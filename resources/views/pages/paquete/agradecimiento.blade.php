@extends('layout.master')
@section('content')
<div>
    <div>
        <h2>Gracias por su Compra</h2>
    </div>
</div>
<!-- /Container -->

@endsection


@push('custom-scripts')
<script>
    function showModal(title,subtitulo, description, incluye, noincluye, imgprincipal) {
    document.getElementById('modal-title').innerText = title;
    document.getElementById('modal-description').innerText = description;
    document.getElementById('modal-subtitulo').innerText = subtitulo;
    document.getElementById('modal-incluye').innerHTML = incluye;
    document.getElementById('modal-noincluye').innerHTML = noincluye;
    document.getElementById('modal-image').src = '' + imgprincipal;
}

</script>


@endpush
