<?php

namespace repositories;

use Illuminate\Mail\Mailer;

class AperoMailer implements AperoMailerInterface{
    protected $header;
    
    public function setHeader(array $header){
        $this->header=$header;
    }
    
    public function send($tpl, $message){
        if(!empty($this->header)){
            throw new \RuntimeException('no header!');
        }
        Mailer::send($tpl, $message, function($message){
            $message->to();
        });
    }
}