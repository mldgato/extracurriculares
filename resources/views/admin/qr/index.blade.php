<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    {{-- @foreach ($alumnos as $codigo => $infoAlumno)
        <div>
            {!! QrCode::size(500)->generate($codigo) !!}
            <p>{{ $infoAlumno['nombres'] }} {{ $infoAlumno['apellidos'] }}</p>
            <p>{{ $codigo }}</p>
            <a href="{{ asset('storage/qrcodes/' . $codigo . '_' . $infoAlumno['apellidos'] . '_' . $infoAlumno['nombres'] . '.png') }}"
                download>Descargar</a>
        </div>
    @endforeach --}}
</body>

</html>
