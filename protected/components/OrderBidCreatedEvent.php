<?php
/**
 * Created by Victor Davydov <septembermd@gmail.com>
 * Date: 6/2/15
 * Time: 3:43 PM
 */

/**
 * Class OrderBidCreatedEvent
 */
class OrderBidCreatedEvent extends NotificationEvent
{
    const MESSAGE_TEMPLATE = "order_bid_created";

    /** @var OrderBidsController controller instance */
    protected $controller;

    /**
     * @param mixed|null $sender
     * @param OrderBidsController $controller
     * @param null $options
     */
    public function __construct($sender, $controller, $options = null)
    {
        $this->controller = $controller;
        parent::__construct($sender, $options);
    }

    /**
     * Send mail
     *
     * @return mixed
     */
    public function sendNotification()
    {
        /** @var OrderBids $orderBid */
        $orderBid = $this->sender;

        /** @var SwiftMailer $mailer */
        $mailer = $this->getMailer();

        $emailTemplate = EmailTemplate::model()->findByAttributes(['slug' => self::MESSAGE_TEMPLATE]);
        if ($emailTemplate) {
            $users = [$orderBid->order->creator->email,];
            $orderAbsoluteUrl = Yii::app()->createAbsoluteUrl('order/view', ['id' => $orderBid->id]);
            $replacements = [
                $orderBid->order->creator->email => [
                    '{{order}}' => CHtml::link('#'.$orderBid->id, $orderAbsoluteUrl),
                    '{{order_url}}'=> CHtml::link($orderAbsoluteUrl, $orderAbsoluteUrl),
                    '{{carrier}}' => $orderBid->user->fullname,
                    '{{items_list}}' => $this->controller->renderPartial('/orderItems/_list', ['items' => $orderBid->order->orderItems]),
                    '{{delivery_country}}' => $orderBid->order->delivery->country->title,
                    '{{loading_country}}' => $orderBid->order->loading->country->title,
                    '{{temperature_control}}' => $orderBid->order->temperature->title,
                ]
            ];

            foreach($users as $email) {
                $mailer->setSubject($emailTemplate->subject)
                    ->addAddress($email)
                    ->setBody($emailTemplate->body)
                    ->setDecoratorReplacements($replacements)
                    ->send();
            }


            Yii::log(sprintf('Sent email notification about new order bid for order #%s by user #%s', $orderBid->order_id, $orderBid->user_id));
        } else {
            Yii::log(sprintf('Failed to send notification. Not found template %s', self::MESSAGE_TEMPLATE), CLogger::LEVEL_ERROR);
        }
    }
}