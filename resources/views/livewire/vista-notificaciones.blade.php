<div class="">
    <li class="dropdown nav-item main-header-notification d-flex">
        <a class="new nav-link"  data-bs-toggle="dropdown" href="javascript:void(0);">
            <svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" width="24" height="24" viewBox="0 0 24 24"><path d="M19 13.586V10c0-3.217-2.185-5.927-5.145-6.742C13.562 2.52 12.846 2 12 2s-1.562.52-1.855 1.258C7.185 4.074 5 6.783 5 10v3.586l-1.707 1.707A.996.996 0 0 0 3 16v2a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1v-2a.996.996 0 0 0-.293-.707L19 13.586zM19 17H5v-.586l1.707-1.707A.996.996 0 0 0 7 14v-4c0-2.757 2.243-5 5-5s5 2.243 5 5v4c0 .266.105.52.293.707L19 16.414V17zm-7 5a2.98 2.98 0 0 0 2.818-2H9.182A2.98 2.98 0 0 0 12 22z"/></svg>
            @if(count($notificaciones)>0)
                <span class="badge bg-secondary header-badge">{{count($notificaciones)}}</span>
            @else
                <span class=" pulse"></span>
            @endif
        </a>
        @if(count($notificaciones)>0)
            <div class="dropdown-menu">
                <div class="main-notification-list Notification-scroll overflow-auto">
                    @foreach ($notificaciones as $notificacion )
                        <a class="d-flex p-3 border-bottom pe-auto" style="cursor:pointer;" wire:click="Leido({{$notificacion->id}})">
                            <div class="">
                                @if ($notificacion->tipo == 0)
                                    <i class="fa fa-map text-white notifyimg bg-success"></i>
                                @elseif ($notificacion->tipo == 1)
                                    <i class="fa fa-hotel text-white notifyimg bg-warning"></i>
                                @elseif ($notificacion->tipo == 2)
                                    <i class="fa fa-plane text-white notifyimg bg-dark"></i>
                                @elseif ($notificacion->tipo == 3)
                                    <i class="mdi mdi-cake-variant text-white notifyimg bg-info"></i>
                                @elseif ($notificacion->tipo == 4)
                                    <i class="fa fa-check-double text-white notifyimg bg-secondary"></i>
                                @else
                                    <i class="fa fa-envelope text-white notifyimg bg-danger"></i>
                                @endif
                            </div>
                            <div class="ms-3">
                                <h5 class="notification-label mb-1">{{ $notificacion->notificacion }}</h5>
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="dropdown-footer">
                    <a class="btn btn-primary btn-sm btn-block" href="{{ route('notificacion.index') }} ">Ver todos</a>
                </div>
            </div>
        @endif
    </li>
</div>

@push('custom-scripts')
<script>
    Livewire.on('notificacionActualizada', () => {
            Livewire.emit('refresh');
        });
</script>
@endpush

