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
            <input type="text" readonly="readonly" text="<?php echo $Paciente->Nombre." ".$Paciente->Apellidos;?>">
          <label>Fecha de Nacimiento</label>
            <input type="text">
            <label>Direccion</label>
            <input
                <?php echo "<td>".$Paciente->Nombre." ".$Paciente->Apellidos."";
                ?>
                readonly="readonly"
            > 
        </div>
        <div>
            <table>
                
            <tr>
                    <th>Servicio</th>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                   
            </tr>
                <?php
            
               foreach($ProductosNotaMedica as $Producto)
                {
                    echo "<tr>";
                    //echo "<td>".$Nota_Rem['Nombre']." ".$Nota_Rem['Apellidos']."</td>";
                    //echo "<td>".date($Nota_Rem['FechaNacimiento'])."</td>";
                    //echo "<td>".$Nota_Rem['Calle']." ".$Nota_Rem['Colonia']."</td>";
                    echo "<td>".$Producto['DescripcionServicio']."</td>";
                    echo "<td>".$Producto['DescripcionProducto']."</td>";
                    echo "<td>".$Producto['CostoProducto']."</td>";
                    echo "<td>".$Producto['CantidadProductoNM']."</td>";
                   
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
            /*
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
             
                
               }*/
            ?>
            </table>
        </div>
    </body>
</html>
