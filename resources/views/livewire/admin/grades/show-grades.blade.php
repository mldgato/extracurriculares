<div wire:init="loadGrades">
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="UpdateNewGrade" tabindex="-1" role="dialog"
        aria-labelledby="UpdateNewGradeLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="UpdateNewGradeLabel">Actualizar grado</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="levelNew">Grado:</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i
                                                    class="fas fa-graduation-cap"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="gradeNew"
                                            placeholder="Escriba el nombre del grado" wire:model="grade_name" />
                                    </div>
                                    @error('grade_name')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="levelNew">Nombre corto:</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i
                                                    class="fas fa-graduation-cap"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="short_nameNew"
                                            placeholder="Escriba el nombre corto del grado"
                                            wire:model="grade_short_name" />
                                    </div>
                                    @error('grade_short_name')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input wire:model="practices" type="checkbox" class="custom-control-input"
                                            id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">¿Prácticas?</label>
                                    </div>
                                </div>
                            </div>
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
                            wire:target="update"><i class="fas fa-spinner fa-pulse"></i> Actualizando</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.grades.order') }}" class="btn btn-outline-warning btn-lg">
                            <i class="fas fa-sort"></i> Ordenar
                        </a>
                        <div>
                            <!-- Button -->
                            <button type="button" class="btn btn-outline-primary btn-lg ml-2" data-toggle="modal"
                                data-target="#CreateNewGrade">
                                <i class="fas fa-plus-circle"></i> Nuevo grado
                            </button>

                            <!-- Modal -->
                            <div wire:ignore.self class="modal fade" id="CreateNewGrade" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1" role="dialog"
                                aria-labelledby="CreateNewGradeLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="CreateNewGradeLabel">Crear grado</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true close-btn">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                @csrf
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="levelNew">Grado:</label>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"
                                                                        id="basic-addon1"><i
                                                                            class="fas fa-graduation-cap"></i></span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    id="gradeNew"
                                                                    placeholder="Escriba el nombre del grado"
                                                                    wire:model="grade_name" />
                                                            </div>
                                                            @error('grade_name')
                                                                <span class="text-danger error">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="levelNew">Nombre corto:</label>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"
                                                                        id="basic-addon1"><i
                                                                            class="fas fa-graduation-cap"></i></span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    id="short_nameNew"
                                                                    placeholder="Escriba el nombre corto del grado"
                                                                    wire:model="grade_short_name" />
                                                            </div>
                                                            @error('grade_short_name')
                                                                <span class="text-danger error">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <div class="custom-control custom-checkbox">
                                                                <input wire:model="practices" type="checkbox"
                                                                    class="custom-control-input" id="customCheck1"
                                                                    style="z-index: 2000">
                                                                <label class="custom-control-label"
                                                                    for="customCheck1">¿Prácticas?</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger close-btn"
                                                data-dismiss="modal" wire:click="resetFields"><i
                                                    class="fas fa-window-close"></i> Cerrar</button>

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
            </div>
            <div class="row mt-2">
                <div class="col-12 col-md-3 mb-2">
                    <div class="d-flex align-items-center">
                        <span><strong>Mostrar</strong></span>
                        <span class="ml-2">
                            <select wire:model="cant" class="form-control">
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
                        <input wire:model="search" id="searcher" type="text" class="form-control"
                            placeholder="Escriba nombre del grado" autofocus="autofocus" />
                    </div>
                </div>
            </div>
        </div>
        @if (count($grades))
            <div class="card-body">
                <table id="GradesTable" class="table table-striped table-hover table-sm">
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
                            <th style="cursor: pointer" wire:click="order('grade_name')">
                                Grado
                                @if ($sort == 'grade_name')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-up ml-4"></i>
                                    @else
                                        <i class="fas fa-sort-down ml-4"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort ml-4"></i>
                                @endif
                            </th>
                            <th style="cursor: pointer" wire:click="order('practices')">
                                Prácticas
                                @if ($sort == 'practices')
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
                        @foreach ($grades as $grade)
                            <tr>
                                <td>{{ $grade->order }}</td>
                                <td>{{ $grade->grade_name }}</td>
                                <td>
                                    @if ($grade->practices == 1)
                                        <span class="badge badge-info p-1"><i class="fas fa-check-square fa-fw"></i>
                                            Realiza prácticas</span>
                                    @else
                                        <span class="badge badge-success p-1"><i
                                                class="fas fa-minus-square fa-fw"></i>
                                            No realiza prácticas</span>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <button wire:click="edit({{ $grade->id }})" data-toggle="modal"
                                        data-target="#UpdateNewGrade" class="btn btn-primary btn-sm mr-2"><span
                                            class="d-none d-lg-block"><i class="fas fa-edit fa-fw"></i>
                                            Editar</span><span class="d-lg-none"><i
                                                class="fas fa-edit fa-fw"></i></span></button>

                                    <button wire:click="$dispatch('deleteGrade', {{ $grade->id }})"
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
            @if ($grades->hasPages())
                <div class="card-footer">
                    <div class="d-flex justify-content-end">{{ $grades->links() }}</div>
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
            Livewire.on('deleteGrade', gradeId => {
                Swal.fire({
                    title: 'Eiminar registro',
                    html: "<p><strong>¿Está seguro que quiere eliminar el grado?</strong></p><p>Tome en cuenta que no se podrá eliminar si el grado se encuentra en una asignación.</p>",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, elimiar!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.dispatchTo('admin.grades.show-grades', 'delete', {
                            grade: gradeId
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
