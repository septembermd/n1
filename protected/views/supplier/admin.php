<?php
$this->breadcrumbs = [
    'Suppliers',
    'Manage',
];

$this->menu = [
    ['label' => Yii::t('main', 'Create Supplier'), 'url' => ['create']],
    ['label' => Yii::t('main', 'Manage Suppliers'), 'url' => ['index']],
];
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo Yii::t('main', 'Manage Suppliers'); ?></h3>

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
    </div>
    <div class="panel-body">
        <p>
            You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
                &lt;&gt;</b>
            or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
        </p>

        <?php $this->widget('booster.widgets.TbGridView', [
            'id' => 'supplier-grid',
            'dataProvider' => $model->search(),
            'filter' => $model,
            'columns' => [
                'title',
                [
                    'class' => 'booster.widgets.TbButtonColumn',
                    'template' => '{update} {delete}',
                ],
            ],
        ]); ?>
    </div>
</div>