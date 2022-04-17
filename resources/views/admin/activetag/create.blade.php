@extends('backend.home')
@section('title','Active Ingredients')
@section('subjudul','Add Active Ingredients')
@section('content')

    @if(count($errors)>0)
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger" role="alert">
            {{$error}}
            </div>
        @endforeach
        @endif

    
<form action=" {{route('activetag.store')}} " method="POST">
@csrf
<div class="form-group">
    <label>Active Ingredients</label>
    <input type="text"class="form-control col-3" name="name"autocomplete="off">
</div>
<div class="form-group">
    <button class="btn btn-primary">Simpan</button>
</div>
</form>
@endsection