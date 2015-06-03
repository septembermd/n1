<?php
/** @var OrderBidsController $this */
/** @var $model OrderBids */

$this->breadcrumbs = [
    Yii::t('main', 'Orders') => ['order/index'],
    $model->order->id => ['order/view', 'id' => $model->order->id],
    Yii::t('main', 'Best Offer'),
];
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?php echo Yii::t('main', 'Best Offer'); ?>
        </h3>
    </div>
    <div class="panel-body">
        <div class="text-center">
            <p><?php echo Yii::t('main', 'Please, assign order to hauler offering best price.'); ?></p>
            <p><?php echo Yii::t('main', 'Delivery cost'); ?>: <?php echo $model->cost; ?> <?php echo $model->order->currency->title; ?></p>
            <p><?php echo Yii::t('main', 'Recent issues');?>: <?php echo $ordersWithIssuesCount; ?></p>

        </div>
    </div>
    <div class="panel-footer text-center">
        <?php $this->widget(
            'booster.widgets.TbButton',
            [
                'label' => Yii::t('main', 'Withdraw'),
                'context' => 'primary',
                'buttonType' =>'link',
                'url' => ['orderBids/withdrawBid', 'id' => $model->id],
                'size' => 'large'
            ]
        ); ?>
        <?php $this->widget(
            'booster.widgets.TbButton',
            [
                'label' => Yii::t('main', 'Accept Offer'),
                'context' => 'primary',
                'buttonType' =>'link',
                'url' => ['orderBids/accept', 'orderBidId' => $model->id],
                'size' => 'large'
            ]
        ); ?>
    </div>
</div>
