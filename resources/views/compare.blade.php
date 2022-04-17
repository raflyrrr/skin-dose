@extends('template_blog.content')
@section('title','yourskindose - Compare Product')
@section('isi')
</div>
<!-- /row -->
</div>
<!-- /container -->
</div>
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    @foreach(\Gloudemans\Shoppingcart\Facades\Cart::instance('compare')->content() as $item)
                    <div class="col-md-6">
                        <div class="" style="text-align: center;">
                            @php
                            $photo = explode(',',$item->model['gambar']);
                            @endphp
                            <img src="{{asset($photo[0])}}" alt="">
                        </div>
                        <div class="" style="text-align: center; margin-top:10px">
                            <a href="{{route('blog.isi',$item->model['slug'])}}" style="font-size:3rem; font-weight:bold;">{{$item->model['namaproduk']}}</a>
                        </div>
                        <a href="{{route('blog.category',$item->model['category'])}}"style="font-size:18px;color: #9da8bc; font-weight:bold;">{{$item->model->category['name']}}</a>

                        <a href="javascript:;" data-id="{{$item->rowId}}" class="remove_from_compare delete-compare btndelete pull-right"style="color: #9da8bc;" onclick=" swal({
                        title: 'Good Job',
                        text: 'Produk berhasil dihapus dari compare',
                        icon: 'success',
                        button: 'OK!'
                        }).then(function(){
                        location.reload();});"><i class="fa fa-trash" style="color: #9da8bc;"></i> Hapus Compare</a>

                        <p style="margin-top:40px">{!! $item->model['content'] !!}</p>

                        <h2 style="margin-top:40px">Ingredients</h2>

                        @foreach ($item->model->tags as $tagsprod)
                        <p><a href="{{route('blog.tag',$tagsprod->slug)}}">{{$tagsprod->name}}</a></p>
                        @endforeach
                        <hr>
                        <h2>Not Match With</h2>
                        <p><a href="" style=" color:#F24A72;text-decoration: underline; cursor:text;">{!! $item->model['ingrenot'] !!}</a></p>
                    </div>
                    @endforeach 
                </div>
            </div>
            <!-- <table class="table table-bordered">
        <tbody>
            <tr>
                <td>Gambar</td>
                @foreach(\Gloudemans\Shoppingcart\Facades\Cart::instance('compare')->content() as $item)
                @php
                $photo = explode(',',$item->model['gambar']);
                @endphp
                <td><img src="{{asset($photo[0])}}" alt="" style="width: 100px;"></td>
                @endforeach
            </tr>
            <tr>
                <td>Nama Produk</td>
                @foreach(\Gloudemans\Shoppingcart\Facades\Cart::instance('compare')->content() as $item)
                @foreach ($item->model->tags as $post)
                <td><a href="">{{$post->name}}</a></td>
                @endforeach
                @endforeach
            </tr>
            <tr>
                <td>Hapus Compare</td>
                @foreach(\Gloudemans\Shoppingcart\Facades\Cart::instance('compare')->content() as $item)

                <td colspan=""><a href="javascript:;" data-id="{{$item->rowId}}" class="remove_from_compare delete-compare btndelete" onclick=" swal({
                        title: 'Good Job',
                        text: 'Produk berhasil dihapus dari compare',
                        icon: 'success',
                        button: 'OK!'
                    }).then(function(){
                        location.reload();});">Hapus</a></td>
                @endforeach

            </tr>
        </tbody>
    </table> -->
            @endsection
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script>
                $(document).on('click', '.delete-compare', function(e) {
                    e.preventDefault();
                    var rowId = $(this).data('id');
                    var token = "{{csrf_token()}}";
                    var path = "{{route('compare.delete')}}";

                    $.ajax({
                        url: path,
                        type: "POST",
                        data: {
                            _token: token,
                            rowId: rowId,
                        },
                        success: function(data) {
                            console.log(data);
                            if (data['status']) {
                                swal({
                                    title: "Good Job",
                                    text: data['message'],
                                    icon: "success",
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