
<style>

    td.details-control {
        background: url(<?php echo base_url('/app-assets/images/datatables/resources/details_open.png');?>) no-repeat center center;
        cursor: pointer;
    }
    tr.shown td.details-control {
        background: url(<?php echo base_url('/app-assets/images/datatables/resources/details_close.png');?>) no-repeat center center;
    }
    th { font-size: 14px; }
    td { font-size: 13px; }
</style>

<div class="row match-height">
        <div class="col-md-12">
            <div class="card">
                <!--CARD HEADER-->
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form">Cortes de Caja</h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>



                </div>
                <!--CARD BODY-->
                <div class="card-body collapse in">
                    <div class="card-block">
                        <!--FORM BODY-->
                        <div class="form-body">

                            <div class="row">
                                <div class="form-group col-md-7 col-xs-12">
                                    <div class="form-group">
                                        <label for="cbCuentas">Cuentas</label>
                                        <select name="cbCuentas" id="cbCuentas" class="form-control" onchange="ConsultarCortesPorCuenta()" >
                                            <option value="">Cuentas</option>

                                        </select>
                                    </div>
                               </div>
                            </div>
                            <div class="row">
                              <div class="form-group col-md-7 col-xs-12">
                                <button type="button" class="btn btn-secondary" id="btnTodos"onclick="ConsultarCortes(1)">
                                    <i class="icon-spinner11"></i> Todos
                                </button>
                                  <button type="button" class="btn btn-secondary" id="btnHoy"onclick="ConsultarCortes(2)">
                                      <i class="icon-calendar3"></i> Hoy
                                  </button>
                                  <button type="button" class="btn btn-secondary" id="btnMes" onclick="ConsultarCortes(3)">
                                      <i class="icon-close-round"></i> Mes
                                  </button>

                              </div>

                            </div>
                            <table id="tblCortesCaja" class="table table-striped table-bordered table-responsive" style="width:100%">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th></th>
                                        <th>#</th>
                                        <th>Cuenta</th>
                                        <th>Fecha</th>
                                        <th>Turno</th>
                                        <th>Balance Corte</th>
                                        <th>Total Efectivo </th>
                                        <th>Total T.C.</th>
                                        <th>Total Transferencias</th>
                                        <th>Total Entregado</th>
                                        <th>Diferencia</th>


                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>

                            </table>

                            <!--MODAL REGISTRAR INCIDENCIAS-->
                            <?php echo form_open('CatalogoProductos_Controller/GuardarProducto'); ?>
                            <div class="modal fade" tabindex="-1" role="dialog" id="modalEditarProducto" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="Modal_Title">Editar Producto
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </h4>


                                    </div>
                                    <div class="modal-body">


                                    </div> <!--DIV MODAL BODY-->
                                    <div class="modal-footer">

                                    <button type="button" class="btn btn-warning mr-1" data-dismiss="modal">
                                            <i class="icon-cross2"></i>Cerrar
                                        </button>

                                        <button type="submit" class="btn btn-success mr-1" name="action" value="GuardarProducto" >
                                            <i class="icon-edit"></i>Guardar
                                        </button>

                                </div>
                                    </div>
                                </div>
                            </div>
                            </form><!--FORM MODAL-->
                        </div>

                    </div>
                </div>
            </div><!--DIV CARD-->
        </div><!--DIV COL-MD-->
</div><!--DIV ROW MATCH-->

<script type="text/javascript">
$(document).ready(function() {
  CargarCuentas();

  $('#tblCortesCaja tbody').on('click', 'td.details-control', function () {
      var tr = $(this).closest('tr');
      var t = $("#tblCortesCaja").DataTable();
      var row = t.row( tr );

      if ( row.child.isShown() ) {
          // This row is already open - close it
          row.child.hide();
          tr.removeClass('shown');
      }
      else {
          // Open this row
          row.child( LoadRowDetail(row.data()) ).show();
          tr.addClass('shown');
      }
  } );

});
function CargarCuentas()
{
  $.ajax({
      url: "<?php echo site_url();?>/CargaCatalogos_Controller/CargarCuentas_ajax",
      method: "POST",
      success: function(data)
          {
               $('#cbCuentas').html(data);
          }
  });

}

function ConsultarCortesPorCuenta() {

  var IdCuenta = $("#cbCuentas").val();



  var t = $('#tblCortesCaja').DataTable({
      "ajax":{
          url:"<?php echo site_url();?>/CorteCaja_Controller/ConsultarCortesCaja_ajax",
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
        "columnDefs":[
          {
            "targets": 10, "data": "TotalEntregado", "render":function(data,type,row,meta)
            {
              return data-row['TotalEnEfectivo'];
              // return parseFloat(row['TotalEnEfectivo'])-parseFloat(data);
            }
          }


        ],
        "columns": [
              {
                  "className":      'details-control',
                  "orderable":      false,
                  "data":           null,
                  "defaultContent": ''
              },
              { "data": "IdCorteCaja"},
              { "data": "DescripcionCuenta" },
              { "data": "FechaCorte" },
              { "data": "DescripcionTurno" },
              { "data": "TotalCorte" },
              { "data": "TotalEnEfectivo" },
              { "data": "TotalEnTC" },
              { "data": "TotalTransferencias" },
              { "data": "TotalEntregado" }


              ]

      });

}
function LoadRowDetail ( d ) {
    // `d` is the original data object for the row
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+

    '</table>';
}
</script>
