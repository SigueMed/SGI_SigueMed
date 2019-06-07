<style>

    
    .inputNombrePaciente{
         width: 95%;
    }
    th { font-size: 13px; }
    td { font-size:12px; }
    
  </style>
  
<div class="row match-height">
        <div class="col-md-5">
            <div class="card">
                <!--CARD HEADER-->
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form"><i class="icon-head"></i>Paciente</h4>
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
                                <div class="form-group col-md-12 col-xs-12">
                                  <input type="hidden" class="form-control" id="idPaciente" name="idPaciente"  readonly="readonly"/>
                                  <label>Paciente</label>
                                  <input type="text" class="inputNombrePaciente" id="txtPaciente" required="required" placeholder="Buscar" />
                               </div>
                            </div>
                            
                            
                            <div class="row">
                                
                                
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                          
                                          <label for="Celular">Celular:</label>
                                        <input type="text" id = "Celular" name="Celular" class="form-control" placeholder="Celular" readonly/>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="text" id = "email" name="email" class="form-control" placeholder="email" readonly/>
                                    </div>
                                </div>
                                


                            </div>
                            <div class="row">
                                
                                
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                          
                                          <label for="RFC">RFC:</label>
                                        <input type="text" id = "RFC" name="RFC" class="form-control" placeholder="Celular" readonly/>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                          
                                          <label for="TotalAdeudo">Adeudo:</label>
                                        <div class="input-group">
                                           <span class="input-group-addon">$</span>
                                          <input type="text" id="TotalAdeudo" name="TotalAdeudo" class="form-control" placeholder="Total" readonly/>
                                          
                                        </div>
                                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalDetalleAduedos">
                                            Detalle
                                        </button>
                                           <a classs = "btn" onclick="Siguiente(1)"><i class="icon-arrow13" data-toggle="tooltip" data-placement="top" id="Siguiente" title="Ir a Productos"> Siguiente</i></a>
                                          
                                    </div>
                                </div>
                                


                            </div>
                            <div class="row">
                                
                                
                                
                                


                            </div>
                            
                            <!-- MODAL DETALLE ADEUDOS -->
                            <div class="modal fade" id="ModalDetalleAduedos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                              aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Detalle Adeudos</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                      <table id="tblDetalleAdeudos" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No. Nota</th>
                                                    <th>Fecha Nota</th>
                                                    <th>Total Nota</th>
                                                    <th>Total Pagado</th>
                                                    <th>Adeudo</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                    </table>
                            
                                    
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>
                        
                        
       
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7">
        <div class="card">
            <!--CARD HEADER-->
            <div class="card-header">
                <h4 class="card-title" id="basic-layout-form">Servicios Abiertos</h4>
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
                        <table id="tblNotasAtendidasPaciente" class="table table-striped table-bordered table-responsive" style="width:100%">
                            <col style="width:20%">
                            <col style="width:20%">
                            <col style="width:20%">
                            <col style="width:25%">
                            <col style="width:5%">
                            
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Servicio</th>
                                        <th>Fecha</th>
                                        <th>Acciones</th>
                                        <th>Cerrar</th>

                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                        </table>
                        
                        <!-- MODAL INFORMACION SERVICIO -->
                            <div class="modal fade" id="ModalInformacionServicio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                              aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Información Servicio
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </h5>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                      <div class="row">
                                          <div class="col-md-12">
                                               <div class="form-group">
                                                    <label for="Modal_Medico">Atendido por:</label>
                                                    <div class="form-group">
                                                        <input type="text" id="Modal_Medico" class="form-control" name="Modal_Medico" placeholder="Atendido por"/>
                                                    </div>
                                                </div>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="col-md-12">
                                               <div class="form-group">
                                                    <label for="Modal_PlanesTratamiento">Planes de Tratamiento</label>
                                                    <div class="position-relative has-icon-left">
                                                            <textarea id="Modal_PlanesTratamiento" rows="5" class="form-control" name="Modal_PlanesTratamiento" placeholder="Planes Tratamiento"></textarea>
                                                            <div class="form-control-position">
                                                                    <i class="icon-file2"></i>
                                                            </div>
                                                    </div>
                                                </div>
                                          </div>
                                      </div>
                                      <table id="Modal_tblProductosNotaMedica" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Producto</th>
                                                    <th>Cantidad</th>
                                                    <th>Descuento</th>
                                                    <th>Total</th>
                                                    

                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                    </table>
                            
                                    
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    
                                  </div>
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
    
   
    //Evento al abrir Modal
    $('#ModalDetalleAduedos').on('show.bs.modal', function (event) {
        var idPaciente = $("#idPaciente").val();
        
        if (idPaciente =="")
        {
            alert("Selecciona un paciente");
            
        }
        else
        {
            ConsultarDetalleAduedosPaciente();
        }
        
    });
 
 
 //input autocomplete Nombre
    var optionsNombre = {
        url: "<?php echo site_url();?>/Agenda_Controler/autocompleteNombre",
        getValue: function (element){
                        return element.Nombre + " " + element.Apellidos;
                    },
        template: {
            type: "custom",
            method: function(value, item){
                return item.Nombre + " " + item.Apellidos;
                
            }
        },
        list: {
            maxNumberOfElements: 5,
            match:{
                enabled:true
            }, 
            
            onClickEvent: function(){
            
            
                var value = $("#txtPaciente").getSelectedItemData().IdPaciente;
                
                
                
                $("#idPaciente").val(value);
                $("#Celular").val($("#txtPaciente").getSelectedItemData().NumCelular);
                
                $("#email").val($("#txtPaciente").getSelectedItemData().email);
              
                ConsultarServiciosAtendidosPaciente();
                ConsultarAdeudosPaciente();
                 $("#tablaProductos tbody tr").remove();
 
                 $("#totalNota").val('');
                 $("#resumenTotalNota").val('');
                
                
            
            },
            
            onChooseEvent: function()
            {
                var value = $("#txtPaciente").getSelectedItemData().IdPaciente;
                
                $("#idPaciente").val(value);
                $("#Celular").val($("#txtPaciente").getSelectedItemData().NumCelular);
                
                $("#email").val($("#txtPaciente").getSelectedItemData().email);
                $("#RFC").val($("#txtPaciente").getSelectedItemData().RFC);
                ConsultarServiciosAtendidosPaciente();
                ConsultarAdeudosPaciente();
                $("#tablaProductos tbody tr").remove();
 
                $("#totalNota").val('');
                
                $("#resumenTotalNota").val('');
                
                
                
            }
            
        },
        theme: "plate-dark"
    };
    
    $('#txtPaciente').easyAutocomplete(optionsNombre);
    
    
   function ConsultarServiciosAtendidosPaciente()
   {
       var IdPaciente = $("#idPaciente").val();
       $.ajax({
                  url:"<?php echo site_url();?>/NotaRemision_Controller/ConsultarNotasAtendidasPaciente_ajax",
                  data:{
                      IdPaciente:IdPaciente
                  },
                  method:"POST",
                  success: function(data)
                    {
                        var VentaInventario = <?php echo $VentaInventario;?>;
                        
                        var NotasMedicas = JSON.parse(data);
                        $("#tblNotasAtendidasPaciente tbody tr").remove();
                        for (i=0;i<NotasMedicas.length;i++)
                        {
                            var tdCargar = "";
                           if(VentaInventario==0)
                            {   
                                
                               tdCargar = '<a class="tooltip-test" title="Cargar Nota" data-original-title="Tooltip" data-toggle="tooltip" href="#" onclick="CargarProductosNota('+NotasMedicas[i]['IdNotaMedica']+','+NotasMedicas[i]['IdEmpleado']+')"><i class="icon-download5"></i>Cargar</a>';
                                       
                            }
                           
                        
                            $('#tblNotasAtendidasPaciente').append(
                            '<tr id=rowNotasAtendidas'+i+'>'+
                            '<td>'+NotasMedicas[i]['IdNotaMedica']+'</td>'+
                            '<td><input type="hidden" value='+NotasMedicas[i]['IdNotaMedica']+'>'+NotasMedicas[i]['DescripcionServicio']+'</td>'+
                            '<td>'+NotasMedicas[i]['FechaNotaMedica']+'</td>'+
                            '<td align="center" data-row="rowNotasAtendidas'+i+'"><a class="tooltip-test" title="Productos" data-original-title="Tooltip" data-toggle="tooltip" href="#" onclick="ConsultarDetalleNota('+NotasMedicas[i]['IdNotaMedica']+')"><i class="icon-zoom-in2"></i>Ver </a>|'+tdCargar +'</td>'+
                            '<td><input type="checkbox" name="chkNotasAtendidas[]" value ="'+NotasMedicas[i]['IdNotaMedica']+'" checked></td>'+
                                
                            '</tr>'
                            );
                        }
                        
                    }
              });
       
   }
   function Siguiente(Card)
   {
       switch (Card)
       {
           case 1:
               var tbl = document.getElementById("BodyNotaRemision");
                tbl.scrollIntoView();
               break;
           case 2:
               break;
           case 3:
               break;
       }
       
   }
   
   function ConsultarDetalleNota(IdNotaMedica)
   {
       
       $.ajax({
            url:"<?php echo site_url();?>/NotaRemision_Controller/ConsultarNotaMedica_ajax",
            data:{
                IdNotaMedica:IdNotaMedica
            },
            method:"POST",
            success: function(data)
                {
                  var NotaMedica = JSON.parse(data);

                  $("#Modal_PlanesTratamiento").val(NotaMedica['PlanesTratamiento']);
                  $("#Modal_Medico").val(NotaMedica['ElaboradoPor']);

                }
            });
            
            $("#ModalInformacionServicio").modal('show');
       
            
       
   }
   function CargarProductosNota(IdNotaMedica, IdEmpleado)
   {
       
       $.ajax({
                  url:"<?php echo site_url();?>/NotaRemision_Controller/ConsultarProductosNotaMedica_ajax",
                  data:{
                      IdNotaMedica:IdNotaMedica
                  },
                  method:"POST",
                  success: function(data)
                    {
                        
                        var ProductosNotaMedica = JSON.parse(data);
                        var SubTotalProducto =0;
                        
                        for (i=0; i<ProductosNotaMedica.length;i++)
                        {
                            SubTotalProducto = 0;
                            SubTotalProducto = parseFloat(ProductosNotaMedica[i]['precio']) * parseFloat(ProductosNotaMedica[i]['CantidadProductoNM']);
                            SubTotalProducto = SubTotalProducto - (SubTotalProducto*(parseFloat(ProductosNotaMedica[i]['Descuento'])/100));
                            
                            var numFila = $('#tablaProductos tbody tr').length+1;
                            $('#tablaProductos').append(
                                '<tr id=row'+numFila+'>'+
                                '<td>'+numFila+'</td>'+
                                '<td><input type="hidden" value='+ProductosNotaMedica[i]['IdServicio']+'><input type="hidden" name="IdEmpleado[]" value="'+IdEmpleado+'">'+ProductosNotaMedica[i]['DescripcionServicio']+'</td>'+
                                '<td><input type="hidden" name="IdProducto[]" value='+ProductosNotaMedica[i]['IdProducto']+'>'+ProductosNotaMedica[i]['DescripcionProducto']+'</td>'+
                                '<td><input type="hidden" name="CodigoSubProducto[]" value=""/><input type="hidden" name="Lote[]" value=""/></td>'+
                                '<td><input type="hidden" name="precio[]" value='+ProductosNotaMedica[i]['precio']+' readonly>'+ProductosNotaMedica[i]['precio']+'</td>'+
                                '<td><input type="hidden" name="cantidad[]" value='+ProductosNotaMedica[i]['CantidadProductoNM']+' readonly>'+ProductosNotaMedica[i]['CantidadProductoNM']+'</td>'+
                                '<td><input type="hidden" name="descuento[]" value="'+ProductosNotaMedica[i]['Descuento']+'%" readonly><input type="hidden" class="form-control" name="subtotal[]" value="'+SubTotalProducto+'">'+ProductosNotaMedica[i]['Descuento']+'</td>'+
                                '<td>'+SubTotalProducto+'</td>'+
                                '<td type="button" name="remove" class="btn btn-danger btn-xs remove" data-row="row'+numFila+'"><i class="icon-ios-trash"></i></td>'+
                                '</tr>'
                            );
                            var TotalNota=0;
                            if($("#totalNota").val()!=="")
                            {
                                TotalNota = parseInt($("#totalNota").val());
                            }


                            TotalNota = TotalNota + SubTotalProducto;
                            $("#totalNota").val(TotalNota);
                            $("#totalNota").change();
                            
                        }                        
                    }
              });
       
   }
   
   function ConsultarAdeudosPaciente()
   {
       var IdPaciente = $("#idPaciente").val();

       $.ajax({
                  url:"<?php echo site_url();?>/NotaRemision_Controller/ConsultarAdeudosPaciente_ajax",
                  data:{
                      IdPaciente:IdPaciente
                  },
                  method:"POST",
                  success: function(data)
                    {
                   
                        var totalAdeudoPaciente = JSON.parse(data);
                
                        if (totalAdeudoPaciente['TotalAdeudo'] !== null)
                        {
                             $("#TotalAdeudo").val(totalAdeudoPaciente['TotalAdeudo']);
                            $("#resumenTotalAdeudo").val(totalAdeudoPaciente['TotalAdeudo']);
                        }
                        else
                        {
                            $("#TotalAdeudo").val(0);
                            $("#resumenTotalAdeudo").val(0);
                        }
       
                       
                    }
                });
    }
    
    function ConsultarDetalleAduedosPaciente()
    {
       var IdPaciente = $("#idPaciente").val();
       
       
       $.ajax({
                  url:"<?php echo site_url();?>/NotaRemision_Controller/ConsultarDetalleAdeudoPaciente_ajax",
                  data:{
                      IdPaciente:IdPaciente
                  },
                  method:"POST",
                  success: function(data)
                    {
                        
                        var DetalleAdeudosPaciente = JSON.parse(data);
                        
                        $("#tblDetalleAdeudos tbody tr").remove();
                        
                        for (i=0; DetalleAdeudosPaciente.length;i++)
                        {
                             
                            $('#tblDetalleAdeudos').append(
                                '<tr>'+
                                '<td>'+DetalleAdeudosPaciente[i]['IdNotaRemision']+'</td>'+
                                '<td>'+DetalleAdeudosPaciente[i]['FechaNotaRemision']+'</td>'+
                                '<td>'+DetalleAdeudosPaciente[i]['TotalNotaRemision']+'</td>'+
                                '<td>'+DetalleAdeudosPaciente[i]['TotalPagado']+'</td>'+
                                '<td>'+DetalleAdeudosPaciente[i]['TotalAdeudo']+'</td>'+
                                
                                '</tr>'
                            );
                        }
       
                        
                    }
                });
        
    }
       
       
</script>
