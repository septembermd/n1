<?php
/**
 * Created by Victor Davydov <septembermd@gmail.com>
 * Date: 6/3/15
 * Time: 12:07 PM
 */

/**
 * Class OrderWithdrawnEvent
 */
class OrderWithdrawnEvent extends NotificationEvent
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


            $supervisors = User::model()->findAllSupervisors();
            /** @var OrderBids[] $orderBids */
            $orderBids = $order->orderBids;
            $users = [$order->creator->email];
            foreach ($supervisors as $supervisor) {
                $users[] = $supervisor->email;
            }
            foreach ($orderBids as $orderBid) {
                $users[] = $orderBid->user->email;
            }
            $replacements = [];
            $deliverDueDate = new DateTime($order->deliver_date);
            $orderAbsoluteUrl = Yii::app()->createAbsoluteUrl('order/view', ['id' => $order->id]);
            foreach ($users as $email) {
                $replacements[$email] = [
                    '{{order}}' => CHtml::link('#'.$order->id, $orderAbsoluteUrl),
                    '{{order_url}}'=> CHtml::link($orderAbsoluteUrl, $orderAbsoluteUrl),
                    '{{items_list}}' => $this->controller->renderPartial('/orderItems/_list', ['items' => $order->orderItems], true),
                    '{{delivery_country}}' => $order->delivery->country->title,
                    '{{loading_country}}' => $order->loading->country->title,
                    '{{deliver_due_date}}' => $deliverDueDate->format('F jS, Y')
                ];
            }

            $mailer->setSubject($emailTemplate->subject)
                ->addAddress($users)
                ->setBody($emailTemplate->body)
                ->setDecoratorReplacements($replacements)
                ->send();

            Yii::log(sprintf('Sent email notification that order #%s created by user %s was withdrawn.', $order->id, $order->creator_id));
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
        return 'order_withdrawn';
    }
}