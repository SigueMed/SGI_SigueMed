<!doctype html>
<html>
<head>
    


    <!--style -->
    <style>
    * {
    font-size: 10px;
    font-family: 'Arial';
}

th,
table {
    border-top: 1px solid black;
    border-collapse: collapse;
    border-bottom: 1px solid black;
}

td.descripcion,
th.descripcion {
    width: 65px;
    max-width: 70px;
    font-size: 9px;
}

td.cantidad,
th.cantidad {
    width: 42px;
    max-width: 42px;
    word-break: break-all;
    font-size: 9px;
}

td.precio,
th.precio {
    width: 45px;
    max-width: 42px;
    word-break: break-all;
    font-size: 9px;
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
    width: 154px;
    max-width: 154px;
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
        <img src="<?php echo base_url();?>app-assets/images/logo/SigueMED_Logo_B.jpg" alt="company logo" style="width:80%; max-width:80px;">
      </div>


            <p class="centrado">Clinica SígueMED<br>Sucursal <?=$Clinica->NombreClinica?><br>Tel. <?=$Clinica->TelefonoClinica?></p>



              <p class="centrado"><b>CORTE CAJA</b></p>

              <p class="derecha"></p>
              <p>No. Corte: <?=$CorteCaja->IdCorteCaja?><br>
              Fecha: <?=$CorteCaja->FechaCorte?><br>
              Hora: <?=$CorteCaja->HoraCorte?></p>

              <p class="derecha">
                Total Entradas: $<?=number_format($CorteCaja->TotalEntradas,2)?><br>
                Total Salidas: $<?=number_format($CorteCaja->TotalSalidas,2)?><br>
                ----------------------------------------
                TOTAL CORTE: $<?=number_format($CorteCaja->TotalCorte,2)?><br>
              </p>

              <p class="centrado"><b>FORMA DE PAGO</b></p>
            <table>
                <thead>
                    <tr>
                        <th>FORMA</th>
                        <th>MONTO</th>
                        <th>ENT.</th>

                    </tr>
                </thead>
                <tbody>
                <?php
                    foreach($DetalleCorteCaja as $detalle)
                    {
                        echo '<tr class="item">';
                        echo '<td class="descripcion">'.$detalle['DescripcionTipoPago'].'</td>';
                        echo '<td class="precio">$'.number_format($detalle['TotalCorteCaja'],0).'</td>';
                        echo '<td class="precio">$'.number_format($detalle['TotalEntregado'],0).'</td>';
                        echo '</tr>';
                    }
                ?>

                </tbody>
            </table>
            <div class="derecha">

              <p>TOTAL ENTREGADO: $<?=number_format($CorteCaja->TotalEntregado,2)?></p>

              <p class="centrado"><b>DETALLE CUENTAS</b></p>

            </div>

            <table>
                <thead>
                    <tr>
                        <th>CUENTA</th>
                        <th>ENT.</th>
                        <th>SAL.</th>
                        <th>BAL.</th>

                    </tr>
                </thead>
                <tbody>
                <?php
                    foreach($BalanceCorte as $detalle)
                    {
                        echo '<tr class="item">';
                        echo '<td class="descripcion">'.$detalle['DescripcionCuenta'].'</td>';
                        echo '<td class="precio">$'.number_format($detalle['TotalEntradas'],0).'</td>';
                        echo '<td class="precio">$'.number_format($detalle['TotalSalidas'],0).'</td>';
                        echo '<td class="precio">$'.number_format($detalle['Balance'],0).'</td>';
                        echo '</tr>';
                    }
                ?>

                </tbody>
            </table>




            <p class="centrado">___________________________<br></p>
            <p class="centrado">Elaborado por<br></p>
            <p class="centrado"><?=$CorteCaja->Responsable?><br></p>
            <p></p>






            <?php
              foreach ($DetalleEfectivo as $detalle) {

                if ($detalle['Balance']>0)
                {
                  echo '<p class="centrado">_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ <br></p>';

                  echo '<div class="centrado">
                    <img src="'.base_url().'app-assets/images/logo/SigueMED_Logo_B.jpg" alt="company logo" style="width:80%; max-width:80px;">
                  </div>';

                  echo '<p class="centrado">Clinica SígueMED<br>Sucursal '.$Clinica->NombreClinica.'<br>Tel. '.$Clinica->TelefonoClinica.'</p>';


                  echo '<p class="centrado"><b>DEPOSITO EFECTIVO</b></p>';
                  echo '<p class="derecha"></p>';


                  echo '<p>No. Corte: '.$CorteCaja->IdCorteCaja.' <br>Fecha: '.$CorteCaja->FechaCorte.'<br><br></p>';

                  echo '<p>CUENTA: '.$detalle['DescripcionCuenta'].'</p>';

                  echo '<p>TOTAL EFECTIVO: '.$detalle['Balance'].'</p>';


                }




              }
            ?>

        </div>
        <button class="oculto-impresion" onclick="imprimir()">Imprimir</button>

</body>
</html>

<script type="text/javascript">
function imprimir() {
  window.print();
}

</script>
