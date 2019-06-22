<!--easy Autocomplete-->
<script src="<?php echo base_url();?>assets/easyautocomplete/jquery.easy-autocomplete.min.js" ></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/easyautocomplete/easy-autocomplete.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/easyautocomplete/easy-autocomplete.themes.min.css">

<style>


    .inputNombrePaciente{
         width: 100%;
    }
    .table th {
        font-size: 13px;
        padding: 7px;}
    .table td {
        font-size:12px;

        padding: 7px;}
    td.block
        {
        border: 1px solid black;
        }

</style>

<?php echo form_open('NotaRemision_Controller/RegistrarNotaRemision');?>
<div class="row">

    <div class="col-lg-4 col-xs-12">

        <!-- PACIENTE -->
        <div class="card my-4">

          <div class="card-body">
              <div class="card-block">
                  <div class="form-body">
                      <div class="row">
                        <div class="col-md-10 col-xs-12">
                              <div class="form-group">
                                  <input type="hidden" class="form-control" id="idPaciente" name="idPaciente"  readonly="readonly"/>
                                  <label>Paciente</label>
                                  <input type="text" class="inputNombrePaciente form-control" id="txtPaciente" required placeholder="Buscar" />
                              </div>
                            </div>
                          <div class="col-md-2">
                              <button type="button" class="btn btn-sm btn-success" onclick="AbrirModalNuevoPaciente()"><i class="icon-plus"></i></button>
                          </div>

                      </div>
                      <div class="row">
                          <div class="col-md-3 col-xs-3">
                              <img src="<?php echo base_url();?>app-assets/images/portrait/small/paciente50.png" alt="avatar">
                          </div>
                          <div class="col-md-9 col-xs-9">
                              <b><label id="lblNombrePaciente" style="font-size: 16px"></label></b>
                          </div>

                      </div>
                      <div class="row">
                          <div class="col-md-3">

                          </div>
                          <div class="col-md-7" style="font-size: 11px">

                              <label id="lblFechaNacimiento" ></label> | <label id="lblSexo"></label> | <a href="#"><i class="icon-pencil"></i></a>
                          </div>
                          <div class ="col-md-2">

                          </div>

                      </div>
                       <div class="row">
                          <div class="col-md-3">

                          </div>
                          <div class="col-md-7" style="font-size: 11px">

                              Total Adeudos: $<label id="lblTotalAdeudos" ></label>  <a href="#"><i class="icon-note"></i></a>
                          </div>
                          <div class ="col-md-2">

                          </div>

                      </div>
                  </div>
              </div>

          </div>
        </div>

        <!-- ULTIMAS NOTAS -->
        <div class="card my-4">
          <div class="card-header">
            <h6 >Ultimas Notas</h6>
          </div>
          <div class="card-body">
              <div class="card-block">
                  <!--FORM BODY-->
                  <div class="form-body">
                      The styling for this basic card example is created by using default Bootstrap utility classes. By using utility classes, the style of the card component can be easily modified with no need for any custom CSS!
                  </div>
              </div>

          </div>
        </div>

    </div>
    <div class="col-lg-5 col-xs-12">
        <!--SERVICIOS NOTA-->
        <div class="card my-4">
            <div class="card-header">
                <h6>Nota Remisión</h6>
            </div>
            <div class="card-body">
                <div class="card-block">

                    <p class="card-text">Agrega los servicios brindados al paciente<br></p>
                    <div class="row">

                        <div class="col-md-12 col-xs-12">
                            <div class="form-group">
                                <label for="ModalLlamada_cbGrupoServicio">Grupo</label>
                                <select name="ModalLlamada_cbGrupoServicio" id="ModalLlamada_cbGrupoServicio" class="form-control" onchange="CargarServiciosGrupo(this)" >
                                    <option value="">Grupo</option>

                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="row">

                        <div class="col-md-12 col-xs-12">
                            <div class="form-group">
                                <label for="cbServicio">Servicio</label>
                                <select name="cbServicio" id="cbServicio" class="form-control" onchange="CargarProductosPorServicio(this)">
                                    <option value="">Servicios</option>

                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <div class="form-group">
                                <label for="cbProducto">Producto</label>
                                <select name="cbProducto" id="cbProducto" class="form-control"  >
                                    <option value="">Productos</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row  match-height">
                        <div class="col-md-5 col-xs-4   ">
                            <div class="form-group">
                                 <label for="SubtotalProducto">Total</label>
                                 <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                   <input type="text" id="SubtotalProducto" name="SubtotalProducto" class="form-control" placeholder="Total" readonly/>
                                 </div>
                            </div>

                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label></label>
                                <button type="button" class="btn btn-primary form-control icon-download5" id="btnAgregar">

                                </button>
                            </div>


                        </div>


                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-responsive my-0" id="tablaProductos">
                                    <thead>
                                        <tr>
                                            <th >#</th>
                                            <th >Servicio</th>
                                            <th >Producto</th>
                                            <th >Subtotal</th>
                                            <th >Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>

                        </div>


                    </div>



                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-xs-12">
        <!--RESUMEN NOTA-->
        <div class="card my-0">
            <div class="card-header">
                <h6>Resumen</h6>
            </div>
            <div class="card-body">
                <div class="card-block">
                    <div class="row" align="right">
                        <div class="col-md-3">

                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                 <label for="TotalNota">Total</label>
                                 <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                   <input type="text" id="TotalNota" name="TotalNota" class="form-control" placeholder="Total" readonly/>
                                 </div>
                            </div>
                        </div>

                    </div>
                    <div class="row" align="right">
                        <div class="col-md-3">

                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="TotalAdeudo">Total Adeudos</label>
                                <div class="input-group">
                                   <span class="input-group-addon">$</span>
                                  <input type="text" id="TotalAdeudo" name="TotalAdeudo" class="form-control" placeholder="Total" readonly/>
                                </div>
                            </div>
                        </div>
                    </div>
                     <div class="row" align="right">
                            <div class ="col-md-3">

                            </div>
                             <div class="col-md-9">
                                 <div class="form-group">
                                     <label for="resumenTotalPago">Total a Pagar</label>
                                     <div class="input-group">
                                        <span class="input-group-addon">$</span>
                                       <input type="text" id="resumenTotalPago" name="resumenTotalPago" class="form-control" placeholder="Total" />
                                     </div>
                                 </div>
                             </div>
                        </div>
                        <div class="row" align="right">
                            <div class ="col-md-3">


                            </div>
                             <div class="col-md-9">
                                 <div class="form-group">
                                     <label for="resumenSaldoPendiente">Saldo Pendiente</label>
                                     <div class="input-group">
                                        <span class="input-group-addon">$</span>
                                        <input type="text" id="resumenSaldoPendiente" name="resumenSaldoPendiente" class="form-control" placeholder="Total" readonly />
                                     </div>
                                 </div>
                             </div>
                        </div>
                    <div class="row" align ="right">

                             <div class="col-md-12">
                                 <div class="form-group">
                                     <label for="cb_FormaPago">Forma de Pago:</label>
                                     <select id="cb_FormaPago" name="cb_FormaPago" class="form-control" required>

                                     </select>

                                 </div>
                             </div>


                        </div>
                        <div class="row" align="right">
                            <div class ="col-md-9">
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

                            <button type="submit" class="btn btn-success" name="action" value='crear'>
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


<script type="text/javascript">
    $(document).ready(function(){

        CargarGruposServicio();
        CargarTipoPago();

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



            var idServicio = $("#cbServicio").val();
            var idProducto =  $("#cbProducto").val();

            if (idProducto !="")
            {
            var descServicio = $("#cbServicio option:selected").html();

            var descProducto = $("#cbProducto option:selected").html();
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

            var subtotal = $("#SubtotalProducto").val();

             $('#tablaProductos').append(
                    '<tr id=row'+numFila+'>'+
                    '<td>'+
                        '<input type="hidden" value="'+idServicio+'">'+
                        '<input type="hidden" name="IdProducto[]" value="'+idProducto+'">'+
                        '<input type="hidden" name="CodigoSubProducto[]" value="">'+
                        '<input type="hidden" name="Lote[]" value="">'+
                        '<input type="hidden" class="form-control" name="subtotal[]" value="'+subtotal+'">'+
                        '<input type="hidden" class="form-control" name="precio[]" value="'+subtotal+'">'+
                        '<input type="hidden" class="form-control" name="cantidad[]" value="1">'+
                        '<input type="hidden" class="form-control" name="descuento[]" value="0">'+
                        '<input type="hidden" name="IdEmpleado[]" value="">'+
                        +numFila+'</td>'+
                    '<td>'+descServicio+'</td>'+
                    '<td>'+descProducto+'</td>'+
                    '<td>'+subtotal+'</td>'+
                    '<td data-row="row'+numFila+'"><button class="btn btn-sm btn-danger" onclick="EliminarProducto('+numFila+')" data-row="row'+numFila+'"><i class="icon-trash"></i></button></td>'+
                    //'<td data-row="row'+numFila+'"><a classs = "btn" onclick="BorrarCuentaProducto('+numFila+')" data-row="row'+numFila+'"><i class="icon-trash" data-toggle="tooltip" data-placement="top" id="EliminarProducto" title="Eliminar producto"> Eliminar</i></a></td>'+
                    '</tr>'
                    );
                ActualizarTotalNota(subtotal);

                 $('#cbProducto').val('');
                 $('#SubtotalProducto').val('');

            }




        });
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
                $("#lblSexo").html(sexo);
                $("#lblFechaNacimiento").html(FechaNacimiento.toDateString("es-ES","dd/M/YYYY"));
                ConsultarAdeudosPaciente();
                CalcularTotalesNotaRemision();



            },

            onChooseEvent: function()
            {
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
                $("#lblSexo").html(sexo);
                $("#lblFechaNacimiento").html(FechaNacimiento.toLocaleDateString());

                ConsultarAdeudosPaciente();
                CalcularTotalesNotaRemision();


            }

        },
        theme: "plate-dark"
    };

    $('#txtPaciente').easyAutocomplete(optionsNombre);

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

        var TotalAdeudo = 0;
        if ($("#TotalAdeudo").val()!== "")
        {
            TotalAdeudo = parseFloat($("#TotalAdeudo").val());
        }

        var TotalAPagar = TotalNota + TotalAdeudo;
        $("#resumenTotalPago").val(TotalAPagar);

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

    function CargarGruposServicio()
    {

        $.ajax({
            url: "<?php echo site_url();?>/CargaCatalogos_Controller/CargarGruposServicio_ajax",
            method: "POST",
            success: function(data)
                {
                     $('#ModalLlamada_cbGrupoServicio').html(data);
                }
        });

    }

    function CargarServiciosGrupo(sel)
    {
         var IdGrupo = sel.value;

        $.ajax({
            url: "<?php echo site_url();?>/CargaCatalogos_Controller/CargarServiciosPorGrupo_ajax",
            data: {IdGrupo: IdGrupo},
            method: "POST",
            success: function(data)
                {
                     $('#cbServicio').html(data);
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

     var totalAdeudos = 0;
     if($("#TotalAdeudo").val()!=="")
     {
         totalAdeudos = $("#TotalAdeudo").val();
     }

     var totalPendiente = 0;

     totalPendiente = parseFloat(totalNota) + parseFloat(totalAdeudos) - parseFloat(totalPagar);

     $("#resumenSaldoPendiente").val(totalPendiente);
 }

 $("#resumenTotalPago").on('change keyup',function(){
     CalcularTotalesNotaRemision();
 });

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
          $("#lblNombrePaciente").html(result['FechaNacimiento']);
          if (result['Sexo']=='F') {
              $("#lblSexo").html('FEMENINO');
          }
          else {
            $("#lblSexo").html('MASCULINO');
          }


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
</script>
