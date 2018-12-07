<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Nota de Remision</title>
        <link rel="stylesheet" href="<?php echo base_url("assets/bootstrap_1/css/bootstrap.css"); ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/alertifyjs/css/alertify.css"); ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/alertifyjs/css/themes/default.css"); ?>"/>
        
        <script src="assets/jquery-3.3.1.min.js"></script>
        <script src="assets/bootstrap_1/js/bootstrap.js"></script>
        <script src="assets/alertifyjs/alertify.js"></script>
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
    <div class="container">
    <div >
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
   
    
    
    <div class="row">
     <div class="col-sm-12">
         <h2></h2>
         <h3></h3>
         <h3></h3>
         <h3></h3>
        <table class="table table-hover table-condensed table-bordered">
                
            
          
            <tr>
                    <th>Servicio</th>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad de Productos</th>
                    <th>Descuento</th>
                    <td>Total</td>
                    <th>Total Con Descuento</th>
                        
                   
            </tr>
            <?php
            
               foreach($ProductosNotaMedica as $Producto)
                {
                    $costo = $Producto['CostoProducto'];
                    $Cantidad = $Producto['CantidadProductoNM'];
                    $Descuento = $Producto['Descuento'];
                    $totalGeneral = $costo * $Cantidad;
                    $DescuentoADec = $Descuento/100;
                    $DescuentoTotal = $DescuentoADec * 1.0;
                    $AplicarDescuento = $totalGeneral * $DescuentoTotal; 
                    $total = $totalGeneral - $AplicarDescuento;
                    echo "<tr>";
                    echo "<td>".$Producto['DescripcionServicio']."</td>";
                    echo "<td>".$Producto['DescripcionProducto']."</td>";
                    echo "<td>".$Producto['CostoProducto']."</td>";
                    echo "<td>".$Producto['CantidadProductoNM']."</td>";
                    echo "<td>".$Producto['Descuento']."%"."</td>";
                    echo "<td>".$totalGeneral."</td>";
                    echo "<td>".$total."</td>";
                    echo "</tr>";
             
                }
            ?>
              </table>
        </div>
    </div>
   
    <div> 
        
        <a href="<?php echo site_url('/Agenda/CitasAtendidas')?>" class="btn btn-primary">Volver</a>
    </div>
   </div> 
    </body>
</html>
