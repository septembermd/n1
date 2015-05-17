<?php
$this->breadcrumbs = [
    'Suppliers' => ['admin'],
    'Create',
];

$this->menu = [
    ['label' => 'List Supplier', 'url' => ['index']],
    ['label' => 'Manage Supplier', 'url' => ['admin']],
];
?>

<?php echo $this->renderPartial('_form', ['model' => $model]); ?>