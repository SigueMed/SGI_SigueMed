<div class="row match-height">
    <div class="col-md-12">
        <div class="card">
            <!--CARD HEADER-->
            <div class="card-header">
                <h4 class="card-title" id="basic-layout-form"><i class="icon-inbox"></i>Corte de Caja - <?=$Cuenta->DescripcionCuenta?></h4>
                <input type="hidden" name="IdCuenta" id="IdCuenta" value="<?=$IdCuenta?>">
                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                <div class="heading-elements">
                        <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                                <li><a data-action="reload"><i class="icon-reload"></i></a></li>
                                <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                                <li><a data-action="close"><i class="icon-cross2"></i></a></li>
                        </ul>
                </div>


            </div>
            <!--CARD BODY-->
            <div class="card-body collapse in">
                <div class="card-block">
                    <!--FORM BODY-->
                    <div class="form-body">

                        <div class="row">
                            <div class="col-md-6">

                                <!--TABLA MOVIMIENTOS CUENTA-->
                                <div class="table-responsive table-striped table table-bordered">
                                    <table class="table" id="tblBalanceCuentas">
                                        <thead class="thead-inverse">
                                            <tr>
                                                <th>Cuenta</th>
                                                <th>Total Entradas</th>
                                                <th>Total Salidas</th>
                                                <th>Balance Cuenta</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                             <div class="col-md-6">

                                <!--TABLA MOVIMIENTOS CUENTA-->
                                <div class="table-responsive table-striped table table-bordered">
                                    <table class="table" id="tblResumenTipoPago">
                                        <thead class="thead-inverse">
                                            <tr>
                                                <th>Forma de Pago</th>
                                                <th>Total Pagos</th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="FechaCorte">Fecha y Hora:</label>
                                    <div class="position-relative has-icon-left">
                                        <input type="datetime-local" id="FechaCorte" class="form-control" name="FechaCorte" value="<?php echo mdate('%Y-%m-%dT%H:%i:%s',now());?>" readonly/>
                                        <div class="form-control-position">
                                                <i class="icon-calendar5"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="turno">Turno:</label>
                                    <div class="position-relative has-icon-left">
                                        <input type="text" id="turno" class="form-control"  name="turno" value="<?php echo $this->session->userdata('Turno');?>" readonly>
                                        <div class="form-control-position">
                                                <i class="icon-clock5"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="EmpleadoCorte">Responsable Corte:</label>
                                    <div class="position-relative has-icon-left">
                                        <input type="text" id="EmpleadoCorte" class="form-control"  name="EmpleadoCorte" value="<?php echo $this->session->userdata('NombreUsuario');?>" readonly>
                                        <div class="form-control-position">
                                                <i class="icon-user"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <h4 class="form-section"><i class="icon-clipboard4"></i> Balance Corte</h4>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="TotalEntradas">Total Entradas:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">$</span>
                                        <input type="text" id="TotalEntradas" name="TotalEntradas" class="form-control" readonly />
                                     </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="TotalSalidas">Total Salidas:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">$</span>
                                        <input type="text" id="TotalSalidas" name="TotalSalidas" class="form-control" placeholder="Total Salidas" readonly />
                                     </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="TotalCorte">Balance Corte:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">$</span>
                                        <input type="text" id="BalanceCorte" name="BalanceCorte" class="form-control" placeholder="Total Balance" readonly />
                                     </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="TotalEntregado">Total Entregado:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    <input type="text" id="TotalEntregado" name="TotalEntregado" class="form-control" readonly value="<?=$MontoEnCaja?>" />
                                 </div>

                              </div>

                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="TotalCorteEfectivo">Total en Efectivo:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">$</span>
                                        <input type="text" id="TotalCorteEfectivo" name="TotalCorteEfectivo" class="form-control" readonly />
                                        <input type="hidden" id="val_TotalCorteEfectivo" name="val_TotalCorteEfectivo"/>
                                     </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="TotalTarjetaCredito">Total Tarjeta de Crédito:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">$</span>
                                        <input type="text" id="TotalTarjetaCredito" name="TotalTarjetaCredito" class="form-control" placeholder="Total T.C." readonly />
                                     </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="TotalTransferencias">Total Transferencias:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">$</span>
                                        <input type="text" id="TotalTransferencias" name="TotalTransferencias" class="form-control" placeholder="Total Transferencias" readonly />
                                     </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="TotalEntregado">Diferencia:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    <input type="text" id="TotalDiferencia" name="TotalDiferencia" class="form-control" readonly value="<?=$MontoEnCaja?>" />
                                 </div>

                              </div>

                            </div>


                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="ComentariosCorte">Comentarios:</label>
                                    <div class="position-relative has-icon-left">
                                        <input type="text" id="ComentariosCorte" class="form-control" placeholder="Comentarios..." name="ComentariosCorte">
                                        <div class="form-control-position">
                                        <i class="icon-chatbox-working"></i>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>




                    <div class="form-actions" align="center">
                        <button type="submit" class="btn btn-warning mr-1" name="action" value="cerrar">
                        <i class="icon-cross2"></i> Cerrar
                        </button>
                         <button type="submit" class="btn btn-success mr-1" name="action" value="RegistrarSalida">
                        <i class="icon-check2"></i> Pagar
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        CargarBalanceCorteCaja();
        CargarBalanceCuentas();
        CargarResumenTipoPago();
        CargarRangoNotas();
    });
    function CargarBalanceCorteCaja()
    {
        $.ajax({
            url:"<?php echo site_url();?>/CorteCaja_Controller/ConsultarBalanceCortePorTipoPago",
            data:{
                IdTipoPago:1,
                IdCuenta: <?=$IdCuenta?>
            },

            method:"POST",
            success: function(data)
              {

                  var BalanceEfectivo = JSON.parse(data);
                  var TotalEntregado = <?=$MontoEnCaja?>;
                  var DiferenciaCajaCorte = TotalEntregado - BalanceEfectivo;

                  $('#TotalCorteEfectivo').val(BalanceEfectivo);
                  $('#TotalDiferencia').val(DiferenciaCajaCorte);
                  $('#val_TotalCorteEfectivo').val(BalanceEfectivo);


              }
          });
          $.ajax({
            url:"<?php echo site_url();?>/CorteCaja_Controller/ConsultarBalanceCortePorTipoPago",
            data:{
                IdTipoPago:2,
                IdCuenta: <?=$IdCuenta?>
            },

            method:"POST",
            success: function(data)
              {

                  var BalanceCaja = JSON.parse(data);

                  $('#TotalTarjetaCredito').val(BalanceCaja);

              }
          });
          $.ajax({
            url:"<?php echo site_url();?>/CorteCaja_Controller/ConsultarBalanceCortePorTipoPago",
            data:{
                IdTipoPago:3,
                IdCuenta: <?=$IdCuenta?>
            },

            method:"POST",
            success: function(data)
              {

                  var BalanceCaja = JSON.parse(data);

                  $('#TotalTransferencias').val(BalanceCaja);

              }
          });
    }

    function CargarBalanceCuentas()
    {
        $.ajax({
            url:"<?php echo site_url();?>/CorteCaja_Controller/ConsultarBalanceCorteCuentas",
            data:{
              IdCuenta: <?=$IdCuenta?>
            },

            method:"POST",
            success: function(data)
              {

                  var BalanceCuenta = JSON.parse(data);

                  $("#tblBalanceCuentas tbody tr").remove();
                  var TotalEntradas= 0;
                  var TotalSalidas = 0;

                  for (i=0; i<BalanceCuenta.length;i++)
                  {

                      TotalEntradas += parseFloat(BalanceCuenta[i]['TotalEntradas']);
                      TotalSalidas += parseFloat(BalanceCuenta[i]['TotalSalidas']);

                      $('#tblBalanceCuentas').append(
                          '<tr>'+
                          '<td>'+BalanceCuenta[i]['DescripcionCuenta']+'</td>'+
                          '<td>'+BalanceCuenta[i]['TotalEntradas']+'</td>'+
                          '<td>'+BalanceCuenta[i]['TotalSalidas']+'</td>'+
                          '<td>$'+BalanceCuenta[i]['Balance']+'</td>'+
                          '</tr>'
                      );
                  }

                  $("#TotalEntradas").val(TotalEntradas);
                  $("#TotalSalidas").val(TotalSalidas);
                  var Balance = TotalEntradas - TotalSalidas;
                  $("#BalanceCorte").val(Balance);


              }
          });
    }

    function CargarResumenTipoPago()
    {
        $.ajax({
            url:"<?php echo site_url();?>/CorteCaja_Controller/ConsultarResumenEntradas",
            data:{
              IdCuenta : <?=$IdCuenta?>
            },

            method:"POST",
            success: function(data)
              {

                  var ResumenTipoPago = JSON.parse(data);

                  $("#tblResumenTipoPago tbody tr").remove();

                  for (i=0; i<ResumenTipoPago.length;i++)
                  {

                      $('#tblResumenTipoPago').append(
                          '<tr>'+
                          '<td>'+ResumenTipoPago[i]['DescripcionTipoPago']+'</td>'+
                          '<td>$'+ResumenTipoPago[i]['TotalTipoPago']+'</td>'+
                          '</tr>'
                      );
                  }


              }
          });
    }

    function CalcularEfectivo()
    {

        var Efectivo = parseFloat($("#val_TotalCorteEfectivo").val());
        var Vales = 0;
        if ($("#TotalVales").val()!=="")
        {
            Vales = parseFloat($("#TotalVales").val());
        }


        Efectivo = Efectivo - Vales;
        $("#TotalCorteEfectivo").val(Efectivo);

    }


</script>
