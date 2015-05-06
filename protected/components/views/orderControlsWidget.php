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
                <?php $this->widget(
                    'booster.widgets.TbButton',
                    array(
                        'label' => Yii::t('main', 'Withdraw'),
                        'context' => 'primary',
                        'url' => array('order/index'),
                        'size' => 'large'
                    )
                ); ?>
            <?php else : ?>
                <?php $this->widget(
                    'booster.widgets.TbButton',
                    array(
                        'label' => 'Offer Transportation',
                        'context' => 'primary',
                        'url' => array('order/index'),
                        'size' => 'large'
                    )
                ); ?>
            <?php endif; ?>
        </div>
    </div>


<?php elseif ($user->isManager()) : ?>
    <div class="row">
        <div class="col-md-12 text-center" style="margin-top:50px;">
            <?php $this->widget(
                'booster.widgets.TbButton',
                array(
                    'label' => Yii::t('main', 'Withdraw'),
                    'context' => 'primary',
                    'url' => array('order/index'),
                    'size' => 'large'
                )
            ); ?>
            <?php $this->widget(
                'booster.widgets.TbButton',
                array(
                    'label' => Yii::t('main', 'Best Offer'),
                    'context' => 'primary',
                    'url' => array('order/index'),
                    'size' => 'large'
                )
            ); ?>
        </div>
    </div>

<?php elseif ($user->isSupervisor() || $user->isAdmin()) : ?>
    <div class="row">
        <div class="col-md-12 text-center" style="margin-top:50px;">
            <?php $this->widget(
                'booster.widgets.TbButton',
                array(
                    'label' => Yii::t('main', 'Withdraw'),
                    'context' => 'primary',
                    'url' => array('order/index'),
                    'size' => 'large'
                )
            ); ?>
            <?php $this->widget(
                'booster.widgets.TbButton',
                array(
                    'label' => sprintf("%s (%s)", Yii::t('main', 'Check offers'), $model->getBidsCount()),
                    'context' => 'primary',
                    'url' => array('order/index'),
                    'size' => 'large'
                )
            ); ?>
        </div>
    </div>

<?php endif; ?>