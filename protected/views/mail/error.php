<h2>Error [<?php echo $type; ?>] [<?php echo $code; ?>] in <?php echo $file; ?> on line <?php echo $line; ?></h2>

<div class="error">
    <p><?php echo CHtml::encode($message); ?></p>
    <p><?php echo CHtml::encode($trace); ?></p>
</div>

<p><?php echo $source; ?></p>