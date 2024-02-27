<div wire:init="loadSections">
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="UpdateNewSection" tabindex="-1" role="dialog"
        aria-labelledby="UpdateNewSectionLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="UpdateNewSectionLabel">Actualizar sección</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Sección:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i
                                            class="fas fa-grip-horizontal"></i></span>
                                </div>
                                <input type="text" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Escriba el nombre de la sección" wire:model="section_name">
                            </div>
                            @error('section_name')
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
                        <a href="{{ route('admin.sections.order') }}" class="btn btn-outline-warning btn-lg">
                            <i class="fas fa-sort"></i> Ordenar
                        </a>
                        <div>
                            <!-- Button -->
                            <button type="button" class="btn btn-outline-primary btn-lg ml-2" data-toggle="modal"
                                data-target="#CreateNewSection">
                                <i class="fas fa-plus-circle"></i> Nueva sección
                            </button>

                            <!-- Modal -->
                            <div wire:ignore.self class="modal fade" id="CreateNewSection" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1" role="dialog"
                                aria-labelledby="CreateNewSectionLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="CreateNewSectionLabel">Crear un ciclo</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true close-btn">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                @csrf
                                                <div class="form-group">
                                                    <label for="cicleNew">Sección:</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1"><i
                                                                    class="fas fa-grip-horizontal"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="cicleNew"
                                                            placeholder="Escriba la sección"
                                                            wire:model="section_name" />
                                                    </div>
                                                    @error('section_name')
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
                                                        class="fas fa-spinner fa-pulse"></i> Guardando</span></button>
                                        </div>
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
                            placeholder="Escriba la sección" autofocus="autofocus" />
                    </div>
                </div>
            </div>
        </div>
        @if (count($sections))
            <div class="card-body">
                <table id="SectionsTable" class="table table-striped table-hover table-sm">
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
                            <th style="cursor: pointer" wire:click="order('section_name')">
                                Seccion
                                @if ($sort == 'section_name')
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
                        @foreach ($sections as $section)
                            <tr>
                                <td>{{ $section->order }}</td>
                                <td>{{ $section->section_name }}</td>
                                <td class="text-right">
                                    <button wire:click="edit({{ $section->id }})" data-toggle="modal"
                                        data-target="#UpdateNewSection" class="btn btn-primary btn-sm mr-2"><span
                                            class="d-none d-lg-block"><i class="fas fa-edit fa-fw"></i>
                                            Editar</span><span class="d-lg-none"><i
                                                class="fas fa-edit fa-fw"></i></span></button>

                                    <button wire:click="$dispatch('deleteSection', {{ $section->id }})"
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
            @if ($sections->hasPages())
                <div class="card-footer">
                    <div class="d-flex justify-content-end">{{ $section->links() }}</div>
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
            Livewire.on('deleteSection', sectionId => {
                Swal.fire({
                    title: 'Eiminar registro',
                    html: "<p><strong>¿Está seguro que quiere eliminar la sección?</strong></p><p>Tome en cuenta que no se podrá eliminar si la sección se encuentra en una asignación.</p>",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, elimiar!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.dispatchTo('admin.sections.show-sections', 'delete', {
                            section: sectionId
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
