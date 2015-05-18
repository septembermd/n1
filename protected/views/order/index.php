<?php
/** @var Order $order */
/** @var bool $isDeleted */
/** @var int $currentStatus */
/** @var CActiveDataProvider $dataProvider */

$this->breadcrumbs = [
    'Orders',
];

$this->menu = [
    ['label' => 'Create Order', 'url' => ['create']],
    ['label' => 'Manage Order', 'url' => ['admin']],
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

if ($this->acl->canCreateOrder()) {
    echo CHtml::link(Yii::t('main', 'New Order'), ['order/create'], ['class' => 'btn btn-primary pull-right']);
}

$this->widget(
    'booster.widgets.TbMenu',
    [
        'type' => 'pills',
        'encodeLabel' => false,
        'items' => $statusNavigationItems,
    ]
);
?>

<?php $this->widget(
    'booster.widgets.TbListView',
    [
        'dataProvider' => $dataProvider,
        'itemView' => '_view',
        'template' => '{items}{pager}'
    ]
); ?>
