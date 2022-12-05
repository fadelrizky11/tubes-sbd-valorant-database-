@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Type Deleted</h2>
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
            <th>type</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($types as $type)
        <tr>
            <td>{{ $type->id_type }}</td>
            <td>{{ $type->type }}</td>
            <td>
                <form>
                    @can('senjata-delete')
                    <a class="btn btn-primary" href="trash/{{ $type ->id_type }}/restore">Restore</a>
                    @endcan
                    @csrf
                    @can('senjata-delete')
                    <a class="btn btn-danger" href="trash/{{ $type->id_type }}/forcedelete">Force Delete</a>
                    @endcan
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {!! $types->links() !!}
    <p class="text-center text-primary"><small>Tutorial by LaravelTuts.com</small></p>
@endsection