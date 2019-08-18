<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Clínica SígueMED Nota de Remisión #<?php echo $IdNotaRemision;?></title>

    <!--style -->
    <style>
    .invoice-box {
        max-width: 850px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }

    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;

    }

    .invoice-box table td {
        padding: 5px;
        vertical-align: top;


    }



    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }

    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }

    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }

    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }

    .invoice-box table tr.item.last td {
        border-bottom: none;
    }

    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }

    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }

        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }

    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }

    .rtl table {
        text-align: right;
    }

    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="4">
                    <table>
                        <tr>
                            <td class="title" rowspan="2">
                                <img src="<?php echo base_url();?>app-assets/images/logo/SigueMED_Logo_B.jpg" alt="company logo" style="width:100%; max-width:80px;">
                            </td>


                            <td rowspan="2" align="right">
                                <b>Nota #<?php echo $NotaRemision->Folio;?><br></b>
                                Fecha Elaboración: <?php echo $NotaRemision->FechaNotaRemision;?><br>
                                Elaborada por: <?php echo $NotaRemision->ElaboradaPor;?><br>
                            </td>

                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="4">
                    <table>
                        <tr>
                            <td>
                                <?=$NotaRemision->ResponsableFolio?><br>
                                <?=$NotaRemision->DireccionFolio?>
                            </td>


                            <td rowspan="2" align="right">
                                <b>Paciente</b><br>
                                <?php echo $NotaRemision->NombrePaciente; ?><br>
                                email: <?php echo $NotaRemision->email; ?><br>
                                RFC: <?php echo $NotaRemision->RFC; ?><br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td colspan="2">
                    Forma de Pago
                </td>
                <td>
                    Fecha Pago
                </td>

                <td>
                    Total Pago
                </td>
            </tr>

            <?php
                foreach($PagosNotaRemision as $pagoNotaRemision)
                {
                    echo '<tr class="details">';
                    echo '<td colspan="2">'.$pagoNotaRemision['DescripcionTipoPago'].'</td>';
                    echo '<td>'.$pagoNotaRemision['FechaPago'].'</td>';
                    echo '<td>$'.$pagoNotaRemision['TotalPago'].'</td>';
                    echo '</tr>';

                }
            ?>


            <tr class="heading">
                <td>
                    Producto
                </td>

                <td>
                    Cantidad
                </td>
                <td>
                    Descuento
                </td>
                <td>
                    SubTotal
                </td>
            </tr>

            <?php
                foreach($DetalleNotaRemision as $detalle)
                {
                    echo '<tr class="item">';
                    echo '<td><p>'.$detalle['DescripcionProducto'].'</p><p style="color:#818a91">'.$detalle['NombreSubProducto'].'</p></td>';
                    echo '<td>'.$detalle['Cantidad'].'</td>';
                    echo '<td>'.$detalle['Descuento'].' %</td>';
                    echo '<td>$'.$detalle['SubTotalDetalle'].'</td>';
                }
            ?>





            <tr>
                <td colspan="3"></td>
                <td>Resumen</td>
            </tr>
            <tr class="total">
                <td colspan="3"> </td>

                <td style="background-color: gainsboro">
                    <b>Total Nota: $<?php echo $NotaRemision->TotalNotaRemision;?></b>
                </td>
            </tr>
            <tr class="total">
                <td colspan="3"> </td>

                <td>
                    Total Pagos:<span style="color:red">(-) $ <?php echo $NotaRemision->TotalNotaRemision;?></span>
                </td>
            </tr>
            <tr class="total">
                <td colspan="3"> </td>

                <td style="background-color: gainsboro">
                    <b>Balance: $ <?php echo (floatval($NotaRemision->TotalNotaRemision) - floatval($NotaRemision->TotalPagado));?></b>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
