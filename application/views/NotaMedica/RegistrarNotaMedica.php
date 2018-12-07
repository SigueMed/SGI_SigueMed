<!DOCTYPE html>
<html>
<head>
    <title>NOTA MEDICA</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <style>
        .box 
        {
            width:100%;
            max-width: 650px;
            margin:0 auto;
            
        }
    </style>
    
</head>
<body>
    
    <?php
        if (isset($errorMessage)) {
            echo "<div class='message'>";
            echo $errorMessage;
            echo "</div>";
        }
    ?>
    <?php echo validation_errors(); ?>
    
    <?php echo form_open('NotaMedica_Controller/ElaborarNotaMedica/'.$NotaMedica->IdNotaMedica); ?>
    
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
    
    
    <!--Div Antecedentes -->
    
    <div>
         <?php
    
    if ($Antecedentes!=FALSE)
    {
        foreach ($Antecedentes as $AntecedenteNota)
        {
            echo "<label for='Antecendete".$AntecedenteNota['IdAntecedenteNotaMedica']."'>".$AntecedenteNota['DescripcionAntecedente']."</label></br>";
            echo "<textarea cols='100' rows='10' name='Antecedente".$AntecedenteNota['IdAntecedenteNotaMedica']."' id='Antecedente".$AntecedenteNota['IdAntecedenteNotaMedica']."'>".$AntecedenteNota['DescripcionAntecedenteNotaMedica']."</textarea></br>";

            // put your code here
        }
    }
    else
    {
        echo "No carga antecedentes";
        echo $NotaMedica->IdNotaMedica;
        echo count($Antecedentes);
    }
    
    ?>
    </div>
    
    <div class="row clearfix">
    <div class="col-md-12">
      <button id="add_row" class="btn btn-default pull-left">Add Row</button>
      <button id='delete_row' class="pull-right btn btn-default">Delete Row</button>
    </div>
  </div>
    
    <!-- DIV TABLA PRODUCTOS-->
    <div class="container">
        <div class="row clearfix">
          <div class="col-md-12">
            <table class="table table-bordered table-hover" id="tab_logic">
              <thead>
                <tr>
                  <th class="text-center"> # </th>
                  <th class="text-center"> Servicio </th>
                  <th class="text-center"> Producto </th>
                  <th class="text-center"> P. Unitario </th>
                  <th class="text-center"> Cantidad </th>
                  <th class="text-center"> Descuento </th>
                  <th class="text-center"> Total </th>
                </tr>
              </thead>
              <tbody>
                <tr id='addr0'>
                  <td>1</td>
                  <td><label id="IdServicio" name="IdServicio[]" hidden="true"></label><input type="text" name='servicio[]'  placeholder='Enter Service Name' class="form-control"/></td>
                  <td><label id="IdProducto" name="IdProducto[]" hidden="true"></label><input type="text" name='producto[]'  placeholder='Enter Product Name' class="form-control"/></td>
                  <td><input type="number" name='precio[]' placeholder='Enter Unit Price' class="form-control price" readonly/></td>
                  <td><input type="number" name='cantidad[]' placeholder='Enter Qty' class="form-control qty" step="0" min="0"/></td>
                  <td><input type="number" name='descuento[]' placeholder='Enter Qty' class="form-control qty" step="10" min="0"/></td>
                  <td><input type="number" name='total[]' placeholder='0.00' class="form-control total" readonly/></td>
                </tr>
                <tr id='addr1'></tr>
              </tbody>
            </table>
          </div>
        </div>
    
    <!--DIV PRODUCTOS-->
    <div class="table-responsive">
    <table class="table table-bordered" id="crud_table">
     <tr>
        <th width="10%">Servicio</th>
        <th width="10%">Producto</th>
        <th width="10%">Precio</th>
        <th width="10%">Cantidad</th>
        <th width="10%">SubTotal</th>
        <th width="10%">Descuento</th>
        <th width="10%">Total</th>
        <th width="5%">Acción</th>
     </tr>
     <tr>
         <td>
             <div class="form-group">
                <select name="servicio" id="servicio">
                <option value="">Selecciona un Servicio</option>
                <?php foreach ($Servicios as $servicio)
                {
                    echo '<option value ="'.$servicio['IdServicio'].'">'.$servicio['DescripcionServicio'].'</option>';
                }
                ?>
                </select>
             </div>
         </td>
         <td>
             
                <div class="form-group">
                    <select name="producto" id="producto" >
                    <option value="">Selecciona un Producto</option>
                    </select>
                </div>
         </td>
         <td contenteditable="true"><input type="text" id="precio" name="precio"/></td>
         <td contenteditable="true"><input type="text" id="cantidad" name="cantidad"/></td>
         <td>Sub Total</td>
         <td contenteditable="true" >D</td>
         <td>Total</td>
         <td></td>
     </tr>
    </table>
        <div align="right">
            <button type="button" name="add" id="add" class="btn btn-success btn-xs">Agregar</button>
        </div>
    </div>
    
    <div class="row clearfix" style="margin-top:20px">
    <div class="pull-right col-md-4">
      <table class="table table-bordered table-hover" id="tab_logic_total">
        <tbody>
          <tr>
            <th class="text-center">Sub Total</th>
            <td class="text-center"><input type="number" name='sub_total' placeholder='0.00' class="form-control" id="sub_total" readonly/></td>
          </tr>
          <tr>
            <th class="text-center">Tax</th>
            <td class="text-center"><div class="input-group mb-2 mb-sm-0">
                <input type="number" class="form-control" id="tax" placeholder="0">
                <div class="input-group-addon">%</div>
              </div></td>
          </tr>
          <tr>
            <th class="text-center">Tax Amount</th>
            <td class="text-center"><input type="number" name='tax_amount' id="tax_amount" placeholder='0.00' class="form-control" readonly/></td>
          </tr>
          <tr>
            <th class="text-center">Grand Total</th>
            <td class="text-center"><input type="number" name='total_amount' id="total_amount" placeholder='0.00' class="form-control" readonly/></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
    
    
    <!--Div Botones-->
    <div>
        <button type="submit" name="action" value="guardar">Guardar</button>
        <button type="submit" name="action" value="cancelar">Cancelar</button>
    </div>
   
    
    </form>
</body>
<script type='text/javascript' language='javascript'>
    
    $(document).ready(function(){
    var i=1;
    $("#add_row").click(function(){
        b=i-1;
      	$('#addr'+i).html($('#addr'+b).html()).find('td:first-child').html(i+1);
      	$('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
      	i++; 
  	});
    $("#delete_row").click(function(){
    	if(i>1){
		$("#addr"+(i-1)).html('');
		i--;
		}
		calc();
	});
	
	$('#tab_logic tbody').on('keyup change',function(){
		calc();
	});
	$('#tax').on('keyup change',function(){
		calc_total();
	});
        
       
	

});

function calc()
{
	$('#tab_logic tbody tr').each(function(i, element) {
		var html = $(this).html();
		if(html!='')
		{
			var qty = $(this).find('.qty').val();
			var price = $(this).find('.price').val();
			$(this).find('.total').val(qty*price);
			
			calc_total();
		}
    });
}

function calc_total()
{
	total=0;
	$('.total').each(function() {
        total += parseInt($(this).val());
    });
	$('#sub_total').val(total.toFixed(2));
	tax_sum=total/100*$('#tax').val();
	$('#tax_amount').val(tax_sum.toFixed(2));
	$('#total_amount').val((tax_sum+total).toFixed(2));
}
    $(document).ready(function()
    {
         $("#servicio").change(function(){
           
          var servicio_id = $('#servicio').val();
          alert(servicio_id);
          if(servicio_id!='')
          {

              $.ajax({
                  url:"<?php echo site_url();?>/NotaMedica_Controller/ConsultarProductosPorServicio",
                  method:"POST",
                  data:{servicio_id:servicio_id},
                  success: function(data)
                    {
                        $('#producto').html(data);
                    }
              });
              
          }
          
       }); 
       
    });
</script>
<script>
$(document).ready(function(){
    var count = 1;
        $('#add').click(function(){
            alert('hola');
        count = count + 1;
        
        var html_code = "<tr id='row"+count+"'>";
            html_code += "<td class='item_name'><select name='servicio' id='servicio'>";
            html_code += "<option value=''>Selecciona un Servicio</option>";
            //mandar a guardar todo el php en una variable y mandarla a llamar al html_code
            html_code += "<?php foreach ($Servicios as $servicio){echo '<option value ='.$servicio['IdServicio'].'>'.$servicio['DescripcionServicio'].'</option>';}?>";
           
            html_code += "</select></td>";
             html_code += "<td class='item_name'><select name='producto' id='producto'>";
            html_code += "<option value=''>Selecciona un Producto</option>";
            html_code += "</select></td>";

            html_code += "<td contenteditable='true' class='item_code'></td>";
            html_code += "<td contenteditable='true' class='item_code'></td>";
            html_code += "<td contenteditable='true' class='item_code'></td>";
            html_code += "<td contenteditable='true' class='item_desc'></td>";
            
            html_code += "<td contenteditable='true' class='item_price' ></td>";
        
        html_code += "<td><button type='button' name='remove' data-row='row"+count+"' class='btn btn-danger btn-xs remove'>Remover</button></td>";  
            html_code += "</tr>";  
            $('#crud_table').append(html_code);
        });        
 $(document).on('click', '.remove', function(){
  var delete_row = $(this).data("row");
  $('#' + delete_row).remove();
 });
 
 $('#save').click(function(){
  var item_name = [];
  var item_code = [];
  var item_desc = [];
  var item_price = [];
  $('.item_name').each(function(){
   item_name.push($(this).text());
  });
  $('.item_code').each(function(){
   item_code.push($(this).text());
  });
  $('.item_desc').each(function(){
   item_desc.push($(this).text());
  });
  $('.item_price').each(function(){
   item_price.push($(this).text());
  });
  $.ajax({
   url:"insert.php",
   method:"POST",
   data:{item_name:item_name, item_code:item_code, item_desc:item_desc, item_price:item_price},
   success:function(data){
    alert(data);
    $("td[contentEditable='true']").text("");
    for(var i=2; i<= count; i++)
    {
     $('tr#'+i+'').remove();
    }
    fetch_item_data();
   }
  });
 });
 
 function fetch_item_data()
 {
  $.ajax({
   url:"fetch.php",
   method:"POST",
   success:function(data)
   {
    $('#inserted_item_data').html(data);
   }
  })
 }
 fetch_item_data();
 
});
</script>


</html>
