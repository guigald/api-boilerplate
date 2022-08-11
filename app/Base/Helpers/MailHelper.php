<?php

namespace App\Base\Helpers;

use Exception;
use SendGrid;
use SendGrid\Mail\Mail;
use Throwable;

class MailHelper
{
    /**
     * @param string $subject
     * @param string $emailTo
     * @param string $nameTo
     * @param string $message
     * @throws Exception
     */
    public function sendMail(
        string $subject,
        string $emailTo,
        string $nameTo,
        string $message
    ): void {
        $mail = new Mail();

        try {
            $mail->setFrom(
                env('SENDGRID_FROM_EMAIL'),
                env('SENDGRID_FROM_NAME')
            );

            $mail->setSubject($subject);
            $mail->addTo($emailTo, $nameTo);
            $mail->addContent('text/html', $message);

            $sendgrid = new SendGrid(getenv('SENDGRID_API_KEY'));

            $sendgrid->send($mail);
        } catch (Throwable $t) {
            throw new Exception($t->getMessage());
        }
    }
}
