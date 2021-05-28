<style>
    .inputNombrePaciente{
         width: 300px;
    }
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
                    <h4 class="card-title" id="basic-layout-form">Catalogo De Servicios</h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-2"></i></a>
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


                            <table id="tblServicios" class="table table-striped table-bordered table-responsive" style="width:100%">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th></th>
                                        <th>Id</th>
                                        <th>Descripcion Servicios</th>
                                        <th>Color</th>
                                        <th>Agenda</th>
                                        <th>Inventario</th>
                                        <th>Servicio</th>
                                        <th>Habilitado</th>
                                        <th>Acciones</th>

                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>
            </div><!--DIV CARD-->
        </div><!--DIV COL-MD-->
</div><!--DIV ROW MATCH-->

<!----------------MODALS-->
<!--MODAL EDITAR SERVICIO-->
<div class="modal fade" tabindex="-1" role="dialog" id="ModalEditarServicio" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-body" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <button onclick="cerrar('#ModalEditarServicio')" type="button" class="close" id="CancelarModalEditarServicio">&times;</button>
            <h5 class="modal-title" id="actualizarModalLabel">Editar Servicio</h5>
        </div>
        <div class="modal-body">

            <div class="col-md-3">
                <div class="form-group">
                    <label for="IdServicio">Id Servicio</label>
                    <input type="text" id="IdServicio" class="form-control"  name="IdServicio" readonly>
                </div>
            </div>

          <div class="row">
            <div class="col-md-6">
              <fieldset class="form-group">
                <label for="txtDescripcionServicio">Descripcion Servicio</label>
                <input type="text" class="form-control" id="txtDescripcionServicio" name="Descripcion Servicio" placeholder="Descripcion Servicio">
                <input type="hidden" name="DescripcionServicio" id="DescripcionServicio">
              </fieldset>
            </div>
            <div class="col-md-6">
              <fieldset class="form-group">
                <label for="txtCodigoColorServicio">Codigo De Color</label>
                <input type="text" class="form-control" id="txtCodigoColorServicio" name="CodigoColorServicio" placeholder="Codigo Del Color">
              </fieldset>
            </div>

            <div class="col-md-1 col-xs-12">
              <fieldset class="form-group">
                <label for="txtServicioHabilitado">Hábilitado</label>
                <input type="checkbox" class="form-control" name="ServicioHabilitado" id="ServicioHabilitado">
              </fieldset>
            </div>

          </div>

          <div class="row">
            <div class="col-md-1 col-xs-12">
              <fieldset class="form-group">
                <label for="txtManejoAgenda">Agenda</label>
                <input type="checkbox" class="form-control" name="ManejoAgenda" id="ManejoAgenda">
              </fieldset>
            </div>
            
            <div class="col-md-1 col-xs-12">
              <fieldset class="form-group">
                <label for="txtManejoInventario">Inventario</label>
                <input type="checkbox" class="form-control" name="ManejoInventario" id="ManejoInventario">
              </fieldset>
            </div>
          
          </div>
          
          <div class="row">

              <div class="col-md-6 col-xs-12">
                  <div class="form-group">
                      <label for="cbGrupoServicio">Grupo Servicio</label>
                      <select name="cbGrupoServicio" id="cbGrupoServicio" class="form-control">
                          <option value="">GrupoServicio</option>

                      </select>
                  </div>
              </div>


          </div>
          <h4 class="form-section"><i class="icon-clipboard4"></i> Clínicas</h4>

          <div class="row">
            <div class="col-md-12">
              <table class="table-striped table-bordered" id="tblSucursalServicio" name="tblSucursalServicio">
                <thead>
                  <th></th>
                  <th>Id</th>
                  <th>Clínica</th>

                </thead>
                <tbody>



                </tbody>

              </table>

            </div>

          </div>

        </div>


        <div class="modal-footer">
            <button id="ModalbtnCancelarNota" type="button" onclick="ActualizarServicio()" class="btn btn-success">Confirmar</button>
            <button id="CancelarModalCancelarNota" onclick="cerrar('#ModalEditarServicio')" type="button" class="btn btn-warning">Cancelar</button>
        </div>
        </div>
    </div>
</div>
<!--MODAL HORARIO SERVICIO--->

<div class="modal fade" tabindex="-1" role="dialog" id="ModalHorarioServicio" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-body" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <button onclick="cerrar('#ModalHorarioServicio')" type="button" class="close" id="CancelarModalHorarioServicio">&times;</button>
            <h5 class="modal-title" id="actualizarModalLabel">Horario Servicio</h5>
        </div>
        <div class="row">
          <div class="col-md-6 col-xs-12">
            <div class="form-group">
              <label for="cbClinica">Clinica</label>
                <select name="cbClinica" id="cbClinica" class="form-control">
                  <option value="">Clinica</option>
                </select>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 col-xs-12">
            <div class="form-group">
              <label for="cbDiaSemana">Dia de la Semana</label>
                <select name="cbDiaSemana" id="cbDiaSemana" class="form-control">
                  <option value="">Selecciona un Dia</option>
                </select>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 col-xs-12">
            <div class="form-group">
              <label for="cbHoraInicio">Hora Inicio</label>
                <select name="cbHoraInicio" id="cbHoraInicio" class="form-control">
                  <option value="">Hora Fin</option>
                </select>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 col-xs-12">
            <div class="form-group">
              <label for="cbHoraFin">Hora Fin</label>
                <select name="cbHoraFin" id="cbhoraFin" class="form-control">
                  <option value="">Hora Fin</option>
                </select>
            </div>
          </div>
        </div>
</div>

<script type="text/javascript">
    //input autocomplete Nombre

    $(document).ready(function() {
        CargarCatalogoServicios();
        CargarGruposServicio();


        // Add event listener for opening and closing details

        // $("#tbl_SeguimientoPacientes tbody").on('click','a.btnEditarSeguimiento',(e)=>{
        //   e.preventDefault();
        //   alert('click');
        //   var $this =$(this);
        //
        //   console.log($this.data('id'));
        // });
        $('#tblServicios tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var t = $("#tblServicios").DataTable();
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

} );

function CargarCatalogoServicios()
{
    var t = $('#tblServicios').DataTable({
      "drawCallback": function( settings ) {
              $('[data-toggle="tooltip"]').tooltip();
            },
        "ajax":{
            url:"<?php echo site_url();?>/Servicio_Controller/ConsultarCatalogoServicios_ajax",

            method:"POST",
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
          "autoWidth":true,
          "columnDefs":[
            {"targets": 8, "render":function(data,type,row,meta){

              var btnAgregarPago="";

              var btnCancelarNota="";
              var btnVerNotaRemision="";
              btnAgregarPago=' <button type="button" style="border-radius: 200px" class="btn btn-blue btn-sm" onclick="OpenModal_HorarioServicio('+data+')"><i class="icon-clock" data-toggle="tooltip" data-placement="top" id="AgregarPago" title="Horario Servicio"></i></button>';
              btnCancelarNota = ' <button type="button" style="border-radius: 200px" class="btn btn-green btn-sm" onclick="OpenModal_EditarServicio('+data+')"><i class="icon-pencil" data-toggle="tooltip" data-placement="top" id="CancelarNota" title="Editar Servicio"></i></button>';

              return btnAgregarPago+btnCancelarNota;//+ btnVerNotaRemision;

            }},
            
            {"targets": 7, "render":function(data,type,row,meta){

              var Habilitado;

              if (data=='0')
              {
                return "DESHABILITADO";
              }
              else{
                return "HABILITADO";
              }



            }},
            {"targets": 5, "render":function(data,type,row,meta){

              var InventarioHabilitado;

              if (data=='0')
              {
                return "DESHABILITADO";
              }
              else{
                return "HABILITADO";
              }



            }},
            {"targets": 4, "render":function(data,type,row,meta){

              var AgendaHabilitado;

              if (data=='0')
              {
                return "DESHABILITADO";
              }
              else{
                return "HABILITADO";
              }



            }}

          ],
          "columns": [
                {
                    "className":      'details-control',
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": ''
                },
                { "data": "IdServicio"},
                { "data": "DescripcionServicio" },
                { "data": "CodigoColorServicio" },
                { "data": "ManejoAgenda" },
                { "data": "ManejoInventario" },
                { "data": "DescripcionGrupoServicio" },
                { "data": "Habilitado" },
                { "data": "IdServicio" }
                

                ]

        });

}
function LoadRowDetail ( d ) {
    // `d` is the original data object for the row
    var div = $('<div/>')
          .addClass( 'loading' )
          .text( 'Loading...' );


      $.ajax({
        url: '<?= site_url()?>/Servicio_Controller/ConsultarClinicasServicio_ajax',
        data:{IdServicio:d.IdServicio},
        type: 'POST'


      })
      .done(function(data) {

        var ClinicasServicio = JSON.parse(data);
        var output ='<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
                        '<th>Clinicas</th>';

        for (i=0; i<ClinicasServicio.length;i++)
        {

          output +='<tr>'+
                    '<td>'+ClinicasServicio[i]['NombreClinica']+'</td>'+
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

//MODAL DE EDITAR USUARIO
//
function OpenModal_EditarServicio(IdServicio) {

  $.ajax({
    url:"<?php echo site_url();?>/Servicio_Controller/ConsultarServicioPorId",
    data:{IdServicio:IdServicio},
    method:"POST",
    dataSrc: ""

  })
  .done(function(data) {
    var Servicio = JSON.parse(data);
    $("#IdServicio").val(Servicio['IdServicio']);
    $("#txtDescripcionServicio").val(Servicio['DescripcionServicio']);
    $("#txtCodigoColorServicio").val(Servicio['CodigoColorServicio']);
    $("#cbGrupoServicio").val (Servicio['IdGrupoServicio']);
    $("#ManejoAgenda").prop('checked',false);
    $("#ManejoInventario").prop('checked',false);
    $("#ServicioHabilitado").prop('checked',false);

    if (Servicio['Habilitado']==1)
    {
      $("#ServicioHabilitado").prop('checked',true);
    }

    if (Servicio['ManejoAgenda']==1)
    {
      $("#ManejoAgenda").prop('checked',true);
    }

    if (Servicio['ManejoInventario']==1)
    {
      $("#ManejoInventario").prop('checked',true);
    }

    CargarClinicas(Servicio['IdServicio']);

  })
  .fail(function() {
    console.log("error");
  });


  $("#ModalEditarServicio").modal('show');

}

function cerrar(Ventana)
{

   $(Ventana).modal('hide');
   //limpiar();
}

///
///MODAL DE HORARIO SERVICIO
///
function OpenModal_HorarioServicio(IdServicio) {

$.ajax({
  url:"<?php echo site_url();?>/Servicio_Controller/ConsultarHorarioServicioPorId",
  data:{IdServicio:IdServicio},
  method:"POST",
  dataSrc: ""

})
.done(function(data) {
  var Horario = JSON.parse(data);
  $("#IdHorarioServicio").val(Horario['IdHorarioServicio']);
  $("#IdServicio").val(Horario['IdServicio']);
  $("#IdClinica").val(Horario['IdClinica']);
  $("#DiaSemana").val (Horario['DiaSemana']);
  $("#HoraInicio").val (Horario['HoraInicio']);
  $("#HoraFin").val (Horario['HoraFin']);

  CargarClinicas(Servicio['IdServicio']);

})
.fail(function() {
  console.log("error");
});


$("#ModalHorarioServicio").modal('show');

}

function cerrar(Ventana)
{

 $(Ventana).modal('hide');
 //limpiar();
}


  function CargarClinicas(IdServicio) {

    var t = $('#tblSucursalServicio').DataTable({
      "drawCallback": function( settings ) {
              $('[data-toggle="tooltip"]').tooltip();
            },
        "ajax":{
            url:"<?php echo site_url();?>/Servicio_Controller/CargarCatalogoClinicasServicio_ajax",
            data: {
              IdServicio:IdServicio
              },
            method:"POST",
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
          "autoWidth":true,
          "columnDefs":[

            {
              "targets":0,"data":"IdClinica","render":function(data,type,row,meta)
              {
                  var checked;

                  if (row['IdServicio']!== null)
                  {
                    checked = "checked=true";
                  }
                  return '<input type="checkbox" class="form-control" name="ClinicasServicio" value="'+data+'" '+checked+'>';

              }

            }

          ],
          "columns": [
                { "data": "IdClinica"},
                { "data": "IdClinica" },
                { "data": "NombreClinica" }


                ]
        });



  }

  function CargarGruposServicio()
  {
       $.ajax({
                url:"<?php echo site_url();?>/CargaCatalogos_Controller/CargarGruposServicio_ajax",
                method:"POST",

                success: function(data)
                  {
                      $('#cbGrupoServicio').html(data);



                  }
            });
  }
  
  function ActualizarServicio()
  {

    var IdServicio = $("#IdServicio").val();
    var DescripcionServicio= $("#txtDescripcionServicio").val();
    var CodigoColorServicio= $("#txtCodigoColorServicio").val();
    var IdGrupoServicio=$("#cbGrupoServicio").val();
    var ManejoAgenda= 0;
    var ManejoInventario = 0;
    var Habilitado =0;
    var clinicas=[];
    
    $("input[name='ClinicasServicio']:checked").each(function(){
      //alert(this.value);
            clinicas.push(this.value);
        });
    if ($("#ServicioHabilitado").is(":checked"))
    {
      Habilitado = 1;
    }
    if ($("#ManejoInventario").is(":checked"))
    {
      ManejoInventario = 1;
    }
    if ($("#ManejoAgenda").is(":checked"))
    {
      ManejoAgenda = 1;
    }
    
    $.ajax({
      url: '<?=site_url('Servicio_Controller/ActualizarServicio_ajax')?>',
      type: 'POST',
      data: {
        IdServicio: IdServicio,
        DescripcionServicio: DescripcionServicio,
        CodigoColorServicio: CodigoColorServicio,
        ManejoAgenda: ManejoAgenda,
        ManejoInventario: ManejoInventario,
        IdGrupoServicio:IdGrupoServicio,
        Habilitado:Habilitado,
        Clinicas:clinicas
      }
    })
    .done(function() {
      Swal.fire({
          title:'Genial',
          text: 'El servicio ha sido actualizado',
          type: 'success',

      });

    })
    .fail(function() {
      Swal.fire({
          title:'Oops...',
          text:'Hubo un error al actualizar el servicio',
          type: 'error',

      });
    })
    .always(function(){
        $("#ModalEditarServicio").modal('hide');

    });

  }

//
</script>
