<div wire:init="loadActivities">
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="UpdateNewCycle" tabindex="-1" role="dialog"
        aria-labelledby="UpdateNewCycle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="UpdateNewCycle">Actualizar un actividad</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Actividad:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-drum"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Escriba el nombre del nivel"
                                    wire:model="activity">
                            </div>
                            @error('activity')
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
                        <!-- Button -->
                        <button type="button" class="btn btn-outline-primary btn-lg ml-2" data-toggle="modal"
                            data-target="#CreateNewCycle">
                            <i class="fas fa-plus-circle"></i> Nueva actividad
                        </button>

                        <!-- Modal -->
                        <div wire:ignore.self class="modal fade" id="CreateNewCycle" data-bs-backdrop="static"
                            data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="CreateNewCycleLabel"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="CreateNewCycleLabel">Crear una nueva actividad</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true close-btn">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            @csrf
                                            <div class="form-group">
                                                <label for="cicleNew">Actividad:</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1"><i
                                                                class="fas fa-calendar-alt"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" id="cicleNew"
                                                        placeholder="Escriba el nombre de la actividad"
                                                        wire:model="activity" />
                                                </div>
                                                @error('activity')
                                                    <span class="text-danger error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger close-btn" data-dismiss="modal"
                                            wire:click="resetFields"><i class="fas fa-window-close"></i>
                                            Cerrar</button>

                                        <button type="button" class="btn btn-success" wire:click="save"
                                            wire:loading.attr="disabled" wire:loading.class.remove="btn-success"
                                            wire:loading.class="btn btn-warning" wire:target="save"><span
                                                wire:loading.remove wire:target="save"><i class="fas fa-save"></i>
                                                Guardar</span><span wire:loading wire:target="save"><i
                                                    class="fas fa-spinner fa-pulse"></i>
                                                Guardando</span></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12 col-md-3 mb-2">
                    <div class="d-flex align-items-center">
                        <span><strong>Mostrar</strong></span>
                        <span class="ml-2">
                            <select wire:model.live="cant" class="form-control">
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
                            placeholder="Escriba nombre de la actividad" autofocus="autofocus" />
                    </div>
                </div>
            </div>
        </div>
        @if (count($activities))
            <div class="card-body">
                <table id="CyclesTable" class="table table-striped table-hover table-sm">
                    <thead>
                        <tr>
                            <th style="cursor: pointer" wire:click="order('order')">
                                #
                                @if ($sort == 'order')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-up ml-4"></i>
                                    @else
                                        <i class="fas fa-sort-down ml-4"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort ml-4"></i>
                                @endif
                            </th>
                            <th style="cursor: pointer" wire:click="order('cycle_name')">
                                Nivel
                                @if ($sort == 'cycle_name')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-up ml-4"></i>
                                    @else
                                        <i class="fas fa-sort-down ml-4"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort ml-4"></i>
                                @endif
                            </th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($activities as $activity)
                            <tr>
                                <td>{{ $cycle->order }}</td>
                                <td>{{ $cycle->cycle_name }}</td>
                                <td class="text-right">
                                    <button wire:click="edit({{ $cycle->id }})" data-toggle="modal"
                                        data-target="#UpdateNewCycle" class="btn btn-primary btn-sm mr-2"><span
                                            class="d-none d-lg-block"><i class="fas fa-edit fa-fw"></i>
                                            Editar</span><span class="d-lg-none"><i
                                                class="fas fa-edit fa-fw"></i></span></button>

                                    <button wire:click="$dispatch('deleteCycle', {{ $cycle->id }})"
                                        class="btn btn-danger btn-sm"><span class="d-none d-lg-block"><i
                                                class="fas fa-trash"></i> Eliminar</span><span class="d-lg-none"><i
                                                class="fas fa-trash"></i></span></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Nivel</th>
                            <th>&nbsp;</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            @if ($activities->hasPages())
                <div class="card-footer">
                    <div class="d-flex justify-content-end">{{ $activities->links() }}</div>
                </div>
            @endif
        @else
            <div class="card-body">
                <strong class="text-danger">No se han encontrado registros...</strong>
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
                        Livewire.dispatchTo('admin.cycles.show-cycles', 'delete', {
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
