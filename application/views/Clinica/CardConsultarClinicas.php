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
                    <h4 class="card-title" id="basic-layout-form">Catalogo de Clinicas</h4>
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


                            <table id="tblClinicas" class="table table-striped table-bordered table-responsive" style="width:100%">
                                <thead class="thead-inverse">
                                    <tr>

                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>direccion</th>
                                        <th>Telefono</th>
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

<!--MODAL EDITAR CLINICA-->
<div class="modal fade" tabindex="-1" role="dialog" id="ModalEditarClinica" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-body" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <button onclick="cerrar('#ModalEditarClinica')" type="button" class="close" id="CancelarModalEditarClinica">&times;</button>
            <h5 class="modal-title" id="actualizarModalLabel">Editar Clinica</h5>
        </div>
        <div class="modal-body">

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="txtIdClinica">Clinica</label>
                <div class="position-relative has-icon-left">
                    <input type="text" readonly="readonly" id="txtIdClinica" class="form-control" name="IdClinica" value=""/>
                    <div class="form-control-position">

                    </div>
                </div>

              </div>

            </div>

          </div>


          <div class="row">
            <div class="col-md-9  ">
              <fieldset class="form-group">
                <label for="txtNombreClinica">Nombre</label>
                <input type="text" class="form-control" id="txtNombreClinica" name="NombreClinica" placeholder="Nombre Clínica">
                <input type="hidden" name="txtNombreClinica" id="txtIdClinica">
              </fieldset>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <fieldset class="form-group">
                <label for="txtDireccionClinica">Direccion</label>
                <input type="text" class="form-control" id="txtDireccionClinica" name="DireccionClinica" placeholder="Direccion">
              </fieldset>
            </div>
          </div>


          <div class="row">
            <div class="col-md-6 col-xs-12">
              <fieldset class="form-group">
                <label for="txtTelefonoClinica">Teléfono</label>
                <input type="text" class="form-control" id="txtTelefonoClinica" name="txtTelefonoClinica" placeholder="Teléfono">
              </fieldset>
            </div>

          </div>

        </div>


        <div class="modal-footer">
            <button id="ModalbtnActualizar" type="button" onclick="ActualizarClinica()" class="btn btn-success">Confirmar</button>
            <button id="ModalbtnCancelar" onclick="cerrar('#ModalEditarClinica')" type="button" class="btn btn-warning">Cancelar</button>
        </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    //input autocomplete Nombre

    $(document).ready(function() {

        CargarCatalogoClinicas();
        CargarServicios();
        CargarPerfiles();



        $('#tblClinicas tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var t = $("#tblClinicas").DataTable();
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

function CargarCatalogoClinicas()
{
    var t = $('#tblClinicas').DataTable({
      "drawCallback": function( settings ) {
              $('[data-toggle="tooltip"]').tooltip();
            },
        "ajax":{
            url:"<?php echo site_url();?>/Clinica_Controller/ConsultarCatalogoClinicas_ajax",

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
            {"targets": 4, "render":function(data,type,row,meta){



              var btnEditarClinica="";

              btnEditarClinica = ' <button type="button" style="border-radius: 200px" class="btn btn-blue btn-sm" onclick="OpenModal_EditarClinica('+data+')"><i class="icon-pencil" data-toggle="tooltip" data-placement="top" id="CancelarNota" title="Editar"></i></button>';



              return btnEditarClinica;//+ btnVerNotaRemision;

            }},


          ],
          "columns": [

                { "data": "IdClinica"},

                { "data": "NombreClinica" },
                { "data": "DireccionClinica" },
                { "data": "TelefonoClinica" },

                { "data": "IdClinica" }
                ]

        });

}


function OpenModal_EditarClinica(IdClinica) {

  $.ajax({
    url:"<?php echo site_url();?>/Clinica_Controller/ConsultarClinicaPorId",
    data:{IdClinica:IdClinica},
    method:"POST",
    dataSrc: ""

  })
  .done(function(data) {
    var Clinica = JSON.parse(data);
    $("#txtIdClinica").val(Clinica['IdClinica']);
    $("#txtNombreClinica").val(Clinica['NombreClinica']);
    $("#txtDireccionClinica").val(Clinica['DireccionClinica']);
    $("#txtTelefonoClinica").val(Clinica['TelefonoClinica']);

  })
  .fail(function() {
    console.log("error");
  });


  $("#ModalEditarClinica").modal('show');

}


//ModalCambiarContrasena
function cerrar(Ventana)
{

   $(Ventana).modal('hide');
   //limpiar();
}


  function ActualizarClinica()
  {

    var IdClinica = $("#txtIdClinica").val();
    var NombreClinica= $("#txtNombreClinica").val();
    var DireccionClinica= $("#txtDireccionClinica").val();
    var TelefonoClinica= $("#txtTelefonoClinica").val();

    $.ajax({
      url: '<?=site_url('Clinica_Controller/ActualizarClinica_ajax')?>',
      type: 'POST',
      data: {
        IdClinica: IdClinica,
        NombreClinica: NombreClinica,
        DireccionClinica: DireccionClinica,
        TelefonoClinica: TelefonoClinica,

      }
    })
    .done(function() {
      Swal.fire({
          title:'Genial',
          text: 'La clinicas ha sido actualizada',
          type: 'success',

      });

    })
    .fail(function() {
      Swal.fire({
          title:'Oops...',
          text:'Hubo un error al actualizar la clinica',
          type: 'error',

      });
    })
    .always(function(){
        $("#ModalEditarClinica").modal('hide');

    });

  }



//
</script>
