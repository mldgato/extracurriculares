@extends('adminlte::page')

@section('content_header')
    <h1>Perfil de usuario</h1>
@stop

@section('content')
    <div class="card card-outline card-primary mb-3">
        <div class="card-header">
            <h3>Datos de usuario</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label>Nombres:</label>
                        <div class="form-control">{{ $user->name }}</div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label>Apellidos:</label>
                        <div class="form-control">{{ $user->surname }}</div>
                    </div>
                </div>
            </div>
            @livewire('admin.users.password-user')
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')

@stop
