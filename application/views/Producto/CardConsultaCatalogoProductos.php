<style>

    td.details-control {
        background: url(<?php echo base_url('/app-assets/images/datatables/resources/details_open.png');?>) no-repeat center center;
        cursor: pointer;
    }
    tr.shown td.details-control {
        background: url(<?php echo base_url('/app-assets/images/datatables/resources/details_close.png');?>) no-repeat center center;
    }
    th { font-size: 14px; }
    td { font-size: 13px; }
</style>
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
                                        <th></th>
                                        <th>Id</th>
                                        <th>Descripción Producto</th>
                                        <th>$ Publico</th>
                                        <th>$ Proveedor</th>
                                        <th>Habilitado</th>
                                        <th>Tipo Producto</th>
                                        <th>Receta</th>
                                        <th>Editar</th>

                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>

                            </table>

                            <!--MODAL EDITAR PRODUCTO-->
                            <?php echo form_open('CatalogoProductos_Controller/GuardarProducto'); ?>
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
                                            <div class='col-md-2'>
                                                <div class='form-group'>
                                                    <label for="Modal_IdProducto">Id. Producto:</label>
                                                    <input type='text' id='Modal_IdProducto' class='form-control' name='Modal_IdProducto' readonly/>
                                                    <input type="hidden" name="EsProveedor" id="EsProveedor" value="">
                                                </div>
                                            </div>
                                             <div class='col-md-8'>
                                                <div class='form-group'>
                                                    <label for="Modal_Descripcion">Descripción:</label>
                                                    <input type='text' id='Modal_Descripcion' class='form-control' name='Modal_Descripcion' />
                                                </div>
                                             </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-md-4">
                                                  <div class="form-group">
                                                          <label for="CostoProducto">Precio Publico</label>
                                                          <div class="input-group">
                                                          <span class="input-group-addon">$</span>
                                                          <input type="text" id="Modal_CostoProducto" class="form-control square" placeholder="Costo" aria-label="Costo" name="Modal_CostoProducto">
                                                          <input type="hidden" name="CostoProducto_ANT" id= "CostoProducto_ANT" value="">
                                                  </div>
                                                  </div>
                                          </div>
                                          <div class="col-md-4">
                                                  <div class="form-group">
                                                          <label for="PrecioProveedor">Precio Proveedor</label>
                                                          <div class="input-group">
                                                          <span class="input-group-addon">$</span>
                                                          <input type="text" id="Modal_PrecioProveedor" class="form-control square" placeholder="Costo" aria-label="Costo" name="Modal_PrecioProveedor" disabled>


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
                                                          <label for="PrecioClinica">Precio Clinica</label>
                                                          <div class="input-group">
                                                          <span class="input-group-addon">$</span>
                                                          <input type="text" id="Modal_PrecioClinica" class="form-control square" placeholder="Costo" aria-label="Costo" name="Modal_PrecioClinica" disabled>
                                                          <input type="hidden" id ="IdCuentaMaestra" name="IdCuentaMaestra">
                                                          <input type="hidden" name="PrecioClinica_Ant" id= "PrecioClinica_Ant" value="">

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
                                                    <label>Monto Pendiente</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">$</span>
                                                        <input type="text" id="Modal_MontoPorAsignar" class="form-control square" placeholder="%" aria-label="Porcentaje" name="Modal_MontoPorAsignar" value="0" readonly>

                                                    </div>

                                                </div>


                                            </div>
                                            <div class="col-md-4 col-xs-4">
                                              <div class='form-group'>
                                                  <label>Monto Asignado</label>
                                                  <div class="input-group">
                                                      <span class="input-group-addon">$</span>
                                                      <input type="text" id="Modal_MontoEnCuentas" class="form-control square" placeholder="%" aria-label="Porcentaje" name="Modal_MontoEnCuentas" value="0" readonly>

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
                                                        <th>%</th>
                                                        <th>Monto</th>
                                                        <th>Eliminar</th>
                                                    </tr>

                                                </thead>
                                                <tbody>

                                                </tbody>

                                            </table>
                                        </div>

                                    </div>
                                    <div class="modal-footer">

                                    <button type="button" class="btn btn-warning mr-1" data-dismiss="modal">
                                            <i class="icon-cross2"></i>Cerrar
                                        </button>

                                        <button type="submit" class="btn btn-success mr-1" name="action" value="GuardarProducto" >
                                            <i class="icon-edit"></i>Guardar
                                        </button>

                                </div>
                                    </div>
                                </div>
                            </div>
                        </form><!--FORM MODAL-->
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

            if(isNaN(parseFloat(IdCuenta)))
            {
              alert("Seleccione una cuenta para asignar");
            }
            else {

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

              var CostoProducto =  parseFloat($("#Modal_CostoProducto").val());
              var MontoAsignar = parseFloat($("#MontoAsignado").val());
              var MontoEnCuentas = parseFloat($("#Modal_MontoEnCuentas").val());

              var PorcentajeCuenta =  MontoAsignar / CostoProducto;
              var MontoPorAsignar = parseFloat($("#Modal_MontoPorAsignar").val());

             if (MontoAsignar <= MontoPorAsignar)
              {

                  $('#tblCuentasProducto').append(
                      '<tr id="row'+numFila+'">'+
                      '<td>'+numFila+'</td>'+
                      '<td><input type="hidden" name="IdCuentaProducto[]" value="'+IdCuenta+'"><input type="hidden" name="PorcentajeProducto[]" value="'+PorcentajeCuenta+'">'+DescripcionCuenta+'</td>'+
                      '<td>'+PorcentajeCuenta*100+'</td>'+
                      '<td>'+MontoAsignar+'</td>'+

                      '<td data-row="row'+numFila+'"><a classs = "btn" onclick="BorrarCuentaProducto('+numFila+')" data-row="row'+numFila+'"><i class="icon-trash" data-toggle="tooltip" data-placement="top" id="EliminarCuenta" title="Eliminar cuenta"> Eliminar</i></a></td>'+
                      '</tr>'
                      );

              MontoPorAsignar -= MontoAsignar;
              MontoEnCuentas += MontoAsignar;

              $("#Modal_MontoPorAsignar").val(MontoPorAsignar);
              $("#Modal_MontoEnCuentas").val(MontoEnCuentas);


              }
              else
              {
                  alert('No puedes asignar mas del disponible por asignar');
              }
          }

        });

        $('#tblCatalogoProductos tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var t = $("#tblCatalogoProductos").DataTable();
            var row = t.row( tr );

            if ( row.child.isShown() ) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            }
            else {
                // Open this row
                row.child( LoadRowDetail(row.data()) ).show();
                tr.addClass('shown');
            }
        } );

        $("#Modal_CostoProducto").change(function(){
          var EsProveedor = $("#EsProveedor").val();

          var PrecioPublico = isNaN(parseFloat($("#Modal_CostoProducto").val()))?0:parseFloat($("#Modal_CostoProducto").val());
          var PrecioPublicoANT = isNaN(parseFloat($("#CostoProducto_ANT").val()))?0:parseFloat($("#CostoProducto_ANT").val());
          var MontoEnCuentas = isNaN(parseFloat($("#Modal_MontoEnCuentas").val()))?0:parseFloat($("#Modal_MontoEnCuentas").val());
          var PrecioClinica = isNaN(parseFloat($("#Modal_PrecioClinica").val()))?0:parseFloat($("#Modal_PrecioClinica").val());
          var PrecioClinicaANT = isNaN(parseFloat($("#PrecioClinica_Ant").val()))?0:parseFloat($("#PrecioClinica_Ant").val());

          if (EsProveedor)
          {
            var PrecioProveedor = isNaN(parseFloat($("#Modal_PrecioProveedor").val()))?0:parseFloat($("#Modal_PrecioProveedor").val());

            if (PrecioProveedor <= PrecioPublico)
            {
              $("#Modal_PrecioClinica").val(PrecioPublico);
              $("#PorcentajeCuentaMaestra").val(1);

            }
            else {
              alert("No puedes reducir el precio publio menos que el precio proveedor");
              $("#Modal_CostoProducto").val(PrecioPublicoANT);

            }



          }
          else {

            var MontoAsignar = PrecioPublico-(MontoEnCuentas+PrecioClinica);

            if (MontoAsignar >=0)
            {
                var PorcentajeCuentaMaestra = PrecioClinica / PrecioPublico;


                $("#Modal_MontoPorAsignar").val(MontoAsignar);
                $("#CostoProducto_ANT").val(PrecioPublicoANT);
                $("#PorcentajeCuentaMaestra").val(PorcentajeCuentaMaestra);

            }
            else {

              $("#Modal_CostoProducto").val(PrecioPublicoANT);

            }

          }







        });

        $("#Modal_PrecioClinica").change(function(){


          var PrecioPublico = isNaN(parseFloat($("#Modal_CostoProducto").val()))?0:parseFloat($("#Modal_CostoProducto").val());
          var PrecioPublicoANT = isNaN(parseFloat($("#CostoProducto_ANT").val()))?0:parseFloat($("#CostoProducto_ANT").val());
          var MontoEnCuentas = isNaN(parseFloat($("#Modal_MontoEnCuentas").val()))?0:parseFloat($("#Modal_MontoEnCuentas").val());
          var PrecioClinica = isNaN(parseFloat($("#Modal_PrecioClinica").val()))?0:parseFloat($("#Modal_PrecioClinica").val());
          var PrecioClinicaANT = isNaN(parseFloat($("#PrecioClinica_Ant").val()))?0:parseFloat($("#PrecioClinica_Ant").val());
          var MontoAsignar = PrecioPublico-(MontoEnCuentas+PrecioClinica);


          if (MontoAsignar >=0)
          {
            var PorcentajeCuentaMaestra = PrecioClinica / PrecioPublico;


              $("#Modal_MontoPorAsignar").val(MontoAsignar);
              $("#CostoProducto_ANT").val(PrecioPublicoANT);
              $("#PorcentajeCuentaMaestra").val(PorcentajeCuentaMaestra);

          }
          else {

            $("#Modal_PrecioClinica").val(PrecioClinicaANT);

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

    function CargarTipoProductos()
    {
        $.ajax({
                  url:"<?php echo site_url();?>/CatalogoProductos_Controller/ConsultarTipoProductos_ajax",
                  method:"POST",

                  success: function(data)
                    {
                        $('#cbTipoProducto').html(data);
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
                 "type": 'currency',"targets":3, "render": function(data,type,row,meta)

                        {
                            return "$"+(parseFloat(data)).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');

                        }
                },
                {
                 "type": 'currency',"targets":4, "render": function(data,type,row,meta)

                        {
                            var PrecioProveedor = isNaN(parseFloat(data))?0:parseFloat(data);
                            return "$"+(PrecioProveedor).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');

                        }
                },
                {
                    "targets":8, "render": function(data,type,row,meta)

                        {
                            return '<a classs = "btn" onclick="OpenModal_EditarProducto('+data+')"><i class="icon-pencil2" data-toggle="tooltip" data-placement="top" id="EditarProducto" title="Editar Producto"> Editar</i></a>';

                        }
                  },
                  {"targets":5, "render": function(data,type,row,meta)
                        {
                            if (data=='1')
                            {
                                return "HABILITADO";
                            }
                            else
                            {
                                return "DESHABILITADO";
                            }


                        }},
                        {"targets":7,"render":function(data,type,row,meta)
                          {
                            if(data==1)
                            {
                              return "REQ. RECETA";
                            }
                            else {
                              return "";
                            }

                          }
                        }

                      ],

              "columns": [
                    {
                        "className":      'details-control',
                        "orderable":      false,
                        "data":           null,
                        "defaultContent": ''
                    },
                    { "data": "IdProducto" },
                    { "data": "DescripcionProducto" },
                    { "data": "CostoProducto"},
                    { "data": "PrecioProveedor"},
                    { "data": "Habilitado" },
                    {"data":"DescripcionTipoProducto"},
                    {"data":"RequiereReceta"},
                    {"data":"IdProducto", "width": "20%"}
                    ]

            });
         }

     }

     function BorrarCuentaProducto(index)
    {

        var Row = document.getElementById('row'+index);
        var Cell = Row.getElementsByTagName('td');
        var MontoEnCuentas = parseFloat($("#Modal_MontoEnCuentas").val());

            document.getElementById("tblCuentasProducto").deleteRow(Row.rowIndex);

            var MontoCuenta = parseFloat(Cell[3].innerText);
            var MontoPorAsignar=isNaN(parseFloat($("#MontoPorAsignar").val()))? 0:parseFloat($("#MontoPorAsignar").val());

           MontoPorAsignar += MontoCuenta;
           MontoEnCuentas -= MontoCuenta;

            $("#Modal_MontoPorAsignar").val(MontoPorAsignar);
            $("#Modal_MontoEnCuentas").val(MontoEnCuentas);
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
                $("#CostoProducto_ANT").val(Producto['CostoProducto']);

                if (Producto['EsProveedor']==1)
                {
                  $("#EsProveedor").val(1);
                  $("#Modal_PrecioProveedor").removeAttr('disabled');
                  $("#Modal_PrecioProveedor").val(Producto['PrecioProveedor']);
                  $("#Modal_PrecioClinica").attr('disabled', 'disabled');

                }
                else {
                  $("#EsProveedor").val(0);
                  $("#Modal_PrecioProveedor").attr('disabled', 'disabled');
                  $("#Modal_PrecioProveedor").val(0);
                  $("#Modal_PrecioClinica").removeAttr('disabled');
                }



                if(Producto['Habilitado']== '1')
                {
                    $("#Modal_chkHabilitado").prop("checked",true);
                }
                CargarCuentas();
                CargarTipoProductos();
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

              var MontoEnCuentas = 0;

                for (var i=0; i<CuentasProducto.length; i++)
                {
                  var CostoProducto = parseFloat($("#Modal_CostoProducto").val());
                  var PorcentajeProducto = parseFloat(CuentasProducto[i]['PorcentajeCuenta']);
                  var CuentaMaestra = CuentasProducto[i]['CuentaMaestra'];
                  var MontoCuenta = CostoProducto * PorcentajeProducto;


                  if (CuentaMaestra ==1)
                  {
                    $('#txtCuentaMaestra').val(CuentasProducto[i]['DescripcionCuenta']);
                    $("#IdCuentaMaestra").val(CuentasProducto[i]['IdCuenta']);
                    $("#PorcentajeCuentaMaestra").val(PorcentajeProducto);
                    $("#Modal_PrecioClinica").val(MontoCuenta);
                    $("#PrecioClinica_Ant").val(MontoCuenta);

                  }
                  else {
                    $('#tblCuentasProducto').append(
                        '<tr id="row'+numFila+'">'+
                        '<td>'+numFila+'</td>'+
                        '<td><input type="hidden" name="IdCuentaProducto[]" value="'+CuentasProducto[i]['IdCuenta']+'"><input type="hidden" name="PorcentajeProducto[]" value="'+CuentasProducto[i]['PorcentajeCuenta']*100+'">'+CuentasProducto[i]['DescripcionCuenta']+'</td>'+
                        '<td>'+(CuentasProducto[i]['PorcentajeCuenta']*100)+'</td>'+
                        '<td>'+MontoCuenta+'</td>'+

                        '<td data-row="row'+numFila+'"><a classs = "btn" onclick="BorrarCuentaProducto('+numFila+')" data-row="row'+numFila+'"><i class="icon-trash" data-toggle="tooltip" data-placement="top" id="EliminarCuenta" title="Eliminar cuenta"> Eliminar</i></a></td>'+
                        '</tr>');

                        PorcentajeAsignado += parseFloat(CuentasProducto[i]['PorcentajeCuenta'])*100;
                        MontoEnCuentas += MontoCuenta;

                  }



                }

                $("#Modal_MontoEnCuentas").val(MontoEnCuentas);



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

    function LoadRowDetail ( d ) {

      var div = $('<div/>')
            .addClass( 'loading' )
            .text( 'Loading...' );


        $.ajax({
          url: '<?= site_url()?>/CatalogoProductos_Controller/ConsultarCuentasProducto_ajax',
          type: 'POST',

          data: {IdProducto: d.IdProducto}
        })
        .done(function(data) {

          var CuentasProducto = JSON.parse(data);
          var output='<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
                          '<th>Cuenta</th>'+
                          '<th>%</th>'+
                          '<th>Monto</th>';
                          //'<th></th>';


          for (i=0; i<CuentasProducto.length;i++)
          {
            var CostoProducto = parseFloat(d.CostoProducto);
            var Porcentaje = parseFloat(CuentasProducto[i]['PorcentajeCuenta']);
            var MontoProducto = CostoProducto*Porcentaje;



            output +='<tr>'+
                      '<td>'+CuentasProducto[i]['DescripcionCuenta']+'</td>'+
                      '<td>'+Porcentaje*100+'</td>'+
                      '<td>'+MontoProducto+'</td>'+
                      //'<td><a classs = "btn" onclick="BorrarCuentaProducto('+d.IdProducto+')"><i class="icon-pencil2" data-toggle="tooltip" data-placement="top" id="CambiarCuentasProducto" title="Cambiar Cuentas"> </i></a></td>'+
                    '</tr>';

          }
          output += '</table>';

          div.html(output);
          div.removeClass('loading');

          console.log(output);
        })
        .fail(function() {
          console.log("error");
        });



        return div;
    }
</script>
