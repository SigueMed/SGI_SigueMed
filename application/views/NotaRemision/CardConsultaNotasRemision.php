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
                                        <th>Id. Nota</th>
                                        <th>No. Ticket</th>
                                        <th>Fecha Nota</th>
                                        <th>Paciente</th>

                                        <th>Estatus</th>
                                        <th>Total Nota</th>
                                        <th>Total Pagado</th>
                                        <th>Total Adeudo</th>
                                        <th>Requiere Factura</th>
                                        <th>Elaborada por</th>
                                        <th>Turno</th>
                                        <th></th>
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

<!----------------MODALS-->
<!--MODAL CANCELAR NOTA-->
<div class="modal fade" tabindex="-1" role="dialog" id="ModalCancelarNota" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <button onclick="cerrar()" type="button" class="close" id="CancelarModalCancelarNota">&times;</button>
            <h5 class="modal-title" id="actualizarModalLabel">Cancelar Nota Remisión</h5>
        </div>
        <div class="modal-body">


        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="ModalIdNotaRemision">No. Nota</label>
                    <input type="text" id="ModalIdNotaRemision" class="form-control"  name="ModalIdNotaRemision" readonly>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="ModalFolio">Folio:</label>
                    <div class="position-relative">
                        <input type="text" id="ModalFolio" class="form-control"  name="ModalFolio" readonly>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="ModalPaciente">Paciente:</label>
                    <input type="text" id="ModalPaciente" class="form-control" name="ModalPaciente" readonly>
                </div>
            </div>


        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="ModalServcio">Servicio</label>
                    <input type="text" id="ModalServcio" class="form-control" name="ModalServcio" readonly>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="ModalTotalNota">Total Nota:</label>
                    <div class="input-group">
                        <span class="input-group-addon">$</span>
                        <input type="text" id="ModalTotalNota" name="ModalTotalNota" class="form-control" readonly/>
                     </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="ModalComentariosCancelacion">Comentarios Cancelación:</label>
                    <input type="text" id="ModalComentariosCancelacion" class="form-control" name="ModalComentariosCancelacion" required>
                </div>
            </div>
        </div>




        </div>
        <div class="modal-footer">
            <button id="ModalbtnCancelarNota" type="button" onclick="CancelarNotaRemision()" class="btn btn-success">Confirmar</button>
            <button id="CancelarModalCancelarNota" onclick="cerrar()" type="button" class="btn btn-warning">Cancelar</button>
        </div>
        </div>
    </div>
</div>
<!--MODAL PAGAR NOTA REMISION-->
<div class="modal fade" tabindex="-1" role="dialog" id="ModalPagarNota" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <button onclick="cerrarPagarNota()" type="button" class="close" id="CancelarModalPagarNota">&times;</button>
            <h5 class="modal-title" id="actualizarModalLabel">Pagar Nota Remisión</h5>
        </div>
        <div class="modal-body">


        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="ModalPagarIdNotaRemision">No. Nota</label>
                    <input type="text" id="ModalPagarIdNotaRemision" class="form-control"  name="ModalPagarIdNotaRemision" readonly>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="ModalPagarFolio">Folio:</label>
                    <div class="position-relative">
                        <input type="text" id="ModalPagarFolio" class="form-control"  name="ModalPagarFolio" readonly>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="ModalPagarPaciente">Paciente:</label>
                    <input type="text" id="ModalPagarPaciente" class="form-control" name="ModalPagarPaciente" readonly>
                </div>
            </div>


        </div>

        <div class="row">
          <div class="col-md-3">
              <div class="form-group">
                  <label for="ModalPagarTotalNota">Total Nota:</label>
                  <div class="input-group">
                      <span class="input-group-addon">$</span>
                      <input type="text" id="ModalPagarTotalNota" name="ModalPagarTotalNota" class="form-control" readonly/>
                   </div>
              </div>
          </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="ModalPagarTotalPagado">Total Pagado:</label>
                    <div class="input-group">
                        <span class="input-group-addon">$</span>
                        <input type="text" id="ModalPagarTotalPagado" name="ModalPagarTotalPagado" class="form-control" readonly/>
                     </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="ModalPagarTotalPendiente">Total Pendiente:</label>
                    <div class="input-group">
                        <span class="input-group-addon">$</span>
                        <input type="text" id="ModalPagarTotalPendiente" name="ModalPagarTotalPendiente" class="form-control" readonly/>
                     </div>
                </div>
            </div>
        </div>
        <div class="row">
          <div class="col-md-4">
              <div class="form-group">
                  <label for="cb_FormaPago">Forma de Pago:</label>
                  <select id="cb_FormaPago" name="cb_FormaPago" class="form-control" required>

                  </select>

              </div>
          </div>
          <div class="col-md-3">
            <div class="form.group">
              <label for=""># Vaucher</label>
              <input type="text" class="form-control" name="txtVaucher" id="txtVaucher" placeholder="# Vaucher">

            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
                <label for="ModalPagarPago">Monto Pago</label>
                <div class="input-group">
                   <span class="input-group-addon">$</span>
                  <input type="text" id="ModalPagarPago" name="ModalPagarPago" class="form-control" placeholder="Monto" />
                </div>
            </div>

          </div>



        </div>



        </div>
        <div class="modal-footer">
            <button id="ModalbtnCancelarNota" type="button" onclick="PagarNotaRemision()" class="btn btn-success">Confirmar</button>
            <button id="CancelarModalCancelarNota" onclick="cerrarPagarNota()" type="button" class="btn btn-warning">Cancelar</button>
        </div>
        </div>
    </div>
</div>
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

         var datos = {
           FechaInicio:FechaInicio,
           FechaFin:FechaFin
         };
        CargarTabla(datos);


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

         var datos={
           FechaInicio:FechaInicio,
           FechaFin:FechaFin
         };

         CargarTabla(datos);


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
         var FechaFin = '2100/12/31';

         var datos ={
           FechaInicio:FechaInicio,
           FechaFin:FechaFin
         };
         CargarTabla(datos);
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

         var datos ={
           FechaInicio:FechaInicio,
           FechaFin:FechaFin,
           EstatusNota:'(notaremision.IdEstatusNotaRemision = 3 OR notaremision.IdEstatusNotaRemision = 4)'
         };
           CargarTabla(datos);



     }

     function CargarTabla(datos)
     {

         var t = $('#tblNotasRemision').DataTable({
           "drawCallback": function( settings ) {
                   $('[data-toggle="tooltip"]').tooltip();
                 },
             "ajax":{
               url:"<?php echo site_url();?>/NotaRemision_Controller/ConsultarNotasDeRemision",
               data:datos,
               method:"POST",
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
               "autoWidth":true,
               "columnDefs":[
                 {
                   "visible": false, "targets":[10]
                 },
                 {
                   "targets": 7, "data": "TotalNotaRemision", "render":function(data,type,row,meta)
                   {
                     return "$"+(data-row['TotalPagado']);
                     // return parseFloat(row['TotalEnEfectivo'])-parseFloat(data);
                   }
                 },
                 {
                   "targets":8, "data":"RequiereFactura", "render":function(data,type,meta,row){
                     if (data =='1')
                     {
                         return  '<input type="checkbox" checked disabled>';
                     }
                     else
                     {
                         return '<input type="checkbox" disabled readonly>';
                     }
                   }
                 },
                 {
                   "targets": 12, "data": "IdNotaRemision", "render":function(data,type,row,meta)
                   {

                     var btnAgregarPago="";

                     var btnCancelarNota="";
                     var btnVerNotaRemision="";
                     if(row['IdEstatusNotaRemision']>2)
                     {
                      btnAgregarPago=' <button type="button" style="border-radius: 200px" class="btn btn-green btn-sm" onclick="OpenModal_AgregarPago('+data+')"><i class="icon-plus3" data-toggle="tooltip" data-placement="top" id="AgregarPago" title="Agregar Pago"></i></button>';
                      //btnAgregarPago =  '<a classs = "btn" onclick="OpenModal_AgregarPago('+data+')"><i class="icon-plus3" data-toggle="tooltip" data-placement="top" id="VerEstatus" title="Agregar Pago"></i></a><br>';
                     }
                     if (row['IdEstatusNotaRemision']!=='2')
                     {
                        btnCancelarNota = ' <button type="button" style="border-radius: 200px" class="btn btn-red btn-sm" onclick="OpenModal_CancelarNota('+data+')"><i class="icon-close" data-toggle="tooltip" data-placement="top" id="CancelarNota" title="Cancelar Nota"></i></button>';
                     }

                     btnVerNotaRemision = " <a href='<?=site_url()?>/NotaRemision/CargarNotaRemision/"+data+"' target='_blank'><i class='icon-book'></i></a>";

                     return btnAgregarPago+btnCancelarNota+ btnVerNotaRemision;


                   }
                 }


               ],
               "columns": [

                     { "data": "IdNotaRemision"},
                     { "data": "Folio"},
                     { "data": "FechaNotaRemision" },
                     { "data": "NombrePaciente" },
                     { "data": "DescripcionEstatusNotaRemision" },
                     { "data": "TotalNotaRemision" },
                     { "data": "TotalPagado" },
                     {"data":"TotalNotaRemision"},
                     {"data":"RequiereFactura"},
                     { "data": "ElaboradaPor" },
                     { "data": "DescripcionTurno" },
                     {"data":"IdEstatusNotaRemision"}
                     ]

             });






     }

     function OpenModal_CancelarNota(IdNotaRemision) {

       $.ajax({
         url:"<?php echo site_url();?>/NotaRemision_Controller/ConsultarNotaRemision_ajax",
         data:{IdNotaRemision:IdNotaRemision},
         method:"POST",
         dataSrc: ""

       })
       .done(function(data) {
         var NotaRemision = JSON.parse(data);
         $("#ModalIdNotaRemision").val(NotaRemision['IdNotaRemision']);
         $("#ModalFolio").val(NotaRemision['Folio']);
         $("#ModalPaciente").val(NotaRemision['NombrePaciente']);
         $("#ModalServcio").val(NotaRemision['DescripcoinServicio']);
         $("#ModalTotalNota").val(NotaRemision['TotalNotaRemision']);


       })
       .fail(function() {
         console.log("error");
       });


       $("#ModalCancelarNota").modal('show');

     }
     function cerrar()
    {

        $('#ModalCancelarNota').modal('hide');
        limpiar();
    }

    function CancelarNotaRemision() {

      var IdNotaRemision = $("#ModalIdNotaRemision").val();
      var ComentariosCancelacion = $("#ModalComentariosCancelacion").val();

      Swal.fire({
          title:'Cancelar Nota Remisión',
          text:'¿Deseas Cancelar la Nota de Remisión #: '+IdNotaRemision +'?',
          type: 'warning',
          showConfirmButton: true,
          showCancelButton:true
      }).then((result)=>
      {
        if (result.value)
        {
          $.ajax({
            url:"<?php echo site_url();?>/NotaRemision_Controller/CancelarNotaRemision_ajax",
            data:{
              IdNotaRemision:IdNotaRemision,
              ComentariosCancelacion: ComentariosCancelacion
            },
            method:"POST",
            dataSrc: ""
          })
          .done(function() {
            Swal.fire({
              title: 'Nota Remisión Cancelada',
              text:'La Nota No.'+IdNotaRemision+' ha sido cancelada',
              type: 'success'
            });
            $('#ModalCancelarNota').modal('hide');

          })
          .fail(function() {
            console.log("error");
          });

        }
        else {
          $('#ModalCancelarNota').modal('hide');
          limpiar();
        }

      });

    }

    function limpiar() {
      $("#ModalIdNotaRemision").val('');
      $("#ModalFolio").val('');
      $("#ModalPaciente").val('');
      $("#ModalServcio").val('');
      $("#ModalTotalNota").val('');

    }

    function OpenModal_AgregarPago(IdNotaRemision) {
      $.ajax({
        url:"<?php echo site_url();?>/NotaRemision_Controller/ConsultarNotaRemision_ajax",
        data:{IdNotaRemision:IdNotaRemision},
        method:"POST",
        dataSrc: ""

      })
      .done(function(data) {
        var NotaRemision = JSON.parse(data);
        $("#ModalPagarIdNotaRemision").val(NotaRemision['IdNotaRemision']);
        $("#ModalPagarFolio").val(NotaRemision['Folio']);
        $("#ModalPagarPaciente").val(NotaRemision['NombrePaciente']);
        $("#ModalPagarServcio").val(NotaRemision['DescripcoinServicio']);
        $("#ModalPagarTotalNota").val(NotaRemision['TotalNotaRemision']);
        $("#ModalPagarTotalPagado").val(NotaRemision['TotalPagado']);

        var TotalPagado = NotaRemision['TotalPagado'];

        if (isNaN(TotalPagado))
        {
          TotalPagado = 0;
        }

        var TotalPendiente = NotaRemision['TotalNotaRemision'] - NotaRemision['TotalPagado'];
        $("#ModalPagarTotalPendiente").val(TotalPendiente);
        $("#ModalPagarPago").val(TotalPendiente);


      })
      .fail(function() {
        console.log("error");
      });
      CargarTipoPago();

      $("#ModalPagarNota").modal('show');
    }

    function cerrarPagarNota() {

      $("#ModalPagarNota").modal('hide');

    }

    function PagarNotaRemision() {

      var IdNotaRemision = $("#ModalPagarIdNotaRemision").val();
      var TotalPago = $("#ModalPagarPago").val();
      var FormaPago = $("#cb_FormaPago").val();
      var Vaucher = $("#txtVaucher").val();


      Swal.fire({
          title:'Pagar Nota Remisión',
          text:'¿Deseas Agregar el pago por: $'+TotalPago+' a la Nota de Remisión #: '+IdNotaRemision +'?',
          type: 'question',
          showConfirmButton: true,
          showCancelButton:true
      }).then((result)=>
      {
        if (result.value)
        {
          $.ajax({
            url:"<?php echo site_url();?>/NotaRemision_Controller/AgregarPagoNotaRemision_ajax",
            data:{
              IdNotaRemision:IdNotaRemision,
              TotalPago: TotalPago,
              FormaPago:FormaPago,
              Vaucher:Vaucher
            },
            method:"POST",
            dataSrc: ""
          })
          .done(function() {
            Swal.fire({
              title: 'Pago Registrado',
              text:'El pago por $'+TotalPago + ' ha sido registrado',
              type: 'success'
            });
            $('#ModalPagarNota').modal('hide');

          })
          .fail(function() {
            console.log("error");
          });

        }
        else {
          $('#ModalPagarNota').modal('hide');

        }

      });



    }

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
