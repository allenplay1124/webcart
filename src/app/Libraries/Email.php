<?php

namespace App\Libraries;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Email
{
    protected $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);
        $this->mail->CharSet = 'UTF-8';
        $this->mail->SMTPDebug = false;
        $this->mail->isSMTP();
        $this->mail->Host = env('email.SMTPHost');
        $this->mail->SMTPAuth = true;
        $this->mail->Username = env('email.SMTPUser');
        $this->mail->Password = env('email.SMTPPass');
        $this->mail->SMTPSecure = env('email.SMTPCrypto');
        $this->mail->Port = env('email.SMTPPort');
        $this->mail->IsHTML(true);
        $this->mail->setFrom(env('email.fromEmail'), env('email.fromName'));
    }

    public function from($address, $name)
    {
        return $this->mail->setFrom($address, $name);
    }

    public function setToAddress($address)
    {
        return $this->mail->addAddress($address);
    }

    public function setReplyTo($address)
    {
        return $this->mail->addReplyTo($address);
    }

    public function addCC($address)
    {
        return $this->mail->addCC($address);
    }

    public function addBCC($address)
    {
        return $this->mail->addBCC($address);
    }

    public function addAttachment($path)
    {
        return $this->mail->addAttachment($path);
    }

    public function isHTML($isHtml = true)
    {
        return $this->mail->isHTML($isHtml);
    }

    public function subject($subject)
    {
        return $this->mail->Subject = $subject;
    }

    public function body($body)
    {
        return $this->mail->msgHTML($body);
    }

    public function altbody($altbody)
    {
        return $this->mail->AltBody = $altbody;
    }

    public function send()
    {
        return $this->mail->send();
    }

    public function printDebugger()
    {
        return $this->mail->ErrorInfo;
    }
}
