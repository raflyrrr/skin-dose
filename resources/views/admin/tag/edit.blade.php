@extends('backend.home')
@section('title','Ingredients')
@section('subjudul','Edit Ingredients')
@section('content')

    @if(count($errors)>0)
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger" role="alert">
            {{$error}}
            </div>
        @endforeach
        @endif

    
<form action="{{ route('tag.update',$tags->id)}} " method="POST">
@csrf
@method('patch')
<div class="form-group">
    <label>Ingredients</label>
    <input type="text"class="form-control col-3" autocomplete="off" name="name"value={{$tags->name}}>
</div>
<div class="form-group">
    <button class="btn btn-primary">Perbaharui</button>
</div>
</form>
@endsection