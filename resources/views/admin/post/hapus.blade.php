@extends('backend.home')
@section('title','Produk')
@section('subjudul','Produk Yang Sudah Dihapus')
@section('content')

@if(Session::has('success'))
<div class="alert alert-success" role="alert">
    {{ Session('success')}}
</div>
@endif

<br>
<br>
<table class="table rable striped table hover table-sm table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Kategori</th>
            <th>Ingredients</th>
            <th>Gambar</th>
            <th>Warning Ingredients</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($post as $result =>$hasil)
        <tr>
            <td> {{$result + $post->firstitem()}} </td>
            <td> {{$hasil->namaproduk}} </td>
            <td> {{$hasil->category->name}} </td>
            <td>@foreach($hasil->tags as $tag)
                <ul>
                    <li>{{ $tag->name }}</li>
                </ul>
                @endforeach
            </td>
            <td><img src=" {{asset( $hasil->gambar )}}  " class="img-fluid" style="width:100px"></td>
            <td>{{$hasil->ingrenot}}</td>
            <td>
                <form action=" {{ route('post.kill', $hasil->id) }} " method="post">
                    @csrf
                    @method('delete')
                    <a href=" {{ route('post.restore', $hasil->id) }} " class="btn btn-info btn-sm" style="margin-right: 8px;"><i class="fas fa-undo"></i></a>
                    <button type="submit" href="" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda ingin menghapus data?')"><i class="fas fa-trash"></i></button>
            </td>
            </form>
        </tr>
        @endforeach
    </tbody>
</table>
{{$post->links()}}
@endsection