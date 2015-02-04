@extends('layouts.admin')

@section('title')
@parent
	@if(isset($title))
		{{{$title}}}
	@endif
@stop

@section('content')
    {{Session::get('messageAperoCreate')}}
    <div id='filterAperoForm'>
            {{Form::open(['url'=>'apero', 'files'=>true, 'method'=>'GET'])}}
                <p>{{Form::label('title', 'Title')}}<br/>
                @if(isset($_GET['title']))
                    {{Form::text('title', htmlentities($_GET['title']), array('placeholder'=>'titre'))}}</p>
                @else
                    {{Form::text('title', Input::old('title'), array('placeholder'=>'titre'))}}</p>
                @endif
                <br/>	
                {{Form::label( 'tag', 'Tag')}}
                @foreach(Tag::all() as $tag)
                    {{Form::label( $tag->id, $tag->name)}}
                    {{Form::checkbox($tag->id, Input::old($tag->id), isset($_GET[$tag->id]))}}
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