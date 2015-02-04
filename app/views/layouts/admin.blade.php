@include('includes.headAdmin')

<body>
    <section id="wrapper">
        <header id="header">
            <h1 id="logo">Apéros Techniques</h1>
            @if(Auth::check())
                Welcome, {{Auth::user()->name}}
            @endif
            <nav class="menu">
                <ul>
                    @section('menu')
                        @include('includes.menu')
                    @show
                </ul>
            </nav>
        </header>

        <section id='content'>
            @yield('content')
        </section>

        @include('includes.footer')

        @section('script')

        @show
    </section>
</body>
</html>

