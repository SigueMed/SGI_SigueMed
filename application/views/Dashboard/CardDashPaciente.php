

    
    <div onclick="location.href='<?php echo site_url('Paciente/SeguimientoPaciente');?>';" class="col-xl-3 col-lg-6 col-xs-12">
        <div class="card">
            <div class="card-body">
                <div class="card-block">
                    <div class="media">
                        <div class="media-body text-xs-left">
                            <h3 class="teal"><label id='PacientesSeguimiento' name='PacientesSeguimiento'></label></h3>
                            <span>Seguimientos del día</span>
                        </div>
                        <div class="media-right media-middle">
                            <i class="icon-phone teal font-large-2 float-xs-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-xs-12">
        <div class="card">
            <div class="card-body">
                <div class="card-block">
                    <div class="media">
                        <div class="media-body text-xs-left">
                            <h3 class="deep-orange"><label id='CitasDia'></label></h3>
                            <span>Citas del día</span>
                        </div>
                        <div class="media-right media-middle">
                            <i class="icon-calendar3 deep-orange font-large-2 float-xs-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    


<script type="text/javascript">
    $(document).ready(function(){
        
        CargarSeguimientos();
        CargarCitasDia();
        
    });
    
    function CargarSeguimientos()
    {
      $.ajax({
            url:"<?php echo site_url();?>/Seguimiento_Controller/ConsultarTotalSeguimientos_ajax",
            
            
            method:"POST",
            success: function(data)
              {
    
                  var SeguimientosDia = JSON.parse(data);
                  
                  
                  $('#PacientesSeguimiento').html(SeguimientosDia['TotalSeguimientos']);
                 

              }
          });  
    }
    
    function CargarCitasDia()
    {
      $.ajax({
            url:"<?php echo site_url();?>/Agenda_Controler/ConsultarTotalCitasDia_ajax",
            
            
            method:"POST",
            success: function(data)
              {
    
                  var CitasDia = JSON.parse(data);
                  
                  
                  $('#CitasDia').html(CitasDia['TotalCitas']);
                 

              }
          });  
    }
    
</script>
