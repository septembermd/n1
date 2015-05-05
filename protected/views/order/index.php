<?php
$this->breadcrumbs=array(
	'Orders',
);

$this->menu=array(
    array('label'=>'Create Order','url'=>array('create')),
    array('label'=>'Manage Order','url'=>array('admin')),
);
?>

<?php
$statusNavigationItems = array();
$statusNavigationItems[] = array(
    'label' => 'All',
    'url' => array('order/index', 'status'=>0)
);
foreach(Order::$statusMap as $statusId => $label) {
    $statusNavigationItems[] = array(
        'label' => $label,
        'url' => array('order/index', 'status' => $statusId)
    );
}
$statusNavigationItems[] = array(
    'label' => 'Deleted',
    'url' => array('order/index', 'deleted'=>1)
);

echo CHtml::link(Yii::t('main', 'New Order'), array('order/create'), array('class'=>'btn btn-primary pull-right'));

$this->widget(
    'booster.widgets.TbMenu',
    array(
        'type' => 'pills',
        'items' => $statusNavigationItems
    )
);
?>

<?php $this->widget(
    'booster.widgets.TbListView',
    array(
        'dataProvider'=>$dataProvider,
        'itemView'=>'_view',
        'template' => '{items}{pager}'
    )
); ?>
