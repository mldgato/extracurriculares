@extends('adminlte::page')

@section('content_header')
    <h1>Actividad: <span class="text-primary">{{ $activity->activity }}</span></h1>
@stop

@section('content')
    @livewire('admin.activities.activity-info', ['activity' => $activity])
@stop

@section('css')

@stop

@section('js')

@stop
