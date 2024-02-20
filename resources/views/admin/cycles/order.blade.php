@extends('adminlte::page')

@section('content_header')
    <h1>Administración de ciclos</h1>
@stop

@section('content')
        @livewire('admin.cycles.order-cycles')
@stop
@section('footer')
    <div class="d-flex justify-content-end">
        <b>Version</b> 3.0
    </div>
    <strong>Sistema de Gestion de Colegios. Todos los derechos reservados © 2016 - {{ date('Y') }}. </strong>
    Colegio San José de los Infantes - Donde la historia y la fe se funden
@stop

@section('css')
    
@stop

@section('js')
    
@stop