@extends('adminlte::page')

@section('title', 'Sistema de Gestión de Colegios')

@section('content_header')
    <h1>Administración de clases</h1>
@stop

@section('content')
    @livewire('admin.classroom.show-classroom')
@stop
@section('footer')
    <div class="d-flex justify-content-end">
        <b>Version</b> 3.0
    </div>
    <strong>Sistema de Gestion de Colegios. Todos los derechos reservados © 2016 - {{ date('Y') }}. </strong>
    Colegio San José de los Infantes - Donde la historia y la fe se funden
@stop
