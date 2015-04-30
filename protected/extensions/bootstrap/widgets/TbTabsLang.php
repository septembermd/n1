<?php
/**
 * TbTabs class file.
 * @author Christoffer Niska <ChristofferNiska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2011-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package bootstrap.widgets
 */

/*
 * Example
 <?php $this->widget('bootstrap.widgets.TbTabsLang', array(
            'type'=>'pills',
            'htmlOptions'=>array('style'=>'font-size: 11px;'),
            'tabs'=>array(
                array('label'=>'RU', 'content'=>$form->textFieldRow($model,'agent_name_ru',array('class'=>'span5','maxlength'=>255)), 'active'=>($model->hasErrors('agent_name_ru'))),
                array('label'=>'RO', 'content'=>$form->textFieldRow($model,'agent_name_ro',array('class'=>'span5','maxlength'=>255)), 'active'=>($model->hasErrors('agent_name_ro'))),
            ),
    ));?>
*/
Yii::import('bootstrap.widgets.TbTabs');
Yii::import('bootstrap.widgets.TbMenu');

/**
 * Bootstrap Javascript tabs widget.
 * @see http://twitter.github.com/bootstrap/javascript.html#tabs
 */
class TbTabsLang extends TbTabs
{
	/**
	 * Initializes the widget.
	 */
	public function init()
	{
        $this->checkTabs();

		if (!isset($this->htmlOptions['id']))
			$this->htmlOptions['id'] = $this->getId();

		$classes = array();

		$validPlacements = array(self::PLACEMENT_ABOVE, self::PLACEMENT_BELOW, self::PLACEMENT_LEFT, self::PLACEMENT_RIGHT);

		if (isset($this->placement) && in_array($this->placement, $validPlacements))
			$classes[] = 'tabs-'.$this->placement;

		if (!empty($classes))
		{
			$classes = implode(' ', $classes);
			if (isset($this->htmlOptions['class']))
				$this->htmlOptions['class'] .= ' '.$classes;
			else
				$this->htmlOptions['class'] = $classes;
		}
	}

	/**
	 * Run this widget.
	 */
	public function run()
	{
		$id = $this->id;
		$content = array();
		$items = $this->normalizeTabs($this->tabs, $content);

		ob_start();
		$this->controller->widget('bootstrap.widgets.TbMenu', array(
			'type'=>$this->type,
			'encodeLabel'=>$this->encodeLabel,
            'htmlOptions'=>array('style'=>'margin-bottom: 5px; margin-left: 160px;'),
			'items'=>$items,
		));
		$tabs = ob_get_clean();

		ob_start();
		echo '<div class="tab-content">';
		echo implode('', $content);
		echo '</div>';
		$content = ob_get_clean();

		echo CHtml::openTag('div', $this->htmlOptions);
		echo $this->placement === self::PLACEMENT_BELOW ? $content.$tabs : $tabs.$content;
		echo '</div>';

		/** @var CClientScript $cs */
		$cs = Yii::app()->getClientScript();
		$cs->registerScript(__CLASS__.'#'.$id, "jQuery('#{$id}').tab();");

		foreach ($this->events as $name => $handler)
		{
			$handler = CJavaScript::encode($handler);
			$cs->registerScript(__CLASS__.'#'.$id.'_'.$name, "jQuery('#{$id}').on('{$name}', {$handler});");
		}
	}

    public function checkTabs()
    {
        $isActive = false;
        if(count($this->tabs))
        {
            foreach($this->tabs as $key=>$item)
            {
                if(isset($item['active']) && $item['active'])
                {
                    if($isActive)
                        $this->tabs[$key]['active'] = false;
                    else
                        $isActive = true;
                }
            }

            if(!$isActive)
                $this->tabs[0]['active'] = true;
        }
    }
}
