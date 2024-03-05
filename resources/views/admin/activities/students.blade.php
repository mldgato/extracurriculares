@extends('adminlte::page')

@section('content_header')
    <h1>Lista de <span class="text-danger">{{ $activity->activity }}</span></h1>
@stop

@section('content')
    <div class="card card-outline card-primary mb-3">
        <div class="card-header">
            <h2>Estudiatnes registrados</h2>
        </div>
        <div class="card-body">
            <table id="Enrollments" class="table table-striped table-hover table-sm">
                <thead>
                    <tr>
                        <th>Carné</th>
                        <th>Apellidos</th>
                        <th>Nombres</th>
                        <th>Nivel</th>
                        <th>Grado</th>
                        <th>Secc.</th>
                        <th>Refistro</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($enrollments as $enrollment)
                        <tr>
                            <td>{{ $enrollment->codschool }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Carné</th>
                        <th>Apellidos</th>
                        <th>Nombres</th>
                        <th>Nivel</th>
                        <th>Grado</th>
                        <th>Secc.</th>
                        <th>Refistro</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')

@stop
