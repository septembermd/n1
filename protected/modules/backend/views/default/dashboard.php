<?php $this->pageTitle=Yii::app()->name . ' - Dashboard'; ?>

<div class="row-fluid">
    <div class="span12">
        <ul class="dshb_icoNav tac">
            <li><a href="<?php echo Yii::app()->createUrl("backend/Order/admin"); ?>" style="background-image: url(<?php echo $this->module->assetsUrl; ?>/img/gCons/bar-chart.png)">Orders</a></li>
            <li><a href="<?php echo Yii::app()->createUrl("backend/pages/admin"); ?>" style="background-image: url(<?php echo $this->module->assetsUrl; ?>/img/gCons/copy-item.png)">Pages</a></li>
            <li><a href="<?php echo Yii::app()->createUrl("backend/user/admin"); ?>" style="background-image: url(<?php echo $this->module->assetsUrl; ?>/img/gCons/agent.png)">Accoutns</a></li>
            <li><a href="<?php echo Yii::app()->createUrl("backend/settings/admin"); ?>" style="background-image: url(<?php echo $this->module->assetsUrl; ?>/img/gCons/processing-02.png)">Settings</a></li>
<!--            <li><a href="<?php /*echo Yii::app()->createUrl("backend/review/admin"); */?>" style="background-image: url(<?php /*echo $this->module->assetsUrl; */?>/img/gCons/happy-face.png)">Reviews</a></li>
            <li><a href="<?php /*echo Yii::app()->createUrl("backend/reason/admin"); */?>" style="background-image: url(<?php /*echo $this->module->assetsUrl; */?>/img/gCons/scale.png)">Reasons</a></li>
            <li><a href="<?php /*echo Yii::app()->createUrl("backend/faq/admin"); */?>" style="background-image: url(<?php /*echo $this->module->assetsUrl; */?>/img/gCons/bookmark.png)">Faq</a></li>
            <li><a href="<?php /*echo Yii::app()->createUrl("backend/contact/admin"); */?>" style="background-image: url(<?php /*echo $this->module->assetsUrl; */?>/img/gCons/chat-.png)">Feedback</a></li>-->
        </ul>
    </div>
</div>

<div class="row-fluid">
    <?php $this->widget('LastUsers'); ?>
</div>