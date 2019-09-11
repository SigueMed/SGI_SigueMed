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
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="cbFoliador">Grupo Servicios:</label>
                            <select name="cbFoliador" id="cbFoliador" class="form-control">

                            </select>

                          </div>

                        </div>
                      </div>
                      <h4 class="form-section"><i class="icon-money"></i> Billetes</h4>
                      <div class="row">
                        <div class="col-md-2">
                          <div class="form-group">
                            <label for="">500</label>
                            <input type="text" name="txt500" value="0" class="form-control monto" data-valor="500">
                          </div>
                        </div>
                        <div class="col-md-2">
                          <div class="form-group">
                            <label for="">200</label>
                            <input type="text" name="txt200" value="0" class="form-control monto" data-valor="200">
                          </div>
                        </div>
                        <div class="col-md-2">
                          <div class="form-group">
                            <label for="">100</label>
                            <input type="text" name="txt100" value="0" class="form-control monto" data-valor="100">
                          </div>
                        </div>
                        <div class="col-md-2">
                          <div class="form-group">
                            <label for="">50</label>
                            <input type="text" name="txt50" value="0" class="form-control monto" data-valor="50">
                          </div>
                        </div>
                        <div class="col-md-2">
                          <div class="form-group">
                            <label for="">20</label>
                            <input type="text" name="txt20" value="0" class="form-control monto" data-valor="20">
                          </div>
                        </div>
                      </div>
                    </div>
                    <h4 class="form-section"><i class="icon-moneypig"></i> Monedas</h4>
                    <div class="row">
                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="">10</label>
                          <input type="text" name="txt10" value="0" class="form-control monto" data-valor="10">
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="">5</label>
                          <input type="text" name="txt5" value="0" class="form-control monto" data-valor="5">
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="">2</label>
                          <input type="text" name="txt2" value="0" class="form-control monto" data-valor="2">
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="">1</label>
                          <input type="text" name="txt1" value="0" class="form-control monto" data-valor="1">
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="">0.50</label>
                          <input type="text" name="txt05" value="0" class="form-control monto" data-valor="0.5">
                        </div>
                      </div>
                    </div>
                    <h4 class="form-section"><i class="icon-calculator"></i> Total</h4>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="">Total en Caja</label>
                          <div class="input-group">
                              <span class="input-group-addon">$</span>
                              <input type="text" id="TotalEntradas" name="TotalEntradas"  value ="0" class="form-control" readonly />
                           </div>
                        </div>

                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <button type="button" class="btn btn-secondary" name="button" onclick="LimpiarPantalla()"><i class="icon-repeat"></i></button>

                        </div>

                      </div>

                    </div>
                  </div>


                    <div class="form-actions" align="right">
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
$(document).ready(function() {

  CargarFoliador();
  $(document).on('change','.monto', function(e){
    e.preventDefault();
    var $this = $(this);
    var data = $this.serialize();
    var monto = parseFloat($this.data('valor'));
    var cantidad = parseFloat($(this).val());
    var total = parseFloat($("#TotalEntradas").val());

    if (!isNaN(cantidad))
    {
      var NuevoTotal = total + (monto*cantidad);

      $("#TotalEntradas").val(NuevoTotal);
    }


  });
});

function CargarFoliador()
{
  $.ajax({
      url: "<?php echo site_url();?>/CargaCatalogos_Controller/CargarFoliador_ajax",
      method: "POST",
      success: function(data)
          {
               $('#cbFoliador').html(data);
          }
  });

}

function LimpiarPantalla() {
  $("input:text.monto").val('0');
  $("#TotalEntradas").val('0');

}

</script>
