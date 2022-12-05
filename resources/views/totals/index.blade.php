@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Hasil Join</h2>
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
            <th>Nama Senjata</th>
            <th>Subjenis</th>
            <th>Type</th>
        </tr>
        @foreach ($joins as $join)
        <tr>
            <td>{{ $join->nama_senjata }}</td>
            <td>{{ $join->subjenis }}</td>
            <td>{{ $join->type }}</td>
        </tr>
        @endforeach
    </table>
    {!! $joins->links() !!}
    <p class="text-center text-primary"><small>Tutorial by LaravelTuts.com</small></p>
@endsection