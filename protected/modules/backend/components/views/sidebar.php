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
                        <div class="accordion-group">
                            <div class="accordion-heading">
                                <a href="#collapseOne" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
                                    <i class="icon-font"></i> Контент
                                </a>
                            </div>
                            <div class="accordion-body collapse<?php if($c=="content") echo " in"; ?>" id="collapseOne">
                                <div class="accordion-inner">
                                    <ul class="nav nav-list">
                                        <li><a href="<?php echo Yii::app()->createUrl("backend/servicepanel/admin");?>"></a></li>
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
