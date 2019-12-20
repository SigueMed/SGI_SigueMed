<form class="form-ajax" data-url="<?= site_url(); ?>/CatalogoProductos_Controller/ActualizarPreciosProductos"
	id="form_ActualizarPrecios">

<div class="row match-height">
        <div class="col-md-12">
            <div class="card">
                <!--CARD HEADER-->
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form">Catalogo de Productos</h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>



                </div>
                <!--CARD BODY-->
                <div class="card-body collapse in">
                    <div class="card-block">
                        <!--FORM BODY-->
                        <div class="form-body">

                            <div class="row">
                                <div class="col-md-7 col-xs-12">
                                    <div class="form-group">
                                        <label for="cbServicio">Servicio</label>
                                        <select name="cbServicio" id="cbServicio" class="form-control" onchange="ConsultarProductosServicio()" >
                                            <option value="">Servicios</option>

                                        </select>
                                    </div>
                               </div>
                            </div>
                            <div class="row">
                              <div class="col-md-3 col-xs-5">
                                <div class="form-group">
                                  <button type="submit" class="btn btn-primary btm-sm" name="button">Guardar</button>

                                </div>

                              </div>
                            </div>
                            <table id="tblCatalogoProductos" class="table table-striped table-bordered table-responsive" style="width:100%">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th>Id</th>
                                        <th>Descripción Producto</th>
                                        <th>Costo</th>
																				<th>C. Proveedor</th>
                                        <th>Habilitado</th>


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
</form>

<script type="text/javascript">
$(document).ready(function() {
  CargarServicios();

  $(document).on('submit', '.form-ajax', function(e){
        e.preventDefault();
        var $this = $(this);
        var table = $("#tblCatalogoProductos").DataTable();

        var data = table.$('input').serialize();

        var url = $this.data('url');
        $.post(url, data).then(function(res){
            if (res.error) {
                Swal.fire('Error', res.message, 'error');
            } else {
                Swal.fire('Éxito', 'Precios Actualizados', 'success');
            }
        }).fail(function(){
            Swal.fire('Error', 'Error al conectarse con el servidor', 'error');
        });

        e.preventDefault();
    });


});

function CargarServicios()
{
    $.ajax({
              url:"<?php echo site_url();?>/CatalogoProductos_Controller/ConsultarServicios_ajax",
              method:"POST",

              success: function(data)
                {
                    $('#cbServicio').html(data);
                }
          });

}

function ConsultarProductosServicio()
{
    var IdServicio = $("#cbServicio").val();
		var EsProveedor = $("#cbServicio").find(":selected").data('proveedor');

    if (IdServicio != "*")
    {
        var t = $('#tblCatalogoProductos').DataTable({
       "ajax":{
           url:"<?php echo site_url();?>/CatalogoProductos_Controller/ConsultarProductosServicio",
           method:"POST",
           data:{
               IdServicio:IdServicio

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
            "targets":2, "render": function(data,type,row,meta)

                   {

                       return "<input type='text' name='Precios[]' value ='"+data+"'>"+
                       "<input type='hidden' name='Productos[]' value='"+row['IdProducto']+"'>";

                   }
           },
					 {
						 "targets":3, "data":"PrecioProveedor", "render":function(data,type,row,meta)
						 {
							 if (EsProveedor)
							 {
								 return "<input type='text' name='PreciosProveedor[]' value ='"+data+"'>";
							 }
							else {
								return "<input type='text' name='PreciosProveedor[]' value ='0' disabled>";
							}

						 }
					 },

                       {"targets":4, "render": function(data,type,row,meta)

                   {
                       if (data=='1')
                       {
                           return "HABILITADO";
                       }
                       else
                       {
                           return "DESHABILITADO";
                       }


                   }}

                 ],

         "columns": [

               { "data": "IdProducto" },
               { "data": "DescripcionProducto" },
               { "data": "CostoProducto"},
							 {"data":"PrecioProveedor"},
               { "data": "Habilitado"}

               ]

       });
    }

}
</script>
