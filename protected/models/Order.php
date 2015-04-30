<?php

/**
 * This is the model class for table "order".
 *
 * The followings are the available columns in table 'order':
 * @property string $id
 * @property string $creator_id
 * @property string $item_id
 * @property integer $currency_id
 * @property integer $status_id
 * @property integer $temperature_id
 * @property string $supplier_id
 * @property string $loading_id
 * @property string $delivery_id
 * @property string $created
 * @property string $due_date
 * @property integer $remark_id
 * @property string $is_deleted
 *
 * The followings are the available model relations:
 * @property Currency $currency
 * @property OrderStatus $status
 * @property Temperature $temperature
 * @property Supplier $supplier
 * @property Remark $remark
 * @property SupplierAddresses $loading
 * @property DeliveryAddress $delivery
 * @property OrderItems $item
 * @property OrderBids[] $orderBids
 */
class Order extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Order the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'order';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('creator_id, item_id, currency_id, status_id, temperature_id, supplier_id, loading_id, delivery_id, created, due_date, remark_id', 'required'),
			array('currency_id, status_id, temperature_id, remark_id', 'numerical', 'integerOnly'=>true),
			array('creator_id, item_id, supplier_id, loading_id, delivery_id', 'length', 'max'=>9),
			array('is_deleted', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, creator_id, item_id, currency_id, status_id, temperature_id, supplier_id, loading_id, delivery_id, created, due_date, remark_id, is_deleted', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'currency' => array(self::BELONGS_TO, 'Currency', 'currency_id'),
			'status' => array(self::BELONGS_TO, 'OrderStatus', 'status_id'),
			'temperature' => array(self::BELONGS_TO, 'Temperature', 'temperature_id'),
			'supplier' => array(self::BELONGS_TO, 'Supplier', 'supplier_id'),
			'remark' => array(self::BELONGS_TO, 'Remark', 'remark_id'),
			'loading' => array(self::BELONGS_TO, 'SupplierAddresses', 'loading_id'),
			'delivery' => array(self::BELONGS_TO, 'DeliveryAddress', 'delivery_id'),
			'item' => array(self::BELONGS_TO, 'OrderItems', 'item_id'),
			'orderBids' => array(self::HAS_MANY, 'OrderBids', 'order_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'creator_id' => 'Creator',
			'item_id' => 'Item',
			'currency_id' => 'Currency',
			'status_id' => 'Status',
			'temperature_id' => 'Temperature',
			'supplier_id' => 'Supplier',
			'loading_id' => 'Loading',
			'delivery_id' => 'Delivery',
			'created' => 'Created',
			'due_date' => 'Due Date',
			'remark_id' => 'Remark',
			'is_deleted' => 'Is Deleted',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('creator_id',$this->creator_id,true);
		$criteria->compare('item_id',$this->item_id,true);
		$criteria->compare('currency_id',$this->currency_id);
		$criteria->compare('status_id',$this->status_id);
		$criteria->compare('temperature_id',$this->temperature_id);
		$criteria->compare('supplier_id',$this->supplier_id,true);
		$criteria->compare('loading_id',$this->loading_id,true);
		$criteria->compare('delivery_id',$this->delivery_id,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('due_date',$this->due_date,true);
		$criteria->compare('remark_id',$this->remark_id);
		$criteria->compare('is_deleted',$this->is_deleted,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}