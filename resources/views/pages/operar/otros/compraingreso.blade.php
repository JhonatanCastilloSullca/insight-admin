@extends('layout.master')
@push('plugin-styles')
@endpush
@section('content')

    @livewire('agregar-ingresos',["reservaId" => $reserva->id])

@endsection
@push('plugin-scripts')
    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{ asset('plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatable/js/dataTables.bootstrap5.js') }}"></script>
@endpush
@push('custom-scripts')
<script>
</script>
@endpush
