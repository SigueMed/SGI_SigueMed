<!doctype html>
<html>
<head>
    <link rel="stylesheet" href="style.css">


    <!--style -->
    <style>
    * {
    font-size: 12px;
    font-family: 'Times New Roman';
}

td,
th,
tr,
table {
    border-top: 1px solid black;
    border-collapse: collapse;
    font-size: 10px;
}

td.producto,
th.producto {
    width: 75px;
    max-width: 75px;

}

td.cantidad,
th.cantidad {
    width: 40px;
    max-width: 40px;
    word-break: break-all;
}

td.precio,
th.precio {
    width: 40px;
    max-width: 40px;
    word-break: break-all;
}

.centrado {
    text-align: center;
    align-content: center;
}
.derecha {
    text-align: right;
    align-content: right;
}

.ticket {
    width: 155px;
    max-width: 155px;
}

img {
    max-width: inherit;
    width: inherit;
}
@media print {
    .oculto-impresion,
    .oculto-impresion * {
        display: none !important;
    }
}
    </style>
</head>

<body>
  <div class="ticket">
      <div class="centrado">
        <img src="<?php echo base_url();?>app-assets/images/logo/SigueMED_Logo_B.jpg" alt="company logo" style="width:80%; max-width:70px;">
      </div>


            <p class="centrado">Clinica SígueMED<br>Sucursal <?=$Clinica->NombreClinica?><br>Ticket No. <?=$NotaRemision->Folio;?><br> <?=$NotaRemision->FechaNotaRemision;?> <br>Hora <?= date('H:i');?></p>

            <p>Tel. <?=$Clinica->TelefonoClinica?></p>

              <p>Paciente:<?=$NotaRemision->NombrePaciente;?>
                <br>
                Medico: <?=$NotaRemision->MedicoAtendio;?>
              </p>
            <table>
                <thead>
                    <tr>
                        <th>CANT</th>
                        <th>PROD</th>
                        <th>%</th>
                        <th>$</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    foreach($DetalleNotaRemision as $detalle)
                    {
                        echo '<tr class="item">';
                        echo '<td>'.$detalle['Cantidad'].'</td>';
                        echo '<td>'.$detalle['DescripcionProducto'].'</td>';
                        echo '<td>'.$detalle['Descuento'].'%</td>';


                        echo '<td>$'.$detalle['SubTotalDetalle'].'</td>';
                        echo '</tr>';
                    }
                ?>

                </tbody>
            </table>
            <div class="derecha">
              <p>TOTAL: $<?=$NotaRemision->TotalNotaRemision;?></p>


            </div>

            <p class="centrado"><b>SU PAGO</b></p>

            <table>
                <thead>
                    <tr>
                        <th>FORMA</th>

                        <th>$$</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    foreach($PagosNotaRemision as $pagoNotaRemision)
                    {
                        echo '<tr class="item">';
                        echo '<td>'.$pagoNotaRemision['DescripcionTipoPago'].'</td>';
                        echo '<td>'.$pagoNotaRemision['TotalPago'].'</td>';
                        echo '</tr>';
                    }
                ?>

                </tbody>
            </table>

            <div class="derecha">

              <p>TOTAL PAGADO: $<?=$NotaRemision->TotalPagado;?></p>
              <p>--------------------</p>
              <p>SALDO: $<?php echo (floatval($NotaRemision->TotalNotaRemision) - floatval($NotaRemision->TotalPagado));?></p>

            </div>

            <p class="centrado">¡GRACIAS POR SU COMPRA!<br></p>
        </div>
        <button class="oculto-impresion" onclick="imprimir()">Imprimir</button>

</body>
</html>

<script type="text/javascript">
function imprimir() {
  window.print();
}

</script>
