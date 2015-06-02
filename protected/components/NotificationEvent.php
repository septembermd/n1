<?php
/**
 * Created by PhpStorm.
 * User: september
 * Date: 5/27/15
 * Time: 9:19 AM
 */

/**
 * Class NotificationEvent
 */
abstract class NotificationEvent extends CEvent
{
    /**
     * @var $mailer
     */
    public $mailer;

    /**
     * @param mixed|null $sender
     * @param null $params
     */
    public function __construct($sender = null, $params = null)
    {
        parent::__construct($sender, $params);

        $this->setMailer(Yii::app()->mailer);
    }

    /**
     * @return mixed
     */
    public function getMailer()
    {
        return $this->mailer;
    }

    /**
     * @param SwiftMailer $mailer
     * @return $this
     */
    public function setMailer(SwiftMailer $mailer)
    {
        $this->mailer = $mailer;

        return $this;
    }


    /**
     * Send mail
     *
     * @return mixed
     */
    public abstract function sendNotification();
}