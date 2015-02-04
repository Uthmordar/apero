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
                <figure>
                    <img src="{{asset('../uploads/'.$apero->url_thumbnail)}}" alt="acc"/>
                </figure>
                @endif
                <p>{{$apero->content}}</p>
                <div class="clear"></div>
                <p class="date">Date: {{HelperDate::timeToStr('d F Y', $apero->date)}}</p>
            </article>
            @if($apero->tag)
                <p>{{$apero->tag->name}} ({{$apero->tag->count_apero}})<br/>
                 PHPUnit is a unit testing framework for the PHP programming language. It is
                 an instance of the xUnit architecture for unit testing frameworks that originated with 
                 SUnit and became popular wuth lUnit</p>
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