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
    <?php Yii::app()->clientScript->registerCssFile("/css/mcustomscrollbar/jquery.mCustomScrollbar.css"); ?>
    <?php Yii::app()->clientScript->registerCssFile("/css/fontawesome/font-awesome.min.css"); ?>
    <?php Yii::app()->clientScript->registerCssFile("/css/theme-default.css"); ?>
    <?php Yii::app()->clientScript->registerCssFile("/css/main.css"); ?>

    <!-- Scripts -->
    <?php Yii::app()->clientScript->registerScriptFile("/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js", CClientScript::POS_END); ?>
    <?php Yii::app()->clientScript->registerScriptFile("/js/plugins.js", CClientScript::POS_END); ?>
    <?php Yii::app()->clientScript->registerScriptFile("/js/actions.js", CClientScript::POS_END); ?>
    <?php Yii::app()->clientScript->registerScriptFile("/static/js/scripts.js", CClientScript::POS_END); ?>

    <!-- END head -->
    <title>Delivery Nr.1</title>
</head>
<!-- BEGIN body -->
<body>

<div class="page-container">

    <?php $this->widget('MainMenuWidget', ['acl' => $this->acl]); ?>

    <div class="page-content">

        <?php $this->widget(
            'booster.widgets.TbBreadcrumbs',
            [
                'homeLink' => 'Nr.1',
                'links' => $this->breadcrumbs
            ]
        ); ?>

        <div class="page-content-wrap">
            <div class="row">
                <div class="col-md-12">
                    <?php echo $content;?>
                </div>
            </div>
        </div>


    </div>

    <footer class="footer-main clearfix">
        <div class="page-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="copyright">
                        <span class="pull-left">Request support by email <a href="mailto:dostavka@number.one">dostavka@number.one</a> or by phone - +373 69 99 9999</span>
                        <span class="pull-right">Cybtronix &copy; 2015</span>
                    </div>
                </div>
            </div>
        </div>
    </footer>

</div>

</body>
<!-- END html -->
</html>