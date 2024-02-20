<!-- resources/views/scan-qr.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Scanner</title>
</head>

<body>
    <button id="startScan">Scan QR Code</button>
    <div id="qrResult"></div>

    <script src="{{ asset('js/instascan.min.js') }}"></script>
    <script>
        document.getElementById('startScan').addEventListener('click', function() {
            let scanner = new Instascan.Scanner({
                video: document.getElementById('qrResult')
            });

            scanner.addListener('scan', function(content) {
                alert('QR Code Content: ' + content);
            });

            Instascan.Camera.getCameras().then(function(cameras) {
                if (cameras.length > 0) {
                    scanner.start(cameras[0]);
                } else {
                    alert('No cameras found.');
                }
            }).catch(function(error) {
                console.error(error);
            });
        });
    </script>
</body>

</html>
