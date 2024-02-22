<div>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <h5 class="text-danger">Actualizar orden de vista<h5>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.sections.index') }}" class="btn btn-outline-success btn-lg">
                            <i class="fas fa-cogs fa-fw"></i> Administrar secciones
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-12">
                    <p>Haz clic en el ícono de <span class="badge badge-secondary"><i
                                class="fas fa-arrows-alt"></i></span> y arrastra en la posición adecuada.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <ul wire:sortable="updateTaskOrder" class="list-group">
                        @foreach ($sections as $section)
                            <li wire:sortable.item="{{ $section->id }}" wire:key="section-{{ $section->id }}"
                                class="list-group-item list-group-item-action list-group-item-light d-flex justify-content-between align-items-center">
                                <h4>{{ $section->section_name }}</h4>
                                <h4 wire:sortable.handle class="badge badge-primary" style="cursor: move;"><i
                                        class="fas fa-arrows-alt"></i></h4>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@section('css')
    <style type="text/css">
        .draggable-mirror {
            background-color: darkgray;
            display: flex;
            justify-content: space-between;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            z-index: 1000 !important;
        }
    </style>
@stop
@section('js')
    <script src="https://unpkg.com/@nextapps-be/livewire-sortablejs@0.4.0/dist/livewire-sortable.js"></script>
    <script>
        Livewire.on('showAlert', (title, message, type) => {
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
