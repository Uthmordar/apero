<?php
class AperoObserver{
    public function saved($apero){
        $this->addCount($apero);
        $this->sendWarnMail($apero);
    }
    
    protected function addCount($apero){
        if($apero->tag){
            $apero->tag->count_apero=$apero->tag->count_apero + 1;
            $apero->tag->save();
        }
    }
    
    protected function sendWarnMail($apero){
        Mail::send('emails.warn', array('title'=>$apero->title), function($message){
            $message->from('us@example.com', 'Laravel Apero');
            $message->to('tanguyrygodin@gmail.com', 'Tanguy Godin')->subject('Nouvel événement!');
        });
    }
}