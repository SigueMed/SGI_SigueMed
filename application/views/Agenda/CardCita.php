<div class="row match-height">
        <div class="col-md-12">
            <div class="card">
                <!--CARD HEADER-->
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form">Información Cita</h4>
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
                            
                            <div class="row">
                                    <div class="col-md-3">
                                            <div class="form-group">
                                                    <label for="CitaServicio">Servicio:</label>
                                                    <input type="text" name="CitaServicio" id="CitaServicio" class="form-control" placeholder="Servicio" readonly value="<?php echo $Cita->DescripcionServicio;?>"/>
                                            </div>
                                    </div>
                                    <div class="col-md-4">
                                            <div class="form-group">
                                                    <label for="CitaDoctor">Doctor:</label>
                                                    <input type="text" name="CitaDoctor" id="CitaDoctor" class="form-control" placeholder="Doctor" readonly value="<?php echo $Cita->NombreDoctor;?>"/>
                                            </div>
                                    </div>
                                    <div class="col-md-2">
                                            <div class="form-group">
                                                    <label for="CitaDia">Día Cita:</label>
                                                    <input type="text" name="CitaDia" id="CitaDia" class="form-control" placeholder="Día" readonly value="<?php echo mdate("%d-%M-%y", strtotime($Cita->FechaInicio));?>"/>
                                            </div>
                                    </div>
                                    <div class="col-md-2">
                                            <div class="form-group">
                                                    <label for="CitaHora">Hora Cita:</label>
                                                    <input type="text" name="CitaDia" id="CitaDia" class="form-control" placeholder="Día" readonly value="<?php echo mdate("%H:%i", strtotime($Cita->FechaInicio));?>"/>
                                            </div>
                                    </div>
                                   
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="CitaComentarios">Comentarios:</label>
                                        <input type="text" name="CitaComentarios" id="CitaComentarios" class="form-control" placeholder="Comentarios" />
                                        
                                    </div>
                                        
                                </div>
                            </div>
                            
                            
                            
                            
                        </div>
                        <!-- FORM ACTIONS-->
                        <div class="form-actions">
                            <?php
                                if($CitaActionsEnabled== true)
                                {
                                    echo '<button type="submit" class="btn btn-warning mr-1" name="action" value="cerrar">';
                                    echo '<i class="icon-cross2"></i> Cerrar';
                                    echo '</button>';
                                    if($CitaCancelActionEnabled==true)
                                    {
                                        echo '<button type="submit" class="btn btn-danger mr-1" name="action" value="'.$CitaCancelAction.'">';
                                        echo '<i class="icon-cross2"></i> '.$CitaCancelTitle;
                                        echo '</button>';
                                    }
                                    echo '<button type="submit" class="btn btn-success" name="action" value='.$CitaSubmitAction.'>';
                                    echo '<i class="icon-check2"></i> '.$CitaSubmitTitle;
                                    echo '</button>';
                                }
                            ?>
                                
                                
                        </div>
                    </div>
                </div>
            </div><!--DIV CARD-->
        </div><!--DIV COL-MD-->
</div><!--DIV ROW MATCH-->
