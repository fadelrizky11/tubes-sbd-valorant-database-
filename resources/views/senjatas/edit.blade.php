@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('senjatas.index') }}"> Back</a>
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
    <form action="{{ route('senjatas.update',$senjata->id_senjata) }}" method="POST">
        @csrf
        @method('PUT')
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ID Senjata:</strong>
                    <input type="number" name="id_senjata" value="{{ $senjata->id_senjata }}" class="form-control" placeholder="ID">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nama Senjata:</strong>
                    <input type="text" name="nama_senjata" value="{{ $senjata->nama_senjata }}" class="form-control" placeholder="Nama Senjata">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Harga:</strong>
                    <input type="number" name="harga" value="{{ $senjata->harga }}" class="form-control" placeholder="Harga">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ID Subjenis:</strong>
                    <input type="number" name="id_subjenis" value="{{ $senjata->id_subjenis }}" class="form-control" placeholder="ID Subjenis">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ID Jenis:</strong>
                    <input type="number" name="id_jenis" value="{{ $senjata->id_jenis }}" class="form-control" placeholder="ID Jenis">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
    <p class="text-center text-primary"><small>Tutorial by LaravelTuts.com</small></p>
@endsection