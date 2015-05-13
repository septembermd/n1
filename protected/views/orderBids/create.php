<?php
$this->breadcrumbs= [
	'Order' => ['order/index', 'status' => $model->order->status_id],
    "#$model->order_id" => ['order/view', 'id'=>$model->order_id],
	'Bid for order',
];

$this->menu= [
['label'=>'List OrderBids','url'=> ['index']],
['label'=>'Manage OrderBids','url'=> ['admin']],
];
?>

<h1><?php echo Yii::t('main', 'Bid for order #{orderId}', ['{orderId}'=>$model->order_id]); ?></h1>

<?php echo $this->renderPartial('_form', ['model'=>$model]); ?>