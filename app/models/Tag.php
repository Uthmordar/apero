<?php

class Tag extends Eloquent{
    protected $guarded=['id'];
    
    /**
     * relationship 1->n tag->aperos
     * @return type
     */
    public function aperos(){
        return $this->hasMany('Apero');
    }
}