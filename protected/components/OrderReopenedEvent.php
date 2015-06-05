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
    /**
     * Send mail
     *
     * @return mixed
     */
    public function sendNotification()
    {
        /** @var Order $order */
        $order = $this->sender;

        $emailTemplate = $this->getTemplate();
        if ($emailTemplate) {
            /** @var SwiftMailer $mailer */
            $mailer = $this->getMailer();
            $mailer->setSubject($emailTemplate->subject)
                ->setBody($emailTemplate->body);

            $users = [$order->creator->email, $order->carrier->email];
            $supervisors = User::model()->findAllSupervisors();
            foreach ($supervisors as $user) {
                $users[] = $user->email;
            }
            $replacements = [];
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
            Yii::log(sprintf('Failed to send notification. Not found template %s', $this->getTemplateName()), CLogger::LEVEL_ERROR);
        }
    }

    /**
     * Template name
     *
     * @return string
     */
    public function getTemplateName()
    {
        return 'order_reopened';
    }
}