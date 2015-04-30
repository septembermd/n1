<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="brand" href="<?php echo Yii::app()->createUrl("backend"); ?>"><i class="icon-home icon-white"></i> <?php echo Yii::app()->name; ?></a>
            <ul class="nav user_menu pull-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo Yii::app()->user->name; ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo Yii::app()->createUrl("backend/user/view",array('id'=>Yii::app()->user->id)); ?>">My Profile</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo Yii::app()->createUrl("backend/default/logout"); ?>">Log Out</a></li>
                    </ul>
                </li>
            </ul>
            <a data-target=".nav-collapse" data-toggle="collapse" class="btn_menu">
                <span class="icon-align-justify icon-white"></span>
            </a>
            <?php $this->widget('MainMenu'); ?>
        </div>
    </div>
</div>