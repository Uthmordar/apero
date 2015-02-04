<?php
namespace repositories;
use User;

class UserMailer extends Mailer{
    public function warnApero(User $user, $title){
        $view="emails.warn";
        $data=['title'=>$title];
        $subject="Nouvel apéro posté";
        $userMail=($user->email)? $user->email : "tanguyrygodin@gmail.com";
        
        return $this->sendTo($userMail, $subject, $view, $data);
    }
    
    public function warnAdminApero(User $user, $title){
        $view="emails.warn_admin";
        $data=['title'=>$title,'user'=>$user];
        $subject="Un nouvel apéro a été ajouté sur apéro";
        $adminMail="tanguyrygodin@gmail.com";
        
        return $this->sendTo($adminMail, $subject, $view, $data);
    }
}