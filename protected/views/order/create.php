<?php
$this->breadcrumbs= [
	'Orders'=> ['index'],
	'Create',
];

$this->menu= [
['label'=>'List Order','url'=> ['index']],
['label'=>'Manage Order','url'=> ['admin']],
];
?>

<h1><?php echo Yii::t('main', 'Create Order'); ?></h1>

<?php echo $this->renderPartial('_form', ['model'=>$model]); ?>