<div class="row match-height">
        <div class="col-md-12">
            <div class="card">
                <!--CARD HEADER-->
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form">Antecedentes Nota Medica</h4>
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
                                <?php

                                if ($Antecedentes!=FALSE)
                                {
                                    foreach ($Antecedentes as $AntecedenteNota)
                                    {
                                        echo '<div class="row">';
                                        echo '<div class="col-md-12">';
                                        echo '<div class="form-group">';
                                        echo '<label for="Antecendete'.$AntecedenteNota['IdAntecedenteNotaMedica'].'">'.$AntecedenteNota['DescripcionAntecedente'].'</label>';
                                        echo '<div class="position-relative has-icon-left">';
                                        echo '<textarea id="timesheetinput7" rows="5" class="form-control" name="Antecedente'.$AntecedenteNota['IdAntecedenteNotaMedica'].'" id="Antecedente'.$AntecedenteNota['IdAntecedenteNotaMedica'].'" placeholder="notes">'.$AntecedenteNota['DescripcionAntecedenteNotaMedica'].'</textarea>';
                                        echo '<div class="form-control-position">';
                                        echo '<i class="icon-file2"></i>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '</div>';

                                    }
                                }
                                else
                                {
                                    echo "No Existen antecedentes para el Servicio. Contactar al area de Administración.";

                                }

                                ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

