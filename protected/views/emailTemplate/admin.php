<?php
$this->breadcrumbs = array(
    Yii::t('main', 'Email Templates') => array('admin'),
    Yii::t('main', 'Manage'),
);

$this->menu = array(
    array('label' => Yii::t('main', 'Email Templates'), 'url' => array('admin')),
);

?>


<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo Yii::t('main', 'Manage Email Templates'); ?></h3>
    </div>
    <div class="panel-body">
        <p>
            You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
                &lt;&gt;</b>
            or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
        </p>

        <?php $this->widget('booster.widgets.TbGridView', array(
            'id' => 'email-template-grid',
            'type' => 'striped',
            'dataProvider' => $model->search(),
            'filter' => $model,
            'columns' => array(
                'slug',
                'subject',
                array(
                    'class' => 'booster.widgets.TbButtonColumn',
                    'template' => '{view} {update}'
                ),
            ),
        )); ?>

    </div>
</div>
