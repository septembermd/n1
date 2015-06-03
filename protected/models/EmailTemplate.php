<?php

/**
 * This is the model class for table "email_template".
 *
 * The followings are the available columns in table 'email_template':
 * @property string $id
 * @property string $slug
 * @property string $subject
 * @property string $body
 */
class EmailTemplate extends CActiveRecord
{
    const TEMPLATE_ORDER_DELAYED = 'order_delivery_delayed';
    const TEMPLATE_ORDER_POSTPONED ='order_postponed';

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'email_template';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['slug', 'length', 'max' => 255],
            ['slug', 'unique'],
            ['subject', 'length', 'max' => 255],
            ['body', 'length', 'max' => 3000],
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            ['id, slug, subject, body', 'safe', 'on' => 'search'],
        ];
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return [];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'slug' => Yii::t('main', 'Slug'),
            'subject' => Yii::t('main', 'Subject'),
            'body' => Yii::t('main', 'Body'),
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
        $criteria->compare('slug', $this->slug, true);
        $criteria->compare('subject', $this->subject, true);
        $criteria->compare('body', $this->body, true);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return EmailTemplate the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * Find email template by slug
     *
     * @param $slug
     * @return static
     */
    public function getEmailTemplateBySlug($slug)
    {
        return self::model()->findByAttributes(['slug' => $slug]);
    }
}
