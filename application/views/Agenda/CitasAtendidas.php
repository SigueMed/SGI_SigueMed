<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Citas Atendidas</title>
    </head>
    <body>
        
         <?php
        if (isset($errorMessage)) {
            echo "<div class='message'>";
            echo $errorMessage;
            echo "</div>";
        }
    ?>
        
        <table>
            <tr>
                <th>Servicio</th>
                <th>Paciente</th>
                <th>Hora</th>
                <th>Nota Remision</th>
                
            </tr>
            
       
        
        <?php
        
            foreach($Citas as $Cita_Item)
            {
                echo "<tr>";
                echo "<td>".$Cita_Item['DescripcionServicio']."</td>";
                echo "<td>".$Cita_Item['Nombre']." ".$Cita_Item['Apellidos']."</td>";
                echo "<td>".date('H:i',strtotime($Cita_Item['HoraCita']))."</td>";
                echo "<td><a href=".site_url('NotaRemision/CrearNota/'.$Cita_Item['IdCitaServicio']).">Crear</td>";
                echo "</tr>";
                
            }
        ?>
        </table>
    </body>
</html>
