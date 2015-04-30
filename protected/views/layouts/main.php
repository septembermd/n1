<!DOCTYPE html>
<!-- BEGIN html -->
<html>
<!-- BEGIN head -->
<head>
    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo Yii::app()->baseUrl; ?>/static/images/favicon.ico" type="image/x-icon" />
    <!-- Stylesheets -->
    
    <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/static/css/bootstrap.min.css" />
    <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/static/css/bootstrap-theme.min.css" />
    
    <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/static/js/jquery-1.7.2.min.js"></script>
    
    <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/static/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/static/js/scripts.js"></script>
    
    <!-- END head -->
    <?php
        //Yii::app()->bootstrap->register();
        Yii::app()->clientScript->scriptMap=array(
            'jquery.js'=>false,
            'jquery.min.js'=>false,
        );
    ?>
    <title>Delivery Nr.1</title>    
</head>
<!-- BEGIN body -->
<body>
  
  <div class="container">
    <div class="row">
      <div class="col-md-12">        
        <?php echo $content;?>
      </div>
    </div>
  </div>

</body>
<!-- END html -->
</html>