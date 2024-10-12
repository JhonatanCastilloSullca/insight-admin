<!DOCTYPE html>
<html>

<head>
    <title>{{ $paquete->titulo }}</title>
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
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            position: absolute;
        }

        .right {
            margin-right: 30px;
            padding: 0;
            width: 30%;
            height: 100%;
            float: right;
            position: relative;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            background: #000;
        }
        .right2 {
            padding: 0;
            width: 30%;
            height: 100%;
            float: right;
            position: relative;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            background: #000;
        }

        .right-title {
            position: absolute;
            top: 18px;
            left: 100px;
            font-size: 30px;
            font-weight: bolder;
            color: #000000;
            line-height: 28px;
        }

        .horarios-right {
            margin-top: 85px;
            text-align: center;
            font-size: 16px;
            font-weight: bolder;
        }

        .text-horarios-right {
            text-align: center;
            color: #727376;
        }

        .text-horarios-left {
            text-align: left;
            color: #727376;
        }

        .descripcion-right {
            margin-left: 80px;
            margin-right: 20px;
            font-size: 15px;
            font-weight: normal;
            text-align: left;
            position: relative;
        }

        .incluye-mid {
            display: table;
            width: 100%;
        }

        .incluye-right,
        .incluye-left {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }

        .text-incluye {
            text-align: left;
            color: #189c9f;
            font-weight: bold;
            text-decoration: underline;
        }
        .float-left{
            float: left;
            width: 350px;
        }

        .pagina-prueba {
            position: relative;
            width: 100%;
            height: 100%;
            background-color: green;
        }

        .div1 {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: red; /* Fondo rojo */
        }

        .div2 {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('{{ asset('storage/img/template.png') }}'); /* Imagen de fondo */
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
        }

        .div3 {
            position: absolute;
            top: 0;
            left: 0;
            width: 80%;
            height: 100%;
            background-color: transparent;
        }

        .half-width {
            width: 50%;
            height: 100%;
        }

        .float-left {
            float: left;
        
        }
        .primera-image, 
        .segunda-image {
            width: 100%; 
            height: 50%; 
            display: block; 
            object-fit: cover !important;            
            margin-bottom: 10px; 
        }


        

        .condiciones {
            width: 100%;
            position: absolute;
            top: 0%;
            left: 10px;
            color: #727376;
            font-size: 10px;
            font-weight: bold;
        }
        .titulo-text{
            color: #ffffff;
            font-size: 45px;
            font-weight: bold;
            padding: 10px;
            margin:0;
        }
        .descripcion-tour{
            position: relative;
            top: 0px;
            width: 800px;
            height: 280px;
            padding: 20px 40px;
            font-size: 20px;
            font-weight: normal;
            margin: 0;
            color: #727376;
        }
        .itinerario-tour{
            position: relative;
            width: 900px;
            height: 250px;
            margin-left: 50px;
        }

        .dia-header {
            height: 40px;
            width: 140px;
            position: absolute;
            top: 30px;
            left: 0;
        }

        .borde-white {
            position: relative;
            height: 65px;
            width: 10px;
            background-color: #c2db6a;
        }

        .texto-dia {
            position: relative;
            top: 0;
            left: 15px;
            font-size: 40px;
            font-weight: bold;
            color: #000000;
        }

        .texto-fecha {
            width: 120px;
            position: absolute;
            top: 0;
            left: 10px;
            font-size: 35px;
            color: #000000;
        }

        .dita-text {
            position: relative;
            top: 0;
            padding-top: 10px;
            line-height: 5px;
            font-size: 18px;
            color: #000000;
            font-weight: bold;
        }

        .firstpage {
            position: relative;
            height: 100%;
            width: 100%;
            background: url('{{ asset('storage/' . $paquete->img_principal) }}') no-repeat center center;
            background-size: cover;
        }

        .secondpage {
            position: relative;
            width: 100%;
            height: 100%;
            background: url('{{ asset('storage/img/template.png') }}') no-repeat center center;
            background-size: cover;
            /* opacity:0.5; */
        }

        .inner-secondpage {
            background: url('{{ asset('storage/img/presentacion1.png') }}') no-repeat center center;
            background-size: cover;
            position: absolute;
            width: 100%;
            height: 100%;
            text-align: center;
            color: #000000;
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
            left: 10%;
            text-align: center;
            width: 80%
        }

        .infoemp {}

        .imageninfoemp {}

        .textoinfoemp {
            margin: 0;
        }

        .inner-secondpage h1 {
            font-size: 50px;
        }

        .infoemptd {
            margin: 0;
            padding: 0;
            line-height: 0;
            text-align: center;
            height: 5px;
        }

        .infoemptable {
            width: 100%;
        }

        .inner-secondpage p {
            font-size: 20px;
        }

        .mediospago {
            height: 100%;
            width: 100%;
            background: url('{{ asset('storage/img/presentacion3.png') }}') no-repeat center center;
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

        .mediospagoizq {
            width: 40%;
            position: relative;
            top: 140px;
            left: 60px;
            height: 76%;
            float: left;
            border-right: 8px solid #179a9d;
        }

        .resumencontainer {
            width: 75%;
            position: relative;
            top: 200px;
            left: 150px;
            height: 76%;
        }

        .mediospagoder {
            width: 40%;
            position: relative;
            top: 140px;
            right: 60px;
            height: 76%;
            float: right;

        }

        .emergencias {
            margin-top: 40px;
            background-color: #e2f1f3;
            padding: 10px;
            border-radius: 5px;
        }

        .emergencias h4,
        h3 {
            margin: 0;
        }

        .mediospagoizq {
            padding: 20px;
            font-size: 12px;
        }

        .mediospagoder {
            padding: 20px;
            font-size: 12px;
        }

        .mediospagotitulo {
            text-align: center;
            font-size: 30px;
            color: #179a9d;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .mediospagotable {
            width: 50%;
            color: #000000;
        }

        .resumencontainertable {
            width: 100%;
            color: #000000;
            line-height: 25px;
        }

        .mediospagotable {}

        .thmediospago {
            background-color: #179a9d;
            width: 50%;
        }

        .thresumen {
            background-color: #179a9d;
        }

        .tituloth {
            text-align: left;
            background-color: #FFF;
            color: #179a9d;
        }

        .tdresumen {
            color: #179a9d;
            text-align: center;
            font-size: 15px;
        }

        .tdresumenservicio {
            color: #179a9d;
            text-align: left;
            font-size: 15px;
        }

        .tfoot {
            position: absolute;
            bottom: 0;

        }

        .mediospagobancos {
            color: #179a9d;
            margin: 0;
            padding: 0;
            border-bottom: 1px solid #179a9d;
        }

        .mediospagobancosh3,
        .mediospagobancosp {
            margin: 0;
            padding: 0;
        }



        .recomendaciones {
            height: 100%;
            width: 100%;
            background: url('{{ asset('storage/img/presentacion3.png') }}') no-repeat center center;
            background-size: cover;
        }

        .politicas {
            height: 100%;
            width: 100%;
            background: url('{{ asset('storage/img/presentacion3.png') }}') no-repeat center center;
            background-size: cover;
        }

        .incluye-text {
            font-size: 24px;
            color: #325258;
        }

        .incluye-text-item {
            font-size: 12px;
            color: #325258;
        }

        .container2 {
            width: 100%;
            height: 100%;
            background-image: url('storage/template-medios-space.png');
            background-size: cover;
            background-position: center;
            position: relative;
            box-sizing: border-box;

        }

        .container3 {
            position: absolute;
            width: 64%;
            height: 90%;
            padding: 10px;
            box-sizing: border-box;
            top: 10px;
            left: 0%;

        }

        .text-container2 {
            position: relative;
            color: #000;
            width: 100%;
            height: auto;
            text-align: center;
            box-sizing: border-box;
        }

        .text-container2 {
            font-size: 25px;
            color: #325258;
        }

        .costos-detalles {
            padding-left: 60px;
            text-align: left;
            width: 60%;
            font-size: 30px;
            color: #179a9d;
        }

        .card-precio-medios {
            width: 350px;
            background: #2ca0b4;
            color: #FFF;
            margin: auto;
            border-radius: 10px;
            font-weight: bold;
            text-align: center;
            box-sizing: border-box;
            font-size: 40px;

        }

        .text-card-precios {
            padding: 10px 40px;
            margin-top: 15px;
        }

        .text-second-page {
            position: relative;
        }

        .contenido-second {
            position: absolute;
            top: 20px;
            left: 20px;
            color: #FFF;
            width: min-content;
            font-size: 20px;
            font-weight: bold;
            margin-right: 20px;
        }

        .h4-paquete {
            color: #FFF;
            font-size: 24px;
            margin: 0;
            padding: 0;
        }

        .h3-paquete {
            background-color: #179a9d;
            line-height: 30px;
        }

        .span-guion {
            font-size: 35px;
        }

        .redes-sociales-secondpage {
            position: absolute;
            bottom: 40px;
            right: 70px;
            width: 390px;
            height: 180px;
        }

        .table-redes-sociales-secondpage {
            width: 100%;
            height: 100%;
        }

        .td-redes-sociales {
            height: 90px;
            width: 100%;
        }

        .a-redes {
            width: 100%;
        }

        .div-red {
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="firstpage">
    </div>
    @foreach ($paquete->detallestours as $k => $detalles)
        @foreach ($detalles->servicio->itinerarios as $i => $itinerario)
    <div class="pagina-prueba">
        <div class="div1">
            
            <div class="half-width float-left">
                
            </div>
            <div class="half-width float-left" style="background-color: #179a9d">                
                <img src="{{ asset($detalles->servicio->img_principal) }}" alt="primera imagen" class="primera-image">
                <img src="{{ asset($detalles->servicio->img_principal) }}" alt="segunda imagen" class="segunda-image">        
            </div>
        </div>
    
        <div class="div2">
            Fondo Image
        </div>
    
        <div class="div3">
            <p class="titulo-text">
                {{$detalles->servicio->titulo}}
            </p>
            <div class="descripcion-tour">
                {!!$detalles->servicio->descripcion!!}
            </div>
            
            <div class="itinerario-tour">
                <div class="float-left">
                    <p class="incluye-text">
                        @if ($detalles->servicio->categoria_id == 5)
                            INCLUYE:
                        @endif
                    </p>
                    @if ($detalles->servicio->categoria_id == 5)
                        @foreach ($detalles->itinerarios[$i]->incluyes as $incluye)
                            <p class="incluye-text-item"><img src='{{ asset('storage/img/check.png') }}'
                                    style="width:15px; height:15px; padding:0 10px;"
                                    alt="">{{ $incluye->titulo }}</p>
                        @endforeach
                    @endif
                </div>
                <div class="float-left">
                    <p class="incluye-text">
                        @if ($detalles->servicio->categoria_id == 5)
                            NO INCLUYE:
                        @endif
                    </p>
                    @if ($detalles->servicio->categoria_id == 5)
                        @foreach ($detalles->itinerarios[$i]->noincluyes as $incluye)
                            <p class="incluye-text-item"><img src='{{ asset('storage/img/X.png') }}'
                                    style="width:15px; height:15px; padding:0 10px;"
                                    alt="">{{ $incluye->titulo }}</p>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    @endforeach
    @endforeach
    
{{--     
    <div class="secondpage">
        <div class="text-second-page">
            <div class="contenido-second">
                <h4 class="h4-paquete">{{ $paquete->titulo }} :</h4>
                <h3 class="h3-paquete">
                    @foreach ($paquete->detallestours as $index => $detalle)
                        {{ $detalle->servicio->titulo }}
                        @if (!$loop->last)
                            <span class="span-guion">-</span>
                        @endif
                    @endforeach
                </h3>
            </div>
        </div>
    @foreach ($paquete->detallestours as $k => $detalles)
        @foreach ($detalles->servicio->itinerarios as $i => $itinerario)
            
            <div class="container">
                <div class="left">
                    <div class="condiciones" >
                        <p class="titulo-text">
                            {{$detalles->servicio->titulo}}
                        </p>
                        <div class="descripcion-tour">
                            {!!$detalles->servicio->descripcion!!}
                        </div>
                        <div class="itinerario-tour">
                            <div class="float-left">
                                <p class="incluye-text">
                                    @if ($detalles->servicio->categoria_id == 5)
                                        INCLUYE:
                                    @endif
                                </p>
                                @if ($detalles->servicio->categoria_id == 5)
                                    @foreach ($detalles->itinerarios[$i]->incluyes as $incluye)
                                        <p class="incluye-text-item"><img src='{{ asset('storage/img/check.png') }}'
                                                style="width:15px; height:15px; padding:0 10px;"
                                                alt="">{{ $incluye->titulo }}</p>
                                    @endforeach
                                @endif
                            </div>
                            <div class="float-left">
                                <p class="incluye-text">
                                    @if ($detalles->servicio->categoria_id == 5)
                                        NO INCLUYE:
                                    @endif
                                </p>
                                @if ($detalles->servicio->categoria_id == 5)
                                    @foreach ($detalles->itinerarios[$i]->noincluyes as $incluye)
                                        <p class="incluye-text-item"><img src='{{ asset('storage/img/X.png') }}'
                                                style="width:15px; height:15px; padding:0 10px;"
                                                alt="">{{ $incluye->titulo }}</p>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endforeach 
    
    </div>     
    --}}
    
</body>
</html>
