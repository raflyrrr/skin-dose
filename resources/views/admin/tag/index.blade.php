@extends('backend.home')
@section('title','Ingredients')
@section('subjudul','Ingredients')
@section('content')

@if(Session::has('success'))
<div class="alert alert-success" role="alert">
    {{ Session('success')}}
</div>
@endif
<a href=" {{route('tag.create')}} " class="btn btn-info">Tambah Ingredients</a>
<br>
<br>
<table class="table rable striped table hover table-sm table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Ingredients</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tag as $result =>$hasil)
        <tr>
            <td> {{$result + $tag->firstitem()}} </td>
            <td> {{$hasil->name}} </td>
            <td>
                <form action=" {{route('tag.destroy', $hasil->id)}} " method="post">
                    @csrf
                    @method('delete')
                    <a href=" {{route('tag.edit',$hasil->id)}} " class="btn btn-primary btn-sm" style="margin-right: 8px;"><i class="fas fa-edit"></i></a>
                    <button type="submit" href="" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda ingin menghapus data?')"><i class="fas fa-trash"></i></button>
            </td>
            </form>
        </tr>
        @endforeach
    </tbody>
</table>
{{$tag->links()}}
@endsection