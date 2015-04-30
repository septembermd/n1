<?php
/**
 * Created by Idol IT.
 * Date: 10/16/12
 * Time: 5:13 PM
 */

class DbCriteria extends CDbCriteria
{

    public function age_compare($column, $value, $partialMatch = false, $operator = 'AND', $escape = true)
    {
        if (is_array($value)) {
            if ($value === array())
                return $this;
            return $this->addInCondition($column, $value, $operator);
        } else
            $value = "$value";

        if (preg_match('/^(?:\s*(<>|<=|>=|<|>|=))?(.*)$/', $value, $matches)) {
            $value = $matches[2];
            $op = $matches[1];
        } else
            $op = '';

        if ($value === '')
            return $this;

        if ($partialMatch) {
            if ($op === '')
                return $this->addSearchCondition($column, $value, $escape, $operator);
            if ($op === '<>')
                return $this->addSearchCondition($column, $value, $escape, $operator, 'NOT LIKE');
        } else if ($op === '')
            $op = '=';

        $date = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d"), date("Y") - $value));
        $date_2 = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d"), date("Y") - $value - 1));

        if ($op == ">") {
            $op = "<";
        } else if ($op == "<") {
            $op = ">";
        } else if ($op == "<=") {
            $op = ">=";
        } else if ($op == ">=") {
            $op = "<=";
        }

        if ($op == "=")
            $this->addCondition("birthday BETWEEN '$date_2' AND '$date'", $operator);
        elseif ($op == ">=" || $op == "<")
            $this->addCondition("birthday $op '$date_2'", $operator);
        elseif ($op == ">" || $op == "<=")
            $this->addCondition("birthday $op '$date'", $operator);
        else
            $this->addCondition("birthday NOT BETWEEN '$date_2' AND '$date'", $operator);
        //$this->params[self::PARAM_PREFIX . self::$paramCount++] = $value;

        return $this;
    }

    public function category_compare($column, $value, $partialMatch=false, $operator='AND', $escape=true)
    {
        if(is_array($value))
        {
            if($value===array())
                return $this;
            return $this->addInCondition($column,$value,$operator);
        }
        else
            $value="$value";

        if(preg_match('/^(?:\s*(<>|<=|>=|<|>|=))?(.*)$/',$value,$matches))
        {
            $value=$matches[2];
            $op=$matches[1];
        }
        else
            $op='';

        if($value==='')
            return $this;

        if($partialMatch)
        {
            if($op==='')
                return $this->addSearchCondition($column,$value,$escape,$operator);
            if($op==='<>')
                return $this->addSearchCondition($column,$value,$escape,$operator,'NOT LIKE');
        }
        else if($op==='')
            $op='=';

        if($category = Category::model()->findByPk($value)){
            $categories = $category->descendants()->findAll();
            if (count($categories) > 0) {
                $ids = array_values(CHtml::listData($categories, "id", "id"));
                array_push($ids,$category->id);
                $this->addInCondition($column, $ids);
            }else{
                $this->addCondition($column.$op.self::PARAM_PREFIX.self::$paramCount,$operator);
                $this->params[self::PARAM_PREFIX.self::$paramCount++]=$value;
            }
        }



        return $this;
    }


}