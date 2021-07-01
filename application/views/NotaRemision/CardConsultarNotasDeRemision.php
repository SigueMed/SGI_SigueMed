<style>
    .inputNombrePaciente{
         width: 300px;
    }
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
                    <h4 class="card-title" id="basic-layout-form">Notas De Remision</h4>
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

                            <table id="tblNotasRemision" class="table table-striped table-bordered table-responsive" style="width:100%">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th></th>
                                        <th>Id. Nota</th>
                                        <th>Foliador</th>
                                        <th>Clínica</th>
                                        <th>Fecha Nota</th>
                                        <th>Paciente</th>
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

<script type="text/javascript">
    $(document).ready(function(){
        CargarNotaRemision();

        $('#tblNotasRemision tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var t = $("#tblNotasRemision").DataTable();
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
});

function CargarNotaRemision()
{
    var t = $('#tblNotasRemision').DataTable({
        "drawCallback": function( settings ) {
                $('[data-toggle="tooltip"]').tooltip();
                },
        "ajax":{
            url:"<?php echo site_url();?>/NotaRemision_Controller/ConsultarNotasRemisionTemp",

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
            {"targets": 6, "render":function(data,type,row,meta){
                var url="<?=site_url("NotaRemision/AbrirNotaTemp/")?>"+data;
                btnNotaRemision=' <button type="button" style="border-radius: 200px" class="btn btn-blue btn-sm" onclick="window.location.href=\''+url+'\'"><i class="icon-plus" data-toggle="tooltip" data-placement="top" id="NotaRemision" title="Nota Remision"></i></button>';

                return btnNotaRemision;
            }},            
        ],
        "columns": [
            {       
                "className":      'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": ''
            },
            { "data": "IdNotaRemisionTemp"},
            { "data": "DescripcionFoliador" },
            { "data": "NombreClinica" },
            { "data": "FechaNotaRemision_Temp" },
            { "data": "NombrePaciente" },
            { "data": "IdNotaRemisionTemp"}
        ]

    });
}
        
function LoadRowDetail ( d ) {
    // `d` is the original data object for the row
    var div = $('<div/>')
          .addClass( 'loading' )
          .text( 'Loading...' );


      $.ajax({
        url: '<?= site_url()?>/NotaRemision_Controller/DetallesNotaRemisionTemp',
        data:{IdDetalleNota:d.IdDetalleNota},
        type: 'POST'


      })
      .done(function(data) {

        var DescripcionNota = JSON.parse(data);
        var output ='<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
                        '<th>Detalle Nota</th>';

        for (i=0; i<DescripcionNota.length;i++)
        {

          output +='<tr>'+
                    '<td>'+DescripcionNota[i]['DescripcionProducto']+'</td>'+
                    '<td>'+DescripcionNota[i]['Cantidad']+'</td>'+
                    '<td>'+DescripcionNota[i]['Descuento']+'</td>'+

                  '</tr>';

        }
        output += '</table>';

        div.html(output);
        div.removeClass('loading');

        console.log(output);
      })
      .fail(function() {
        console.log("error");
      });



      return div;
}


</script>