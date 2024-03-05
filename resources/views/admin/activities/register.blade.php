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
            var codschool = decodedText;
            var token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/admin/activities/enrollment',
                type: 'POST',
                data: {
                    codschool: codschool,
                    activity: activity
                },
                headers: {
                    'X-CSRF-TOKEN': token
                },
                success: function(response) {
                    if (response == 1) {
                        showSuccessAlert();
                    } else {
                        showErrorAlert();
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    /* console.log(textStatus, errorThrown);
                    showErrorAlert(); */
                }
            });
        }

        function showSuccessAlert() {
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: 'Operación exitosa',
                showConfirmButton: false,
                timer: 2000
            });
        }

        function showErrorAlert() {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Ha ocurrido un problema',
                showConfirmButton: false,
                timer: 2000
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
