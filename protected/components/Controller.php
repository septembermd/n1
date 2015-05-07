<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
    public $pageCur;
    public $filter;
    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout='//layouts/main';
    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu=array();
    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs=array();
    public $current = "home";
    public $active_root;
    public $active_category;

    /** @var AccessControlList */
    public $acl;

    public function init()
    {
        if (!Yii::app()->user->isGuest) {
            $user = User::model();
            $currentUser = $user->findByPk(Yii::app()->user->id);
            if ($currentUser instanceof User) {
                $this->acl = new AccessControlList($currentUser);
                // Logout user if he was disabled or his role was changed by admin
                if ($this->acl->canAuthenticate()) {
                    $user->flash_messages = false;
                    //$user->last_login = new CDbExpression('NOW()');
                    //$user->save();
                } else {
                    Yii::app()->user->logout();
                }
            }
        }
    }

    public function getAssetsUrl()
    {
        if ($this->_assetsUrl === null)
            $this->_assetsUrl = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('webroot.static'), false, -1, true);
        return $this->_assetsUrl;
    }

    public function redirectToHomePage()
    {
        $this->redirect(Yii::app()->homeUrl);
    }

    public function redirectToLoginPage()
    {
        $this->redirect(array('site/login'));
    }
}