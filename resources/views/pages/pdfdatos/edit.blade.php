@extends('layout.master')
@push('plugin-styles')
@endpush
@section('content')
<div class="main-container container-fluid">
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ $message }}
        <button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button"><span aria-hidden="true">&times;</span></button>
    </div>
    @endif
    <form action="{{ route('pdfdatos.store') }}" method="post" class="forms-sample" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="breadcrumb-header justify-content-between">
            <div class="left-content">
                <span class="main-content-title mg-b-0 mg-b-lg-1">Datos de PDF</span>
            </div>
            <div class="justify-content-center mt-2">
                <button type="submit" id="submit-button" class="btn btn-primary me-2">Actualizar</button>
            </div>
            <input type="hidden" name="id_pdf" value="{{$pdfdato?->id}}">
        </div>
        <div class="row">
            <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-xs-12">
                        <div class="card sales-card">
                            <div class="row">
                                <div class="col-12">
                                    <div class="ps-4 pt-4 pe-3 pb-4">
                                        <div class="">
                                            <h6 class="mb-2 h4">Términos y Condiciones</h6>
                                        </div>
                                        <div class="pb-0 mt-0">
                                            <textarea class="form-control" name="rec_cancel1" id="rec_cancel1" rows="10">{{$pdfdato?->rec_cancel1}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-xl-6 col-lg-6 col-md-6 col-xs-12">
                        <div class="card sales-card">
                            <div class="row">
                                <div class="col-12">
                                    <div class="ps-4 pt-4 pe-3 pb-4">
                                        <div class="">
                                            <h6 class="mb-2 h4 ">Recomendaciones y Cancelaciones Izquierda</h6>
                                        </div>
                                        <div class="pb-0 mt-0">
                                            <div class="pb-0 mt-0">
                                                <textarea class="form-control" name="rec_cancel2" id="rec_cancel2" rows="10">{{$pdfdato?->rec_cancel2}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-xs-12">
                        <div class="card sales-card">
                            <div class="row">
                                <div class="col-12">
                                    <div class="ps-4 pt-4 pe-3 pb-4">
                                        <div class="">
                                            <h6 class="mb-2 h4 ">Politicas de Venta</h6>
                                        </div>
                                        <div class="pb-0 mt-0">
                                            <div class="pb-0 mt-0">
                                                <textarea class="form-control" name="poli_ven1" id="poli_ven1" rows="10">{{$pdfdato?->poli_ven1}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-xs-12">
                        <div class="card sales-card">
                            <div class="row">
                                <div class="col-12">
                                    <div class="ps-4 pt-4 pe-3 pb-4">
                                        <div class="">
                                            <h6 class="mb-2 h4 ">Politicas de Venta</h6>
                                        </div>
                                        <div class="pb-0 mt-0">
                                            <div class="pb-0 mt-0">
                                                <textarea class="form-control" name="poli_ven2" id="poli_ven2" rows="10">{{$pdfdato?->poli_ven2}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </form>
</div>

@endsection
@push('plugin-scripts')
    <script src="{{asset('plugins/summernote/summernote-bs4.js')}}"></script>
    <script src="{{asset('plugins/summernote-editor/summernote1.js')}}"></script>
@endpush
@push('custom-scripts')

<script>
    $(document).ready(function () {
        $('#rec_cancel1').summernote();
        $('#rec_cancel2').summernote();
        $('#poli_ven1').summernote();
        $('#poli_ven2').summernote();
    });
</script>
@endpush
