<?php

use Nette\Mail\SmtpMailer;

class Mailer extends SmtpMailer {
    private String $host = '';
    private String $userName = '';
    private String $password = '';

    private String $encryptyon = '';
    private int $port;
    private SmtpMailer $mailer;
    /** Need call __construct with SMTP server setting */
    public function __construct($host = 'smtp.seznam.cz', $userName = 'testlocal', $password = '****', $encryptyon = 'ssl',$port = 465){
        $this->host = $host;
        $this->password = $password;
        $this->userName = $userName;
        $this->encryptyon = $encryptyon;
        $this->port = $port;

        $this->mailer = new SmtpMailer(
            host: $host,
            username: $userName,
            password: $password,
            port: $port,
            encryption: 'ssl',
        );
    }

}