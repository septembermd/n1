<?php
/**
 * Created by Victor Davydov <septembermd@gmail.com>
 * Date: 6/3/15
 * Time: 12:45 PM
 */

class OrderLoadedEvent extends NotificationEvent
{
    /** @var OrderBidsController controller instance */
    protected $controller;

    /**
     * @param Order $sender
     * @param OrderController $controller
     * @param null $options
     */
    public function __construct(Order $sender, OrderController $controller, $options = null)
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
            $supervisors = User::model()->findAllSupervisors();
            $users = [$order->creator->email, $order->carrier->email];
            foreach ($supervisors as $supervisor) {
                $users[] = $supervisor->email;
            }
            $replacements = [];
            foreach ($users as $email) {
                $replacements[$email] = [
                    '{{order}}' => CHtml::link('#'.$order->id, $orderAbsoluteUrl),
                    '{{order_url}}'=> CHtml::link($orderAbsoluteUrl, $orderAbsoluteUrl),
                    '{{items_list}}' => $this->controller->renderPartial('/orderItems/_list', ['items' => $order->orderItems]),
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

            Yii::log(sprintf('Sent email notification that order #%s is loaded by user %s', $order->id, $order->carrier_id));
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
        return 'order_loaded';
    }
}