<?php /*echo CHtml::link('ru','', array('style' => 'font-size:16px; margin-right:5px; color: #FFF; cursor:pointer;')) */?><!--
<?php /*echo CHtml::link('ro','', array('style' => 'font-size:16px; margin-right:5px; color: #FFF; cursor:pointer;')) */?>
--><?php /*echo CHtml::link('en','', array('style' => 'font-size:16px; margin-right:5px; color: #FFF; cursor:pointer;')) */?>

<a href="<?php echo Yii::app()->createUrl('site/change', ['lang' => 'ro']); ?>" <?php echo Yii::app()->language == 'ro' ? ' class="active"' : ''; ?>>Romana</a> |
<a href="<?php echo Yii::app()->createUrl('site/change', ['lang' => 'ru']); ?>" <?php echo Yii::app()->language == 'ru' ? ' class="active"' : ''; ?>>Русский</a> |
<a href="<?php echo Yii::app()->createUrl('site/change', ['lang' => 'en']); ?>" <?php echo Yii::app()->language == 'en' ? ' class="active"' : ''; ?>>English</a>