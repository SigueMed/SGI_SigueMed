<div class="row match-height">
        <div class="col-md-12">
            <div class="card">
                <!--CARD HEADER-->
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form">Entrada Inventario</h4>
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
                                    <div class="form-group">
                                        <label for="Proveedor">Proveedores</label>
                                        <select name="proveedor" id="proveedor" class="form-control" onchange="CargarProveedorID()" required="required">
                                            <option value="">Proveedores</option>
                                            
                                        </select>
                                    </div>
                                </div>
                            
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="NombreProveedor">Nombre:</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="text" id="NombreProveedor" class="form-control" placeholder="Proveedor" name="NombreProveedor" readonly>
                                            <div class="form-control-position">
                                            <i class="icon-head"></i>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="DireccionProveedor">Dirección:</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="text" id="DireccionProveedor" class="form-control" placeholder="Proveedor" name="DireccionProveedor" readonly>
                                            <div class="form-control-position">
                                            <i class="icon-office"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="TelefonoProveedor">Telefono:</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="text" id="TelefonoProveedor" class="form-control" placeholder="Telefono" name="TelefonoProveedor" readonly>
                                            <div class="form-control-position">
                                            <i class="icon-phone"></i>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="emailProveedor">email:</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="text" id="emailProveedor" class="form-control" placeholder="email" name="emailProveedor" readonly>
                                            <div class="form-control-position">
                                            <i class="icon-mail2"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                            </div>
                            <h4 class="form-section"><i class="icon-paper"></i> Factura</h4>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                       
                                        <label for="NumeroFactura">No. Factura:</label>
                                        <input type="text" id="NumeroFactura" class="form-control" placeholder="No. Factura" name="NumeroFactura" required="required">
                            
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="FechaFactura">Fecha Factura:</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="date" id="FechaFactura" class="form-control" name="FechaFactura"/>
                                            <div class="form-control-position">
                                                    <i class="icon-calendar5"></i>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                       
                                       <label for="TotalFactura">Total Factura:</label>
                                            <div class="input-group">
                                                    <span class="input-group-addon">$</span>
                                                    <input type="text" id="TotalFactura" class="form-control square" placeholder="Total Factura" aria-label="Total Factura" name="TotalFactura">
                                                    
                                            </div>
                                    </div>
                                </div>
                                
                                
                            </div>
                            
                            <h4 class="form-section"><i class="icon-drawer"></i> Productos</h4>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Servicios">Servicios</label>
                                        <select name="Servicios" id="Servicios" class="form-control" onchange="CargarCatalogoProductosInventario()">
                                            <option value="">Servicios</option>
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Productos">Producto:</label>
                                        <select name="Productos" id="Productos" class="form-control" onchange="$('#CodigoSubProducto').focus()">
                                            <option value="">Productos</option>
                                            
                                        </select>
                                        
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="CodigoSubProducto">Codigo:</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="text" id="CodigoSubProducto" class="form-control" placeholder="Código de Barras" name="CodigoSubProducto" onchange="CargarSubProducto()" onkeypress="runScript(event)">
                                            <div class="form-control-position">
                                            <i class="icon-barcode"></i>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="DescripcionSubProducto">Descripción:</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="text" id="DescripcionSubProducto" class="form-control" placeholder="Descripción" name="DescripcionSubProducto">
                                            <div class="form-control-position">
                                            <i class="icon-box"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="LoteSubProducto">No. Lote:</label>
                                        <input type="text" id="LoteSubProducto" class="form-control" placeholder="No. Lote" name="LoteSubProducto">
                                        
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="CaducidadSubProducto">Fecha Caducidad:</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="date" id="CaducidadSubProducto" class="form-control" name="CaducidadSubProducto"/>
                                            <div class="form-control-position">
                                                    <i class="icon-calendar5"></i>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                </div>
                                <div class="row  ">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="CantidadSubProducto">Cantidad:</label>
                                            <input type="text" id="CantidadSubProducto" class="form-control" placeholder="Cantidad" name="CantidadSubProducto"/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="CostoSubProducto">Costo:</label>
                                            <div class="input-group">
                                                    <span class="input-group-addon">$</span>
                                                    <input type="text" id="CostoSubProducto" class="form-control square" placeholder="Costo" aria-label="Costo" name="CostoSubProducto">
                                                    
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="form-group" align="right">
                                            <button type="button" class="btn btn-primary" id="btnAgregarSubProducto"><i class="icon-android-add"></i>Agregar</button>
                                        </div>

                                    </div>
                                    
                            </div>
                            
                                 
                                <table class="table table-responsive table-bordered table-striped" id="tablaSubProductos">
                                    <thead>
                                        <th>#</th>
                                        <th>Producto</th>
                                        <th>Código</th>
                                        <th>Nombre</th>
                                        <th>No. Lote</th>
                                        <th>Fec. Caducidad</th>
                                        <th>Cantidad</th>
                                        <th>Costo</th>
                                        <th>Eliminar</th>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                    
                                </table>
                                
                            
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-warning mr-1" name="action" value="cancelar">
                                <i class="icon-cross2"></i> Cancelar
                            </button>
                            <button type="submit" class="btn btn-primary mr-1" name="action" value='GuardarEntrada'>
                                <i class="icon-check2"></i>Guardar Entrada
                            </button>
                            
                                
                                
                        </div>
                                
                            
                            
                          
                            
                    </div>
                </div>
            </div>
        </div>
</div>
<script type="text/javascript">
    $(document).ready(function()
    {
        CargarProveedores();
        CargarServiciosInventario();
        CargarCatalogoProductosInventario();
        
        //Agregar nueva fila a la tabla productos
        $('#btnAgregarSubProducto').click(function(){
 
            var idProducto =  $("#Productos").val();
            var descProducto = $("#Productos option:selected").html();
            var numFila = $('#tablaSubProductos tbody tr').length+1;
            var CodigoBarras = $("#CodigoSubProducto").val();
            var DescripcionSubProducto = $("#DescripcionSubProducto").val();
            
            var CantidadSubProducto = $("#CantidadSubProducto").val();
            var CostoSubProducto = $("#CostoSubProducto").val();
            var FechaCaducidad = $("#CaducidadSubProducto").val();
            var LoteSubProducto = $("#LoteSubProducto").val();
            
            if(CantidadSubProducto!=="" && parseInt(CantidadSubProducto) >0)
            {
                $('#tablaSubProductos').append(
                    '<tr id=row'+numFila+'>'+
                    '<td>'+numFila+'</td>'+
                    '<td><input type="hidden" class="form-control" name="CodigoProducto[]"value='+idProducto+'>'+descProducto+'</td>'+
                    '<td><input type="hidden" class="form-control" name="CodigoBarras[]" value="'+CodigoBarras+'" readonly>'+CodigoBarras+'</td>'+
                    '<td><input type="hidden" class="form-control" name="DescripcionSubProducto[]" value="'+DescripcionSubProducto+'"readonly>'+DescripcionSubProducto+'</td>'+
                    '<td><input type="hidden" class="form-control" name="LoteSubProducto[]" value="'+LoteSubProducto+'" readonly>'+LoteSubProducto+'</td>'+
                    '<td><input type="hidden" class="form-control" name="FechaCaducidad[]" value="'+FechaCaducidad+'" readonly>'+FechaCaducidad+'</td>'+
                    '<td><input type="hidden" class="form-control" name="CantidadSubProducto[]" value="'+CantidadSubProducto+'" readonly>'+CantidadSubProducto+'</td>'+
                    '<td><input type="hidden" class="form-control" name="CostoSubProducto[]" value="'+CostoSubProducto+'" readonly>'+CostoSubProducto+'</td>'+
                    '<td><button type="button" name="removeSubProducto" class="btn mr-1 mb-1 btn-danger btn-sm removeSubProducto" data-row="row'+numFila+'"><i class="icon-ios-trash"></i></button></td>'+
                    '</tr>'
                    );
            
            LimpiarControles();
            $("#CodigoSubProducto").focus();
                
            }     
        });
        //Borrar filas de la tabla productos
        $(document).on('click', '.removeSubProducto', function(){
            var delete_row = $(this).data("row");
            
           
            $('#' + delete_row).remove();
            
            
        });
        
        
    });
    function CargarProveedores()
    {
        $.ajax({
                  url:"<?php echo site_url();?>/Inventario_Controller/ConsultarProveedores_ajax",
                  method:"POST",
                  success: function(data)
                    {
                        $('#proveedor').html(data);
                    }
              });
    }
    function CargarProveedorID()
    {
        var IdProveedor = $('#proveedor').val();
        if (IdProveedor !== "")
        {
   
            $.ajax({
                url:"<?php echo site_url();?>/Inventario_Controller/ConsultarProveedorPorId",
                method:"POST",
                data:{IdProveedor:IdProveedor},
                success: function(data)
                {
                   var Proveedor = JSON.parse(data);
                   $('#NombreProveedor').val(Proveedor['NombreProveedor']);
                   $('#DireccionProveedor').val(Proveedor['DireccionProveedor']);
                   $('#TelefonoProveedor').val(Proveedor['TelefonoProveedor']);
                   $('#emailProveedor').val(Proveedor['emailProveedor']);
                   $('#NumeroFactura').focus();


                }
            });
        }
        
    }
    function CargarCatalogoProductosInventario()
    {
        var IdServicio = $('#Servicios').val();
         $.ajax({
                  url:"<?php echo site_url();?>/Inventario_Controller/CargarCatalogoProductos_ajax",
                  data:{
                      IdServicio:IdServicio
                  },
                  method:"POST",
                  success: function(data)
                    {
                        $('#Productos').html(data);
                    }
              });
    }
    
    function LimpiarControles()
    {
        $("#CodigoSubProducto").val("");
        $("#DescripcionSubProducto").val("");
        $("#Productos").val("");
        $("#CostoSubProducto").val("");
        $("#LoteSubProducto").val("");
        $("#CaducidadSubProducto").val(0);
        $("#CantidadSubProducto").val("");
    }
    
    function CargarSubProducto()
    {
        $.ajax({
                url:"<?php echo site_url();?>/Inventario_Controller/ConsultarSubProducto_ajax",
                method:"POST",
                data:{CodigoSubProducto:$('#CodigoSubProducto').val()},
                success: function(data)
                {
                   var SubProducto = JSON.parse(data);

                   if (SubProducto!== false)
                   {
 
                        $('#DescripcionSubProducto').val(SubProducto['NombreSubProducto']);
                        $('#DescripcionSubProducto').prop('readonly',true);

                        $('#LoteSubProducto').focus();
                   }
                   else
                   {
                       $('#DescripcionSubProducto').prop('readonly',false);
                       $('#DescripcionSubProducto').val('');
                       $('#DescripcionSubProducto').focus();
                   }


                }
            });
        
    }
    
    function CargarServiciosInventario()
    {
        
         $.ajax({
                url:"<?php echo site_url();?>/Inventario_Controller/ConsultarServiciosInventario_ajax",
                method:"POST",
                
                success: function(data)
                {
                    
                    $('#Servicios').html(data);
                }
            });
        
        
    }
    
    function runScript(e)
    {
        if (e.keyCode == 13) {
            e.preventDefault();
            CargarSubProducto();
        return false;
    }
    }
    
</script>
