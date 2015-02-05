@extends('layouts.admin')

@section('title')
@parent
	@if(isset($title))
		{{{$title}}}
	@endif
@stop

@section('content')
    <div class="aperos_index">
        <section id="main_content">
            @if(Auth::check())
                <div id='addAperoForm'>
                    {{Form::open(['url'=>'apero', 'files'=>true, 'method'=>'POST'])}}
                        {{Session::get('messageAperoCreate')}}
                        <div class="control-group">
                            {{Form::label('title', 'Title')}}
                            {{Form::text('title', Input::old('title'), array('placeholder'=>'titre', 'required'))}}
                            {{isset($errors)?'<p>'.$errors->first('title').'</p>': ''}}
                        </div>
                        <div class="control-group">	
                            {{Form::label('date', 'Date')}}
                            {{Form::input('date', 'date')}}
                        </div>
                        <div class="control-group">
                            {{Form::label('content', 'Content')}}<br/>
                            {{Form::textarea('content', Input::old('content'), array('placeholder'=>'mon contenu', 'class'=>'ckeditor'))}}
                            {{isset($errors)?'<p>'.$errors->first('content').'</p>': ''}}
                        </div>
                        <div class="control-group">
                            {{Form::label('thumbnail', 'Thumbnail')}}
                            {{Form::file('file', array('multiple'=>false))}}
                            {{isset($errors)?'<p>'.$errors->first('images').'</p>':''}}
                        </div>
                        <div class="control-group">
                            {{Form::label( 'tag', 'Tag')}}
                            {{Form::select('tag', $tags)}}
                        </div>
                        {{Form::submit('Submit', array('class'=>'btn btn-primary'))}}
                    {{Form::close()}}
                </div>
            @endif
        </section>
        <aside class="left">
            @if(Lang::has('aside.concept_title'))
                <h3>{{Lang::get('aside.concept_title')}}</h3>
            @endif
            @if(Lang::has('aside.concept'))
                <p>
                {{Lang::get('aside.concept')}}
                </p>
            @endif
        </aside>
        <div class="clear"></div>
    </div>
@stop