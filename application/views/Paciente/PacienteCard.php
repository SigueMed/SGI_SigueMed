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
                                    <div class="col-md-6">
                                            <div class="form-group">
                                                    <label for="Nombre">Nombre</label>
                                                    <input type="text" name="Nombre" id="Nombre" class="form-control" placeholder="Nombre"/>
                                            </div>
                                    </div>
                                    <div class="col-md-6">
                                            <div class="form-group">
                                                    <label for="Apellidos">Apellidos</label>
                                                    <input type="text" name="Apellidos" id="Apellidos" class="form-control" placeholder="Apellidos"/>
                                            </div>
                                    </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="FechaNacimiento">Fecha Nacimiento</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="date" id="FechaNacimiento" class="form-control" name="FechaNacimiento" value="<?php echo $Paciente->FechaNacimiento; ?>"/>
                                            <div class="form-control-position">
                                                    <i class="icon-calendar5"></i>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                            <label for="Edad">Edad</label>
                                            <input type="text" name="Edad" id ="Edad" class="form-control" placeholder="Edad" readonly/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="Celular">Celular:</label>
                                        <input type="text" id = "Celular" name="Celular" class="form-control" placeholder="Celular"/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="Celular">Email:</label>
                                        <input type="text" id = "email" name="email" class="form-control" placeholder="email"/>
                                    </div>
                                </div>


                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="EstadoCivil">Estado Civil:</label>
                                        <input type="text" name="EstadoCivil" id="EstadoCivil" class="form-control" placeholder="Estado Civil" value="<?php echo $Paciente->EstadoCivil; ?>"/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="ViveCon">Vive con:</label>
                                        <input type="text" name="ViveCon" id="ViveCon" class="form-control" placeholder="Vive con"/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="Escolaridad">Escolaridad:</label>
                                        <input type="text" name="Escolaridad" id="Escolaridad" class="form-control" placeholder="Escolaridad" value="<?php echo $Paciente->Escolaridad; ?>"/>
                                    </div>
                                </div>

                            </div>

                            <h4 class="form-section"><i class="icon-clipboard4"></i> Dirección</h4>


                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="calle">Calle</label>
                                        <input type="text" name="Calle" id="Calle" class="form-control" placeholder="Calle"/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="colonia">Colonia</label>
                                        <input type="text" name="Colonia" id="Colonia" class="form-control" placeholder="Colonia"/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                         <label for="cp">Código Postal</label>
                                        <input type="text" id="CP" name="CP" class="form-control" placeholder="C.P."/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="IdServiciosMedicos">Recursos Medicos</label>
                                        <input type="text" id="IdServiciosMedicos"  class="form-control" placeholder="Servicios Medicos" name="IdServiciosMedicos" value=""/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- FORM ACTIONS-->
                        <div class="form-actions">
                            <?php
                                if($PacienteActionsEnabled== true)
                                {
                                    echo '<button type="submit" class="btn btn-warning mr-1" name="action" value="cancelar">';
                                    echo '<i class="icon-cross2"></i> Cancelar';
                                    echo '</button>';
                                    echo '<button type="submit" class="btn btn-primary" name="action" value='.$PacienteSubmitAction.'>';
                                    echo '<i class="icon-check2"></i> Guardar';
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
            $("#EstadoCivil").val(Paciente['EstadoCivil']);
            $("#ViveCon").val(Paciente['ViveCon']);
            $("#Escolaridad").val(Paciente['Escolaridad']);
            $("#Calle").val(Paciente['Calle']);
            $("#Colonia").val(Paciente['Colonia']);
            $("#CP").val(Paciente['CP']);
            //$("#IdServiciosMedicos").val(Paciente['IdServiciosMedicos']);
            
        
        }     
    });
    
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
</script>