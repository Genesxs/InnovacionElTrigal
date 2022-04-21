@extends('adminlte::page')

@section('title', 'Admin')

@section('content_header')

    @can('admin.home.admin')
        <h1>Evaluar idea <p class="text-info">{{ $idea->nombre }}</p>
        </h1>
    @endcan
    @can('admin.home.innovador')
        <h1>Editar idea <p class="text-info">{{ $idea->nombre }}</p>
        </h1>
    @endcan
@stop

@section('content')


    @if (session('info'))
        <div class="alert  alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            {!! Form::model($idea, ['route' => ['admin.ideas.update', $idea], 'method' => 'put']) !!}


            @can('admin.home.innovador')
                <div class="form-group">
                    {!! Form::label('nombre', 'Nombre') !!}
                    {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Escriba el nombre de su idea']) !!}

                    @error('nombre')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('descripcion', 'Descripción') !!}
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
                    {!! Form::select('proceso_impacto_id', $procesoImpactos, null, ['class' => 'form-control', 'placeholder' => 'Seleccione un proceso de impacto...']) !!}

                    @error('proceso_impacto')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                </div>
            @endcan

            @can('admin.home.admin')
                <div class="form-group">
                    {!! Form::label('nombre', 'Nombre') !!}
                    {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Escriba el nombre de su idea', 'disabled readonly']) !!}

                    @error('nombre')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('descripcion', 'Descripción') !!}
                    {!! Form::textarea('descripcion', null, ['class' => 'form-control', 'placeholder' => 'Describa su idea', 'disabled readonly']) !!}

                    @error('descripcion')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('categoria_id', 'Categoría') !!}
                    {!! Form::select('categoria_id', $categorias, null, ['class' => 'form-control', 'placeholder' => 'Seleccione una categoría...', 'disabled readonly']) !!}

                    @error('categoria')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>


                <div class="form-group">
                    {!! Form::label('proceso_impacto_id', 'Proceso de impacto') !!}
                    {!! Form::select('proceso_impacto_id', $procesoImpactos, null, ['class' => 'form-control', 'placeholder' => 'Seleccione un proceso de impacto...', 'disabled readonly']) !!}

                    @error('proceso_impacto')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('estado', 'Estado') !!}
                    {!! Form::select('estado', ['Inscrita' => 'Inscrita', 'Aceptada' => 'Aceptada', 'Rechazada' => 'Rechazada', 'Reformular' => 'Reformular'], null, ['class' => 'form-control', 'placeholder' => 'Seleccione una categoría...']) !!}

                    @error('categoria')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                </div>

                <div class="form-group">
                    {!! Form::label('observacion', 'Observación') !!}
                    {!! Form::textarea('observacion', null, ['class' => 'form-control', 'placeholder' => 'Escriba su observación']) !!}

                    @error('observacion')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            @endcan

            @can('admin.home.innovador')
                {!! Form::submit('Editar idea', ['class' => 'btn btn-info']) !!}
            @endcan

            @can('admin.home.admin')
                {!! Form::submit('Evaluar', ['class' => 'btn btn-info']) !!}
            @endcan

            {!! Form::close() !!}
        </div>
    </div>

@stop

@section('css')
    <!--<link rel="stylesheet" href="/css/admin_custom.css">-->
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
