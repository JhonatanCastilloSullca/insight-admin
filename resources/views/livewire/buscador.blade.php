<div class="main-header-center ms-4 d-sm-none d-md-none d-lg-block form-group">
    <input class="form-control" placeholder="Buscar..." type="search" wire:model.defer="search" wire:keydown.enter="buscar">
    <button class="btn" wire:click="buscar()"><i class="fas fa-search"></i></button>
</div>