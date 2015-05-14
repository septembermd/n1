<?php
/** @var OrderBidsController $this */
/** @var $model OrderBids */
?>
<div class="row">
    <div class="col-md-12 text-center" style="margin-top:50px;">
        <p><?php echo Yii::t('main', 'Please, assign order to hauler offering best price.'); ?></p>

        <p><?php echo Yii::t('main', 'Delivery cost'); ?>: <?php echo $model->cost; ?> <?php echo $model->order->currency->title; ?></p>
        <p><?php echo Yii::t('main', 'Recent issues');?>: <?php echo $ordersWithIssuesCount; ?></p>

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