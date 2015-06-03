<?php
/**
 * Created by Victor Davydov <septembermd@gmail.com>
 * Date: 6/3/15
 * Time: 7:23 PM
 */

/**
 * Class OrderCreatedEvent
 */
class OrderCreatedEvent extends NotificationEvent
{
    protected $controller;

    /**
     * @param mixed|null $sender
     * @param OrderController $controller
     * @param array|null $options
     */
    public function __construct($sender, OrderController $controller,  $options = null)
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
        $emailTemplate = $this->getTemplate();
        if ($emailTemplate) {
            /** @var Order $orderBid */
            $order = $this->sender;
            $mailer = $this->getMailer();

            $orderAbsoluteUrl = Yii::app()->createAbsoluteUrl('order/view', ['id' => $order->id]);
            $carriers = User::model()->findAllCarriers();
            $users = [];
            foreach ($carriers as $carrier) {
                $users[] = $carrier->email;
            }
            $replacements = [];
            foreach ($users as $email) {
                $replacements[$email] = [
                    '{{order}}' => CHtml::link('#'.$order->id, $orderAbsoluteUrl),
                    '{{order_url}}'=> CHtml::link($orderAbsoluteUrl, $orderAbsoluteUrl),
                    '{{items_list}}' => $this->controller->renderPartial('/orderItems/_list', ['items' => $order->orderItems], true),
                    '{{delivery_country}}' => $order->delivery->country->title,
                    '{{delivery_address}}' => $order->delivery->address,
                    '{{loading_country}}' => $order->loading->country->title,
                    '{{temperature_control}}' => $order->temperature->title,
                ];
            }

            $mailer->setSubject($emailTemplate->subject)
                ->addAddress($users)
                ->setBody($emailTemplate->body)
                ->setDecoratorReplacements($replacements)
                ->send();

            Yii::log(sprintf('Sent email notification that a new order order #%s created', $order->id));
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
        return 'order_created';
    }
}