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

        $emailTemplate = $this->getTemplate();
        if ($emailTemplate) {
            $orderAbsoluteUrl = Yii::app()->createAbsoluteUrl('order/view', ['id' => $orderBid->id]);
            $deliverDueDate = new DateTime($orderBid->order->deliver_date);
            $replacements = [
                $orderBid->order->creator->email => [
                    '{{order}}' => CHtml::link('#'.$orderBid->id, $orderAbsoluteUrl),
                    '{{order_url}}'=> CHtml::link($orderAbsoluteUrl, $orderAbsoluteUrl),
                    '{{carrier}}' => CHtml::link($orderBid->user->fullname, Yii::app()->createAbsoluteUrl('user/view', ['id' => $orderBid->user_id])),
                    '{{items_list}}' => $this->controller->renderPartial('/orderItems/_list', ['items' => $orderBid->order->orderItems]),
                    '{{delivery_country}}' => $orderBid->order->delivery->country->title,
                    '{{loading_country}}' => $orderBid->order->loading->country->title,
                    '{{temperature_control}}' => $orderBid->order->temperature->title,
                    '{{deliver_due_date}}' => $deliverDueDate->format('F jS, Y')
                ]
            ];

            $mailer->setSubject($emailTemplate->subject)
                ->addAddress($orderBid->order->creator->email)
                ->setBody($emailTemplate->body)
                ->setDecoratorReplacements($replacements)
                ->send();

            Yii::log(sprintf('Sent email notification about new order bid for order #%s by user #%s', $orderBid->order_id, $orderBid->user_id));
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
        return 'order_bid_created';
    }
}