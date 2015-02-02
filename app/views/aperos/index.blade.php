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
        <li {{HelperBlog::isPage('list_apero')}}><a href="{{url('/list_apero')}}">Rechercher un apéro</a></li>
        <li {{HelperBlog::isPage('create_apero')}}><a href="{{url('/create_apero')}}">Create Apero</a></li>
        <li><a href="{{url('page/logOut')}}" {{HelperBlog::isPage('logOut')}}>Log out</a></li>
    @endif
@stop

@section('content')
    @if(!empty($aperos))
        @foreach($aperos as $apero)
        <h2>{{$apero->title}}</h2>
        @endforeach
    @else
    <p>Pas d'apéro</p>
    @endif
@stop