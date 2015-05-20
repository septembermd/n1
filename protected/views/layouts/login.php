<!DOCTYPE html>
<html lang="en" class="body-full-height">
<head>
    <!-- META SECTION -->
    <title><?php echo $this->pageTitle; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    <link rel="icon" href="favicon.ico" type="image/x-icon"/>
    <!-- END META SECTION -->

    <!-- CSS INCLUDE -->
    <?php Yii::app()->clientScript->registerCssFile("/css/theme-default.css"); ?>
    <?php Yii::app()->clientScript->registerCssFile("/css/main.css"); ?>
    <!-- EOF CSS INCLUDE -->
</head>
<body>

<div class="login-container">

    <div class="login-box animated fadeInDown">
        <div class="login-body">
            <?php echo $content; ?>
        </div>
        <div class="login-footer">
            <div class="pull-left">
                <span class="pull-right">Nr.1 &copy; 2015</span>
            </div>
            <div class="pull-right">
                <a href="#" class="pull-left">Developed by Cybtronix</a>
            </div>
        </div>
    </div>

</div>

</body>
</html>






