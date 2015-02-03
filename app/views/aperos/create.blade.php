@extends('layouts.admin')

@section('title')
@parent
	@if(isset($title))
		{{{$title}}}
	@endif
@stop

@section('content')
    @if(Auth::check())
        <div id='addAperoForm'>
            {{Form::open(['url'=>'apero', 'files'=>true, 'method'=>'POST'])}}
                {{Session::get('messageAperoCreate')}}
                <p>{{Form::label('title', 'Title')}}<br/>
                {{Form::text('title', Input::old('title'), array('placeholder'=>'titre', 'required'))}}</p>
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
                {{Form::submit('Submit')}}
            {{Form::close()}}
        </div>
    @endif
@stop