<?php

/**
 * This is the model class for table "superuser".
 *
 * The followings are the available columns in table 'superuser':
 * @property integer $id
 * @property string $username
 * @property string $name
 * @property string $surname
 * @property string $email
 * @property string $password
 * @property string $salt
 * @property integer $is_active
 * @property integer $is_staff
 * @property string $last_login
 * @property string $date_joined
 */
class Superuser extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Superuser the static model class
	 */

    public $agreement;

    public $password_repeat;

    public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'superuser';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return [
            ['username, name, surname, email, phone, address, password, password_repeat', 'required',
                'on' => 'insert'],
            ['username', 'unique',
                'on' => 'insert'],
            ['password, password_repeat', 'required', 'on' => 'updatepassword'],
            ['email, name, password, password_repeat', 'required', 'on' => 'register'],
            ['type_name, cod_fisc','required','on'=>'scenario1'],
            ['username, name, surname, email, is_active', 'required', 'on' => 'update'],
            ['is_active, type, phone ', 'numerical', 'integerOnly' => true],
            ['password', 'length', 'min' => 5],
            ['username, name, password', 'length', 'max' => 512],
            ['salt', 'length', 'max' => 255],
            ['email', 'email', 'message' => 'Email is not valid.'],
            ['email', 'unique'],
            ['password', 'compare', 'on' => 'insert, updatepassword, register'],
            ['password_repeat', 'safe'],
            ['last_login, date_joined, is_staff', 'safe'],
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
            ['id, username, name,  email, password, salt, is_active, is_staff, last_login, date_joined', 'safe', 'on' => 'search'],
            ['is_active', 'default',
                'value' => 1,
                'setOnEmpty' => false, 'on' => 'insert, register'],
            ['date_joined', 'default',
                'value' => new CDbExpression('NOW()'),
                'setOnEmpty' => false, 'on' => 'insert, register']

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
        ];
	}

    public function validatePassword($password)
    {
        return $this->hashPassword($password, $this->salt) === $this->password;
    }

	/**
     * Generates the password hash.
     * @param string password
     * @param string salt
     * @return string hash
     */
    public function hashPassword($password, $salt)
    {
        return md5($salt . $password);
    }

    /**
     * Generates a salt that can be used to generate a password hash.
     * @return string the salt
     */
    public function generateSalt()
    {
        return uniqid('', true);
    }

    /**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
            'username' => 'Логин',
            'name' => 'Имя',
            'surname' => 'Фамилия',
			'email' => 'Email',
            'password' => 'Пароль',
            'address' => 'Адрес',
            'phone' => 'Телефон',
            'type' => 'Тип лица',
            'password_repeat' => 'Повторите пароль',
            'type_name' => 'Название предприятия',
            'cod_fisc'  => 'Фискальный код',
        ];
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */

  public function getIsUserOnline()
    {
        // select five minutes ago
        $five_minutes_ago = mktime(date("H"), date("i") - 5, date("s"), date("m"), date("d"), date("Y"));

        if ($this->last_login > $five_minutes_ago)
            return true;
        else
            return false;
    }
  
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('salt', $this->salt, true);
        $criteria->compare('is_active', $this->is_active);
        $criteria->compare('is_staff', $this->is_staff);
        $criteria->compare('last_login', $this->last_login, true);
        $criteria->compare('date_joined', $this->date_joined, true);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }

    public function beforeSave()
    {
        if ($this->isNewRecord) {
            $this->salt = $this->generateSalt();
            $this->password = $this->hashPassword($this->password, $this->salt);
            $this->password_repeat = $this->hashPassword($this->password, $this->salt);
    }

        return parent::beforeSave();
    }

    public function todayRegistrations()
    {
        $crt = new CDbCriteria();
        $day_ago = date("Y-m-d H:i:s", mktime(date("H"), date("i"), date("s"), date("m"), date("d") - 1, date("Y")));
        $crt->select = '*, UNIX_TIMESTAMP(date_joined) as date_joined';
        $crt->condition = 'date_joined > :param';
        $crt->params = [':param' => $day_ago];
        return User::model()->findAll($crt);
}
}