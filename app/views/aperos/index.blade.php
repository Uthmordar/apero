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
        {{Form::open(["",/*'url'=>'apero', 'method'=>'GET',*/ 'id'=>'form_index'])}}
            <p>{{Form::label('title', 'Title')}}<br/>
            {{Form::text('title', Input::old('title'), array('placeholder'=>'titre'))}}</p>
            <br/>	
            {{Form::label( 'tag', 'Tag')}}
            @foreach(Tag::all() as $tag)
                {{Form::label( $tag->id, $tag->name)}}
                {{Form::checkbox($tag->id, Input::old($tag->id), isset($_GET[$tag->id]))}}
            @endforeach
            {{Form::submit('Filtrer')}}
        {{Form::close()}}
    </div>
    @if(isset($links))
    <div id="pagination">
        {{$links}}
    </div>
    @endif
    <section id="aperos_list">
        @if(!empty($aperos))
        <ul>
            @foreach($aperos as $apero)
                <li><h2><a href="{{url('/apero/'.$apero->id)}}">{{$apero->title}}</a></h2></li>
            @endforeach
        </ul>
        @else
            <p>Pas d'apéro</p>
        @endif
    </section>
@stop

@section('script')
@parent
    <script type='text/javascript' src='{{asset('assets/js/dist/aperos.index.min.js')}}'></script>
@stop