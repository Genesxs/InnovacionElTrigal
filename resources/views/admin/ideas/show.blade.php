@extends('adminlte::page')

@section('title', 'Admin')

@section('content_header')
@stop

@section('content')


    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detalles idea</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right" href="{{ route('admin.ideas.index') }}">
                        Back
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">
            <div class="card-body">
                <div class="row">


                    <div class="col-sm-12">
                        {!! Form::label('nombre', 'Nombre:') !!}
                        <p>{{ $idea->nombre }}</p>
                    </div>

                    <div class="col-sm-12">
                        {!! Form::label('descripcion', 'Descripción:') !!}
                        <p>{{ $idea->descripcion }}</p>
                    </div>

                    <div class="col-sm-12">
                        {!! Form::label('observacion', 'Observación:') !!}
                        <p>{{ $idea->observacion }}</p>
                    </div>

                    <div class="col-sm-12">
                        {!! Form::label('estado', 'Estado:') !!}
                        <p>{{ $idea->estado }}</p>
                    </div>

                    {{-- <div class="col-sm-12">
                        {!! Form::label('url_photo', 'Foto:') !!}
                        <img id="imgAvatar" class="d-flex align-self-start rounded mr-2"
                            src="{{ asset($employee->url_photo) }}" alt="" height="200">
                    </div> --}}

                </div>
            </div>
        </div>
    </div>

@stop

@section('css')
    <!--  <link rel="stylesheet" href="/css/admin_custom.css">-->
@stop

@section('js')
    <script>

    </script>
@stop
