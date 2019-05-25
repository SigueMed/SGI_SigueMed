<div class="row match-height">
        <div class="col-md-12">
            <div class="card">
                <!--CARD HEADER-->
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form">Inventario</h4>
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
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="txtCodigoSubProducto">Codigo:</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="text" id="txtCodigoSubProducto" class="form-control" placeholder="Código de Barras" name="txtCodigoSubProducto" onchange="CargarSubProducto()">
                                            <div class="form-control-position">
                                            <i class="icon-barcode"></i>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="txtDescripcionSubProducto">Descripción:</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="text" id="txtDescripcionSubProducto" class="form-control" placeholder="Descripción" name="txtDescripcionSubProducto" readonly>
                                            <div class="form-control-position">
                                            <i class="icon-box"></i>
                                            </div>
                                        </div>
                                        <input type="text" hidden="true" id="txtIdProducto" name="txtIdProducto" readonly>
                                        <input type="text" hidden="true" id="txtIdServicio" name="txtIdServicio" readonly>
                                        <input type="text" hidden="true" id="txtDescProducto" name="txtDescProducto" readonly>
                                        <input type="text" hidden="true" id="txtDescServicio" name="txtDescServicio" readonly>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="txtLoteSubProducto">No. Lote:</label>
                                        <input type="text" id="txtLoteSubProducto" class="form-control" placeholder="No. Lote" name="txtLoteSubProducto" readonly>
                                        
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="txtCaducidadSubProducto">Fecha Caducidad:</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="date" id="txtCaducidadSubProducto" class="form-control" name=txt"CaducidadSubProducto" readonly/>
                                            <div class="form-control-position">
                                                    <i class="icon-calendar5"></i>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                
                            </div>
                                <div class="row  ">
                                
                                    <div class="col-md-2 col-xs-6">
                                        <div class="form-group">
                                            <label for="txtCantidadInventario">Cantidad Inventario:</label>
                                            <input type="text" id="txtCantidadInventario" class="form-control" placeholder="Cantidad" name="txtCantidadInventario" readonly/>
                                            
                                        </div>
                                    </div>
                                     <div class="col-md-2 col-xs-6">
                                        <div class="form-group">
                                            <label for="txtPrecioProducto">Costo:</label>
                                            <div class="input-group">
                                                    <span class="input-group-addon">$</span>
                                                    <input type="text" id="txtPrecioProducto" class="form-control square" placeholder="Precio" aria-label="Costo" name="PrecioProducto" readonly>
                                                    
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-xs-4">
                                        <div class="form-group">
                                            <label for="txtCantidadVenta">Cantidad:</label>
                                            <input type="text" id="txtCantidadVenta" class="form-control" placeholder="Cantidad" name="txtCantidadVenta" onchange="CalcularSubtotalInventario()"/>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-xs-4">
                                        <div class="form-group">
                                             <label for="txtdescuentoInventario">Descuento</label>
                                             <div class="input-group">
                                                 <input type="text" id="txtdescuentoInventario" name="txtdescuentoInventario" class="form-control" placeholder="Descuento" onchange="CalcularSubtotalInventario()" readonly/>
                                               <span class="input-group-addon">%</span>
                                             </div>
                                        </div>

                                    </div>
                                    <div class="col-md-2 col-xs-4">
                                        <div class="form-group">
                                            <label for="txtSubTotalInventario">Subtotal:</label>
                                            <div class="input-group">
                                                    <span class="input-group-addon">$</span>
                                                    <input type="text" id="txtSubTotalInventario" class="form-control square" placeholder="Subtotal" aria-label="Costo" name="txtSubTotalInventario" readonly>
                                                    
                                            </div>
                                        </div>
                                    </div>
                                   
                               </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-secondary" id="btnAgregarInventario">
                                                <i class="icon-android-add"></i>Agregar
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#btnAgregarInventario').click(function(){
        
            var CodigoSubProducto = $("#txtCodigoSubProducto").val();
            var idServicio = $("#txtIdServicio").val();
            var descServicio = $("#txtDescServicio").val();
            var Lote =$("#txtLoteSubProducto").val();
            var DescSubProducto = $("#txtDescripcionSubProducto").val();
            var idProducto =  $("#txtIdProducto").val();
            var descProducto = $("#txtDescProducto").val();
            var numFila = $('#tablaProductos tbody tr').length+1;
            var precio = $("#txtPrecioProducto").val();
            var cantidad = $("#txtCantidadVenta").val();
            var descuento = $("#txtdescuentoInventario").val();
            var subtotalInventario = $("#txtSubTotalInventario").val();
            var ExistenciaInventario = parseInt($("#txtCantidadInventario").val());
            
            if (parseInt(cantidad)> ExistenciaInventario)
            {
                alert('No se puede agregar una cantidad mayor a la del Inventario');
            }
            else
            {
                if(cantidad!=="" && parseInt(cantidad) >0)
                {
                    $('#tablaProductos').append(
                        '<tr id=row'+numFila+'>'+
                        '<td>'+numFila+'</td>'+
                        '<td><input type="hidden" value='+idServicio+'><input type="hidden" name="IdEmpleado[]" value="">'+descServicio+'</td>'+
                        '<td><input type="hidden" name="IdProducto[]" value="'+idProducto+'">'+descProducto+'</td>'+
                        '<td><input type="hidden" name="CodigoSubProducto[]" value='+CodigoSubProducto+'><input type="hidden" name="Lote[]" value='+Lote+'>'+DescSubProducto+'</td>'+
                        '<td><input type="hidden"  name="precio[]" value="'+precio+'">'+precio+'</td>'+
                        '<td><input type="hidden" name="cantidad[]" value="'+cantidad+'">'+cantidad+'</td>'+
                        '<td><input type="hidden" name="descuento[]" value="'+descuento+'"><input type="hidden" name="subtotal[]" value="'+subtotalInventario+'">'+descuento+'</td>'+
                        '<td>'+subtotalInventario+'</td>'+
                        '<td type="button" name="remove" class="btn btn-danger btn-xs remove" data-row="row'+numFila+'"><i class="icon-ios-trash"></i></td>'+
                        '</tr>'
                        );
                    var TotalNota=0;
                    if($("#totalNota").val()!=="")
                    {
                        TotalNota = parseFloat($("#totalNota").val());
                    }


                    TotalNota = TotalNota + parseFloat(subtotalInventario);
                    $("#totalNota").val(TotalNota);
                    $("#totalNota").change();
                    $("#txtCodigoSubProducto").val('');
                     LimpiarCamposProductosInventario();


                } 
            }
        });
    });
    function CargarSubProducto()
    {
        $.ajax({
                url:"<?php echo site_url();?>/Inventario_Controller/ConsultarExistenciaSubProducto_ajax",
                method:"POST",
                data:{CodigoSubProducto:$('#txtCodigoSubProducto').val()},
                success: function(data)
                {
                   var SubProducto = JSON.parse(data);
  
                   if (SubProducto!== false && SubProducto !== '2')
                   {
                    
                        $('#txtDescripcionSubProducto').val(SubProducto['NombreSubProducto']);
                        $('#txtLoteSubProducto').val(SubProducto['Lote']);
                        $('#txtCaducidadSubProducto').val(SubProducto['FechaCaducidad']);
                        $('#txtPrecioProducto').val(SubProducto['CostoProducto']);
                        $('#txtCantidadInventario').val(SubProducto['CantidadInventario']);
                        $('#txtIdProducto').val(SubProducto['IdProducto']);
                        $('#txtIdServicio').val(SubProducto['IdServicio']);
                        $('#txtDescProducto').val(SubProducto['DescripcionProducto']);
                        $('#txtDescServicio').val(SubProducto['DescripcionServicio']);
                        
                        

                        $('#txtCantidadVenta').val('1');
                        $('#txtdescuentoInventario').val('0');
                        

                        $('#txtCantidadVenta').focus();
                        
                        CalcularSubtotalInventario();
                        
                   }
                   else
                   {
                       
                       LimpiarCamposProductosInventario();
                       $("#txtCodigoSubProducto").focus();
                   }


                }
            });
        
    }
    function CalcularSubtotalInventario()
    {
        var cantidad = $("#txtCantidadVenta").val();
        var precio = $("#txtPrecioProducto").val();
        var descuento = $("#txtdescuentoInventario").val();
        var subtotal=cantidad * precio;
        subtotal = subtotal - (subtotal*(descuento/100));

        $("#txtSubTotalInventario").val(subtotal);
    }
    
    function LimpiarCamposProductosInventario()
    {
        $('#txtDescripcionSubProducto').val('');
        $('#txtLoteSubProducto').val('');
        $('#txtCaducidadSubProducto').val('');
        $('#txtPrecioProducto').val('');
        $('#txtCantidadInventario').val('');
        $('#txtIdProducto').val('');
        $('#txtIdServicio').val('');
        $('#txtDescProducto').val('');
        $('#txtDescServicio').val('');



        $('#txtCantidadVenta').val('');
        $('#txtdescuentoInventario').val('');
        $("#txtSubTotalInventario").val('');
        
    }
    
                
</script>
   