<?php

namespace App\Mail;

use Config, Mail, Log;
use Swift_SmtpTransport;
use Swift_SendmailTransport;
use Swift_Mailer;

class MailConfig
{
    public function set($sender) {
        if(Config('mail.driver') == 'log') {
            return $this;
        }
        $settings = Config('mail.configurations.' . $sender);
        $transport = Swift_SmtpTransport::newInstance(Config('mail.host'), Config('mail.port'), Config('mail.encryption'));
        $transport->setUsername($settings['username']);
        $transport->setPassword($settings['password']);
        $mailer = new Swift_Mailer($transport);
        Mail::setSwiftMailer($mailer);

        Mail::alwaysFrom($settings['username'], Config::get('mail.from.name'));
        config(['mail.from.address' => $settings['username']]);

        return $this;
    }

    public function fallback() {
        if(Config('mail.driver') == 'log') {
            return $this;
        }
        $settings = Config('mail.fallback');
        $transport = Swift_SmtpTransport::newInstance(Config('mail.fallback.host'), Config('mail.fallback.port'), Config('mail.fallback.encryption'));
        $transport->setUsername($settings['username']);
        $transport->setPassword($settings['password']);
        $mailer = new Swift_Mailer($transport);
        Mail::setSwiftMailer($mailer);
        Mail::alwaysFrom($settings['from']['address'], $settings['from']['name']);
        config(['mail.from.address' => $settings['from']['address']]);

        return $this;
    }

    public function sendmail() {
        if(Config('mail.driver') == 'log') {
            return $this;
        }
        Config::set('mail.driver', 'sendmail');
        $transport = Swift_SendmailTransport::newInstance(Config('mail.sendmail'));
        $mailer = new Swift_Mailer($transport);
        Mail::setSwiftMailer($mailer);

        return $this;
    }
}