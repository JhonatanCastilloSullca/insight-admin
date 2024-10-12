@extends('layout.master')
@push('plugin-styles')
@endpush
@section('content')
    @livewire('crear-sin-fecha')


@endsection

@push('plugin-scripts')
    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{ asset('plugins/sortablejs/Sortable.min.js') }}"></script>

@endpush

