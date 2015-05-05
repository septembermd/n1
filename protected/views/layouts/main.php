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
        Yii::app()->clientScript->scriptMap=array(
            'jquery.js'=>false,
            'jquery.min.js'=>false,
        );
    ?>
    <title>Delivery Nr.1</title>    
</head>
<!-- BEGIN body -->
<body>
    <header class="navbar navbar-static-top">
        <div class="container">
            <nav class="navbar-collapse bs-navbar-collapse collapse" aria-expanded="false" style="height: 1px;">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#">Nr.1</a>
                    </li>
                    <li><?php echo CHtml::link(Yii::t('main', 'Пользователи'), array('user/index'));?></li>
                    <li><?php echo CHtml::link(Yii::t('main', 'Наряды'), array('order/index'));?></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                    <?php if(Yii::app()->user->isGuest): ?>
                        <?php echo CHtml::link(Yii::t('main', 'Войти'), array('site/login')) ?>
                    <?php else: ?>
                        <?php echo CHtml::link(Yii::t('main', 'Выйти'), array('site/logout')) ?>
                    <?php endif ?>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
  
  <div class="container">
    <div class="row">
      <div class="col-md-12">        
        <?php echo $content;?>
      </div>
    </div>
  </div>

<footer>
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