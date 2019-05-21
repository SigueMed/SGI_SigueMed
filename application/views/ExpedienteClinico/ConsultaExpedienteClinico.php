 
   
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Servicio</th>
                <th>Fecha Nota</th>
                <th>No. Nota Medica</th>
                <th>Ver Nota</th>
                
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($PacientesExpediente as $Paciente)
                {
                    echo'<tr>';
                    echo'<td>'.$Paciente['Nombre'].'</td>';
                    echo'<td>'.$Paciente['Apellidos'].'</td>';
                    echo'<td>'.$Paciente['DescripcionServicio'].'</td>';
                    echo'<td>'.$Paciente['FechaNotaMedica'].'</td>';
                    echo'<td>'.$Paciente['IdNotaMedica'].'</td>';
                    echo'<td align="center"><a href="'.site_url('ExpedienteClinico/ConsultarNotaMedica/'.$Paciente['IdNotaMedica']).'"><i class="icon-clipboard3"></i></a></td>';
                    echo '</tr>';
                    
                }
            ?>
            
        </tbody>
        
    </table>

<script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable();
} );
</script>

