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
 * @property integer $role_id
 * @property string $created
 * @property string $is_active
 *
 * The followings are the available model relations:
 * @property OrderBids[] $orderBids
 * @property StatusChanges[] $statusChanges
 * @property Company $company
 * @property Role $role
 */
class User extends ActiveRecord
{
    const STATE_INACTIVE = 0;
    const STATE_ACTIVE = 1;

    public $new_password;

    public static $userStateList = array(
        self::STATE_ACTIVE => 'Active',
        self::STATE_INACTIVE => 'Inactive'
    );

    /**
     * @param $state
     * @return bool
     */
    public static function getUserStateLabel($state)
    {
        if(isset(self::$userStateList[$state])) {
            return self::$userStateList[$state];
        }

        return false;
    }

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('company_id, fullname, email, password, phone, role_id, created', 'required', 'on'=>'create'),
			array('company_id, fullname, email, phone, role_id, created', 'required', 'on'=>'update'),
			array('email', 'email'),
            array('email', 'filter', 'filter'=>'trim'),
            array('email', 'unique'),
			array('role_id', 'numerical', 'integerOnly'=>true),
			array('company_id', 'length', 'max'=>5),
			array('fullname, email', 'length', 'max'=>100),
			array('phone', 'length', 'max'=>20),
			array('password, new_password, salt', 'length', 'max'=>255),
			array('password, new_password', 'length', 'min'=>6),
			array('is_active', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('password', 'safe', 'on'=>'update'),
			array('id, company_id, fullname, email, phone, password, salt, role_id, created, is_active', 'safe', 'on'=>'search'),
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
			'orderBids' => array(self::HAS_MANY, 'OrderBids', 'user_id'),
			'statusChanges' => array(self::HAS_MANY, 'StatusChanges', 'user_id'),
			'company' => array(self::BELONGS_TO, 'Company', 'company_id'),
			'role' => array(self::BELONGS_TO, 'Role', 'role_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'company_id' => 'Company',
			'fullname' => 'Fullname',
			'email' => 'Email',
			'phone' => 'Phone',
			'password' => 'Password',
			'salt' => 'Salt',
			'role_id' => 'Role',
			'created' => 'Created',
			'is_active' => 'Is Active',
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
		$criteria->compare('company_id',$this->company_id,true);
		$criteria->compare('fullname',$this->fullname,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('salt',$this->salt,true);
		$criteria->compare('role_id',$this->role_id);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('is_active',$this->is_active,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
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

    public function isActive()
    {
        return self::STATE_ACTIVE == $this->is_active;
    }

    public function setPassword($password)
    {
        $this->password = CPasswordHelper::hashPassword($password);
        $this->salt = CPasswordHelper::generateSalt();
    }
}