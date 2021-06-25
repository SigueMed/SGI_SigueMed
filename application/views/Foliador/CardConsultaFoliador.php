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
                    <h4 class="card-title" id="basic-layout-form">Catalogo de Foliadores</h4>
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


                            <table id="tblFoliadores" class="table table-striped table-bordered table-responsive" style="width:100%">
                                <thead class="thead-inverse">
                                    <tr>



                                        <th>Id</th>
                                        <th>Descripcion Foliador</th>
                                        <th>Valor Folio</th>

                                        <th>Responsable Folio</th>
                                        <th>Direccion Folio</th>
                                        <th>Manejo Inventario</th>
                                        <th>Titulo Ticket</th>
                                        <th>Imagen Ticket</th>

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

<!--MODAL EDITAR FOLIADOR-->
<div class="modal fade" tabindex="-1" role="dialog" id="ModalEditarFolio" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-body" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <button onclick="cerrar('#ModalEditarFolio')" type="button" class="close" id="CancelarModalEditarFolio">&times;</button>
            <h5 class="modal-title" id="actualizarModalLabel">Editar Foliador</h5>
        </div>
        <div class="modal-body">

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="txtIdFoliador">Foliador</label>
                <div class="position-relative has-icon-left">
                    <input type="text" readonly="readonly" id="txtIdFoliador" class="form-control" name="IdFoliador" value=""/>
                    <div class="form-control-position">

                    </div>
                </div>

              </div>

            </div>
            <div class="col-md-6">


            </div>
          </div>


          <div class="row">
            <div class="col-md-12">
              <fieldset class="form-group">
                <label for="txtDescripcionFoliador">Descripcion</label>
                <input type="text" class="form-control" id="txtDescripcionFoliador" name="DescripcionFoliador" placeholder="Descripcion de Foliador">
                <input type="hidden" name="ModalIdCuenta" id="ModalIdCuenta">
              </fieldset>
            </div>

          </div>


          <div class="row">

            <div class="col-md-6 col-xs-12">
              <fieldset class="form-group">
                <label for="txtValorFolio">Valor Folio</label>
                <input type="number" class="form-control" id="txtValorFolio" name="ValorFolio" placeholder="Valor de Folio">
              </fieldset>
            </div>

            <div class="col-md-6 col-xs-12">
              <fieldset class="form-group">
                <label for="txtResponsableFolio">Responsable</label>
                <input type="text" class="form-control" id="txtResponsableFolio" name="ResponsableFolio" placeholder="Responsable de Folio">
              </fieldset>
            </div>

          </div>

          <div class="row">

            <div class="col-md-8 col-xs-12">
              <fieldset class="form-group">
                <label for="txtDireccionFolio">Direccion Folio</label>
                <input type="text" class="form-control" id="txtDireccionFolio" name="DireccionFolio" placeholder="Direccion de Folio">
              </fieldset>
            </div>

            <div class="col-md-4 col-xs-12">
              <fieldset class="form-group">
                <label for="txtManejoInventario">Manejor de Inventario</label>
                <input type="checkbox" class="form-control"  id="ManejoInventario" name="ManejoInventario">
              </fieldset>
            </div>

          </div>

            <div class="row">

              <div class="col-md-6 col-xs-12">
                <fieldset class="form-group">
                  <label for="txtTituloTicket">Titulo Ticket</label>
                  <input type="text" class="form-control" id="txtTituloTicket" name="TituloTicket" placeholder="Titulo de Ticket">
                </fieldset>
              </div>

              <div class="col-md-6 col-xs-12">
                <fieldset class="form-group">
                  <label for="ImgImagenTicket">Imagen Ticket</label>
                  <input type="file" class="form-control-file"  id="ImagenTicket" name="ImagenTicket">
                </fieldset>
              </div>


          </div>




        </div>


        <div class="modal-footer">
            <button id="ModalbtnActualizar" type="button" onclick="ActualizarFoliador()" class="btn btn-success">Confirmar</button>
            <button id="ModalbtnCancelar" onclick="cerrar('#ModalEditarFolio')" type="button" class="btn btn-warning">Cancelar</button>
        </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    //input autocomplete Nombre

    $(document).ready(function() {

        CargarCatalogoFoliadores();




        // Add event listener for opening and closing details

        // $("#tbl_SeguimientoPacientes tbody").on('click','a.btnEditarSeguimiento',(e)=>{
        //   e.preventDefault();
        //   alert('click');
        //   var $this =$(this);
        //
        //   console.log($this.data('id'));
        // });
        $('#tblFoliadores tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var t = $("#tblFoliadores").DataTable();
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

function CargarCatalogoFoliadores()
{
    var t = $('#tblFoliadores').DataTable({
      "drawCallback": function( settings ) {
              $('[data-toggle="tooltip"]').tooltip();
            },
        "ajax":{
            url:"<?php echo site_url();?>/Foliador_Controller/ConsultarCatalogoFoliadores_ajax",

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
            {"targets": 8, "render":function(data,type,row,meta){



              var btnEditarFolio="";

              btnEditarFolio = ' <button type="button" style="border-radius: 200px" class="btn btn-blue btn-sm" onclick="OpenModal_EditarFolio('+data+')"><i class="icon-pencil" data-toggle="tooltip" data-placement="top" id="CancelarNota" title="Editar"></i></button>';

              return btnEditarFolio;

            }},
            {"targets": 5, "render":function(data,type,row,meta){

              var Habilitado;

              if (data=='0')
              {
                return "DESHABILITADO";
              }
              else{
                return "HABILITADO";
              }



            }}

          ],
          "columns": [

                { "data": "IdFoliador"},
                { "data": "DescripcionFoliador" },
                { "data": "ValorFolio" },
                { "data": "ResponsableFolio" },
                { "data": "DireccionFolio" },
                { "data": "ManejoInventario" },
                { "data": "TituloTicket" },
                { "data": "ImagenTicket" },
                { "data": "IdFoliador" }
                ]

        });

}


function OpenModal_EditarFolio(IdFoliador) {

  $.ajax({
    url:"<?php echo site_url();?>/Foliador_Controller/ConsultarFoliadorPorId",
    data:{IdFoliador:IdFoliador},
    method:"POST",
    dataSrc: ""

  })
  .done(function(data) {
    var Foliador = JSON.parse(data);
    $("#txtIdFoliador").val(Foliador['IdFoliador']);
    $("#txtDescripcionFoliador").val(Foliador['DescripcionFoliador']);
    $("#txtValorFolio").val(Foliador['ValorFolio']);
    $("#txtResponsableFolio").val(Foliador['ResponsableFolio']);
    $("#txtDireccionFolio").val(Foliador['DireccionFolio']);

    $("#ManejoInventario").prop('checked',false);

    $("#txtTituloTicket").val(Foliador['TituloTicket']);
    $("#ImagenTicket").val(Foliador['ImagenTicket']);



    if (Foliador['ManejoInventario']==1)
    {
      alert("habilitado");
      $("#ManejoInventario").prop('checked',true);
    }


  })
  .fail(function() {
    console.log("error");
  });


  $("#ModalEditarFolio").modal('show');

}





//ModalCambiarContrasena
function cerrar(Ventana)
{

   $(Ventana).modal('hide');
   //limpiar();
}






  function ActualizarFoliador()
  {

    var IdFoliador = $("#txtIdFoliador").val();
    var DescripcionFoliador= $("#txtDescripcionFoliador").val();
    var ValorFolio= $("#txtValorFolio").val();
    var ResponsableFolio= $("#txtResponsableFolio").val();
    var DireccionFolio=$("#txtDireccionFolio").val();

    var ManejoInventario =0;
    var TituloTicket= $("#txtResponsableFolio").val();
    var ImagenTicket= $("#ImagenTicket").val();



    if ($("#ManejoInventario").is(":checked"))
    {
      Habilitado = 1;
    }


    $.ajax({
      url: '<?=site_url('Foliador_Controller/ActualizarFoliador_ajax')?>',
      type: 'POST',
      data: {
        IdFoliador: IdFoliador,
        DescripcionFoliador: DescripcionFoliador,
        ValorFolio: ValorFolio,
        ResponsableFolio: ResponsableFolio,
        DireccionFolio: DireccionFolio,
        ManejoInventario: ManejoInventario,
        TituloTicket:TituloTicket,
        ImagenTicket:ImagenTicket
      }
    })
    .done(function() {
      Swal.fire({
          title:'Genial',
          text: 'El Foliador ha sido actualizado',
          type: 'success',

      });
      CargarCatalogoFoliadores();

    })
    .fail(function() {
      Swal.fire({
          title:'Oops...',
          text:'Hubo un error al actualizar al Foliador',
          type: 'error',

      });
    })
    .always(function(){
        $("#ModalEditarFolio").modal('hide');

    });

  }



//
</script>
