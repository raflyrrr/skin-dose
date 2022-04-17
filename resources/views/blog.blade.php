@extends('template_blog.content')
@section('title','yourskindose - Home')
@section('isi')
<hr>
<div class="carousel-header" style="">
<img src="/frontend/img/bodyvector.svg" alt="" width="50%" style="display: block;
  margin-left: auto;
  margin-right: auto;">
	<h1 style="text-align:center; font-size:4rem; color:#90A8BC;">decode ingredient lists like a pro</h1>
</div>

</div>
<!-- /row -->
</div>
<!-- /container -->
</div>

<!-- /SECTION -->

<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="col-md-12">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<hr>
						<h1 style="text-align:center; margin:6rem; font-size:4rem; color:#90A8BC">products</h1>
					</div>
					<!-- post -->
					@foreach($data as $post_terbaru)
					<div class="col-md-3">
						<div class="post" style="margin-top: 20px;">
							<a class="post-img" href=" {{ route('blog.isi',$post_terbaru->slug ) }} "><img src="{{ $post_terbaru->gambar }}" alt="" style="height: 200px;"></a>
							<div class="post-body" style="text-align: center;">
								<div class="post-category">
									<a href="{{ route('blog.category',$post_terbaru->category->slug ) }}"> {{$post_terbaru->category->name}} </a>
								</div>
								<h3 class="post-title"><a href="{{ route('blog.isi',$post_terbaru->slug ) }}">{{ $post_terbaru->namaproduk }}</a></h3>
								<ul class="post-meta">
									<li><a href="javascript:void(0);" class="add_to_compare" data-id="{{$post_terbaru->id}}" id="add_to_compare_{{$post_terbaru->id}}">Compare</a></li>
								</ul>
							</div>
						</div>
					</div>
					@endforeach
				</div>
				<hr>
			</div>
			<!-- container -->
			<!-- row -->
			<div class="col-md-12">
				<!-- row -->
				
					<!-- post -->
					
					
						<div class="post">
							<div class="post-body-text" style="text-align: center;">
								<h3 style="font-weight: lighter;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged</h3>
							</div>
						</div>
					
					
				
				<hr>
			</div>
			<div class="col-md-12">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<h1 style="text-align:center; margin:6rem; font-size:4rem; color:#90A8BC;">category</h1>
					</div>
					<!-- post -->
					@foreach($data as $post_terbaru)
					<div class="col-md-3">
						<div class="post" style="margin-top: 80px;">
							<div class="post-body-cat" style="text-align: center;">
								<h3 class="post-title-category"><a href="{{ route('blog.category',$post_terbaru->category->slug ) }}">{{ $post_terbaru->category->name }}</a></h3>
							</div>
						</div>
					</div>
					@endforeach
				</div>
				<hr>
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