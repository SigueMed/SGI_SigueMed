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
                <div class="card-body collapse in" id="BodyNotaRemision">
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
                                <div class="col-md-2 col-xs-3">
                                    <div class="form-group">
                                         <label for="PrecioUnitario">Precio</label>
                                         <div class="input-group">
                                            <span class="input-group-addon">$</span>
                                           <input type="text" id="PrecioUnitario" name="PrecioUnitario" class="form-control" placeholder="Precio Unitario" readonly/>
                                         </div>
                                    </div>
                                </div>
                                <div class="col-md-1 col-xs-3">
                                    <div class="form-group">
                                         <label for="cantidadProducto">Cantidad</label>
                                         <input type="text" id="cantidadProducto" name="cantidadProducto" class="form-control" placeholder="Cantidad" onchange="CalcularSubtotal()"/>
                                    </div>
                                </div>
                                <div class="col-md-2 col-xs-3">
                                    <div class="form-group">
                                         <label for="descuento">Desc.</label>
                                         <div class="input-group">
                                           <input type="text" id="descuento" name="descuento" class="form-control" placeholder="Descuento" onchange="CalcularSubtotal()"/>
                                           <span class="input-group-addon">%</span>
                                         </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-xs-3">
                                    <div class="form-group">
                                         <label for="total">Total</label>
                                         <div class="input-group">
                                            <span class="input-group-addon">$</span>
                                           <input type="text" id="total" name="total" class="form-control" placeholder="Total" readonly/>
                                         </div>
                                    </div>
                                
                            </div>
                            </div>
                            
                            <div align = "right">
                                    <button type="button" class="btn btn-secondary" id="btnInventario">
                                    <i class="icon-ios-medkit-outline"></i>Inventario
                                </button>
                                <button type="button" class="btn btn-secondary" id="btnLimpiar">
                                    <i class="icon-trash4"></i>Limpiar
                                </button>
                                <button type="button" class="btn btn-secondary" id="btnAgregar">
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
                                            <th>SubProducto</th>
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
                                    echo '<button type="submit" class="btn btn-primary" name="action" value="'.$ProductosNotaSubmitAction.'">';
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
        var Perfil = <?php echo $this->session->userdata('IdPerfil');?>;
        
        if (Perfil!==3)
        {
            
            $("#descuento").prop('readonly',true);
        }
        else
        {
             $("#descuento").prop('readonly',false);
        }
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
                        LimpiarCampos();
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
                    '<td><input type="hidden" value="'+idServicio+'"><input type="hidden" name="IdEmpleado[]" value="">'+descServicio+'</td>'+
                    '<td><input type="hidden" name="IdProducto[]" value="'+idProducto+'">'+descProducto+'</td>'+
                    '<td><input type="hidden" name="CodigoSubProducto[]" value=""><input type="hidden" name="Lote[]" value=""></td>'+
                    '<td><input type="hidden" class="form-control" name="precio[]" value="'+precio+'" readonly>$'+precio+'</td>'+
                    '<td><input type="hidden" class="form-control" name="cantidad[]" value="'+cantidad+'"readonly>'+cantidad+'</td>'+
                    '<td><input type="hidden" class="form-control" name="descuento[]" value="'+descuento+'" readonly><input type="hidden" class="form-control" name="subtotal[]" value="'+subtotal+'">'+descuento+'%</td>'+
                    '<td>'+subtotal+'</td>'+
                    '<td type="button" name="remove" class="btn btn-danger btn-xs remove" data-row="row'+numFila+'"><i class="icon-ios-trash"></i></td>'+
                    '</tr>'
                    );
                var TotalNota=0;
                if($("#totalNota").val()!=="")
                {
                    TotalNota = parseFloat($("#totalNota").val());
                }


                TotalNota = TotalNota + parseFloat(subtotal);
                $("#totalNota").val(TotalNota);
                $("#totalNota").change();
                
                LimpiarCampos();
                $('#servicio').val('');
            }     
        });
        
        //Agregar nueva fila a la tabla productos
        $('#btnLimpiar').click(function(){
            $("#tablaProductos tbody tr").remove();
 
           $("#totalNota").val('');
        });
        
        
        //Borrar filas de la tabla productos
        $(document).on('click', '.remove', function(){
            var delete_row = $(this).data("row");
            
            var subtotal = parseFloat($("#"+delete_row).find("td")[7].innerHTML);
            $('#' + delete_row).remove();
            
            var TotalNota=0;
            
            if($("#totalNota").val()!=="")
            {
                TotalNota = parseFloat($("#totalNota").val());
            }
            
            
            
            TotalNota = TotalNota - subtotal;
            
            
            $("#totalNota").val(TotalNota);
            $("#totalNota").change();
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
    
    function LimpiarCampos()
    {
        $("#producto").val('');
        //
        $("#cantidadProducto").val('');
        $("#PrecioUnitario").val('');
        $("#descuento").val('');
        $("#total").val('');
        $('#cb_CuentaProd').val('');
        
    }
    
    
    
    
</script>
