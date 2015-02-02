<?php

namespace repositories;
use Mail;

abstract class Mailer implements MailerInterface{
    public function sendTo($userMail, $subject, $view, $data=[]){
        Mail::queue($view, $data, function($message) use($userMail, $subject){
            $message->to($userMail)->subject($subject);
        });
    }
}