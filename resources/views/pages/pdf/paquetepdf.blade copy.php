<!DOCTYPE html>
<html>
<head>
    <title>{{$paquete->titulo}}</title>
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
            width: 35%;
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
            height:65px;
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
            background: url('{{ asset("storage/img/presentacion2.png") }}') no-repeat center center;
            background-size: cover;
        }

        .secondpage {
            width: 100%;
            height: 100%;
            background: url('{{ asset("storage/".$paquete->img_principal) }}') no-repeat center center;
            background-size: cover;
            position: relative;
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
            font-size:28px;
            color:#325258;
        }
        .incluye-text-item{
            font-size:16px;
            color:#325258;
        }
    </style>
</head>
<body>
    <div class="firstpage">
    </div>

    <div class="secondpage">
        <div class="inner-secondpage">
            <div class="classtext">
                <h1>{{ $paquete->titulo }}</h1>
                <p>{!! $paquete->descripcion !!}</p>
            </div>
        </div>
    </div>


    @foreach ($paquete->detallestours as $k => $detalles )
    @if($detalles->servicio->categoria->id == 1)
    <div class="container">

    <div class="" style="background: url('{{ asset($detalles->servicio->template) }}') no-repeat center center; background-size: cover; float: left; width:100%;height:100%;">
        </div>
        <div class="dia-header">
            <div class="texto-dia">1
            </div>
        </div>
        <div class="right">
            <div class="horarios-right">
            </div>
            <div class="condiciones">
                <p class="incluye-text">INCLUYE:</p>
                @foreach($detalles->detallesIncluidos as $incluye)
                    <p class="incluye-text-item"><img src='{{ asset("storage/img/check.png") }}' style="width:15px; height:15px; padding:0 10px;" alt="">{{ $incluye->servicioIncluido->titulo }}</p>
                @endforeach
                <p class="incluye-text">NO INCLUYE:</p>
                @foreach($detalles->detallesNoIncluidos as $incluye)
                    <p class="incluye-text-item"><img src='{{ asset("storage/img/X.png") }}' style="width:15px; height:15px; padding:0 10px;" alt="">{{ $incluye->servicioNoIncluido->titulo }}</p>
                @endforeach
            </div>
        </div>
    </div>
    @else
    <div class="secondpage">
        <div class="inner-secondpage">
            <div class="classtext">
                <h1>{{$detalles->servicio->titulo}}</h1>
                <p>{{$detalles->servicio->descripcion}}</p>
            </div>
        </div>
    </div>
    @endif

    @endforeach
    @foreach ($paquete->detalleshoteles as $k => $detalles )
    @if($detalles->servicio->categoria->id == 1)
    <div class="container">
        <div class="left" style="background: url('{{ asset($detalles->servicio->img_principal) }}') no-repeat center center; background-size: cover; float: left;">
        </div>
        <div class="right">
            <div class="right-title">
                {{$detalles->servicio->titulo}}
            </div>
            <div class="horarios-right">
                <p class="text-horarios-right">HORARIOS: {{$detalles->servicio->horario}}</p>
                <div class="descripcion-right">
                    {!! $detalles->servicio->descripcion !!}
                    <div class="incluye-mid">
                        <div class="incluye-right">
                            <p class="text-incluye">INCLUYE</p>
                            <ul>
                                @foreach($detalles->detallesIncluidos as $incluye)
                                    <li>{{ $incluye->servicioIncluido->titulo }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="incluye-left">
                            <p class="text-incluye">NO INCLUYE</p>
                            <ul>
                                @foreach($detalles->detallesNoIncluidos as $incluye)
                                    <li>{{ $incluye->servicioNoIncluido->titulo }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="condiciones">
                <p>*CONDICIONES DE RESERVA</p>
                <span>{{$detalles->servicio->condicion}}</span>
            </div>
        </div>
        <div class="dia-header">
            <div class="texto-dia">
                <div class="texto-fecha">
                    Dia {{$detalles->dia_servicio}}
                    <div class="dita-text">
                        {{date("d-m-Y",strtotime($detalles->fecha_viaje))}}
                    </div>
                </div>
            </div>
            <div class="borde-white"></div>
        </div>
    </div>
    @else
    <div class="secondpage">
        <div class="inner-secondpage">
            <div class="classtext">
                <h1>{{$detalles->servicio->titulo}}</h1>
                <h2>{{$detalles->fecha_viaje}} - {{$detalles->fecha_viajefin}}</h2>
            </div>
        </div>
    </div>
    @endif

    @endforeach
    @foreach ($paquete->detallesvuelos as $k => $detalles )
    @if($detalles->servicio->categoria->id == 1)
    <div class="container">
        <div class="left" style="background: url('{{ asset($detalles->servicio->img_principal) }}') no-repeat center center; background-size: cover; float: left;">
        </div>
        <div class="right">
            <div class="right-title">
                {{$detalles->servicio->titulo}}
            </div>
            <div class="horarios-right">
                <p class="text-horarios-right">HORARIOS: {{$detalles->servicio->horario}}</p>
                <div class="descripcion-right">
                    {!! $detalles->servicio->descripcion !!}
                    <div class="incluye-mid">
                        <div class="incluye-right">
                            <p class="text-incluye">INCLUYE</p>
                            <ul>
                                @foreach($detalles->detallesIncluidos as $incluye)
                                    <li>{{ $incluye->servicioIncluido->titulo }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="incluye-left">
                            <p class="text-incluye">NO INCLUYE</p>
                            <ul>
                                @foreach($detalles->detallesNoIncluidos as $incluye)
                                    <li>{{ $incluye->servicioNoIncluido->titulo }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="condiciones">
                <p>*CONDICIONES DE RESERVA</p>
                <span>{{$detalles->servicio->condicion}}</span>
            </div>
        </div>
        <div class="dia-header">
            <div class="texto-dia">
                <div class="texto-fecha">
                    Dia {{$detalles->dia_servicio}}
                    <div class="dita-text">
                        {{date("d-m-Y",strtotime($detalles->fecha_viaje))}}
                    </div>
                </div>
            </div>
            <div class="borde-white"></div>
        </div>
    </div>
    @else
    <div class="secondpage">
        <div class="inner-secondpage">
            <div class="classtext">
                <h1>{{$detalles->servicio->titulo}}</h1>
                <p>{{$detalles->descripcion}}</p>
                <p>{{$detalles->fecha_viaje}} - {{$detalles->fecha_viajefin}}</p>
            </div>
        </div>
    </div>
    @endif

    @endforeach


    <div class="mediospago">
        <div class="mediospagocontainer">
            <div class="resumencontainer">
                <table class="resumencontainertable">
                    <tbody>
                        <tr>
                            <th colspan="5" class="thresumen tituloth">Servicios:</th>
                        </tr>
                        <tr>
                            <th class="thresumen">Dia</th>
                            <th colspan="2" class="thresumen">Tour</th>
                            <th class="thresumen">Tipo</th>
                            <th class="thresumen">Tipo</th>
                            <!-- <th class="thresumen">Precio $</th> -->
                            <!-- <th class="thresumen">Precio S/</th> -->
                        </tr>
                        @foreach ($paquete->detallestours as $i =>  $detalle)
                        <tr>
                            <td class="tdresumen">{{$i+1}}</td>
                            <td colspan="2" class="tdresumenservicio">{{$detalle->servicio->titulo}}</td>
                            <td class="tdresumen">{{$detalle->tipo ? 'Privado' : 'Compartido'}}</td>
                            <td class="tdresumen">{{$detalle->adulto ? 'Adulto' : 'Niño'}}</td>
                            <!-- <td class="tdresumen">{{$detalle->preciosoles}}</td> -->
                            <!-- <td class="tdresumen">{{$detalle->preciodolares}}</td> -->
                        </tr>
                        @endforeach
                        <tr>
                            <th colspan="5" class="thresumen tituloth">Hoteles:</th>
                        </tr>
                        <tr>
                            <th class="thresumen">Dia</th>
                            <th colspan="4" class="thresumen">Hotel</th>
                            <!-- <th class="thresumen">Precio $</th> -->
                            <!-- <th class="thresumen">Precio S/</th> -->
                        </tr>
                        @foreach ($paquete->detalleshoteles as $i =>  $detalle)
                        <tr>
                            <td class="tdresumen">{{$i+1}}</td>
                            <td class="tdresumenservicio">{{$detalle->servicio->titulo}}</td>
                            <!-- <td class="tdresumen">{{$detalle->preciosoles}}</td> -->
                            <!-- <td class="tdresumen">{{$detalle->preciodolares}}</td> -->
                        </tr>
                        @endforeach
                        <tr>
                            <th colspan="5" class="thresumen tituloth">Vuelos:</th>
                        </tr>
                        <tr>
                            <th class="thresumen">Dia</th>
                            <th colspan="3" class="thresumen">Tour</th>
                            <th class="thresumen">Tipo</th>
                            <!-- <th class="thresumen">Precio $</th> -->
                            <!-- <th class="thresumen">Precio S/</th> -->
                        </tr>
                        @foreach ($paquete->detallesvuelos as $i =>  $detalle)
                        <tr>
                            <td class="tdresumen">{{$i+1}}</td>
                            <td colspan="3" class="tdresumenservicio">{{$detalle->servicio->titulo}}</td>
                            <td class="tdresumen">{{$detalle->tipo ? 'Ida' : 'Ida y Vuelta'}}</td>
                            <!-- <td class="tdresumen">{{$detalle->preciosoles}}</td> -->
                            <!-- <td class="tdresumen">{{$detalle->preciodolares}}</td> -->
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="tfoot">
                        <tr>
                            <td colspan="2"></td>
                            <th class="thresumen">Total:</th>
                            <th class="thresumen">{{$paquete->precio_soles}}</th>
                            <th class="thresumen">{{$paquete->precio_dolares}}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="mediospago">
        <div class="mediospagocontainer">
            <div class="mediospagoizq">
                <div class="mediospagotitulo">
                    Medios de Pago
                </div>
                <div class="mediosizqtabla">
                    <table>
                        <tr>
                            <td>
                                <table class="mediospagotable">
                                    <thead>
                                        <tr>
                                            <th class="thmediospago">Soles S/</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($mediossoles as  $medio)
                                        <tr>
                                            <td>
                                                <div class="mediospagobancos">
                                                    <h3 class="mediospagobancosh3">{{$medio->banco}}</h3>
                                                    <h3 class="mediospagobancosh3">{{$medio->nombre}}</h3>
                                                    <p class="mediospagobancosp">{{$medio->numero}}</p>
                                                    <p class="mediospagobancosp">-CCI: {{$medio->cci}}</p>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                            <td>
                                <table class="mediospagotable">
                                    <thead>
                                        <tr>
                                            <th class="thmediospago">Soles S/</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($mediosdolares as  $medio)
                                        <tr>
                                            <td>
                                                <div class="mediospagobancos">
                                                    <h3 class="mediospagobancosh3">{{$medio->banco}}</h3>
                                                    <h3 class="mediospagobancosh3">{{$medio->nombre}}</h3>
                                                    <p class="mediospagobancosp">{{$medio->numero}}</p>
                                                    <p class="mediospagobancosp">-CCI: {{$medio->cci}}</p>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="mediospagoder" >
                <div class="classtextinfo">
                    <div class="infoemp" >
                        <table class="infoemptable">
                            <tbody>
                                <tr>
                                    <td class="infoemptd" rowspan="3">
                                    <img src='{{ asset("storage/img/infoicono.png") }}' style="width:50px; height:60px;" alt="">
                                    </td>
                                    <td class="infoemptd">
                                        <h2 class="textoinfoemp-titulo">INFORMACIÓN EMPRESARIAL</h2>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="infoemptd">
                                        <b>RUC:</b><span>20600769317</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="infoemptd">
                                        <b>RAZON SOCIAL:</b><span>AVT JISA ADVENTURE EIRL</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="">
                        <div class="emergencias">
                            <h4>EMERGENCIAS 24 HRS</h4>
                            <H3>926 561 020</H3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mediospago">
        <div class="mediospagocontainer">
            <div class="mediospagoizq">
                {!! $pdfdatos->rec_cancel1 !!}
            </div>
            <div class="mediospagoder">
                {!! $pdfdatos->rec_cancel2 !!}
            </div>
        </div>
    </div>
    <div class="mediospago">
        <div class="mediospagocontainer">
            <div class="mediospagoizq">
                {!! $pdfdatos->poli_ven1 !!}
            </div>
            <div class="mediospagoder">
                {!! $pdfdatos->poli_ven2 !!}
            </div>
        </div>
    </div>
</body>
</html>