@extends('layout.master')
@push('plugin-styles')
    <link href="{{ asset('plugins/filepond/filepond.css') }}" rel="stylesheet" />
@endpush
@section('content')
<div class="main-container container-fluid">
    
    @livewire('servicio-duplicar', ['servicio' => $servicio,])

</div>


@endsection

@push('plugin-scripts')
    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('plugins/summernote/summernote-bs4.js')}}"></script>
    <script src="{{asset('plugins/summernote-editor/summernote1.js')}}"></script>
    <script src="{{ asset('plugins/filepond/filepond.js') }}"></script>
    <script src="{{ asset('plugins/filepond/filepond-validation.js') }}"></script>

    <script src="{{ asset('plugins/colorpicker/pickr.es5.min.js') }}"></script>
    <script src="{{ asset('plugins/spectrum-colorpicker/spectrum.js') }}"></script>

@endpush

