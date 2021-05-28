<form class="form-ajax" data-url="<?= site_url(); ?>/Servicio_Controller/AgregarNuevoServicio"
	id="form_RegistrarPagoProveedor">

<div class="row">
  <!--COL 1-->
  <div class="col-md-12">
    <!--CARD SERVICIO-->
    <div class="card my-4 shadow">
      <!--CARD HEADER-->
      <div class="card-header">
          <h4 class="card-title" id="basic-layout-form">Nuevo Servicio</h4>
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
                    <label for="txtDescripcionServicio">Descripcion Servicio</label>
                    <input type="text" class="form-control" id="txtDescripcionServicio" name="DescripcionServicio" placeholder="Descripcion Servicio">
                  </fieldset>
                </div>
                <div class="col-md-6">
                  <fieldset class="form-group">
                    <label for="txtCodigoColorServicio">Codigo Color</label>
                    <input type="text" class="form-control" id="txtCodigoColor" name="CodigoColorServicio" placeholder="Codigo Color">
                  </fieldset>
                </div>
            

              <div class="col-md-6 col-xs-12">
                      <div class="form-group">
                          <label for="cbGrupoServicio">Grupo Servicio</label>
                          <select name="cbGrupoServicio" id="cbGrupoServicio" class="form-control">
                              <option value="">GrupoServicio</option>

                          </select>
                      </div>
                  </div>

                <div class="row">
                </div>
              </div>

              <div class="row">
                <div class="col-md-1 col-xs-12">
                  <fieldset class="form-group">
                    <label for="txtManejoInventario">Inventario</label>
                    <input type="checkbox" class="form-control" name="ManejoInventario">
                  </fieldset>
                </div>

                <div class="col-md-1 col-xs-12">
                  <fieldset class="form-group">
                    <label for="txtManejoAgenda">Agenda</label>
                    <input type="checkbox" class="form-control" name="ManejoAgenda">
                  </fieldset>
                </div>

                <div>
                 <div class="col-md-1 col-xs-12">
                    <fieldset class="form-group">
                      <label for="txtHabilitado">Hábilitado</label>
                      <input type="checkbox" class="form-control" name="ServicioHabilitado">
                    </fieldset>
                  </div>  
                </div>
              </div>

             

              <h4 class="form-section"><i class="icon-clipboard4"></i> Clínicas</h4>

              <div class="row">
                <div class="col-md-6">
                  <table class="table-striped table-bordered table-responsive" id="tblSucursalServicio" name="tblSucursalServicio">
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
  CargarGrupoServicio();

  $(document).on('submit', '.form-ajax', function(e){
        e.preventDefault();
        var $this = $(this);

        var data = $this.serialize();

        var action = document.activeElement.getAttribute('value');

        var url = $this.data('url');


          $.post(url, data).then(function(res){
            //console.log('DEBUG:'+res);
            
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

function CargarClinicas() 
{
  var t = $('#tblSucursalServicio').DataTable({
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
                return '<input type="checkbox" class="form-control" name="ClinicaServicio[]" value="'+data+'">';
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

function CargarGrupoServicio()
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
</script>
