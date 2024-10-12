@extends('layout.master')
@push('plugin-styles')
    <link href="{{ asset('plugins/filepond/filepond.css') }}" rel="stylesheet" />
@endpush
@section('content')
<div class="main-container container-fluid">
    @livewire('paquetes-create', ['paqueteId' => $paquete->id])
</div>


@endsection

@push('plugin-scripts')
    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('plugins/summernote/summernote-bs4.js')}}"></script>
    <script src="{{asset('plugins/summernote-editor/summernote1.js')}}"></script>
    <script src="{{ asset('plugins/filepond/filepond.js') }}"></script>
    <script src="{{ asset('plugins/filepond/filepond-validation.js') }}"></script>
@endpush

