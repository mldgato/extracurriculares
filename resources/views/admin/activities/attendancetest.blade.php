@extends('adminlte::page')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <form action="{{ route('admin.activities.registerAttendance') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="codschool">Carné:</label>
                    <input type="text" name="codschool" id="codschool" required readonly value="20130749"
                        class="form-control">
                    <input type="hidden" name="activity" id="activity" value="{{ $activity->id }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-success btn-lg">Enviar</button>
            </div>
        </div>
    </form>
@stop

@section('css')

@stop

@section('js')

@stop
