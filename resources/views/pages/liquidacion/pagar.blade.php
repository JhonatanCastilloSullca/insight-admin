@extends('layout.master')
@push('plugin-styles')
@endpush
@section('content')

@livewire('pagar-liquidacion',["liquidacion"=>$liquidacion])

@endsection

@push('plugin-scripts')
  <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
@endpush

