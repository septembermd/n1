<?php
/**
 * .
 * Date: 10/8/12
 * Time: 11:55 AM
 */

Yii::import('zii.widgets.CMenu');

class ExtendedMenu extends CMenu{

    protected function renderMenu($items)
    {
        if(count($items))
        {
            echo CHtml::openTag('div',array('class'=>'btn-toolbar pull-right'));
            echo CHtml::openTag('div',array('class'=>'btn-group'));
            $this->renderMenuRecursive($items);
            echo CHtml::closeTag('div');
            echo CHtml::closeTag('div');
        }
    }

    protected function renderMenuRecursive($items)
    {
        $count=0;
        $n=count($items);
        foreach($items as $item)
        {
            $count++;
            $options=isset($item['itemOptions']) ? $item['itemOptions'] : array();
            $class=array();
            if($item['active'] && $this->activeCssClass!='')
                $class[]=$this->activeCssClass;
            if($count===1 && $this->firstItemCssClass!==null)
                $class[]=$this->firstItemCssClass;
            if($count===$n && $this->lastItemCssClass!==null)
                $class[]=$this->lastItemCssClass;
            if($this->itemCssClass!==null)
                $class[]=$this->itemCssClass;
            if($class!==array())
            {
                if(empty($options['class']))
                    $options['class']=implode(' ',$class);
                else
                    $options['class'].=' '.implode(' ',$class);
            }


            $menu=$this->renderMenuItem($item);
            if(isset($this->itemTemplate) || isset($item['template']))
            {
                $template=isset($item['template']) ? $item['template'] : $this->itemTemplate;
                echo strtr($template,array('{menu}'=>$menu));
            }
            else
                echo $menu;

            if(isset($item['items']) && count($item['items']))
            {
                $this->renderMenuRecursive($item['items']);
            }

        }
    }

    protected function renderMenuItem($item)
    {
        if (isset($item['url'])) {
            if(isset($item['linkOptions']['class']))
                $item['linkOptions']['class'] .= ' btn btn-small';
            else
                $item['linkOptions']['class'] = 'btn btn-small';
            $label = $this->linkLabelWrapper === null ? $item['label'] : '<' . $this->linkLabelWrapper . '>' . $item['label'] . '</' . $this->linkLabelWrapper . '>';
            return CHtml::link($label, $item['url'], isset($item['linkOptions']) ? $item['linkOptions'] : array());
        } else
            return CHtml::tag('span', isset($item['linkOptions']) ? $item['linkOptions'] : array(), $item['label']);
    }

}