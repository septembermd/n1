<?php

/**
 * This is the model class for table "order_bids".
 *
 * The followings are the available columns in table 'order_bids':
 * @property string $id
 * @property string $user_id
 * @property string $order_id
 * @property string $cost
 * @property string $created
 * @property string $is_winner
 * @property string $is_deleted
 *
 * The followings are the available model relations:
 * @property User $user
 * @property Order $order
 */
class OrderBids extends CActiveRecord
{
    const STATE_ACTIVE = 0;
    const STATE_DELETED = 1;

    const IS_WINNER = 1;
    const IS_COMPETITOR = 0;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'order_bids';
	}

    /**
     * Model behaviors
     *
     * @return array
     */
    public function behaviors(){
        return [
            'ESaveRelatedBehavior' => [
                'class' => 'application.components.ESaveRelatedBehavior'
            ]
        ];
    }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return [
			['user_id, order_id, cost', 'required'],
			['user_id, order_id', 'length', 'max'=>9],
			['cost', 'length', 'max'=>7],
			['is_winner, is_deleted', 'length', 'max'=>1],
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			['id, user_id, order_id, cost, created, is_winner, is_deleted', 'safe', 'on'=>'search'],
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
			'user' => [self::BELONGS_TO, 'User', 'user_id'],
			'order' => [self::BELONGS_TO, 'Order', 'order_id'],
        ];
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'user_id' => 'User',
			'order_id' => 'Order',
			'cost' => 'Cost',
			'created' => 'Created',
			'is_winner' => 'Is Winner',
			'is_deleted' => 'Is Deleted',
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
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('order_id',$this->order_id,true);
		$criteria->compare('cost',$this->cost,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('is_winner',$this->is_winner,true);
		$criteria->compare('is_deleted',$this->is_deleted,true);

		return new CActiveDataProvider($this, [
			'criteria'=>$criteria,
        ]);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OrderBids the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * @param $orderId
     * @return CActiveDataProvider
     */
    public function getCActiveDataProviderByOrderId($orderId)
    {
        $criteria = new CDbCriteria();
        $criteria->compare('order_id', $orderId);
        $dataProvider =  new CActiveDataProvider(__CLASS__, ['criteria' => $criteria]);

        return $dataProvider;
    }

    /**
     * Check if order is withdrawn
     *
     * @return bool
     */
    public function isWithdrawn()
    {
        return $this->is_deleted == self::STATE_DELETED;
    }

    /**
     * Get criteria for best offer query
     *
     * @param Order $order
     * @return CDbCriteria
     */
    public function getBestOfferCriteriaByOrder(Order $order) {
        $criteria = new CDbCriteria();
        $criteria->compare('order_id', $order->id);
        $criteria->compare('is_deleted', self::STATE_ACTIVE);
        $criteria->order = "cost ASC";

        return $criteria;
    }

    /**
     * Get best offer by Order
     *
     * @param Order $order
     * @return OrderBids
     */
    public function findBestOfferByOrder(Order $order)
    {
        $criteria = $this->getBestOfferCriteriaByOrder($order);

        return self::model()->find($criteria);
    }

    /**
     * Get best offers count by Order
     *
     * @param Order $order
     * @return static
     */
    public function getAllBestOfferCountByOrder(Order $order)
    {
        $criteria = $this->getBestOfferCriteriaByOrder($order);
        $criteria->select = 'COUNT(id) as count';

        return self::model()->find($criteria);
    }
}
