<?php
/** @var AccessControlList $acl */
/** @var Order $model */

/** @var User $user */
$user = $acl->getUser();
?>

<?php if ($user->isCarrier()) : // Carrier view ?>
    <div class="row">
        <div class="col-md-12 text-center" style="margin-top:50px;">
            <?php if ($model->isHaulerNeeded()) : ?>
                <?php if ($model->isTransportationOfferedByUser($user)) : ?>
                    <?php
                    /** @var OrderBids $userBid */
                    $userBid = $model->getOrderBidByUser($user);
                    ?>
                    <?php if ($userBid->isWithdrawn()) : ?>
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
            <?php elseif ($model->isInTransit()) : ?>
                <?php if (!$model->isCargoLoaded()) : ?>
                    <?php $this->widget(
                        'booster.widgets.TbButton',
                        [
                            'label' => 'Load Cargo',
                            'context' => 'primary',
                            'buttonType' =>'link',
                            'url' => ['order/loadCargo', 'id' => $model->id],
                            'size' => 'large',
                            'htmlOptions' => [
                                'confirm' => Yii::t('main', "Are you sure you'd like to submit this action?"),
                            ],
                        ]
                    ); ?>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>


<?php elseif ($user->isManager()) : // Manager view ?>
    <div class="row">
        <div class="col-md-12 text-center" style="margin-top:50px;">
            <?php if ($model->isHaulerNeeded()): ?>
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
                        'url' => ['orderBids/bestOffer', 'orderId' => $model->id],
                        'size' => 'large'
                    ]
                ); ?>
            <?php endif; ?>
        </div>
    </div>

<?php elseif ($user->isSupervisor() || $user->isAdmin()) : // Supervisor and Admin view ?>
    <div class="row">
        <div class="col-md-12 text-center" style="margin-top:50px;">
            <?php if ($model->isDeleted()) : ?>
                <?php $this->widget(
                    'booster.widgets.TbButton',
                    [
                        'label' => Yii::t('main', 'Restore'),
                        'context' => 'primary',
                        'buttonType' =>'link',
                        'url' => ['order/restore', 'id' => $model->id],
                        'size' => 'large'
                    ]
                ); ?>

            <?php elseif ($model->isHaulerNeeded()): ?>
                <?php $this->widget(
                    'booster.widgets.TbButton',
                    [
                        'label' => Yii::t('main', 'Withdraw'),
                        'context' => 'primary',
                        'buttonType' =>'link',
                        'url' => ['order/withdraw', 'id' => $model->id],
                        'size' => 'large'
                    ]
                ); ?>
                <?php $this->widget(
                    'booster.widgets.TbButton',
                    [
                        'label' => sprintf("%s (%s)", Yii::t('main', 'Check offers'), $model->getBidsCount()),
                        'context' => 'primary',
                        'buttonType' =>'link',
                        'url' => ['orderBids/index', 'orderId' => $model->id],
                        'size' => 'large'
                    ]
                ); ?>

            <?php elseif ($model->isInTransit()) : ?>
                <?php $this->widget(
                    'booster.widgets.TbButton',
                    [
                        'label' => Yii::t('main', 'Accomplish'),
                        'context' => 'primary',
                        'buttonType' =>'link',
                        'url' => ['order/accomplish', 'id' => $model->id],
                        'size' => 'large'
                    ]
                ); ?>

            <?php elseif ($model->isDelivered()) : ?>
                <?php $this->widget(
                    'booster.widgets.TbButton',
                    [
                        'label' => Yii::t('main', 'Reopen'),
                        'context' => 'warning',
                        'buttonType' =>'link',
                        'url' => ['order/reopen', 'id' => $model->id],
                        'size' => 'large',
                        'htmlOptions' => [
                            'confirm' => Yii::t('main', "Are you sure you'd like to submit this action?"),
                        ],
                    ]
                ); ?>
            <?php endif; ?>
        </div>
    </div>

<?php endif; ?>