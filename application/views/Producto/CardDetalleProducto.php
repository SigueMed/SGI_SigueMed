<div class="row match-height">
        <div class="col-md-12">
            <div class="card">
                <!--CARD HEADER-->
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form">Información del Producto</h4>
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
                                    <div class="form-group">
                                        <label for="cbServicioProducto">Servicio</label>
                                        <select id="cbServicioProducto" name="cbServicioProducto" class="form-control">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                    <div class="col-md-8">
                                            <div class="form-group">
                                                    <label for="DescripcionProducto">Nombre Producto</label>
                                                    <input type="text" name="DescripcionProducto" id="DescripcionProducto" class="form-control" placeholder="Descripción Producto"/>
                                            </div>
                                    </div>

                            </div>
                            <div class="row">
                              <div class="col-md-4">
                                      <div class="form-group">
                                              <label for="CostoProducto">Precio Publico</label>
                                              <div class="input-group">
                                              <span class="input-group-addon">$</span>
                                              <input type="text" id="CostoProducto" class="form-control square" placeholder="Costo" aria-label="Costo" name="CostoProducto">

                                      </div>
                                      </div>
                              </div>
                              <div class="col-md-4">
                                      <div class="form-group">
                                              <label for="PrecioProveedor">Precio Proveedor</label>
                                              <div class="input-group">
                                              <span class="input-group-addon">$</span>
                                              <input type="text" id="PrecioProveedor" class="form-control square" placeholder="Costo" aria-label="Costo" name="PrecioProveedor" disabled>

                                      </div>
                                      </div>
                              </div>

                            </div>
                            <div class="row">
                              <div class="col-md-4">
                                      <div class="form-group">
                                              <label for="PrecioClinica">Precio Clinica</label>
                                              <div class="input-group">
                                              <span class="input-group-addon">$</span>
                                              <input type="text" id="PrecioClinica" class="form-control square" placeholder="Costo" aria-label="Costo" name="PrecioClinica" disabled>
                                              <input type="hidden" id ="IdCuentaMaestra" name="IdCuentaMaestra">

                                      </div>
                                      </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                    <label for="txtCuentaMaestra">Cuenta:</label>
                                    <input type="text" class="form-control" name="txtCuentaMaestra" id="txtCuentaMaestra" value="" disabled>
                                    <input type="hidden" id="PorcentajeCuentaMaestra" name="PorcentajeCuentaMaestra" value="">
                                </div>

                              </div>

                            </div>
                            <div class='row'>
                                <div class='col-md-4 col-xs-4'>
                                    <div class='form-group'>
                                        <label>Monto Por Asignar</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">$</span>
                                            <input type="text" id="MontoPorAsignar" class="form-control square" placeholder="%" aria-label="Porcentaje" name="MontoPorAsignar" value="0" readonly>

                                        </div>

                                    </div>


                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cbCuentaProducto">Cuenta</label>
                                        <select id="cbCuentaProducto" name="cbCuentaProducto" class="form-control">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="PorcentajeCuentaProducto">Monto</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">$</span>
                                            <input type="text" id="MontoAsignado" class="form-control square" aria-label="Porcentaje" name="MontoAsignado">

                                        </div>
                                    </div>
                                </div>
                                <div class='col-md-2 col-xs-2'>
                                    <div class='form-group'>
                                        <label><br> </label>
                                        <button class='form-control' type="button" class="btn btn-secondary" id="btnAgregarCuentaProd">
                                            <i class="icon-plus-square"></i>Agregar
                                        </button>

                                    </div>


                                </div>

                            </div>

                              <div class="row">

                                  <table class="table table-responsive table-striped" id="tblCuentasProducto" style="width:100%">
                                      <thead>
                                          <tr>
                                              <th>#</th>
                                              <th>Cuenta</th>
                                              <th>$</th>
                                              <th>Eliminar</th>
                                          </tr>

                                      </thead>
                                      <tbody>

                                      </tbody>

                                  </table>
                              </div>



                        </div>
                        <!-- FORM ACTIONS-->
                        <div class="form-actions">
                            <?php
                                if($ProductoActionsEnabled == true)
                                {
                                    echo '<button type="submit" class="btn btn-warning mr-1" name="action" value="cerrar">';
                                    echo '<i class="icon-cross2"></i> Cerrar';
                                    echo '</button>';
                                    if($ProductoCancelActionEnabled==true)
                                    {
                                        echo '<button type="submit" class="btn btn-danger mr-1" name="action" value="'.$ProductoCancelAction.'">';
                                        echo '<i class="icon-cross2"></i>'.$ProductoCancelTitle;
                                        echo '</button>';

                                    }

                                    echo '<button type="submit" class="btn btn-success" name="action" value='.$ProductoSubmitAction.'>';
                                    echo '<i class="icon-check2"></i>'.$ProductoSubmitTitle;
                                    echo '</button>';
                                }
                            ?>
                            <?php
                                if($CuentasProductoActionsEnabled == true)
                                {
                                    echo '<button type="submit" class="btn btn-warning mr-1" name="action" value="cerrar">';
                                    echo '<i class="icon-cross2"></i> Cerrar';
                                    echo '</button>';
                                    if($CuentasProductoCancelActionEnabled==true)
                                    {
                                        echo '<button type="submit" class="btn btn-danger mr-1" name="action" value="'.$CuentasProductoCancelAction.'">';
                                        echo '<i class="icon-cross2"></i>'.$CuentasProductoCancelTitle;
                                        echo '</button>';

                                    }

                                    echo '<button type="submit" class="btn btn-success" name="action" value='.$CuentasProductoSubmitAction.'>';
                                    echo '<i class="icon-check2"></i>'.$CuentasProductoSubmitTitle;
                                    echo '</button>';
                                }
                            ?>


                        </div>
                    </div>
                </div>
            </div><!--DIV CARD-->
        </div><!--DIV COL-MD-->
</div><!--DIV ROW MATCH-->

<script type="text/javascript">
    $(document).ready(function(){
       CargarServicios();
       CargarCuentas();
       CargarValores();

       $("#CostoProducto").change(function(){
         var EsProveedor = $("#cbServicioProducto").find(":selected").data('proveedor');

         if (EsProveedor)
         {

           $("#PrecioClinica").val($("#CostoProducto").val());
         }

         var PrecioPublico = isNaN(parseFloat($("#CostoProducto").val()))?0:parseFloat($("#CostoProducto").val());
         var PrecioClinica = isNaN(parseFloat($("#PrecioClinica").val()))?0:parseFloat($("#PrecioClinica").val());
         var MontoAsignar = PrecioPublico-PrecioClinica;
         var PorcentajeCuentaMaestra = PrecioClinica / PrecioPublico;


         $("#MontoPorAsignar").val(MontoAsignar);
         $("#PorcentajeCuentaMaestra").val(PorcentajeCuentaMaestra);
         


       });

       $("#PrecioClinica").change(function(){
         var PrecioPublico = isNaN(parseFloat($("#CostoProducto").val()))?0:parseFloat($("#CostoProducto").val());
         var PrecioClinica = isNaN(parseFloat($("#PrecioClinica").val()))?0:parseFloat($("#PrecioClinica").val());
         var MontoAsignar = PrecioPublico-PrecioClinica;
         var PorcentajeCuentaMaestra = PrecioClinica / PrecioPublico;


         $("#MontoPorAsignar").val(MontoAsignar);
         $("#PorcentajeCuentaMaestra").val(PorcentajeCuentaMaestra);
         alert($("#PorcentajeCuentaMaestra").val());

       });

       $('#cbServicioProducto').change(function(){
         var EsProveedor = $(this).find(":selected").data('proveedor');

         $("#PrecioProveedor").val(0);
         $("#PrecioClinica").val(0);
         $("#CostoProducto").val(0);
         $("#MontoPorAsignar").val(0);
         if (EsProveedor)
         {

           $("#PrecioProveedor").removeAttr('disabled');


           $("#txtCuentaMaestra").val("");
           $("#PrecioClinica").attr('disabled', 'disabled');

         }
         else {


           $("#PrecioClinica").removeAttr('disabled');
           CargarCuentaMaestra();
           $("#PrecioProveedor").attr('disabled', 'disabled');
         }
       });

       $('#btnAgregarCuentaProd').click(function(){



           var IdCuenta = $("#cbCuentaProducto").val();
           var DescripcionCuenta = $("#cbCuentaProducto option:selected").html();
           var TotalFilas = $('#tblCuentasProducto tbody tr').length;
           var numFila = 0;

           if(TotalFilas <1)
           {
               numFila = 1;
           }
           else

           {
               numFila = parseInt(document.getElementById('tblCuentasProducto').rows[TotalFilas].cells[0].innerHTML);
               numFila +=1;
           }
           var CostoProducto = isNaN(parseFloat($("#CostoProducto").val()))?0:parseFloat($("#CostoProducto").val());
           var MontoAsignar =  parseFloat($("#MontoPorAsignar").val());
           var MontoAsignado = parseFloat($("#MontoAsignado").val());
           var ProcentajeAsignado = MontoAsignado / CostoProducto;

          if (MontoAsignar>=MontoAsignado)
           {

               $('#tblCuentasProducto').append(
                   '<tr id="row'+numFila+'">'+
                   '<td>'+numFila+'</td>'+
                   '<td><input type="hidden" name="IdCuentaProducto[]" value="'+IdCuenta+'"><input type="hidden" name="PorcentajeProducto[]" value="'+ProcentajeAsignado+'">'+DescripcionCuenta+'</td>'+
                   '<td>'+MontoAsignado+'</td>'+

                   '<td data-row="row'+numFila+'"><a classs = "btn" onclick="BorrarCuentaProducto('+numFila+')" data-row="row'+numFila+'"><i class="icon-trash" data-toggle="tooltip" data-placement="top" id="EliminarCuenta" title="Eliminar cuenta"> Eliminar</i></a></td>'+
                   '</tr>'
                   );

           MontoAsignado -= MontoAsignado;

           $("#MontoPorAsignar").val(MontoAsignado);

           }
           else
           {
               alert('No puede asignar un monto mayor al Disponible por Asignar');
           }

       });

    });

    function CargarValores()
    {
        var DatosProducto = <?= json_encode($InformacionProducto)?>;
        if (DatosProducto !== null)
        {
            $('#cbServicioProducto').val(DatosProducto['IdServicio']);
            $("#DescripcionProducto").val(DatosProducto['DescripcionProducto']);
            $("#CostoProducto").val(DatosProducto['CostoProducto']);
            $("#PrecioProveedor").val(DatosProducto['PrecioProveedor']);
        }
        else
        {
            $("#DescripcionProducto").val();
            $("#CostoProducto").val();
        }


    }

    function CargarServicios()
    {
         $.ajax({
                  url:"<?php echo site_url();?>/CatalogoProductos_Controller/ConsultarServicios_ajax",
                  method:"POST",

                  success: function(data)
                    {
                        $('#cbServicioProducto').html(data);

                         var DatosProducto = <?= json_encode($InformacionProducto)?>;
                        if (DatosProducto !== null)
                        {
                            $('#cbServicioProducto').val(DatosProducto['IdServicio']);
                            $('#cbServicioProducto').prop('disabled','disabled');
                        }

                    }
              });
    }
    function CargarCuentaMaestra() {
      $.ajax({
               url:"<?php echo site_url();?>/Cuenta_Controller/ConsultarCuentaMaestra",
               method:"POST",

               success: function(data)
                 {
                   var CuentaMaestra = JSON.parse(data);

                     $('#txtCuentaMaestra').val(CuentaMaestra['DescripcionCuenta']);
                     $("#IdCuentaMaestra").val(CuentaMaestra['IdCuenta']);


                 }
           });


    }

    function BorrarCuentaProducto(index)
    {

        var Row = document.getElementById('row'+index);
        var Cell = Row.getElementsByTagName('td');

            document.getElementById("tblCuentasProducto").deleteRow(Row.rowIndex);



            var PorcentajeCuentaBorrado = parseFloat(Cell[2].innerText);



            var PorcentajeAsignado=0;

            if($("#PorcentajeAsignado").val()!=="")
            {
                PorcentajeAsignado = parseFloat($("#PorcentajeAsignado").val());
            }



            PorcentajeAsignado -= PorcentajeCuentaBorrado;



            $("#PorcentajeAsignado").val(PorcentajeAsignado);
    }

    function CargarCuentas()
    {
        $.ajax({
                  url:"<?php echo site_url();?>/CatalogoProductos_Controller/ConsultarCuentas_ajax",
                  method:"POST",

                  success: function(data)
                    {
                        $('#cbCuentaProducto').html(data);

                    }
              });

    }
</script>
