<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

class AuthController extends BaseController {
	
    public function checkUser(){
        $rules=array(
            'name'=>'required',
            'password'=>'required'
        );

        $validator=Validator::make(Input::all(), $rules);
        if($validator->fails()){
            return Redirect::back()->withInput()->withErrors($validator);
        }else{
            $userData= array();
            $userData['name']=Input::get('name');
            $userData['password']=Input::get('password');
            $remember=Input::get('remember');

            if(Auth::attempt($userData, $remember)){
                return Redirect::to('/create_apero');
            }else{
                Session::flash('message', '<p>Pas de correspondance username/password.</p>');
                return Redirect::back();
            }
        }
    }

    public function logOut(){
        $user=Auth::user();
        $user->updated_at=Carbon::now();
        $user->save();

        Auth::logout();
        return Redirect::to('/');
    }	
}