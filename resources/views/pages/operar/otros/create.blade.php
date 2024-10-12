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

@livewire('crear-operacion-otros')

@endsection

@push('plugin-scripts')
    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{ asset('plugins/sortablejs/Sortable.min.js') }}"></script>
@endpush

