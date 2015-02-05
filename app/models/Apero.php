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
    
    /**
     * create apero from /apero/create
     * @param type $apero
     * @param type $input
     * @return type
     * @throws \RuntimeException
     */
    public function createApero($apero, $input, $uploader){
        $apero->title=$input['title'];
        $apero->content=($input['content'])? $input['content'] : '';
        $apero->date=strtotime($input['date']);
        if(Input::hasfile('file')){
            $apero->url_thumbnail=$uploader->uploadImage(Input::file('file'), 'messageAperoCreate', [120, 120]);
        }
        $apero->status='publish';
        if(!Tag::findOrFail($input['tag'])){
            Session::flash('messageAperoCreate', "<p class='error bg-danger'><span class='glyphicon glyphicon-remove' style='color:red;'></span>Problème de tag.</p>");
            throw new \RuntimeException('No tag');
        }
        $apero->tag_id=intval($input['tag']);
        $apero->user_id=Auth::user()->id;
        $apero->created_at=time();
        return $apero;
    }
}