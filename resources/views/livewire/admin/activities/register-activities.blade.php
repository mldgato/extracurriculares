<div>
    <div class="card card-outline card-primary mb-3">
        <div class="card-header">
            <h2>Escaneo <i class="fas fa-qrcode"></i></h2>
        </div>
        <div class="card-body">
            <div id="reader" width="600px"></div>
        </div>
    </div>

    @section('js')
        <script type="text/javascript">
            function onScanSuccess(decodedText, decodedResult) {
                Livewire.dispatchTo('admin.activities.register-activities', 'enroll', {
                    codschool: decodedText
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

            Livewire.on('closeModalMessaje', (title, message, type, mymodal) => {
                if (title[3] != 'null') {
                    $('#' + title[3]).modal('hide');
                }
                Swal.fire({
                    position: 'top-end',
                    icon: title[2],
                    title: title[0],
                    text: title[1],
                    showConfirmButton: false,
                    timer: 3000
                });
            });
        </script>
    @stop
</div>
