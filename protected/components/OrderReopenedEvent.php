<?php
/**
 * Created by Victor Davydov <septembermd@gmail.com>
 * Date: 6/2/15
 * Time: 7:24 PM
 */


/**
 * Class OrderReopenedEvent
 */
class OrderReopenedEvent extends NotificationEvent
{
    const MESSAGE_TEMPLATE = 'order_reopened';

    /**
     * @param mixed|null $sender
     * @param null $options
     */
    public function __construct($sender, $options = null)
    {
        parent::__construct($sender, $options);
    }

    /**
     * Send mail
     *
     * @return mixed
     */
    public function sendNotification()
    {
        /** @var Order $order */
        $order = $this->sender;

        $emailTemplate = EmailTemplate::model()->findByAttributes(['slug' => self::MESSAGE_TEMPLATE]);
        if ($emailTemplate) {
            /** @var SwiftMailer $mailer */
            $mailer = $this->getMailer();
            $mailer->setSubject($emailTemplate->subject)
                ->setBody($emailTemplate->body);

            $users = [$order->creator->email, $order->carrier->email];
            foreach ($users as $email) {
                $replacements[$email] = [
                    '{{order}}' => CHtml::link('#' . $order->id, Yii::app()->createAbsoluteUrl('order/view', ['id' => $order->id])),
                    '{{site}}' => Yii::app()->createAbsoluteUrl('/')
                ];
                $mailer->addAddress($users);
            }
            $mailer->setDecoratorReplacements($replacements)
                ->send();

            Yii::log('Sent notification that order is reopened');
        } else {
            Yii::log(sprintf('Failed to send notification. Not found template %s', self::MESSAGE_TEMPLATE), CLogger::LEVEL_ERROR);
        }
    }
}