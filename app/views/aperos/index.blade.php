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
        <li {{HelperBlog::isPage('list_apero')}}><a href="{{url('/apero')}}">Rechercher un apéro</a></li>
        <li {{HelperBlog::isPage('create_apero')}}><a href="{{url('/create_apero')}}">Create Apero</a></li>
        <li><a href="{{url('logOut')}}" {{HelperBlog::isPage('logOut')}}>Log out</a></li>
    @else
        <li><a href="{{url('/')}}" {{HelperBlog::isHome()}}>Home</a></li>
        <li {{HelperBlog::isPage('list_apero')}}><a href="{{url('/apero')}}">Rechercher un apéro</a></li>
        <li><a href="{{url('login')}}" {{HelperBlog::isPage('logIn')}}>Log in</a></li>
    @endif
@stop

@section('content')
    <div id='filterAperoForm'>
            {{Form::open(['url'=>'apero', 'files'=>true, 'method'=>'GET'])}}
                <p>{{Form::label('title', 'Title')}}<br/>
                {{Form::text('title', Input::old('title'), array('placeholder'=>'titre'))}}</p>
                <br/>	
                {{Form::label( 'tag', 'Tag')}}
                @foreach(Tag::all() as $tag)
                    {{Form::label( $tag->name, $tag->name)}}
                    {{Form::checkbox($tag->name, Input::old($tag->id), isset($_GET[$tag->id]))}}
                @endforeach
                {{Form::submit('Filtrer')}}
            {{Form::close()}}
        </div>
    @if(!empty($aperos))
        @if(isset($links))
        <div id="pagination">
            {{$links}}
        </div>
        @endif
        @foreach($aperos as $apero)
        <h2><a href="{{url('/apero/'.$apero->id)}}">{{$apero->title}}</a></h2>
        @endforeach
    @else
    <p>Pas d'apéro</p>
    @endif
@stop