@extends('template_blog.content')
@section('title','yourskindose - List Product')
@section('isi')
<div class="col-md-12 hot-post-left">
	@foreach($data as $list_post)
	<div class="post post-row">
		<a class="post-img" href="{{route('blog.isi', $list_post->slug)}}"><img src="{{asset ($list_post->gambar)}}" alt=""></a>
		<div class="post-body" style="box-shadow: none !important;">
			<div class="post-category">
				<a href="{{ route('blog.category', $list_post->category->slug) }}"> {{$list_post->category->name}} </a>
			</div>

			<h3 class="post-title"><a href="{{route('blog.isi', $list_post->slug)}}">{{$list_post->namaproduk}}</a></h3>
			<ul class="post-meta">
				<li>{{$list_post->created_at->diffForHumans()}} | <a href="javascript:void(0);"class="add_to_compare" data-id="{{$list_post->id}}" id="add_to_compare_{{$list_post->id}}">Compare</a></li>
			</ul>


			<div class="tags-widget">
				<ul>
					@foreach($list_post->tags as $post)
					<li>
						<a href="{{ route('blog.tag', $post->slug) }}"> {{$post->name}} </a>
					</li>
					@endforeach
				</ul>
			</div>

			<div class="activetags-widget">
				<ul>
					@foreach ($list_post->ingredients as $active)
					<li>
						<a href="{{ route('blog.activetag', $active->slug) }}"> {{$active->name}} </a>
					</li>
					@endforeach
				</ul>
			</div>


		</div>

	</div>
	<br>

	@endforeach
	<div style="text-align:center">
		{{$data->links()}}
	</div>
</div>
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
			<script>
				$(document).on('click', '.add_to_compare', function(e) {
					e.preventDefault();
					var post_id = $(this).data('id');
					var token = "{{csrf_token()}}";
					var path = "{{route('compare.store')}}";

					$.ajax({
						url: path,
						type: "POST",
						dataType: "JSON",
						data: {
							post_id: post_id,
							_token: token,
						},
						beforeSend: function() {
							$('#add_to_compare_' + post_id).html('<i class="fa fa-spinner fa-spin"></i>');
						},
						complete: function() {
							$('#add_to_compare_' + post_id).html('<a>Added to compare</a>');
						},
						success: function(data) {
							console.log(data);

							if (data['true']) {
								$('body #header-ajax').html(data['header']);
								$('body #compare_counter').html(data['compare_count']);
								swal({
									title: "Good Job",
									text: data['message'],
									icon: "success",
									button: "OK!"
								});
							} else if (data['present']) {
								$('body #header-ajax').html(data['header']);
								$('body #compare_counter').html(data['compare_count']);
								swal({
									title: "Oops",
									text: data['message'],
									icon: "warning",
									button: "OK!"
								});

							} else {
								swal({
									title: "Sorry",
									text: "Kamu tidak dapat menambahkan lebih dari 2 produk",
									icon: "error",
									button: "OK!"
								});

							};
						},
						error: function(err) {
							console.log(err)
						}
					});
				});
			</script>