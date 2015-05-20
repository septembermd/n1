<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form TbActiveForm */

$this->pageTitle = Yii::app()->name . ' - Login';

$this->breadcrumbs = [
    Yii::t('main', 'Login'),
];
?>

<div class="login-title"><strong><?php echo Yii::t('main', 'Log In'); ?></strong> to your account</div>

<?php $form = $this->beginWidget('booster.widgets.TbActiveForm', [
    'id' => 'login-form',
    'enableClientValidation' => true,
    'clientOptions' => [
        'validateOnSubmit' => true,
    ],
]); ?>
<?php echo $form->textFieldGroup($model, 'username', ['label' => false]); ?>

<?php echo $form->passwordFieldGroup($model, 'password', ['label' => false]); ?>

<div class="form-group">
    <div class="col-md-6">
        <?php echo CHtml::link(Yii::t('main', 'Forgot your password?'), ['site/accessRestoreRequest'], ['class' => 'btn btn-link btn-block']); ?>
    </div>
    <div class="col-md-6">
        <?php echo CHtml::submitButton(Yii::t('main', 'Login'), ['class' => 'btn btn-info btn-block']); ?>
    </div>
</div>

<?php $this->endWidget(); ?>

<div class="login-subtitle clearfix">
    <br/>
    <?php echo CHtml::link(Yii::t('main', 'Request an account'), ['site/accessRequest']); ?>
</div>