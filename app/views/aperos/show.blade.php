@extends('layouts.admin')

@section('title')
@parent
	@if(isset($title))
		{{{$title}}}
	@endif
@stop

@section('content')
    @if(!empty($apero))
        <h2>{{$apero->title}}</h2>
        <p>{{$apero->content}}</p>
    @endif
@stop