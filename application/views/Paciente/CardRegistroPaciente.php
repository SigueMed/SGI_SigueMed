<div class="row">
  <!--COL 1-->
  <div class="col-md-6">
    <!--CARD PACIENTE-->
    <div class="card my-4 shadow">
      <!--CARD HEADER-->
      <div class="card-header">
        <h6 >Nuevo Paciente</h6>
      </div>
      <div class="card-body">
        <div class="card-block">
            <!--FORM BODY-->
            <div class="form-body">
              <div class="row">
                <div class="col-md-12">
                  <fieldset class="form-group">
                    <label for="txtNombrePaciente">Nombre</label>
                    <input type="text" class="form-control" id="txtNombrePaciente" name="NombrePaciente" placeholder="Nombre Completo" required>
                  </fieldset>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <fieldset class="form-group">
                    <label for="txtNombreApellidos">Apellidos</label>
                    <input type="text" class="form-control" id="txtNombreApellidos" name="ApellidosPaciente" placeholder="Apellidos" required>
                  </fieldset>
                </div>
              </div>
              <div class="row">
                <div class="col-md-5 col-xs-12">
                  <div class="form-group">
                    <label for="FechaNacimiento">Fecha Nacimiento</label>
                    <div class="position-relative has-icon-left">
                        <input type="date" id="FechaNacimiento" class="form-control" name="FechaNacimientoPaciente" value="" onchange="ActualizarEdad()"/>
                        <div class="form-control-position">
                          <i class="icon-calendar5"></i>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 col-xs-12">
                  <div class="form-group">
                    <label for="Edad">Edad</label>
                    <input type="text" name="Edad" id ="Edad" class="form-control" placeholder="Edad" readonly/>
                  </div>
                </div>
                <div class="col-md-4  col-xs-12">
                  <div class="form-group">
                    <label for="cbSexo">Sexo:</label>
                    <select name="Sexo" id="cbSexo" class="form-control" onchange="" required>
                      <option value="M">Masculino</option>
                      <option value="F">Femenino</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 col-xs-12">
                  <fieldset class="form-group">
                    <label for="txtTelefonoPaciente">Teléfono</label>
                    <input type="text" class="form-control" id="txtTelefonoPaciente" name="TelefonoPaciente" placeholder="Teléfono" required>
                  </fieldset>
                </div>
                <div class="col-md-6  col-xs-12">
                  <fieldset class="form-group">
                    <label for="txtEmailPaciente">@-email</label>
                    <input type="text" class="form-control" id="txtEmailPaciente" name="emailPaciente" placeholder="direccion@correo.com">
                  </fieldset>
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
