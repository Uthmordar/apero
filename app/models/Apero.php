<?php

class Apero extends Eloquent{
    protected $guarded=['id'];
    protected $fillable=['title', 'content', 'date'];
    
    public static function boot(){
        parent::boot();
        Apero::observe(new AperoObserver);
    }
    
    public function user(){
        return $this->belongsTo('User');
    }
    
    public function tag(){
        return $this->belongsTo('Tag');
    }
    
    /**
     * 
     * @param type $apero
     */
    public function tagCount(){
        if($this->tag){
            $this->tag->count_apero=$this->tag->aperos()->count();
            $this->tag->save();
        }
    }
    /**
     * 
     * @param type $apero
     */
    public function sendWarnMail(){
        Mail::queue('emails.warn', array('title'=>$this->title), function($message){
            $message->from('us@example.com', 'Laravel Apero');
            $message->to('tanguyrygodin@gmail.com', 'Tanguy Godin')->subject('Nouvel événement!');
        });
    }
    
    public function filter(){
        return ['title' => 'required', 'date'=>'required', 'file'=> 'mimes:jpeg,bmp,png'];
    }
}