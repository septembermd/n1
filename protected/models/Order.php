<?php

/**
 * This is the model class for table "order".
 *
 * The followings are the available columns in table 'order':
 * @property string $id
 * @property string $creator_id
 * @property integer $currency_id
 * @property string $status_id
 * @property string $supplier_id
 * @property string $loading_id
 * @property string $delivery_id
 * @property integer $temperature_id
 * @property integer $remark_id
 * @property string $valid_date
 * @property string $load_date
 * @property string $deliver_date
 * @property string $loaded_on_date
 * @property string $delivered_on_date
 * @property string $deleted_on_date
 * @property string $is_deleted
 * @property string $created
 *
 * The followings are the available model relations:
 * @property Supplier $supplier
 * @property Remark $remark
 * @property SupplierAddresses $loading
 * @property DeliveryAddress $delivery
 * @property Temperature $temperature
 * @property Currency $currency
 * @property OrderBids[] $orderBids
 * @property OrderItems[] $orderItems
 */
class Order extends CActiveRecord
{
    const STATUS_HAULER_NEEDED = 1;
    const STATUS_IN_TRANSIT = 2;
    const STATUS_DELIVERED = 3;
    const STATUS_WITHDRAWN = 4;

    public static $statusMap = array(
        self::STATUS_HAULER_NEEDED => "Hauler needed",
        self::STATUS_IN_TRANSIT => "In transit",
        self::STATUS_DELIVERED => "Delivered",
        self::STATUS_WITHDRAWN => "Withdrawn"
    );

    public static function getStatusLabel($status) {
        if(isset(self::$statusMap[$status])) {
            return self::$statusMap[$status];
        }

        return false;
    }

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'order';
	}

    /**
     * Model behaviors
     * @return array
     */
    public function behaviors(){
        return array(
            'ESaveRelatedBehavior' => array(
                'class' => 'application.components.ESaveRelatedBehavior'
            )
        );
    }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('creator_id, currency_id, loading_id, delivery_id, temperature_id, valid_date, load_date, deliver_date', 'required'),
			array('currency_id, temperature_id, remark_id', 'numerical', 'integerOnly'=>true),
			array('creator_id, supplier_id, loading_id, delivery_id', 'length', 'max'=>9),
			array('status_id, is_deleted', 'length', 'max'=>1),
			array('created, remark_id, supplier_id, loaded_on_date, delivered_on_date, deleted_on_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, creator_id, currency_id, status_id, supplier_id, loading_id, delivery_id, temperature_id, remark_id, valid_date, load_date, deliver_date, loaded_on_date, delivered_on_date, deleted_on_date, is_deleted, created', 'safe', 'on'=>'search'),
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
			'creator' => array(self::BELONGS_TO, 'User', 'creator_id'),
			'supplier' => array(self::BELONGS_TO, 'Supplier', 'supplier_id'),
			'remark' => array(self::BELONGS_TO, 'Remark', 'remark_id'),
			'loading' => array(self::BELONGS_TO, 'SupplierAddresses', 'loading_id'),
			'delivery' => array(self::BELONGS_TO, 'DeliveryAddress', 'delivery_id'),
			'temperature' => array(self::BELONGS_TO, 'Temperature', 'temperature_id'),
			'currency' => array(self::BELONGS_TO, 'Currency', 'currency_id'),
			'orderBids' => array(self::HAS_MANY, 'OrderBids', 'order_id'),
			'orderItems' => array(self::HAS_MANY, 'OrderItems', 'order_id'),
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
			'currency_id' => 'Currency',
			'status_id' => 'Status',
			'supplier_id' => 'Supplier',
			'loading_id' => 'Loading',
			'delivery_id' => 'Delivery',
			'temperature_id' => 'Temperature',
			'remark_id' => 'Remark',
			'valid_date' => 'Valid Date',
			'load_date' => 'Load Date',
			'deliver_date' => 'Deliver Date',
			'loaded_on_date' => 'Loaded On Date',
			'delivered_on_date' => 'Delivered On Date',
			'deleted_on_date' => 'Deleted On Date',
			'is_deleted' => 'Is Deleted',
			'created' => 'Created',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('creator_id',$this->creator_id,true);
		$criteria->compare('currency_id',$this->currency_id);
		$criteria->compare('status_id',$this->status_id,true);
		$criteria->compare('supplier_id',$this->supplier_id,true);
		$criteria->compare('loading_id',$this->loading_id,true);
		$criteria->compare('delivery_id',$this->delivery_id,true);
		$criteria->compare('temperature_id',$this->temperature_id);
		$criteria->compare('remark_id',$this->remark_id);
		$criteria->compare('valid_date',$this->valid_date,true);
		$criteria->compare('load_date',$this->load_date,true);
		$criteria->compare('deliver_date',$this->deliver_date,true);
		$criteria->compare('loaded_on_date',$this->loaded_on_date,true);
		$criteria->compare('delivered_on_date',$this->delivered_on_date,true);
		$criteria->compare('deleted_on_date',$this->deleted_on_date,true);
		$criteria->compare('is_deleted',$this->is_deleted,true);
		$criteria->compare('created',$this->created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Order the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getBidsCount()
    {
        return count($this->orderBids);
    }
}
