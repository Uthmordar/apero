<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

class AuthController extends BaseController{
    protected $users;
    
    public function __construct(User $user){
        $this->users=$user;
    }
    
    public function checkUser(){
        $validator=Validator::make(Input::all(), $this->users->getRules());
        if($validator->fails()){
            return Redirect::back()->withInput()->withErrors($validator);
        }else{
            $userData=[];
            $userData['name']=Input::get('name');
            $userData['password']=Input::get('password');
            $remember=Input::get('remember');

            if(Auth::attempt($userData, $remember)){
                return Redirect::to('/apero/create');
            }else{
                Session::flash('message', '<p>Pas de correspondance username/password.</p>');
                return Redirect::back();
            }
        }
    }

    public function logOut(){
        $user=Auth::user();
        $user->save();

        Auth::logout();
        return Redirect::to('/');
    }	
}