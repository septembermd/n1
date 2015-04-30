<?php
/**
 * @var $c string
 */
?>

<!-- sidebar -->
<a href="javascript:void(0)" class="sidebar_switch on_switch ttip_r" title="Hide Sidebar">Sidebar switch</a>
<div class="sidebar">
    <div class="antiScroll">
        <div class="antiscroll-inner">
            <div class="antiscroll-content">

                <div class="sidebar_inner">
                    <br><br>
                    <div id="side_accordion" class="accordion">

<!--                        <div class="accordion-group">
                            <div class="accordion-heading">
                                <a href="#collapseSix" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
                                    <i class="icon-shopping-cart"></i> Магазин
                                </a>
                            </div>
                            <div class="accordion-body collapse<?php /*if($c=="store") echo " in"; */?>" id="collapseSix">
                                <div class="accordion-inner">
                                    <ul class="nav nav-list">
                                        <li><a href="<?php /*echo Yii::app()->createUrl("backend/Order/admin");*/?>">Управление заказами</a></li>
                                        <li><a href="<?php /*echo Yii::app()->createUrl("backend/product/admin");*/?>">Управление товарами</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>-->

                        <div class="accordion-group">
                            <div class="accordion-heading">
                                <a href="#collapseOne" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
                                    <i class="icon-font"></i> Контент
                                </a>
                            </div>
                            <div class="accordion-body collapse<?php if($c=="content") echo " in"; ?>" id="collapseOne">
                                <div class="accordion-inner">
                                    <ul class="nav nav-list">
                                        <li><a href="<?php echo Yii::app()->createUrl("backend/company/admin");?>">О компании</a></li>
                                        <li><a href="<?php echo Yii::app()->createUrl("backend/service/admin");?>">Услуги</a></li>
                                        <li><a href="<?php echo Yii::app()->createUrl("backend/qualily/admin");?>">Качество</a></li>
                                        <li><a href="<?php echo Yii::app()->createUrl("backend/benefits/admin");?>">Выгоды</a></li>
                                        <li><a href="<?php echo Yii::app()->createUrl("backend/news/admin");?>">Новости</a></li>
                                        <li><a href="<?php echo Yii::app()->createUrl("backend/partners/admin");?>">Партнеры</a></li>
                                        <li><a href="<?php echo Yii::app()->createUrl("backend/contacts/admin");?>">Контакты</a></li>
                                        <li><a href="<?php echo Yii::app()->createUrl("backend/contactpeople/admin");?>">Контактные данные</a></li>
                                        <li><a href="<?php echo Yii::app()->createUrl("backend/reviews/admin");?>">Отзывы</a></li>
                                        <li><a href="<?php echo Yii::app()->createUrl("backend/servicepanel/admin");?>">Сервис панель</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-group">
                            <div class="accordion-heading">
                                <a href="#collapseFour" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
                                    <i class="icon-user"></i> Управление аккаунтами
                                </a>
                            </div>
                            <div class="accordion-body collapse<?php if($c=="account_manager") echo " in"; ?>" id="collapseFour">
                                <div class="accordion-inner">
                                    <ul class="nav nav-list">
                                        <li><a href="<?php echo Yii::app()->createUrl("backend/user/admin"); ?>">Пользователи</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-group">
                            <div class="accordion-heading">
                                <a href="#collapseFive" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
                                    <i class="icon-cog"></i> Конфигурация
                                </a>
                            </div>
                            <div class="accordion-body collapse<?php if($c=="configuration") echo " in"; ?>" id="collapseFive">
                                <div class="accordion-inner">
                                    <ul class="nav nav-list">
                                        <li><a href="<?php echo Yii::app()->createUrl("backend/settings/admin"); ?>">Настройки</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="push"></div>
                </div>

            </div>
        </div>
    </div>

</div>
