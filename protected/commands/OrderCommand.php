<?php
/**
 * Created by Victor Davydov <septembermd@gmail.com>.
 * Date: 5/27/15
 * Time: 7:29 PM
 */


/**
 * Class OrderCommand
 */
class OrderCommand extends ConsoleCommand
{
    public function actionCheckDelayedOrders()
    {
        echo "Finding delayed orders..." . PHP_EOL;
        /** @var Order[] $orders */
        $orders = Order::model()->getDelayedOrders();
        $ordersCount = count($orders);
        Yii::log(
            sprintf("Found %s delayed %s" . PHP_EOL, $ordersCount, $this->pluralize('order', $ordersCount)),
            CLogger::LEVEL_ERROR,
            'email_notification'
        );

        foreach ($orders as $order) {
            Yii::log(
                sprintf(
                    "Sending notification email about delayed Order #%s to Carrier #%s %s <%s>",
                    $order->id,
                    $order->carrier_id,
                    $order->carrier->fullname,
                    $order->carrier->email
                ),
                CLogger::LEVEL_INFO,
                'email_notification'
            );

            /** @var SwiftMailer $mailer */
            $mailer = Yii::app()->mailer;

            /** @var EmailTemplate $emailTemplateModel */
            $emailTemplateModel = EmailTemplate::model();
            $template = $emailTemplateModel->getEmailTemplateBySlug(EmailTemplate::TEMPLATE_ORDER_DELAYED);

            $replacements = [
                $order->carrier->email => [
                    '{{order}}' => CHtml::link('#'.$order->id, Yii::app()->createAbsoluteUrl('order/view', ['id' => $order->id])),
                    '{{carrier}}' => CHtml::link($order->carrier->fullname, Yii::app()->createAbsoluteUrl('order/view', ['id' => $order->carrier_id]))
                ]
            ];

            if ($template) {
                $mailer->setSubject($template->subject)
                    ->setBody($template->body)
                    ->setTo($order->carrier->email)
                    ->setDecoratorReplacements($replacements)
                    ->send();
            } else {
                Yii::log("Email template not found!", CLogger::LEVEL_ERROR, 'email_notification');

                return 1;
            }

        }

        echo "Done!" . PHP_EOL;

        return 0;
    }
}