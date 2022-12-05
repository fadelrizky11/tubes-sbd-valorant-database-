@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Subjenis</h2>
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
    <form action="{{ route('subtypes.update',$subtype->id_subjenis) }}" method="POST">
        @csrf
        @method('PUT')
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ID Senjata:</strong>
                    <input type="number" name="id_subjenis" value="{{ $subtype->id_subjenis }}" class="form-control" placeholder="ID Subjenis">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Subjenis:</strong>
                    <input type="text" name="subjenis" value="{{ $subtype->subjenis }}" class="form-control" placeholder="Subjenis">
                </div>
             </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>warna_subjenis:</strong>
                    <input type="text" name="warna_subjenis" value="{{ $subtype->warna_subjenis }}" class="form-control" placeholder="Warna Subjenis">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>skin_subjenis:</strong>
                    <input type="text" name="skin_subjenis" value="{{ $subtype->skin_subjenis }}" class="form-control" placeholder="Skin Subjenis">
                </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
    <p class="text-center text-primary"><small>Tutorial by LaravelTuts.com</small></p>
@endsection