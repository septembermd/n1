<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property string $id
 * @property string $company_id
 * @property string $fullname
 * @property string $email
 * @property string $phone
 * @property string $password
 * @property string $salt
 * @property string $role_id
 * @property string $created
 * @property string $is_active
 *
 * The followings are the available model relations:
 * @property Order[] $orders
 * @property integer $carrierOrdersCount
 * @property OrderBids[] $orderBids
 * @property Company $company
 */
class User extends ActiveRecord
{
    const STATE_INACTIVE = 0;
    const STATE_ACTIVE = 1;

    const ROLE_CARRIER = 1;
    const ROLE_MANAGER = 2;
    const ROLE_SUPERVISOR = 3;
    const ROLE_ADMIN = 4;

    /** @var string New password value */
    public $new_password;

    /** @var array User phone numbers */
    public $phone_numbers;

    /** @var array User state map */
    public static $userStateList = [
        self::STATE_ACTIVE => 'Active',
        self::STATE_INACTIVE => 'Inactive'
    ];

    /** @var array User role map */
    public static $roleMap = [
        self::ROLE_CARRIER => 'carrier',
        self::ROLE_MANAGER => 'logistics manager',
        self::ROLE_SUPERVISOR => 'supervisor',
        self::ROLE_ADMIN => 'administrator'
    ];

    /**
     * Get label for user state
     *
     * @param $state
     * @return bool
     */
    public static function getUserStateLabel($state)
    {
        if (isset(self::$userStateList[$state])) {
            return self::$userStateList[$state];
        }

        return false;
    }

    /**
     * Get label for user role
     *
     * @param $role
     * @return bool
     */
    public static function getRoleLabel($role)
    {
        if (isset(self::$roleMap[$role])) {
            return self::$roleMap[$role];
        }

        return false;
    }

    /**
     * Returns the static model of the specified AR class.
     *
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['company_id, fullname, email, password, phone, role_id, created', 'required', 'on' => 'create'],
            ['company_id, fullname, email, phone, role_id, created', 'required', 'on' => 'update'],
            ['fullname', 'match', 'not' => true, 'pattern' => '/[^a-zA-Z0-9-_ ]/', 'message' => 'Invalid characters in full name.',],
            ['email', 'email'],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'unique'],
//            ['phone', 'match', 'not' => true, 'pattern' => '/[^a-zA-Z0-9-+ ]/', 'message' => 'Invalid characters in phone number.',],
            ['phone_numbers', 'validPhone'],
            ['role_id', 'numerical', 'integerOnly' => true],
            ['fullname, email', 'length', 'max' => 100],
            ['phone', 'length', 'max' => 255, 'message' => 'Too many phone numbers.'],
            ['password, new_password, salt', 'length', 'max' => 255],
            ['password, new_password', 'length', 'min' => 6],
            ['is_active, role_id', 'length', 'max' => 1],
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            ['password', 'safe', 'on' => 'update'],
            ['id, company_id, fullname, email, phone, password, salt, role_id, created, is_active', 'safe', 'on' => 'search'],
        ];
    }

    /**
     * Phone numbers validator
     *
     * @param $attribute
     * @param $params
     */
    public function validPhone($attribute, $params)
    {
        if (is_array($this->$attribute)) {
            $pattern = '/[a-zA-Z0-9-+ ]$/';
            foreach ($this->$attribute as $key => $phone) {
                if(!preg_match($pattern, $phone)) {
                    $this->addError('phone', 'Invalid characters in phone number.');
                    break;
                }
            }
        } else {
            $this->addError('phone', Yii::t('main', 'Phone data sent invalid.'));
        }
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return [
            'carrierOrders' => [self::HAS_MANY, 'Order', 'carrier_id'],
            'orders' => [self::HAS_MANY, 'Orders', 'creator_id'],
            'carrierOrdersCount' => [self::STAT, 'Order', 'carrier_id'],
            'orderBids' => [self::HAS_MANY, 'OrderBids', 'user_id'],
            'orderCarriers' => [self::HAS_MANY, 'Orders', 'carrier_id'],
            'orderUserViews' => [self::HAS_MANY, 'OrderUserView', 'user_id'],
            'company' => [self::BELONGS_TO, 'Company', 'company_id'],
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => Yii::t('main', 'Company'),
            'fullname' => Yii::t('main', 'Fullname'),
            'email' => Yii::t('main', 'Email'),
            'phone' => Yii::t('main', 'Phone'),
            'password' => Yii::t('main', 'Password'),
            'salt' => Yii::t('main', 'Salt'),
            'role_id' => Yii::t('main', 'Role'),
            'created' => Yii::t('main', 'Created'),
            'is_active' => Yii::t('main', 'Is Active'),
        ];
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('company_id', $this->company_id, true);
        $criteria->compare('fullname', $this->fullname, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('phone', $this->phone, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('salt', $this->salt, true);
        $criteria->compare('role_id', $this->role_id, true);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('is_active', $this->is_active, true);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }

    /**
     * After find
     */
    public function afterFind()
    {
        if ($this->hasAttribute('phone')) {
            $this->phone_numbers = explode(',', $this->phone);
        }

        // This method doesn't return any value
        parent::afterFind();
    }

    /**
     * @return bool
     */
    public function beforeValidate()
    {
        // Save phone as imploded string
        if (!empty($this->phone_numbers)) {
            $this->phone = implode(',', $this->phone_numbers);
        }

        return parent::beforeValidate();
    }

    /**
     * @return bool
     */
    public function beforeSave()
    {
        // Save new company, if id is not numeric then user added a custom value
        $company = Company::model()->countByAttributes(['id' => $this->company_id]);
        if ($company == 0) {
            $company = new Company();
            $company->setAttribute('title', $this->company_id);
            if (!$company->validate()) {
                $this->addErrors($company->getErrors());
            } else {
                if ($company->save()) {
                    $this->company_id = $company->id;
                } else {
                    $this->addError('company_id', [Yii::t('main', 'Error saving new company.')]);
                }
            }
        }

        // If model is updating
        if (!$this->isNewRecord) {
            $this->beforeUpdate();
        }

        return parent::beforeSave();
    }

    /**
     * Actions to perform when updating model
     */
    public function beforeUpdate()
    {
        // Save new password if user filled in the field
        if (!empty($this->new_password)) {
            $this->setPassword($this->new_password);
        }
    }

    /**
     * Validate user password
     *
     * @param $password
     * @return bool
     */
    public function validatePassword($password)
    {
        return CPasswordHelper::verifyPassword($password, $this->password);
    }

    /**
     * @param $password
     * @throws CException
     */
    public function setPassword($password)
    {
        $this->password = CPasswordHelper::hashPassword($password);
        $this->salt = CPasswordHelper::generateSalt();
    }

    /**
     * Check if given model is the same model
     *
     * @param User $user
     * @return bool
     */
    public function isSelf(User $user)
    {
        return $this->id === $user->id;
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return self::STATE_ACTIVE == $this->is_active;
    }

    /**
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role_id == self::ROLE_ADMIN;
    }

    /**
     * @return bool
     */
    public function isSupervisor()
    {
        return $this->role_id == self::ROLE_SUPERVISOR;
    }

    /**
     * @return bool
     */
    public function isManager()
    {
        return $this->role_id == self::ROLE_MANAGER;
    }

    /**
     * @return bool
     */
    public function isCarrier()
    {
        return $this->role_id == self::ROLE_CARRIER;
    }

    /**
     * @param Order $order
     * @return bool
     */
    public function hasOrderBids(Order $order)
    {
        return count($this->orderBids) > 0;
    }

    /**
     * Get delivered orders with issues count
     *
     * @return string
     */
    public function getRecentIssuesCount()
    {
        $criteria = new CDbCriteria();
        $criteria->condition = "remark_id!=".Order::REMARK_SUCCESS;
        $criteria->compare('status_id', Order::STATUS_DELIVERED);

        return $this->carrierOrdersCount($criteria);
    }
}