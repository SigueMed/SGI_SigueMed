

    <div onclick="location.href='<?php echo site_url('CorteCaja/ElaborarCorteCaja');?>';" class="col-xl-3 col-lg-6 col-xs-12">
        <div class="card">
            <div class="card-body">
                <div class="card-block">
                    <div class="media">
                        <div class="media-body text-xs-left">
                            <h3 class="pink">$<label id='TotalEfectivoCaja'></label></h3>
                            <span>Efectivo en Caja</span>
                        </div>
                        <div class="media-right media-middle">
                            <i class="icon-bag2 pink font-large-2 float-xs-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<script type="text/javascript">
    $(document).ready(function(){
        
        $.ajax({
            url:"<?php echo site_url();?>/CorteCaja_Controller/ConsultarBalanceCortePorTipoPago",
            data:{
                IdTipoPago:1
            },
            
            method:"POST",
            success: function(data)
              {
    
                  var BalanceEfectivo = JSON.parse(data);
                  
                  $('#TotalEfectivoCaja').html(BalanceEfectivo);
                 

              }
          });
    });
</script>
