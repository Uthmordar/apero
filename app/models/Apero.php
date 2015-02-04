<?php

class Apero extends Eloquent{
    protected $guarded=['id'];
    protected $fillable=['title', 'content', 'date'];
    protected $filter=[
            'title'=>'required',
            'date'=>'required',
            'image'=>'image|mime:jpg,png,gif,jpeg|max:3000'
        ];
    
    public static function boot(){
        parent::boot();
        Apero::observe(new AperoObserver);
    }
    
    /**
     * relation n->1  aperos->user
     * @return type
     */
    public function user(){
        return $this->belongsTo('User');
    }
    
    /**
     * relation n->1 aperos->tag
     * @return type
     */
    public function tag(){
        return $this->belongsTo('Tag');
    }
    
    /**
     * give number of aperos linked to apero tag
     * @param type $apero
     */
    public function tagCount(){
        if($this->tag){
            $this->tag->count_apero=$this->tag->aperos()->count();
            $this->tag->save();
        }
    }

    /**
     * filter for create form field
     * @return type
     */
    public function filter(){
        return $this->filter;
    }
}