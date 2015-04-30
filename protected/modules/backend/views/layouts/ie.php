<?php

$alias = Yii::getPathOfAlias('application.modules.backend.assets');
$link_1 = Yii::app()->assetManager->publish($alias . '/css/ie.css');
$link_2 = Yii::app()->assetManager->publish($alias . '/js/ie/html5.js');
$link_3 = Yii::app()->assetManager->publish($alias . '/js/ie/respond.min.js');
$link_4 = Yii::app()->assetManager->publish($alias . '/lib/flot/excanvas.min.js');
$link_5 = Yii::app()->assetManager->publish($alias . '/favicon.ico');

?>
<!--[if lte IE 8]>
<link rel="stylesheet" href="<?php echo $link_1; ?>"/>
<script src="<?php echo $link_2; ?>"></script>
<script src="<?php echo $link_3; ?>"></script>
<script src="<?php echo $link_4; ?>"></script>
<![endif]-->

<!-- Favicon -->
<link rel="shortcut icon" href="<?php echo $link_5; ?>"/>