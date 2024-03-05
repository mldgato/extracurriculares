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
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Nivel</th>
                        <th>Grado</th>
                        <th>Sección</th>
                        <th>Fecha de Registro</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($enrollments as $enrollment)
                        <tr>
                            <td>{{ $enrollment->codschool }}</td>
                            <td>{{ $enrollment->firstname }}</td>
                            <td>{{ $enrollment->lastname }}</td>
                            <td>{{ $enrollment->level_name }}</td>
                            <td>{{ $enrollment->grade_name }}</td>
                            <td>{{ $enrollment->section_name }}</td>
                            <td>{{ $enrollment->registrationdate }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Nivel</th>
                        <th>Grado</th>
                        <th>Sección</th>
                        <th>Fecha de Registro</th>
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
