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
        
        <?php echo form_open('NotaRemision_Controller/CrearNotaRemision/'.$NotaMedica->IdNotaMedica); ?>

    <!--Div Paciente-->
    <div>
        <label for="Nombre">Nombre</label>
        <input type="text" name="Nombre" id="Nombre" value="<?php echo $Paciente->Nombre; ?>"/>

        <label for="Apellidos">Apellidos</label>
        <input type="text" name="Apellidos" id="Apellidos" value="<?php echo $Paciente->Apellidos; ?>"/><br/>
        
        <label for="Edad">Edad</label>
        <input type="text" name="Edad" id ="Edad" value="<?php 
         
            $edad = (time()-strtotime($Paciente->FechaNacimiento))/ (60*60*24*365.35); 
            echo floor($edad) ?>"/>
        
        <label for="FechaNacimiento">Fecha Nacimiento</label>
        <input type="text" name="FechaNacimiento" id="FechaNacimiento" value="<?php echo $Paciente->FechaNacimiento; ?>"/><br/>
        
        <label for="calle">Calle</label>
        <input type="text" name="Calle" value="<?php echo $Paciente->Calle; ?>"/>
        
        <label for="colonia">Colonia</label>
        <input type="text" name="Colonia" value="<?php echo $Paciente->Colonia; ?>"/>
        
        <label for="cp">Código Postal</label>
        <input type="text" name="CP" value="<?php echo $Paciente->CP; ?>"/><br/>
        
        <label for="EstadoCivil">Estado Civil:</label>
        <input type="text" name="EstadoCivil" value="<?php echo $Paciente->EstadoCivil; ?>"/>
        
        <label for="ViveCon">Vive con:</label>
        <input type="text" name="ViveCon" value="<?php echo $Paciente->ViveCon; ?>"/>
        
        <label for="Escolaridad">Escolaridad</label>
        <input type="text" name="Escolaridad" value="<?php echo $Paciente->Escolaridad; ?>"/><br/>
        
        <label for="IdServiciosMedicos">Recursos Medicos</label>
        <input type="text" name="IdServiciosMedicos" value=""/>
        
        <label for="Celular">Celular:</label>
        <input type="text" name="Celular" value="<?php echo $Paciente->NumCelular; ?>"/>
        
    </div>
   
    <!--Div Somatometria-->
    <div>
        <label for="Peso">Peso</label>
        <input type="text" name="Peso" id="Peso" value="<?php echo $NotaMedica->PesoPaciente; ?>" />Kg.

        <label for="Talla">Talla</label>
        <input type="text" name="Talla" id="Talla" value="<?php echo $NotaMedica->TallaPaciente; ?>"/>mts.
        
        <label for="TA">T/A</label>
        <input type="text" name="TA" id="TA" value="<?php echo $NotaMedica->PresionPaciente; ?>"/>Mm/Hg.
        
        <label for="Temperatura">T</label>
        <input type="text" name="Temperatura" id="Temperatura" value="<?php echo $NotaMedica->TemperaturaPaciente; ?>"/>°C.
        
        <label for="FC">F/C</label>
        <input type="text" name="FC" id="FC" value="<?php echo $NotaMedica->FrCardiacaPaciente; ?>"/>L/m.
        
        <label for="FR">F/R</label>
        <input type="text" name="FR" id="FR" value="<?php echo $NotaMedica->FrRespiratoriaPaciente; ?>"/>R/m.
        
         
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
