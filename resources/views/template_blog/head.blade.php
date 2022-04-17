<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta name="description" content="">
	<title>@yield('title','MotoOto')</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700%7CMuli:400,700" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href=" {{asset('frontend/css/bootstrap.min.css')}} " />

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="{{asset('frontend/css/font-awesome.min.css')}}">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="{{asset('frontend/css/style.css')}}" />

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

</head>

<body>
	<!-- HEADER -->
	<header id="header">
		<!-- NAV -->
		<div id="nav">
			<!-- Top Nav -->
			<div id="nav-top">
				<div class="container">


					<!-- logo -->
					<div class="nav-logo">
						<a href="{{ url('') }}" class=""><img src="" alt="">
							<h1 style="margin-top: 20px;">your<span style="color: #6D7E98;">skin</span>dose</h1>
						</a>
					</div>
					<!-- /logo -->

					<!-- search & aside toggle -->
					<div class="nav-btns">
						<a href="{{ route('blog.list') }}" style="margin-right:10px; color:#90A8BC; font-weight:bold;">Product</a>
						<div class="dropdown">
							<button class="dropbtn">Category</button>
							<div class="dropdown-content">
								@foreach ($category_widget as $result)
								<a href="{{ route('blog.category', $result->slug) }}">{{$result->name}}</a>
								@endforeach
							</div>
						</div>
						<div class="dropdown" style="margin-right:10px;">
							<button class="dropbtn">Ingredients</button>
							<div class="dropdown-content">
								@foreach ($tag_widget as $result4)
								<a href="{{ route('blog.tag', $result4->slug) }}">{{$result4->name}}</a>
								@endforeach
							</div>
						</div>
						<a href="{{route('compare')}}" style="margin-right:10px; color:#90A8BC; font-weight:bold;">Compare</a>
						<button class="search-btn"><i class="fa fa-search" style="color:#90A8BC;"></i></button>
						<div id="nav-search">
							<form action=" {{route('blog.search')}} " method="get">
								<input class="input" name="search" placeholder="Enter your search...">
							</form>
							<button class="nav-close search-close">
								<span></span>
							</button>
						</div>

					</div>
					<!-- /search & aside toggle -->
				</div>
			</div>
			<!-- /Top Nav -->

			<!-- Aside Nav -->
			<!-- <div id="nav-aside">
				<ul class="nav-aside-menu">
					<li><a href=" {{ url('') }} ">Home</a></li>
					<li class="has-dropdown"><a>Categories</a>
						<ul class="dropdown">
							@foreach ($category_widget as $result2)
							<li><a href=" {{ route('blog.category', $result2->slug) }} "> {{ $result2->name }} </a></li>
							@endforeach
						</ul>
					</li>
					<li class="has-dropdown"><a>Tags</a>
						<ul class="dropdown">
							@foreach ($tag_widget as $result3)
							<li><a href=" {{ route('blog.tag', $result3->slug) }} "> {{ $result3->name }} </a></li>
							@endforeach
						</ul>
					</li>
					<li><a href="#">About Us</a></li>
				</ul>
				<button class="nav-close nav-aside-close"><span></span></button>
			</div> -->
			<!-- /Aside Nav -->
		</div>
		<!-- /NAV -->
	</header>
	<!-- /HEADER -->