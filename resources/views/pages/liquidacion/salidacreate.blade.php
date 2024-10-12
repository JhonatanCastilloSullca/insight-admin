@extends('layout.master')
@push('plugin-styles')
@endpush
@section('content')

@livewire('liquidacion-egreso')

@endsection

@push('plugin-scripts')
  <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
@endpush

