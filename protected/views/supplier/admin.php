<?php
$this->breadcrumbs = [
    'Suppliers' => ['index'],
    'Manage',
];

$this->menu = [
    ['label' => 'List Supplier', 'url' => ['index']],
    ['label' => 'Create Supplier', 'url' => ['create']],
];

Yii::app()->clientScript->registerScript('search', "
    $('.search-button').click(function(){
        $('.search-form').toggle();
            return false;
        });
        $('.search-form form').submit(function(){
            $.fn.yiiGridView.update('supplier-grid', {
            data: $(this).serialize()
        });
        return false;
    });
");
?>

<p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
        &lt;&gt;</b>
    or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link(Yii::t('main', 'Advanced Search'), '#', ['class' => 'search-button btn']); ?>

<?php $this->widget(
    'booster.widgets.TbButton',
    [
        'label' => Yii::t('main', 'Add New Supplier'),
        'context' => 'primary',
        'buttonType' =>'link',
        'url' => ['supplier/create'],
        'size' => 'small',
        'htmlOptions' => ['class' => 'pull-right']
    ]
); ?>

<div class="search-form" style="display:none">
    <?php $this->renderPartial('_search', [
        'model' => $model,
    ]); ?>
</div><!-- search-form -->

<?php $this->widget('booster.widgets.TbGridView', [
    'id' => 'supplier-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => [
//        'id',
        'title',
        [
            'class' => 'booster.widgets.TbButtonColumn',
            'template' => '{update} {delete}',
        ],
    ],
]); ?>
