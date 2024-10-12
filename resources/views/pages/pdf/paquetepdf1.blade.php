<!DOCTYPE html>
<html>
<head>
    <title>Mi Vista con Espacios Fijos</title>
    <style>
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
            page-break-after: auto; /* Evitar el salto de página */
        }
        .left {
            margin:0;
            padding:0;
            width: 50%;
            height: 100%;
        }
        .right {
            margin:0;
            padding:0;
            width: 60%; /* Ajustado para evitar sobrepaso */
            height: 100%;
            float: right;
            position: relative;
            background: url('{{ asset("storage/img/tour-background.png") }}') no-repeat left left;
            background-position: center; /* Center the image */
            background-repeat: no-repeat; /* Do not repeat the image */
            background-size: cover; /* Resize the background image to cover the entire container */
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
            bottom:100px;
            left:80px;
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
        }
        .borde-white{
            position:relative;
            height:65px;
            width:10px;
            background-color:#c2db6a;
        }
        .texto-dia{
            position:absolute;
            left:15px;
            font-size:40px;
            font-weight:bold;
            color:#FFFFFF;
        }
        .texto-fecha{
            width:120px;
            position:absolute;
            top:30px;
            left:10px;
            font-size:18px;
            color:#FFFFFF;
        }
        .dita-text{
            line-height:5px;
            font-size:30px;
            font-weight:bold;
        }

        .firstpage {
            height: 100%;
            width: 100%;
            background: url('{{ asset("storage/img/presentacion2.png") }}') no-repeat center center;
            background-size: cover;
        }
        .secondpage {
            height: 100%;
            width: 100%;
            background: url('{{ asset("storage/img/presentacion1.png") }}') no-repeat center center;
            background-size: cover;
        }
        .mediospago {
            height: 100%;
            width: 100%;
            background: url('{{ asset("storage/img/mediospago.png") }}') no-repeat center center;
            background-size: cover;
        }
        .recomendaciones {
            height: 100%;
            width: 100%;
            background: url('{{ asset("storage/img/recomendaciones.png") }}') no-repeat center center;
            background-size: cover;
        }
        .politicas {
            height: 100%;
            width: 100%;
            background: url('{{ asset("storage/img/politicas.png") }}') no-repeat center center;
            background-size: cover;
        }
    </style>
</head>
<body>
    <div class="firstpage"></div>
    <div class="secondpage"></div>

    @foreach ($paquete->detallestours as $k => $detalles )
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
    @endforeach
    @foreach ($paquete->detallesdemas as $k => $detalles )
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
                Dia 1
                <div class="texto-fecha">
                    <div class="dita-text">
                        Dia 1
                    </div>
                    2023-01-04
                </div>
            </div>
            <div class="borde-white"></div>
        </div>
    </div>
    @endforeach
    <div class="mediospago"></div>
    <div class="recomendaciones"></div>
    <div class="politicas"></div>
</body>
</html>
