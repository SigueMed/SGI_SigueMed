<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<link href='<?php echo base_url();?>assets/fullcalendar/fullcalendar.css' rel='stylesheet' />
<link href='<?php echo base_url();?>assets/fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />
<!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/AdminLTE.min.css">

<script src="<?php echo base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>

<script src='<?php echo base_url();?>assets/fullcalendar/lib/moment.min.js'></script>
<!-- <script src='<?php echo base_url();?>assets/fullcalendar/lib/jquery.min.js'></script> -->
<script src='<?php echo base_url();?>assets/fullcalendar/fullcalendar.min.js'></script>
<script src='<?php echo base_url();?>assets/fullcalendar/locale/es.js'></script>

<!-- plugin Reloj-->
<script src="<?php echo base_url();?>assets/pluginreloj/bootstrap-clockpicker.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/pluginreloj/bootstrap-clockpicker.css">


<title>Agenda Citas</title>

<script>

	$(document).ready(function() {
		
                //llama la funcion getEventos para mostrar los eventos de la bd en el calendario
		$.post('<?php echo site_url();?>/ccalendar/getEventos',
			function(data){
				alert(data);

				$('#calendar').fullCalendar({
					header: {
						left: 'prev,next today',
						center: 'title',
						right: 'month, agendaWeek,agendaDay'
					},
					defaultDate: new Date(),
					navLinks: true, // can click day/week names to navigate views
					editable: true,
					eventLimit: true, // allow "more" link when too many events
					editable: true,
                                        //llama a data de la funcion getEvetos
					events: $.parseJSON(data),
                                        //eventDrop es para poder guardar la fecha al moverla de posicion
					eventDrop: function(event, delta, revertFunc){
                                                alert(event.end.format());
						var id = event.id;
						var fi = event.start.format();
						var ff = event.end.format();

						if (!confirm("Esta seguro de mover la fecha del evento?")) {
							revertFunc();
						}else{
							$.post("<?php echo site_url();?>/Agenda_Controler/updEvento",
							{
								id:id,
								fecini:fi,
								fecfin:ff
							},
							function(data){
								if (data == 1) {
									alert('Se actualizo correctamente');
								}else{
									alert('ERROR.');
								}
							});
						}
					},
                                        //eventResize guada la fecha al agregar o quitar dias del evento.
					eventResize: function(event, delta, revertFunc) {
                                                var id = event.id;
						var fi = event.start.format();
						var ff = event.end.format();

						if (!confirm("Esta seguro de cambiar la fecha?")) {
							revertFunc();//reverFunct regresa a la fecha si se cancela el cambio
						}else{
							$.post("<?php echo base_url();?>ccalendar/updEvento",
							{
								id:id,
								fecini:fi,
								fecfin:ff
							},
							function(data){
								if (data == 1) {
									alert('Se cambio correctamente');
								}else{
									alert('ERROR.');
								}
							});
						}
				    },
                                        //
                                        eventClick: function(event, jsEvent, view) {
                                        
                                        //activar y desactivar botones
                                        $('#btnGuardarCita').prop("disabled",true);
                                        $('#btnModificar').prop("disabled",false);
                                        $('#btnEliminar').prop("disabled",false);

				    	// alert(event.title);
				    	$('#idEvento').val(event.id);
                                        $('#idPaciente').val(event.id);
				    	$('#mtitulo').html(event.title);
				    	$('#txtPaciente').val(event.descripcion);
                                        $('#txtDia').val(event.start.format('DD'));
                                        $('#txtMes').val(event.start.format("MM"));
                                        $('#txtAnio').val(event.start.format("YYYY"));
                                        $('#txtHora').val(event.start.format("HH:mm"));
				    	$('#modalEvento').modal();

				    	if (event.url) {
				    		window.open(event.url);
				    		return false;
				    	}

				    },
                                    //eventRender elimina los eventos del calendario y de la bd
				    eventRender: function(event, element) {
                                        
                                        //element.html muestra el icono de eliminar en un evento
				        var el = element.html();
				        element.html("<div style='width:90%;float:left;'>" + el + "</div>" + 
						        	"<div style='color:red;text-align:right;' class='closeE'>" +
						        		"<i class='fa fa-trash'></i>" +
						        	"</div>");

				        element.find('.closeE').click(function(){
				        	if (!confirm("Esta seguro de eliminar el evento?")) {
								return false;
							}else{
								var id = event.id;
								$.post("<?php echo base_url();?>ccalendar/deleteEvento",
								{
									id:id
								},
								function(data){
									alert(data);
									if (data == 1) {
										$('#calendar').fullCalendar( 'removeEvents', event.id);
										alert('Se elimino correctamente');
									}else{
										alert('ERROR.');
									}
								});
					        }
				        });
                                        
                                        //eliminar cita por medio del boton borrar
                                        $('#btnEliminar').click(function(){
                                                var id = event.id;
                                                $.post("<?php echo base_url();?>ccalendar/deleteEvento",
                                                {
                                                id:id
                                                },
                                                function(data){
                                                        if (data == 1) {
                                                            $('#calendar').fullCalendar( 'removeEvents', event.id);
                                                            alert('Se elimino correctamente');
                                                        }else{
                                                            alert('ERROR.');
                                                        }
                                                });
                                        });
                                        
				    },
                                    dayClick: function(date,jsEvent,view){
                                    
                                    //activar y desactivar botones
                                    $('#btnGuardarCita').prop("disabled",false);
                                    $('#btnModificar').prop("disabled",true);
                                    $('#btnEliminar').prop("disabled",true);
                                    
                                    limpiarFormulario();
                                    
                                    $('#txtDia').val(date.format('DD'));
                                    $('#txtMes').val(date.format("MM"));
                                    $('#txtAnio').val(date.format("YYYY"));
                                    
                                    $('#modalEvento').modal();
                                    }
					
				});
			});

		
		
	});

</script>
<style>

	body {
		margin: 40px 10px;
		padding: 0;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		font-size: 14px;
	}

	#calendar {
		max-width: 750px;
		margin: 0 auto;
	}
        .fc th{
                padding: 10px 0px;
                vertical-align: middle;
                background: #F2F2F2;
            }

</style>
<style>
    .example-modal .modal {
      position: relative;
      top: auto;
      bottom: auto;
      right: auto;
      left: auto;
      display: block;
      z-index: 1;
    }

    .example-modal .modal {
      background: transparent !important;
    }
  </style>
</head>
<body>

    <div class="dropdown">
        <button class="btn btn-linkedin dropdown-toggle" type="button" id="dropdownServicio" data-toggle="dropdown" aria-extended="true">
            Servicio
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownServicio"> 
            
            <li role="presentation"><a role="item" href="#">1</a></li>
            <li class="divider"></li>
            <li role="presentation"><a role="item" href="#">2</a></li>
            <li class="divider"></li>
            <li role="presentation"><a role="item" href="#">3</a></li>
            <li class="divider"></li>
            <li role="presentation"><a role="item" href="#">4</a></li>
        </ul>
        
    </div>
    
	<div id='calendar'></div>

        
	<!-- Modal 1 (Agregar, modificar, eliminar) (ventana modal con Bootstrap) -->
	<div class="modal fade" id="modalEvento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog modal-body" role="document">
	    <div class="modal-content">
	      <div class="modal-header bg-aqua-gradient">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="mtitulo"></h4>
	      </div>

	      <div class="modal-body">

	            <!-- form start -->
	            
	            <input type="hidden" id="idEvento">
                    <input type="hidden" id="idPaciente">
	            
                    <div class="form-row">
	                <div class="form-group col-md-10">
	                  <label>Paciente</label>
                          <input type="text" class="form-control" id="txtPaciente" required="required"/>
	               </div>
                        <div class="form-group col-md-2">
                            <label>-</label>
                            <button class="form-control btn btn-info" data-toggle="modal" data-target="#modalEventoCliente">Add</button>
                        </div>
                    </div>
                    
	                <div class="form-row">
                          <div class="form-group col-md-3">
	                  <label>Dia</label>
                          <input type="text" class="form-control" id="txtDia" readonly="readonly"/>
	                </div>
                          
                        <div class="form-group col-md-2">
	                  <label>Mes</label>
                          <input type="text" class="form-control" id="txtMes" readonly="readonly"/>
	                </div>
                            
                        <div class="form-group col-md-3">
	                  <label>Año</label>
	                    <input type="text" class="form-control" id="txtAnio" readonly="readonly"/>
	                </div>
                            
                        <div class="form-group col-md-4">
	                  <label>Hora</label>

                            <div class="input-group clockpicker" data-autoclose="true">
                                <input type="text" class="form-control" id="txtHora"/>
                            </div>
	                </div>
                            
                        </div>
                    
              </div>
               
              <div class="modal-footer">
	        
	        <button type="button" class="btn btn-success" id="btnGuardarCita">Guardar</button>
                <button type="button" id="btnModificar" class="btn btn-success">Modificar</button>
                <button type="button" id="btnEliminar" class="btn btn-danger">Borrar</button>
                
	      </div>
	    </div>
	  </div>
	</div>
        
        
        
        <!-- Modal 2 (Agregar un nuevo cliente) (ventana modal con Bootstrap) -->
	<div class="modal fade" id="modalEventoCliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog modal-content" role="document">
	    <div class="modal-content">
	      <div class="modal-header bg-yellow-gradient">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="mtitulo">Registrar Nuevo Paciente</h4>
	      </div>

	      <div class="modal-body">

	            <!-- form start -->
	            
	            <!--<input type="hidden" id="idEvento">-->
	            
                    <div class="form-row">
	                <div class="form-group col-md-10">
	                  <label>Nombre:</label>
                            <input type="text" class="form-control" id="txtNombrePaciente">
                          <label>Apellidos:</label>
                            <input type="text" class="form-control" id="txtApellidoPaciente">
                          
	               </div>
                        <div class="form-group col-md-2">
                            <label>-</label>
                            <button type="button" class="btn btn-success" id="btnGuardarCliente">Guardar</button>
                        </div>
                    </div>
                    <div class="form-group col-md-5">
	                  <label>Telefono</label>
                            <input type="text" class="form-control" id="txtTelefono">
                    </div>
                    
	                
              </div><br>

	      <div class="modal-footer"></div>
	    </div>
	  </div>
	</div>
        
        
        
        

<script type="text/javascript">
    
    //llamando a la clase clockpicker del reloj
    $('.clockpicker').clockpicker();
    
    //limpiar formulario en la ventana modal
    function limpiarFormulario(){
        $('#idEvento').val('');
	$('#mtitulo').html('');
        $('#txtPaciente').val('');
    }
        
        //acualizar eventos
	$('#btnModificar').click(function(){
		var nome = $('#txtPaciente').val();
		var web = $('#txtDia').val();
		var ide = $('#idEvento').val();

		$.post("<?php echo base_url();?>ccalendar/updEvento2",
		{
			nom: nome,
			web: web,
			id: ide
		},
		function(data){
			if (data == 1) {
				//$('#btnCerrarModal').click();
                                alert('La informacion se modifico correctamente');
			}
		});
	});
        
        //guardar nuevos eventos
        $('#btnGuardarCita').click(function(){
		var idPaciente = $('#idPaciente').val();
                var fecini = $('#txtHora').val;
                var fecfin = $('#txtMes').val;
		var web = $('#txtDia').val();
                
                
		$.post("<?php echo base_url();?>Agenda_Controller/agregarEvento",
		{
			idPaciente: idPaciente,
                        fecini: fecini,
                        fecfin: fecfin,
			web: web
		},
		function(data){
			if (data == 1) {
				//$('#btnCerrarModal').click();
                                alert('La informacion se ha guardado');
			}
		});
	});
        
        
        
        
        
        
</script>


</body>
</html>
