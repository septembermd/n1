<div class="view row" style="margin-bottom: 20px">

    <div class="col-md-2">
        <?php echo CHtml::encode($data->user->company->title); ?>
    </div>

    <div class="col-md-2">
        <?php echo CHtml::encode($data->cost); ?> <?php echo CHtml::encode($data->order->currency->title); ?>
    </div>

    <div class="col-md-2">
        <?php echo CHtml::encode($data->created); ?>
    </div>

    <div class="col-md-2">
        2
    </div>

    <div class="col-md-2">
        <?php if ($data->order->isHaulerNeeded()) : ?>
            <?php $this->widget(
                'booster.widgets.TbButton',
                [
                    'label' => 'Accept Offer',
                    'context' => 'primary',
                    'buttonType' =>'link',
                    'url' => ['orderBids/accept', 'orderBidId' => $data->id],
                    'size' => 'small'
                ]
            ); ?>
        <?php endif; ?>
    </div>
</div>