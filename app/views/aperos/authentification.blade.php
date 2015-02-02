<div id='commentForm'>
    {{Form::open(['url'=>'authentification'])}}
        {{Session::get('message')}}
        <p>{{Form::label('name', 'Name')}}<br/>
        {{Form::text('name', Input::old('name'), array('placeholder'=>'your name'))}}</p>
        {{isset($errors)?'<p>'.$errors->first('name').'</p>': ''}}

        {{Form::label('password', 'password')}}<br/>
        {{Form::password('password', Input::old('password'), array('placeholder'=>'password'))}}
        {{isset($errors)?'<p>'.$errors->first('password').'</p>': ''}}

        {{Form::label('remember', 'Se souvenir de moi')}}
        {{Form::checkbox('remember', Input::old('remember'))}}
        {{isset($errors)?'<p>'.$errors->first('remember').'</p>': ''}}
        {{Form::submit('Log in!')}}
    {{Form::close()}}
</div>