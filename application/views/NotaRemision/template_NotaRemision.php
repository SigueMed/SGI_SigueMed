 <div class="content-body">
    <section class="card">
<div id="invoice-template" class="card-block">
		<!-- Invoice Company Details -->
		<div id="invoice-company-details" class="row">
			<div class="col-md-3 col-sm-12 text-xs-center text-md-left">
				<img src="<?php echo base_url();?>app-assets/images/logo/SigueMED_Logo_B.png" alt="company logo" class=""/>
				<ul class="px-0 list-unstyled">
					<li class="text-bold-800"><label id="ResponsableFolio"></label></li>
					<li><label id="DireccionFolio"></label></li>


				</ul>
			</div>
			<div class="col-md-9 col-sm-12 text-xs-center text-md-right">
				<h2>Recibo</h2>
                                <p class="pb-3">
                                    NOTA #<label id="NumeroRecibo"></label>

                                </p>

				<ul class="px-0 list-unstyled">
					<li>Total Recibo</li>
                                        <li class="lead text-bold-800">$ <label class="lead text-bold-800" id="TotalRecibo"></label></li>
				</ul>
			</div>
		</div>
		<!--/ Invoice Company Details -->

		<!-- Invoice Customer Details -->
		<div id="invoice-customer-details" class="row pt-2">
			<div class="col-sm-12 text-xs-center text-md-left">
				<p class="text-muted">Cliente</p>
			</div>
			<div class="col-md-6 col-sm-12 text-xs-center text-md-left">
				<ul class="px-0 list-unstyled">
                                    <li class="text-bold-800"><label class="text-bold-800" id="NombreCliente"></label></li>
                                    <li>Dirección: <label id="DireccionCliente"></label></li>
                                    <li>Telefóno: <label id="TelefonoCliente"></label></li>
                                    <li>e-mail: <label id="emailCliente"></label></li>
				</ul>
			</div>
			<div class="col-md-6 col-sm-12 text-xs-center text-md-right">
                            <p><span class="text-muted">Fecha Recibo :</span> <label id ="FechaNotaRemision"></label></p>
                            <p><span class="text-muted">Estatus Recibo :</span> <label id="EstatusNotaRemision"></label></p>

			</div>
		</div>
		<!--/ Invoice Customer Details -->

		<!-- Invoice Items Details -->
		<div id="invoice-items-details" class="pt-2">
			<div class="row">
				<div class="table-responsive col-md-12 col-sm-12">
					<table class="table" id="table_DetalleNotaRemision">
					  <thead>
					    <tr>
					      <th>#</th>
					      <th>Servicio y Producto</th>
					      <th class="text-xs-right">Costo Uni.</th>
                                              <th class="text-xs-right">Cantidad</th>
					      <th class="text-xs-right">Descuento</th>
					      <th class="text-xs-right">SubTotal</th>
					    </tr>
					  </thead>
					  <tbody>

					  </tbody>
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 col-sm-12 text-xs-center text-md-left">
					<p class="lead">Pagos:</p>
					<div class="row">
						<div class="col-md-9">
						<table class="table table-sm" id="table_PagosNotaRemision">
                                                    <thead>
                                                        <tr>
                                                            <th>Pago</th>

                                                            <th>Total Pago</th>
                                                        </tr>

                                                    </thead>
							<tbody>

							</tbody>
						</table>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-sm-12">
					<p class="lead">Resumen</p>
					<div class="table-responsive">
						<table class="table">
						  <tbody>
						  	<tr>
						  		<td class="text-bold-800">Total Nota</td>
                                                                <td class="text-bold-800 text-xs-right">$ <lable id="TotalNotaRemision"></lable></td>
						  	</tr>


						  	<tr>
						  		<td>Total Pagos</td>
                                                                <td class="pink text-xs-right">(-) $ <label id="TotalPagado"></label></td>
						  	</tr>
						  	<tr class="bg-grey bg-lighten-4">
						  		<td class="text-bold-800">Balance</td>
                                                                <td class="text-bold-800 text-xs-right">$ <label id="BalanceNota"></label></td>
						  	</tr>
						  </tbody>
						</table>
					</div>

                                        <div class="text-xs-center">
						<p>Elaborada por:</p>

                                                <h6><label id="ElaboradaPor"></label></h6>
						<p class="text-muted">Clínica SígueMED</p>
					</div>

				</div>
			</div>
		</div>

		<!-- Invoice Footer -->
		<div id="invoice-footer">
			<div class="row">
				<div class="col-md-7 col-sm-12">
					<h6>Terminos y Condiciones</h6>
					<p>You know, being a test pilot isn't always the healthiest business in the world. We predict too much for the next year and yet far too little for the next 10.</p>
				</div>
				<div class="col-md-5 col-sm-12 text-xs-center">
					<button onclick="myFunction(<?php echo $IdNotaRemision;?>)" type="button" class="btn btn-primary btn-lg my-1"><i class="icon-paperplane"></i> Send Invoice</button>
				</div>
			</div>
		</div>
		<!--/ Invoice Footer -->

	</div>
</section>
        </div>
<script type="text/javascript">
    $(document).ready(function()
    {
        var IdRecibo = <?php echo $IdNotaRemision;?>;
        CargarInformacionRecibo(IdRecibo);

    }

    );

    function CargarInformacionRecibo(IdRecibo)
    {
       //CARGAR ENCABEZADO NOTA REMISION
        $.ajax({
                url: "<?php echo site_url();?>/NotaRemision_Controller/ConsultarNotaRemision_ajax",
                method: "POST",
                data:{IdNotaRemision:IdRecibo},
                success: function(data)
                    {
                        var NotaRemision = JSON.parse(data);
                        $("#NumeroRecibo").html(NotaRemision['Folio']);
                        $("#TotalRecibo").html(NotaRemision['TotalNotaRemision']);
                        $("#NombreCliente").html(NotaRemision['NombrePaciente']);
                        $("#emailCliente").html(NotaRemision['email']);
                        $("#TelefonoCliente").html(NotaRemision['NumCelular']);
                        $("#FechaNotaRemision").html(NotaRemision['FechaNotaRemision']);
                        $("#ElaboradaPor").html(NotaRemision['ElaboradaPor']);
                        $("#ResponsableFolio").html(NotaRemision['ResponsableFolio']);
                        $("#DireccionFolio").html(NotaRemision['DireccionFolio']);


                        $("#EstatusNotaRemision").html(NotaRemision['DescripcionEstatusNotaRemision']);
                        $("#TotalNotaRemision").html(NotaRemision['TotalNotaRemision']);
                        $("#TotalPagado").html(NotaRemision['TotalPagado']);
                        var Balance = parseFloat(NotaRemision['TotalNotaRemision']) - parseFloat(NotaRemision['TotalPagado']);
                        $("#BalanceNota").html(Balance);
                    }
            });

            //CARGAR PRODUCTOS NOTA REMISION
            $.ajax({
                url: "<?php echo site_url();?>/NotaRemision_Controller/ConsultarProductosNotaRemision_ajax",
                method: "POST",
                data:{IdNotaRemision:IdRecibo},
                success: function(data)
                    {
                        var DetalleNotaRemision = JSON.parse(data);
                        var NombreSubProducto="";


                       for (i=0; i<DetalleNotaRemision.length;i++)
                       {
                           if (DetalleNotaRemision[i]['NombreSubProducto'] !== null)

                           {
                               NombreSubProducto =DetalleNotaRemision[i]['NombreSubProducto'];
                           }

                           $("#table_DetalleNotaRemision").append(
                                   '<tr>'+
                                    '<th scope="row">'+(i+1)+'</th>'+
                                    '<td>'+
                                        '<p>'+DetalleNotaRemision[i]['DescripcionProducto']+'</p>'+
                                        '<p class="text-muted">'+NombreSubProducto+'</p>'+
                                    '</td>'+
                                    '<td class="text-xs-right">$ '+DetalleNotaRemision[i]['CostoUnitario']+'</td>'+
                                    '<td class="text-xs-right">'+DetalleNotaRemision[i]['Cantidad']+'</td>'+
                                    '<td class="text-xs-right">'+DetalleNotaRemision[i]['Descuento']+' %</td>'+
                                    '<td class="text-xs-right">$ '+DetalleNotaRemision[i]['SubTotalDetalle']+'</td>'+
                                   '</tr>'

                                   );

                       }

                    }
            });

            //CARGAR PAGOS NOTA REMISION
            $.ajax({
                url: "<?php echo site_url();?>/NotaRemision_Controller/ConsultarPagosNotaRemision_ajax",
                method: "POST",
                data:{IdNotaRemision:IdRecibo},
                success: function(data)
                    {
                        var PagosNotaRemision = JSON.parse(data);



                       for (i=0; i<PagosNotaRemision.length;i++)
                       {


                           $("#table_PagosNotaRemision").append(
                                   '<tr>'+

                                    '<td>'+
                                        '<p>'+PagosNotaRemision[i]['FechaPago']+'</p>'+
                                        '<p class="text-muted">'+PagosNotaRemision[i]['DescripcionTipoPago']+'</p>'+
                                    '</td>'+
                                    '<td class="text-xs-right">$ '+PagosNotaRemision[i]['TotalPago']+'</td>'+
                                   '</tr>'
                                   );

                       }

                    }
            });



    }
    function myFunction(IdNotaRemision) {
        window.open("<?php echo site_url('NotaRemision/CrearPDF/');?>"+IdNotaRemision);
      }
</script>
