<div class="row match-height">
        <div class="col-md-12">
            <div class="card">
                <!--CARD HEADER-->
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form">Consulta Pacientes</h4>
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
                            <table id="Inventario" class="table table-striped table-bordered" style="width:80%">
                                    <thead>
                                        <tr>
                                            <th>Nombre(s)</th>
                                            <th>Apellidos</th>
                                            <th>Teléfono</th> 
                                            <th>email</th>
                                            <th>Acciones</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php
                                            foreach($Pacientes as $Paciente)
                                            {
                                                echo'<tr>';
                                                echo'<td>'.$Paciente['Nombre'].'</td>';
                                                echo'<td>'.$Paciente['Apellidos'].'</td>';
                                                echo'<td>'.$Paciente['NumCelular'].'</td>';
                                                echo'<td>'.$Paciente['email'].'</td>';
                                               
                                                echo'<td align="center"><a href="'. site_url('Paciente/EditarPaciente/'. $Paciente['IdPaciente']).'"><i class="icon-edit" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Editar"></i></a><a href="#" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Expediente"><i class="icon-ios-albums"></i></a></td>';
                                                echo '</tr>';

                                            }
                                        ?>


                                    </tbody>

                                </table>
                            </div>
                        
                    </div>
                </div>
            </div><!--DIV CARD-->
        </div><!--DIV COL-MD-->
</div><!--DIV ROW MATCH-->

<script type="text/javascript">
    $(document).ready(function() {
    $('#Inventario').DataTable();
} );
</script>