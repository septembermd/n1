<?php
/**
 * Created by Victor Davydov <septembermd@gmail.com>
 * Date: 6/3/15
 * Time: 10:01 AM
 */

/**
 * Class HaulerChosenEvent
 */
class HaulerChosenEvent extends NotificationEvent
{
    /** @var OrderBidsController controller instance */
    protected $controller;

    /**
     * @param OrderBids $sender
     * @param OrderBidsController $controller
     * @param null $options
     */
    public function __construct(OrderBids $sender, OrderBidsController $controller, $options = null)
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
        $orderBid = $this->sender;
        /** @var Order $order */
        $order = $orderBid->order;

        $emailTemplate = $this->getTemplate();
        if ($emailTemplate) {
            $mailer = $this->getMailer();

            $orderAbsoluteUrl = Yii::app()->createAbsoluteUrl('order/view', ['id' => $order->id]);
            $deliverDueDate = new DateTime($order->deliver_date);
            $replacements = [
                $order->carrier->email => [
                    '{{order}}' => CHtml::link('#'.$order->id, $orderAbsoluteUrl),
                    '{{order_url}}'=> CHtml::link($orderAbsoluteUrl, $orderAbsoluteUrl),
                    '{{carrier}}' => CHtml::link($order->carrier->fullname, Yii::app()->createAbsoluteUrl('user/view', ['id' => $order->carrier_id])),
                    '{{items_list}}' => $this->controller->renderPartial('/orderItems/_list', ['items' => $order->orderItems]),
                    '{{delivery_country}}' => $order->delivery->country->title,
                    '{{loading_country}}' => $order->loading->country->title,
                    '{{temperature_control}}' => $order->temperature->title,
                    '{{deliver_due_date}}' => $deliverDueDate->format('F jS, Y')
                ]
            ];

            $mailer->setSubject($emailTemplate->subject)
                ->addAddress($order->creator->email)
                ->setBody($emailTemplate->body)
                ->setDecoratorReplacements($replacements)
                ->send();

            Yii::log(sprintf('Sent email notification that hauler has been chosen for order #%s', $order->id));
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
        return 'hauler_chosen';
    }
}