<?php

class SearchController extends Frontend
{
	public function actionIndex($style=null,$order=null,$manufacturer=null,$attribute=null)
	{
		if ( isset($_GET['q']) ) {
			$with = array();
			$category = array();
			$criteria = new CDbCriteria();
			$criteria->condition = "name like :search or description like :search";
			$criteria->params = array(':search'=> "%{$_GET['q']}%");

			if ( isset($_GET['category']) && $_GET['category'] > 0 ) {
				$category = Category::model()->findByPk($_GET['category']);
				$criteria->addCondition("category_id = {$category->id}");
			}

			$template = "type/_grid";
	        if ( $style == "list" ) {
	            $template ='type/_' . $style;
	        }

	        switch ($order) {
	            case "price":
	                $criteria->order = "price";
	                break;
	            case "created":
	                $criteria->order = "created DESC";
	                break;
	            default:
	                $criteria->order = "name";
	                break;
	        }

	        if ($manufacturer)
            	$criteria->addInCondition("manufacturer_id", explode(',',trim($manufacturer)));

            if ($attribute) {
	            $crtr = new CDbCriteria;
	            $crtr->addInCondition("id", explode(',',trim($attribute)));
	            $opt = EntityAttributeOption::model()->findAll($crtr);
	            $attrs = CHtml::listData($opt, 'id', 'option');
	            $criteria->addInCondition("entityAttributeOptions.option", $attrs);
	            $with = array('entityAttributeOptions'=>array('together'=>true));
	        }

	        $products = new Product();

	        $total = $products->with($with)->count($criteria);
	        $pages = new Pagination($total);
	        $pages->pageSize = 4;
	        $pages->applyLimit($criteria);
	        $list = $products->with($with)->findAll($criteria);

	        if ( Yii::app()->request->isAjaxRequest ) {
	        	$this->widget("ProductList",array('pages'=>$pages,'products'=>$list,'template'=>$template));
	            Yii::app()->end();
	        }

	        $this->render('index',array('models'=>$list,'pages'=>$pages,'q'=>$_GET['q'],'template'=>$template,'category'=>$category));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
}