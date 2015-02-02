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
}