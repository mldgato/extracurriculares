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
                        <th>Apellido</th>
                        <th>Nombre</th>
                        <th>Nivel</th>
                        <th>Grado</th>
                        <th>Sección</th>
                        <th>Fecha de Registro</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($enrollments as $enrollment)
                        <tr>
                            <td>{{ $enrollment->student->codschool }}</td>
                            <td>{{ $enrollment->student->lastname }}</td>
                            <td>{{ $enrollment->student->firstname }}</td>
                            <td>
                                @foreach ($enrollment->student->classroomstudents as $classroomStudent)
                                    {{ $classroomStudent->classroom->level->level_name }}
                                @endforeach
                            </td>
                            <td>
                                @foreach ($enrollment->student->classroomstudents as $classroomStudent)
                                    {{ $classroomStudent->classroom->grade->grade_name }}
                                @endforeach
                            </td>
                            <td>
                                @foreach ($enrollment->student->classroomstudents as $classroomStudent)
                                    {{ $classroomStudent->classroom->section->section_name }}
                                @endforeach
                            </td>
                            <td>{{ $enrollment->formattedRegistrationDate() }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Código</th>
                        <th>Apellido</th>
                        <th>Nombre</th>
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
    <script type="text/javascript">
        $(document).ready(function() {
            var table = new DataTable('#Enrollments', {
                language: {
                    url: '//cdn.datatables.net/plug-ins/2.0.1/i18n/es-ES.json',
                },
                "aaSorting": [ [3,'asc'], [4,'asc'], [5,'asc'], [1,'asc'], [2,'asc'] ],
            });
        });
    </script>
@stop
