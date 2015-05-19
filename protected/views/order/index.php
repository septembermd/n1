<?php
/** @var Order $order */
/** @var bool $isDeleted */
/** @var int $currentStatus */
/** @var CActiveDataProvider $dataProvider */

$this->breadcrumbs = [
    Yii::t('main', 'Orders'),
];

$this->menu = [
    ['label' => Yii::t('main', 'Create Order'), 'url' => ['create']],
    ['label' => Yii::t('main', 'Manage Order'), 'url' => ['admin']],
];
?>

<?php
$statusNavigationItems = [];
foreach (Order::$statusMap as $statusId => $label) {
    $unviewedOrderCount = $order->getUnviewedOrderCountByUserAndStatus($this->acl->getUser(), $statusId);
    $itemLabel = $unviewedOrderCount
        ? sprintf('%s <span class="badge">%s</span>', Yii::t('main', $label), $unviewedOrderCount)
        : Yii::t('main', $label);
    $statusNavigationItems[] = [
        'label' => $itemLabel,
        'url' => ['order/index', 'status' => $statusId],
        'active' => $isDeleted ? false : ($currentStatus === $statusId)
    ];
}
$statusNavigationItems[] = [
    'label' => Yii::t('main', 'Deleted'),
    'url' => ['order/index', 'deleted' => Order::IS_DELETED],
    'visible' => $this->acl->canViewDeletedOrders()
];
?>

<?php if ($this->acl->canCreateOrder()) : ?>
    <?php echo CHtml::link(Yii::t('main', 'New Order'), ['order/create'], ['class' => 'btn btn-primary pull-right']); ?>
<?php endif; ?>

<?php $this->widget(
    'booster.widgets.TbMenu',
    [
        'type' => 'tabs',
        'encodeLabel' => false,
        'htmlOptions' => ['style' => 'margin-top: 0;'],
        'items' => $statusNavigationItems,
    ]
); ?>

<div class="panel panel-default">
    <div class="panel-body">
        <?php $this->widget(
            'booster.widgets.TbListView',
            [
                'dataProvider' => $dataProvider,
                'itemView' => '_view',
                'template' => '{items}{pager}'
            ]
        ); ?>
    </div>
</div>
