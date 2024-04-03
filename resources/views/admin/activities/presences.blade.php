@extends('adminlte::page')

@section('content_header')
    <h1>Administración de actividades extra curriculares</h1>
@stop

@section('content')
    <div class="row">
        <div class="col">
            <h2 class="text-secondary">Asistencia</h2>
        </div>
    </div>
    <div class="row">
        @foreach ($activities as $activity)
            <div class="col-sm-12 col-md-4 col-lg-3">
                <div class="small-box bg-{{ $activity->class }}">
                    <div class="inner">
                        <h3>{{ $activity->activity }}</h3>
                        <p>Registro</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <a href="{{ route('admin.activities.attendance', $activity) }}" class="small-box-footer">Ingresar <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endforeach
    </div>
@stop

@section('css')

@stop

@section('js')

@stop
