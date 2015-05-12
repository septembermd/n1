<?php
$this->breadcrumbs= [
	'Orders',
];

$this->menu= [
    ['label'=>'Create Order','url'=> ['create']],
    ['label'=>'Manage Order','url'=> ['admin']],
];
?>

<?php
$statusNavigationItems = [];
foreach(Order::$statusMap as $statusId => $label) {
    $statusNavigationItems[] = [
        'label' => $label,
        'url' => ['order/index', 'status' => $statusId],
        'active' => $isDeleted ? false : ($currentStatus === $statusId)
    ];
}
$statusNavigationItems[] = [
    'label' => 'Deleted',
    'url' => ['order/index', 'deleted'=>Order::IS_DELETED]
];

echo CHtml::link(Yii::t('main', 'New Order'), ['order/create'], ['class'=>'btn btn-primary pull-right']);

$this->widget(
    'booster.widgets.TbMenu',
    [
        'type' => 'pills',
        'items' => $statusNavigationItems,
    ]
);
?>

<?php $this->widget(
    'booster.widgets.TbListView',
    [
        'dataProvider'=>$dataProvider,
        'itemView'=>'_view',
        'template' => '{items}{pager}'
    ]
); ?>
