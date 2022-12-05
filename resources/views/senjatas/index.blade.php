@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Senjata</h2>
            </div>
            <div class="pull-right">
                @can('senjata-create')
                <a class="btn btn-success" href="{{ route('senjatas.create') }}"> Create New Product</a>
                @endcan
                @can('senjata-delete')
                <a class="btn btn-info" href = "/senjatas/trash">Deleted Data</a>
                @endcan   
            </div>
            <div class="my-3 col-12 col-sm-8 col-md-5">
                <form action="" method="get">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Keyword" name = "keyword" aria-label="Keyword" aria-describedby="basic-addon1">
                        <button class="input-group-text btn btn-primary" id="basic-addon1">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered">
        <tr>
            <th>ID Senjata</th>
            <th>Nama Senjata</th>
            <th>Harga</th>
            <th>ID Subjenis</th>
            <th>ID Jenis</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($senjatas as $senjata)
        <tr>
            <td>{{ $senjata->id_senjata }}</td>
            <td>{{ $senjata->nama_senjata }}</td>
            <td>{{ $senjata->harga }}</td>
            <td>{{ $senjata->id_subjenis }}</td>
            <td>{{ $senjata->id_jenis }}</td>
            <td>
                <form action="{{ route('senjatas.destroy',$senjata->id_senjata) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('senjatas.show',$senjata->id_senjata) }}">Show</a>
                    @can('senjata-edit')
                    <a class="btn btn-primary" href="{{ route('senjatas.edit',$senjata->id_senjata) }}">Edit</a>
                    @endcan
                    @csrf
                    @method('DELETE')
                    @can('senjata-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan             
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {!! $senjatas->links() !!}
    <p class="text-center text-primary"><small>Tutorial by LaravelTuts.com</small></p>
@endsection