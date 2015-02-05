<?php
use repositories\UserMailer as Mailer;
use repositories\UploadImage;

class AperoController extends \BaseController{

    protected $aperos;
    protected $mailer;
    protected $upload;
    protected $users;

    public function __construct(Apero $apero, Mailer $mailer, UploadImage $uploadImage, User $user){
        $this->mailer=$mailer;
        $this->aperos=$apero;
        $this->upload=$uploadImage;
        $this->users=$user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(){
        $data=Input::all();
        if(Request::ajax()){
            if($data['token']!=Session::token()){
                return false;
            }
            $title=($data['title'])? strip_tags(trim($data['title'])): '';
            $tags=(!empty($data['tags']))? $data['tags'] : [];
            $cat=[];
            foreach($tags as $tag){
                $tag=intval($tag);
                if(is_int($tag) && Tag::find($tag)){
                    $cat[]=$tag;
                }
            }
            if(!empty($cat)){
                $aperos=DB::table('aperos')->whereIn('tag_id', $cat)->where('title', 'LIKE', "%" . $title . "%")->orderBy('created_at', 'desc')->get();
            }else{
                $aperos=DB::table('aperos')->where('title', 'LIKE', "%" . $title . "%")->orderBy('created_at', 'desc')->get();
            }

            $result=[];
            foreach($aperos as $apero){
                $result[]="<li><h2><a href='" . url('/apero/'.$apero->id) . "'>" . $apero->title . "</a></h2></li>";
            }
            
            return $result; die();
        }
        
        $aperos=DB::table('aperos')->orderBy('created_at', 'desc')->paginate(3);
        $links=$aperos->links();
        return View::make('aperos.index', ['aperos'=>$aperos, 'links'=>$links]);
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
        if(!Auth::user()){
            Session::flash('messageAperoCreate', "<p class='error bg-danger'><span class='glyphicon glyphicon-remove' style='color:red;'></span>Auth user required.</p>");
            throw new \RuntimeException('No user');
        }
        
        $input=Input::all();
        
        foreach($input as $k=>$v){
            if(is_string($v)){
                $input[$k]=strip_tags($v);
            }
        }

        $v=Validator::make($input, $this->aperos->filter());
        if($v->fails()){
            return Redirect::route('apero.create')->withInput()->withErrors($v->messages());
        }

        $apero=new Apero;
        try{
            $this->aperos->createApero($apero, $input, $this->upload);
        }catch(RuntimeException $e){
            return Redirect::route('apero.create');
        }
        $apero->save();
        
        $user=Auth::user();
        $this->mailer->warnApero($user, $apero->title);
        $this->mailer->warnAdminApero($user, $apero->title);
        
        Session::flash('messageAperoCreate', "<p class='success bg-success'><span class='glyphicon glyphicon-ok' style='color:green;'></span>Success</p>");
        return Redirect::to('apero')->with('message', 'success');
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
        try{
            if($this->users->isCanEdit($id)){
                Apero::destroy($id);
                Session::flash('messageAperoCreate', "<p class='success bg-success'><span class='glyphicon glyphicon-ok' style='color:green;'></span>Success in deleting/p>");
                return Redirect::to('/aperos.index');
            }
        }catch (RuntimeException $e){
            Session::flash('messageAperoDelete', "<p class='error bg-danger'><span class='glyphicon glyphicon-remove' style='color:red;'></span>". $e->getMessage() . "</p>");
            return Redirect::back();
        }
    }
}