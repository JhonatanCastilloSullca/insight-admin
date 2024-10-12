@extends('layout.master')
@push('plugin-styles')
    <style>
        .tabla-reducida th, .tabla-reducida td {
            font-size: 0.78rem !important;
        }
        .no-wrap {
            white-space: nowrap;
        }
        .cursor-pointer {
            cursor: pointer;
        }
    </style>
@endpush
@section('content')
<div class="main-container container-fluid">
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">Editar Operacion Tours</span>
        </div>
    </div>
    @livewire('editar-operacion', ['operar' => $operar])


</div>


@endsection

@push('plugin-scripts')
    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{ asset('plugins/sortablejs/Sortable.min.js') }}"></script>
@endpush

