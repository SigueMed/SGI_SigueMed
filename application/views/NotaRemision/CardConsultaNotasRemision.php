<div class="row match-height">
        <div class="col-md-12">
            <div class="card">
                <!--CARD HEADER-->
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form">Notas de Remisión</h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                                    <li><a data-action="reload"><i class="icon-reload"></i></a></li>
                                    <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                                    <li><a data-action="close"><i class="icon-cross2"></i></a></li>
                            </ul>
                    </div>
                    

                </div>
                <!--CARD BODY-->
                <div class="card-body collapse in">
                    <div class="card-block">
                        <!--FORM BODY-->
                        <div class="form-body">  
                            
                            <div class="row">
                                <div class="form-group col-md-12 col-xs-12">
                                    <button type="button" class="btn btn-secondary" id="btnNotasHoy"onclick="ConsultarNotasHoy()">
                                        <i class="icon-calendar3"></i> Hoy
                                    </button>
                                    <button type="button" class="btn btn-secondary" id="btnNotasMes" onclick="ConsultarNotasRemisionMes()">
                                        <i class="icon-calendar2"></i> Mes Actual
                                    </button>
                                    <button type="button" class="btn btn-secondary" id="btnNotasTodas" onclick="ConsultarTodasNotas()">
                                        <i class="icon-table"></i> Todas
                                    </button>
                                    <button type="button" class="btn btn-secondary" id="btnNotasPendientes" onclick="ConsultarNotasPendientes()">
                                        <i class="icon-dollar"></i> Pendientes
                                    </button>
                               </div>
                            </div>
                            <table id="tblNotasRemision" class="table table-striped table-bordered table-responsive" style="width:100%">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th>No. Nota</th>
                                        <th>Fecha Nota</th>
                                        <th>Paciente</th>
                                        
                                        <th>Estatus</th>
                                        <th>Total Nota</th>
                                        <th>Total Pagado</th>
                                        <th>Total Adeudo</th>
                                        <th>Requiere Factura</th>
                                        <th>Elaborada por</th>
                                        <th>Turno</th>
                                        <th>Acciones</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
        
                            </table>
                        </div>
                        
                    </div>
                </div>
            </div><!--DIV CARD-->
        </div><!--DIV COL-MD-->
</div><!--DIV ROW MATCH-->
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip({'placement': 'top'});
       ConsultarNotasRemisionMes();
    });
    
     function ConsultarNotasRemisionMes()
     {
         var hoy  = new Date();
         var Fin = new Date();
         Fin.setMonth(Fin.getMonth()+3);
         
         var mesInicio = hoy.getMonth()+1;
         if (mesInicio<10)
         {
             mesInicio = '0'+mesInicio;
         }
         
         var mesFin = Fin.getMonth()+1;
         if(mesFin <10)
         {
             mesFin ='0'+mesFin;
         }
         
         var FechaInicio = hoy.getFullYear()+'/'+mesInicio+'/01';
         var FechaFin = hoy.getFullYear()+'/'+mesInicio+'/31';
         
        
         
         $.ajax({
            url:"<?php echo site_url();?>/NotaRemision_Controller/ConsultarNotasDeRemision",
            data:{
                FechaInicio:FechaInicio,
                FechaFin:FechaFin
                
            },
            method:"POST",
            success: function(data)
              {
                  
                  CargarTabla(data);


              }
          });
     }
     
     function ConsultarNotasHoy()
     {
         var hoy  = new Date();
                  
         var mesInicio = hoy.getMonth()+1;
         if (mesInicio<10)
         {
             mesInicio = '0'+mesInicio;
         }
         
         var FechaInicio = hoy.getFullYear()+'/'+mesInicio+'/'+hoy.getDate();
         var FechaFin = hoy.getFullYear()+'/'+mesInicio+'/'+hoy.getDate();
         
        
         
         $.ajax({
            url:"<?php echo site_url();?>/NotaRemision_Controller/ConsultarNotasDeRemision",
            data:{
                FechaInicio:FechaInicio,
                FechaFin:FechaFin
                
            },
            method:"POST",
            success: function(data)
              {
                  
                  CargarTabla(data);


              }
          });
     }
     function ConsultarTodasNotas()
     {
         var hoy  = new Date();
                  
         var mesInicio = hoy.getMonth()+1;
         if (mesInicio<10)
         {
             mesInicio = '0'+mesInicio;
         }
         
         var FechaInicio = '1900/01/01';
         var FechaFin = '2100/12/31';;
         
        
         
         $.ajax({
            url:"<?php echo site_url();?>/NotaRemision_Controller/ConsultarNotasDeRemision",
            data:{
                FechaInicio:FechaInicio,
                FechaFin:FechaFin
                
            },
            method:"POST",
            success: function(data)
              {
                  
                  CargarTabla(data);


              }
          });
     }
     
     function ConsultarNotasPendientes()
     {
         var hoy  = new Date();
                  
         var mesInicio = hoy.getMonth()+1;
         if (mesInicio<10)
         {
             mesInicio = '0'+mesInicio;
         }
         
         var FechaInicio = '1900/01/01';
         var FechaFin = '2100/12/31';
         
        
         
         $.ajax({
            url:"<?php echo site_url();?>/NotaRemision_Controller/ConsultarNotasDeRemision",
            data:{
                FechaInicio:FechaInicio,
                FechaFin:FechaFin,
                EstatusNota:'notaremision.IdEstatusNotaRemision = 3 OR notaremision.IdEstatusNotaRemision = 4'
                
            },
            method:"POST",
            success: function(data)
              {
                  
                  CargarTabla(data);


              }
          });
     }
     
     function CargarTabla(data)
     {
         var NotasRemision = JSON.parse(data);
         
        var t = $('#tblNotasRemision').DataTable({
                  "destroy":true,
                  "language": {
                       "lengthMenu": "Mostrando _MENU_ registros por pag.",
                       "zeroRecords": "Sin Datos - disculpa",
                       "info": "Motrando pag. _PAGE_ de _PAGES_",
                       "infoEmpty": "Sin registros disponibles",
                       "infoFiltered": "(filtrado de _MAX_ total)"
                   }

                   });   
           t.clear();
           t.draw();
           var adeudo = 0;
           var requiereFactura ="";
           var acciones = "";
           
          for(i=0;i<NotasRemision.length;i++)
          {
              adeudo = parseFloat(NotasRemision[i]['TotalNotaRemision']) - parseFloat(NotasRemision[i]['TotalPagado']);
              
              if (NotasRemision[i]['RequiereFactura']==='1')
              {
                  requiereFactura = '<input type="checkbox" checked disabled>';
              }
              else
              {
                  requiereFactura = '<input type="checkbox" disabled readonly>';
              }
              
              acciones = '<a class="btn"><i class="icon-list-numbered" data-toggle="tooltip" title="Detalle"></i></a>';
              
              
              t.row.add([
                  NotasRemision[i]['IdNotaRemision'],
                  NotasRemision[i]['FechaNotaRemision'],
                  NotasRemision[i]['NombrePaciente'],
                  
                  NotasRemision[i]['DescripcionEstatusNotaRemision'],
                  '$'+ NotasRemision[i]['TotalNotaRemision'],
                  '$'+NotasRemision[i]['TotalPagado'],
                  '$'+adeudo,
                  requiereFactura,
                  NotasRemision[i]['ElaboradaPor'],
                  NotasRemision[i]['DescripcionTurno'],
                  acciones
                  

              ]).draw(false);




          }
     }
     
</script>
