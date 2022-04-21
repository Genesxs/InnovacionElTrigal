@extends('adminlte::page')

@section('title', 'Admin')

@section('content_header')
    <h1>Lista de Ideas</h1>
@stop

@section('content')

    @if (session('info'))
        <div class="alert  alert-success">
            <strong>{{ session('info') }}</strong>

        </div>
    @endif

    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.ideas.store']) !!}

            <div class="form-group">
                {!! Form::label('nombre', 'Nombre') !!}
                {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Escriba el nombre de su idea']) !!}

                @error('nombre')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                {!! Form::label('descripcion', 'Descripcion') !!}
                {!! Form::textarea('descripcion', null, ['class' => 'form-control', 'placeholder' => 'Describa su idea']) !!}

                @error('descripcion')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                {!! Form::label('categoria_id', 'Categoría') !!}
                {!! Form::select('categoria_id', $categorias, null, ['class' => 'form-control', 'placeholder' => 'Seleccione una categoría...']) !!}

                @error('categoria')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

            </div>

            <div class="form-group">
                {!! Form::label('proceso_impacto_id', 'Proceso de impacto') !!}
                {!! Form::select('proceso_impacto_id', $procesosImpacto , null, ['class' => 'form-control', 'placeholder' => 'Seleccione un proceso de impacto...']) !!}

                @error('proceso_impacto')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

            </div>

            {!! Form::submit('Agregar idea', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>

@stop

@section('css')
    <!-- <link rel="stylesheet" href="/css/admin_custom.css">-->
@stop

@section('js')
    <script>
        
    </script>
@stop
