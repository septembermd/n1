<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle = Yii::app()->name . ' - Error';
$this->breadcrumbs = [
    'Error',
];
?>
<div class="error-container">
    <div class="error-code">
        <?php echo $code; ?>
    </div>
    <div class="error-text">
        <?php echo CHtml::encode($message); ?>
    </div>
    <div class="error-subtext">
        <?php echo Yii::t('main', "Unfortunately we're having trouble loading the page you are looking for. Please wait a moment and try again or use action below."); ?>
    </div>
    <div class="error-actions">
        <div class="row">
            <div class="col-md-6">
                <?php echo CHtml::link('Return to Home page', ['order/index'], ['class' => 'btn btn-info btn-block btn-lg']); ?>
            </div>
            <div class="col-md-6">
                <button onclick="history.back();" class="btn btn-primary btn-block btn-lg">Previous page</button>
            </div>
        </div>
    </div>
</div>