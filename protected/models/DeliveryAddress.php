<?php

/**
 * This is the model class for table "delivery_address".
 *
 * The followings are the available columns in table 'delivery_address':
 * @property string $id
 * @property string $country_id
 * @property string $address
 *
 * The followings are the available model relations:
 * @property Country $country
 * @property Order[] $orders
 */
class DeliveryAddress extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'delivery_address';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['country_id, address', 'required'],
            ['country_id', 'length', 'max' => 9],
            ['address', 'length', 'max' => 255],
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            ['country_id, address', 'safe', 'on' => 'search'],
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
            'country' => [self::BELONGS_TO, 'Country', 'country_id'],
            'orders' => [self::HAS_MANY, 'Order', 'delivery_id'],
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('main', 'Delivery ID'),
            'country_id' => Yii::t('main', 'Delivery Country'),
            'address' => Yii::t('main', 'Delivery Address'),
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

        $criteria = new CDbCriteria;

        $criteria->compare('country_id', $this->country_id, true);
        $criteria->compare('address', $this->address, true);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return DeliveryAddress the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string
     */
    public function getCountryAndAddress()
    {
        return $this->country->title . ', ' . $this->address;
    }

    /**
     * @return array
     */
    public static function getList()
    {
        return CHtml::listData(self::model()->findAll(), 'id', 'countryAndAddress');
    }
}
