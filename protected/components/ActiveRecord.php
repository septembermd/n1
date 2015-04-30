<?php
/**
 * Created by JetBrains PhpStorm.
 * User: admin
 * Date: 10/3/12
 * Time: 12:36 PM
 * To change this template use File | Settings | File Templates.
 */

class ActiveRecord extends CActiveRecord
{

    /* Disable flash messages in actions */
    public $flash_messages = true;

    public function requiredAlert(){
        if (!$this->hasErrors())
            return '<div class="alert alert-info">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        Fields with <strong>*</strong> are required.
                    </div>';
        else
            return '';
    }

    protected function beforeSave()
    {
        /**
         * Check for file fields if finded then paste values into form
         */


        $rules = $this->rules();
        foreach ($rules as $rule) {
            if (in_array('file',$rule,true)) {

                $begin = true;
                if(isset($rule['on']))
                {
                    if(is_array($rule['on']))
                    {
                        if(!in_array($this->scenario,$rule['on']))
                            $begin = false;
                    }
                    else
                    {
                        if($this->scenario != $rule['on'])
                            $begin = false;

                        if (!in_array($this->scenario, array_map('trim',explode(",",$rule["on"]))))
                            $begin = false;
                    }
                }

                if($begin)
                {

                    $attributes = array_map('trim',explode(",",$rule[0]));
                    foreach ($attributes as $attribute) {

                        if ($this->hasAttribute($attribute)) {
                            $image = CUploadedFile::getInstance($this, $attribute);
                            if (is_object($image)) {
                                $this->putImages($image, $attribute);
                            }

                            if (isset($_POST[get_class($this)][$attribute . "_remove"]))
                                $this->$attribute = "";

                        }

                    }
                }
            }
        }

        if ($this->flash_messages) {
            $name = get_class($this);
            if($this->hasAttribute('name')){
                $id = CHtml::link($this->name,array('view','id'=>$this->id));
            }else{
                $id = CHtml::link($this->id,array('view','id'=>$this->id));
            }
            switch ($this->scenario) {
                case "newcustomer":
                    Yii::log("$name $id was successfully created.", "profile", "backend");
                    Yii::app()->user->setFlash('success', "$name was successfully created.");
                    break;
                case "insert":
                    Yii::log("$name $id was successfully created.", "profile", "backend");
                    Yii::app()->user->setFlash('success', "$name was successfully created.");
                    break;
                case "update":
                    Yii::log("$name $id was successfully updated.", "profile", "backend");
                    Yii::app()->user->setFlash('success', "$name was successfully updated.");
                    break;
                case "updatepassword":
                    Yii::log("Password of user " . $this->name . " was changed successfully.", "profile", "backend");
                    Yii::app()->user->setFlash('success', "Password of user " . $this->name . " was changed successfully.");
                    break;
                default:
                    break;
            }
        }

        /**
         * Check if author exists in model then paste value info form
         */

        if ($this->hasAttribute('author') && empty($this->author))
            $this->author = Yii::app()->user->id;

        return parent::beforeSave();
    }


    /**
     * @var $image CUploadedFile
     */
    protected function putImages($image, $attribute)
    {
        $filename = $this->imageName($image);
        $path = 'images/site/' . get_class($this) . "/" . $filename;
        $dir = Yii::getPathOfAlias("webroot") . '/images/site/' . get_class($this) . '/';

        $path = strtolower($path);
        $dir = strtolower($dir);

        if (!is_dir($dir))
            mkdir($dir, 0777, true);


        $this->$attribute = $path;
        $image->saveAs($path);
    }

    private function imageName($name)
    {
        $data = explode(".",$name);
        $ext = ".".$data[count($data)-1];
        $filename = md5(rand(1, 99999) . $name) . $ext;
        return $filename;
    }



    protected function afterDelete()
    {
        $name = get_class($this);
        if($this->hasAttribute('name')){
            $id = CHtml::link($this->name,array('view','id'=>$this->id));
        }else{
            $id = CHtml::link($this->id,array('view','id'=>$this->id));
        }
        Yii::log("$name $id was successfully deleted.", "profile", "backend");
        Yii::app()->user->setFlash('success', "$name was successfully deleted.");
    }

}
