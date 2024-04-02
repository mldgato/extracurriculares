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
            <div class="table-responsive">
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
                                <td>{{ $enrollment->codschool }}</td>
                                <td>{{ $enrollment->lastname }}</td>
                                <td>{{ $enrollment->firstname }}</td>
                                <td>{{ $enrollment->level_name }}</td>
                                <td>{{ $enrollment->grade_name }}</td>
                                <td>{{ $enrollment->section_name }}</td>
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
    </div>
@stop

@section('css')

@stop

@section('js')
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.0/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.html5.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var table = new DataTable('#Enrollments', {
                language: {
                    url: '//cdn.datatables.net/plug-ins/2.0.1/i18n/es-ES.json',
                },
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'copyHtml5',
                        className: 'btn btn-info mb-2',
                        text: 'Copiar <i class="fa fa-clipboard" aria-hidden="true"></i>'
                    },
                    {
                        extend: 'excelHtml5',
                        className: 'btn btn-success mb-2',
                        text: 'Excel <i class="fas fa-file-excel"></i>',
                        autoFilter: true,
                        sheetName: 'Ingresos',
                        customize: function(xlsx) {
                            var sheet = xlsx.xl.worksheets['sheet1.xml'];
                            $('row c*', sheet).attr('s', '25');
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        className: 'btn btn-danger mb-2',
                        text: 'PDF <i class="fas fa-file-pdf"></i>'
                    }
                ],
                "aaSorting": [
                    [3, 'asc'],
                    [4, 'asc'],
                    [5, 'asc'],
                    [1, 'asc'],
                    [2, 'asc']
                ],
            });
            table.buttons().container()
                .appendTo($('.col-sm-6:eq(0)', table.table().container()));
        });
    </script>
@stop
