<?php
$this->breadcrumbs = [
    'Order' => ['order/index', 'status' => $model->order->status_id],
    $model->order_id => ['order/view', 'id' => $model->order_id],
    'Bid for order',
];

$this->menu = [
    ['label' => 'List OrderBids', 'url' => ['index']],
    ['label' => 'Manage OrderBids', 'url' => ['admin']],
];
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?php echo Yii::t('main', 'Bid for order #{orderId}', ['{orderId}' => $model->order_id]); ?>
        </h3>
    </div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form', ['model' => $model]); ?>
    </div>
</div>