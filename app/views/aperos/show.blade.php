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
    @if(!empty($apero))
        <h2>{{$apero->title}}</h2>
        <p>{{$apero->content}}</p>
    @endif
@stop