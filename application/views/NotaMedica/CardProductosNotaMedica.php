<div class="row match-height">
        <div class="col-md-12">
            <div class="card">
                <!--CARD HEADER-->
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form">Nota Remisión</h4>
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
                            <!--FILA PRODUCTO-->
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="servicio">Servicio</label>
                                        <select name="servicio" id="servicio" class="form-control" >
                                            <option value="">Servicios</option>
                                            <?php foreach ($Servicios as $servicio)
                                            {
                                                echo '<option value ="'.$servicio['IdServicio'].'">'.$servicio['DescripcionServicio'].'</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="producto">Producto</label>
                                        <select name="producto" id="producto" class="form-control"  >
                                            <option value="">Productos</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                         <label for="PrecioUnitario">Precio</label>
                                         <div class="input-group">
                                            <span class="input-group-addon">$</span>
                                           <input type="text" id="PrecioUnitario" name="PrecioUnitario" class="form-control" placeholder="Precio Unitario" readonly/>
                                         </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                         <label for="cantidadProducto">Cantidad</label>
                                         <input type="text" id="cantidadProducto" name="cantidadProducto" class="form-control" placeholder="Cantidad" onchange="CalcularSubtotal()"/>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                         <label for="descuento">Desc.</label>
                                         <div class="input-group">
                                           <input type="text" id="descuento" name="descuento" class="form-control" placeholder="Descuento" onchange="CalcularSubtotal()"/>
                                           <span class="input-group-addon">%</span>
                                         </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                         <label for="total">Total</label>
                                         <div class="input-group">
                                            <span class="input-group-addon">$</span>
                                           <input type="text" id="total" name="total" class="form-control" placeholder="Total" readonly/>
                                         </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div align="right">
                                <button type="button" class="btn btn-blue" id="btnAgregar">
                                    <i class="icon-android-add"></i>Agregar
                                </button>
                            </div>
                            
                            <!--TABLA PRODUCTOS-->
                            <div class="table-responsive">
                                <table class="table" id="tablaProductos">
                                    <thead class="thead-inverse">
                                        <tr>
                                            <th>#</th>
                                            <th>Servicio</th>
                                            <th>Producto</th>
                                            <th>Precio</th>
                                            <th>Cantidad</th>
                                            <th>Descuento</th>
                                            <th>Subtotal</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            
                            
                            
                           <div class="row">
                               <div class="col-md-10">
                                     
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="totalNota">Total Nota</label>
                                        <div class="input-group">
                                           <span class="input-group-addon">$</span>
                                          <input type="text" id="totalNota" name="totalNota" class="form-control" placeholder="Total" readonly/>
                                        </div>
                                    </div>  
                                </div>
                           </div>
                            
                        </div>
                        <!--FORM ACTIONS-->
                        <div class="form-actions">
                            <?php
                                if($ProductosNotaActionsEnabled== true)
                                {
                                    echo '<button type="submit" class="btn btn-warning mr-1" name="action" value="cancelar">';
                                    echo '<i class="icon-cross2"></i> Cancelar';
                                    echo '</button>';
                                    echo '<button type="submit" class="btn btn-primary" name="action" value='.$ProductosNotaSubmitAction.'>';
                                    echo '<i class="icon-check2"></i> Guardar';
                                    echo '</button>';
                                }
                            ?>
                                
                                
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

<script type="text/javascript">
$(document).ready(function()
    {
        //Lista Servicio Evento: Change
        //Carga lista de productos del servicio seleccionado
        $("#servicio").change(function(){
           
          var servicio_id = $('#servicio').val();

          if(servicio_id!='')
          {

              $.ajax({
                  url:"<?php echo site_url();?>/NotaMedica_Controller/ConsultarProductosPorServicio",
                  method:"POST",
                  data:{servicio_id:servicio_id},
                  success: function(data)
                    {
                        $('#producto').html(data);
                    }
              });
              
          }
          
       }); 
        // Lista Productos Evento: Change
        //Carga Información del producto seleccionado
        $('#producto').change(function(){
            var producto_id = $('#producto').val();
            if(producto_id!='')
            {
                $.ajax({
                    url: "<?php echo site_url();?>/NotaMedica_Controller/ConsultarProductoPorId",
                    method: "POST",
                    data:{producto_id:producto_id},
                    success: function(data)
                        {                         
                            var producto_detail = JSON.parse(data);
                            $('#PrecioUnitario').val(producto_detail['CostoProducto']);
                            $('#cantidadProducto').val(1);
                            $("#descuento").val(0);
                            CalcularSubtotal();
                            document.getElementById("cantidadProducto").focus();
                        }
                });
            
            }
        });  
        //Agregar nueva fila a la tabla productos
        $('#btnAgregar').click(function(){
        
 
            
            var idServicio = $("#servicio").val();
            var descServicio = $("#servicio option:selected").html();
  
            var idProducto =  $("#producto").val();
            var descProducto = $("#producto option:selected").html();
            var numFila = $('#tablaProductos tbody tr').length+1;
            var precio = $("#PrecioUnitario").val();
            var cantidad = $("#cantidadProducto").val();
            var descuento = $("#descuento").val();
            var subtotal = $("#total").val();

            
            if(cantidad!=="" && parseInt(cantidad) >0)
            {
                $('#tablaProductos').append(
                    '<tr id=row'+numFila+'>'+
                    '<td>'+numFila+'</td>'+
                    '<td><input type="hidden" value='+idServicio+'>'+descServicio+'</td>'+
                    '<td><input type="hidden" name="IdProducto[]" value='+idProducto+'>'+descProducto+'</td>'+
                    '<td><input class="form-control" name="precio[]" value="'+precio+'" readonly></td>'+
                    '<td><input class="form-control" name="cantidad[]" value="'+cantidad+'"readonly></td>'+
                    '<td><input class="form-control" name="descuento[]" value="'+descuento+'%" readonly></td>'+
                    '<td>'+subtotal+'</td>'+
                    '<td type="button" name="remove" class="btn btn-danger btn-xs remove" data-row="row'+numFila+'"><i class="icon-ios-trash"></i></td>'+
                    '</tr>'
                    );
                var TotalNota=0;
                if($("#totalNota").val()!=="")
                {
                    TotalNota = parseInt($("#totalNota").val());
                }


                TotalNota = TotalNota + parseInt(subtotal);
                $("#totalNota").val(TotalNota);
            }     
        });
        
        //Borrar filas de la tabla productos
        $(document).on('click', '.remove', function(){
            var delete_row = $(this).data("row");
            
            var subtotal = parseInt($("#"+delete_row).find("td")[6].innerHTML);
            $('#' + delete_row).remove();
            
            var TotalNota=0;
            if($("#totalNota").val()!=="")
            {
                TotalNota = parseInt($("#totalNota").val());
            }
            
            
            TotalNota = TotalNota - parseInt(subtotal);
            $("#totalNota").val(TotalNota);
        });
             
    });
    
    //Calcular el subtotal del producto seleccionado incluyendo el descuento
    function CalcularSubtotal()
    {
        var cantidad = $("#cantidadProducto").val();
        var precio = $("#PrecioUnitario").val();
        var descuento = $("#descuento").val();
        var subtotal=cantidad * precio;
        subtotal = subtotal - (subtotal*(descuento/100));

        $("#total").val(subtotal);
    }
    
</script>
