@extends('backend.home')
@section('title','Active Ingredients')
@section('subjudul','Edit Active Ingredients')
@section('content')

    @if(count($errors)>0)
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger" role="alert">
            {{$error}}
            </div>
        @endforeach
        @endif

    
<form action="{{ route('activetag.update',$activetags->id)}} " method="POST">
@csrf
@method('patch')
<div class="form-group">
    <label>Active Ingredients</label>
    <input type="text"class="form-control col-3" autocomplete="off" name="name" value={{$activetags->name}}>
</div>
<div class="form-group">
    <button class="btn btn-primary">Perbaharui</button>
</div>
</form>
@endsection