@extends('backend.home')
@section('title','Category')
@section('subjudul','Add Category')
@section('content')

    @if(count($errors)>0)
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger" role="alert">
            {{$error}}
            </div>
        @endforeach
        @endif

    
<form action=" {{route('category.store')}} " method="POST">
@csrf
<div class="form-group">
    <label>Category</label>
    <input type="text"class="form-control col-3" name="name"autocomplete="off">
</div>
<div class="form-group">
    <button class="btn btn-primary">Simpan</button>
</div>
</form>
@endsection