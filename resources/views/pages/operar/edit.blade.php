@extends('layout.master')
@push('plugin-styles')
    <link href="{{ asset('plugins/filepond/filepond.css') }}" rel="stylesheet" />
@endpush
@section('content')
<div class="main-container container-fluid">
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">Editar Servicio</span>
        </div>
    </div>
    @livewire('servicios-edit', ['servicio' => $servicio])

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

