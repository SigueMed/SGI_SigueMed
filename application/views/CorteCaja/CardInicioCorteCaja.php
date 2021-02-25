<form>
<div class="row match-height">
    <div class="col-md-7">
        <div class="card">
            <!--CARD HEADER-->
            <div class="card-header">
                <h4 class="card-title" id="basic-layout-form"><i class="icon-inbox"></i>Ingresar Monto Corte</h4>
                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                <div class="heading-elements">
                        <!-- <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                                <li><a data-action="reload"><i class="icon-reload"></i></a></li>
                                <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                                <li><a data-action="close"><i class="icon-cross2"></i></a></li>
                        </ul> -->
                </div>


            </div>
            <!--CARD BODY-->
            <div class="card-body collapse in">
                <div class="card-block">
                    <!--FORM BODY-->
                    <div class="form-body">
                      <!--QUITAR LA CUENTA PARA REALIZAR EL CORTE
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="cbCuentas">Cuenta:</label>
                            <select name="cbCuentas" id="cbCuentas" class="form-control">

                            </select>

                          </div>

                        </div>
                      </div> -->

                    <h4 class="form-section"><i class="icon-calculator"></i> Total</h4>
                    <div class="row">

                      <div class="col-md-6">
                        <table id="tblTotalFormasPago">
                          <thead>
                            <th>Forma Pago</th>
                            <th>Total</th>
                          </thead>
                          <tbody>

                          </tbody>
                        </table>

                      </div>



                    </div>
                  </div>


                    <div class="form-actions" align="right">
                        <button type="submit" class="btn btn-warning mr-1" name="action" value="cerrar">
                        <i class="icon-cross2"></i> Cerrar
                        </button>
                         <button type="submit" class="btn btn-success mr-1" name="action" value="RealizarCorteCaja">
                        <i class="icon-check2"></i> Pagar
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {

  //CargarCuentas();
  CargarTablaFormasPago();


});

function CargarCuentas()
{
  $.ajax({
      url: "<?php echo site_url();?>/CargaCatalogos_Controller/CargarCuentas_ajax",
      data:{
        CuentasCorte:1
      },
      method: "POST",
      success: function(data)
          {
               $('#cbCuentas').html(data);
          }
  });

}

function CargarTablaFormasPago()
{
  $.ajax({
    url: '<?=site_url()?>/CargaCatalogos_Controller/ConsultarTiposPago_ajax',
    type: 'POST',
  })
  .done(function(data) {

    var TiposPago = JSON.parse(data);


      for(i=0;i<TiposPago.length;i++)
      {
        $("#tblTotalFormasPago").append(
          '<tr>'+
            '<td>'+TiposPago[i]['DescripcionTipoPago']+'</td>'+
            '<td>'+
              '<div class="input-group">'+
                '<span class="input-group-addon">$</span>'+
                '<input type="text" id="TipoPago-'+TiposPago[i]['IdTipoPago']+'" name="TipoPago-'+TiposPago[i]['IdTipoPago']+'"  value ="0" class="form-control"/>'+
              '</div>'+
            '</td>'+
          '</tr>'
        );


      }

  })
  .fail(function() {
    console.log("error");
  })
  .always(function() {
    console.log("complete");
  });

}



</script>
