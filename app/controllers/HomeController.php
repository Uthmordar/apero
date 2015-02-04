<?php

class HomeController extends BaseController {
    /*
    |--------------------------------------------------------------------------
    | Default Home Controller
    |--------------------------------------------------------------------------
    |
    | You may wish to use controllers instead of, or in addition to, Closure
    | based routes. That's great! Here is an example controller method to
    | get you started. To route to this controller, just add the route:
    |
    |	Route::get('/', 'HomeController@showWelcome');
    |
    */
    public function showHome(){
        $apero=DB::table('aperos')->orderBy('created_at', 'desc')->first();
        $ap=Apero::findOrFail($apero->id);

        return View::make('aperos.home', ['title'=>'Homepage', 'apero'=>$ap]);
    }

    public function createApero(){
        return View::make('aperos.create');
    }
}
