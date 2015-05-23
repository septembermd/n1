<?php

/**
 * This is the model class for table "supplier_addresses".
 *
 * The followings are the available columns in table 'supplier_addresses':
 * @property string $id
 * @property string $supplier_id
 * @property string $country_id
 * @property string $address
 *
 * The followings are the available model relations:
 * @property Order[] $orders
 * @property Supplier $supplier
 * @property Country $country
 */
class SupplierAddresses extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'supplier_addresses';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return [
			['supplier_id, country_id, address', 'required'],
			['supplier_id, country_id', 'length', 'max'=>9],
			['address', 'length', 'max'=>255],
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			['id, supplier_id, country_id, address', 'safe', 'on'=>'search'],
        ];
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return [
			'orders' => [self::HAS_MANY, 'Order', 'loading_id'],
			'supplier' => [self::BELONGS_TO, 'Supplier', 'supplier_id'],
			'country' => [self::BELONGS_TO, 'Country', 'country_id'],
        ];
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return [
			'id' => Yii::t('main', 'Supplier ID'),
			'supplier_id' => Yii::t('main', 'Supplier'),
			'country_id' => Yii::t('main', 'Supplier Country'),
			'address' => Yii::t('main', 'Supplier Address'),
        ];
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
		$criteria->compare('supplier_id',$this->supplier_id,true);
		$criteria->compare('country_id',$this->country_id,true);
		$criteria->compare('address',$this->address,true);

		return new CActiveDataProvider($this, [
			'criteria'=>$criteria,
        ]);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SupplierAddresses the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * @return string
     */
    public function getCountryAndAddress(){
        return $this->country->title.', '.$this->address;
    }

    /**
     * Get list of supplier addresses for a supplier by id
     *
     * @param $supplierId
     * @return array
     */
    public static function getListBySupplierId($supplierId)
    {
        return CHtml::listData(self::model()->findAll('supplier_id='.$supplierId), 'id', 'countryAndAddress');
    }
}
