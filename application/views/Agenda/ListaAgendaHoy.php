<style>
    td.details-control {
        background: url(<?php echo base_url('/app-assets/images/datatables/resources/details_open.png');?>) no-repeat center center;
        cursor: pointer;
        width: 5%;
    }
    tr.shown td.details-control {
        background: url(<?php echo base_url('/app-assets/images/datatables/resources/details_close.png');?>) no-repeat center center;
        width: 5%;
    }
   th { font-size: 13px; }
   td { font-size: 12px; }
</style>
<div class="row match-height">
        <div class="col-md-12">
            <div class="card">
                <!--CARD HEADER-->
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form">Consulta de Citas</h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>



                </div>
                <!--CARD BODY-->
                <div class="card-body collapse in">
                    <div class="card-block">
                        <!--FORM BODY-->
                        <div class="form-body">

                            <div class="row">
                                <div class="form-group col-md-12 col-xs-12">
                                    <button type="button" class="btn btn-secondary" id="btnCitasHoy"onclick="ConsultarCitasHoy()">
                                        <i class="icon-calendar3"></i> Hoy
                                    </button>
                                    <button type="button" class="btn btn-secondary" id="btnCitasSemana" onclick="ConsultarCitasSemana()">
                                        <i class="icon-calendar2"></i> Semana
                                    </button>
                                    <button type="button" class="btn btn-secondary" id="btnCitasTodas" onclick="ConsultarTodasCitas()">
                                        <i class="icon-table"></i> Todas
                                    </button>
                                    <button type="button" class="btn btn-secondary" id="btnCitasConfirmadas" onclick="ConsultarCitasConfirmadas()">
                                        <i class="icon-square-check"></i> Confirmadas
                                    </button>
                                    <button type="button" class="btn btn-secondary" id="btnCitasPorConfirmar" onclick="ConsultarCitasPorConfirmadas()">
                                        <i class="icon-square-minus"></i> Por Confirmar
                                    </button>
                               </div>
                            </div>
                            <table id="tblCitas" class="table table-striped table-bordered table-responsive" style="width:100%">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th></th>
                                        <th>Servicio</th>
                                        <th>Día/Hora</th>


                                        <th>Paciente</th>
                                        <th>Telefono</th>
                                        <th>Razón Cita</th>
                                        <th>Estatus</th>
                                        <th>IdEstatus</th>
                                        <th>IdNotaMedica</th>


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
       $('#tblCitas tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var t = $("#tblCitas").DataTable();
            var row = t.row( tr );

            if ( row.child.isShown() ) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            }
            else {
                // Open this row
                row.child( formatCitas(row.data()) ).show();
                tr.addClass('shown');
            }
        } );

       ConsultarCitasHoy();
    });
    function formatCitas ( d ) {
    // `d` is the original data object for the row
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
        '<tr>'+
            '<td>ElaboradaPor:</td>'+
            '<td>'+d.NombreElaboradaPor+'</td>'+
            '<td>Modificada Por:</td>'+
            '<td>'+d.NombreModificadaPor+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Fecha Modificación:</td>'+
            '<td>'+d.FechaModificacion+'</td>'+
            '<td>Comentarios:</td>'+
            '<td>'+d.ComentariosCambio+'</td>'+

        '</tr>'+

    '</table>';
    }

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

     function ConsultarCitasHoy()
     {
         var hoy  = new Date();

         var mesInicio = hoy.getMonth()+1;
         if (mesInicio<10)
         {
             mesInicio = '0'+mesInicio;
         }

         var FechaInicio = hoy.getFullYear()+'-'+mesInicio+'-'+hoy.getDate()+' 00:00:00';
         var FechaFin = hoy.getFullYear()+'-'+mesInicio+'-'+hoy.getDate()+' 23:59:59';



        CargarTabla(FechaInicio, FechaFin, 0);


     }
     function ConsultarCitasSemana()
     {
         var hoy  = new Date();

         var mesInicio = hoy.getMonth()+1;
         if (mesInicio<10)
         {
             mesInicio = '0'+mesInicio;
         }

         var FechaInicio = hoy.getFullYear()+'-'+mesInicio+'-'+hoy.getDate()+' 00:00:00';

         hoy.setDate(hoy.getDate()+7);
         mesInicio = hoy.getMonth()+1;
         if (mesInicio<10)
         {
             mesInicio = '0'+mesInicio;
         }

         var FechaFin = hoy.getFullYear()+'-'+mesInicio+'-'+hoy.getDate()+' 23:59:59';
         CargarTabla(FechaInicio,FechaFin,0);
     }
     function ConsultarTodasCitas()
     {
         var hoy  = new Date();

         var mesInicio = hoy.getMonth();
         if (mesInicio<10)
         {
             mesInicio = '0'+mesInicio;
         }

         var FechaInicio = hoy.getFullYear()+'-'+mesInicio+'-'+hoy.getDate()+' 00:00:00';
         var FechaFin = (hoy.getFullYear()+1)+'-'+mesInicio+'-'+hoy.getDate()+' 23:59:59';



        CargarTabla(FechaInicio, FechaFin, -1);

     }

     function ConsultarCitasConfirmadas()
     {
         var hoy  = new Date();

         var mesInicio = hoy.getMonth()+1;
         if (mesInicio<10)
         {
             mesInicio = '0'+mesInicio;
         }

         var FechaInicio = hoy.getFullYear()+'-'+mesInicio+'-'+hoy.getDate()+' 00:00:00';

         hoy.setDate(hoy.getDate()+7);
         mesInicio = hoy.getMonth()+1;
         if (mesInicio<10)
         {
             mesInicio = '0'+mesInicio;
         }

         var FechaFin = hoy.getFullYear()+'-'+mesInicio+'-'+hoy.getDate()+' 23:59:59';
         CargarTabla(FechaInicio,FechaFin,2);

     }

     function ConsultarCitasPorConfirmadas()
     {
          var hoy  = new Date();

         var mesInicio = hoy.getMonth()+1;
         if (mesInicio<10)
         {
             mesInicio = '0'+mesInicio;
         }

         var FechaInicio = hoy.getFullYear()+'-'+mesInicio+'-'+hoy.getDate()+' 00:00:00';

         hoy.setDate(hoy.getDate()+7);
         mesInicio = hoy.getMonth()+1;
         if (mesInicio<10)
         {
             mesInicio = '0'+mesInicio;
         }

         var FechaFin = hoy.getFullYear()+'-'+mesInicio+'-'+hoy.getDate()+' 23:59:59';
         CargarTabla(FechaInicio,FechaFin,1);

     }


     function CargarTabla(FechaInicio,FechaFin, EstatusCita)
     {

         var t = $('#tblCitas').DataTable({
            "ajax":{
                url:"<?php echo site_url();?>/Agenda_Controler/ConsultarCitas",
                method:"POST",
                data:{
                    FechaInicio:FechaInicio,
                    FechaFin:FechaFin,
                    EstatusCita: EstatusCita
                },
                dataSrc: ""
            },

             "destroy":true,
             "language": {
                  "lengthMenu": "Mostrando _MENU_ registros por pag.",
                  "zeroRecords": "Sin Datos - disculpa",
                  "info": "Motrando pag. _PAGE_ de _PAGES_",
                  "infoEmpty": "Sin registros disponibles",
                  "infoFiltered": "(filtrado de _MAX_ total)"
              },
              "columnDefs":[
                {
                    "targets":9, "render": function(data,type,row,meta)

                        {
                            var IdPerfil = <?php echo $this->session->userdata('IdPerfil');?>;

                            switch (row['IdStatusCita'])
                            {
                                case '1':
                                    return '<a classs = "btn" href="<?php echo site_url();?>/Agenda/ConfirmarCita/'+data+'"><i class="icon-square-check"> Confirmar</i></a>';
                                    break;
                                case '2':
                                    return '<a classs = "btn" href="<?php echo site_url();?>/NotaMedica/Registrar/'+data+'"><i class="icon-file2"> Atender</i></a>';
                                    break;
                                case '3':
                                    if (IdPerfil =='3')
                                    {
                                        return '<a classs = "btn" href="<?php echo site_url();?>/NotaMedica/ElaborarNota/'+row['IdNotaMedica']+'"><i class="icon-file2"> Elaborar Nota</i></a>';
                                    }
                                    else
                                    {
                                        return 'En Espera';
                                    }

                                    break;
                                default:
                                    return'...';

                            }



                        }},
                        {"visible":false, "targets" : [7,8]}

                        ],

              "columns": [
                    {
                        "className":      'details-control',
                        "orderable":      false,
                        "data":           null,
                        "defaultContent": ''
                    },
                    { "data": "DescripcionServicio" },
                    { "data": "FechaInicio" },
                    { "data": "NombrePaciente" },
                    { "data": "NumCelular" },
                    { "data": "Comentarios" },
                    { "data": "DescripcionEstatusCita" },
                    { "data": "IdStatusCita" },
                    { "data": "IdNotaMedica" },
                    { "data": "IdCitaServicio" }


                        //{ "data": "<a></<a>"}

                    ]

            });




     }

</script>

<!--<div class="row match-height">
        <div class="col-md-12">
            <div class="card">
                CARD HEADER
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form">Lista de Citas Abiertas</h4>
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
                CARD BODY
                <div class="card-body collapse in">
                    <div class="card-block">
                        FORM BODY
                        <div class="form-body">
                            <table id="Table_Citas" class="table table-striped table-bordered table-responsive" style="width:100%">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th>Día</th>
                                        <th>Hora</th>
                                        <th>Paciente</th>
                                        <th>Teléfono</th>
                                        <th>Servicio</th>
                                        <th>Nota Medica</th>
                                        <th>Estatus</th>
                                        <?php
                                         if ($this->session->userdata('IdPerfil')== MEDICO) //Administrador
                                               {
                                                   echo "<th>Crear Nota</td>";

                                               }
                                        ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    //<?php
//                                        foreach($Citas as $Cita_item)
//                                       {
//                                           echo "<tr>";
//                                           echo "<td>".date('d-m-Y',strtotime($Cita_item['FechaInicio']))."</td>";
//                                           echo "<td>".date('H:i',strtotime($Cita_item['FechaInicio']))."</td>";
//                                           echo "<td>".$Cita_item['Nombre'].' '.$Cita_item['Apellidos']."</td>";
//                                           echo "<td>".$Cita_item['NumCelular']."</td>";
//                                           echo "<td>".$Cita_item['DescripcionServicio']."</td>";
//                                           echo "<td>".$Cita_item['IdNotaMedica']."</td>";
//                                           echo "<td>";
//                                               if ($Cita_item['IdStatusCita'] == AGENDADA)
//                                               {
//                                                   echo  "<a href=".site_url('Agenda/ConfirmarCita/'.$Cita_item['IdCitaServicio']).">".$Cita_item['DescripcionEstatusCita']."</a>";
//
//                                               }
//                                               else
//                                               {
//                                                   if($Cita_item['IdStatusCita']== CONFIRMADA)
//                                                   {
//                                                       echo "<a href=".site_url('NotaMedica/Registrar/'.$Cita_item['IdCitaServicio']).">".$Cita_item['DescripcionEstatusCita']."</a>";
//                                                   }
//                                                   else
//                                                   {
//
//                                                   echo $Cita_item['DescripcionEstatusCita'];
//                                                   }
//                                               }
//                                           echo "</td>";
//
//                                           if($Cita_item['IdStatusCita']== REGISTRADA)
//                                           {
//
//                                               //$this->load->model('Servicio_Model');
//                                               if ($this->session->userdata('IdPerfil')== MEDICO) //Administrador
//                                               {
//                                                   echo "<td>";
//                                                   echo "<a href=".site_url('NotaMedica/ElaborarNota/'.$Cita_item['IdNotaMedica']).">Crear Nota</a>";
//                                                   echo "</td>";
//                                               }
//
//                                           }
//                                           else
//                                           {
//                                                echo "<td></td>";
//                                           }
//
//                                           echo "</tr>";
//                                       }
//                                   ?>
                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>
            </div>DIV CARD
        </div>DIV COL-MD
</div>DIV ROW MATCH
<script>
    $(document).ready(function(){
        $("#Table_Citas").DataTable();
    });

     function CargarTabla()
    {

    }
</script>-->
