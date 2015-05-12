<?php
/** @var AccessControlList $acl */
/** @var Order $model */
/** @var User $user */
$user = $acl->getUser();
?>

<?php if ($user->isCarrier()) : ?>
    <div class="row">
        <div class="col-md-12 text-center" style="margin-top:50px;">
            <?php if ($model->isTransportationOfferedByUser($user)) : ?>
                <?php
                /** @var OrderBids $userBid */
                $userBid = $model->getOrderBidByUser($user);
                ?>

                <?php if($userBid->isWithdrawn()) : ?>
                    <p><?php echo Yii::t('main', 'Your offer was withdrawn'); ?></p>
                <?php else : ?>
                    <p><?php printf("%s: <strong>%s %s</strong>", Yii::t('main', 'Your bid is'), $userBid->cost, $model->currency->title);?></p>
                    <?php $this->widget(
                        'booster.widgets.TbButton',
                        [
                            'label' => Yii::t('main', 'Withdraw'),
                            'context' => 'primary',
                            'buttonType' =>'link',
                            'url' => ['orderBids/delete', 'id' => $userBid->id, 'orderId' => $model->id],
                            'size' => 'large'
                        ]
                    ); ?>
                <?php endif; ?>
            <?php else : ?>
                <?php $this->widget(
                    'booster.widgets.TbButton',
                    [
                        'label' => 'Offer Transportation',
                        'context' => 'primary',
                        'buttonType' =>'link',
                        'url' => ['orderBids/create', 'orderId' => $model->id],
                        'size' => 'large'
                    ]
                ); ?>
            <?php endif; ?>
        </div>
    </div>


<?php elseif ($user->isManager()) : ?>
    <div class="row">
        <div class="col-md-12 text-center" style="margin-top:50px;">
            <?php $this->widget(
                'booster.widgets.TbButton',
                [
                    'label' => Yii::t('main', 'Withdraw'),
                    'context' => 'primary',
                    'url' => ['order/index'],
                    'size' => 'large'
                ]
            ); ?>
            <?php $this->widget(
                'booster.widgets.TbButton',
                [
                    'label' => Yii::t('main', 'Best Offer'),
                    'context' => 'primary',
                    'url' => ['orderBids/create', 'orderId' => $model->id],
                    'size' => 'large'
                ]
            ); ?>
        </div>
    </div>

<?php elseif ($user->isSupervisor() || $user->isAdmin()) : ?>
    <div class="row">
        <div class="col-md-12 text-center" style="margin-top:50px;">
            <?php $this->widget(
                'booster.widgets.TbButton',
                [
                    'label' => Yii::t('main', 'Withdraw'),
                    'context' => 'primary',
                    'url' => ['order/index'],
                    'size' => 'large'
                ]
            ); ?>
            <?php $this->widget(
                'booster.widgets.TbButton',
                [
                    'label' => sprintf("%s (%s)", Yii::t('main', 'Check offers'), $model->getBidsCount()),
                    'context' => 'primary',
                    'url' => ['order/index'],
                    'size' => 'large'
                ]
            ); ?>
        </div>
    </div>

<?php endif; ?>