<?php
$this->breadcrumbs= [
	'Order Bids',
	'Create',
];

$this->menu= [
['label'=>'List OrderBids','url'=> ['index']],
['label'=>'Manage OrderBids','url'=> ['admin']],
];
?>

<h1>Create OrderBids</h1>

<?php echo $this->renderPartial('_form', ['model'=>$model]); ?>