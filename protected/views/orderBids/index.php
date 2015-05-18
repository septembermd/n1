<?php
$this->breadcrumbs = [
    'Order Bids',
];

$this->menu = [
    ['label' => 'Create OrderBids', 'url' => ['create']],
    ['label' => 'Manage OrderBids', 'url' => ['admin']],
];
?>

<h3>Order Bids <span class="badge alert-info"><?php echo $dataProvider->getItemCount(); ?></span></h3>

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
