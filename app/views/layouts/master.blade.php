	@include('includes.head')

<body>
	<div class="menu">
		<div class="container clearfix">

			<a href="http://localhost/l4/public"><div id="logo" class="grid_3">
				<img src="{{asset('asset/images/logo.png')}}">
			</div>
			</a>

			<div id="nav" class="grid_9 omega">
				<ul class='menuCat'>
				<!-- <ul class="navigation">
					<li data-slide="1">Top Slide</li>
					<li data-slide="2">Parallax Scrolling</li>
					<li data-slide="3">Grid</li>
					<li data-slide="4">Credits</li> -->
					@section('menu')
						@include('includes.menu')
					@show
				</ul>
			</div>
		</div>
	</div>

	<div class="slide" id="slide2" data-slide="2" data-stellar-background-ratio="0.5">
		<div class="container clearfix">

			<div id="content" class="grid_12">
				@if(Auth::check())
					<p>{{trans('blog.welcome')}} {{Auth::user()->username}}</p>
				@endif
				<h1>Parallax Scrolling</h1>
				<h2>What you've seen its called parallax scrolling</h2>
				<br/>
				@yield('content')
			</div>

		</div>
	</div>



	<div class="slide" id="slide3" data-slide="3" data-stellar-background-ratio="0.5">
		<div class="container clearfix">
			@if(isset($debug))
				@foreach($debug as $d)
					<li>{{$d}}</li>
				@endforeach
			@endif

			<div id="content" class="grid_12">
				<h1>Grid</h1>
				<h2>See how the grid changes when you resize your screen</h2>
			</div>
		</div>
	</div>



	@include('includes.footer')
	
	@if($debug=DB::getQueryLog())
		{{dd($debug)}}
	@endif
</body>
</html>