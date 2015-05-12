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
    
    <script src="<?php echo Yii::app()->baseUrl; ?>/static/js/jquery-1.7.2.min.js"></script>
    
    <script src="<?php echo Yii::app()->baseUrl; ?>/static/js/jquery-ui.min.js"></script>
    <script src="<?php echo Yii::app()->baseUrl; ?>/static/js/scripts.js"></script>
    
    <!-- END head -->
    <?php
        Yii::app()->clientScript->scriptMap= [
            'jquery.js'=>false,
            'jquery.min.js'=>false,
        ];
    ?>
    <title>Delivery Nr.1</title>    
</head>
<!-- BEGIN body -->
<body>
    <header class="navbar navbar-static-top">
        <div class="container">
            <?php $this->widget('MainMenuWidget', ['acl' => $this->acl]); ?>
        </div>
    </header>
  
  <div class="container">
      <?php $this->widget(
          'booster.widgets.TbBreadcrumbs',
          [
              'homeLink' => 'Nr.1',
              'links' => $this->breadcrumbs
          ]
      ); ?>
    <div class="row">
      <div class="col-md-12">        
        <?php echo $content;?>
      </div>
    </div>
  </div>

<footer style="margin-top: 35px;">
    <div class="container">
        <div class="copyright">
            <a href="#" class="pull-left">Developed by Cybtronix</a>
            <span class="pull-right">Nr.1 &copy; 2015</span>
        </div>
    </div>
</footer>

</body>
<!-- END html -->
</html>