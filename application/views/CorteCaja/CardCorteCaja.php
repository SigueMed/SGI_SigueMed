<div class="row match-height">
    <div class="col-md-12">
        <div class="card">
            <!--CARD HEADER-->
            <div class="card-header">
                <h4 class="card-title" id="basic-layout-form"><i class="icon-inbox"></i>Corte de Caja - <?=$Clinica->NombreClinica?></h4>
                <input type="hidden" name="IdCuenta" id="IdCuenta">
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
                            <div class="col-md-8">

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

                        </div>
                        <div class="row">
                          <div class="col-md-12">

                             <!--TABLA MOVIMIENTOS CUENTA-->
                             <div class="table-responsive table-striped table table-bordered">
                                 <table class="table" id="tblResumenTipoPago">
                                     <thead class="thead-inverse">
                                         <tr>
                                             <th>Forma de Pago</th>
                                             <th>Total Entradas</th>
                                             <th>Total Salidas</th>
                                             <th>Balance</th>
                                             <th>Total Entregado</th>
                                             <th>Diferencia</th>
                                           </tr>
                                     </thead>
                                     <tbody>
                                     </tbody>
                                 </table>
                             </div>

                         </div>
                       </div>

                       <div class="row">
                         <div class="col-md-2">
                           <div class="form-group">
                             <label for="TotalEntradas">Total Entradas</label>
                             <div class="input-group">
                               <span class="input-group-addon">$</span>
                               <input type="text" id="txtTotalEntradas" name="txtTotalEntradas"  value ="0" class="form-control"/>
                               <input type="hidden" id="TotalEntradas" name="TotalEntradas"  value ="0" class="form-control"/>
                             </div>

                           </div>


                         </div>
                         <div class="col-md-2">
                           <div class="form-group">
                             <label for="TotalSalidas">Total Salidas</label>
                             <div class="input-group">
                               <span class="input-group-addon">$</span>
                               <input type="text" id="txtTotalSalidas" name="txtTotalSalidas"  value ="0" class="form-control"/>
                               <input type="hidden" id="TotalSalidas" name="TotalSalidas"  value ="0" class="form-control"/>
                             </div>

                           </div>


                         </div>
                         <div class="col-md-2">
                           <div class="form-group">
                             <label for="BalanceCorte">Balance Corte</label>
                             <div class="input-group">
                               <span class="input-group-addon">$</span>
                               <input type="text" id="txtBalanceCorte" name="txtBalanceCorte"  value ="0" class="form-control"/>
                               <input type="hidden" id="BalanceCorte" name="BalanceCorte"  value ="0" class="form-control"/>
                             </div>

                           </div>


                         </div>
                         <div class="col-md-2">
                           <div class="form-group">
                             <label for="TotalEntregado">Total Entregado</label>
                             <div class="input-group">
                               <span class="input-group-addon">$</span>
                               <input type="text" id="txtTotalEntregado" name="txtTotalEntregado"  value ="0" class="form-control"/>
                               <input type="hidden" id="TotalEntregado" name="TotalEntregado"  value ="0" class="form-control"/>
                             </div>

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

<!--MODALS-->
<!--MODAL BUSCAR PRODUCTO-->
<div class="modal fade" id="Modal_DetalleEntradasCorte" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h5 class="modal-title">Detalle Entradas corte</h5>

        </div>
        <div class="modal-body">
          <h6 class="form-section">Entradas</h6>
          <table id="tbl_DetalleEntradasCorte" class="table table-striped table-bordered table-responsive" style="width:100%">
              <thead>

                  <tr>
                      <th>No. Nota</th>
                      <th>Fecha</th>
                      <th>Paciente</th>
                      <th>Total Nota</th>
                      <th>Total Pagado</th>
                      <th>Estatus</th>


                  </tr>
              </thead>
              <tbody>


              </tbody>

          </table>



        </div>
        <!-- FORM ACTIONS-->
        <div class="modal-footer">
            <button type="button" class="btn btn-warning mr-1" data-dismiss="modal">
                <i class="icon-cross2"></i>Cerrar
            </button>

        </div>

      </div>
    </div>
</div><!--MODAL BUSCAR PRODUCTO-->




<script type="text/javascript">
    $(document).ready(function(){

        CargarBalanceCuentas();
        CargarResumenTipoPago();
        //CargarDetalleNotasCorte();
        //CargarDetalleMovimientosCorte();


    });


    function CargarBalanceCuentas()
    {

        $.ajax({
            url:"<?php echo site_url();?>/CorteCaja_Controller/ConsultarBalanceCorteCuentas",
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
                      Entrada = new Intl.NumberFormat("en-US", {style: "currency", currency: "USD"}).format(parseFloat(BalanceCuenta[i]['TotalEntradas']));
                      Salida = new Intl.NumberFormat("en-US", {style: "currency", currency: "USD"}).format(parseFloat(BalanceCuenta[i]['TotalSalidas']));
                      BalanceES = new Intl.NumberFormat("en-US", {style: "currency", currency: "USD"}).format(parseFloat(BalanceCuenta[i]['Balance']));


                      $('#tblBalanceCuentas').append(
                          '<tr>'+
                          '<td> '+BalanceCuenta[i]['DescripcionCuenta']+'</td>'+
                          '<td> <a id="linkEditar" href="#" onclick="OpenModal_DetalleEntradasCorte('+BalanceCuenta[i]['IdCuenta']+')">'+Entrada+'</a></td>'+
                          '<td>'+Salida+'</td>'+
                          '<td>'+BalanceES+'</td>'+
                          '</tr>'
                      );
                  }

                  $("#TotalEntradas").val(TotalEntradas);
                  $("#TotalSalidas").val(TotalSalidas);
                  $("#txtTotalEntradas").val(new Intl.NumberFormat("en-US", {style: "currency", currency: "USD"}).format(TotalEntradas));
                  $("#txtTotalSalidas").val(new Intl.NumberFormat("en-US", {style: "currency", currency: "USD"}).format(TotalSalidas));
                  var Balance = TotalEntradas - TotalSalidas;
                  $("#txtBalanceCorte").val(new Intl.NumberFormat("en-US", {style: "currency", currency: "USD"}).format(Balance));
                  $("#BalanceCorte").val(Balance);



              }
          });
    }

    function CargarResumenTipoPago()
    {
        $.ajax({
            url:"<?php echo site_url();?>/CorteCaja_Controller/ConsultarBalanceCorteTipoPago",


            method:"POST",
            success: function(data)
              {

                  var ResumenTipoPago = JSON.parse(data);
                  var MontosPago = <?=json_encode($MontosTipoPago)?>;
                  var ResumenTotalCorte = 0;
                  var TotalEntradas = 0;
                  var TotalSalidas = 0;
                  var Balance = 0;
                  var TotalEntregado =0;

                  $("#tblResumenTipoPago tbody tr").remove();

                  for (i=0; i<ResumenTipoPago.length;i++)
                  {

                    var ValorPago = MontosPago.find(o=>o.IdTipoPago===ResumenTipoPago[i]['IdTipoPago']);

                    TotalEntradas = new Intl.NumberFormat("en-US", {style: "currency", currency: "USD"}).format(parseFloat(ResumenTipoPago[i]['TotalEntradas']));
                    TotalSalidas = new Intl.NumberFormat("en-US", {style: "currency", currency: "USD"}).format(parseFloat(ResumenTipoPago[i]['TotalSalidas']));
                    Balance = parseFloat(ResumenTipoPago[i]['TotalEntradas'])-parseFloat(ResumenTipoPago[i]['TotalSalidas']);
                    TotalEntregado=new Intl.NumberFormat("en-US", {style: "currency", currency: "USD"}).format(ValorPago['Monto']);

                    ResumenTotalCorte += parseFloat(ValorPago['Monto']);


                    var Diferencia = parseFloat(ValorPago['Monto'])-Balance;



                      $('#tblResumenTipoPago').append(
                          '<tr>'+
                          '<td>'+ResumenTipoPago[i]['DescripcionTipoPago']+'</td>'+
                          '<td>'+TotalEntradas+'</td>'+
                          '<td>'+TotalSalidas+'</td>'+
                          '<td>'+new Intl.NumberFormat("en-US", {style: "currency", currency: "USD"}).format(Balance)+'</td>'+
                          '<td>'+TotalEntregado+'</td>'+
                          '<td>'+
                            '<input type="hidden" name="IdTiposPago[]" value="'+ResumenTipoPago[i]['IdTipoPago']+'">'+
                            '<input type="hidden" name="TotalesCorte[]" value="'+Balance+'">'+
                            '<input type="hidden" name="TotalesEntregado[]" value="'+ValorPago['Monto']+'">'+
                          ''+new Intl.NumberFormat("en-US", {style: "currency", currency: "USD"}).format(Diferencia)+'</td>'+
                          '</tr>'
                      );
                  }

                  $("#txtTotalEntregado").val(new Intl.NumberFormat("en-US", {style: "currency", currency: "USD"}).format(ResumenTotalCorte));
                  $("#TotalEntregado").val(ResumenTotalCorte);


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
function CargarDetalleNotasCorte(IdCuenta) {



  var t = $('#tbl_DetalleEntradasCorte').DataTable({
    "drawCallback": function( settings ) {
            $('[data-toggle="tooltip"]').tooltip();
          },
      "ajax":{
          url:"<?php echo site_url();?>/CorteCaja_Controller/ConsultarDetalleNotasCorteCuenta_ajax",
          data:{IdCuenta:IdCuenta},
          method:"POST",
          dataSrc: ""
      },

       "destroy":true,
       "language": {
            "lengthMenu": "Mostrando _MENU_ registros por pag.",
            "zeroRecords": "Sin Datos - disculpa",
            "info": "Motrando pag. _PAGE_ de _PAGES_",
            "infoEmpty": "Sin registros disponibles",
            "infoFiltered": "(filtrado de _MAX_ total)"
        },
        "autoWidth":true,

        "columns": [

              { "data": "IdNotaRemision"},
              { "data": "FechaNotaRemision" },
              { "data": "Paciente" },
              { "data": "TotalNotaRemision" },
              { "data": "TotalPagado" },

              { "data": "DescripcionEstatusNotaRemision" }



              ]

      });


}

function CargarDetalleMovimientosCorte() {
  var IdCuenta = $("#IdCuenta").val();

  var t = $('#tblDetalleMovimientosCuentaCorte').DataTable({
    "drawCallback": function( settings ) {
            $('[data-toggle="tooltip"]').tooltip();
          },
      "ajax":{
          url:"<?php echo site_url();?>/CorteCaja_Controller/ConsultarDetalleMovimientosCuentaSinCorte_ajax",
          data:{IdCuenta: IdCuenta},
          method:"POST",
          dataSrc: ""
      },

       "destroy":true,
       "language": {
            "lengthMenu": "Mostrando _MENU_ registros por pag.",
            "zeroRecords": "Sin Datos - disculpa",
            "info": "Motrando pag. _PAGE_ de _PAGES_",
            "infoEmpty": "Sin registros disponibles",
            "infoFiltered": "(filtrado de _MAX_ total)"
        },
        "autoWidth":true,
        "columnDefs":[
          {
            "targets":0,"data":"IdNotaRemision","render":function(data,type,meta,row)
            {
                return "<a href='<?=site_url()?>/NotaRemision/CargarNotaRemision/"+data+"'' target='_blank'>"+data+"</a>";
            }
          }

        ],
        "columns": [

              { "data": "IdNotaRemision"},
              { "data": "FechaNotaRemision" },
              { "data": "Paciente" },
              { "data": "DescripcionTipoMovimientoCuenta" },
              { "data": "DescripcionCuenta" },
              { "data": "TotalMovimiento" },

              { "data": "DescripcionTipoPago" }





              ]

      });


}

//MODALS

function OpenModal_DetalleEntradasCorte(IdCuenta) {


  CargarDetalleNotasCorte(IdCuenta);
  $("#Modal_DetalleEntradasCorte").modal('show');

}



</script>
