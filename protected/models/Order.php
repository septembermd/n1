<?php

/**
 * This is the model class for table "order".
 *
 * The followings are the available columns in table 'order':
 * @property string $id
 * @property string $creator_id
 * @property string $carrier_id
 * @property string $status_id
 * @property integer $currency_id
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
 * @property string $status_updated_date
 *
 * The followings are the available model relations:
 * @property User $creator
 * @property User $carrier
 * @property Supplier $supplier
 * @property Remark $remark
 * @property SupplierAddresses $loading
 * @property DeliveryAddress $delivery
 * @property Temperature $temperature
 * @property Currency $currency
 * @property OrderBids[] $orderBids
 * @property OrderBids[] $orderBidsCount
 * @property OrderItems[] $orderItems
 * @property orderUserView[] $orderUserViews
 */
class Order extends CActiveRecord
{
    const STATUS_HAULER_NEEDED = 1;
    const STATUS_IN_TRANSIT = 2;
    const STATUS_DELIVERED = 3;
    const STATUS_WITHDRAWN = 4;
    const STATUS_DRAFT = 5;

    const IS_ACTIVE = 0;
    const IS_DELETED = 1;

    const REMARK_SUCCESS = 1;
    const REMARK_DELIVERY_DELAYED = 2;
    const REMARK_CARGO_SPOILED = 3;
    const REMARK_DELIVERY_DELAYED_AND_CARGO_SPOILED = 4;

    /** @var array status map */
    public static $statusMap = [
        self::STATUS_HAULER_NEEDED => "Hauler needed",
        self::STATUS_IN_TRANSIT => "In transit",
        self::STATUS_DELIVERED => "Delivered",
        self::STATUS_WITHDRAWN => "Withdrawn",
        self::STATUS_DRAFT => "Draft"
    ];

    /** @var string Actual status_id value */
    public $currentStatusId;

    /** @var string Actual is_deleted value */
    public $currentIsDeleted;

    /** @var bool Actual status if cargo loaded */
    public $currentCargoLoaded;

    /**
     * Get status label by status
     *
     * @param $status
     * @return bool
     */
    public static function getStatusLabel($status)
    {
        if (isset(self::$statusMap[$status])) {
            return self::$statusMap[$status];
        }

        return false;
    }

    /**
     * Get status map
     *
     * @return array
     */
    public static function getStatusMap()
    {
        return [
            'HAULER_NEDDED' => self::STATUS_HAULER_NEEDED,
            'IN_TRANSIT' => self::STATUS_IN_TRANSIT,
            'DELIVERED' => self::STATUS_DELIVERED,
            'WITHDRAWN' => self::STATUS_WITHDRAWN,
            'DRAFT' => self::STATUS_DRAFT
        ];
    }

    /**
     * @return mixed
     */
    public function getCurrentStatusId()
    {
        return $this->currentStatusId;
    }

    /**
     * @param $status_id
     * @return $this
     */
    public function setCurrentStatusId($status_id)
    {
        $this->currentStatusId = $status_id;

        return $this;
    }

    /**
     * @return string
     */
    public function getCurrentIsDeleted()
    {
        return $this->currentIsDeleted;
    }

    /**
     * @param $is_deleted
     * @return $this
     */
    public function setCurrentDeleted($is_deleted)
    {
        $this->currentIsDeleted = $is_deleted;

        return $this;
    }

    /**
     * @return bool
     */
    public function getCurrentCargoLoaded()
    {
        return $this->currentCargoLoaded;
    }

    /**
     * @param $isCargoLoaded
     * @return $this
     */
    public function setCurrentCargoLoaded($isCargoLoaded)
    {
        $this->currentCargoLoaded = $isCargoLoaded;

        return $this;
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
     *
     * @return array
     */
    public function behaviors()
    {
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
            ['creator_id, currency_id, supplier_id, loading_id, delivery_id, temperature_id, valid_date, load_date, deliver_date', 'required', 'on' => ['insert', 'update']],
            ['currency_id, temperature_id, delivery_id, loading_id, supplier_id', 'numerical', 'integerOnly' => true],
            ['currency_id, temperature_id, delivery_id, loading_id, supplier_id', 'default', 'setOnEmpty' => true, 'value' => null],
            ['creator_id, carrier_id, supplier_id, loading_id, delivery_id', 'length', 'max' => 9],
            ['status_id, is_deleted', 'length', 'max' => 1],
            ['load_date, deliver_date, valid_date', 'date', 'format' => 'yyyy-MM-dd', 'allowEmpty' => false, 'on' => ['insert', 'update']],
            ['load_date, deliver_date, valid_date', 'default', 'setOnEmpty' => true, 'value' => null, 'on' => 'saveDraft'],
            ['load_date, deliver_date, valid_date', 'compare', 'compareAttribute' => 'created', 'operator' => '>=', 'message' => '{attribute} must start with created date.'],
            ['load_date, deliver_date', 'compare', 'compareAttribute' => 'valid_date', 'operator' => '>', 'message' => '{attribute} must not be less than {compareAttribute}'],
            ['deliver_date', 'compare', 'compareAttribute' => 'load_date', 'operator' => '>=', 'message' => '{attribute} must not be less than {compareAttribute}'],
            ['status_updated_date', 'default', 'value' => new CDbExpression('NOW()'), 'setOnEmpty' => false, 'on' => 'insert'],
            ['created, carrier_id, supplier_id, remark_id, loaded_on_date, delivered_on_date, deleted_on_date', 'safe'],
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            ['id, creator_id, carrier_id, currency_id, status_id, supplier_id, loading_id, delivery_id, temperature_id, remark_id, valid_date, load_date, deliver_date, loaded_on_date, delivered_on_date, deleted_on_date, is_deleted, created, status_updated_date', 'safe', 'on' => 'search'],
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
            'creator' => [self::BELONGS_TO, 'User', 'creator_id'],
            'carrier' => [self::BELONGS_TO, 'User', 'carrier_id'],
            'supplier' => [self::BELONGS_TO, 'Supplier', 'supplier_id'],
            'remark' => [self::BELONGS_TO, 'Remark', 'remark_id'],
            'loading' => [self::BELONGS_TO, 'SupplierAddresses', 'loading_id'],
            'delivery' => [self::BELONGS_TO, 'DeliveryAddress', 'delivery_id'],
            'temperature' => [self::BELONGS_TO, 'Temperature', 'temperature_id'],
            'currency' => [self::BELONGS_TO, 'Currency', 'currency_id'],
            'orderBids' => [self::HAS_MANY, 'OrderBids', 'order_id'],
            'orderBidsCount' => [self::STAT, 'OrderBids', 'order_id'],
            'orderItems' => [self::HAS_MANY, 'OrderItems', 'order_id'],
            'orderUserViews' => [self::HAS_MANY, 'OrderItems', 'order_id'],
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('main', 'Order ID'),
            'creator_id' => Yii::t('main', 'Responsible'),
            'carrier_id' => Yii::t('main', 'Hauler'),
            'status_id' => Yii::t('main', 'Status'),
            'currency_id' => Yii::t('main', 'Currency'),
            'supplier_id' => Yii::t('main', 'Supplier Company'),
            'loading_id' => Yii::t('main', 'Supplier Address'),
            'delivery_id' => Yii::t('main', 'Delivery Address'),
            'temperature_id' => Yii::t('main', 'Temperature Control'),
            'remark_id' => Yii::t('main', 'Remark'),
            'valid_date' => Yii::t('main', 'Valid Until'),
            'load_date' => Yii::t('main', 'Load Until'),
            'deliver_date' => Yii::t('main', 'Deliver Due'),
            'loaded_on_date' => Yii::t('main', 'Loaded On'),
            'delivered_on_date' => Yii::t('main', 'Delivered On'),
            'deleted_on_date' => Yii::t('main', 'Deleted On'),
            'is_deleted' => Yii::t('main', 'Is Deleted'),
            'created' => Yii::t('main', 'Created'),
            'status_updated_date' => Yii::t('main', 'Status Updated Date')
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

        $criteria->compare('id', $this->id, true);
        $criteria->compare('creator_id', $this->creator_id, true);
        $criteria->compare('carrier_id', $this->carrier_id, true);
        $criteria->compare('status_id', $this->status_id, true);
        $criteria->compare('currency_id', $this->currency_id);
        $criteria->compare('supplier_id', $this->supplier_id, true);
        $criteria->compare('loading_id', $this->loading_id, true);
        $criteria->compare('delivery_id', $this->delivery_id, true);
        $criteria->compare('temperature_id', $this->temperature_id);
        $criteria->compare('remark_id', $this->remark_id);
        $criteria->compare('valid_date', $this->valid_date, true);
        $criteria->compare('load_date', $this->load_date, true);
        $criteria->compare('deliver_date', $this->deliver_date, true);
        $criteria->compare('loaded_on_date', $this->loaded_on_date, true);
        $criteria->compare('delivered_on_date', $this->delivered_on_date, true);
        $criteria->compare('deleted_on_date', $this->deleted_on_date, true);
        $criteria->compare('is_deleted', $this->is_deleted, true);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('status_updated_date', $this->created, true);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Order the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * After find
     */
    public function afterFind()
    {
        $this->setCurrentStatusId($this->status_id);
        $this->setCurrentDeleted($this->is_deleted);
        $this->setCurrentCargoLoaded($this->isCargoLoaded());

        parent::afterFind();
    }

    /**
     * Before model save
     *
     * @return bool
     */
    public function beforeSave()
    {
        // Update status_updated_date only if status changed or order restored
        if ($this->getCurrentStatusId() !== $this->status_id || $this->getCurrentIsDeleted() !== $this->is_deleted) {
            $this->status_updated_date = new CDbExpression('NOW()');
        }

        return parent::beforeSave();
    }

    public function afterSave()
    {
        // New order created
        if (($this->isNewRecord && !$this->isDraft()) || ($this->getCurrentStatusId() == self::STATUS_DRAFT && $this->status_id == self::STATUS_HAULER_NEEDED)) {
            $event = new CModelEvent();
            $this->onOrderCreated($event);
        }
        // Check if order was reopened
        if ($this->getCurrentStatusId() == self::STATUS_DELIVERED && $this->status_id == self::STATUS_IN_TRANSIT) {
            $event = new CModelEvent();
            $this->onOrderReopened($event);
        }

        // Check if hauler chosen
        if ($this->getCurrentStatusId() == self::STATUS_HAULER_NEEDED && $this->status_id == self::STATUS_IN_TRANSIT) {
            $event = new CModelEvent();
            $this->onHaulerChosen($event);
        }

        // Check if order was delivered
        if ($this->getCurrentStatusId() == self::STATUS_IN_TRANSIT && $this->status_id == self::STATUS_DELIVERED) {
            $event = new CModelEvent();
            $this->onOrderDelivered($event);
        }

        // Check if order was withdrawn
        if ($this->getCurrentStatusId() == self::STATUS_HAULER_NEEDED && $this->status_id == self::STATUS_WITHDRAWN) {
            $event = new CModelEvent();
            $this->onOrderWithdrawn($event);
        }

        // Check if order was loaded
        if ($this->isCargoLoaded() && !$this->getCurrentCargoLoaded()) {
            $event = new CModelEvent();
            $this->onOrderLoaded($event);
        }

        parent::afterSave();
    }

    /**
     * Get order bid by user
     *
     * @param User $user
     * @return null|OrderBids
     */
    public function getOrderBidByUser(User $user)
    {
        $orderBids = $this->orderBids([
            'condition' => 'user_id=' . $user->id,
            'limit' => 1
        ]);

        if (isset($orderBids[0])) {
            return $orderBids[0];
        }

        return null;
    }

    /**
     * Get bids count
     *
     * @return int
     */
    public function getBidsCount()
    {
        return $this->orderBidsCount([
            'condition' => "is_deleted='" . OrderBids::STATE_ACTIVE . "'"

        ]);
    }

    /**
     * Check if order has bids
     *
     * @return bool
     */
    public function hasOrderBids()
    {
        return $this->getBidsCount() > 0;
    }

    /**
     * @return null|OrderBids
     */
    public function getBidWon()
    {
        $orderBids = $this->orderBids([
            'condition' => "is_winner='" . OrderBids::IS_WINNER . "'",
            'limit' => 1
        ]);

        if (isset($orderBids[0])) {
            return $orderBids[0];
        }

        return null;
    }

    /**
     * @param User $user
     * @param integer $status
     * @param bool $isDeleted
     * @return CActiveDataProvider
     */
    public function getCActiveDataProviderByUserAndStatus(User $user, $status, $isDeleted)
    {
        $criteria = new CDbCriteria();
        if ($isDeleted) {
            $criteria->compare('is_deleted', self::IS_DELETED);
        } elseif ($status) {
            $criteria->compare('status_id', $status);
            $criteria->compare('is_deleted', self::IS_ACTIVE);
        }

        if ($user->isCarrier() && $status !== self::STATUS_HAULER_NEEDED) {
            $criteria->compare('carrier_id', $user->id);
        }

        $criteria->order = "status_updated_date DESC";

        return new CActiveDataProvider(__CLASS__, ['criteria' => $criteria]);
    }

    /**
     * Check if user has offered transportation
     * Also should be checked by is_deleted field value in future if required
     *
     * @param User $user
     * @return bool
     */
    public function isTransportationOfferedByUser(User $user)
    {
        $orderBidsCount = $this->orderBidsCount([
            'condition' => 'user_id=' . $user->id
        ]);

        return ($orderBidsCount > 0);
    }

    /**
     * Check if carrier has been chosen
     *
     * @return bool
     */
    public function isCarrierChosen()
    {
        return $this->carrier_id != null;
    }

    /**
     * Check if cargo is loaded
     *
     * @return bool
     */
    public function isCargoLoaded()
    {
        return $this->loaded_on_date != null;
    }

    /**
     * Check if order status is 'Hauler needed'
     *
     * @return bool
     */
    public function isHaulerNeeded()
    {
        return $this->status_id == self::STATUS_HAULER_NEEDED;
    }

    /**
     * Check if order is in transit
     *
     * @return bool
     */
    public function isInTransit()
    {
        return $this->status_id == self::STATUS_IN_TRANSIT;
    }

    /**
     * Check if order status is 'Delivered'
     *
     * @return bool
     */
    public function isDelivered()
    {
        return $this->status_id == self::STATUS_DELIVERED;
    }

    /**
     * Check if order status is 'Draft'
     *
     * @return bool
     */
    public function isDraft()
    {
        return $this->status_id == self::STATUS_DRAFT;
    }

    /**
     * Check if order is deleted
     *
     * @return bool
     */
    public function isDeleted()
    {
        return $this->is_deleted == self::IS_DELETED;
    }

    /**
     * @return bool
     */
    public function isDeliveryDelayed()
    {
        $todayDateTime = new DateTime();
        $validUntilDateTime = new DateTime($this->valid_date);

        return $todayDateTime > $validUntilDateTime;
    }

    /**
     * Get orders with issues criteria
     *
     * @param User $user
     * @return CDbCriteria
     */
    public function getOrdersWithIssuesCriteriaByUser(User $user)
    {
        $criteria = new CDbCriteria();
        $criteria->compare('carrier_id', $user->id);
        $criteria->compare('status_id', self::STATUS_DELIVERED);
        $criteria->addCondition("remark_id != :remark");
        $criteria->params[':remark'] = self::REMARK_SUCCESS;

        return $criteria;
    }

    /**
     * Get orders with issues
     *
     * @param User $user
     * @return Order[]
     */
    public function getOrdersWithIssuesByUser(User $user)
    {
        $criteria = $this->getOrdersWithIssuesCriteriaByUser($user);

        return self::model()->findAll($criteria);
    }

    /**
     * Get orders with issues count
     *
     * @param User $user
     * @return string
     */
    public function getOrdersWithIssuesCountByUser(User $user)
    {
        $criteria = $this->getOrdersWithIssuesCriteriaByUser($user);

        return self::model()->count($criteria);
    }

    /**
     * Check if user has already viewed this order
     *
     * @param User $user
     * @return bool
     */
    public function isViewedByUser(User $user)
    {
        $orderUserViewModel = OrderUserView::model();
        $criteria = new CDbCriteria();
        $criteria->compare('user_id', $user->id);
        $criteria->compare('order_id', $this->id);

        return $orderUserViewModel->count($criteria) > 0;
    }

    /**
     * Get count of orders which were not viewed by user
     *
     * @param User $user
     * @param null $status
     * @return int
     */
    public function getUnviewedOrderCountByUserAndStatus(User $user, $status = null)
    {
        $orderUserView = OrderUserView::model()->getOrderUserViewByUser($user);
        $orderUserViewList = CHtml::listData($orderUserView, 'order_id', 'user_id');
        $orderUserViewIds = array_keys($orderUserViewList);

        $criteria = new CDbCriteria();
        $criteria->addNotInCondition('id', $orderUserViewIds);
        if ($user->isCarrier() && $status != self::STATUS_HAULER_NEEDED) {
            $criteria->compare('carrier_id', $user->id);
        }
        if ($status) {
            $criteria->compare('status_id', $status);
        }
        $criteria->compare('is_deleted', self::IS_ACTIVE);

        return self::model()->count($criteria);
    }

    /**
     * Get deleted unviewed order count
     *
     * @param User $user
     * @return string
     */
    public function getUnviewedDeletedOrderCountByUser(User $user)
    {
        $orderUserView = OrderUserView::model()->getOrderUserViewByUser($user);
        $orderUserViewList = CHtml::listData($orderUserView, 'order_id', 'user_id');
        $orderUserViewIds = array_keys($orderUserViewList);

        $criteria = new CDbCriteria();
        $criteria->addNotInCondition('id', $orderUserViewIds);
        $criteria->compare('is_deleted', self::IS_DELETED);

        return self::model()->count($criteria);
    }

    /**
     * Get draft order
     *
     * @param User $user
     * @return Order
     */
    public function getDraftOrderByUser(User $user)
    {
        $criteria = new CDbCriteria();
        $criteria->compare('creator_id', $user->id);
        $criteria->compare('status_id', self::STATUS_DRAFT);

        return self::model()->find($criteria);
    }

    /**
     * @return Order[]
     */
    public function getDelayedOrders()
    {
        $criteria = new CDbCriteria();
        $criteria->addCondition('DATE(NOW()) > DATE(deliver_date)');
        $criteria->addCondition('remark_id IS NULL');
        $criteria->compare('status_id', Order::STATUS_IN_TRANSIT);
        $criteria->compare('is_deleted', Order::IS_ACTIVE);

        return self::model()->findAll($criteria);
    }

    /**
     * @return static[]
     */
    public function getPostponedOrders()
    {
        $criteria = new CDbCriteria();
        $criteria->addCondition('DATE(NOW()) > DATE(valid_date)');
        $criteria->addCondition('remark_id IS NULL');
        $criteria->compare('status_id', Order::STATUS_HAULER_NEEDED);
        $criteria->compare('is_deleted', Order::IS_ACTIVE);

        return self::model()->findAll($criteria);
    }

    /**
     * @param $event
     * @throws CException
     */
    public function onOrderCreated($event)
    {
        $this->raiseEvent(__FUNCTION__, $event);
    }

    /**
     * @param $event
     * @throws CException
     */
    public function onOrderReopened($event)
    {
        $this->raiseEvent(__FUNCTION__, $event);
    }

    /**
     * @param $event
     * @throws CException
     */
    public function onHaulerChosen($event)
    {
        $this->raiseEvent(__FUNCTION__, $event);
    }

    /**
     * @param $event
     * @throws CException
     */
    public function onOrderDelivered($event)
    {
        $this->raiseEvent(__FUNCTION__, $event);
    }

    /**
     * @param $event
     * @throws CException
     */
    public function onOrderWithdrawn($event)
    {
        $this->raiseEvent(__FUNCTION__, $event);
    }

    /**
     * @param $event
     * @throws CException
     */
    public function onOrderLoaded($event)
    {
        $this->raiseEvent(__FUNCTION__, $event);
    }
}
