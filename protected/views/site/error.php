<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle = Yii::app()->name . ' - Error';
$this->breadcrumbs = [
    'Error',
];
?>

<h2>Error <?php echo $code; ?></h2>

<div class="error">
    <p><?php echo CHtml::encode($message); ?></p>

    <p><?php echo CHtml::link('Return to Home page', ['site/index']); ?></p>
</div>