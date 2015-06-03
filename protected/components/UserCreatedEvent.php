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
    /**
     * Send message
     */
    public function sendNotification()
    {
        /** @var User $userCreated */
        $userCreated = $this->sender;

        /** @var SwiftMailer $mailer */
        $mailer = $this->getMailer();

        $emailTemplate = $this->getTemplate();
        if ($emailTemplate) {
            $replacements = [
                $userCreated->email => [
                    '{{login}}' => $userCreated->email,
                    '{{password}}' => $userCreated->realPassword,
                    '{{login_url}}' => Yii::app()->createAbsoluteUrl('site/login')
                ]
            ];

            $mailer->setSubject($emailTemplate->subject)
                ->addAddress($userCreated->email)
                ->setBody($emailTemplate->body)
                ->setDecoratorReplacements($replacements)
                ->send();
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
        return 'user_created';
    }
}