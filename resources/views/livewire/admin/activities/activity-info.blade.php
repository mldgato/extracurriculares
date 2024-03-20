<div wire:init="loadUsers">
    <div class="card card-outline card-primary mb-3">
        <div class="card-header">
            <form>
                @csrf
                <div class="row align-items-start justify-content-end">
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label for="user_id" class="sr-only">Usuarios:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-users"></i></span>
                                </div>
                                <select name="user_id" id="user_id" class="form-control" wire:model="user_id">
                                    <option value="" selected>- Seleccione un usuario -</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">
                                            {{ $user->surname . ' ' . $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('user_id')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <button type="button" class="btn btn-success" wire:click="save" wire:loading.attr="disabled"
                            wire:loading.class.remove="btn-success" wire:loading.class="btn btn-warning"
                            wire:target="save"><span wire:loading.remove wire:target="save"><i class="fas fa-save"></i>
                                Guardar</span><span wire:loading wire:target="save"><i
                                    class="fas fa-spinner fa-pulse"></i>
                                Guardando</span></button>
                    </div>
                </div>
            </form>
        </div>
        @if (count($activityUsers))
            <div class="card-body">
                <table id="CyclesTable" class="table table-striped table-hover table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Apellidos</th>
                            <th>Nombres</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($activityUsers as $activityUser)
                            <tr>
                                <td>{{ $activityUser->id }}</td>
                                <td>{{ $activityUser->surname }}</td>
                                <td>{{ $activityUser->name }}</td>
                                <td class="text-right">
                                    <button wire:click="confirmDelete({{ $activityUser->id }})"
                                        class="btn btn-danger btn-sm">
                                        <span class="d-none d-lg-block"><i class="fas fa-trash"></i> Eliminar</span>
                                        <span class="d-lg-none"><i class="fas fa-trash"></i></span>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Apellidos</th>
                            <th>Nombres</th>
                            <th>&nbsp;</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        @else
            <div class="card-body">
                <strong class="text-danger">No se han encontrado registros...</strong>
            </div>
        @endif
    </div>

    @section('js')
        <script type="text/javascript">
            Livewire.on('confirmDelete', userId => {
                Swal.fire({
                    title: 'Eliminar registro',
                    html: "<p><strong>¿Está seguro que quiere eliminar la asignación?</strong></p><p>Tome en cuenta que no se podrá eliminar si en la asignación hay estudiantes inscritos.</p>",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, eliminar!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.dispatch('delete', userId);
                    }
                })
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
            Livewire.on('refreshComponent', event => {
                Livewire.dispatch('render');
            });
        </script>
    @stop
</div>
