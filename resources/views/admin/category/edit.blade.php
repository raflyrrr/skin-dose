@extends('backend.home')
@section('title','Category')
@section('subjudul','Edit Category')
@section('content')

@if(count($errors)>0)
@foreach ($errors->all() as $error)
<div class="alert alert-danger" role="alert">
    {{$error}}
</div>
@endforeach
@endif

@if(Session::has('success'))
<div class="alert alert-success" role="alert">
    {{ Session('success') }}
</div>
@endif

<form action="{{ route('category.update',$category->id)}} " method="POST">
    @csrf
    @method('put')
    <div class="form-group">
        <label>Category</label>
        <input type="text" class="form-control col-3" autocomplete="off" name="name" value="{{ $category->name }}">
    </div>
    <div class="form-group">
        <button class="btn btn-primary">Perbaharui</button>
    </div>
</form>
@endsection