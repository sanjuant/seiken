<?php

namespace AppBundle\Services\Mail;

use Swift_Mailer;
use Swift_Message;

class SmartMailer implements MailerInterface
{
    private $sender, $recipient, $object, $message;

    private $mailer;

    public function __construct(Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function setSender(string $email): MailerInterface
    {
        $this->sender = $email;

        return $this;
    }

    public function setRecipient($email): MailerInterface
    {
        $this->recipient = $email;

        return $this;
    }

    public function setObject(string $object): MailerInterface
    {
        $this->object = $object;

        return $this;
    }

    public function setMessage(string $message): MailerInterface
    {
        $this->message = $message;

        return $this;
    }

    public function send(): bool
    {
        $message = Swift_Message::newInstance()
                                ->setSubject($this->object)
                                ->setFrom($this->sender)
                                ->setTo($this->recipient)
                                ->setBody($this->message)
        ;

        $err = [];
        $this->mailer->send($message, $err);

        return count($err) == 0;
    }
}