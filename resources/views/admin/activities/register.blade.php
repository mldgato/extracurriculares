@extends('adminlte::page')

@section('content_header')
    <h1>Registro de actividades extra curriculares</h1>
@stop

@section('content')
    <div class="card card-outline card-primary mb-3">
        <div class="card-header">
            <h2>Escaneo <i class="fas fa-qrcode"></i></h2>
        </div>
        <div class="card-body">
            <div id="reader" width="600px"></div>
            <input type="hidden" id="activity" value="{{ $activity->id }}">
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')
    <script type="text/javascript">
        function onScanSuccess(decodedText, decodedResult) {
            var activity = $('#activity').val();
            var codschool = 'tu-codigo-de-escuela'; // Reemplaza esto con el código de tu escuela

            $.ajax({
                url: '/admin/activities/enrollment/' + codschool + '/' + activity,
                type: 'GET',
                success: function(response) {
                    // Aquí puedes manejar la respuesta del servidor
                    console.log(response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Aquí puedes manejar los errores
                    console.log(textStatus, errorThrown);
                }
            });
        }

        function onScanFailure(error) {}

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 10,
                qrbox: {
                    width: 250,
                    height: 250
                }
            },
            /* verbose= */
            false);
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>
@stop
