<!DOCTYPE html>
<html>

<head>
    <title>
        Facturacion
    </title>
    <style>
        @page {
            width: 210mm;
            height: 149mm;
        }

        html {
            margin: 0;
            border: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            margin: 0;
            padding: 0;
            padding: 20px;
        }

        .header {
            width: 100%;
            height: 150px;
        }

        .logo {
            float: left;
            width: 20%;
            height: 150px;
            text-align: center;
        }

        .info-empresa {
            float: left;
            width: 55%;
            height: 150px;
            text-align: center;
        }

        .info-observaciones {
            float: left;
            width: 80%;
            height: 150px;
            text-align: left;
            font-size: 12px;
            padding-top: 40px;
            padding-left: 20px;
        }


        .observaciones {
            border: #000 1px solid;
            height: 150px;
        }

        .footer {
            margin-top: 20px;
            font-size: 12px;
            text-align: left;
        }

        .table-info-empresa {
            height: 100%;
            width: 100%;
            display: table;
            text-align: center;
        }

        .table-info-empresa td {
            vertical-align: middle;
        }

        .h5-info-empresa {
            font-size: 20px;
            margin: 0;
            padding: 0;
            font-weight: bold;
        }

        .h6-info-empresa {
            font-size: 15px;
            margin: 0;
            padding: 0;
            font-weight: normal;
        }

        .h5-h6-space {
            margin: 0;
            padding: 0;
            height: 10px;
        }

        .cuadro-info {
            float: left;
            width: 25%;
            height: 150px;
        }

        .cuadro-inner {
            border: 1px solid #000;
            text-align: center;
            padding: 30px;
        }

        .first-columnt-table {
            width: 160px;
        }

        .second-column-table {
            width: 640px;
        }

        .third-column-table {
            width: 180px;
        }

        .fourth-column-table {
            width: 190px;
        }

        .table-tbody {
            font-size: 10px;
        }

        .data {
            height: 100px;
        }

        .fw-bold {
            font-weight: bold;
        }

        .td-color-detail {
            background-color: #189c9f;
        }

        .first-td {
            text-align: center;
            width: 110px;
            padding: 5px;
        }

        .second-td {
            text-align: center;
            width: 120px;
            padding: 5px;
        }

        .third-td {
            text-align: center;
            width: 655px;
            padding: 5px;
        }

        .fourth-td {
            text-align: center;
            width: 120px;
            padding: 5px;
        }

        .fiveth-td {
            text-align: center;
            width: 130px;
            padding: 5px;
        }

        .tr-details {
            text-align: center;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }

        .content-td-first {
            width: 870px;
            font-weight: bold;
            font-style: italic;
        }

        .content-td-second {
            width: 150px;
        }

        .content-td-third {
            width: 150px;
        }

        .text-right {
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="logo">
            <img class="imagen-logo" src="{{ asset('img/brand/logo.png')}}" width="150px">
        </div>
        <div class="info-empresa">
            <table class="table-info-empresa">
                <tr>
                    <td>
                        <div class="h5-h6-space"></div>
                        <h5 class="h5-info-empresa">A.V.T. CUZCO TRAVEL E.I.R.L.</h5>
                        <h5 class="h5-info-empresa">Tour Operator</h5>
                        <div class="h5-h6-space"></div>
                        <h6 class="h6-info-empresa">Contact:984 930 404</h6>
                        <h6 class="h6-info-empresa">jisa_tours@hotmail.com</h6>
                        <h6 class="h6-info-empresa">CAL. GARCILASO NRO - 265 INT. 12 - Cusco - Cusco - Cusco</h6>
                    </td>
                </tr>
            </table>
        </div>
        <div class="cuadro-info">
            <div class="cuadro-inner">
                <h6 class="h6-info-empresa">RUC: 20600769317</h6>
                <h5 class="h5-info-empresa">BOLETA DE VENTA</h5>
                <h5 class="h5-info-empresa">ELECTRONICA</h5>
                <h6 class="h6-info-empresa">B001-1554</h6>
            </div>
        </div>
    </div>
    <div class="data">
        <table>
            <tbody class="table-tbody">
                <tr>
                    <td class="first-column-table fw-bold">CLIENTE:</td>
                    <td class="second-column-table">ANGEL OLIVAS MARTINEZ</td>
                    <td class="third-column-table fw-bold">PASAPORTE:</td>
                    <td class="fourth-column-table">PAP471870</td>
                </tr>
                <tr>
                    <td class="first-columnt-table fw-bold">DIRECCION:</td>
                    <td class="second-column-table">-</td>
                    <td class="third-column-table fw-bold">FECHA:</td>
                    <td class="fourth-column-table">14/04/2024 - 14:07:55</td>
                </tr>
                <tr>
                    <td class="first-columnt-table fw-bold">FORMA DE PAGO:</td>
                    <td class="second-column-table">CONTADO</td>
                    <td class="third-column-table fw-bold">MONEDA:</td>
                    <td class="fourth-column-table">DOLARES</td>
                </tr>
                <tr>
                    <td class="first-columnt-table fw-bold">VENDEDOR:</td>
                    <td class="second-column-table">ANYELA</td>

                </tr>
                <tr>
                    <td class="first-columnt-table fw-bold">CONDICION PAGO:</td>
                    <td class="second-column-table">WE TRAVEL $ 77.78 14/04/2024</td>

                </tr>
            </tbody>
        </table>
    </div>
    <div class="detail">
        <table class="table table-bordered table-striped table-sm">
            <thead class="table-tbody">
                <tr>
                    <td class="first-td td-color-detail">CANT</td>
                    <td class="second-td td-color-detail">U.M.</td>
                    <td class="third-td td-color-detail">DESCRIPCION</td>
                    <td class="fourth-td td-color-detail">P.U</td>
                    <td class="fiveth-td td-color-detail">IMPORTE</td>
                </tr>
            </thead>
            <tbody class="table-tbody">
                <tr class="tr-details">
                    <td>1</td>
                    <td>SERVICIO</td>
                    <td>PAGO PARA EL VALLE SAGRADO VIP FECHA DE SERVICIO 23 ABRIL</td>
                    <td>77.75</td>
                    <td>77.75</td>
                </tr>
                <tr class="tr-details">
                    <td>1</td>
                    <td>SERVICIO</td>
                    <td>PAGO PARA EL VALLE SAGRADO VIP FECHA DE SERVICIO 23 ABRIL</td>
                    <td>77.75</td>
                    <td>77.75</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="content">
        <table>
            <tbody class="table-tbody">
                <tr>
                    <td class="content-td-first" rowspan="3">SON: SETENTA Y SISTE CON 78/100 DOLARES</td>
                    <td class="content-td-second fw-bold">OP. GRAVADA</td>
                    <td class="content-td-third text-right">85.92</td>
                </tr>
                <tr>
                    <td class="content-td-second fw-bold">I.G.V</td>
                    <td class="content-td-third text-right">11.86</td>
                </tr>
                <tr>
                    <td class="content-td-second fw-bold">IMPORTE TOTAL</td>
                    <td class="content-td-third text-right">77.78</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="observaciones">
        <div class="info-observaciones">
            <div class="fw-bold">OBSERVACIONES</div>
            <div>Representación impresa de la Boleta de Venta Electronica</div>
            <div>Autorizado mediante Resolución de Intendencia N° 094-005-0001933/SUNAT</div>
            <div>Emitido a travez de facturacion propia</div>
        </div>
        <div class="logo">
            <img class="imagen-logo" src="data:image/png;base64, {!! $qrcode !!}" width="150px">
        </div>
    </div>
    <div class="footer">
        GRACIAS POR SU PREFERENCIA
    </div>
</body>

</html>