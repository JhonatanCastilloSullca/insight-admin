<!DOCTYPE html>
<html>
<head>
    <title>Reserva # {{$reser->id}}</title>
    <style>
        @page {
            width: 297mm;
            height: 167mm;
        }
        html {
            margin: 0;
            border: border-box;
            font-family: Arial, sans-serif;

        }
        body {
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            height: 100%;
            position: relative;
            page-break-after: auto;
        }
        .left {
            margin:0;
            padding:0;
            width: 50%;
            height: 100%;
        }
        .right {
            margin-right:30px;
            padding:0;
            width: 30%;
            height: 100%;
            float: right;
            position: relative;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        .right-title{
            position: absolute;
            top:18px;
            left:100px;
            font-size:30px;
            font-weight: bolder;
            color:#FFFFFF;
            line-height:28px;
        }

        .horarios-right{
            margin-top:85px;
            text-align:center;
            font-size:16px;
            font-weight: bolder;
        }
        .text-horarios-right{
            text-align:center;
            color:#727376;
        }
        .text-horarios-left{
            text-align:left;
            color:#727376;
        }
        .descripcion-right{
            margin-left:80px;
            margin-right:20px;
            font-size:15px;
            font-weight:normal;
            text-align:left;
            position:relative;
        }
        .incluye-mid {
            display: table;
            width: 100%;
        }
        .incluye-right, .incluye-left {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }
        .text-incluye {
            text-align: left;
            color: #189c9f;
            font-weight:bold;
            text-decoration: underline;
        }
        .condiciones{
            position: absolute;
            top:50px;
            left:120px;
            color:#727376;
            font-size:10px;
            font-weight:bold;
        }
        .dia-header{
            background-color: #189c9f;
            height:40px;
            width:140px;
            position:absolute;
            top:30px;
            left:0;
            border-left: 10px solid #c2db6a;
        }

        .borde-white{
            position:relative;
            height:65px;
            width:10px;
            background-color:#c2db6a;
        }
        .texto-dia{
            position:relative;
            top:0;
            left:15px;
            font-size:40px;
            font-weight:bold;
            color:#FFFFFF;
        }
        .texto-dia-2{
            position:relative;
            top:9px;
            left:15px;
            font-size:24px;
            font-weight:bold;
            color:#FFFFFF;
        }
        .texto-fecha{
            width:120px;
            position:absolute;
            top:0;
            left:10px;
            font-size:35px;
            color:#FFFFFF;
        }
        .dita-text{
            position:relative;
            top:0;
            padding-top: 10px;
            line-height:5px;
            font-size:18px;
            color:#FFFFFF;
            font-weight:bold;
        }
        .firstpage {
            position: relative;
            height: 100%;
            width: 100%;
            background: url('{{ asset("storage/img/presentacion1.png") }}') no-repeat center center;
            background-size: cover;
        }

        .secondpage {
            width: 100%;
            height: 100%;
            background-size: cover;
        }

        .inner-secondpage {
            background: url('{{ asset("storage/img/presentacion1.png") }}') no-repeat center center;
            background-size: cover;
            position: absolute;
            width: 100%;
            height: 100%;
            text-align: center;
            color: white;
        }

        .inner-secondpage {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .classtext {
            position: absolute;
            top: 40%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .classtextinfo {
            color: #179a9d;
            position: absolute;
            top: 20%;
            left:10%;
            text-align:center;
            width:80%
        }
        .infoemp{
        }
        .imageninfoemp{
        }
        .textoinfoemp{
            margin:0;
        }
        .inner-secondpage h1 {
            font-size: 50px;
        }
        .infoemptd{
            margin:0;
            padding:0;
            line-height:0;
            text-align:center;
            height:5px;
        }
        .infoemptable
        {
            width:100%;
        }

        .inner-secondpage p {
            font-size: 20px;
        }
        .mediospago {
            height: 100%;
            width: 100%;
            background: url('{{ asset("storage/img/presentacion3.png") }}') no-repeat center center;
            background-size: cover;
        }
        .mediospagocontainer {
            width: 100%;
            height: 100%;
        }
        .mediosizqtabla {
            width: 100%;
        }

        .mediosizqtabla table {
            width: 100%;
            border-collapse: collapse;
        }

        .mediosizqtabla td {
            width: 50%;
            box-sizing: border-box;
        }
        .mediospagoizq
        {
            width: 40%;
            position: relative;
            top:140px;
            left:60px;
            height: 76%;
            float: left;
            border-right: 8px solid #179a9d;
        }
        .resumencontainer
        {
            width: 75%;
            position: relative;
            top:200px;
            left:150px;
            height: 76%;
        }
        .mediospagoder {
            width: 40%;
            position: relative;
            top:140px;
            right:60px;
            height: 76%;
            float: right;

        }
        .emergencias{
            margin-top:40px;
            background-color:#e2f1f3;
            padding:10px;
            border-radius:5px;
        }
        .emergencias h4, h3{
            margin:0;
        }

        .mediospagoizq {
            padding:20px;
            font-size:12px;
        }

        .mediospagoder {
            padding:20px;
            font-size:12px;
        }
        .mediospagotitulo{
            text-align:center;
            font-size:30px;
            color:#179a9d;
            font-weight:bold;
            margin-bottom:5px;
        }
        .mediospagotable{
            width:50%;
            color:white;
        }
        .resumencontainertable{
            width:100%;
            color:white;
            line-height: 25px;
        }
        .mediospagotable
        {

        }
        .thmediospago{
            background-color:#179a9d;
            width:50%;
        }
        .thresumen{
            background-color:#179a9d;
        }
        .tituloth{
            text-align: left;
            background-color: #FFF;
            color: #179a9d;
        }
        .tdresumen{
            color:#179a9d;
            text-align:center;
            font-size:15px;
        }
        .tdresumenservicio{
            color:#179a9d;
            text-align:left;
            font-size:15px;
        }
        .tfoot{
            position: absolute;
            bottom: 0;

        }
        .mediospagobancos{
            color: #179a9d;
            margin:0;
            padding:0;
            border-bottom:1px solid #179a9d;
        }
        .mediospagobancosh3, .mediospagobancosp
        {
            margin:0;
            padding:0;
        }



        .recomendaciones {
            height: 100%;
            width: 100%;
            background: url('{{ asset("storage/img/presentacion3.png") }}') no-repeat center center;
            background-size: cover;
        }
        .politicas {
            height: 100%;
            width: 100%;
            background: url('{{ asset("storage/img/presentacion3.png") }}') no-repeat center center;
            background-size: cover;
        }
        .incluye-text{
            font-size:24px;
            color:#325258;
        }
        .incluye-text-item{
            font-size:12px;
            color:#325258;
        }

        .dia-header-2{
            background-color: #189c9f;
            height:40px;
            width:140px;
            position:absolute;
            top:30px;
            left:0;
            border-left: 10px solid #c2db6a;
        }
    </style>
</head>
<body>
    <div class="firstpage">
    </div>


    @foreach ($reser->detallestoursItinerario as $k => $detalle )
        @foreach($detalle->servicio->itinerarios as $i => $itinerario)
        <div class="container">

            <div class="" style="background: url('{{ asset($itinerario->template) }}') no-repeat center center; background-size: cover; float: left; width:100%;height:100%;">
            </div>
                <div class="{{ $detalle->fecha_viaje == null || strtotime($detalle->fecha_viaje) == strtotime('1969-12-31') ? 'dia-header' : 'dia-header-2' }}">
                    <div class="texto-dia">1
                    </div>
                </div>
                <span class="texto-dia-2" >{{ $detalle->fecha_viaje == null || strtotime($detalle->fecha_viaje) == strtotime('1969-12-31') ? '' : date('d-m-Y', strtotime($detalle->fecha_viaje)) }}                </span>
                <div class="right">
                    <div class="horarios-right">
                    </div>
                    <div class="condiciones">
                        <p class="incluye-text">
                            @if($detalle->servicio->categoria_id == 5)
                                INCLUYE:
                            @endif
                        </p>
                        @if($detalle->servicio->categoria_id == 5)
                            @foreach($detalle->itinerarios[$i]->incluyes as $incluye)
                                <p class="incluye-text-item"><img src='{{ asset("storage/img/check.png") }}' style="width:15px; height:15px; padding:0 10px;" alt="">{{ $incluye->titulo }}</p>
                            @endforeach
                        @endif
                        <p class="incluye-text">
                            @if($detalle->servicio->categoria_id == 5)
                                NO INCLUYE:
                            @endif
                        </p>
                        @if($detalle->servicio->categoria_id == 5)
                            @foreach($detalle->itinerarios[$i]->noincluyes as $incluye)
                                <p class="incluye-text-item"><img src='{{ asset("storage/img/X.png") }}' style="width:15px; height:15px; padding:0 10px;" alt="">{{ $incluye->titulo }}</p>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    @endforeach
    {{-- @foreach ($reser->detalleshoteles as $k => $detalles )
    <div class="" style="background: url('{{ asset($detalles->servicio->template) }}') no-repeat center center; background-size: cover; float: left; width:100%;height:100%;">


    @endforeach
    @foreach ($reser->detallesvuelos as $k => $detalles )
    <div class="" style="background: url('{{ asset($detalles->servicio->template) }}') no-repeat center center; background-size: cover; float: left; width:100%;height:100%;">

    @endforeach --}}
    
    <div class="" style="background: url('{{ asset("storage/medios.png") }}') no-repeat center center; background-size: cover; float: left; width:100%;height:100%;">
</body>
</html>
