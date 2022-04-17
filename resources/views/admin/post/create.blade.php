@extends('backend.home')
@section('title','Produk')
@section('subjudul','Add Produk')
@section('content')

@if(count($errors)>0)
@foreach ($errors->all() as $error)
<div class="alert alert-danger" role="alert">
    {{$error}}
</div>
@endforeach
@endif


<form action=" {{route('post.store')}} " method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label>Nama Produk</label>
        <input type="text" class="form-control col-3" name="namaproduk" autocomplete="off">
    </div>
    <div class="form-group">
        <label>Kategori</label>
        <select class="form-control" name="category_id">
            <option value="" holder>Pilih Kategori</option>
            @foreach ($category as $result)


            <option value=" {{$result->id}} "> {{$result->name}} </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Ingredients</label>
        <select class="form-control select2" multiple="" name="tags[]">
            @foreach($tags as $tag)
            <option value="{{ $tag->id }}">{{ $tag->name }}</option>

            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Active Ingredients</label>
        <select class="form-control select2" multiple="" name="ingredients[]">
            @foreach($activetags as $activetag)
            <option value="{{ $activetag->id }}">{{ $activetag->name }}</option>

            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Dekripsi Produk</label>
        <textarea name="content" class="form-control" id="content"></textarea>
    </div>
    <div class="form-group">
        <label>Gambar Produk</label>
        <input type="file" name="gambar" class="form-control">
    </div>
    <div class="form-group">
        <label>Warning Ingredients</label>
        <textarea name="ingrenot" class="form-control" id="ingrenot"></textarea>
    </div>
    <div class="form-group">
        <button class="btn btn-primary">Simpan</button>
    </div>
</form>
<script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('content');
    CKEDITOR.replace('ingrenot')
</script>
@endsection