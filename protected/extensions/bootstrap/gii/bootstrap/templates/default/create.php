<?php
/**
 * The following variables are available in this template:
 * - $this: the BootCrudCode object
 */
?>
<?php
echo "<?php\n";
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label'=>array('admin'),
	'Create',
);\n";
?>

$this->menu=array(
	array('label'=>'Manage <?php echo $this->modelClass; ?>','url'=>array('admin')),
);
?>

<legend>Create <?php echo $this->modelClass; ?></legend>

<?php echo "<?php echo \$this->renderPartial('_form', array('model'=>\$model)); ?>"; ?>
