<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Nota de Remision</title>
    </head>
    <body>
        <?php
        
    ?>
        
        <table>
            <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Fecha de Nacimiento</th>
                <th>Direccion</th>
                <th>Fecha de NotaMedica</th>
                <th>Peso</th>
                <th>Talla</th>
                <th>Temperatura</th>
                <th>IMC</th>
                <th>Presion</th>
                <th>Frecuencia Cardiaca</th>
                <th>Frecuencia Respiratoria</th>
                <th>Cantidad de Productos</th>
                <th>Descuento</th>
            </tr>
            
       
        
        <?php
        
            foreach($Nota as $Nota_Rem)
            {
                echo "<tr>";
                echo "<td>".$Nota_Rem['DescripcionServicio']."</td>";
                echo "<td>".$Nota_Rem['Nombre']."</td>";
                echo "<td>".$Nota_Rem['Apellidos']."</td>";
                echo "<td>".date($Nota_Rem['FechaNacimiento'])."</td>";
                echo "<td>".$Nota_Rem['Direccion']."</td>";
                echo "<td>".date($Nota_Rem['FechaNotaMedica'])."</td>";
                echo "<td>".$Nota_Rem['PesoPaciente']."</td>";
                echo "<td>".$Nota_Rem['TallaPaciente']."</td>";
                echo "<td>".$Nota_Rem['TemperaturaPaciente']."</td>";
                echo "<td>".$Nota_Rem['IMCPaciente']."</td>";
                echo "<td>".$Nota_Rem['PresionPaciente']."</td>";
                echo "<td>".$Nota_Rem['FrCardiacaPaciente']."</td>";
                echo "<td>".$Nota_Rem['FrRespiratoriaPaciente']."</td>";
                echo "<td>".$Nota_Rem['CantidadProductoNM']."</td>";
                echo "<td>".$Nota_Rem['Descuento']."</td>";
                echo "</tr>";
                
            }
        ?>
        </table>
    </body>
</html>
