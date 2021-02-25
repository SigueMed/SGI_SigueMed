<!--easy Autocomplete-->
<script src="<?php echo base_url();?>assets/easyautocomplete/jquery.easy-autocomplete.min.js" ></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/easyautocomplete/easy-autocomplete.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/easyautocomplete/easy-autocomplete.themes.min.css">

<style>


    .inputNombrePaciente{
         width: 100%;
    }
    .inputBuscarProducto{
         width: 100%;
    }
    .table th {
        font-size: 14px;
        padding: 7px;}
    .table td {
        font-size:13px;

        padding: 7px;}
    td.block
        {
        border: 1px solid black;
        }

</style>

<?php echo form_open('NotaRemision_Controller/RegistrarNotaRemision');?>
<!--RENGLON 1-->
<div class="row">

    <div class="col-lg-6 col-xs-12">

        <!-- PACIENTE -->
        <div class="card my-4">
          <div class="card-header">
              <h6>Datos Paciente</h6>
          </div>

          <div class="card-body">
              <div class="card-block">
                  <div class="form-body">
                    <div class="row">
                      <div class="col-md-6">
                        <input type="checkbox" id="chkPacienteGeneral" name="PacienteGeneral" value="PacienteGeneral">
                        <label for="chkPacienteGeneral">Venta General</label><br>

                      </div>

                    </div>
                      <div class="row">
                        <div class="col-md-2 col-xs-1">
                            <img src="<?php echo base_url();?>app-assets/images/portrait/small/Paciente50.png" alt="avatar">
                        </div>
                        <div class="col-md-8 col-xs-12">
                              <div class="form-group">
                                  <input type="hidden" class="form-control" id="idPaciente" name="idPaciente"  readonly="readonly"/>
                                  <label>Nombre:</label>
                                  <input type="text" class="inputNombrePaciente form-control" id="txtPaciente" required placeholder="Buscar" />
                              </div>
                          </div>
                          <div class="col-md-2">
                            <label style="color:white">_____</label>
                              <button type="button" class="btn btn-sm btn-success" onclick="AbrirModalNuevoPaciente()"><i class="icon-plus"></i></button>
                          </div>

                      </div>
                      <div class="row">

                          <div class="col-md-9 col-xs-9">
                              <b><label id="lblNombrePaciente" style="font-size: 16px"></label></b>
                          </div>

                      </div>
                      <div class="row">

                          <div class="col-md-7" style="font-size: 11px">

                              Fec. Nacimiento: <label id="lblFechaNacimiento" ></label> |Sexo: <label id="lblSexo"></label> | <a href="#"><i class="icon-pencil"></i></a>
                          </div>
                          <div class ="col-md-2">

                          </div>

                      </div>

                  </div>
              </div>

          </div>
        </div>
    </div>

    <div class="col-lg-6 col-xs-12">

        <!-- Resumen -->
        <div class="card my-4">
          <div class="card-header">
              <h6>Resumen Compra</h6>
          </div>

          <div class="card-body">
              <div class="card-block">
                  <div class="form-body">
                      <div class="row">

                      </div>
                  </div>
              </div>
          </div>
        </div>
    </div>


</div>
<!--RENGLON 2-->
<div class="row">
    <div class="col-lg-12 col-xs-12">
        <!--SERVICIOS NOTA-->
        <div class="card my-4">
            <div class="card-header">
                <h6>Detalle</h6>
            </div>
            <div class="card-body">
                <div class="card-block">
                  <div class="row">
                    <div class="col-md-12">
                        <table class="table" style="width:100%" id="tablaProductos">
                                <thead>
                                    <tr>
                                        <th >#</th>
                                        <th >Servicio</th>
                                        <th >Producto</th>
                                        <th >Costo</th>
                                        <th >Cant.</th>
                                        <th >Total</th>
                                        <th >Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

                    </div>
                  </div>

                    <div class="row  match-height">
                      <div class="col-md-10 col-xs-10">
                            <div class="form-group">
                                <input type="hidden" class="form-control" id="IdProducto" name="IdProducto"  readonly="readonly"/>
                                <label>Servicio/Producto:</label>
                                <input type="text" class="inputBuscarProducto form-control" id="txtProducto" placeholder="Buscar" />
                                <input type="hidden" name="IdFoliador" id="IdFoliador" value="1">
                            </div>
                        </div>
                        <div class="col-md-1 col-xs-1">
                          <div class="form-group">
                            <label style ="color:white">_</label>
                            <button type="button" name="button" class="btn btn-info form-control icon-search" onclick="LoadModal_BuscarProducto()"></button>

                          </div>

                        </div>
                      </div>
                      <div class="row">


                        <div class="col-md-4 col-xs-4">
                          <div class="form-group">
                            <label for="DescripcionProducto">Descripción Producto:</label>
                            <input type="text" class = "form-control" name="DescripcionProducto" id="DescripcionProducto" value="" readonly="readonly">
                            <input type="hidden" class="form-control" id="IdServicio" name="IdServicio"  readonly="readonly"/>
                            <input type="hidden" class="form-control" id="DescripcionServicio" name="DescripcionServicio"  readonly="readonly"/>
                            <input type="hidden" class="form-control" id="PrecioProveedor" name="PrecioProveedor"  readonly="readonly"/>
                            <input type="hidden" class="form-control" id="EsProveedor" name="EsProveedor"  readonly="readonly"/>


                          </div>

                        </div>
                        <div class="col-md-2">
                          <div class="form-group">
                            <label for="CantidadProducto">Cantidad</label>
                            <input type="text" class ="form-control" name="CantidadProducto"  id="CantidadProducto" value="">
                          </div>

                        </div>

                        <div class="col-md-3 col-xs-3">
                            <div class="form-group">
                                 <label for="SubtotalProducto">Total</label>

                                    <input type="text" id="SubtotalProducto" name="SubtotalProducto" class="form-control" placeholder="Total" readonly="readonly">


                                 <!-- <div class="input-group">

                                    <span class="input-group-addon">$</span>
                                    <input type="text" id="SubtotalProducto" name="SubtotalProducto" class="form-control" placeholder="Total">
                                 </div> -->

                                 <input type="hidden" name="CodigoSubProducto" id="CodigoSubProducto">
                                 <input type="hidden" name="Lote" id="Lote">
                            </div>

                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label style="color:white">_</label>
                                <button type="button" class="btn btn-info form-control icon-download5" id="btnAgregar">

                                </button>
                            </div>


                        </div>


                    </div>




                </div>
            </div>
        </div>


    </div>

</div>

<div class="row">
  <div class="col-lg-6 col-xs-12">
    <div class="card my-0">
        <div class="card-header">
            <h6>Resumen</h6>
        </div>
        <div class="card-body">
            <div class="card-block">

                <div class="row" align="right">
                    <div class="col-md-6">
                      <div class="form-group">
                           <label for="TotalNota">Total</label>
                           <div class="input-group">
                              <span class="input-group-addon">$</span>
                             <input type="text" id="TotalNota" name="TotalNota" class="form-control" placeholder="Total" readonly/>
                           </div>
                      </div>
                    </div>
                    <div class="col-md-1">
                      <div class="form-group">
                          <label style="color:white">.</label>
                          <button type="button" class="btn btn-sm align-items-center" id="btnRecalcularTotales" onclick="RecalcularTotales()">
                            <i class="fa fa-refresh align-middle"></i>
                          </button>
                      </div>

                    </div>




                </div>
                <div class="row">
                  <div class="col-md-4">
                      <div class="form-group">
                          <label for="cb_FormaPago">Forma de Pago:</label>
                          <select id="cb_FormaPago" name="cb_FormaPago" class="form-control" required>

                          </select>

                      </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form.group">
                      <label for=""># Vaucher</label>
                      <input type="text" class="form-control" name="txtVaucher" id="txtVaucher" placeholder="# Vaucher">

                    </div>
                  </div>
                </div>
                <div class="row">

                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="montoPago">Monto Pago</label>
                        <div class="input-group">
                           <span class="input-group-addon">$</span>
                          <input type="text" id="montoPago" name="montoPago" class="form-control" placeholder="Monto" />
                        </div>
                    </div>

                  </div>

                    <div class="col-md-2">
                      <div class="form-group">
                        <label style="color:white">______</label>
                        <button type="button" class="form-control btn" name="button" id="btnAgregarPago">+</button>
                      </div>

                    </div>

                </div>
                <div class="row">
                  <div class="col-md-12">
                    <table class="table table-responsive" id="tblPagos">
                      <th>#</th>
                      <th>Forma</th>
                      <th>Vaucher</th>
                      <th>Monto</th>
                      <th>Eliminar</th>
                    </table>

                  </div>
                </div>
                <div class="row" align ="right">
                  <div class="col-md-4">
                    <div class="form-group">
                        <label for="resumenTotalPago">Total a Pagar</label>
                        <div class="input-group">
                           <span class="input-group-addon">$</span>
                          <input type="text" id="resumenTotalPago" name="resumenTotalPago" class="form-control" placeholder="Total" required readonly/>
                        </div>
                    </div>

                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                        <label for="resumenSaldoPendiente">Saldo Pendiente</label>
                        <div class="input-group">
                           <span class="input-group-addon">$</span>
                           <input type="text" id="resumenSaldoPendiente" name="resumenSaldoPendiente" class="form-control" placeholder="Total" readonly />
                        </div>
                    </div>

                  </div>

                </div>


                    <div class="row" align="right">
                        <div class ="col-md-4">
                            <div class="form-group">
                                <label>Requiere Factura</label>
                                <div class="input-group">
                                    <label class="display-inline-block custom-control custom-radio ml-1">
                                            <input type="radio" name="RequiereFactura" id="chkRequiereFactura" value="1" class="custom-control-input">
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description ml-0">Si</span>
                                    </label>
                                    <label class="display-inline-block custom-control custom-radio">
                                            <input type="radio" name="RequiereFactura" checked id ="chkRequiereFactura" value="0" class="custom-control-input">
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description ml-0">No</span>
                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row" align="right">
                      <div class="col-md-12">
                        <button type="submit" class="btn btn-warning mr-1" name="action" value="cerrar">
                          <i class="icon-cross2"></i> Cerrar
                        </button>

                        <button type="submit" class="btn btn-success" id="btnPagar" name="action" value='crear'>
                          <i class="icon-check2"></i> Pagar
                        </button>
                      </div>

                    </div>
                </div>
            </div>
        </div>

  </div>
</div>
</form>

<!------------------------------------------------------------MODALS--------------------------------------------------------------->

<!--MODAL NUEVO PACIENTE-->
<div class="modal fade" id="Modal_NuevoPaciente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h5 class="modal-title">Nuevo Paciente</h5>
            <input type="hidden" id="ModalLlamada_IdSeguimientoMedico" name="ModalLlamada_IdSeguimientoMedico">
            <input type="hidden" id="ModalLlamada_IdEstatusSeguimiento" name="ModalLlamada_IdEstatusSeguimiento">
            <input type="hidden" id="NumeroSeguimiento" name="NumeroSeguimiento">
        </div>
        <div class="modal-body">
                <input type="text" hidden="true" name="ModalIdPaciente" id="IdFamiliarResponsable"/>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="ModalNombre">Nombre</label>
                      <input type="text" name="ModalNombre" id="ModalNombre" class="form-control" placeholder="Nombre"/>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                        <label for="ModalApellidos">Apellidos</label>
                        <input type="text" name="ModalApellidos" id="ModalApellidos" class="form-control" placeholder="Apellidos"/>
                    </div>
                  </div>
                        <div class="col-md-4">
                                <div class="form-group">
                                        <label for="ModalSexo">Sexo</label>
                                        <select class="form-control" id="ModalSexo" name="ModalSexo">
                                          <option value="F">FEMENINO</option>
                                          <option value="M">MASCULINO</option>

                                        </select>

                                </div>
                        </div>
                </div>
          <div class="row">
                    <div class="col-md-4 col-xs-6">
                        <div class="form-group">
                            <label for="ModalFechaNacimiento">Fecha Nacimiento</label>
                            <div class="position-relative has-icon-left">
                                <input type="date" id="ModalFechaNacimiento" class="form-control" name="ModalFechaNacimiento" value="" onchange="CalcularEdad()"/>
                                <div class="form-control-position">
                                        <i class="icon-calendar5"></i>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-2 col-xs-6">
                        <div class="form-group">
                                <label for="ModalEdad">Edad</label>
                                <input type="text" name="ModalEdad" id ="ModalEdad" class="form-control" placeholder="Edad" readonly/>
                        </div>
                    </div>
                    <div class="col-md-3 col-xs-12">
                        <div class="form-group">
                            <label for="ModalCelular">Celular:</label>
                            <input type="text" id = "ModalCelular" name="ModalCelular" class="form-control" placeholder="Celular"/>
                        </div>
                    </div>



                </div>
          <h6 class="form-section">Facturación</h6>
          <div class="row">

                  <div class="col-md-5">

                    <div class="form-group">
                      <label for="ModalRFC">RFC</label>
                      <input type="text" name="ModalRFC" id="ModalRFC" class="form-control" placeholder="RFC"/>
                    </div>
                  </div>
                  <div class="col-md-5">
                    <div class="form-group">
                      <label for="Modalemail">email</label>
                      <input type="text" name="Modalemail" id="Modalemail" class="form-control" placeholder="email"/>
                    </div>
                  </div>
                </div>
          <h5 class="form-section"><i class="icon-clipboard4"></i> Dirección</h5>

          <!--DIRECCION-->
          <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="ModalDondeVive">Donde Vive:</label>
                    <select name="ModalDondeVive" id="ModalDondeVive" class="form-control" onchange="">
                        <option value="">Seleccione una opción</option>
                        <option value="1">Zona Urbana</option>
                        <option value="0">Zona Rural</option>

                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="ModalCalle">Calle</label>
                    <input type="text" name="ModalCalle" id="ModalCalle" class="form-control" placeholder="Calle"/>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="ModalColonia">Colonia</label>
                    <input type="text" name="ModalColonia" id="ModalColonia" class="form-control" placeholder="Colonia"/>
                </div>
            </div>
            <div class="col-md-2">
                        <div class="form-group">
                             <label for="ModalCP">Código Postal</label>
                            <input type="text" id="ModalCP" name="ModalCP" class="form-control" placeholder="C.P."/>
                        </div>
                    </div>
          </div>

          <!-- FORM ACTIONS-->
          <div class="modal-footer">
                    <button type="button" class="btn btn-warning mr-1" data-dismiss="modal">
                        <i class="icon-cross2"></i>Cerrar
                    </button>
                    <button type="button" class="btn btn-success mr-1" name="btnAgregarPaciente" id ="btnAgregarPaciente" onclick="AgregarNuevoPaciente()">
                        <i class="icon-check2"></i>Registrar
                    </button>
                </div>
        </div>
      </div>
    </div>
</div><!--MODAL NUEVO PACIENTE-->

<!--MODAL BUSCAR PRODUCTO-->
<div class="modal fade" id="Modal_BuscarProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h5 class="modal-title">Buscar Producto</h5>

        </div>
        <div class="modal-body">
          <h6 class="form-section">Facturación</h6>
          <table id="tbl_Productos" class="table table-striped table-bordered table-responsive" style="width:100%">
              <thead>

                  <tr>
                      <th>Id</th>
                      <th>Servicio</th>
                      <th>Descripción Prodcto</th>
                      <th>Costo</th>
                      <th></th>

                  </tr>
              </thead>
              <tbody>


              </tbody>

          </table>



        </div>
        <!-- FORM ACTIONS-->
        <div class="modal-footer">
            <button type="button" class="btn btn-warning mr-1" data-dismiss="modal">
                <i class="icon-cross2"></i>Cerrar
            </button>

        </div>

      </div>
    </div>
</div><!--MODAL BUSCAR PRODUCTO-->


<script type="text/javascript">
    $(document).ready(function(){
      CargarProductos();

      $(window).keydown(function(event){
        if(event.keyCode == 13) {
          event.preventDefault();
          return false;
        }
      });

        $("#btnPagar").attr("disabled","disabled");
        CargarFoliador();
        CargarTipoPago();

        $("#servicio").change(function(){

          var servicio_id = $('#servicio').val();

          if(servicio_id!='')
          {

              $.ajax({
                  url:"<?php echo site_url();?>/NotaMedica_Controller/ConsultarProductosPuntoVenta",
                  method:"POST",
                  data:{servicio_id:servicio_id},
                  success: function(data)
                    {
                        $('#producto').html(data);
                        $('#total').val(0);
                    }
              });

          }

       });
        // Lista Productos Evento: Change
        //Carga Información del producto seleccionado
        $('#cbProducto').change(function(){
            var producto_id = $('#cbProducto').val();
            if(producto_id!='')
            {
                $.ajax({
                    url: "<?php echo site_url();?>/NotaMedica_Controller/ConsultarProductoPorId",
                    method: "POST",
                    data:{producto_id:producto_id},
                    success: function(data)
                        {
                            var producto_detail = JSON.parse(data);
                            $('#SubtotalProducto').val(producto_detail['CostoProducto']);

                        }
                });


            }
        });

        //Agregar nueva fila a la tabla productos
        $('#btnAgregar').click(function(){



            var idServicio = $("#IdServicio").val();
            var idProducto =  $("#IdProducto").val();
            var Cantidad = $("#CantidadProducto").val();
            var PrecioProveedor = $("#PrecioProveedor").val();
            var descServicio = $("#DescripcionServicio").val();
            var EsProveedor = $("#EsProveedor").val();


            if (idProducto !="")
            {


            var descProducto = $("#DescripcionProducto").val();
            var TotalFilas = $('#tablaProductos tbody tr').length;
            var precio =$("#SubtotalProducto").val();


            var numFila = 0;

            if(TotalFilas <1)
            {
                numFila = 1;
            }
            else

            {
                numFila = parseInt(document.getElementById('tablaProductos').rows[TotalFilas].cells[0].innerHTML);
                numFila +=1;
            }



            var subtotal = parseFloat(precio) * parseFloat(Cantidad);

            if (!isNaN(subtotal))
            {
              $('#tablaProductos').append(
                     '<tr id=row'+numFila+'>'+
                     '<td>'+numFila+'</td>'+
                     '<td>'+
                         '<input type="hidden" value="'+idServicio+'">'+
                         '<input type="hidden" name="IdProductos[]" value="'+idProducto+'">'+
                         '<input type="hidden" name="CodigoSubProducto[]" value="">'+
                         '<input type="hidden" name="Lote[]" value="">'+
                         '<input type="hidden" class="form-control" name="subtotal[]" value="'+subtotal+'">'+
                         '<input type="hidden" class="form-control" name="precio[]" value="'+precio+'">'+
                         '<input type="hidden" class="form-control" name="cantidad[]" value="'+Cantidad+'">'+
                         '<input type="hidden" class="form-control" name="descuento[]" value="0">'+
                         '<input type="hidden" class="form-control" name="proveedor[]" value="'+EsProveedor+'">'+
                         '<input type="hidden" class="form-control" name="preciosproveedor[]" value="'+PrecioProveedor+'">'+
                         '<input type="hidden" class="form-control" name="descuento[]" value="0">'+
                         '<input type="hidden" name="IdEmpleado[]" value="">'+
                         descServicio+'</td>'+
                     '<td>'+descProducto+'</td>'+
                     '<td>'+precio+'</td>'+
                     '<td>'+Cantidad+'</td>'+
                     '<td>'+subtotal+'</td>'+
                     '<td data-row="row'+numFila+'"><button class="btn btn-sm btn-danger" onclick="EliminarProducto('+numFila+')" data-row="row'+numFila+'"><i class="icon-trash"></i></button></td>'+
                     //'<td data-row="row'+numFila+'"><a classs = "btn" onclick="BorrarCuentaProducto('+numFila+')" data-row="row'+numFila+'"><i class="icon-trash" data-toggle="tooltip" data-placement="top" id="EliminarProducto" title="Eliminar producto"> Eliminar</i></a></td>'+
                     '</tr>'
                     );
                 ActualizarTotalNota(subtotal);
                 CalcularTotalesNotaRemision();
                 HabilitarPago();

               $("#txtProducto").val("");
               $("#DescripcionProducto").val("");
               $("#CantidadProducto").val("");
               $("#SubtotalProducto").val("");
               $("#txtProducto").focus();
               $("#btnAgregar").attr("disabled","disabled");

            }





            }




        });

        $("#btnAgregarPago").click(function()
        {
          var txtFormaPago = $("#cb_FormaPago option:selected").html();
          var idFormaPago = $("#cb_FormaPago").val();

          var txtVaucher = $("#txtVaucher").val();
          var montoPago = $("#montoPago").val();

          var saldoPendiente = parseInt($("#resumenSaldoPendiente").val());
          var TotalAPagar = parseInt($("#resumenTotalPago").val());

          if (montoPago =="" || montoPago==null)
          {
            Swal.fire("Monto Invalido","Debes de indicar el monto del pago","error");
          }
          else {

            if (isNaN(TotalAPagar))
            {
              TotalAPagar=0;
            }


            var TotalFilasPagos = $('#tblPagos tbody tr').length;

            var numFilaPago = 0;

            if(TotalFilasPagos <=1)
            {
                numFilaPago = 1;
            }
            else

            {

                numFilaPago = parseInt(document.getElementById('tblPagos').rows[TotalFilasPagos-1].cells[0].innerHTML);
                numFilaPago +=1;
            }



             $('#tblPagos').append(
                    '<tr id=rowPago'+numFilaPago+'>'+
                    '<td>'+numFilaPago+'</td>'+
                    '<td>'+
                      '<input type="hidden" name="FormasPago[]" value="'+idFormaPago+'">'+
                      '<input type="hidden" name="Vauchers[]" value="'+txtVaucher+'">'+
                      '<input type ="hidden" name="MontosPago[]" value="'+montoPago+'">'+
                    txtFormaPago+'</td>'+
                    '<td>'+txtVaucher+'</td>'+
                    '<td>$'+montoPago+'</td>'+
                    '<td data-row="rowPago'+numFilaPago+'"><button type="button" class="btn btn-sm btn-danger" onclick="EliminarPago('+numFilaPago+')" data-row="row'+numFilaPago+'"><i class="icon-trash"></i></button></td>'
                    );


              TotalAPagar += parseInt(montoPago);

              $("#montoPago").val('');

              $("#resumenTotalPago").val(TotalAPagar);

              CalcularTotalesNotaRemision()

          }





        });
    });

    //INPUT AUTOCOMPLETE Productos
    var optionsProducto = {
        url: "<?php echo site_url();?>/CatalogoProductos_Controller/ConsultarProductosPuntoVenta",
        ajaxSettings: { dataType: "json", method: "POST", data: {IdFoliador:1} },
        getValue: function (element){
                        return "[" + element.DescripcionServicio +"]-" + element.DescripcionProducto ;
                    },
        template: {
            type: "custom",
            method: function(value, item){
                return "[" + item.DescripcionServicio +"]-" + item.DescripcionProducto  ;

            }
        },
        list: {
            maxNumberOfElements: 6,
            match:{
                enabled:true
            },

            onClickEvent: function(){
                Autocomplete_CargarDatosProducto();
            },

            onChooseEvent: function()
            {

              Autocomplete_CargarDatosProducto();
            }

        },
        theme: "plate-dark"
    };

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
                Autocomplete_CargarDatosPaciente();
            },

            onChooseEvent: function()
            {

              Autocomplete_CargarDatosPaciente();
            }

        },
        theme: "plate-dark"
    };

    $('#txtPaciente').easyAutocomplete(optionsNombre);

    $("#txtProducto").easyAutocomplete(optionsProducto);

    function Autocomplete_CargarDatosProducto() {
      var value = $("#txtProducto").getSelectedItemData().IdProducto;
     var DescripcionProducto = $("#txtProducto").getSelectedItemData().DescripcionProducto;
     var DescripcionServicio = $("#txtProducto").getSelectedItemData().DescripcionServicio;
     var CostoProducto = $("#txtProducto").getSelectedItemData().CostoProducto;
     var IdServicio =$("#txtProducto").getSelectedItemData().IdServicio;
     var PrecioProveedor =$("#txtProducto").getSelectedItemData().PrecioProveedor;
     var EsProveedor =$("#txtProducto").getSelectedItemData().Proveedor;

     $("#IdProducto").val(value);
     $("#DescripcionProducto").val(DescripcionProducto);
     $("#SubtotalProducto").val(CostoProducto)
     $("#IdServicio").val(IdServicio);
     $("#DescripcionServicio").val(DescripcionServicio);
     $("#PrecioProveedor").val(PrecioProveedor);
     $("#EsProveedor").val(EsProveedor);

     $("#CantidadProducto").val(1);
     $("#btnAgregar").removeAttr("disabled");

    }

    function Autocomplete_CargarDatosPaciente() {
      var value = $("#txtPaciente").getSelectedItemData().IdPaciente;
     var NombrePaciente = $("#txtPaciente").getSelectedItemData().Nombre +' '+ $("#txtPaciente").getSelectedItemData().Apellidos;
     var FechaNacimiento = new Date( $("#txtPaciente").getSelectedItemData().FechaNacimiento);
     var bdSexo = $("#txtPaciente").getSelectedItemData().Sexo;
     var sexo =" - ";
     if (bdSexo=="F")
     {
         sexo ="Femenino";
     }
     else
     {
         sexo = "Masculino";
     }

     $("#idPaciente").val(value);
     $("#lblNombrePaciente").html(NombrePaciente);
     HabilitarPago();
     $("#lblSexo").html(sexo);
     $("#lblFechaNacimiento").html(FechaNacimiento.toLocaleDateString());

     //ConsultarAdeudosPaciente();
     CalcularTotalesNotaRemision();
    }


     //Calcular el subtotal del producto seleccionado incluyendo el descuento
    function ActualizarTotalNota(subtotal)
    {
        var TotalNota=0;
        if($("#TotalNota").val()!=="")
        {
            TotalNota = parseFloat($("#TotalNota").val());
        }


        TotalNota = TotalNota + parseFloat(subtotal);
        $("#TotalNota").val(TotalNota);

        // var TotalAdeudo = 0;
        // if ($("#TotalAdeudo").val()!== "")
        // {
        //     TotalAdeudo = parseFloat($("#TotalAdeudo").val());
        // }

        // var TotalAPagar = TotalNota + TotalAdeudo;
        // $("#resumenTotalPago").val(TotalAPagar);

    }

    function EliminarProducto(index)
    {

        var Row = document.getElementById('row'+index);
        var Cell = Row.getElementsByTagName('td');

        document.getElementById("tablaProductos").deleteRow(Row.rowIndex);

        var Subtotal = parseFloat(Cell[3].innerText);
        Subtotal = Subtotal*-1;

        ActualizarTotalNota(Subtotal);
        CalcularTotalesNotaRemision();


    }
    function EliminarPago(index)
    {

        var Row = document.getElementById('rowPago'+index);
        var Cell = Row.getElementsByTagName('td');
        var montoPago = parseFloat(Cell[3].innerText.substring(1,Cell[3].innerText.length));

        document.getElementById("tblPagos").deleteRow(Row.rowIndex);

        var TotalAPagar = parseInt($("#resumenTotalPago").val());

        TotalAPagar -= montoPago;
        $("#resumenTotalPago").val(TotalAPagar);
        CalcularTotalesNotaRemision();


    }

    function CargarFoliador()
    {
      $.ajax({
          url: "<?php echo site_url();?>/CargaCatalogos_Controller/CargarFoliador_ajax",
          data:{
            ManejoInventario:0
          },
          method: "POST",
          success: function(data)
              {
                   $('#cbFoliador').html(data);
              }
      });

    }


    function CargarServiciosGrupo(sel)
    {
         var IdFoliador = sel.value;

        $.ajax({
            url: "<?php echo site_url();?>/CargaCatalogos_Controller/CargarServiciosPorFoliador_ajax",
            data: {
              IdFoliador: IdFoliador,
              Inventario: false
            },
            method: "POST",
            success: function(data)
                {
                     $('#cbServicio').html(data);
                     $('#IdFoliador').val(IdFoliador);

                }
        });

    }

    function CargarProductosPorServicio(servicio)
    {
        var IdServicio = servicio.value;

        $.ajax({
            url: "<?php echo site_url();?>/CargaCatalogos_Controller/CargarProductosPorServicio_ajax",
            data: {IdServicio: IdServicio},
            method: "POST",
            success: function(data)
                {
                     $('#cbProducto').html(data);
                     $('#cbFoliador').prop('disabled',true);

                }
        });
    }

    function CargarTipoPago()
 {
     $.ajax({
                  url:"<?php echo site_url();?>/NotaRemision_Controller/ConsultarTipoPago_ajax",
                  method:"POST",

                  success: function(data)
                    {
                        $('#cb_FormaPago').html(data);

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
                             $("#lblTotalAdeudos").html(totalAdeudoPaciente['TotalAdeudo']);
                            $("#TotalAdeudo").val(totalAdeudoPaciente['TotalAdeudo']);
                        }
                        else
                        {
                            $("#lblTotalAdeudos").html(0);
                            $("#TotalAdeudo").val(0);
                        }
                        CalcularTotalesNotaRemision();

                    }
                });
    }

 function CalcularTotalesNotaRemision()
 {
     var totalNota = 0;

     if ($("#TotalNota").val()!=="")
     {

        totalNota = $("#TotalNota").val();
     }
     var totalPagar=0;
     if($("#resumenTotalPago").val()!=="")
     {
         totalPagar = $("#resumenTotalPago").val();
     }



     var totalPendiente = 0;

     totalPendiente = parseFloat(totalNota)  - parseFloat(totalPagar);

     $("#resumenSaldoPendiente").val(totalPendiente);
     $("#montoPago").val(totalPendiente);

 }

 $("#resumenTotalPago").on('change keyup',function(){
     CalcularTotalesNotaRemision();
 });


 function HabilitarPago() {
   var Paciente = $("#idPaciente").val();
   var TotalNota = $("#TotalNota").val();


   if (Paciente!== "" && TotalNota !== "")
   {

     $("#btnPagar").removeAttr('disabled');

   }

 }
 function RecalcularTotales()
 {
   var Total=0;
   $('input[name^="subtotal"]').each(function(){
   Total = Total + parseFloat($(this).val());
  });


  $("#TotalNota").val(parseFloat(Total));

  CalcularTotalesNotaRemision();

 }

 function AbrirModalNuevoPaciente()
 {
   $("#ModalNombre").val();
   $("#Modalemail").val();
   $("#ModalFechaNacimiento").val();
   $("#ModalSexo").val('F');
   $("#ModalRFC").val();
   $("#ModalApellidos").val();
   $("#ModalCelular").val();
   $("#ModalDondeVive").val();
   $("#ModalCalle").val();
   $("#ModalColonia").val();
   $("#ModalCP").val();


   $("#Modal_NuevoPaciente").modal('show');
 }

 function AgregarNuevoPaciente()
 {
   $.ajax({
      type: "POST",
      url: "<?php echo site_url();?>/NotaRemision_Controller/AgregarPaciente_ajax",
      data:{
        'NombrePaciente': $("#ModalNombre").val(),
        'ApellidosPaciente': $("#ModalApellidos").val(),
        'Sexo': $("#ModalSexo").val(),
        'RFCPaciente': $("#ModalRFC").val(),
        'emailPaciente': $("#Modalemail").val(),
        'FechaNacimientoPaciente': $("#ModalFechaNacimiento").val(),
        'DondeVivePaciente': $("#ModalDondeVive").val(),
        'callePaciente': $("#ModalCalle").val(),
        'TelefonoPaciente': $("#ModalCelular").val(),
        'CP': $("#ModalCP").val(),
        'Colonia':$("#ModalColonia").val()
      },
      method:"POST",
      success: function(data)
      {
        var result = JSON.parse(data);

        if (result!== false) {
          Swal.fire({
              title:'El Paciente ha sido registrado',
              type: 'success',
              showConfirmButton: true
          });
          var NombrePaciente = result['Nombre']+ ' '+ result['Apellidos'];

          $("#txtPaciente").val(NombrePaciente);
          $("#idPaciente").val(result['IdPaciente']);
          $("#lblNombrePaciente").html(NombrePaciente);
          $("#lblFechaNacimiento").html(result['FechaNacmiento']);
          if (result['Sexo']=='F') {
              $("#lblSexo").html('FEMENINO');
          }
          else {
            $("#lblSexo").html('MASCULINO');
          }
          HabilitarPago();

          $("#Modal_NuevoPaciente").modal('hide');
        }






      }
    });

 }
 function CalcularEdad()
 {
     edad = CalcularEdad($("#ModalFechaNacimiento").val());
     $("#ModalEdad").val(edad);
 }


 function CalcularEdad(FechaNacimiento)
 {
     var hoy = new Date();
     var cumpleanos = new Date(FechaNacimiento);
     var edad = hoy.getFullYear() - cumpleanos.getFullYear();
     var m = hoy.getMonth() - cumpleanos.getMonth();

     if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
         edad--;
     }

     return edad;
 }

 function HabilitarPago() {
   var Paciente = $("#idPaciente").val();
   var TotalNota = $("#TotalNota").val();


   if (Paciente!== "" && TotalNota !== "")
   {

     $("#btnPagar").removeAttr('disabled');

   }

 }
 function RecalcularTotales()
 {
   var Total=0;
   $('input[name^="subtotal"]').each(function(){
   Total = Total + parseFloat($(this).val());
  });


  $("#TotalNota").val(parseFloat(Total));

  CalcularTotalesNotaRemision();



 }

 //MODAL BUSCAR Productos
 function LoadModal_BuscarProducto()
 {

   $("#Modal_BuscarProducto").modal('show');
 }

 function CargarProductos()
 {

     var t = $('#tbl_Productos').DataTable({
    "ajax":{
        url:"<?php echo site_url();?>/CatalogoProductos_Controller/ConsultarProductosPuntoVenta",
        method:"POST",
        data:{
            IdFoliador:1
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
         "type": 'currency',"targets":3, "render": function(data,type,row,meta)

                {
                    return "$"+(parseFloat(data)).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');

                }
        },
        {
            "targets":4, "render": function(data,type,row,meta)

                {
                    return '<a classs = "btn" onclick="SeleccionarProducto('+data+',\''+row['DescripcionProducto']+'\','+row['CostoProducto']+','+row['IdServicio']+',\''+row['DescripcionServicio']+'\','+row['PrecioProveedor']+','+row['Proveedor']+')"><i class="icon-fast-forward2" data-toggle="tooltip" data-placement="top" id="SeleccionarProducto" title="Seleccionar"></i></a>';
                    //return '<a classs = "btn" onclick="SeleccionarProducto('+data+',\''+row['DescripcionProducto']+'\','+row['CostoProducto']+','+row['IdServicio']+',\''+row['DescripcionServicio']+'\')"><i class="icon-fast-forward2" data-toggle="tooltip" data-placement="top" id="SeleccionarProducto" title="Seleccionar"></i></a>';
                }
          },
          {
            "targets":[5], "visible":false
          }
          ],

      "columns": [

            { "data": "IdProducto" },
            { "data": "DescripcionServicio" },
            { "data": "DescripcionProducto" },
            { "data": "CostoProducto"},
            {"data":"IdProducto", "width": "20%"},
            {"data":"Proveedor"}
            ]

    });

 }

 function SeleccionarProducto(IdProducto,DescripcionProducto,CostoProducto,IdServicio,DescripcionServicio,PrecioProveedor,Proveedor)
 {
   $("#IdProducto").val(IdProducto);
   $("#DescripcionProducto").val(DescripcionProducto);
   $("#SubtotalProducto").val(CostoProducto)
   $("#IdServicio").val(IdServicio);
   $("#DescripcionServicio").val(DescripcionServicio);
   $("#PrecioProveedor").val(PrecioProveedor);
   $("#EsProveedor").val(Proveedor);
   //
   $("#CantidadProducto").val(1);
   $("#btnAgregar").removeAttr("disabled");
    $("#Modal_BuscarProducto").modal('hide');


 }


</script>
