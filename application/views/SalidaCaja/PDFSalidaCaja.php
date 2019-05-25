<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Clínica SígueMED Nota Salida Caja #<?php echo $SalidaCaja->IdSalida;?></title>
    
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
                <td colspan="6">
                    <table>
                        <tr>
                            <td class="title" rowspan="2">
                                <img src="<?php echo base_url();?>app-assets/images/logo/SigueMED_Logo_B.jpg" alt="company logo" style="width:100%; max-width:80px;">
                            </td>
                            
                            
                            <td rowspan="2" align="right">
                                <b>Salida Caja #<?php echo $SalidaCaja->IdSalida;?><br></b>
                                Fecha Elaboración: <?php echo $SalidaCaja->FechaSalida;?><br>
                                Elaborada por: <?php echo $SalidaCaja->ElaboradaPor;?><br>
                            </td>
                           
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="6">
                    <table>
                        <tr>
                            <td>
                                Clínica SígueMED<br>
                                Privada Profra. Ma. Concepción M. #215<br>
                                La Concordia, Aguascalientes, AGS. C.P. 20040
                            </td>
                                                       
                            
                            <td rowspan="2" align="right">
                                <b>Médico</b><br>
                                <?php echo $SalidaCaja->NombreMedico; ?><br>
                                No. Cuenta: <?php echo $SalidaCaja->IdCuenta; ?><br>
                                
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
                
            
           
            
            <tr class="heading">
                <td>
                    Fecha Pago
                </td>
                
                <td>
                    Movimiento
                </td>
                <td>
                    Tipo Pago
                </td>
                <td>
                    Total
                </td>
                <td>
                    No. Remisión
                </td>
                <td>
                    Fecha Nota Rem.
                </td>
            </tr>
           
            
            <?php 
                foreach($MovimientosSalida as $movimiento)
                {
                    echo '<tr class="item">';
                    echo '<td>'.$movimiento['FechaMovimientoCuenta'].'</td>';
                    echo '<td>'.$movimiento['DescripcionTipoMovimientoCuenta'].'</td>';
                    echo '<td>'.$movimiento['DescripcionTipoPago'].'</td>';
                    echo '<td>$'.$movimiento['TotalMovimiento'].'</td>';
                    echo '<td>'.$movimiento['IdNotaRemision'].'</td>';
                    echo '<td>'.$movimiento['FechaNotaRemision'].'</td>';
                    //echo '</tr>';
                }
            ?>
            
            
            
            
            
            <tr>
                <td colspan="5"></td>
                <td>Resumen</td>
            </tr>
            <tr class="total">
                <td colspan="5"> </td>
                
                <td style="background-color: gainsboro">
                    <b>Total Salida: $<?php echo $SalidaCaja->TotalSalida;?></b>
                </td>
            </tr>
            <tr class="total">
                <td colspan="5"> </td>
                
                <td>
                    Total Transferencias:<span style="color:blue"> $ <?php echo $TotalTransferencias->TotalTipoPago;?></span>
                </td>
            </tr>
            <tr class="total">
                <td colspan="5"> </td>
                
                <td>
                    Total Tarjeta Credito:<span style="color:blue"> $ <?php echo $TotalTarjetaCredito->TotalTipoPago;?></span>
                </td>
            </tr>
            
        </table>
    </div>
</body>
</html>
