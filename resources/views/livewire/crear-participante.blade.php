<div>
    <style>
        a {
            cursor: pointer;
        }

    </style>
    <form>
        <div class="row mt-5">
            <div class="col">

            </div>
            <div class="col">
                <input class="form-control " type="text" wire:model="user_id">
    

                <div class="mt-3 d-flex justify-content-center">
                @if ($consulta == 0)
                    <a class="btn btn-primary" wire:click="buscar()">buscar</a>
                @else
                    <a class="btn btn-success" wire:click="crear()">Agregar</a>
                @endif      
                </div>
                @if (session()->has('message'))
                        <div class="alert alert-success mt-3" role="alert">
                            {{ session('message') }}
                        </div>
                @endif
                
            </div>
            <div div class="col">
    
            </div>
        </div>          
    </form>

    <div class="card-body">
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

</div>
