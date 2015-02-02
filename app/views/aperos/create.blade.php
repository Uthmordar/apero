@extends('layouts.admin')

@section('title')
@parent
	@if(isset($title))
		{{{$title}}}
	@endif
@stop

@section('menu')
    @if(Auth::check())
            <li><a href="{{url('/')}}" {{HelperBlog::isHome()}}>Home</a></li>
            <li><a href="{{url('/liste_apero')}}" {{HelperBlog::isPage('liste_aperos')}}>Rechercher un apéro</a></li>
            <li {{HelperBlog::isPage('create_apero')}}><a href="{{url('/create_apero')}}">Create Apero</a></li>
            <li><a href="{{url('page/logOut')}}" {{HelperBlog::isPage('logOut')}}>Log out</a></li>
    @endif
@stop


@section('content')
    @if(Auth::check())
        <div id='addAperoForm'>
            {{Form::open(['url'=>'apero', 'files'=>true, 'method'=>'POST'])}}
                {{Session::get('messageAperoCreate')}}
                <p>{{Form::label('title', 'Title')}}<br/>
                {{Form::text('title', Input::old('tile'), array('placeholder'=>'titre', 'required'))}}</p>
                {{isset($errors)?'<p>'.$errors->first('title').'</p>': ''}}
                <br/>	
                {{Form::label('date', 'Date')}}<br/>
                {{Form::input('date', 'date') }}
                <br/>
                {{Form::label('content', 'Content')}}<br/>
                {{Form::textarea('content', Input::old('content'), array('placeholder'=>'mon contenu', 'class'=>'ckeditor'))}}
                {{isset($errors)?'<p>'.$errors->first('content').'</p>': ''}}
                <br/>
                {{Form::label('thumbnail', 'Thumbnail')}}
                {{Form::file('file', array('multiple'=>false))}}
                {{isset($errors)?'<p>'.$errors->first('images').'</p>':''}}
                <br/>
                {{Form::label( 'tag', 'Tag')}}
                {{Form::select('tag', $tags)}}
                {{Form::submit('Créer')}}
            {{Form::close()}}
        </div>
    @endif
@stop