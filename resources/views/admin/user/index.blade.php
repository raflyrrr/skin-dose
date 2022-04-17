@extends('backend.home')
@section('title','User')
@section('subjudul','User')
@section('content')

@if(Session::has('success'))
<div class="alert alert-success" role="alert">
    {{ Session('success')}}    
  </div>
    @endif
<a href=" {{route('user.create')}} "class="btn btn-info">Tambah User</a>
<br>
<br>
<table class="table rable striped table hover table-sm table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama User</th>
            <th>Email</th>
            <th>Tipe</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($user as $result =>$hasil)
            <tr>
                <td> {{$result + $user->firstitem()}} </td>
                <td> {{$hasil->name}} </td>
                <td> {{$hasil->email}} </td>
                <td>
                @if($hasil->tipe)
                <span class="badge badge-info">Administrator</span></h6> 
                    @else
                    <span class="badge badge-warning">Author</span></h6> 
                    
                @endif 
                </td>
                    <td>
                    <form action=" {{route('user.destroy', $hasil->id)}} " method="post">
                        @csrf
                        @method('delete')
                        <a href=" {{route('user.edit',$hasil->id)}} " class="btn btn-primary btn-sm" style="margin-right: 8px;"><i class="fas fa-edit"></i></a>
                    <button type="submit" href="" class="btn btn-danger btn-sm"onclick="return confirm('Apakah anda ingin menghapus data?')"><i class="fas fa-trash"></i></button></td>
                    </form>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{$user->links()}}
@endsection
