<?php
/**
 * Created by Victor Davydov <septembermd@gmail.com>
 * Date: 6/3/15
 * Time: 8:34 AM
 */

/**
 * Class OrderBidWithdrawnEvent
 */
class OrderBidWithdrawnEvent extends NotificationEvent
{
    protected $controller;

    protected $form;

    /**
     * @param mixed|null $sender
     * @param OrderBidWithdrawForm $form
     * @param OrderBidsController $controller
     * @param array|null $options
     */
    public function __construct($sender, OrderBidWithdrawForm $form, OrderBidsController $controller,  $options = null)
    {
        $this->controller = $controller;
        $this->form = $form;
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

        $emailTemplate = $this->getTemplate();
        if ($emailTemplate) {
            $currentUser = $this->controller->acl->getUser();

            /** @var SwiftMailer $mailer */
            $mailer = $this->getMailer();
            $mailer->setSubject($emailTemplate->subject)
                ->setBody($emailTemplate->body);

            $replacements = [];
            $users = [$orderBid->user->email];

            $supervisors = User::model()->findAllSupervisors();
            foreach ($supervisors as $supervisor) {
                $users[] = $supervisor->email;
            }

            $mailer->addAddress($users);
            
            $orderAbsoluteUrl = Yii::app()->createAbsoluteUrl('order/view', ['id' => $orderBid->id]);
            foreach ($users as $email) {
                $replacements[$email] = [
                    '{{order}}' => CHtml::link('#'.$orderBid->id, $orderAbsoluteUrl),
                    '{{carrier}}' => CHtml::link($orderBid->user->fullname, Yii::app()->createAbsoluteUrl('user/view', ['id' => $currentUser->id])),
                    '{{reason}}' => $this->form->reason,
                    '{{bids_url}}' => CHtml::link(Yii::app()->createAbsoluteUrl('orderBids/index'), Yii::app()->createAbsoluteUrl('orderBids/index'))
                ];
            }
            $mailer->setDecoratorReplacements($replacements)
                ->send();

            Yii::log(
                sprintf(
                    'Sent email notification about withdrawn order bid for order #%s by user #%s. Reason: %s',
                    $orderBid->order_id, $orderBid->user_id,
                    $this->form->reason
                )
            );

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
        return 'order_bid_withdrawn';
    }
}