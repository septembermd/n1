<?php

/**
 * This is the model class for table "company".
 *
 * The followings are the available columns in table 'company':
 * @property string $id
 * @property string $title
 *
 * The followings are the available model relations:
 * @property User[] $users
 */
class Company extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Company the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'company';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return [
			['title', 'required'],
			['title', 'length', 'max'=>255],
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			['id, title', 'safe', 'on'=>'search'],
        ];
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return [
			'users' => [self::HAS_MANY, 'User', 'company_id'],
        ];
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'title' => 'Title',
        ];
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('title',$this->title,true);

		return new CActiveDataProvider($this, [
			'criteria'=>$criteria,
        ]);
	}

    /**
     * Get list for dropdown
     *
     * @return array
     */
    public static function getList()
    {
        return CHtml::listData(self::model()->findAll(),'id','title');
    }


    /**
     * Get select2 list
     *
     * @return array
     */
    public static function getSelect2List()
    {
        $values = self::getList();
        $results = [];
        foreach ($values as $key => $value) {
            $results[] = [
                'id' => $key,
                'text' => $value
            ];
        }

        return $results;
    }

}