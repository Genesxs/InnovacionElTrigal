@extends('adminlte::page')

@section('title', 'Admin')

@section('content_header')
    <h1>Participantes de la idea: {{ $nombre_idea->nombre }}</h1>
@stop

@section('content')
    @livewireStyles
    <div>

        @if (session('info'))
            <div class="alert  alert-success">
                <strong>{{ session('info') }}</strong>

            </div>
        @endif


        @can('admin.home.admin')
        <div class="form-group">

            <div class="card-body mt-5">
                <table class="table table-striped text-center">
                    <thead class="bg-dark">
                        <th>Número identificación</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        </tr>
                    </thead>
        
                    <tbody>
                        @if (count($ideas_user) > 0)
                            @foreach ($ideas_user as $ideas_user)
                                <tr class="text-center text-dark">
                                    <td>{{ $ideas_user->documento_identificacion }}</td>
                                    <td>{{ $ideas_user->name }}</td>
                                    <td>{{ $ideas_user->apellidos }}</td>
        
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5">No hay participantes inscritos</td>
                            </tr>
                        @endif
                    </tbody>
        
        
                </table>
            </div>
            @endcan

            @can('admin.home.innovador')
                @livewire('crear-participante', ['idea' => $idea])
            @endcan

        </div>

    </div>
    @livewireScripts
@stop

@section('css')
    <!--  <link rel="stylesheet" href="/css/admin_custom.css">-->
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
