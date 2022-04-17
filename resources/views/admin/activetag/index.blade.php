@extends('backend.home')
@section('title','Active Ingredients')
@section('subjudul','Active Ingredients')
@section('content')

@if(Session::has('success'))
<div class="alert alert-success" role="alert">
    {{ Session('success')}}
</div>
@endif
<a href=" {{route('activetag.create')}} " class="btn btn-info">Tambah Active Ingredients</a>
<br>
<br>
<table class="table rable striped table hover table-sm table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Active Ingredients</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($activetag as $result =>$hasil)
        <tr>
            <td> {{$result + $activetag->firstitem()}} </td>
            <td> {{$hasil->name}} </td>
            <td>
                <form action=" {{route('activetag.destroy', $hasil->id)}} " method="post">
                    @csrf
                    @method('delete')
                    <a href=" {{route('activetag.edit',$hasil->id)}} " class="btn btn-primary btn-sm" style="margin-right: 8px;"><i class="fas fa-edit"></i></a>
                    <button type="submit" href="" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda ingin menghapus data?')"><i class="fas fa-trash"></i></button>
            </td>
            </form>
        </tr>
        @endforeach
    </tbody>
</table>
{{$activetag->links()}}
@endsection