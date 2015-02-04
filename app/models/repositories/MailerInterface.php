<?php
namespace repositories;

interface MailerInterface{
    function sendTo($userMail, $subject, $view, $data);
}