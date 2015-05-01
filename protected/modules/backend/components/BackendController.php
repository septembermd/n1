<?php

/**
 * .
 * Date: 9/29/12
 * Time: 5:57 PM
 */
class BackendController extends Controller {

  public $layout = "/layouts/main";
  public $sidebar_tab;

  public function init() {
    
    /*if (!Yii::app()->user->isGuest) {
      $user = Superuser::model()->findByPk(Yii::app()->user->id);

      
      if (!$user->is_active) {
        Yii::app()->user->logout();
      } else {
        $user->flash_messages = false;
        $user->last_login = new CDbExpression('NOW()');
        $user->save();
      }
    }*/
    
    parent::init();

    if (!empty($this->sidebar_tab))
      Yii::app()->session["sidebar_tab"] = $this->sidebar_tab;
  }

  public function filters() {
    return array(
      'accessControl', // perform access control for CRUD operations
    );
  }

  /**
   * Specifies the access control rules.
   * This method is used by the 'accessControl' filter.
   * @return array access control rules
   */
  public function accessRules() {
    return array(
      array('allow',
        'actions' => array('upload', 'gallery', 'logout', 'login', 'error'),
        'users' => array('*'),
      ),
      array('allow', // allow admin user to perform 'admin' and 'delete' actions
        'actions' => array(
          'createrow',
          'send',
          'addrecipients',
          'rendercustomizer',
          'applyproduct',
          'detachproduct',
          'deleterow',
          'customize',
          'index',
          'tree',
          'view',
          'create',
          'update',
          'delete',
          'admin',
          'map',
          'imagedel',
          'newcustomer',
          'addproduct',
          'addstatus',
          'updatepassword',
          'search',
          'viewall',
          'excel'
        ),
        'expression' => 'isset(Yii::app()->user->id) && Superuser::model()->findByPk(Yii::app()->user->id)->is_staff',
      ),
      array('deny', // deny all users
        'users' => array('*'),
      ),
    );
  }

}
