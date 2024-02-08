@php
    function formatCurrency($str){
        $str = number_format($str, 0, '.', '.');

        return '$' . $str;
    }
@endphp

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotización</title>
    <style>
        body{
            margin: 0px;
            padding: 0px;
        }
        @font-face {
        font-family: "Alata";
        src: url("https://raw.githubusercontent.com/HernanTo/Glory-store/deploy/public/fonts/alata/Alata-Regular.ttf") format("truetype");
        font-weight: bold;
        }
        @font-face {
        font-family: "Poppins";
        src: url("https://raw.githubusercontent.com/HernanTo/Glory-store/deploy/public/fonts/Poppins-Regular.ttf") format("truetype");
        font-weight: normal;
        }

        @font-face {
        font-family: "Poppins";
        src: url("https://raw.githubusercontent.com/HernanTo/Glory-store/deploy/public/fonts/Poppins/Poppins-SemiBold.ttf") format("truetype");
        font-weight: bold;
        }

        @font-face {
        font-family: "Nunito";
        src: url("https://raw.githubusercontent.com/HernanTo/Glory-store/deploy/public/fonts/Nunito_Sans/static/NunitoSans_10pt-Regular.ttf") format("truetype");
        font-weight: normal;
        }

        @font-face {
        font-family: "Nunito";
        src: url("https://raw.githubusercontent.com/HernanTo/Glory-store/deploy/public/fonts/Nunito_Sans/static/NunitoSans_10pt-Bold.ttf") format("truetype");
        font-weight: bold;
        }
        @page {
            margin-top: 210px;
            margin-bottom: 50px;
        }
        .main-content{
            max-width: 700px;
        }
        .header{
            position: fixed;
            width: 700px;
            top: -210px;
            left: 0px;
            background: white;
            width: 100%;
            max-width: 700px;
            height: 210px;
        }
        hr{
            margin: 0px
        }
        .header table{
            width: 100%;
            font-family: "Poppins";
            border-collapse: collapse;
        }
        .head_con h2{
            margin: 0px;
            padding: 0px;
            font-size: 30px;
            text-align: center;
        }
        .head_con{
            background: #505765;
            color: white;
            width: 100%;
            padding: 28px 0px 40px 0px;
            margin: 0px;
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
            margin-top: -6px;
        }

        .header table .info_bill b{
            font-family: "Alata";
        }
        .logo__lotus{
            width: 100%;
            margin-left: 50px
        }
        .info_lotus{
            text-align: right;
            font-size: 14px;
            font-family: 'Nunito';
        }
        .table_info_usr{
            text-align: left;
            border-collapse: collapse;
            width: 100%;
        }
        .table_info_usr tbody tr td{
            padding-left: 20px;
            padding-right: 20px;
            font-family: "Nunito";
            font-size: 15px;
            height: 30px;
        }
        .table_info_usr tbody tr{
            padding-bottom: 50px;
        }
        .table_info_usr tbody tr td b{
            font-family: "Poppins";
        }
        .colm_sc{
            text-align: left;
            padding-left: 100px !important;
        }
        .th__main_usr{
            border-bottom: 2px solid black;
            font-family: "Alata";
        }
        .con_table{
            padding: 20px;
        }
        .con_table table{
            text-align: center;
        }
        .table__b{
            border-collapse: collapse;
            font-family: "Nunito";
            width: 100%;
        }
        .table__b thead th{
            background: #505765;
            color: white;
            font-family: "Alata";
            font-size: 11px
        }
        .table__b tbody tr{
            background: rgba(201, 201, 201, 0.5);
        }
        .table__b tbody tr td{
            font-size: 13px;
        }
        .table__b tbody .odd{
            background: #C9C9C9;
        }
        .con_resumen{
            min-height: 64px;
            max-height: 160px;
        }
        #table_rsume{
            width: 100%;
            min-height: 64px;
            border-top: 2px solid;
            page-break-inside: avoid;
        }
        #table_rsume tr td{
            text-align: right;
            font-family: "Nunito";
            font-size: 15px;
        }
        #table_rsume tr td b{
            font-family: "Alata";
        }

        .info_bill td{
            padding: 20px 0px 20px 0px;
            font-family: 'Nunito'
        }
        .subtr{
            background: #ffffff !important;
            border-top: 2px solid;
            font-size: 14px;
        }
        .subtd b{
            text-align: right  !important;
            font-family: "Alata" !important;
        }
        .name_tall{
            font-size: 17px;
        }
        .alert_cotizacion{
            max-width: 250px;
            text-align: center;
            font-family: 'Nunito';
            font-weight: bold;
            font-size: 15px
        }
    </style>
</head>
<body>
    <div class="header">
        <table class="table_infoo">
            <tr>
                <td style="width: 220px;">
                    <div class="head_con"><h2>COTIZACIÓN</h2></div>
                </td>
                <td class="info_lotus">
                    <b class="name_tall">Glory Store</b>  <br>
                    <b>EMAIL: </b>   soporte@tallerglory.store<br>
                    <b>TÉLEFONO: </b>  3102452756<br>
                    <b>NIT/CC: </b>  80864878<br>
                    CL 64 103A-33, Bogotá
                </td>
                <td style="width: 200px; text-align: center;">
                    <img src="https://raw.githubusercontent.com/HernanTo/Glory-store/deploy/public/img/logoc.png" alt="logo_lotus" class="logo__lotus">
                </td>
            </tr>
        </table>
        <table class="table_infoo">
            <tr class="info_bill">
                <td><b>NÚMERO DE COTIZACIÓN: </b>  {{$budget->reference}} </td>
                <td style="text-align: right;"><b>FECHA DE LA COTIZACIÓN: </b> {{$budget->created_at->format('d-m-Y')}} </td>
            </tr>
        </table>
        <hr>
    </div>
    <div class="main-content">
        <main class="body__content">
            <table class="table_info_usr">
                <thead>
                    <tr class="th__main_usr">
                        @php
                            $stateGeneral = $budget->customer->modelo != NULL || $budget->customer->modelo != '' || $budget->customer->placa != NULL || $budget->customer->placa != '';

                            $stateModelo = $budget->customer->modelo != NULL || $budget->customer->modelo != '';
                            $statePlaca = $budget->customer->placa != NULL || $budget->customer->placa != '';
                        @endphp
                        <th height="40" style="text-align: left; width: 50%;">DATOS CLIENTE</th>
                        @if ($stateGeneral)
                            <th class="colm_sc" height="40">INFORMACIÓN VEHÍCULO</th>
                        @else
                            <th class="colm_sc" height="40"></th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <b>Nombre: </b>
                            {{$budget->customer->fullName}}
                        </td>
                        @if ($stateModelo)
                            <td class="colm_sc"><b>Modelo:</b> {{$budget->customer->modelo}}</td>
                        @else
                            <td class="colm_sc"> </td>
                        @endif

                    </tr>
                    <tr>
                        <td><b>Dirección: </b> {{$budget->customer->address}}</td>
                        @if ($statePlaca)
                            <td class="colm_sc"><b>Placa:</b> {{$budget->customer->placa}}</td>
                        @else
                            <td class="colm_sc"> </td>
                        @endif
                    </tr>
                    <tr>
                        <td colspan="2"><b>NIT/CC:</b> {{$budget->customer->cc}}</td>
                    </tr>
                    <tr>
                        <td colspan="2"><b>Teléfono:</b> {{$budget->customer->phone_number}}</td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2"><b>Técnico/Vendedor: </b> {{$budget->seller->fullName}}</td>
                    </tr>
                </tbody>
            </table>
            <hr>
                @if (count($budget->products) >= 1)
                    <div class="con_table">
                        <table class="table__b">
                            <thead>
                                <tr>
                                    <th>CÓDIGO</th>
                                    <th>REPUESTO</th>
                                    <th>CANT.</th>
                                    <th>STOCK</th>
                                    <th>COSTO/U</th>
                                    <th>COSTO/T</th>
                                    <th>DESCUENTO %</th>
                                    <th>VALOR DESC</th>
                                    <th>TOTAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $subtProducts = 0;
                                    $discount = 0;
                                @endphp
                                @foreach ($budget->products as $product)
                                    @php
                                        if($product->pivot->stock <= $product->stock){
                                            $stock = 'Si';
                                        }else{
                                            $stock = 'No';
                                        }
                                    @endphp
                                    <tr class="{{ $loop->even ? 'odd' : 'even-row' }}">
                                        <td> {{$product->num_repuesto}} </td>
                                        <td> {{$product->name}} </td>
                                        <td> {{$product->pivot->stock}} </td>
                                        <td> {{$stock}} </td>
                                        <td> {{formatCurrency($product->pivot->price)}} </td>
                                        <td> {{formatCurrency($product->pivot->price * $product->pivot->stock)}} </td>
                                        <td> {{$product->pivot->discount}}% </td>
                                        <td> {{formatCurrency((($product->pivot->price * $product->pivot->stock) * $product->pivot->discount)/100)}} </td>
                                        <td> {{formatCurrency($product->pivot->total_prices)}} </td>
                                    </tr>
                                    @php
                                        $subtProducts += $product->pivot->total_prices;
                                        $discount += ((($product->pivot->price * $product->pivot->stock) * $product->pivot->discount)/100);
                                    @endphp
                                @endforeach
                                <tr class="subtr">
                                    <td colspan="8" class="subtd"><b>SUBTOTAL REPUESTOS: </b></td>
                                    <td> {{formatCurrency($subtProducts)}} </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @endif

                <div class="con_table con_resumen">
                <table id="table_rsume">
                    <tr>
                    </tr>
                    @if ($discount > 0)
                        <tr>
                            <td colspan="2"><b>DESCUENTO: </b> - {{formatCurrency($discount)}}</td>
                        </tr>
                        @endif
                        <tr>
                        <td rowspan="3" class="alert_cotizacion">Sujeto a variación de precio y stock. <br>
                            Cotización válida hasta {{$date->format('d-m-Y')}}</td>
                        <td><b>SUBTOTAL: </b> {{formatCurrency($budget->subtotal)}} </td>
                    </tr>
                    @if ($budget->IVA)
                        <tr>
                            <td><b>IVA: </b> {{formatCurrency($budget->subtotal * 0.19)}} </td>
                        </tr>
                    @endif
                    <tr>
                        <td><b>TOTAL: </b>  {{formatCurrency($budget->total)}}</td>
                    </tr>
                </table>
            </div>
        </main>
    </div>
</body>
</html>
