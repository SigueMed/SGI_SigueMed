
<div class="row match-height">
        <div class="col-md-12">
            <div class="card">
                <!--CARD HEADER-->
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form">Catalogo de Productos</h4>
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
                                        <label for="cbServicio">Servicio</label>
                                        <select name="cbServicio" id="cbServicio" class="form-control" onchange="ConsultarProductosServicio()" >
                                            <option value="">Servicios</option>
                                            
                                        </select>
                                    </div>
                               </div>
                            </div>
                            <table id="tblCatalogoProductos" class="table table-striped table-bordered table-responsive" style="width:100%">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th>Id</th>
                                        <th>Descripción Producto</th>
                                        <th>Costo</th>
                                        <th>Habilitado</th>
                                        <th>Editar</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
        
                            </table>
                            
                            <!--MODAL EDITAR PRODUCTO-->
                            <div class="modal fade" tabindex="-1" role="dialog" id="modalEditarProducto" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="Modal_Title">Editar Producto
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </h4>
                                        
                                        
                                    </div>
                                    <div class="modal-body">
                                        <div class='row'>
                                            <div class='col-md-4'>
                                                <div class='form-group'>
                                                    <label for="Modal_IdProducto">Id. Producto:</label>
                                                    <input type='text' id='Modal_IdProducto' class='form-control' name='Modal_IdProducto' readonly/>
                                                </div>
                                            </div>
                                             <div class='col-md-8'>
                                                <div class='form-group'>
                                                    <label for="Modal_Descripcion">Descripción:</label>
                                                    <input type='text' id='Modal_Descripcion' class='form-control' name='Modal_Descripcion' />
                                                </div>
                                             </div>
                                        </div>
                                        <div class='row'>
                                            <div class='col-md-4'>
                                                <div class="form-group">
                                                    <label for="Modal_CostoProducto">Precio Publico</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">$</span>
                                                        <input type="text" id="Modal_CostoProducto" class="form-control square" placeholder="Costo" aria-label="Costo" name="Modal_CostoProducto">
                                                    
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="Modal_chkHabilitado">Habilitado:</label>
                                                    <input type="checkbox" class='form-control' id="Modal_chkHabilitado" name="Modal_chkHabilitado" value="1">
                                                </div>
                                            </div>
                                        </div>
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
                                                    <label for="PorcentajeCuentaProducto">Procentaje Producto</label>
                                                    <div class="input-group">

                                                        <input type="text" id="PorcentajeCuentaProducto" class="form-control square" placeholder="%" aria-label="Porcentaje" name="PorcentajeCuentaProducto">
                                                        <span class="input-group-addon">%</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='col-md-2 col-xs-6'>
                                                <div class='form-group'>
                                                    <label><br> </label>
                                                    <button class='form-control' type="button" class="btn btn-secondary" id="btnAgregarCuentaProd">
                                                        <i class="icon-plus-square"></i>Agregar
                                                    </button>

                                                </div>


                                            </div>

                                        </div>
                                        <div class='row'>
                                            <div class='col-md-3 col-xs-6'>
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
                                    <div class="modal-footer">
                                        <button id="Cancelar" type="button" class="btn btn-warning mr-1" data-dismiss="modal">Cancelar</button>
                                        <button id="EditarProducto" type="button" class="btn btn-success" data-dismiss="modal">Guardar</button>
                                        
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div><!--DIV CARD-->
        </div><!--DIV COL-MD-->
</div><!--DIV ROW MATCH-->
<script>
    $(document).ready(function(){
        
        
       CargarServicios();
       
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
    });
    
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
    
    function CargarServicios()
    {
        $.ajax({
                  url:"<?php echo site_url();?>/CatalogoProductos_Controller/ConsultarServicios_ajax",
                  method:"POST",
                  
                  success: function(data)
                    {
                        $('#cbServicio').html(data);
                    }
              });
    
    }
    
    
    
     
     function ConsultarProductosServicio()
     {
         var IdServicio = $("#cbServicio").val();
         
         if (IdServicio != "*")
         {
             var t = $('#tblCatalogoProductos').DataTable({
            "ajax":{
                url:"<?php echo site_url();?>/CatalogoProductos_Controller/ConsultarProductosServicio",
                method:"POST",
                data:{
                    IdServicio:IdServicio

                },
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
              "columnDefs":[
                {
                    "targets":4, "render": function(data,type,row,meta)
                    
                        {   
                            return '<a classs = "btn" onclick="OpenModal_EditarProducto('+data+')"><i class="icon-pencil2" data-toggle="tooltip" data-placement="top" id="EditarProducto" title="Editar Producto"> Editar</i></a>';
                            
                        }}
                       
                      ], 
                      
              "columns": [
                    
                    { "data": "IdProducto" },
                    { "data": "DescripcionProducto" },
                    { "data": "CostoProducto" },
                    { "data": "Habilitado" },
                    {"data":"IdProducto"}
                    ]

            });
         }
    
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
    
     
     function OpenModal_EditarProducto(IdProducto)
     {
         $.ajax
        ({
            url:'<?php echo site_url();?>/CatalogoProductos_Controller/ConsultarProductoPorId_ajax',
            data:{
                IdProducto:IdProducto
            },
            method: "POST",
            success:function(resp)
            {
                
                var Producto = JSON.parse(resp);
                
                LimpiarModalEditarProducto();
                
                
                $('#Modal_IdProducto').val(Producto['IdProducto']);
                $("#Modal_Descripcion").val(Producto['DescripcionProducto']);
                $("#Modal_CostoProducto").val(Producto['CostoProducto']);
                
                if(Producto['Habilitado']== '1')
                {
                    $("#Modal_chkHabilitado").prop("checked",true);
                }
                CargarCuentas();
                CargarCuentasProducto(Producto['IdProducto']);
                
                
                $("#modalEditarProducto").modal('show');
    
            }
        });
     }
     
     function CargarCuentasProducto(IdProducto)
     {
         $.ajax
        ({
            url:'<?php echo site_url();?>/CatalogoProductos_Controller/ConsultarCuentasProducto_ajax',
            data:{
                IdProducto:IdProducto
            },
            method: "POST",
            success:function(resp)
            {
                
                var CuentasProducto = JSON.parse(resp);
                
                
                var numFila = 1;
                var PorcentajeAsignado = 0;
             $('#tblCuentasProducto tbody tr').remove();
                
                for (var i=0; i<CuentasProducto.length; i++)
                {
                    $('#tblCuentasProducto').append(
                        '<tr id="row'+numFila+'">'+
                        '<td>'+numFila+'</td>'+
                        '<td><input type="hidden" name="IdCuentaProducto[]" value="'+CuentasProducto[i]['IdCuenta']+'"><input type="hidden" name="PorcentajeProducto[]" value="'+CuentasProducto[i]['PorcentajeCuenta']*100+'">'+CuentasProducto[i]['DescripcionCuenta']+'</td>'+
                        '<td>'+(CuentasProducto[i]['PorcentajeCuenta']*100)+'</td>'+
           
                        '<td data-row="row'+numFila+'"><a classs = "btn" onclick="BorrarCuentaProducto('+numFila+')" data-row="row'+numFila+'"><i class="icon-trash" data-toggle="tooltip" data-placement="top" id="EliminarCuenta" title="Eliminar cuenta"> Eliminar</i></a></td>'+
                        '</tr>');
                        
                        PorcentajeAsignado += parseFloat(CuentasProducto[i]['PorcentajeCuenta'])*100;
                    
                }
            
            
            
            $("#PorcentajeAsignado").val(PorcentajeAsignado);
                    
                }
            
        });
         
     }
     
    function  LimpiarModalEditarProducto()
    {
        $('#Modal_IdProducto').val();
        $("#Modal_Descripcion").val();
        $("#Modal_CostoProducto").val();
        $("#Modal_chkHabilitado").prop("checked",false);
        
         
    }
</script>
