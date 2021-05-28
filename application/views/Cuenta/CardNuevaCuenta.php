<form class="form-ajax" data-url="<?= site_url(); ?>/Cuenta_ControllerPersona/AgregarNuevaCuenta"
	id="form_RegistrarCuenta">

<div class="row">
  <!--COL 1-->
  <div class="col-md-12">
    <!--CARD PACIENTE-->
    <div class="card my-4 shadow">
      <!--CARD HEADER-->
      <div class="card-header">
          <h4 class="card-title" id="basic-layout-form">Nueva Cuenta</h4>
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
                <div class="col-md-9">
                  <fieldset class="form-group">
                    <label for="txtDescripcionCuenta">Descripcion</label>
                    <input type="text" class="form-control" id="txtDescripcionCuenta" name="DescripcionCuenta" placeholder="Descripcion de la cuenta">
                  </fieldset>
                </div>

              </div>
              <div class="row">

              </div>

              <div class="row">

              </div>

              <div class="row">


								<div class="col-md-2 col-xs-12">
                  <fieldset class="form-group">
                    <label for="CuentaHabilitada">Hábilitado</label>
                    <input type="checkbox" class="form-control" name="Habilitado">
                  </fieldset>
                </div>

                <div class="col-md-2 col-xs-12">
                  <fieldset class="form-group">
                    <label for="txtCorteCaja">Corte de caja</label>
                    <input type="checkbox" class="form-control" name="CorteCaja">
                  </fieldset>
                </div>

								<div class="col-md-2 col-xs-12">
                  <fieldset class="form-group">
                    <label for="txtCuentaMaestra">Cuenta Maestra</label>
                    <input type="checkbox" class="form-control" name="CuentaMaestra">
                  </fieldset>
                </div>



              </div>
              <div class="row">

                  <div class="col-md-6 col-xs-12">
                      <div class="form-group">
                          <label for="cbEmpleado">Empleado</label>
                          <select name="IdEmpleado" id="cbEmpleado" class="form-control">
                              <option value="">IdEmpleado</option>

                          </select>
                      </div>
                  </div>



              </div>


            </div>
            <!--FORM ACTIONS-->
            <div class="form-actions" align="right">
              <button type="submit" class="btn btn-success" name="buttonGuardar"><i class="icon-check2"></i> Guardar</button>

            </div>

        </div>
      </div>
    </div>
  </div>

</div>

<script type="text/javascript">
$(document).ready(function() {
  // CargarClinicas();
  // CargarServicios();
  CargarEmpleados();

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



// function CargarClinicas() {
//
//   var t = $('#tblSucursalUsuario').DataTable({
//     "drawCallback": function( settings ) {
//             $('[data-toggle="tooltip"]').tooltip();
//           },
//       "ajax":{
//           url:"<?php echo site_url();?>/CargaCatalogos_Controller/ConsultarClinicas_ajax",
//
//           method:"POST",
//           dataSrc: ""
//       },
//
//        "destroy":true,
//        "language": {
//             "lengthMenu": "Mostrando _MENU_ registros por pag.",
//             "zeroRecords": "Sin Datos - disculpa",
//             "info": "Motrando pag. _PAGE_ de _PAGES_",
//             "infoEmpty": "Sin registros disponibles",
//             "infoFiltered": "(filtrado de _MAX_ total)"
//         },
//         "autoWidth":true,
//         "columnDefs":[
//           {
//             "targets":0,"data":"IdClinica","render":function(data,type,meta,row)
//             {
//                 return '<input type="checkbox" class="form-control" name="ClinicaUsuario[]" value="'+data+'">';
//             }
//           }
//
//         ],
//         "columns": [
//
//               { "data": "IdClinica"},
//               { "data": "IdClinica" },
//               { "data": "NombreClinica" }
//
//               ]
//       });
//
//
//
// }


function CargarEmpleados()
{
	//CARGA UNA Lista de los empleados
     $.ajax({
              url:"<?php echo site_url();?>/CargaCatalogos_Controller/CargarEmpleados_ajax",
              method:"POST",

              success: function(data)
                {
                    $('#cbEmpleado').html(data);



                }
          });
}

</script>
