<?php

class Tag extends Eloquent{
    protected $guarded=['id'];
    
    public function aperos(){
        return $this->hasMany('Apero');
    }
}