<div wire:init="loadUsers">
    <div wire:ignore.self class="modal fade" id="UpdateNewCycle" tabindex="-1" role="dialog"
        aria-labelledby="UpdateNewCycle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="UpdateNewCycle">Actualizar usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        @csrf
                        <div class="form-group">
                            <label>Nombres:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Escriba los nombres del usuario"
                                    wire:model="name">
                            </div>
                            @error('name')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Apellidos:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-user"></i></span>
                                </div>
                                <input type="text" class="form-control"
                                    placeholder="Escriba los apellidos del usuario" wire:model="surname">
                            </div>
                            @error('surname')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Email:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Escriba el email del usuario"
                                    wire:model="email">
                            </div>
                            @error('email')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button wire:click="resetFields" type="button" class="btn btn-danger" data-dismiss="modal"><i
                            class="fas fa-window-close"></i> Cerrar</button>

                    <button wire:click.prevent="update" type="button" class="btn btn-success"
                        wire:loading.attr="disabled" wire:loading.class.remove="btn-success"
                        wire:loading.class="btn btn-warning" wire:target="update"><span wire:loading.remove
                            wire:target="update"><i class="fas fa-exchange-alt"></i> Actualizar</span><span wire:loading
                            wire:target="update"><i class="fas fa-spinner fa-pulse"></i> Actualizando</span></button>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-outline card-primary mb-3">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex justify-content-end">
                        {{-- <a href="{{ route('admin.users.create') }}" class="btn btn-outline-info btn-lg">
                            <i class="fas fa-user-plus fa-fw"></i> Nuevo usuario
                        </a> --}}
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12 col-md-3 mb-2">
                    <div class="d-flex align-items-center">
                        <span><strong>Mostrar</strong></span>
                        <span class="ml-2">
                            <select wire:model.live="cant" class="form-control">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </span>
                        <span class="ml-2"><strong>registros</strong></span>
                    </div>
                </div>
                <div class="col-12 col-md-9">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                        </div>
                        <input wire:model.live="search" id="searcher" type="text" class="form-control"
                            placeholder="Escriba el nombre o apellido del usuario" autofocus="autofocus" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex justify-content-end">
                    </div>
                </div>
            </div>
        </div>
        @if (count($users))
            <div class="card-body">
                <table class="table table-striped table-hover table-sm">
                    <thead>
                        <tr>
                            <th role="button" wire:click="order('surname')">
                                Apellidos
                                @if ($sort == 'surname')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-up ml-4"></i>
                                    @else
                                        <i class="fas fa-sort-down ml-4"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort ml-4"></i>
                                @endif
                            </th>
                            <th role="button" wire:click="order('name')">
                                Nombres
                                @if ($sort == 'name')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-up ml-4"></i>
                                    @else
                                        <i class="fas fa-sort-down ml-4"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort ml-4"></i>
                                @endif
                            </th>
                            <th class="d-none d-md-table-cell">Email</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="align-middle">{{ $user->surname }}</td>
                                <td class="align-middle">{{ $user->name }}</td>
                                <td class="d-none d-md-table-cell align-middle">{{ $user->email }}</td>
                                <td class="align-middle">
                                    <button wire:click="edit({{ $user->id }})" data-toggle="modal"
                                        data-target="#UpdateNewCycle" class="btn btn-primary btn-sm mr-2"><span
                                            class="d-none d-lg-block"><i class="fas fa-edit fa-fw"></i>
                                            Editar</span><span class="d-lg-none"><i
                                                class="fas fa-edit fa-fw"></i></span></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Apellidos</th>
                            <th>Nombres</th>
                            <th class="d-none d-md-table-cell">Email</th>
                            <th>&nbsp;</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            @if ($users->hasPages())
                <div class="card-footer">
                    <div class="d-flex justify-content-end">{{ $users->links() }}</div>
                </div>
            @endif
        @else
            <div class="card-body">
                @if ($this->readyToLoad)
                    <strong>No hay ningún registro...</strong>
                @else
                    <div class="row">
                        <div class="col text-center my-4">
                            <i class="fas fa-spinner fa-pulse fa-3x"></i>
                        </div>
                    </div>
                @endif

            </div>
        @endif

    </div>
</div>
