<form class="form-ajax" data-url="<?= site_url(); ?>/Usuario_Controller/AgregarNuevoUsuario"
	id="form_RegistrarPagoProveedor">

<div class="row">
  <!--COL 1-->
  <div class="col-md-12">
    <!--CARD PACIENTE-->
    <div class="card my-4 shadow">
      <!--CARD HEADER-->
      <div class="card-header">
          <h4 class="card-title" id="basic-layout-form">Nuevo Usuario</h4>
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
      <div class="card-body">
        <div class="card-block">
            <!--FORM BODY-->
            <div class="form-body">
              <div class="row">
                <div class="col-md-6">
                  <fieldset class="form-group">
                    <label for="txtNombreUsuario">Nombre</label>
                    <input type="text" class="form-control" id="txtNombreUsuario" name="NombreUsuario" placeholder="Nombre Usuario">
                  </fieldset>
                </div>
                <div class="col-md-6">
                  <fieldset class="form-group">
                    <label for="txtApellidosUsuario">Apellidos</label>
                    <input type="text" class="form-control" id="txtApellidosUsuario" name="ApellidosUsuario" placeholder="Apellidos">
                  </fieldset>
                </div>
              </div>
              <div class="row">

              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="txtUsuario">Usuario</label>
                    <div class="position-relative has-icon-left">
                        <input type="text" id="txtUsuario" class="form-control" name="Usuario" value=""/>
                        <div class="form-control-position">
                          <i class="icon-user4"></i>
                        </div>
                    </div>

                  </div>

                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="txtPassword">Password (mínimo 8 carácteres)</label>
                    <div class="position-relative has-icon-left">
                        <input type="password" id="txtPassword" class="form-control" name="Password" value="" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"/>
                        <div class="form-control-position">
                          <i class="icon-lock2"></i>

                        </div>
                    </div>
                    <input type="checkbox" onclick="ShowPassword()">Show Password

                  </div>

                </div>
              </div>
              <div class="row">

              </div>

              <div class="row">
                <div class="col-md-6 col-xs-12">
                  <fieldset class="form-group">
                    <label for="txtTelefonoPaciente">Teléfono</label>
                    <input type="text" class="form-control" id="txtTelefonoPaciente" name="TelefonoPaciente" placeholder="Teléfono">
                  </fieldset>
                </div>
                <div class="col-md-1 col-xs-12">
                  <fieldset class="form-group">
                    <label for="txtTelefonoPaciente">Hábilitado</label>
                    <input type="checkbox" class="form-control" name="UsuarioHabilitado">
                  </fieldset>
                </div>

              </div>
              <div class="row">

                  <div class="col-md-6 col-xs-12">
                      <div class="form-group">
                          <label for="cbServicio">Servicio</label>
                          <select name="cbServicio" id="cbServicio" class="form-control">
                              <option value="">Servicios</option>

                          </select>
                      </div>
                  </div>
                  <div class="col-md-6 col-xs-12">
                      <div class="form-group">
                          <label for="cbPerfil">Perfil</label>
                          <select name="cbPerfil" id="cbPerfil" class="form-control">
                              <option value="">Perfil</option>

                          </select>
                      </div>
                  </div>


              </div>

              <h4 class="form-section"><i class="icon-clipboard4"></i> Clínicas</h4>

              <div class="row">
                <div class="col-md-6">
                  <table class="table-striped table-bordered table-responsive" id="tblSucursalUsuario" name="tblSucursalUsuario">
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
            <!--FORM ACTIONS-->
            <div class="form-actions" align="right">
              <button type="submit" class="btn btn-success" name="button"><i class="icon-check2"></i> Guardar</button>

            </div>

        </div>
      </div>
    </div>
  </div>

</div>

<script type="text/javascript">
$(document).ready(function() {
  CargarClinicas();
  CargarServicios();
  CargarPerfiles();

  $(document).on('submit', '.form-ajax', function(e){
        e.preventDefault();
        var $this = $(this);

        var data = $this.serialize();

        var action = document.activeElement.getAttribute('value');

        var url = $this.data('url');


          $.post(url, data).then(function(res){
            var a = JSON.parse(res);

              if (a.error) {
                  Swal.fire('Error', a.message, 'error');
              } else {
                  Swal.fire('Éxito', a.message, 'success');
                  $(".form-ajax")[0].reset();
              }
          }).fail(function(){
              Swal.fire('Error', 'Error al conectarse con el servidor', 'error');
          });



        e.preventDefault();
    });

});

function ShowPassword() {
  var x = document.getElementById("txtPassword");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }

}

function CargarClinicas() {

  var t = $('#tblSucursalUsuario').DataTable({
    "drawCallback": function( settings ) {
            $('[data-toggle="tooltip"]').tooltip();
          },
      "ajax":{
          url:"<?php echo site_url();?>/CargaCatalogos_Controller/ConsultarClinicas_ajax",

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
            "targets":0,"data":"IdClinica","render":function(data,type,meta,row)
            {
                return '<input type="checkbox" class="form-control" name="ClinicaUsuario[]" value="'+data+'">';
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

function CargarPerfiles()
{
     $.ajax({
              url:"<?php echo site_url();?>/CargaCatalogos_Controller/CargarPerfiles_ajax",
              method:"POST",

              success: function(data)
                {
                    $('#cbPerfil').html(data);



                }
          });
}

</script>
