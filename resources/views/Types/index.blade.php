@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Jenis</h2>
            </div>
            <div class="pull-right">
                @can('senjata-create')
                <a class="btn btn-success" href="{{ route('types.create') }}"> Create New Product</a>
                @endcan
                @can('senjata-delete')
                <a class="btn btn-info" href = "/types/trash">Deleted Data</a>
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
            <th>ID Type</th>
            <th>Type</th>
            <th>Abilities</th>
            <th>Armor</th>

            <th width="280px">Action</th>
        </tr>
        @foreach ($types as $type)
        <tr>
            <td>{{ $type->id_type }}</td>
            <td>{{ $type->type }}</td>
            <td>{{ $type->Abilities }}</td>
            <td>{{ $type->Armor }}</td>

            <td>
                <form action="{{ route('types.destroy',$type->id_type) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('types.show',$type->id_type) }}">Show</a>
                    @can('senjata-edit')
                    <a class="btn btn-primary" href="{{ route('types.edit',$type->id_type) }}">Edit</a>
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
    {!! $types->links() !!}
    <p class="text-center text-primary"><small>Tutorial by LaravelTuts.com</small></p>
@endsection