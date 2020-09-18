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
                    <h4 class="card-title" id="basic-layout-form">Catalogo de Usuarios</h4>
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


                            <table id="tblUsuarios" class="table table-striped table-bordered table-responsive" style="width:100%">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th></th>
                                        <th>Id</th>
                                        <th>Usuario</th>
                                        <th>Nombre</th>

                                        <th>Apellidos</th>
                                        <th>Telefono</th>
                                        <th>Servicio</th>
                                        <th>Perfil</th>
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
<!--MODAL CAMBIAR CONTRASEÑA-->
<div class="modal fade" tabindex="-1" role="dialog" id="ModalCambiarContrasena" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <button onclick="cerrar('#ModalCambiarContrasena')" type="button" class="close" id="CancelarModalCambiarContrasena">&times;</button>
            <h5 class="modal-title" id="actualizarModalLabel">Cambiar Contraseña Usuario</h5>
        </div>
        <div class="modal-body">


        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="ModalIdEmpleado">Id Empleado</label>
                    <input type="text" id="ModalIdEmpleado" class="form-control"  name="ModalIdEmpleado" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="ModalUsuario">Usuario:</label>
                    <div class="position-relative">
                        <input type="text" id="ModalUsuario" class="form-control"  name="ModalUsuario" readonly>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
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


        </div>
        <div class="modal-footer">
            <button id="ModalbtnCambiarContrasena" type="button" onclick="CambiarContrasena()" class="btn btn-success">Cambiar</button>
            <button id="CancelarModalCambiarContrasena" onclick="cerrar('#ModalCambiarContrasena')" type="button" class="btn btn-warning">Cancelar</button>
        </div>
        </div>
    </div>
</div>
<!--MODAL EDITAR USUARIO-->
<div class="modal fade" tabindex="-1" role="dialog" id="ModalEditarUsuario" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-body" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <button onclick="cerrar('#ModalEditarUsuario')" type="button" class="close" id="CancelarModalEditarUsuario">&times;</button>
            <h5 class="modal-title" id="actualizarModalLabel">Editar Usuario</h5>
        </div>
        <div class="modal-body">


          <div class="row">
            <div class="col-md-6">
              <fieldset class="form-group">
                <label for="txtNombreUsuario">Nombre</label>
                <input type="text" class="form-control" id="txtNombreUsuario" name="NombreUsuario" placeholder="Nombre Usuario">
                <input type="hidden" name="ModalIdEmpleado" id="ModalIdEmpleado">
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


            </div>
          </div>

          <div class="row">
            <div class="col-md-6 col-xs-12">
              <fieldset class="form-group">
                <label for="txtTelefono">Teléfono</label>
                <input type="text" class="form-control" id="txtTelefono" name="txtTelefono" placeholder="Teléfono">
              </fieldset>
            </div>
            <div class="col-md-1 col-xs-12">
              <fieldset class="form-group">
                <label for="txtTelefono">Hábilitado</label>
                <input type="checkbox" class="form-control" name="UsuarioHabilitado" id="UsuarioHabilitado">
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
            <div class="col-md-12">
              <table class="table-striped table-bordered" id="tblSucursalUsuario" name="tblSucursalUsuario">
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
            <button id="ModalbtnCancelarNota" type="button" onclick="ActualizarUsuario()" class="btn btn-success">Confirmar</button>
            <button id="CancelarModalCancelarNota" onclick="cerrar('#ModalEditarUsuario')" type="button" class="btn btn-warning">Cancelar</button>
        </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    //input autocomplete Nombre

    $(document).ready(function() {

        CargarCatalogoUsuarios();
        CargarServicios();
        CargarPerfiles();


        // Add event listener for opening and closing details

        // $("#tbl_SeguimientoPacientes tbody").on('click','a.btnEditarSeguimiento',(e)=>{
        //   e.preventDefault();
        //   alert('click');
        //   var $this =$(this);
        //
        //   console.log($this.data('id'));
        // });
        $('#tblUsuarios tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var t = $("#tblUsuarios").DataTable();
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

function CargarCatalogoUsuarios()
{
    var t = $('#tblUsuarios').DataTable({
      "drawCallback": function( settings ) {
              $('[data-toggle="tooltip"]').tooltip();
            },
        "ajax":{
            url:"<?php echo site_url();?>/Usuario_Controller/ConsultarCatalogoUsuarios_ajax",

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
            {"targets": 9, "render":function(data,type,row,meta){

              var btnAgregarPago="";

              var btnCancelarNota="";
              var btnVerNotaRemision="";
              btnAgregarPago=' <button type="button" style="border-radius: 200px" class="btn btn-purple btn-sm" onclick="OpenModal_CambiarContrasena('+data+',\''+row['usuario']+'\')"><i class="icon-key2" data-toggle="tooltip" data-placement="top" id="AgregarPago" title="Cambiar Contraseña"></i></button>';
              btnCancelarNota = ' <button type="button" style="border-radius: 200px" class="btn btn-blue btn-sm" onclick="OpenModal_EditarUsuario('+data+')"><i class="icon-pencil" data-toggle="tooltip" data-placement="top" id="CancelarNota" title="Editar"></i></button>';


              //btnVerNotaRemision = " <a href='<?=site_url()?>/NotaRemision/CargarNotaRemision/"+data+"' target='_blank'><i class='icon-book'></i></a>";

              return btnAgregarPago+btnCancelarNota;//+ btnVerNotaRemision;

            }},
            {"targets": 8, "render":function(data,type,row,meta){

              var Habilitado;

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
                { "data": "IdEmpleado"},
                { "data": "usuario" },
                { "data": "NombreEmpleado" },
                { "data": "ApellidosEmpleado" },
                { "data": "TelefonoEmpleado" },
                { "data": "DescripcionServicio" },
                { "data": "DescripcionPerfil" },
                { "data": "Habilitado" },
                { "data": "IdEmpleado" }
                ]

        });

}
function LoadRowDetail ( d ) {
    // `d` is the original data object for the row
    var div = $('<div/>')
          .addClass( 'loading' )
          .text( 'Loading...' );


      $.ajax({
        url: '<?= site_url()?>/Usuario_Controller/ConsultarClinicasUsuario_ajax',
        data:{IdUsuario:d.IdEmpleado},
        type: 'POST'


      })
      .done(function(data) {

        var ClinicasUsuario = JSON.parse(data);
        var output ='<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
                        '<th>Clinicas</th>';

        for (i=0; i<ClinicasUsuario.length;i++)
        {

          output +='<tr>'+
                    '<td>'+ClinicasUsuario[i]['NombreClinica']+'</td>'+
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

function OpenModal_EditarUsuario(IdEmpleado) {

  $.ajax({
    url:"<?php echo site_url();?>/Usuario_Controller/ConsultarUsuarioPorId",
    data:{IdUsuario:IdEmpleado},
    method:"POST",
    dataSrc: ""

  })
  .done(function(data) {
    var Usuario = JSON.parse(data);
    $("#ModalIdEmpleado").val(Usuario['IdEmpleado']);
    $("#txtNombreUsuario").val(Usuario['NombreEmpleado']);
    $("#txtApellidosUsuario").val(Usuario['ApellidosEmpleado']);
    $("#cbServicio").val (Usuario['IdServicio']);
    $("#cbPerfil").val(Usuario['IdPerfil']);
    $("#txtTelefono").val(Usuario['TelefonoEmpleado']);
    $("#UsuarioHabilitado").removeAttr('checked');
    $("#txtUsuario").val(Usuario['usuario']);

    if (Usuario['Habilitado']==1)
    {
      $("#UsuarioHabilitado").attr('checked',true);
    }
    CargarClinicas(Usuario['IdEmpleado']);

  })
  .fail(function() {
    console.log("error");
  });


  $("#ModalEditarUsuario").modal('show');

}

function OpenModal_CambiarContrasena(IdEmpleado,Usuario)
{
    $("#ModalIdEmpleado").val(IdEmpleado);
    $("#ModalUsuario").val(Usuario);

    $("#ModalCambiarContrasena").modal('show');
}

function CambiarContrasena()
{
  var IdEmpleado = $("#ModalIdEmpleado").val();
  var password= $("#txtPassword").val();

  $.ajax({
    url: '<?=site_url('Usuario_Controller/ActualizarContrasenaUsuario_ajax')?>',
    type: 'POST',
    data: {
      IdEmpleado: IdEmpleado,
      password: password,

    }
  })
  .done(function() {
    Swal.fire({
        title:'Genial',
        text: 'El usuario ha sido actualizado',
        type: 'success',

    });

  })
  .fail(function() {
    Swal.fire({
        title:'Oops...',
        text:'Hubo un error al actualizar el usuario',
        type: 'error',

    });
  })
  .always(function(){
      $("#ModalEditarUsuario").modal('hide');

  });


}

//ModalCambiarContrasena
function cerrar(Ventana)
{

   $(Ventana).modal('hide');
   //limpiar();
}

  function CargarClinicas(IdUsuario) {

    var t = $('#tblSucursalUsuario').DataTable({
      "drawCallback": function( settings ) {
              $('[data-toggle="tooltip"]').tooltip();
            },
        "ajax":{
            url:"<?php echo site_url();?>/Usuario_Controller/CargarCatalogoClinicasUsuario_ajax",
            data: {
              IdUsuario:IdUsuario
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

                  if (row['IdEmpleado']!== null)
                  {
                    checked = "checked=true";
                  }
                  return '<input type="checkbox" class="form-control" name="ClinicaUsuario" value="'+data+'" '+checked+'>';

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

  function ActualizarUsuario()
  {

    var IdEmpleado = $("#ModalIdEmpleado").val();
    var NombreEmpleado= $("#txtNombreUsuario").val();
    var ApellidosEmpleado= $("#txtApellidosUsuario").val();
    var TelefonoEmpleado= $("#txtTelefono").val();
    var IdServicio=$("#cbServicio").val();
    
    var IdPerfil= $("#cbPerfil").val();
    var Habilitado =0;
    var clinicas=[];

    $("input[name='ClinicaUsuario']:checked").each(function(){
            clinicas.push(this.value);
        });
    if ($("#UsuarioHabilitado").is(":checked"))
    {
      Habilitado = 1;
    }


    $.ajax({
      url: '<?=site_url('Usuario_Controller/ActualizarUsuario_ajax')?>',
      type: 'POST',
      data: {
        IdEmpleado: IdEmpleado,
        NombreEmpleado: NombreEmpleado,
        ApellidosEmpleado: ApellidosEmpleado,
        TelefonoEmpleado: TelefonoEmpleado,
        IdServicio:IdServicio,
        IdPerfil: IdPerfil,
        Habilitado:Habilitado,
        Clinicas:clinicas
      }
    })
    .done(function() {
      Swal.fire({
          title:'Genial',
          text: 'El usuario ha sido actualizado',
          type: 'success',

      });

    })
    .fail(function() {
      Swal.fire({
          title:'Oops...',
          text:'Hubo un error al actualizar el usuario',
          type: 'error',

      });
    })
    .always(function(){
        $("#ModalEditarUsuario").modal('hide');

    });

  }

  function ShowPassword() {
    var x = document.getElementById("txtPassword");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }

  }

//
</script>
