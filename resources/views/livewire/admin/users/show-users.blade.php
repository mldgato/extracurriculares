<div wire:init="loadUsers">
    <div wire:ignore.self class="modal fade" id="a" tabindex="-1" role="dialog" aria-labelledby="UpdateNewCycle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="UpdateUserData">Actualizar usuario</h5>
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

    <div wire:ignore.self class="modal fade" id="UpdateUserPass" tabindex="-1" role="dialog"
        aria-labelledby="UpdateUserPass" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Actualizar Contraseña del Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        @csrf
                        <div class="form-group">
                            <label for="password">Contraseña:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-unlock-alt"></i></span>
                                </div>
                                <input type="password" class="form-control" id="password"
                                    placeholder="Escriba la nueva contraseña" wire:model="password">
                            </div>
                            @error('password')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_repeat">Repetir:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-redo-alt"></i></span>
                                </div>
                                <input type="password" class="form-control" id="password_repeat"
                                    placeholder="Repita la nueva contraseña" wire:model="password_repeat">
                            </div>
                            @error('password_repeat')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button wire:click="resetFields" type="button" class="btn btn-danger" data-dismiss="modal"><i
                            class="fas fa-window-close"></i> Cerrar</button>

                    <button wire:click.prevent="updatePass" type="button" class="btn btn-success"
                        wire:loading.attr="disabled" wire:loading.class.remove="btn-success"
                        wire:loading.class="btn btn-warning" wire:target="updatePass"><span wire:loading.remove
                            wire:target="updatePass"><i class="fas fa-exchange-alt"></i> Actualizar</span><span
                            wire:loading wire:target="updatePass"><i class="fas fa-spinner fa-pulse"></i>
                            Actualizando</span></button>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="UpdateUserRole" tabindex="-1" role="dialog"
        aria-labelledby="UpdateUserRole" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Asignar roles de usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        @csrf
                        <div class="form-group">
                            <label for="name">Usuario:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                                </div>
                                <input type="text" class="form-control" id="name"
                                    placeholder="Escriba el nombre completo del usuario" wire:model="name" disabled>
                            </div>
                        </div>
                        @foreach ($roles as $role)
                            <div>
                                <label>
                                    <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                                        wire:model="selectedRoles"
                                        {{ in_array($role->id, $selectedRoles) ? 'checked' : '' }}>
                                    {{ $role->name }}
                                </label>
                            </div>
                        @endforeach
                    </form>
                </div>
                <div class="modal-footer">
                    <button wire:click="resetFields" type="button" class="btn btn-danger" data-dismiss="modal"><i
                            class="fas fa-window-close"></i> Cerrar</button>

                    <button wire:click.prevent="updateRole" type="button" class="btn btn-success"
                        wire:loading.attr="disabled" wire:loading.class.remove="btn-success"
                        wire:loading.class="btn btn-warning" wire:target="updateRole"><span wire:loading.remove
                            wire:target="updateRole"><i class="fas fa-exchange-alt"></i> Actualizar</span><span
                            wire:loading wire:target="updateRole"><i class="fas fa-spinner fa-pulse"></i>
                            Actualizando</span></button>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="CreateNewCycle" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" role="dialog" aria-labelledby="CreateNewCycleLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="CreateNewCycleLabel">Crear nuevo usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form autocomplete="off">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nombres:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i
                                            class="fas fa-user"></i></span>
                                </div>
                                <input type="text" class="form-control" id="name"
                                    placeholder="Escriba el nombre del usuario" wire:model="name" />
                            </div>
                            @error('name')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="surname">Apellidos:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i
                                            class="far fa-user"></i></span>
                                </div>
                                <input type="text" class="form-control" id="surname"
                                    placeholder="Escriba el nombre del usuario" wire:model="surname" />
                            </div>
                            @error('surname')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i
                                            class="fas fa-envelope"></i></span>
                                </div>
                                <input type="email" class="form-control" id="email"
                                    placeholder="Escriba el nombre del usuario" wire:model="email" />
                            </div>
                            @error('email')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-unlock-alt"></i></span>
                                </div>
                                <input type="password" class="form-control" id="password"
                                    placeholder="Escriba la nueva contraseña" wire:model="password">
                            </div>
                            @error('password')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_repeat">Repetir:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-redo-alt"></i></span>
                                </div>
                                <input type="password" class="form-control" id="password_repeat"
                                    placeholder="Repita la nueva contraseña" wire:model="password_repeat">
                            </div>
                            @error('password_repeat')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger close-btn" data-dismiss="modal"
                        wire:click="resetFields"><i class="fas fa-window-close"></i>
                        Cerrar</button>

                    <button type="button" class="btn btn-success" wire:click="save" wire:loading.attr="disabled"
                        wire:loading.class.remove="btn-success" wire:loading.class="btn btn-warning"
                        wire:target="save"><span wire:loading.remove wire:target="save"><i class="fas fa-save"></i>
                            Guardar</span><span wire:loading wire:target="save"><i
                                class="fas fa-spinner fa-pulse"></i>
                            Guardando</span></button>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-outline card-primary mb-3">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex justify-content-end">
                        <!-- Button -->
                        <button type="button" class="btn btn-outline-primary btn-lg ml-2" data-toggle="modal"
                            data-target="#CreateNewCycle">
                            <i class="fas fa-plus-circle"></i> Nuevo usuario
                        </button>
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
                                        data-target="#UpdateUserData" class="btn btn-success btn-sm mr-2"
                                        title="Editar"><i class="fas fa-edit fa-fw"></i></button>

                                    <button wire:click="edit({{ $user->id }})" data-toggle="modal"
                                        data-target="#UpdateUserPass" class="btn btn-primary btn-sm mr-2"
                                        title="Editar"><i class="fas fa-lock"></i></button>

                                    <button wire:click="edit({{ $user->id }})" data-toggle="modal"
                                        data-target="#UpdateUserRole" class="btn btn-warning btn-sm mr-2"
                                        title="Editar"><i class="fas fa-user-tag"></i></button>
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
    @section('js')
        <script type="text/javascript">
            Livewire.on('deleteCycle', cycleId => {
                Swal.fire({
                    title: 'Eiminar registro',
                    html: "<p><strong>¿Está seguro que quiere eliminar el ciclo?</strong></p><p>Tome en cuenta que no se podrá eliminar si el ciclo se encuentra en una asignación.</p>",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, elimiar!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.dispatchTo('admin.activities.activity-info', 'delete', {
                            cycle: cycleId
                        });
                    }
                });
            });
            Livewire.on('closeModalMessaje', (title, message, type, mymodal) => {
                if (title[3] != 'null') {
                    $('#' + title[3]).modal('hide');
                }
                Swal.fire({
                    position: 'top-end',
                    icon: title[2],
                    title: title[0],
                    text: title[1],
                    showConfirmButton: false,
                    timer: 3000
                });
            });
        </script>
    @stop
</div>
