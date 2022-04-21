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
        <div class="card-header bg-dark">
            {{ auth()->user()->name }}
            {{-- {{$idUsuario  }} Rol: {{count($roles) }} {{$roles[0]->name}} --}}
            @can('admin.home.innovador')
                <a class="btn btn-success btn-sm ml-4" href="{{ route('admin.ideas.create') }}">
                    Agregar nueva idea
                </a>
            @endcan

        </div>
        <div class="card-body">
            <table class="table table-striped text-center">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Estado</th>
                        @can('admin.home.innovador')
                            <th>Descripción</th>
                            <th>Categoria</th>
                            <th>Proceso impacto</th>
                        @endcan
                        @can('admin.home.admin')
                            <th>Observación</th>
                        @endcan

                    </tr>
                </thead>


                <tbody>
                    @if (count($ideas) > 0)
                        @foreach ($ideas as $idea)
                            <tr class="text-center">
                                <td>{{ $idea->nombre }} </td>
                                <td>{{ $idea->estado }} </td>
                                @can('admin.home.innovador')
                                    <td>{{ $idea->descripcion }}</td>
                                @endcan
                                @can('admin.home.admin')
                                    <td>{{ $idea->observacion }} </td>
                                @endcan
                                <td>{{ $idea->dc }} </td>
                                <td>{{ $idea->dpi }} </td>



                                <td width="10px">
                                    <a href="{{ route('admin.show.idea', [$idea->id]) }}" class='btn btn-info btn-sm'>
                                        <i class="far fa-eye"></i>
                                    </a>
                                </td>

                                @can('admin.home.innovador')
                                    <td width="10px">
                                        <a href="{{ route('admin.ideas.edit', $idea) }}" class="btn btn-sm btn-default">
                                            Editar
                                        </a>
                                    </td>
                                @endcan

                                <td width="10px">
                                    <a href="{{ route('admin.show.participantes', $idea->id) }}"
                                        class="btn btn-sm btn-info">
                                        Participantes
                                    </a>
                                </td>

                                @can('admin.home.admin')
                                    <td width="10px">
                                        <a href="{{ route('admin.ideas.edit', $idea) }}" class="btn btn-sm btn-default">
                                            Evaluar
                                        </a>
                                    </td>
                                @endcan

                                <td width="10px">
                                    {{-- <form action="">
                                    <button class="btn btn-sm btn-danger">
                                        Eliminar
                                    </button>
                                </form> --}}
                                </td>
                            </tr>


                        @endforeach
                    @else
                        <tr>
                            <td colspan="5">No hay ideas inscritas</td>
                        </tr>

                    @endif
                </tbody>
            </table>
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
