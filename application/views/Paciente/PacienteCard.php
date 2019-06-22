<div class="row match-height">
        <div class="col-md-12">
            <div class="card">
                <!--CARD HEADER-->
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form">Información Paciente</h4>
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
                            <h4 class="form-section"><i class="icon-head"></i>Datos Personales</h4>
                            <div class="row">
                                    <div class="col-md-5">
                                            <div class="form-group">
                                                    <label for="Nombre">Nombre</label>
                                                    <input type="text" name="Nombre" id="Nombre" class="form-control" placeholder="Nombre"/>
                                            </div>
                                    </div>
                                    <div class="col-md-5">
                                            <div class="form-group">
                                                    <label for="Apellidos">Apellidos</label>
                                                    <input type="text" name="Apellidos" id="Apellidos" class="form-control" placeholder="Apellidos"/>
                                            </div>
                                    </div>
                                    <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="cbSexo">Sexo:</label>
                                        <select name="cbSexo" id="cbSexo" class="form-control" onchange="">
                                            <option value="M">Masculino</option>
                                            <option value="F">Femenino</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-xs-6">
                                    <div class="form-group">
                                        <label for="FechaNacimiento">Fecha Nacimiento</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="date" id="FechaNacimiento" class="form-control" name="FechaNacimiento" value="" onchange="ActualizarEdad()"/>
                                            <div class="form-control-position">
                                                    <i class="icon-calendar5"></i>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-2 col-xs-6">
                                    <div class="form-group">
                                            <label for="Edad">Edad</label>
                                            <input type="text" name="Edad" id ="Edad" class="form-control" placeholder="Edad" readonly/>
                                    </div>
                                </div>
                                <div class="col-md-3 col-xs-12">
                                    <div class="form-group">
                                        <label for="Celular">Celular:</label>
                                        <input type="text" id = "Celular" name="Celular" class="form-control" placeholder="Celular"/>
                                    </div>
                                </div>
                                <div class="col-md-3 col-xs-12">
                                    <div class="form-group">
                                        <label for="Celular">Email:</label>
                                        <input type="text" id = "email" name="email" class="form-control" placeholder="email"/>
                                    </div>
                                </div>


                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="cbEscolaridad">Escolaridad:</label>
                                        <select name="cbEscolaridad" id="cbEscolaridad" class="form-control" onchange="">
                                            <option value="">Escolaridad</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-xs-12">
                                    <div class="form-group">
                                        <label for="Escolaridad">Otro:</label>
                                        <input type="text" id = "Escolaridad" name="Escolaridad" class="form-control" placeholder="Otro-Escolaridad"/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="cbEstadoCivil">Estado Civil:</label>
                                        <select name="cbEstadoCivil" id="cbEstadoCivil" class="form-control" onchange="">
                                            <option value="">Estado Civil</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="ViveCon">Vive con:</label>
                                        <input type="text" name="ViveCon" id="ViveCon" class="form-control" placeholder="Vive con"/>
                                    </div>
                                </div>


                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="cbReligion">Religion:</label>
                                        <select name="cbReligion" id="cbReligion" class="form-control" onchange="">
                                            <option value="">Religion</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-xs-12">
                                    <div class="form-group">
                                        <label for="Religion">Otro:</label>
                                        <input type="text" id = "Religion" name="Religion" class="form-control" placeholder="Otro-Religion"/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="cbOcupacion">Ocupación:</label>
                                        <select name="cbOcupacion" id="cbOcupacion" class="form-control" onchange="">
                                            <option value="">Ocupación</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="Ocupacion">Otro:</label>
                                        <input type="text" name="Ocupacion" id="Ocupacion" class="form-control" placeholder="Otro-Ocupación"/>
                                    </div>
                                </div>


                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="cbRecursosMedicos">Recursos Medicos</label>
                                        <select name="cbRecursosMedicos" id="cbRecursosMedicos" class="form-control" onchange="">
                                            <option value="">Recursos Medicos</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-6">
                                    <div class="form-group">

                                          <label for="RFC">RFC:</label>
                                        <input type="text" id = "RFC" name="RFC" class="form-control" placeholder="RFC"/>
                                    </div>
                                </div>
                            </div>

                            <h4 class="form-section"><i class="icon-clipboard4"></i> Dirección</h4>


                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="DondeVive">Donde Vive:</label>
                                        <select name="DondeVive" id="DondeVive" class="form-control" onchange="">
                                            <option value="">Seleccione una opción</option>
                                            <option value="1">Zona Urbana</option>
                                            <option value="0">Zona Rural</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="Calle">Calle</label>
                                        <input type="text" name="Calle" id="Calle" class="form-control" placeholder="Calle"/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="colonia">Colonia</label>
                                        <input type="text" name="Colonia" id="Colonia" class="form-control" placeholder="Colonia"/>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                         <label for="cp">Código Postal</label>
                                        <input type="text" id="CP" name="CP" class="form-control" placeholder="C.P."/>
                                    </div>
                                </div>
                            </div>

                                                        


                        </div>
                        <!-- FORM ACTIONS-->
                        <div class="form-actions">
                            <?php
                                if($PacienteActionsEnabled== true)
                                {
                                    echo '<button type="submit" class="btn btn-warning mr-1" name="action" value="cerrar">';
                                    echo '<i class="icon-cross2"></i> Cerrar';
                                    echo '</button>';
                                    if($PacienteCancelActionEnabled==true)
                                    {
                                        echo '<button type="submit" class="btn btn-danger mr-1" name="action" value="'.$PacienteCancelAction.'">';
                                        echo '<i class="icon-cross2"></i> '.$PacienteCancelTitle;
                                        echo '</button>';
                                    }
                                    echo '<button type="submit" class="btn btn-success" name="action" value='.$PacienteSubmitAction.'>';
                                    echo '<i class="icon-check2"></i> '.$PacienteSubmitTitle;
                                    echo '</button>';
                                }
                            ?>


                        </div>
                    </div>
                </div>
            </div><!--DIV CARD-->
        </div><!--DIV COL-MD-->
</div><!--DIV ROW MATCH-->

<script type="text/javascript">
    $(document).ready(function()
    {
        CargaEscolaridad();
        CargarEstadoCivil();
        CargarReligion();
        CargarOcupacion();
        CargarRecursosMedicos();
        CargarPaciente();



    });

    function ActualizarEdad()
    {
        edad = CalcularEdad($("#FechaNacimiento").val());
        $("#Edad").val(edad);
    }


    function CalcularEdad(FechaNacimiento)
    {
        var hoy = new Date();
        var cumpleanos = new Date(FechaNacimiento);
        var edad = hoy.getFullYear() - cumpleanos.getFullYear();
        var m = hoy.getMonth() - cumpleanos.getMonth();

        if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
            edad--;
        }

        return edad;
    }

    function CargaEscolaridad()
    {
        $.ajax({
                  url:"<?php echo site_url();?>/Paciente_Controller/CargarEscolaridad_ajax",
                  method:"POST",
                  success: function(data)
                    {

                        $('#cbEscolaridad').html(data);

                        var Paciente = <?= json_encode($Paciente)?>;
                        if (Paciente !== null)
                        {
                            $("#cbEscolaridad").val(Paciente['IdEscolaridad']);
                        }
                    }
              });
    }

    function CargarEstadoCivil()
    {
        $.ajax({
                  url:"<?php echo site_url();?>/Paciente_Controller/CargarEstadoCivil_ajax",
                  method:"POST",
                  success: function(data)
                    {

                        $('#cbEstadoCivil').html(data);

                        var Paciente = <?= json_encode($Paciente)?>;
                        if (Paciente !== null)
                        {
                            $("#cbEstadoCivil").val(Paciente['IdEstadoCivil']);
                        }
                    }
              });
    }


    function CargarReligion()
    {
        $.ajax({
                  url:"<?php echo site_url();?>/Paciente_Controller/CargarReligion_ajax",
                  method:"POST",
                  success: function(data)
                    {

                        $('#cbReligion').html(data);

                        var Paciente = <?= json_encode($Paciente)?>;
                        if (Paciente !== null)
                        {
                            $("#cbReligion").val(Paciente['IdReligion']);
                        }
                    }
              });
    }

    function CargarOcupacion()
    {
        $.ajax({
                  url:"<?php echo site_url();?>/Paciente_Controller/CargarOcupacion_ajax",
                  method:"POST",
                  success: function(data)
                    {

                        $('#cbOcupacion').html(data);

                        var Paciente = <?= json_encode($Paciente)?>;
                        if (Paciente !== null)
                        {
                            $("#cbOcupacion").val(Paciente['IdOcupacion']);
                        }
                    }
              });
    }

    function CargarRecursosMedicos()
    {
        $.ajax({
                  url:"<?php echo site_url();?>/Paciente_Controller/CargarRecursosMedicos_ajax",
                  method:"POST",
                  success: function(data)
                    {

                        $('#cbRecursosMedicos').html(data);

                        var Paciente = <?= json_encode($Paciente)?>;
                        if (Paciente !== null)
                        {
                            $("#cbRecursosMedicos").val(Paciente['IdRecursosMedicos']);
                        }
                    }
              });
    }


    function CargarPaciente()
    {
        var Paciente = <?= json_encode($Paciente)?>;
        if (Paciente !== null)
        {
            //alert(Somatometria['PesoPaciente']);
            $("#Nombre").val(Paciente['Nombre']);
            $("#Apellidos").val(Paciente['Apellidos']);

            if(Paciente['FechaNacimiento'] !== '0000-00-00')
            {

                $("#FechaNacimiento").val(Paciente['FechaNacimiento']);
                $("#Edad").val(CalcularEdad(Paciente['FechaNacimiento']));
            }
            $("#Celular").val(Paciente['NumCelular']);
            $("#email").val(Paciente['email']);
            $("#cbEstadoCivil").val(Paciente['EstadoCivil']);
            $("#ViveCon").val(Paciente['ViveCon']);
            $("#Calle").val(Paciente['Calle']);
            $("#Colonia").val(Paciente['Colonia']);
            $("#CP").val(Paciente['CP']);
            $("#Escolaridad").val(Paciente['Escolaridad']);
            $("#Religion").val(Paciente['Religion']);
            $("#Ocupacion").val(Paciente['Ocupacion']);
             $("#cbEscolaridad").val(Paciente['IdEscolaridad']);
            $("#cbReligion").val(Paciente['IdReligion']);
            $("#cbOcupacion").val(Paciente['IdOcupacion']);
            $("#DondeVive").val(Paciente['DondeVive']);
            $("#cbSexo").val(Paciente['Sexo']);
            $("#RFC").val(Paciente['RFC']);



            //$("#IdServiciosMedicos").val(Paciente['IdServiciosMedicos']);


        }

    }

</script>
