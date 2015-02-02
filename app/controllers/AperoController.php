<?php
use repositories\AperoMailer;

class AperoController extends \BaseController{

    protected $aperos;
    protected $mailer;

    public function __construct(Apero $apero, \repositories\AperoMailerInterface $mailer){
        $this->mailer=$mailer;
        $this->aperos=$apero;
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
            $apero->url_thumbnail=$this->uploadImage();
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
        
        $apero->sendWarnMail();
        
        return Redirect::to('apero')
                        ->with('message', 'success');
    }
    
    public function uploadImage(){
        if(Input::hasfile('file')) {
            $file = Input::file('file');
            $files = [$file];
            $rules = ['image' => 'image|mime:jpg,png,gif, jpeg|max:3000'];
            $validator = Validator::make($files, $rules);

            $fileTrueName = $file->getClientOriginalName();
            $fileExtension = $file->getClientOriginalExtension();
            $fileThumb = $file;

            $destinationPath = 'public/uploads/';
            $filename = str_random(15) . '.' . $fileExtension;

            $thumbPath = $destinationPath . '_min/' . $filename;
            // fonction de resize des images
            HelperImage::thumb($fileThumb, 50, 50, $thumbPath);

            $upload_success = $file->move($destinationPath, $filename);

            if ($upload_success) {
                return $filename;
            }else{
                Session::flash('messageAperoCreate', "<p class='error bg-danger'><span class='glyphicon glyphicon-remove' style='color:red;'></span>Problème d'upload.</p>");
                return Redirect::back();
            }
        }
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        
    }

}
