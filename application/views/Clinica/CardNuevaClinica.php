<form class="form-ajax" data-url="<?= site_url(); ?>/Clinica_Controller/AgregarNuevaClinica"
	id="form_RegistrarClinica">

<div class="row">
  <!--COL 1-->
  <div class="col-md-12">
    <!--CARD PACIENTE-->
    <div class="card my-4 shadow">
      <!--CARD HEADER-->
      <div class="card-header">
          <h4 class="card-title" id="basic-layout-form">Nueva Clinica</h4>
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
                    	<label for="txtNombreClinica">Nombre de Clinica</label>
                    <input type="text" class="form-control" id="txtNombreClinica" name="NombreClinica" placeholder="Nombre de la Clinica">
                  </fieldset>
                </div>
                <div class="col-md-9">
                  <fieldset class="form-group">
                    <label for="txtDireccionClinica">Direccion</label>
                    <input type="text" class="form-control" id="txtDireccionClinica" name="DireccionClinica" placeholder="Direccion de la Clinica">
                  </fieldset>
                </div>
              </div>
              <div class="row">

              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="txtTelefonoClinica">Telefono de la Clinica</label>

                        <input type="text" id="txtTelefonoClinica" class="form-control" placeholder="Telefono de la Clinica" name="TelefonoClinica" value=""/>
                        <div class="form-control-position">

                        </div>

                  </div>
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

</script>
