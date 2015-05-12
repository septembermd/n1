<?php
$this->breadcrumbs= [
	'Orders'=> ['index'],
	$model->id=> ['view','id'=>$model->id],
	'Update',
];

	$this->menu= [
	['label'=>'List Order','url'=> ['index']],
	['label'=>'Create Order','url'=> ['create']],
	['label'=>'View Order','url'=> ['view','id'=>$model->id]],
	['label'=>'Manage Order','url'=> ['admin']],
    ];
	?>

	<h1>Update Order <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', ['model'=>$model]); ?>