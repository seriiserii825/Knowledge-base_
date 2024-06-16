<html>
<head>
    <style>
        @font-face {
            font-family: Comfortaa;
            src: url("{{asset('fonts/Comfortaa-Bold.ttf')}}");
            font-weight: 700;
        }
        @font-face {
            font-family: Comfortaa;
            src: url("{{asset('fonts/Comfortaa-Light.ttf')}}");
            font-weight: 300;
        }
        @font-face {
            font-family: Eina04;
            src: url("{{asset('fonts/Eina04-Light.ttf')}}");
            font-weight: 300;
        }
        @font-face {
            font-family: Eina04;
            src: url("{{asset('fonts/Eina04-Regular.ttf')}}");
            font-weight: 400;
        }
        @font-face {
            font-family: Eina04;
            src: url("{{asset('fonts/Eina04-SemiBold.ttf')}}");
            font-weight: 600;
        }
        * {
            padding: 0px;
            margin: 0px;
            font-family: Eina04, sans-serif;
            font-weight: normal;
        }
        body {
            background-image:url({{  url('img/riepelogo/pdfback.jpg') }});
            background-size: cover;
            background-repeat: no-repeat;
            background-position: top;
        }
        .epilogue__header {
            padding: 0 32px 0;
            width: 100%;
        }
        .epilogue__header img {
            margin-right: 32px;
            margin-top: 32px;
        }
        .epilogue__text {
            display: inline-block;
            margin-top: 32px;
            width: 138px;
            font-family: Comfortaa, sans-serif;
            font-size: 8px;
            font-weight: 300;
            color: #3877A0;
        }
        .epilogue__text b {
            font-weight: bold;
        }
        .epilogue__body {
            position: relative;
            padding: 115px 32px 0;
        }
        .epilogue__info {
            padding-top: 31px;
            padding-bottom: 16px;
            border-bottom: 1px solid #E6E6E6;
        }
        .epilogue__title {
            margin-bottom: 0;
            font-size: 14px;
            font-weight: 600;
            line-height: 1;
            color: #244C56;
        }
        .epilogue__subtitle {
            font-size: 10px;
            font-weight: 300;
        }
        .epilogue__subtitle b {
            font-weight: 400;
        }
        .epilogue__wrap {
            width: 100%;
            border-collapse: collapse;
        }
        .epilogue__wrap td {
            padding: 16px 48px;
            border-bottom: 1px solid #849DA2;
        }
        .epilogue__wrap td:first-of-type {
            padding-left: 0;
        }
        .info--first {
            border-right: 1px solid #E6E6E6;
        }
        .info__label {
            font-size: 6px;
            font-weight: 600;
            text-transform: uppercase;
            color: #244C56;
        }
        .info__title {
            font-size: 10px;
            font-weight: 600;
            color: black;
        }
        .info__link {
            font-size: 8px;
            font-weight: 600;
            text-decoration: none;
            color: #2C85A0;
        }
        .info__subtitle {
            font-size: 10px;
            font-weight: normal;
        }
        .info__value {
            font-size: 8px;
            color: #4A4A4A;
        }
        .table__title {
            margin-top: 5px;
            font-size: 8px;
            font-weight: 600;
            color: black;
        }
        .table table {
            margin-bottom: 10px;
            width: 100%;
            border-collapse: collapse;
        }
        .table tbody tr:nth-of-type(odd) {
            background: #f5f5f5;
        }
        .table table td,
        .table table th {
            padding: 8px 16px;
            font-size: 8px;
        }
        .table th {
            text-align: right;
            border-bottom: 1px solid #849DA2;
        }
        .table td {
            text-align: right;
        }
        .table tr td:first-of-type {
            text-align: left;
        }
        .table td b {
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="epilogue">
    <div class="epilogue__header">
        <img src="{{url('/img/riepelogo/epilogue-logo.png')}}" alt=""/>
        <div class="epilogue__text"><b>Soluzioni</b> innovative per far <b>crescere</b> la tua <b>azienda</b></div>
    </div>
    <div class="epilogue__body">
        <div class="epilogue__content">
            <div class="epilogue__info">
                <h1 class="epilogue__title">Riepilogo trimestrale copie (da lettura contatori)</h1>
                <div class="epilogue__subtitle">Periodo: Dal <b>01/10/2022</b> al <b>31/12/2022</b></div>
            </div>
            <table class="epilogue__wrap">
                <tr>
                    <td>
                        <div class="info info--first">
                            <div class="info__label">Cliente</div>
                            <h2 class="info__title">Spett.le Consorzio Musp</h2>
                            <div class="info__link">sabrina.anselmi@musp.net</div>
                        </div>
                    </td>
                    <td>
                        <div class="info">
                            <div class="info__label">Stampante</div>
                            <h2 class="info__subtitle">Canon IRAC3720i</h2>
                            <div class="info__value">Matricola 22F11936</div>
                        </div>
                    </td>
                    <td>
                        <div class="info">
                        </div>
                    </td>
                </tr>
            </table>
            <div class="table">
                <h2 class="table__title">Copie bianco nero</h2>
                <table>
                    <thead>
                    <tr>
                        <th></th>
                        <th>Valore al 01/10/2022</th>
                        <th>Valore al 31/12/2022</th>
                        <th>Numero copie</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>A4</td>
                        <td>16358</td>
                        <td>18377</td>
                        <td>2019</td>
                    </tr>
                    <tr>
                        <td>A3</td>
                        <td>4</td>
                        <td>4</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <td><b>Totale</b></td>
                        <td></td>
                        <td></td>
                        <td><b>2019</b></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="table">
                <h2 class="table__title">Copie colore</h2>
                <table>
                    <thead>
                    <tr>
                        <th></th>
                        <th>Valore al 01/10/2022</th>
                        <th>Valore al 31/12/2022</th>
                        <th>Numero copie</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>A4</td>
                        <td>16358</td>
                        <td>18377</td>
                        <td>724</td>
                    </tr>
                    <tr>
                        <td>A3</td>
                        <td>4</td>
                        <td>4</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <td><b>Totale</b></td>
                        <td></td>
                        <td></td>
                        <td><b>724</b></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="table">
                <h2 class="table__title">Costi</h2>
                <table>
                    <thead>
                    <tr>
                        <th></th>
                        <th>Bianco nero</th>
                        <th>Colore</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Copie incluse</td>
                        <td>0</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <td>Copie effettuate</td>
                        <td>2019</td>
                        <td>724</td>
                    </tr>
                    <tr>
                        <td>Copie extra</td>
                        <td>2019</td>
                        <td>724</td>
                    </tr>
                    <tr>
                        <td>Importo per copia</td>
                        <td>0,007 €</td>
                        <td>0,070 €</td>
                    </tr>
                    <tr>
                        <td>Importo base</td>
                        <td>14,13 €</td>
                        <td>50,68 €</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="table">
                <table>
                    <thead>
                    <tr>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Rivalutazione Istat</td>
                        <td>0,2 €</td>
                    </tr>
                    <tr>
                        <td><b>Totale</b></td>
                        <td><b>65.01 €</b></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>




