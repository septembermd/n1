<?php
$this->breadcrumbs = [
    Yii::t('main', 'Order Bids'),
];

$this->menu = [
    ['label' => Yii::t('main', 'Create OrderBids'), 'url' => ['create']],
    ['label' => Yii::t('main', 'Manage OrderBids'), 'url' => ['admin']],
];
?>

<h3></h3>


<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?php echo Yii::t('main', 'Order Bids'); ?>
        </h3>
        <span class="badge pull-right"><?php printf('%s %s', $dataProvider->getItemCount(), Yii::t('main', 'offers')); ?></span>
    </div>
    <div class="panel-body">

        <div class="row" style="margin-top:20px;">
            <div class="col-md-2"><strong><?php echo Yii::t('main', 'Hauler'); ?></strong></div>
            <div class="col-md-2"><strong><?php echo Yii::t('main', 'Delivery Cost'); ?></strong></div>
            <div class="col-md-2"><strong><?php echo Yii::t('main', 'Created on'); ?></strong></div>
            <div class="col-md-2"><strong><?php echo Yii::t('main', 'Recent Problems'); ?></strong></div>
            <div class="col-md-2"></div>
        </div>

        <?php $this->widget('booster.widgets.TbListView', [
            'dataProvider' => $dataProvider,
            'template' => '{items}{pager}',
            'itemView' => '_view',
        ]); ?>
    </div>
</div>