<?php
/**
 * @var $model User
 * @var $this BackendController
 **/
$this->breadcrumbs = array(
    'Users' => array('admin'),
    'Manage',
);

$this->menu = array(
    array('label' => 'Create User', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('user-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<legend>Manage Users</legend>

<p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
    &lt;&gt;</b>
    or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button btn')); ?>
<div class="search-form" style="display:none">
    <?php $this->renderPartial('_search', array(
    'model' => $model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'user-grid',
    'dataProvider' => $model->search(),
    'type' => 'striped bordered condensed',
    'filter' => $model,
    'columns' => array(
        array('name'=>'id','headerHtmlOptions'=>array('width'=>'40px')),
        'username',
        'name',
        'email',
        'is_active:boolean',
        'is_staff:boolean',
        'last_login',
        array(
            'class' => 'backend.components.ButtonColumn',
            'htmlOptions' => array('width' => '60px'),
        ),
    ),
)); ?>


