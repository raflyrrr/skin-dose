@extends('template_blog.content')
@section('title','yourskindose - Product')
@section('isi')

@foreach($data as $isi_post)

<div class="container">
	<div class="row">
		<div class="col-md-5">
			<div id="post-header" class="page-header">
				<div class="page-header-bg " style="background-image: url({{ asset($isi_post->gambar) }});" data-stellar-background-ratio="1"></div>
			</div>
		</div>
		<div class="col-md-7">
			<div class="post-category">
				<a href="{{ route('blog.category', $isi_post->category->slug) }}">{{$isi_post->category->name}}</a>
			</div>
			<h1> {{$isi_post->namaproduk}} </h1>
			<a href="javascript:void(0);"class="add_to_compare" data-id="{{$isi_post->id}}" id="add_to_compare_{{$isi_post->id}}">Compare</a>
			<div class="section-row" style="margin-top: 20px;">
				{!! $isi_post->content !!}
			</div>

		</div>
	</div>
</div>
<h2 style="margin-top: 15px;">Ingredients Overview</h2>
<hr>


<div class="ingre">
	@foreach ($isi_post->tags as $ingre)
	<a href="https://google.com/search?q={{$ingre->name}}" target="_blank" style="font-size:2rem;">{{$ingre->name}},</a>
	@endforeach
	@foreach ($isi_post->ingredients as $activeingre)
	<a href="https://google.com/search?q={{$activeingre->name}}" target="_blank" style="font-size:2rem; color:red;">{{$activeingre->name}},</a>
	@endforeach
</div>

<h2 style="margin-top:5%">More Products</h2>

<div class="row">
	<div class="col-md-12">
		<div class="row">
			@foreach ($data2 as $moreprod)
			<div class="col-md-3">
				<div class="post" style="margin-top: 20px;">
					<a class="post-img" href=" {{ route('blog.isi',$moreprod->slug ) }} "><img src="/{{ $moreprod->gambar }}" alt="" style="height: 200px;"></a>
					<div class="post-body" style="text-align: center;">
						<div class="post-category">
							<a href="{{ route('blog.category',$moreprod->category->slug ) }}"> {{$moreprod->category->name}} </a>
						</div>
						<h3 class="post-title"><a href="{{ route('blog.isi',$moreprod->slug ) }}">{{ $moreprod->namaproduk }}</a></h3>
						<ul class="post-meta">
							<li><a href="javascript:void(0);" class="add_to_compare" data-id="{{$moreprod->id}}" id="add_to_compare_{{$moreprod->id}}">Compare</a></li>
						</ul>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</div>



@endforeach
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