@extends('backend.home')
@section('title','User')
@section('subjudul','Add User')
@section('content')

    @if(count($errors)>0)
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger" role="alert">
            {{$error}}
            </div>
        @endforeach
        @endif

    
<form action=" {{route('user.store')}} " method="POST">
@csrf
<div class="form-group">
    <label>Nama User</label>
    <input type="text"class="form-control col-3" name="name"autocomplete="off">
</div>
<div class="form-group">
    <label>Email</label>
    <input type="text"class="form-control col-3" name="email"autocomplete="off">
</div>
<div class="form-group">
    <select class="form-control" name="tipe">
    <option value=""holder>Pilih Tipe User</option>
    <option value="1"holder>Administrator</option>
    <option value="0"holder>Author</option>\
    </select>
</div>

<div class="form-group">
    <label>Password</label>
    <input type="password"class="form-control col-3" name="password"autocomplete="off">
</div>

<div class="form-group">
    <button class="btn btn-primary">Simpan</button>
</div>
</form>
@endsection