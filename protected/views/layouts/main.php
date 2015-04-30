<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Terra Cleaning</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="title" content="" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/jq.js"></script>
    <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/style.css" type="text/css" media="screen" />
    <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/actions.js"></script>
    <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
</head>
<body>

<!-- Header -->
<div id="header">
    <div id="header_text"><div id="home"></div>

        <div id="lang" style="margin-left: 150px;">
            <?php $this->widget("MultiLang"); ?>
        </div></div><br />

        <?php $this->widget("Logo"); ?>

</div><!-- header -->

<!-- MiniMenu -->
<div id="minimenu">
    <ul id="mini">
        <?php
        if (isset($this->pageCur))
        {
            $pageCur =  $this->pageCur;
            $$pageCur = 'active';
        }
        ?> <!--echo "<div id='minimenu_item'>" ;  echo '<li id="menu_1">'-->
        <? echo (isset($home)) ?  "<div id='minimenu_item'>" : "<a href=\"".Yii::app()->homeUrl."site/submenu\"><li id='menu_1'>" ?>
            <? echo Yii::t('base','КОМПАНИЯ') ?>
            <div><?php echo Yii::t("base","о компании");?></div>
        <? echo (isset($home)) ? '</div>' : '</li></a>' ?>

        <? echo (isset($service)) ?  "<div id='minimenu_item'>" : "<a href=\"".Yii::app()->homeUrl."site/service\"><li id='menu_2'>" ?>
            <? echo Yii::t('base','УСЛУГИ') ?>
            <div><?php echo Yii::t("base",'предоставляемые<br>услуги');?></div>
        <? echo (isset($service)) ? '</div>' : '</li></a>' ?>

        <? echo (isset($quality)) ?  "<div id='minimenu_item'>" : "<a href=\"".Yii::app()->homeUrl."site/quality\"><li id='menu_3'>" ?>
            <? echo Yii::t('base','КАЧЕСТВО') ?>
            <div><?php echo Yii::t("base",'гарантированное<br>качество');?></div>
        <? echo (isset($quality)) ? '</div>' : '</li></a>' ?>

        <? echo (isset($news)) ?  "<div id='minimenu_item'>" : "<a href=\"".Yii::app()->homeUrl."site/news\"><li id='menu_4'>" ?>
            <? echo Yii::t('base','НОВОСТИ') ?>
            <div><?php echo Yii::t("base","новости компании");?></div>
        <? echo (isset($news)) ? '</div>' : '</li></a>' ?>

        <? echo (isset($clients)) ?  "<div id='minimenu_item'>" : "<a href=\"".Yii::app()->homeUrl."site/clients\"><li id='menu_5'>" ?>
            <? echo Yii::t('base','КЛИЕНТЫ') ?>
            <div><?php echo Yii::t("base","наши клиенты");?></div>
        <? echo (isset($clients)) ? '</div>' : '</li></a>' ?>

        <? echo (isset($cont)) ?  "<div id='minimenu_item'>" : "<a href=\"".Yii::app()->homeUrl."site/contact\"><li id='menu_6'>" ?>
             <? echo Yii::t('base','КОНТАКТЫ') ?>
            <div><?php echo Yii::t("base","контактные данные");?></div>
        <? echo (isset($cont)) ? '</div>' : '</li></a>' ?>
    </ul>
</div><!-- minimenu -->

<div id="content">
        <?php echo $content;?>
</div>

<?php $this->widget("Services"); ?>

<div id="footer">
    <div id="copyright">
        <?php echo yiisetting('copyright') ?>
    </div>

    <div id="partner">
        <?php $this->widget('LangSwitch', array('setting' => 'partner')) ?>
    </div>

    <div id="logo">
        <img src="/<?php echo yiisetting('partner_logo') ?>" alt='karcher logo' />
    </div>
</div><!-- footer -->
</body>
</html>