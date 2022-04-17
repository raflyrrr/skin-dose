@extends('backend.home')
@section('title','Produk')
@section('subjudul','Edit Produk')
@section('content')

@if(count($errors)>0)
@foreach ($errors->all() as $error)
<div class="alert alert-danger" role="alert">
    {{$error}}
</div>
@endforeach
@endif


<form action=" {{route('post.update', $post->id)}} " method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="form-group">
        <label>Nama Produk</label>
        <input type="text" class="form-control col-3" name="namaproduk" autocomplete="off" value="{{ $post->namaproduk }}">
    </div>
    <div class="form-group">
        <label>Kategori</label>
        <select class="form-control" name="category_id">
            <option value="" holder>Pilih Kategori</option>
            @foreach ($category as $result)
            <option value=" {{$result->id}} " @if($post->category_id == $result->id)
                selected
                @endif
                > {{$result->name}} </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Ingredients</label>
        <select class="form-control select2" multiple="" name="tags[]">
            @foreach($tags as $tag)
            <option value="{{ $tag->id }}" @foreach($post->tags as $value)
                @if($tag->id == $value->id)
                selected
                @endif
                @endforeach
                >{{ $tag->name }}</option>

            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Active Ingredients</label>
        <select class="form-control select2" multiple="" name="ingredients[]">
            @foreach($activetags as $activetag)
            <option value="{{ $activetag->id }}" @foreach($post->ingredients as $activevalue)
                @if($activetag->id == $activevalue->id)
                selected
                @endif
                @endforeach
                >{{ $activetag->name }}</option>

            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Deskripsi Produk</label>
        <textarea name="content" class="form-control" id="content">{{ $post->content }}</textarea>
    </div>
    <div class="form-group">
        <label>Gambar Produk</label>
        <input type="file" name="gambar" class="form-control">
    </div>
    <div class="form-group">
        <label>Warning Ingredients</label>
        <textarea name="ingrenot" class="form-control" id="ingrenot">{{ $post->ingrenot }}</textarea>
    </div>
    <div class="form-group">
        <button class="btn btn-primary">Perbaharui</button>
    </div>
</form>

<script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('content');
    CKEDITOR.replace('ingrenot')
</script>
@endsection