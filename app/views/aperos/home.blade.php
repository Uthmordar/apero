@extends('layouts.admin')

@section('title')
@parent
	@if(isset($title))
            {{{$title}}}
	@endif
@stop

@section('content')
    <div class="home">
        <section id="last_apero" class="left">
            <article>
                <h2><a href="{{url('/apero/'.$apero->id)}}">{{$apero->title}}</a></h2>
                @if($apero->url_thumbnail)
                    <img src="{{asset('../uploads/_min/'.$apero->url_thumbnail)}}"/>
                @endif
                <p>{{$apero->content}}</p>
            </article>
            <p>{{$tag->name}} ({{$tag->count_apero}})<br/>
             PHPUnit is a unit testing framework for the PHP programming language. It is
             an instance of the xUnit architecture for unit testing frameworks that originated with 
             SUnit and became popular wuth lUnit</p>
        </section>
        <aside class="left">
            <h3>Les apéros</h3>
            <p>Description...</p>
        </aside>
        <div class="clear"></div>
    </div>
@stop