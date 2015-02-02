@include('includes.headAdmin')

<body>
    <nav class="menu">
        <ul>
            @section('menu')
            @include('includes.menu')
            @show
        </ul>
    </nav>

    <div id='content'>
        @if(Auth::check())
        @endif
        @yield('content')
    </div>



    @if(isset($debug))
    @foreach($debug as $d)
<li>{{$d}}</li>
@endforeach
@endif


@include('includes.footer')

@section('script')

@show

</body>
</html>

