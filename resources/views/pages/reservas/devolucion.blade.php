@extends('layout.master')
@push('plugin-styles')
@endpush
@section('content')

@if($tipo == 1)
    @livewire('reprogramacion-reserva',['reserva' => $reserva])
@else
    @livewire('devolucion-reserva',['reserva' => $reserva])
@endif
    
@endsection

@push('plugin-scripts')
    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{ asset('plugins/sortablejs/Sortable.min.js') }}"></script>
@endpush

