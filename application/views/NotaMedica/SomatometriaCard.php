<div class="row match-height">
        <div class="col-md-12">
            <div class="card">
                <!--CARD HEADER-->
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form">Somatometria Paciente</h4>
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
                            <h4 class="form-section"><i class="icon-heart"></i>Datos Somatometria</h4>
                        
                            <div class="row">
                                <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="Peso">Peso - Kg.</label>
                                            <input type="text" name="Peso" id="Peso" class="form-control" placeholder="Peso"/>
                                        </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="Talla">Talla - mts.</label>
                                        <input type="text" name="Talla" id="Talla" class="form-control" placeholder="Talla"/>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="TA">T/A - Mm/Hg.</label>
                                        <input type="text" name="TA" id="TA" class="form-control" placeholder="T/A"/>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="Temperatura">T - °C.</label>
                                        <input type="text" name="Temperatura" id="Temperatura" class="form-control" placeholder="Temp"/>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="FC">F/C - L/m.</label>
                                        <input type="text" name="FC" id="FC" class="form-control" placeholder="F/C"/>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="FR">F/R - R/m.</label>
                                        <input type="text" name="FR" id="FR" class="form-control" placeholder="F/R"/>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- FORM ACTIONS-->
                        <div class="form-actions">
                            <?php
                                if($SomatometriaActionsEnabled)
                                {
                                    echo '<button type="submit" class="btn btn-warning mr-1" name="action" value="cancelar">';
                                    echo '<i class="icon-cross2"></i> Cancelar';
                                    echo '</button>';
                                    echo '<button type="submit" class="btn btn-primary" name="action" value='.$SomatometriaSubmitAction.'>';
                                    echo '<i class="icon-check2"></i> Guardar';
                                    echo '</button>';
                                }
                            ?>
                                
                                
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

<script type="text/javascript">
    $(document).ready(function()
    {
        
        var Somatometria = <?= json_encode($NotaMedica)?>;
        if (Somatometria !== null)
        {
            //alert(Somatometria['PesoPaciente']);
            $("#Peso").val(Somatometria['PesoPaciente']);
            $("#Talla").val(Somatometria['TallaPaciente']);
            $("#TA").val(Somatometria['PresionPaciente']);
            $("#Temperatura").val(Somatometria['TemperaturaPaciente']);
            $("#FC").val(Somatometria['FrCardiacaPaciente']);
            $("#FR").val(Somatometria['FrRespiratoriaPaciente']);
        
        }     
    });
</script>


