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
        if (isset($errorMessage)) {
            echo "<div class='message'>";
            echo $errorMessage;
            echo "</div>";
        }
    ?>
        <div>
            <label>Nombre</label>
            <input type="text">
          <label>Fecha de Nacimiento</label>
            <input type="text">
            <label>Direccion</label>
            <input type="text">
        </div>
        <div>
            <table>
                <tr>
              
                    <th>Fecha de NotaMedica</th>
                    <th>Peso</th>
                    <th>Talla</th>
                    <th>Temperatura</th>
                    <th>IMC</th>
                    <th>Presion</th>
                    <th>Frecuencia Cardiaca</th>
                    <th>Frecuencia Respiratoria</th>
                </tr>
                <?php
            
                foreach($Nota as $Nota_Rem)
                {
                    echo "<tr>";
                    //echo "<td>".$Nota_Rem['Nombre']." ".$Nota_Rem['Apellidos']."</td>";
                    //echo "<td>".date($Nota_Rem['FechaNacimiento'])."</td>";
                    //echo "<td>".$Nota_Rem['Calle']." ".$Nota_Rem['Colonia']."</td>";
                    echo "<td>".date($Nota_Rem['FechaNotaMedica'])."</td>";
                    echo "<td>".$Nota_Rem['PesoPaciente']."</td>";
                    echo "<td>".$Nota_Rem['TallaPaciente']."</td>";
                    echo "<td>".$Nota_Rem['TemperaturaPaciente']."</td>";
                    echo "<td>".$Nota_Rem['IMCPaciente']."</td>";
                    echo "<td>".$Nota_Rem['PresionPaciente']."</td>";
                    echo "<td>".$Nota_Rem['FrCardiacaPaciente']."</td>";
                    echo "<td>".$Nota_Rem['FrRespiratoriaPaciente']."</td>";
                    echo "</tr>";
             
                
                }
            ?>
              </table>
            
        </div>
        <div>
            <table>
                <tr>
              
                    <th>Descripcion de Servicio</th>
                    <th>Cantidad de Productos</th>
                    <th>Descuento</th>
                  <!-- <td> <a href = "/sgi_siguemed/index.php/Agenda/CitasAtendidas"  >Volver</td>
                  --->
                </tr>
                
            <?php
            
                foreach($Nota as $Nota_Rem)
                {
                    echo "<tr>";
                    //echo "<td>".$Nota_Rem['Nombre']." ".$Nota_Rem['Apellidos']."</td>";
                    //echo "<td>".date($Nota_Rem['FechaNacimiento'])."</td>";
                    //echo "<td>".$Nota_Rem['Calle']." ".$Nota_Rem['Colonia']."</td>";
                  
                    echo "<td>".$Nota_Rem['DescripcionProducto']."</td>";
                    echo "<td>".$Nota_Rem['CantidadProductoNM']."</td>";
                    echo "<td>".$Nota_Rem['Descuento']."</td>";
                    echo "<td><a href=".site_url('/sgi_siguemed/index.php/Agenda/CitasAtendidas').">Crear</td>";
                    echo "</tr>";
             
                
                }
            ?>
            </table>
        </div>
    </body>
</html>
