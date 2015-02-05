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
            {{Session::get('messageAperoCreate')}}
            <div id='filterAperoForm'>
                {{Form::open(['id'=>'form_index', 'class'=>'form-horizontal'])}}
                    <div class="control-group">
                        {{Form::label('title', 'Title')}}
                        {{Form::text('title', Input::old('title'), array('placeholder'=>'titre'))}}
                    </div>
                    
                    <div class="control-group">
                        {{Form::label( 'tag', 'Tag')}}
                        @foreach(Tag::all() as $tag)
                            <div>
                                {{Form::label( $tag->id, $tag->name)}}
                                {{Form::checkbox($tag->id, Input::old($tag->id), isset($_GET[$tag->id]))}}
                            </div>
                        @endforeach
                    </div>
                    {{Form::submit('Filtrer', array('class'=>'btn btn-primary'))}}
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

@section('script')
@parent
    <script type='text/javascript' src='{{asset('assets/js/dist/aperos.index.min.js')}}'></script>
@stop