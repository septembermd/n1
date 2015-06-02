<?php
/**
 * Created by PhpStorm.
 * User: september
 * Date: 5/27/15
 * Time: 9:29 AM
 */

/**
 * Class UserCreatedEvent
 */
class UserCreatedEvent extends NotificationEvent
{
    const MESSAGE_TEMPLATE = 'user_created';

    /**
     * @param mixed|null $sender
     * @param null $options
     */
    public function __construct($sender, $options = null)
    {
        parent::__construct($sender, $options);
    }

    /**
     * Send message
     */
    public function sendNotification()
    {
        /** @var User $userCreated */
        $userCreated = $this->sender;

        /** @var SwiftMailer $mailer */
        $mailer = $this->getMailer();

        $emailTemplate = EmailTemplate::model()->findByAttributes(['slug' => self::MESSAGE_TEMPLATE]);
        if ($emailTemplate) {
            $replacements = [
                '{{login}}' => $userCreated->email,
                '{{password}}' => $userCreated->password,
                '{{login_url}}' => Yii::app()->createAbsoluteUrl('user/login')
            ];

            $mailer->setSubject($emailTemplate->subject)
                ->addAddress($userCreated->email)
                ->setBody($emailTemplate->body)
                ->setDecoratorReplacements($replacements)
                ->send();
        }
    }
}