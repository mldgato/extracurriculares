<div wire:init="loadStudents">
    <div class="card card-outline card-primary">
        <div class="card-header">
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
                        <input wire:model.live="search" id="searcher" type="search" class="form-control"
                            placeholder="Escriba el nombre o apellido del usuario" autofocus="autofocus" />
                    </div>
                </div>
            </div>
        </div>
        @if (count($students))
            <div class="card-body">
                <table class="table table-striped table-hover table-sm">
                    <thead>
                        <tr>
                            <th role="button" wire:click="order('codschool')">
                                Carné
                                @if ($sort == 'codschool')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-up ml-4"></i>
                                    @else
                                        <i class="fas fa-sort-down ml-4"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort ml-4"></i>
                                @endif
                            </th>
                            <th role="button" wire:click="order('lastname')">
                                Apellidos
                                @if ($sort == 'lastname')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-up ml-4"></i>
                                    @else
                                        <i class="fas fa-sort-down ml-4"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort ml-4"></i>
                                @endif
                            </th>
                            <th role="button" wire:click="order('firstname')">
                                Nombres
                                @if ($sort == 'firstname')
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
                        @foreach ($students as $student)
                            <tr>
                                <td class="align-middle">{{ $student->codschool }}</td>
                                <td class="align-middle">{{ $student->lastname }}</td>
                                <td class="align-middle">{{ $student->firstname }}</td>
                                <td class="align-middle">
                                    <a href="{{ route('admin.students.show', $student) }}"
                                        class="btn btn-primary btn-sm"><span class="d-none d-lg-block"><i
                                                class="fas fa-edit fa-fw"></i>
                                            Administrar</span><span class="d-lg-none"><i
                                                class="fas fa-edit fa-fw"></i></span></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Carné</th>
                            <th>Apellidos</th>
                            <th>Nombres</th>
                            <th>&nbsp;</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            @if ($students->hasPages())
                <div class="card-footer">
                    <div class="d-flex justify-content-end">{{ $students->links() }}</div>
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
