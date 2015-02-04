<?php
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {
    use UserTrait, RemindableTrait;
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table='users';
    /**
     * The attributes excluded from the model's JSON form.
     * @var array
     */
    protected $hidden=['password', 'remember_token'];
    protected $rules=[
            'name'=>'required',
            'password'=>'required'
        ];
    
    public function getRules(){
        return $this->rules;
    }
    /**
     * relationship 1->n user->aperos
     * @return type
     */
    public function aperos(){
        return $this->hasMany('Apero');
    }
    
    /**
     * check if user can edit/delete apero
     * @param type $post
     * @return type
     */
    public static function isCanEdit($aperoId){
        $user=Auth::user();
        $role=$user->role;
        if($role=="admin"){
            return self::adminDeleting();
        }else if($role=="editor"){
            return self::editorDeleting();
        }else if($role=="author"){
            return self::authorDeleting($aperoId);
        }
    }
    
    protected static function adminDeleting(){
        return true;
    }
    
    protected static function editorDeleting(){
        return true;
    }
    
    protected static function authorDeleting($aperoId){
        if(Apero::findOrFail($aperoId)->user_id==Auth::id()){
            return true;
        }
        throw new RuntimeException("Author can't delete others users posts");
    }
}