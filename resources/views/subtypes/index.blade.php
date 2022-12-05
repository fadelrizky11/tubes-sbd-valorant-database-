@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Subjenis</h2>
            </div>
            <div class="pull-right">
                @can('senjata-create')
                <a class="btn btn-success" href="{{ route('subtypes.create') }}"> Create New Product</a>
                @endcan
                @can('senjata-delete')
                <a class="btn btn-info" href = "/subtypes/trash">Deleted Data</a>
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
            <th>ID Subjenis</th>
            <th>Subjenis</th>
            <th>Warna subjenis</th>
            <th>Skin subjenis</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($subjenis as $subtype)
        <tr>
            <td>{{ $subtype->id_subjenis }}</td>
            <td>{{ $subtype->subjenis }}</td>
            <td>{{ $subtype->warna_subjenis }}</td>
            <td>{{ $subtype->skin_subjenis }}</td>
            <td>
                <form action="{{ route('subtypes.destroy',$subtype->id_subjenis) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('subtypes.show',$subtype->id_subjenis) }}">Show</a>
                    @can('senjata-edit')
                    <a class="btn btn-primary" href="{{ route('subtypes.edit',$subtype->id_subjenis) }}">Edit</a>
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
    {!! $subjenis->links() !!}
    <p class="text-center text-primary"><small>Tutorial by LaravelTuts.com</small></p>
@endsection