@if(isset($menuCat))
	@if(Auth::check())
		<li><a href="{{url('page/logOut')}}" {{HelperBlog::isPage('logOut')}}>Log out</a></li>
	@else
		<li><a href="{{url('page/log')}}" {{HelperBlog::isPage('log')}}>Log in</a></li>
	@endif
	<li><a href="{{url('page/users')}}" {{HelperBlog::isPage('users')}}>Users</a></li>
	<li><a href="{{url('page/contact')}}" {{HelperBlog::isPage('contact')}}>Contact</a></li>
	@if(Auth::check())
		<li><a href="{{url('page/profile')}}" {{HelperBlog::isPage('profile')}}>Profile</a></li>
	@endif
	@foreach($menuCat as $cat)
		<li><a href="{{url('cat/'.$cat->id)}}" {{HelperBlog::isCat($cat->id)}}>{{$cat->title}}</a></li>
	@endforeach
@endif