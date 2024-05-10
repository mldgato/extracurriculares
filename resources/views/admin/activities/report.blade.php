@extends('adminlte::page')

@section('content_header')
    <h1>Reporte de asistencia de: <strong class="text-danger">{{ $activity->activity }}</strong></h1>
@stop

@section('content')
    <div class="card card-outline card-primary mb-3">
        <div class="card-header">
            <h2>Selección del mes <i class="fas fa-calendar-check"></i></h2>
        </div>
        <div class="card-body">
            <form action="{{route('admin.activities.viewReport')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label for="cycle">Mes:</label>
                            <select name="month" id="month" class="form-control" required>
                                <option value="" selected>- Seleccione -</option>
                                <option value="1">Enero</option>
                                <option value="2">Febrero</option>
                                <option value="3">Marzo</option>
                                <option value="4">Abril</option>
                                <option value="5">Mayo</option>
                                <option value="6">Junio</option>
                                <option value="7">Julio</option>
                                <option value="8">Agosto</option>
                                <option value="9">Septiembre</option>
                                <option value="10">Octubre</option>
                                <option value="11">Noviembre</option>
                                <option value="12">Diciembre</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label for="cycle">Ciclo:</label>
                            <select name="cycle" id="cycle" class="form-control" required>
                                <option value="" selected>- Seleccione -</option>
                                @foreach ($cycles as $cycle)
                                    <option value="{{ $cycle->id }}">{{ $cycle->cycle_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="d-flex justify-content-end">
                            <input type="hidden" name="activity" value="{{ $activity->id }}">
                            <button type="submit" class="btn btn-success">Mostrar reporte <i
                                    class="fas fa-file-alt"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')

@stop
