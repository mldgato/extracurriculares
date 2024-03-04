<div>
    <div class="card card-outline card-primary mb-3">
        <div class="card-header">
            <h1>Escaneo <i class="fas fa-qrcode"></i></h1>
        </div>
        <div class="card-body">
            <div id="reader" width="600px"></div>
        </div>
    </div>

    @section('js')
        <script type="text/javascript">
            function onScanSuccess(decodedText, decodedResult) {
                // handle the scanned code as you like, for example:
                console.log(`Code matched = ${decodedText}`, decodedResult);
            }

            function onScanFailure(error) {
                // handle scan failure, usually better to ignore and keep scanning.
                // for example:
                console.warn(`Code scan error = ${error}`); 
            }

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
</div>
