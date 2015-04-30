<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <!-- theme color-->
    <link rel="stylesheet" href="<?php echo $this->module->assetsUrl; ?>/css/blue.css" />
    <!-- tooltip -->
    <link rel="stylesheet" href="<?php echo $this->module->assetsUrl; ?>/lib/qtip2/jquery.qtip.min.css" />
    <!-- main styles -->
    <link rel="stylesheet" href="<?php echo $this->module->assetsUrl; ?>/css/style.css" />

    <!-- Favicons and the like (avoid using transparent .png) -->
    <link rel="shortcut icon" href="<?php echo $this->module->assetsUrl; ?>/favicon.ico" />
    <link rel="apple-touch-icon-precomposed" href="<?php echo $this->module->assetsUrl; ?>/icon.png" />

    <link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>

    <!--[if lte IE 8]>
    <script src="<?php echo $this->module->assetsUrl; ?>/js/ie/html5.js"></script>
    <script src="<?php echo $this->module->assetsUrl; ?>/js/ie/respond.min.js"></script>
    <![endif]-->

    <style>
        input[type=checkbox].rme{
            float:left;
            margin-right: 5px;
        }

    </style>

</head>
<body class="login_page">
<?php echo $content;?>


<script src="<?php echo $this->module->assetsUrl; ?>/js/jquery.min.js"></script>
<script src="<?php echo $this->module->assetsUrl; ?>/js/jquery.actual.min.js"></script>
<script src="<?php echo $this->module->assetsUrl; ?>/lib/validation/jquery.validate.min.js"></script>
<script src="<?php echo $this->module->assetsUrl; ?>/bootstrap/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function(){
        //* boxes animation
        form_wrapper = $('.login_box');
        function boxHeight() {
            form_wrapper.animate({ marginTop : ( - ( form_wrapper.height() / 2) - 24) },400);
        };
        form_wrapper.css({ marginTop : ( - ( form_wrapper.height() / 2) - 24) });
    });
</script>


</body>
</html>
