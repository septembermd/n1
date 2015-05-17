<?php
$this->breadcrumbs = [
    'Suppliers' => ['admin'],
    $model->title,
    'Update',
];

$this->menu = [
    ['label' => 'List Supplier', 'url' => ['index']],
    ['label' => 'Create Supplier', 'url' => ['create']],
    ['label' => 'View Supplier', 'url' => ['view', 'id' => $model->id]],
    ['label' => 'Manage Supplier', 'url' => ['admin']],
];
?>

<?php echo $this->renderPartial('_form', ['model' => $model]); ?>