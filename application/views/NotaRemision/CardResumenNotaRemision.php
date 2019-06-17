<div class="row">
    <div class="col-md-6 offset-md-6">
        <div class="card">
            <!--CARD HEADER-->
            <div class="card-header">
                <h4 class="card-title" id="basic-layout-form"><i class="icon-social-usd"></i>Resumen Nota Remisión</h4>
                


            </div>
            <!--CARD BODY-->
            <div class="card-body collapse in">
                <div class="card-block">
                    <!--FORM BODY-->
                    <div class="form-body"> 
                        <div class="row" align ="right">
                            <div class ="col-md-6">
                                <label for="resumenTotalNota">Total Nota</label>
                            </div>
                             <div class="col-md-6">
                                 <div class="form-group">
                                     
                                     <div class="input-group">
                                        <span class="input-group-addon">$</span>
                                       <input type="text" id="resumenTotalNota" name="resumenTotalNota" class="form-control" placeholder="Total" readonly/>
                                     </div>
                                 </div>  
                             </div>
                        </div>
                        <div class="row" align="right">
                            <div class ="col-md-6">
                                <label for="resumenTotalAdeudo">Total Adeudos</label>
                            </div>
                             <div class="col-md-6">
                                 <div class="form-group">
                                     
                                     <div class="input-group">
                                        <span class="input-group-addon">$</span>
                                       <input type="text" id="resumenTotalAdeudo" name="resumenTotalAdeudo" class="form-control" placeholder="Total" readonly/>
                                     </div>
                                 </div>  
                             </div>
                        </div>
                        <div class="row" align="right">
                            <div class ="col-md-6">
                                <label for="resumenTotalPago">Total a Pagar</label>
                            </div>
                             <div class="col-md-6">
                                 <div class="form-group">
                                     
                                     <div class="input-group">
                                        <span class="input-group-addon">$</span>
                                       <input type="text" id="resumenTotalPago" name="resumenTotalPago" class="form-control" placeholder="Total" />
                                     </div>
                                 </div>  
                             </div>
                        </div>
                        <div class="row" align ="right">
                            <div class ="col-md-6">
                                <label for="cb_FormaPago">Forma de Pago:</label>
                            </div>
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <select id="cb_FormaPago" name="cb_FormaPago" class="form-control" required>
                                         
                                     </select> 
                                    
                                 </div>  
                             </div>
                            
                            
                        </div>
                        
                        <div class="row" align="right">
                            <div class ="col-md-6">
                                
                                <label for="resumenSaldoPendiente">Saldo Pendiente</label>
                            </div>
                             <div class="col-md-6">
                                 <div class="form-group">
                                     
                                     <div class="input-group">
                                        <span class="input-group-addon">$</span>
                                        <input type="text" id="resumenSaldoPendiente" name="resumenSaldoPendiente" class="form-control" placeholder="Total" readonly />
                                     </div>
                                 </div>  
                             </div>
                        </div>
                        <div class="row" align="right">
                            <div class ="col-md-6">
                                <div class="form-group">
                                    <label>Requiere Factura</label>
                                    <div class="input-group">
                                        <label class="display-inline-block custom-control custom-radio ml-1">
                                                <input type="radio" name="RequiereFactura" id="chkRequiereFactura" value="1" class="custom-control-input">
                                                <span class="custom-control-indicator"></span>
                                                <span class="custom-control-description ml-0">Si</span>
                                        </label>
                                        <label class="display-inline-block custom-control custom-radio">
                                                <input type="radio" name="RequiereFactura" checked id ="chkRequiereFactura" value="0" class="custom-control-input">
                                                <span class="custom-control-indicator"></span>
                                                <span class="custom-control-description ml-0">No</span>
                                        </label>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        

                    </div>
                    <!-- FORM ACTIONS-->
                        <div class="form-actions" align="center">
                            <?php
                                if($ResumenNotaRemisionActionsEnabled== true)
                                {
                                    echo '<button type="submit" class="btn btn-warning mr-1" name="action" value="cerrar">';
                                    echo '<i class="icon-cross2"></i> Cerrar';
                                    echo '</button>';
                                    
                                    echo '<button type="submit" class="btn btn-success" name="action" value='.$ResumenNotaRemisionSubmitAction.'>';
                                    echo '<i class="icon-check2"></i> '.$ResumenNotaRemisionSubmitTitle;
                                    echo '</button>';
                                }
                            ?>
                                
                                
                        </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
      CargarTipoPago();
      
      $("#totalNota").change(function(){
            $("#resumenTotalNota").val($("#totalNota").val());
            var TotalAPagar = parseFloat($("#totalNota").val()) + parseFloat($("#TotalAdeudo").val());
            $("#resumenTotalPago").val(TotalAPagar);
            CalcularTotalesNotaRemision();
        });
  });
  
    
 function CalcularTotalesNotaRemision()
 {
     var totalNota = $("#resumenTotalNota").val();
     var totalAdeudos = $("#TotalAdeudo").val();
     var totalPagar = $("#resumenTotalPago").val();
     if (totalPagar!== "")
     {
         var totalPendiente = parseFloat(totalNota) + parseFloat(totalAdeudos) - parseFloat(totalPagar);
     }
     else
     {
         var totalPendiente = parseFloat(totalNota) + parseFloat(totalAdeudos);
     }
     
     
     $("#resumenSaldoPendiente").val(totalPendiente);
 }
 
 $("#resumenTotalPago").on('change keyup',function(){
     CalcularTotalesNotaRemision();
 });
 
 function CargarTipoPago()
 {
     $.ajax({
                  url:"<?php echo site_url();?>/NotaRemision_Controller/ConsultarTipoPago_ajax",
                  method:"POST",
                  
                  success: function(data)
                    {
                        $('#cb_FormaPago').html(data);
                       
                    }
              });
 }
 
    
</script>
