<?php
$this->breadcrumbs= [
	'Orders'=> ['index'],
	'Manage',
];

$this->menu= [
['label'=>'List Order','url'=> ['index']],
['label'=>'Create Order','url'=> ['create']],
];

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('order-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Manage Orders</h1>

<p>
	You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
		&lt;&gt;</b>
	or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#', ['class'=>'search-button btn']); ?>
<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search', [
	'model'=>$model,
    ]); ?>
</div><!-- search-form -->

<?php $this->widget('booster.widgets.TbGridView', [
'id'=>'order-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=> [
		'id',
		'creator_id',
		'currency_id',
		'status_id',
		'supplier_id',
		'loading_id',
		/*
		'delivery_id',
		'temperature_id',
		'remark_id',
		'valid_date',
		'load_date',
		'deliver_date',
		'loaded_on_date',
		'delivered_on_date',
		'deleted_on_date',
		'is_deleted',
		'created',
		*/
[
'class'=>'booster.widgets.TbButtonColumn',
],
],
]); ?>
