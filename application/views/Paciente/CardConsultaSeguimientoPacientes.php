<style>
    td.details-control {
        background: url(<?php echo base_url('/app-assets/images/datatables/resources/details_open.png');?>) no-repeat center center;
        cursor: pointer;
    }
    tr.shown td.details-control {
        background: url(<?php echo base_url('/app-assets/images/datatables/resources/details_close.png');?>) no-repeat center center;
    }
    th { font-size: 14px; }
    td { font-size: 13px; }
</style>
<div class="row match-height">
        <div class="col-md-12">
            <div class="card">
                <!--CARD HEADER-->
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form">Seguimiento Pacientes</h4>
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
                            <table id="tbl_SeguimientoPacientes" class="table table-striped table-bordered table-responsive" style="width:100%">
                                <thead>
                                    <tr>
                                        <th colspan="7">Seguimiento</th>
                                        <th colspan="6">Llamadas Seguimiento</th>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <th>Paciente</th>
                                        <th>Teléfono</th>
                                        <th>Seguimiento</th> 
                                        <th>Fecha Seguimiento</th>
                                        <th>Estatus</th>
                                        <th>Comentarios</th>
                                        <th>Primera</th>
                                        <th>Fecha </th>
                                        <th>Segunda</th>
                                        <th>Fecha </th>
                                        <th>Tercera</th>
                                        <th>Fecha </th>


                                    </tr>
                                </thead>
                                <tbody>
                                     

                                </tbody>

                            </table>
                            
                            <!--MODAL FechaConfirmación-->
                            <div class="modal fade" tabindex="-1" role="dialog" id="ModalLlamada" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h5 class="modal-title">Llamada Seguimiento</h5>
                                    <input type="hidden" id="ModalLlamada_IdSeguimientoMedico" name="IdSeguimientoMedico">
                                    <input type="hidden" id="ModalLlamada_IdEstatusSeguimiento" name="IdEstatusSeguimiento">
                                </div>
                                <div class="modal-body">
                                    <div class = "row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="ModalLlamada_FechaLlamada">Fecha Llamada:</label>
                                                <div class="position-relative has-icon-left">
                                                    <input type="date" id="ModalLlamada_FechaLlamada" class="form-control" name="ModalLlamada_FechaLlamada"/>
                                                    <div class="form-control-position">
                                                        <i class="icon-calendar5"></i>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="ModalLlamada_cbRespuestaLlamada">Respuesta:</label>
                                                <select name="ModalLlamada_cbRespuestaLlamada" id="ModalLlamada_cbRespuestaLlamada" class="form-control" onchange="">
                                                    <option value="">Respuestas...</option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="ModalLamada_Comentarios">Comentarios</label>
                                                <div class="position-relative has-icon-left">
                                                        <textarea id="ModalLamada_Comentarios" rows="3" class="form-control" name="ModalLamada_Comentarios" placeholder="Comentarios"></textarea>
                                                        <div class="form-control-position">
                                                                <i class="icon-file2"></i>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button id="ConfirmarFecha" type="button" class="btn btn-primary" data-dismiss="modal">Llamar...</button>
                                    <button id="CancelarFecha" type="button" class="btn btn-success" data-dismiss="modal">Atendido</button>
                                    <button id="CancelarFecha" type="button" class="btn btn-danger" data-dismiss="modal">Rechazado</button>
                                    <button id="CancelarFecha" type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
                                    <button id="CancelarFecha" type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                </div>
                                </div>
                            </div>
                            </div> 
                            </div>
                        
                    </div>
                </div>
            </div><!--DIV CARD-->
        </div><!--DIV COL-MD-->
</div><!--DIV ROW MATCH-->

<script type="text/javascript">
    $(document).ready(function() {
        
        CargarSeguimientoPacientes();
        
        // Add event listener for opening and closing details
        $('#tbl_SeguimientoPacientes tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var t = $("#tbl_SeguimientoPacientes").DataTable();
            var row = t.row( tr );

            if ( row.child.isShown() ) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            }
            else {
                // Open this row
                row.child( LoadRowDetail(row.data()) ).show();
                tr.addClass('shown');
            }
        } );
        
} );

function CargarSeguimientoPacientes()
{
    var t = $('#tbl_SeguimientoPacientes').DataTable({
        "ajax":{
            url:"<?php echo site_url();?>/Paciente_Controller/ConsultarSeguimientoPacientes_ajax",
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
          "columnDefs": [
                { "width": "20%", "targets": [1,3] }
              ],
          "columns": [
                {
                    "className":      'details-control',
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": ''
                },
                { "data": "NombrePaciente" },
                { "data": "NumCelular" },
                { "data": "DescripcionSeguimiento" },
                { "data": "FechaSeguimiento" },
                { "data": "DescripcionEstatusSeguimiento" },
                { "data": "ObservacionesSeguimiento" },
                { "data": "Respuesta1" },
                { "data": "FechaRespuesta_1" },
                { "data": "Respuesta2" },
                { "data": "FechaRespuesta_2" },
                { "data": "Respuesta3" },
                { "data": "FechaRespuesta_3" }
                ]

        });
            
}
function LoadRowDetail ( d ) {
    // `d` is the original data object for the row
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
        '<tr>'+
            '<td colspan="2">Elaborado Por:</td>'+
            '<td colspan="2">'+d.NombreElaboradoPor+'</td>'+
                       
        '</tr>'+
        '<tr>'+
            '<td>Llamada 1:</td>'+
            '<td>'+d.NombreEmpleado_1+'</td>'+
            '<td>Llamada 2:</td>'+
            '<td>'+d.NombreEmpleado_2+'</td>'+
            
        '</tr>'+
        
    '</table>';
}
function ConfirmarSeguimientoPaciente(IdSeguimientoMedico, IdEstatusSeguimiento)
    {        
        $('#ModalLlamada_IdSeguimientoMedico').val(IdSeguimientoMedico);
        $('#ModalLlamada_IdEstatusSeguimiento').val(IdEstatusSeguimiento);
        var fecha = new Date(); 
        var mes = fecha.getMonth()+1; 
        var dia = fecha.getDate(); 
        var ano = fecha.getFullYear();
        if(dia<10)
            dia='0'+dia;
        if(mes<10)
            mes='0'+mes;
        
        var hoy = ano+"-"+mes+"-"+dia;
        $('#ModalLlamada_FechaLlamada').val(hoy);
        $("#ModalLlamada").modal('show');
    }
//    
</script>
