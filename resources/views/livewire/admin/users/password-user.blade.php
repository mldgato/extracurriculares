<div>
    <div class="row">
        <div class="col">
            <hr>
        </div>
    </div>
    <form>
        @csrf
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="form-group">
                    <label>Contraseña:</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        </div>
                        <input type="password" class="form-control" placeholder="Escriba su nueva contraseña"
                            wire:model="password">
                    </div>
                    @error('password')
                        <span class="text-danger error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="form-group">
                    <label>Repetir:</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        </div>
                        <input type="password" class="form-control" placeholder="Repita su nueva contraseña"
                            wire:model="repeat">
                    </div>
                    @error('repeat')
                        <span class="text-danger error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="d-flex justify-content-end">
                    <button wire:click.prevent="update" type="button" class="btn btn-success"
                        wire:loading.attr="disabled" wire:loading.class.remove="btn-success"
                        wire:loading.class="btn btn-warning" wire:target="update"><span wire:loading.remove
                            wire:target="update"><i class="fas fa-exchange-alt"></i> Actualizar</span><span wire:loading
                            wire:target="update"><i class="fas fa-spinner fa-pulse"></i> Actualizando</span></button>
                </div>
            </div>
        </div>
    </form>
</div>
