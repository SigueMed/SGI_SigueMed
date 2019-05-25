<div class="row match-height">
        <div class="col-md-12">
            <div class="card">
                <!--CARD HEADER-->
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form">Cuentas Producto</h4>
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
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="cbCuentaProducto">Cuenta</label>
                                        <select id="cbCuentaProducto" name="cbCuentaProducto" class="form-control">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="PorcentajeCuentaProducto">Procentaje</label>
                                        <div class="input-group">
                                            
                                            <input type="text" id="PorcentajeCuentaProducto" class="form-control square" placeholder="%" aria-label="Porcentaje" name="PorcentajeCuentaProducto">
                                            <span class="input-group-addon">%</span>
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
                            <div class='row'>
                                <div class='col-md-2 col-xs-2'>
                                    <div class='form-group'>
                                        <label>Porcentaje Asignado </label>
                                        <div class="input-group">

                                            <input type="text" id="PorcentajeAsignado" class="form-control square" placeholder="%" aria-label="Porcentaje" name="PorcentajeAsignado" value="0" readonly>
                                            <span class="input-group-addon">%</span>
                                        </div>
                                                                                
                                    </div>
                                    
                                    
                                </div>
                            </div>
                            <div class="row">
                                
                                <table class="table table-responsive table-striped" id="tblCuentasProducto" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Cuenta</th>
                                            <th>%</th>
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
        CargarCuentas();
       CargarValores(); 
       
        //Agregar nueva fila a la tabla productos
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
  
            var PorcentajeCuenta =  parseFloat($("#PorcentajeCuentaProducto").val());
            var PorcentajeAsignado = parseFloat($("#PorcentajeAsignado").val());
  
           if (PorcentajeCuenta <= (100-PorcentajeAsignado))
            {
            
                $('#tblCuentasProducto').append(
                    '<tr id="row'+numFila+'">'+
                    '<td>'+numFila+'</td>'+
                    '<td><input type="hidden" name="IdCuentaProducto[]" value="'+IdCuenta+'"><input type="hidden" name="PorcentajeProducto[]" value="'+PorcentajeCuenta+'">'+DescripcionCuenta+'</td>'+
                    '<td>'+PorcentajeCuenta+'</td>'+
           
                    '<td data-row="row'+numFila+'"><a classs = "btn" onclick="BorrarCuentaProducto('+numFila+')" data-row="row'+numFila+'"><i class="icon-trash" data-toggle="tooltip" data-placement="top" id="EliminarCuenta" title="Eliminar cuenta"> Eliminar</i></a></td>'+
                    '</tr>'
                    );
            
            PorcentajeAsignado += PorcentajeCuenta;
            
            $("#PorcentajeAsignado").val(PorcentajeAsignado);
                
            }
            else
            {
                alert('No puedes asignar mas del '+(100-PorcentajeAsignado)+'%');
            }
                
        });
        
        //Borrar filas de la tabla productos
        $(document).on('click', '.remove', function(){
            
 
        });
       
    });
    
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
