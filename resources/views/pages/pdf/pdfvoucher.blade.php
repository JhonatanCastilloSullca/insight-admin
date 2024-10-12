<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Voucher de Reserva Nº {{ $reserva->numero }}-{{date("d-m-Y",strtotime($reserva->primerafecha()?->fecha_viaje))}}</title>
    <style>
        @page {
            margin: 0cm 0cm;
        }

        header {
            position: fixed;
            top: 0cm;
            left: 0px;
            right: 0px;
            height: 3cm;
        }

        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 6cm;
        }



        body {
            margin: 2px;
            margin-top: 390px;
            margin-bottom: 250px;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            font-size: 0.75rem;
            font-weight: normal;
            color: #151b1e;
            size: landscape;
            width: 100%;
            height: 100%;
        }

        .pasajeros-table {
            width: 100%;
            border-collapse: collapse;
        }

        .pasajeros-table th,
        .pasajeros-table td {
            padding: 3px 10px;
            border-bottom: 1px solid #179a9d;
        }

        tr {
            margin: 0;
            padding: 2px;
        }

        td>* {
            padding: 2px;
            margin: 0;
        }

        .pasajeros-table th {
            background-color: #179a9d;
            color: #FFFFFF;
            border: 1px solid;
        }

        .tdcenter {
            text-align: center;
        }

        .tdleft {
            text-align: left;
        }

        .pasajeros-table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .pasajeros-table tbody tr:hover {
            background-color: #ddd;
        }


        .title-table {
            margin: 0;
            padding: 2px;
            margin-top: 20px;
        }

        .logoarriba {
            height: 50px;
        }


        .parrafo-termino {
            font-size: 0.75rem;
            color: #464646;
            line-height: 38px;
        }

        .parrafo-titulo {
            font-size: 0.75rem;
            color: #375a64;
            line-height: 50px;
            font-weight: bold;
        }

        .parrafo-subtitulo {
            font-size: 0.75rem;
            color: #179a9d;
            line-height: 41px;
            font-weight: bold;
        }


        main {
            z-index: 2;
            margin-left: 5%;
            margin-right: 5%;
        }
    </style>
</head>

<body>
    <header>
        <div class="header">
            <img src="{{ asset('img/brand/head.png') }}" alt="admin@bootstrapmaster.com" style="width: 100%;">
        </div>
    </header>
    <footer>
        <div class="footer">
            <div class="">
                <img src="{{ asset('img/brand/footer.png') }}" alt="admin@bootstrapmaster.com" style="width: 100%;">
            </div>
        </div>
    </footer>
    <main>
        <div class="container-fluid">
            <div class="card">
                <div class="row">
                    <h3
                        style="text-align:center; font-size:75px !important; color: #179a9d !important; line-height:80px; margin-bottom: 10px;">
                        Voucher de Reserva Nº {{ $reserva->numero }}-{{date("d-m-Y",strtotime($reserva->primerafecha()?->fecha_viaje))}}</h3>
                    <h4
                        style="margin-top: 25px !important ;font-size:35px !important; color: #000000 !important; line-height:40px;">
                        Counter asesor: {{ $reserva->user->nombre }}</h4>
                    <h4 class="title-table">PASAJEROS</h4>
                    <table class="pasajeros-table">
                        <thead>
                            <tr>
                                <th class="thnro">N°</th>
                                <th class="tdcenter">Nombres</th>
                                <th class="tdcenter">Nacionalidad</th>
                                <th class="tdcenter">Documentos</th>
                                <th class="tdcenter">Edad</th>
                                <th class="tdcenter">Género</th>
                                <th class="tdcenter">Teléfono</th>
                                <th class="tdcenter">Correo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reserva->pasajeros as $i => $pasajero)
                                <tr>
                                    <td class="thnro">{{ ++$i }}</td>
                                    <td>{{ $pasajero->nombreCompleto }}</td>
                                    <td>{{ $pasajero->pais->nombre }}</td>
                                    <td>{{ $pasajero->documento?->tipo_documento }}
                                        {{ $pasajero->documento?->num_documento }}</td>
                                    <td>{{ \Carbon\Carbon::parse($pasajero->nacimiento)->diffInYears(\Carbon\Carbon::now()) }}
                                    </td>
                                    <td>{{ $pasajero->genero == 'MASCULINO' ? 'M' : 'F' }}</td>
                                    <td>{{ $pasajero->celular }}</td>
                                    <td>{{ $pasajero->email }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <h4 class="title-table">SERVICIOS REGISTRADOS</h4>
                    <table class="pasajeros-table">
                        <thead>
                            <tr>
                                <th class="thnro">N°</th>
                                <th class="tdcenter">Pax</th>
                                <th class="tdcenter">Servicio</th>
                                <th class="tdcenter">Fecha Inicio</th>
                                <th class="tdcenter">Incluye</th>
                                <th class="tdcenter">No Incluye</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reserva->detallestoursItinerario as $i => $detalle)
                                <tr>
                                    <td class="thnro">{{ ++$i }}</td>
                                    <td>{{ $detalle->pax }}</td>
                                    <td>{{ $detalle->servicio->titulo }}</td>
                                    <td>
                                        {{ $detalle->fecha_viaje ? date('d-m-Y', strtotime($detalle->fecha_viaje)) : null }}

                                    </td>
                                    <td>
                                        @foreach ($detalle->itinerarios as $itinerario)
                                            @foreach ($itinerario->incluyes as $incluye)
                                                - {{ $incluye->titulo }}<br>
                                            @endforeach
                                        @endforeach
                                    </td>
                                    <td class="tdcenter">
                                        @foreach ($detalle->itinerarios as $itinerario)
                                            @foreach ($itinerario->noincluyes as $noincluye)
                                                - {{ $noincluye->titulo }}<br>
                                            @endforeach
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if (count($reserva->detalleshoteles))
                    <div class="row">
                        <h4 class="title-table">HOTELES REGISTRADOS</h4>
                        <table class="pasajeros-table">
                            <thead>
                                <tr>
                                    <th class="thnro">N°</th>
                                    <th class="tdcenter">Cant.</th>
                                    <th class="tdcenter">Noches</th>
                                    <th class="tdcenter">Servicio</th>
                                    <th class="tdcenter">Check Inn</th>
                                    <th class="tdcenter">Check Out</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reserva->detalleshoteles as $i => $detalle)
                                    <tr>
                                        <td class="thnro">{{ ++$i }}</td>
                                        <td>{{ $detalle->pax }}</td>
                                        <td>{{ $detalle->equipaje }}</td>
                                        <td>{{ $detalle->servicio->proveedor?->nombre }}
                                            {{ $detalle->servicio->proveedor?->ubicacion?->nombre }}
                                            {{ $detalle->servicio->titulo }}</td>
                                        <td>{{ $detalle->fecha_viaje ? date('d-m-Y H:i', strtotime($detalle->fecha_viaje)) : null }} </td>
                                        <td class="tdcenter">
                                            {{ $detalle->fecha_viajefin ? date('d-m-Y H:i', strtotime($detalle->fecha_viajefin)) : null }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
                @if (count($reserva->detallesvuelos))
                    <div class="row">
                        <h4 class="title-table">VUELOS REGISTRADOS</h4>
                        <table class="pasajeros-table">
                            <thead>
                                <tr>
                                    <th class="thnro">N°</th>
                                    <th class="tdcenter">Pax</th>
                                    <th class="tdcenter">Servicio</th>
                                    <th class="tdcenter">Fecha Ida</th>
                                    <th class="tdcenter">Fecha Retorno</th>
                                    <th class="tdcenter">Incluye</th>
                                    <th class="tdcenter">No Incluye</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reserva->detallesvuelos as $i => $detalle)
                                    <tr>
                                        <td class="thnro">{{ ++$i }}</td>
                                        <td>{{ $detalle->pax }}</td>
                                        <td>{{ $detalle->servicio->titulo }}</td>
                                        <td>{{ $detalle->fecha_viaje ? date('d-m-Y H:i', strtotime($detalle->fecha_viaje)) : null}}</td>
                                        <td>{{ $detalle->fecha_viajefin ? date('d-m-Y H:i', strtotime($detalle->fecha_viajefin)) : '' }}</td>
                                        <td>
                                            @foreach ($detalle->itinerarios as $itinerario)
                                                @foreach ($itinerario->incluyes as $incluye)
                                                    - {{ $incluye->titulo }}<br>
                                                @endforeach
                                            @endforeach
                                        </td>
                                        <td class="tdcenter">
                                            @foreach ($detalle->itinerarios as $itinerario)
                                                @foreach ($itinerario->noincluyes as $noincluye)
                                                    - {{ $noincluye->titulo }}<br>
                                                @endforeach
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
                <div class="row">
                    <h4 class="title-table">PAGOS REGISTRADOS</h4>
                    <table class="pasajeros-table">
                        <thead>
                            <tr>
                                <th class="thnro">N°</th>
                                <th>Medio de pago</th>
                                <th>Fecha de pago</th>
                                <th>Monto</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reserva->pagos as $i => $pago)
                                <tr>
                                    <td class="thnro">{{ ++$i }}</td>
                                    <td>{{ $pago->medio->nombre }} {{ $pago->medio->banco }}
                                        {{ $pago->medio->moneda->nombre }}</td>
                                    <td>{{ $pago->fecha }}</td>
                                    <td>{{ $pago->moneda->abreviatura }} {{ $pago->monto }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <h4 class="title-table">RESUMEN</h4>
                    <table class="pasajeros-table">
                        <thead>
                            <tr>
                                <th>PRECIO TOTAL DEL PAQUETE </th>
                                <th>MONTO TOTAL PAGADO </th>
                                <th>SALDO PENDIENTE</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reserva->totales as $total)
                                <tr>
                                    <td>{{ $total->moneda->abreviatura }} {{ $total->total }}</td>
                                    <td>{{ $total->moneda->abreviatura }} {{ $total->acuenta }}</td>
                                    <td>{{ $total->moneda->abreviatura }} {{ $total->saldo }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if(count($reserva->cuotas)>0)
                    <div class="row">
                        <h4 class="title-table">CRONOGRAMA DE PAGOS POR REALIZAR</h4>
                        <table class="pasajeros-table">
                            <thead>
                                <tr>
                                    <th class="thnro">N°</th>
                                    <th>Fecha</th>
                                    <th>Monto</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reserva->cuotas as $i => $cuota)
                                    <tr>
                                        <td class="thnro">{{ $cuota->nroCuota }}</td>
                                        <td>{{ $cuota->fecha }}</td>
                                        <td>{{ $cuota->moneda->abreviatura }} {{ $cuota->monto }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        <div class="container-fluid">
            <div class="card">
                <div class="row">
                    <h3 style="text-align:center; font-size:75px !important; color: #179a9d !important;"> Términos y
                        Condiciones </h3>
                    <p style="font-size:35px !important;">
                        {!! $pdfdato->rec_cancel1 !!}
                    </p>
                    {{-- <span class="parrafo-termino">
                        Estimado viajero, Reciba un cordial saludo de todo el equipo de Jisa Adventure. Nos llena de
                        entusiasmo que haya seleccionado nuestra compañía como su aliada en la exploración de las
                        maravillas del Perú. Nos comprometemos a proporcionarle una experiencia inolvidable, llena de
                        descubrimientos y aventuras.
                    </span>
                    <p class="parrafo-titulo">1. Reserva</p>
                    <p class="parrafo-subtitulo">a) Reserva tu viaje:</p>
                    <span class="parrafo-termino">Puedes reservar un viaje con Jisa Adventure contactándonos al número
                        telefónico +51 976 294 449 o por correo electrónico a ventas@cuscoinsight.com.</span>
                    <p class="parrafo-subtitulo">b) Reservas en el sitio web:</p>
                    <span class="parrafo-termino">Si reserva directamente a través de nuestro sitio web, asegúrese de
                        proporcionar todos los detalles requeridos incluido el nombre completo, el número de pasaporte,
                        la fecha de nacimiento, la nacionalidad y el sexo. Una vez que confirmemos su pago,
                        verificaremos la disponibilidad y obtendremos los permisos necesarios.
                        Nota: Su reserva será realizada solo después de recibir una confirmación por escrito de Jisa
                        Adventure mediante su correo electrónico o número telefónico(WhatsApp).</span>

                    <p class="parrafo-titulo">2. Proceso de Reserva y Políticas de Pago:</p>
                    <p class="parrafo-subtitulo">a) Depósito de Reserva:</p>
                    <span class="parrafo-termino">Para asegurar una reserva de su lugar en los distintos tours, se
                        requiere un depósito inicial del 50% del precio total. Este paso es esencial para la reserva de
                        boletos y servicios adicionales, asegurando la disponibilidad y una planificación detallada de
                        su viaje.</span>
                    <p class="parrafo-subtitulo">b) Liquidación del Saldo:</p>
                    <span class="parrafo-termino">En caso haya pagado una fracción del precio total de su reserva, el
                        monto restante deberá ser pagado antes de realizarse los tours correspondientes a su reserva.
                        Caso contrario no realice el pago a su debido tiempo se cobrará un adicional del 6.5% del uso de
                        link de pago o P.O.S.</span>
                    <p class="parrafo-subtitulo">c) Vuelos:</p>
                    <span class="parrafo-termino">En caso se acepte la reserva con inclusión de vuelos la venta de estos
                        requiere el pago del 100% del total, por otro lado, cualquier cambio o reprogramación está
                        sujeto a tarifas de la aerolínea, lo cual no responsabiliza a la agencia. No podemos aceptar
                        responsabilidad alguna por las cancelaciones o retrasos en alguno de sus vuelos, si la
                        cancelación o el retraso se debe a condiciones climáticas adversas, la reprogramación de la
                        compañía aérea, el aeropuerto de autoridad y/o la acción de los controladores aéreos, fallas
                        mecánicas o acción industrial.
                        Nuestra agencia se esforzará para solucionar su itinerario de viaje, y que todo inconveniente
                        sea solucionado de la mejor manera posible, considerando tarifas por cambio en caso la situación
                        lo amerite.
                        El Cliente debe comprender y ser flexible si por causa de retraso aéreo no se puede solucionar
                        los problemas.
                        La empresa no se responsabiliza de pérdidas de vuelos por situaciones personales y/o decisiones
                        del cliente.</span>

                    <p class="parrafo-titulo">3. Política de Cancelación y Modificaciones:</p>
                    <p class="parrafo-subtitulo">a) Derecho de Cancelación:</p>
                    <span class="parrafo-termino">La A.V.T. Jisa Adventure se reserva el derecho de cancelar cualquier
                        viaje debido a circunstancias excepcionales o imprevistas. Nos comprometemos a comunicar
                        cualquier cambio con la mayor antelación posible y a ofrecer alternativas adecuadas para
                        reacomodar su experiencia.</span>
                    <p class="parrafo-subtitulo">b) No se aplica reembolso por gastos anticipados:</p>
                    <span class="parrafo-termino">Es importante que tenga en cuenta que no nos hacemos responsables por
                        gastos incurridos antes de la confirmación oficial de su viaje, tales como boletos aéreos no
                        reembolsables, trámites de visa, o gastos médicos.
                        Si decide cancelar o no asistir a un viaje de varios días, recuerde que el depósito inicial del
                        50% no es reembolsable y no transferible. Esto refleja nuestra política de no cancelación y
                        asegura que los arreglos logísticos y preparativos realizados no resulten en una pérdida
                        financiera para nuestra empresa.</span>

                    <p class="parrafo-titulo">4. Cambios en la Reserva:</p>
                    <p class="parrafo-subtitulo">a) Cambios Planificados:</p>
                    <span class="parrafo-termino">Si necesita cambiar la fecha o la ruta de su viaje (con la excepción
                        del tour a Machu Picchu), y lo hace con más de 56 horas de antelación al inicio del tour, se
                        aplicará una tarifa administrativa de US$ 20.00 por persona.</span>
                    <p class="parrafo-subtitulo">b) Cambios repentinos de Último Minuto:</p>
                    <span class="parrafo-termino">Para los cambios solicitados dentro de las 48 horas previas al inicio
                        del tour, se aplicará una tarifa de US$ 40.00 adicionales por persona.</span>

                    <p class="parrafo-titulo">5. Términos y Condiciones para el Tour de Machu Picchu</p>
                    <p class="parrafo-subtitulo">a) Transporte desde su Hotel:</p>
                    <span class="parrafo-termino">El transporte desde su hotel hasta la estación de buses en Wanchaq o
                        en la Avenida El Sol se realizará en un servicio privado proporcionado por JISA ADVENTURE,
                        garantizando comodidad y puntualidad al inicio de su aventura.
                        Posteriormente, el transporte hacia la estación de tren en Ollantaytambo será en un servicio
                        compartido proporcionado por la empresa Perú Rail o Inca Rail, ofreciendo una oportunidad única
                        de socializar con otros viajeros y disfrutar del paisaje.</span>
                    <p class="parrafo-subtitulo">b) Garantía de Ingreso a Machu Picchu:</p>
                    <span class="parrafo-termino">La disponibilidad de entradas es gestionada por el sistema web
                        implementado por el Ministerio de Cultura peruano, las agencias de viajes y turismo no poseen
                        control de estas entradas así que pedimos su comprensión en caso no haya disponibilidad de rutas
                        y/o fechas para ingresar al Santuario Histórico de Machu Picchu.
                        Si la Agencia asegura su ingreso a Machu Picchu o se encarga de la compra de su entrada, esto se
                        debe a la concreta disponibilidad en el momento de realizarla solo si su reserva se realiza de
                        manera anticipada. Nos comprometemos a facilitar estos arreglos como parte de nuestra dedicación
                        a su experiencia de viaje.
                        En caso no hubiera disponibilidad de entrada a Machu Picchu el área de Ventas se pondrá en
                        contacto con usted para coordinar cambios de fecha o diferencia de usos de distintas rutas y
                        circuitos en el recinto.</span>
                    <p class="parrafo-subtitulo">c) Política de No Reembolso:</p>
                    <span class="parrafo-termino">Los precios asociados con el tour a Machu Picchu, incluyendo boletos
                        de tren y entradas a la ciudadela, no son reembolsables, ni transferibles bajo ninguna
                        circunstancia.
                        Esto destaca la importancia de la planificación y reserva anticipadas.</span>
                    <p class="parrafo-subtitulo">d) Idioma en el Guiado de Machu Picchu:</p>
                    <span class="parrafo-termino">Los precios asociados con el tour a Machu Picchu, incluyendo boletos
                        de tren y entradas a la ciudadela, no son reembolsables, ni transferibles bajo ninguna
                        circunstancia.
                        Esto destaca la importancia de la planificación y reserva anticipadas.</span>

                    <p class="parrafo-titulo">6. Responsabilidad en la Compra de Entradas Presenciales:</p>
                    <span class="parrafo-termino">No nos hacemos responsables por compras de entradas a la ciudadela de
                        Machu Picchu realizadas de manera presencial por parte del viajero en el pueblo de Aguas
                        Calientes.
                        Las entradas son limitadas y recomendamos encarecidamente gestionar la compra a través de los
                        canales oficiales para asegurar su disponibilidad, así mismo comprarlo con anticipación.</span>
                    <p class="parrafo-subtitulo">a) Cambios y Cancelaciones:</p>
                    <span class="parrafo-termino">Cualquier cambio o cancelación en su reserva está sujeta a nuestras
                        políticas generales de cancelación, así como a las condiciones específicas impuestas por los
                        operadores ferroviarios y otros proveedores de servicios.</span>
                    <p class="parrafo-subtitulo">b) Recomendaciones Generales:</p>
                    <span class="parrafo-termino">Le pedimos encarecidamente estar preparado y puntual para el servicio
                        de transporte privado desde su hotel, ya que este no esperará tiempos excesivos para iniciar el
                        tour designado.
                        Considerar la contratación de un seguro de viaje que cubra imprevistos de su viaje ya que la
                        agencia no contrata servicios de seguro para los viajeros.</span>

                    <p class="parrafo-titulo">7. Condiciones Específicas en Cusco:</p>
                    <p class="parrafo-subtitulo">a) Logística de Transporte:</p>
                    <span class="parrafo-termino">Teniendo en cuenta las calles estrechas y el tráfico vehicular de
                        Cusco, es posible que el servicio de recojo se realice en puntos de encuentro estratégicos y
                        accesibles, en lugar de directamente en su hotel (dependiendo a la ubicación de este). Además,
                        se realizarán los recojos de su hotel siempre y cuando se encuentren en el casco monumental de
                        la ciudad, en caso contrario no se encuentren en el casco monumental se indicará un punto de
                        encuentro.</span>

                    <p class="parrafo-titulo">8. Visa, Documentación, Permisos y seguros</p>
                    <p class="parrafo-subtitulo">a) Documentación Adjunta:</p>
                    <span class="parrafo-termino">
                        Junto a este comunicado, encontrará su programa de viaje detallado e información adicional que
                        incluye consejos prácticos y recomendaciones para una experiencia de viaje más placentera. Se
                        solicita verificar el programa de viaje detallado y confirmar si la fecha de viaje es correcta o
                        realizar alguna observación al momento de su compra, caso contrario no nos haremos responsables.
                        <br>Todos los clientes al momento de contratar los servicios de la empresa se comprometen a
                        permitir tomar una copia de los documentos personales (Pasaporte, Cedula, DNI, etc.) por parte
                        del representante de la empresa (La empresa conservará esta información de manera confidencial y
                        la utilizará solo para tramites contables y administrativos).

                        <br> - Todos los clientes al momento de contratar los servicios de Jisa Adventure, se
                        comprometen a adquirir por cuenta propia los documentos y permisos vigentes necesarios para
                        desarrollar las actividades del itinerario con normalidad, además deben portar durante el
                        desarrollo de las excursiones dichos documentos cuyos datos enviaron al momento de la reserva.
                        <br> - De acuerdo a la ley vigente en Perú, un turista no puede permanecer más de 60 días en el
                        país de acuerdo a su tarjeta TAM, por lo que, si el cliente extranjero que realice el viaje
                        estuviera en Perú más de 60 días, deberá pagar el IGV adicional de 18% del total del tour.
                    </span>
                    <p class="parrafo-subtitulo">b) Comprobante de Pago y Coordinación:</p>
                    <span class="parrafo-termino">Recibirá un comprobante de pago desde facturacion@cuscoinsight.com y
                        nuestro equipo de operaciones se contactará con
                        usted para finalizar detalles y manejar el saldo pendiente.</span>

                    <p class="parrafo-titulo">9. Recomendaciones y Consejos de Viaje</p>
                    <p class="parrafo-subtitulo">a) Alojamiento:</p>
                    <span class="parrafo-termino">Le sugerimos optar por alojamientos cerca de la Plaza de Armas en
                        Cusco y en el distrito de Miraflores en Lima, para facilitar los traslados y el acceso a
                        actividades programadas.</span>
                    <p class="parrafo-subtitulo">b) Preparativos de Viaje:</p>
                    <span class="parrafo-termino">Por favor, asegúrese de enviarnos los detalles de sus vuelos y
                        cualquier documento adicional que se haya solicitado, como pasaportes o identificaciones</span>

                    <p class="parrafo-titulo">10. Puntos a Recordar:</p>
                    <p class="parrafo-subtitulo">a) Admisiones a Sitios Turísticos:</p>
                    <span class="parrafo-termino">A menos que se especifique lo contrario en su itinerario, los
                        ingresos a sitios turísticos no están incluidos, excepto a Machu Picchu siempre y cuando lo haya
                        contratado de esta manera y sujeto a disponibilidad. Por otro lado, los documentos adjuntados
                        anteriormente en su reserva están vinculados con el ingreso a Machu Picchu, tickets aéreos entre
                        otros motivo por el cual debe presentar ese documento al momento de su visita, así este se haya
                        vencido, debiendo traer consigo ambos documentos (vigente y el vencido).</span>
                    <p class="parrafo-subtitulo">b) Dinámica de los Tours:</p>
                    <span class="parrafo-termino">A menos que haya contratado un tour privado, participará en tours con
                        Grupos compartidos con un máximo de 20 pasajeros, proporcionando una experiencia rica y dinámica
                        con guías expertos en español o ingles. Para los tours privados, disfrutará de una atención
                        personalizada y un itinerario ajustado a sus preferencias personales.</span>
                    <p class="parrafo-subtitulo">c) Retorno y Horarios:</p>
                    <span class="parrafo-termino">Tras cada excursión, el retorno culminará en el Centro Histórico de
                        Cusco, salvo en el caso del tour a Machu Picchu, donde garantizamos el traslado de regreso a su
                        hotel. Los horarios de trenes y entradas a Machu Picchu se sujetan a la disponibilidad y serán
                        confirmados con antelación, procurando siempre la mejor experiencia. Por otro lado, debe tener
                        en cuenta que estos ingresos y tickets de tren no son reembolsable ni transferibles.</span>
                    <p class="parrafo-subtitulo">d) Seguros de Viaje:</p>
                    <span class="parrafo-termino">Recomendamos encarecidamente la contratación de un seguro de viaje
                        completo que cubra eventualidades médicas, cancelaciones y otras interrupciones. Esto no solo es
                        una medida de precaución, sino también una inversión en su tranquilidad durante su aventura en
                        Perú.</span>

                    <p class="parrafo-titulo">11. Relacionado al servicio y nuestras responsabilidades</p>
                    <span class="parrafo-termino">Esta información es crucial para nuestro equipo, ya que nos permite
                        prepararnos de manera adecuada y tomar las medidas necesarias para adaptar nuestras actividades
                        a las necesidades individuales de cada viajero. Nuestro objetivo es brindar una experiencia
                        excepcional, asegurando la comodidad y seguridad de cada participante durante toda la
                        aventura.</span>
                    <p class="parrafo-subtitulo">a) Divulgación obligatoria:</p>
                    <span class="parrafo-termino">Para garantizar una experiencia segura y placentera para todos
                        nuestros aventureros, es fundamental que al realizar la reserva con Jisa Adventure, los viajeros
                        informen sobre cualquier condición médica preexistente, alergias o problemas de salud
                        específicos.</span>
                    <p class="parrafo-subtitulo">b) Salud y estado físico:</p>
                    <span class="parrafo-termino">Los participantes deben estar en óptimas condiciones físicas. Si
                        tiene alguna duda sobre su salud, consulte con su médico. Si tienes más de 80 años, será
                        necesario un certificado médico vigente que acredite tu buen estado de salud.</span>
                    <p class="parrafo-subtitulo">c) Derechos de Participación:</p>
                    <span class="parrafo-termino">Jisa Adventure se reserva la discreción de negar a cualquier
                        individuo el derecho de viajar o participar en actividades turísticas específicas si su
                        condición física o mental se considera inadecuada para el viaje o representa un riesgo para sí
                        mismo o para otros.</span>
                    <p class="parrafo-subtitulo">d) Divulgación del embarazo:</p>
                    <span class="parrafo-termino">El embarazo se clasifica como una condición especial de cuidado
                        médico y debe informarse al momento de la reserva. En ciertos Tours de Aventura Extrema, que
                        pueden no ser aptos para todo público, Jisa Adventure se reserva el derecho de no aceptar la
                        participación de mujeres embarazadas por razones de seguridad.
                        Esta medida se toma con el máximo cuidado para garantizar la integridad de todas las personas
                        involucradas en nuestras experiencias de aventura. Nuestro compromiso primordial es asegurar la
                        seguridad y comodidad de cada uno de nuestros visitantes, ajustando las actividades según las
                        condiciones médicas y los niveles de riesgo asociados.</span>

                    <p class="parrafo-titulo">12. Derecho de uso de imágenes:</p>
                    <span class="parrafo-termino">Al participar en cualquiera de los paquetes ofrecidos por Jisa
                        Adventure el cliente otorga expresamente el permiso a Jisa Adventure para capturar y utilizar
                        cualquier imagen, foto y video tomados durante el tour con fines promocionales y de marketing.
                        Esto incluye, pero no se limita a, el uso en folletos, marketing en linea y plataformas de redes
                        sociales.
                        El cliente reconoce que no recibirá ninguna compensación, financiera o de otro tipo, por el uso
                        de dichas imágenes, fotos o vídeos. Este consentimiento se otorga libremente y sin la
                        expectativa de ningún retorno o beneficio.
                        No obstante, en caso de que el cliente no desee que Jisa Adventure utilice cualquier imagen de
                        su tour con fines promocionales, es necesario que lo comunique previamente. Para ello, puede
                        enviar un correo a su Asesor de Experiencias antes de iniciar el viaje.</span>

                    <p class="parrafo-titulo">Compromiso de JISA ADVENTURE:</p>
                    <span class="parrafo-termino">
                        Nuestro compromiso es con su satisfacción y seguridad. Nuestro equipo está dedicado a manejar
                        todos los aspectos de su viaje con profesionalismo y cuidado, y estamos disponibles para
                        responder a cualquier consulta o necesidad que pueda surgir antes o durante su viaje.
                        <br>Le agradecemos su confianza en Jisa Adventure y nos entusiasma poder ofrecerle una
                        experiencia de viaje que supere sus expectativas. Estamos seguros de que su aventura en Perú
                        será una historia que atesorará por siempre.
                        <br>Si tiene preguntas adicionales o necesita más información, no dude en contactarnos
                        <br>¡Esperamos darle la bienvenida pronto y ser parte de su inolvidable experiencia por Perú!
                        <br>Atentamente,
                        <br>El Equipo de Jisa Adventure
                    </span> --}}
                </div>
            </div>
        </div>
    </main>

</body>

</html>
