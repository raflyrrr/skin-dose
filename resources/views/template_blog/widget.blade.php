<div class="col-md-4">


	<!-- social widget -->
	
	<!-- /social widget -->

	<!-- category widget -->
	<div class="aside-widget">
		<div class="section-title">
			<h2 class="title">Categories</h2>
		</div>
		<div class="category-widget">
			<ul>
				@foreach ($category_widget as $hasil)
				<li><a href=" {{route('blog.category', $hasil->slug)}} ">{{$hasil->name}}<span>{{ $hasil->posts->count() }}</span></a></li>
				@endforeach
			</ul>
		</div>
	</div>
	<div class="aside-widget">
		<div class="section-title">
			<h2 class="title">Tags</h2>
		</div>
		<div class="category-widget">
			<ul>
				@foreach ($tag_widget as $hasil)
				<li><a href=" {{route('blog.tag', $hasil->slug)}} ">{{$hasil->name}}<span>{{ $hasil->posts->count() }}</span></a></li>
				@endforeach
			</ul>
		</div>
	</div>



</div>