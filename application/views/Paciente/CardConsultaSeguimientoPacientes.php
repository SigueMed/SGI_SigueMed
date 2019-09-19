<!--easy Autocomplete-->
<script src="<?php echo base_url();?>assets/easyautocomplete/jquery.easy-autocomplete.min.js" ></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/easyautocomplete/easy-autocomplete.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/easyautocomplete/easy-autocomplete.themes.min.css">



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
                    <h4 class="card-title" id="basic-layout-form">Seguimiento Pacientes</h4>
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
                                        <button type="button" class="btn btn-primary btn-sm" onclick="ShowModalNuevoSeguimiento()">Nuevo Seguimiento</button>
                                    </div>

                                </div>

                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-xs-12">
                                  <button type="button" class="btn btn-secondary" id="btnCitasHoy"onclick="CargarSeguimientoPacientes(1)">
                                      <i class="icon-spinner11"></i> Todos
                                  </button>
                                    <button type="button" class="btn btn-secondary" id="btnCitasHoy"onclick="CargarSeguimientoPacientes(2)">
                                        <i class="icon-calendar3"></i> Hoy
                                    </button>
                                    <button type="button" class="btn btn-secondary" id="btnCitasSemana" onclick="CargarSeguimientoPacientes(3)">
                                        <i class="icon-close-round"></i> Cerrados
                                    </button>
                                    <button type="button" class="btn btn-secondary" id="btnCitasTodas" onclick="CargarSeguimientoPacientes(4)">
                                        <i class="icon-phone-hang-up"></i> En Seguimiento
                                    </button>

                               </div>
                            </div>

                            <table id="tbl_SeguimientoPacientes" class="table table-striped table-bordered table-responsive" style="width:100%">
                                <thead>
                                    <tr>
                                        <th colspan="7">Seguimiento</th>
                                        <th colspan="7">Llamadas Seguimiento</th>
                                        <th rowspan ="2"></th>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <th>Prioridad</th>
                                        <th>Paciente</th>
                                        <th>Teléfono</th>
                                        <th>Seguimiento</th>
                                        <th>Servicio</th>
                                        <th>Fecha Seguimiento</th>
                                        <th>Estatus</th>

                                        <th>Primera</th>
                                        <th>Fecha </th>
                                        <th>Segunda</th>
                                        <th>Fecha </th>
                                        <th>Tercera</th>
                                        <th>Fecha </th>



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

<!--MODAL Editar Seguimiento-->
<div class="modal fade" tabindex="-1" role="dialog" id="ModalEditarSeguimiento" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-body" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Editar Seguimiento <b><label id="lblNumSeguimiento" name ="NumSeguimiento"></label></b></h5>
          <input type="hidden" class="IdSeguimiento" id="ModalEditar_IdSeguimientoMedico" name="IdSeguimientoMedico">
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-8">
            <b><label class="form-group" id="ModalEditar_lblNombrePaciente" style="font-size: 16px"></label></b>
          </div>
        </div>
        <div class="row">
          <div class="col-md-8">
            <b><label class="form-group" id="ModalEditar_lblDescripcionServicio" style="font-size: 16px"></label></b>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="ModalEditar_Seguimiento">Seguimiento</label>
              <input type="textarea" id="ModalEditar_Seguimiento" class="form-control" name="txtSeguimiento">
            </div>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning mr-1" data-dismiss="modal">
            <i class="icon-cross2"></i>Cerrar
        </button>

        <button type="button" class="btn btn-success mr-1" onclick="ActualizarSeguimiento()">
            <i class="icon-edit"></i>Guardar
        </button>
      </div>
    </div>
  </div>
</div>
<!--MODAL Editar Seguimiento-->


<!--MODAL FechaConfirmación-->
<?php echo form_open('Seguimiento_Controller/ActualizarSeguimiento'); ?>
  <div class="modal fade" tabindex="-1" role="dialog" id="ModalLlamada" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-body" role="document">
      <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h5 class="modal-title">Llamada Seguimiento <b><label id="NumSeguimiento" name ="NumSeguimiento"></label></b></h5><br>
          <label id="DescServicio" for=""></label>
          <input type="hidden" id="ModalLlamada_IdSeguimientoMedico" name="ModalLlamada_IdSeguimientoMedico">
          <input type="hidden" id="ModalLlamada_IdEstatusSeguimiento" name="ModalLlamada_IdEstatusSeguimiento">
          <input type="hidden" id="NumeroSeguimiento" name="NumeroSeguimiento">
      </div>
      <div class="modal-body">
          <div class = "row">
              <div class="col-md-8">
                  <div class="form-group">
                      <label for="ModalLlamada_FechaLlamada">Fecha Llamada:</label>
                      <div class="position-relative has-icon-left">
                          <input type="date" id="ModalLlamada_FechaLlamada" class="form-control" name="ModalLlamada_FechaLlamada"/>
                          <div class="form-control-position">
                              <i class="icon-calendar5"></i>
                          </div>
                      </div>

                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-md-12">
                  <div class="form-group">
                      <label for="ModalLlamada_cbRespuestaLlamada">Respuesta:</label>
                      <select name="ModalLlamada_cbRespuestaLlamada" id="ModalLlamada_cbRespuestaLlamada" class="form-control" onchange="">
                          <option value="">Respuestas...</option>

                      </select>
                  </div>
              </div>
          </div>
          <div class="row">

              <div class="col-md-12">
                  <div class="form-group">
                      <label for="ModalLamada_Comentarios">Comentarios</label>
                      <div class="position-relative has-icon-left">
                              <textarea id="ModalLamada_Comentarios" rows="3" class="form-control" name="ModalLamada_Comentarios" placeholder="Comentarios"></textarea>
                              <div class="form-control-position">
                                      <i class="icon-file2"></i>
                              </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-md-12">
                  <div class="form-group">
                      <label for="ModalLlamada_cbEstatusSeguimiento">Estatus:</label>
                      <select name="ModalLlamada_cbEstatusSeguimiento" id="ModalLlamada_cbEstatusSeguimiento" class="form-control" onchange="">
                          <option value="">Seleccione un estatus</option>
                          <option value="2">Volver a llamar</option>
                          <option value="3">Terminar Seguimiento</option>
                          <option value="4">Rechazado por paciente</option>
                          <option value="5">Cancelar Seguimiento</option>

                      </select>
                  </div>
              </div>
          </div>
          <div class = "row">
              <div class="col-md-8">
                  <div class="form-group">
                      <label for="ModalLlamada_FechaSigLlamada">Fecha Sig. Llamada:</label>
                      <div class="position-relative has-icon-left">
                          <input type="date" id="ModalLlamada_FechaSigLlamada" class="form-control" name="ModalLlamada_FechaSigLlamada" required="required"/>
                          <div class="form-control-position">
                              <i class="icon-calendar5"></i>
                          </div>
                      </div>

                  </div>
              </div>
          </div>

      </div>
      <div class="modal-footer">

          <button type="button" class="btn btn-warning mr-1" data-dismiss="modal">
                  <i class="icon-cross2"></i>Cerrar
              </button>

              <button type="submit" class="btn btn-success mr-1" name="action" value="GuardarSeguimiento" >
                  <i class="icon-edit"></i>Guardar
              </button>

      </div>
      </div>
  </div>
  </div>
</form> <!--MODAL FORM-->
<!--MODAL ModalNuevoSeguimiento-->
<?php echo form_open('Seguimiento_Controller/AgregarNuevoSeguimiento'); ?>
  <div class="modal fade" tabindex="-1" role="dialog" id="ModalNuevoSeguimiento" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-content" role="document">
      <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h5 class="modal-title">Nuevo Seguimiento</h5>

      </div>
      <div class="modal-body">
          <div class="row">

              <div class="form-group col-md-10 col-xs-12">
                      <input type="hidden" class="form-control" id="idPaciente" name="idPaciente"  readonly="readonly"/>
                      <label>Paciente</label>
                      <input type="text" class="inputNombrePaciente form-control" id="txtPaciente" required="required" placeholder="Buscar" />
              </div>


          </div>
          <div class="row">
              <div class="col-md-3 col-xs-3">
                  <img src="<?php echo base_url();?>app-assets/images/portrait/small/paciente50.png" alt="avatar">
              </div>
              <div class="col-md-9 col-xs-9">
                  <b><label class="form-group" id="lblNombrePaciente" style="font-size: 16px"></label></b>
              </div>

          </div>
          <div class="row">
              <div class="col-md-9">
                  <div class="form-group">
                      <label for="ModalSeguimiento_cbGrupoServicio">Grupo Servicios</label>
                      <select name="ModalSeguimiento_cbGrupoServicio" id="ModalSeguimiento_cbGrupoServicio" class="form-control" onchange="CargarServiciosGrupo(this)">
                          <option value="">Grupos de Servicios</option>

                      </select>
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-md-9">
                  <div class="form-group">
                      <label for="ModalSeguimiento_cbServicio">Servicio</label>
                      <select name="IdServicio" id="ModalSeguimiento_cbServicio" class="form-control" required="required">
                          <option value="">Servicios</option>

                      </select>
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-md-12">
                  <div class="form-group">
                          <label for="DescripcionSeguimiento">Seguimiento</label>
                          <input type="text" name="DescripcionSeguimiento" id="DescripcionSeguimiento" class="form-control" placeholder="Descripción Seguimiento" required="required"/>
                  </div>
              </div>
          </div>
              <div class="row">
                  <div class="col-md-3">
                      <div class="form-group">
                              <label for="diasSeguimiento">días</label>
                              <input type="text" name="diasSeguimiento" id="diasSeguimiento" class="form-control" placeholder="Días" value ="3" onchange="EstablecerFechaSeguimiento(this.value)"/>
                      </div>
                  </div>
                  <div class="col-md-5">
                      <div class="form-group">
                          <label for="FechaSeguimiento">Fecha Seguimiento</label>
                          <div class="position-relative has-icon-left">
                              <input type="date" id="FechaSeguimiento" class="form-control" name="FechaSeguimiento" value="" required="required"/>
                              <div class="form-control-position">
                                      <i class="icon-calendar5"></i>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                        <label for="cbPrioridadSeguimiento">Prioridad</label>
                        <select   name="cbPrioridadSeguimiento" id="cbPrioridadSeguimiento" class="form-control" required="required">
                            <option value=1>Alta </option>
                            <option value=2 selected>Media</option>
                            <option value=3>Baja</option>

                        </select>
                    </div>

                  </div>
              </div>
          </div>
      <div class="modal-footer">

          <button type="button" class="btn btn-warning mr-1" data-dismiss="modal">
                  <i class="icon-cross2"></i>Cerrar
              </button>

              <button type="submit" class="btn btn-success mr-1" name="action" value="AgregarSeguimiento" >
                  <i class="icon-edit"></i>Guardar
              </button>

      </div>
      </div>
    </div>
  </div>
</form> <!--MODAL FORM-->

<script type="text/javascript">
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

                $("#idPaciente").val(value);
                $("#lblNombrePaciente").html(NombrePaciente);



            },

            onChooseEvent: function()
            {
                 var value = $("#txtPaciente").getSelectedItemData().IdPaciente;

                var NombrePaciente = $("#txtPaciente").getSelectedItemData().Nombre +' '+ $("#txtPaciente").getSelectedItemData().Apellidos;

                $("#idPaciente").val(value);
                $("#lblNombrePaciente").html(NombrePaciente);




            }

        },
        theme: "plate-dark"
    };

    $('#txtPaciente').easyAutocomplete(optionsNombre);




    $(document).ready(function() {

        CargarSeguimientoPacientes(1);

        // Add event listener for opening and closing details

        // $("#tbl_SeguimientoPacientes tbody").on('click','a.btnEditarSeguimiento',(e)=>{
        //   e.preventDefault();
        //   alert('click');
        //   var $this =$(this);
        //
        //   console.log($this.data('id'));
        // });
        $('#tbl_SeguimientoPacientes tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var t = $("#tbl_SeguimientoPacientes").DataTable();
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

function CargarSeguimientoPacientes(TipoConsulta)
{
    var t = $('#tbl_SeguimientoPacientes').DataTable({
        "ajax":{
            url:"<?php echo site_url();?>/Seguimiento_Controller/ConsultarSeguimientoPacientes_ajax",
            data:{TipoConsulta:TipoConsulta},
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
            {"targets": 14, "render":function(data,type,row,meta){
              return '<a id="linkEditar" href="#" onclick="EditarSeguimiento('+data+',\''+row['NombrePaciente']+'\',\''+row['DescripcionServicio']+'\',\''+row['DescripcionSeguimiento']+'\')"><i class="icon-edit2"></i></a>'+
                    '<a id="linkEliminar" href="#" onclick="EliminarSeguimiento('+data+')"><i class="icon-trash2"></i></a>';
            }},
            {"targets":1, "render":function(data,type,row,meta){

              switch (data) {
                case '1':
                  return '<i class="fa fa-flag red"></i> Alta';
                  break;
                case '2':
                  return '<i class="fa fa-flag yellow"></i> Media';
                  break;
                case '3':
                  return '<i class="fa fa-flag green"></i> Baja';
                  break;
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
                { "data": "Prioridad"},
                { "data": "NombrePaciente" },
                { "data": "NumCelular" },
                { "data": "DescripcionSeguimiento" },
                { "data": "DescripcionServicio" },
                { "data": "FechaSeguimiento" },
                { "data": "DescripcionEstatusSeguimiento" },
                { "data": "Respuesta1" },
                { "data": "FechaRespuesta_1" },
                { "data": "Respuesta2" },
                { "data": "FechaRespuesta_2" },
                { "data": "Respuesta3" },
                { "data": "FechaRespuesta_3" },
                { "data": "IdSeguimientoMedico" }
                ]

        });

}
function LoadRowDetail ( d ) {
    // `d` is the original data object for the row
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
        '<tr>'+
            '<td colspan="2">Elaborado Por:</td>'+
            '<td colspan="2">'+d.NombreElaboradoPor+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Llamada:</td>'+
            '<td>#1</td>'+
            '<td>#2</td>'+
            '<td>#3</td>'+
        '</tr>'+
        '<tr>'+
          '<td>Respuesta</td>'+
          '<td>'+d.Respuesta1+'</td>'+
          '<td>'+d.Respuesta2+'</td>'+
          '<td>'+d.Respuesta3+'</td>'+
        '</tr>'+
        '<tr>'+
          '<td>Fecha llamada:</td>'+
          '<td>'+d.FechaRespuesta_1+'</td>'+
          '<td>'+d.FechaRespuesta_2+'</td>'+
          '<td>'+d.FechaRespuesta_3+'</td>'+
        '</tr>'+
        '<tr>'+
          '<td>Realizada por:</td>'+
          '<td>'+d.NombreEmpleado_1+'</td>'+
          '<td>'+d.NombreEmpleado_2+'</td>'+
          '<td>'+d.NombreEmpleado_3+'</td>'+
        '</tr>'+
        '<tr>'+
          '<td>Comentarios:</td>'+
          '<td>'+d.Respuesta_1+'</td>'+
          '<td>'+d.Respuesta_2+'</td>'+
          '<td>'+d.Respuesta_3+'</td>'+
        '</tr>'+
    '</table>';
}
function ConfirmarSeguimientoPaciente(IdSeguimientoMedico, IdEstatusSeguimiento, NumeroSeguimiento, NombrePaciente, DescripcionServicio)
    {

        $('#ModalLlamada_IdSeguimientoMedico').val(IdSeguimientoMedico);
        $('#ModalLlamada_IdEstatusSeguimiento').val(IdEstatusSeguimiento);
        $('#DescServicio').html(DescripcionServicio);
        $('#NumeroSeguimiento').val(NumeroSeguimiento);
        $("#NumSeguimiento").html(NombrePaciente);
        var fecha = new Date();
        var mes = fecha.getMonth()+1;
        var dia = fecha.getDate();
        var ano = fecha.getFullYear();
        if(dia<10)
            dia='0'+dia;
        if(mes<10)
            mes='0'+mes;

        var hoy = ano+"-"+mes+"-"+dia;
        $('#ModalLlamada_FechaLlamada').val(hoy);

        fecha.setDate(fecha.getDate()+parseInt(3));

        var d = fecha.getDate();
        if (d<10)
        {
            d= '0'+d;
        }
        var m =  parseInt(fecha.getMonth())+1;
        if (m <10)
         {
             m = '0'+m;
         }

         if (NumeroSeguimiento >= 3)
         {
           document.getElementById('ModalLlamada_FechaSigLlamada').style.visibility = 'hidden';

         }
         else {
           document.getElementById('ModalLlamada_FechaSigLlamada').style.visibility = 'visible';
         }



        $("#ModalLlamada_FechaSigLlamada").val(fecha.getFullYear()+'-'+m+'-'+d);
        LimpiarModalLlamadas();
        CargarRespuestas();
        $("#ModalLlamada").modal('show');
    }

  function CargarRespuestas()
  {
       $.ajax({
                url:"<?php echo site_url();?>/Seguimiento_Controller/CargarRespuestas_ajax",
                method:"POST",
                success: function(data)
                  {

                      $('#ModalLlamada_cbRespuestaLlamada').html(data);


                  }
            });
  }

  function LimpiarModalLlamadas()
  {
      $('#ModalLamada_Comentarios').val();

  }

  function ShowModalNuevoSeguimiento()
  {
       CargarGruposServicio('#ModalSeguimiento_cbGrupoServicio');
       EstablecerFechaSeguimiento(3);
      $("#ModalNuevoSeguimiento").modal('show');
  }

  function EditarSeguimiento(IdSeguimiento,NombrePaciente,DescripcionServicio,Seguimiento) {

    CargarGruposServicio('#ModalEditar_cbGrupoServicio');
    $("#lblNumSeguimiento").html(IdSeguimiento);
    $("#ModalEditar_lblNombrePaciente").html(NombrePaciente);
    $("#ModalEditar_lblDescripcionServicio").html(DescripcionServicio);
    $("#ModalEditar_IdSeguimientoMedico").val(IdSeguimiento);
    $("#ModalEditar_Seguimiento").val(Seguimiento);
    $("#ModalEditarSeguimiento").modal('show');

  }

  function ActualizarSeguimiento() {

    var IdSeguimiento = $("#ModalEditar_IdSeguimientoMedico").val();
    var NuevaDescripcion = $("#ModalEditar_Seguimiento").val();
    $.ajax({
      url: '<?=site_url('Seguimiento_Controller/EditarSeguimiento_ajax')?>',
      type: 'POST',

      data: {
        IdSeguimiento: IdSeguimiento,
        DescripcionSeguimiento: NuevaDescripcion
      }
    })
    .done(function() {
      Swal.fire({
          title:'Genial',
          text: 'El seguimiento ha sido actualizado',
          type: 'success',

      });

    })
    .fail(function() {
      Swal.fire({
          title:'Oops...',
          text:'Hubo un error al actualizar el seguimiento',
          type: 'error',

      });
    })
    .always(function(){
        $("#ModalEditarSeguimiento").modal('hide');
        CargarSeguimientoPacientes(1);
    });


  }


  function ShowModalEditarSeguimiento()
  {
    CargarGruposServicio('#ModalEditar_cbGrupoServicio');
  }

  function CargarGruposServicio(control)
  {

      $.ajax({
          url: "<?php echo site_url();?>/CargaCatalogos_Controller/CargarGruposServicio_ajax",
          method: "POST",
          success: function(data)
              {
                   $(control).html(data);
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
                   $('#ModalSeguimiento_cbServicio').html(data);
              }
      });

  }

  function EstablecerFechaSeguimiento(dias)
  {

   var hoy = new Date();


  hoy.setDate(hoy.getDate()+parseInt(dias));

  var d = hoy.getDate();
  if (d<10)
  {
      d= '0'+d;
  }
  var m =  parseInt(hoy.getMonth())+1;
  if (m <10)
   {
       m = '0'+m;
   }


   $('#FechaSeguimiento').val(hoy.getFullYear()+'-'+m+'-'+d);
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

    $("#ModalNuevoSeguimiento").modal('hide');
    $("#Modal_NuevoPaciente").modal('show');
  }

  function EliminarSeguimiento(IdSeguimiento) {
    Swal.fire({
        title: 'Eliminar Seguimiento',
        text: "¿Deseas eliminar este seguimiento?",
        type: 'warning',
        showCancelButton: true,
        reverseButtons: true,
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: '<?=site_url('Seguimiento_Controller/EliminarSeguimiento_ajax')?>',
            type: 'POST',
            data: {IdSeguimiento: IdSeguimiento}
          })
          .done(function() {
            Swal.fire(
              'Eliminado',
              'El seguimiento ha sido eliminado.',
              'success'
            );
            CargarSeguimientoPacientes(1);

          })
          .fail(function() {
            Swal.fire(
              'Oops...',
              'Hubo un error al eliminar el seguimiento',
              'error'
            );
          });
        }
      });
  }


//
</script>
