@if(Auth::check())
    <li {{HelperMenu::isHome()}}><a href="{{url('/')}}">Home</a></li>
    <li {{HelperMenu::isApRessource('apero')}}><a href="{{url('/apero')}}">Rechercher un apéro</a></li>
    <li {{HelperMenu::isApRessource('create')}}><a href="{{url('/apero/create')}}">Create Apero</a></li>
    <li {{HelperMenu::isPage('logOut')}}><a href="{{url('logOut')}}">Log out</a></li>
@else
    <li {{HelperMenu::isHome()}}><a href="{{url('/')}}">Home</a></li>
    <li {{HelperMenu::isApRessource('apero')}}><a href="{{url('/apero')}}">Rechercher un apéro</a></li>
    <li {{HelperMenu::isPage('logIn')}}><a href="{{url('login')}}">Log in</a></li>
@endif