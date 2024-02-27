<div wire:init="loadClassrooms">
    <div class="card card-outline card-primary mb-3">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex justify-content-end">
                        <div>
                            <!-- Button -->
                            <button type="button" class="btn btn-outline-primary btn-lg" data-toggle="modal"
                                data-target="#CreateNewGradeassignment">
                                <i class="fas fa-plus-circle"></i> Nueva asignación
                            </button>
                            <!-- Modal -->
                            <div wire:ignore.self class="modal fade" id="CreateNewGradeassignment"
                                data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
                                aria-labelledby="CreateNewGradeassignmentLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="CreateNewGradeassignmentLabel">Crear una
                                                Asignación</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true close-btn">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                @csrf
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="cycle_id">Ciclo:</label>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text" id="basic-addon1"><i
                                                                            class="fas fa-calendar-alt"></i></span>
                                                                </div>
                                                                <select name="cycle_id" id="cycle_id"
                                                                    class="form-control" wire:model="cycle_id">
                                                                    <option value="">- Seleccione -</option>
                                                                    @foreach ($cycles as $cycle)
                                                                        <option value="{{ $cycle->id }}">
                                                                            {{ $cycle->cycle_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            @error('cycle_id')
                                                                <span class="text-danger error">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="level_id">Nivel:</label>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text" id="basic-addon1"><i
                                                                            class="fas fa-forward"></i></span>
                                                                </div>
                                                                <select name="level_id" id="level_id"
                                                                    class="form-control" wire:model="level_id">
                                                                    <option value="">- Seleccione -</option>
                                                                    @foreach ($leves as $level)
                                                                        <option value="{{ $level->id }}">
                                                                            {{ $level->level_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            @error('level_id')
                                                                <span class="text-danger error">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="grade_id">Grado:</label>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text" id="basic-addon1"><i
                                                                            class="fas fa-graduation-cap"></i></span>
                                                                </div>
                                                                <select name="grade_id" id="grade_id"
                                                                    class="form-control" wire:model="grade_id">
                                                                    <option value="">- Seleccione -</option>
                                                                    @foreach ($grades as $grade)
                                                                        <option value="{{ $grade->id }}">
                                                                            {{ $grade->grade_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            @error('grade_id')
                                                                <span class="text-danger error">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="section_id">Sección:</label>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text" id="basic-addon1"><i
                                                                            class="fas fa-grip-horizontal"></i></span>
                                                                </div>
                                                                <select name="section_id" id="section_id"
                                                                    class="form-control" wire:model="section_id">
                                                                    <option value="">- Seleccione -</option>
                                                                    @foreach ($sections as $section)
                                                                        <option value="{{ $section->id }}">
                                                                            {{ $section->section_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            @error('section_id')
                                                                <span class="text-danger error">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
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
                            placeholder="Puede escribir el ciclo, nivel, grado o sección" autofocus="autofocus" />
                    </div>
                </div>
            </div>
        </div>
        @if (count($classrooms))
            <div class="card-body">
                <table id="GradeassignmentsTable" class="table table-striped table-hover table-sm">
                    <thead>
                        <tr>
                            <th style="cursor: pointer" wire:click="order('id')">
                                Cod.
                                @if ($sort == 'id')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-up ml-4"></i>
                                    @else
                                        <i class="fas fa-sort-down ml-4"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort ml-4"></i>
                                @endif
                            </th>
                            <th style="cursor: pointer" wire:click="order('elciclo')">
                                Ciclo
                                @if ($sort == 'elciclo')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-up ml-4"></i>
                                    @else
                                        <i class="fas fa-sort-down ml-4"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort ml-4"></i>
                                @endif
                            </th>
                            <th style="cursor: pointer" wire:click="order('elnivel')">
                                Nivel
                                @if ($sort == 'elnivel')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-up ml-4"></i>
                                    @else
                                        <i class="fas fa-sort-down ml-4"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort ml-4"></i>
                                @endif
                            </th>
                            <th style="cursor: pointer" wire:click="order('elgrado')">
                                Grado
                                @if ($sort == 'elgrado')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-up ml-4"></i>
                                    @else
                                        <i class="fas fa-sort-down ml-4"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort ml-4"></i>
                                @endif
                            </th>
                            <th style="cursor: pointer" wire:click="order('laseccion')">
                                Sección
                                @if ($sort == 'laseccion')
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
                        @foreach ($classrooms as $classroom)
                            <tr>
                                <td>{{ $classroom->id }}</td>
                                <td>{{ $classroom->elciclo }}</td>
                                <td>{{ $classroom->elnivel }}</td>
                                <td>{{ $classroom->elgrado }}</td>
                                <td>{{ $classroom->laseccion }}</td>
                                <td class="text-right">
                                    <button wire:click="$dispatch('Gradeassignments', {{ $classroom->id }})"
                                        class="btn btn-danger btn-sm"><span class="d-none d-lg-block"><i
                                                class="fas fa-trash"></i> Eliminar</span><span class="d-lg-none"><i
                                                class="fas fa-trash"></i></span></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Cod.</th>
                            <th>Ciclo</th>
                            <th>Nivel</th>
                            <th>Grado</th>
                            <th>Sección</th>
                            <th>&nbsp;</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            @if ($classrooms->hasPages())
                <div class="card-footer">
                    <div class="d-flex justify-content-end">{{ $classrooms->links() }}</div>
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
            Livewire.on('Gradeassignments', classroomId => {
                Swal.fire({
                    title: 'Eiminar registro',
                    html: "<p><strong>¿Está seguro que quiere eliminar la asignación?</strong></p><p>Tome en cuenta que no se podrá eliminar si en la asignación hay estudiantes inscritos.</p>",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, elimiar!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.dispatchTo('admin.classroom.show-classroom', 'delete', {
                            classroom: classroomId
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
