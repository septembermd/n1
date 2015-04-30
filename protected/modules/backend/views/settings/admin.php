<?php
$this->breadcrumbs=array(
	'Settings'=>array('admin'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create Setting','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('settings-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<legend>Manage Settings</legend>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'settings-grid',
    'type' => 'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>null,
    'htmlOptions'=>array('style'=>'padding:0;'),
	'columns'=>array(
        array('name'=>'id','headerHtmlOptions'=>array('width'=>'40px')),
		'name',
        array(
            'class' => 'backend.components.ButtonColumn',
            'htmlOptions' => array('width' => '60px'),
            'template'=>'{view} {update}'
        ),
	),
)); ?>
