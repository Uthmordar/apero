<?php
use repositories\UserMailer as Mailer;
use repositories\UploadImage;

class AperoController extends \BaseController{

    protected $aperos;
    protected $mailer;
    protected $upload;

    public function __construct(Apero $apero, Mailer $mailer, UploadImage $uploadImage){
        $this->mailer=$mailer;
        $this->aperos=$apero;
        $this->upload=$uploadImage;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(){
        $aperos=$this->aperos->all();
        return View::make('aperos.index', compact('aperos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(){
        $tags=[];
        foreach(Tag::all() as $tag){
            $tags[$tag->id]=$tag->name;
        }
        return View::make('aperos.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(){
        $input=Input::all();
        $v=Validator::make($input, ['title' => 'required', 'date'=>'required']);
        if($v->fails()){
            return Redirect::route('apero.create')->withInput()->withErrors($v->messages());
        }

        $apero=new Apero;
        $apero->title=$input['title'];
        $apero->content=($input['content'])? $input['content'] : '';
        $apero->date=strtotime($input['date']);
        if(Input::hasfile('file')){
            $apero->url_thumbnail=$this->upload->uploadImage('messageAperoCreate', [120, 120]);
        }
        $apero->status='publish';
        if(!Tag::findOrFail($input['tag'])){
            Session::flash('messageAperoCreate', "<p class='error bg-danger'><span class='glyphicon glyphicon-remove' style='color:red;'></span>Problème de tag.</p>");
            return Redirect::back();
        }
        $apero->tag_id=intval($input['tag']);
        if(!Auth::user()){
            throw new \RuntimeException('No user');
        }
        $apero->user_id=Auth::user()->id;
        $apero->save();
        
        $user=Auth::user();
        $this->mailer->warnApero($user, $apero->title);
        $this->mailer->warnAdminApero($user, $apero->title);
        
        return Redirect::to('apero')
                        ->with('message', 'success');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id){
        $apero=Apero::findOrFail($id);
        return View::make('aperos.show', compact('apero'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id){
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id){
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id){
        
    }
}
