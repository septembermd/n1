<?php
/**
 * Created by Idol IT.
 * Date: 9/29/12
 * Time: 5:35 PM
 */

class BackendModule extends CWebModule
{
    private $_assetsUrl;

    public function init()
    {
        // this method is called when the module is being created
        // you may place code here to customize the module or the application

        // import the module-level models and components
        Yii::app()->getComponent('bootstrap');
        Yii::app()->errorHandler->errorAction = '/backend/default/error';
        Yii::app()->clientScript->coreScriptPosition = CClientScript::POS_HEAD;

        $this->setImport(array(
            'backend.models.*',
            'backend.components.*',
            'backend.controllers.*',
            'backend.actions.*',
        ));

        $this->setComponents(array(
            'errorHandler' => array(
                'errorAction' => 'backend/default/error'),

            'user' => array(
                'class' => 'CWebUser',
                'loginUrl' => Yii::app()->createUrl('backend/default/login'),
                'returnUrl' => array('backend'),
            ),
        ));

    }

    public function beforeControllerAction($controller, $action)
    {
        if (parent::beforeControllerAction($controller, $action)) {
            // this method is called before any module controller action is performed
            // you may place customized code here
            $route = $controller->id . '/' . $action->id;
            // echo $route;
            $publicPages = array(
                'default/login',
                'default/error',
                'product/upload',
                'product/gallery',
                'news/gallery',
                'news/upload',
                'layout/upload',
            );
            if (Yii::app()->user->isGuest && !in_array($route, $publicPages)) {
                Yii::app()->getModule('backend')->user->loginRequired();
            } else
                return true;
        } else
            return false;
    }

    public function getAssetsUrl()
    {
        if ($this->_assetsUrl === null)
            $this->_assetsUrl = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('application.modules.backend.assets'),false,-1,false);
        return $this->_assetsUrl;
    }

    public function setAssetsUrl($value)
    {
        $this->_assetsUrl = $value;
    }
}
