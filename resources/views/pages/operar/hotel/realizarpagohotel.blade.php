@extends('layout.master')
@section('content')
<div class="main-container container-fluid">
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">Realizar pago Hotel</span>
        </div>
    </div>
    @livewire('realizar-pago-hotel', ['reserva' => $reserva])

</div>


@endsection

@push('plugin-scripts')
    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{ asset('plugins/sortablejs/Sortable.min.js') }}"></script>
@endpush

