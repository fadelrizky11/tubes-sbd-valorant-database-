@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Subtype</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('subtypes.index') }}"> Back</a>
            </div>
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('subtypes.store') }}" method="POST">
        @csrf
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ID Subjenis:</strong>
                    <input type="number" name="id_subjenis" class="form-control" placeholder="ID Subjenis">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Subjenis:</strong>
                    <input type="text" name="subjenis" class="form-control" placeholder="Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>warna_subjenis:</strong>
                    <input type="text" name="warna_subjenis" class="form-control" placeholder="warna subjenis">
                </div>
            </div>
            </div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>skin_subjenis:</strong>
                    <input type="text" name="skin_subjenis" class="form-control" placeholder="skin subjenis">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
            </div>
    </form>
    <p class="text-center text-primary"><small>Tutorial by LaravelTuts.com</small></p>
@endsection