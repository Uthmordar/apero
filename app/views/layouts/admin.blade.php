@include('includes.headAdmin')

<body>
    <section id="wrapper">
        <header id="header">
            <h1 id="logo">Apéros Techniques</h1>
            <nav class="menu">
                <ul>
                    @section('menu')
                        @if(Auth::check())
                            <li><a href="{{url('/')}}" {{HelperBlog::isHome()}}>Home</a></li>
                            <li {{HelperBlog::isApRessource('apero')}}><a href="{{url('/apero')}}">Rechercher un apéro</a></li>
                            <li {{HelperBlog::isApRessource('create')}}><a href="{{url('/apero/create')}}">Create Apero</a></li>
                            <li><a href="{{url('logOut')}}" {{HelperBlog::isPage('logOut')}}>Log out</a></li>
                        @else
                            <li><a href="{{url('/')}}" {{HelperBlog::isHome()}}>Home</a></li>
                            <li {{HelperBlog::isApRessource('apero')}}><a href="{{url('/apero')}}">Rechercher un apéro</a></li>
                            <li><a href="{{url('login')}}" {{HelperBlog::isPage('logIn')}}>Log in</a></li>
                        @endif
                    @show
                </ul>
            </nav>
        </header>

        <section id='content'>
            @if(Auth::check())
            @endif
            @yield('content')
        </section>

        @include('includes.footer')

        @section('script')

        @show
    </section>
</body>
</html>

