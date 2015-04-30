<?php
/**
 * @var $this BackendController
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
   <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>-->
    <script src="<?php echo Yii::app()->baseUrl; ?>/js/jq.js"></script>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>



    <!-- gebo blue theme-->
    <link rel="stylesheet" href="<?php echo $this->module->assetsUrl; ?>/css/dark.css" id="link_theme"/>
    <!-- breadcrumbs-->
    <link rel="stylesheet" href="<?php echo $this->module->assetsUrl; ?>/lib/jBreadcrumbs/css/BreadCrumb.css"/>
    <!-- tooltips-->
    <link rel="stylesheet" href="<?php echo $this->module->assetsUrl; ?>/lib/qtip2/jquery.qtip.min.css"/>
    <!-- colorbox -->
    <link rel="stylesheet" href="<?php echo $this->module->assetsUrl; ?>/lib/colorbox/colorbox.css"/>
    <!-- code prettify -->
    <link rel="stylesheet" href="<?php echo $this->module->assetsUrl; ?>/lib/google-code-prettify/prettify.css"/>
    <!-- notifications -->
    <link rel="stylesheet" href="<?php echo $this->module->assetsUrl; ?>/lib/sticky/sticky.css"/>
    <link rel="stylesheet" href="<?php echo $this->module->assetsUrl; ?>/lib/stepy/css/jquery.stepy.css"/>
    <!-- splashy icons -->
    <link rel="stylesheet" href="<?php echo $this->module->assetsUrl; ?>/img/splashy/splashy.css"/>
    <!-- flags -->
    <link rel="stylesheet" href="<?php echo $this->module->assetsUrl; ?>/img/flags/flags.css"/>
    <!-- calendar -->
    <link rel="stylesheet" href="<?php echo $this->module->assetsUrl; ?>/lib/fullcalendar/fullcalendar_gebo.css"/>
    <link rel="stylesheet" href="<?php echo $this->module->assetsUrl; ?>/lib/chosen/chosen.css"/>

    <!-- main styles -->
    <link rel="stylesheet" href="<?php echo $this->module->assetsUrl; ?>/css/style.css"/>
    <link rel="stylesheet" href="<?php echo $this->module->assetsUrl; ?>/css/custom.css"/>

    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=PT+Sans"/>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo $this->module->assetsUrl; ?>/favicon.ico"/>

    <!--[if lte IE 8]>
    <link rel="stylesheet" href="<?php echo $this->module->assetsUrl; ?>/css/ie.css"/>
    <script src="<?php echo $this->module->assetsUrl; ?>/js/ie/html5.js"></script>
    <script src="<?php echo $this->module->assetsUrl; ?>/js/ie/respond.min.js"></script>
    <script src="<?php echo $this->module->assetsUrl; ?>/lib/flot/excanvas.min.js"></script>
    <![endif]-->
    <?php
    Yii::app()->clientScript->scriptMap=array(
        'jquery.js'=>false,
        'jquery.min.js'=>false,
    );
    ?>

</head>
<body>
<div id="maincontainer" class="clearfix">

    <!-- header -->
    <header>
        <?php $this->widget('Nav'); ?>
    </header>

    <!-- main content -->
    <div id="contentwrapper">
        <div class="main_content">

            <?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
                'links'=>$this->breadcrumbs,
            )); ?>

                <?php $this->widget('ExtendedMenu', array(
                    'items' => $this->menu,
                )); ?>

            <?php echo $content; ?>

        </div>
    </div>

    <?php $this->widget('Sidebar'); ?>

    <!-- smart resize event -->
    <script src="<?php echo $this->module->assetsUrl; ?>/js/jquery.debouncedresize.min.js"></script>
    <!-- hidden elements width/height -->
    <script src="<?php echo $this->module->assetsUrl; ?>/js/jquery.actual.min.js"></script>
    <!-- js cookie plugin -->
    <script src="<?php echo $this->module->assetsUrl; ?>/js/jquery.cookie.min.js"></script>
    <script src="<?php echo $this->module->assetsUrl; ?>/js/bootstrap-fileupload.js"></script>
    <!-- main bootstrap js -->

    <!-- tooltips -->
    <script src="<?php echo $this->module->assetsUrl; ?>/lib/qtip2/jquery.qtip.min.js"></script>
    <!-- jBreadcrumbs -->
    <script src="<?php echo $this->module->assetsUrl; ?>/lib/jBreadcrumbs/js/jquery.jBreadCrumb.1.1.min.js"></script>
    <!-- lightbox -->
    <script src="<?php echo $this->module->assetsUrl; ?>/lib/colorbox/jquery.colorbox.min.js"></script>
    <!-- fix for ios orientation change -->
    <script src="<?php echo $this->module->assetsUrl; ?>/js/ios-orientationchange-fix.js"></script>
    <!-- scrollbar -->
    <script src="<?php echo $this->module->assetsUrl; ?>/lib/antiscroll/antiscroll.js"></script>
    <script src="<?php echo $this->module->assetsUrl; ?>/lib/antiscroll/jquery-mousewheel.js"></script>
    <!-- common functions -->
    <script src="<?php echo $this->module->assetsUrl; ?>/js/gebo_common.js"></script>

    <script src="<?php echo $this->module->assetsUrl; ?>/lib/jquery-ui/jquery-ui-1.8.20.custom.min.js"></script>
    <!-- touch events for jquery ui-->
    <script src="<?php echo $this->module->assetsUrl; ?>/js/forms/jquery.ui.touch-punch.min.js"></script>
    <script src="<?php echo $this->module->assetsUrl; ?>/lib/sticky/sticky.min.js"></script>
    <!-- multi-column layout -->
    <script src="<?php echo $this->module->assetsUrl; ?>/js/jquery.imagesloaded.min.js"></script>
    <script src="<?php echo $this->module->assetsUrl; ?>/js/jquery.wookmark.js"></script>
    <!-- responsive table -->
    <script src="<?php echo $this->module->assetsUrl; ?>/js/jquery.mediaTable.min.js"></script>
    <!-- small charts -->
    <script src="<?php echo $this->module->assetsUrl; ?>/js/jquery.peity.min.js"></script>

    <!-- calendar -->
    <script src="<?php echo $this->module->assetsUrl; ?>/lib/fullcalendar/fullcalendar.min.js"></script>
    <!-- sortable/filterable list -->
    <script src="<?php echo $this->module->assetsUrl; ?>/lib/list_js/list.min.js"></script>
    <script src="<?php echo $this->module->assetsUrl; ?>/lib/list_js/plugins/paging/list.paging.min.js"></script>
    <!-- dashboard functions -->
    <script src="<?php echo $this->module->assetsUrl; ?>/js/gebo_dashboard.js"></script>
    <script src="<?php echo $this->module->assetsUrl; ?>/js/jquery.ui.nestedSortable.js"></script>
    <script src="<?php echo $this->module->assetsUrl; ?>/js/custom.js"></script>

    <?php  foreach (Yii::app()->user->getFlashes() as $key => $message) {
                echo DynamicMessages::callMessage($key,$message);
            }
    ?>

</div>
</body>
</html>