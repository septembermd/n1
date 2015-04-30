<!DOCTYPE html>
<html lang="en" class="error_page">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!-- Bootstrap framework -->
    <link rel="stylesheet" href="<?php echo $this->module->assetsUrl; ?>/bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo $this->module->assetsUrl; ?>/bootstrap/css/bootstrap-responsive.min.css"/>
    <!-- main styles -->
    <link rel="stylesheet" href="<?php echo $this->module->assetsUrl; ?>/css/style.css"/>

    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Jockey+One"/>

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>

<?php echo $content; ?>

</body>
</html>

