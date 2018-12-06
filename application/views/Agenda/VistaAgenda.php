
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
<!--easy Autocomplete-->
<script src="<?php echo base_url();?>assets/easyautocomplete/jquery.easy-autocomplete.min.js" ></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/easyautocomplete/easy-autocomplete.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/easyautocomplete/easy-autocomplete.themes.min.css">
<!--Fullcalendar-->
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
                
                 ////muestra los servicios en el dropdown
                $.post("<?php echo site_url();?>/agenda_controler/getServiciosClinica",

                    function(data){
                        var servi = JSON.parse(data);
                        var selected = true;
                        $.each(servi,function(i,item){
                            if (selected)
                            {
                             $('#getServicio').append('<option selected="selected" value="'+item.IdServicio+'">'+item.DescripcionServicio+'</option>'); 
                             selected = false;
                            }
                            else
                            {
                              $('#getServicio').append('<option value="'+item.IdServicio+'">'+item.DescripcionServicio+'</option>');  
                              
                                document.getElementById("txtidServicio").value = 1;
                            }
                        });
                        
                });
                
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
					events: {
                                                url:"<?php echo site_url();?>/Agenda_Controler/getEventos",
                                                type: 'POST',
                                                data: {
                                                    IdServicio: 1// $('#getServicio').val()
                                                    }
                                                        
                                                   
                                                },  
                                        defaultView:'agendaWeek',
                                       
                                                        ////$.parseJSON(data),
                                        //alert('prueba');
                                        //eventDrop es para poder guardar la fechaHr al moverla de posicion
					eventDrop: function(event, delta, revertFunc){
						var id = event.id;
						var fi = event.start.format();
						var ff = event.end.format();
                                                //alert(event.start.format());
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
                                            
                                        //eventResize guada la fechaHr al agregar o quitar dias del evento.
					eventResize: function(event, delta, revertFunc) {
                                                var id = event.id;
						var fi = event.start.format();
						var ff = event.end.format();

						if (!confirm("Esta seguro de cambiar la fechaHr?")) {
							revertFunc();//reverFunct regresa a la fechaHr si se cancela el cambio
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
                                        eventClick: function(event, jsEvent, view) {
                                        
                                        //activar y desactivar botones
                                        $('#btnGuardarCita').prop("disabled",true);
                                        $('#btnModificar').prop("disabled",false);
                                        $('#btnEliminar').prop("disabled",false);

				    	// alert(event.title);
				    	$('#idEvento').val(event.id);
                                        $('#idPaciente').val(event.idpac);
                                        
                                        
				    	$('#mtitulo').html(event.title);
				    	$('#txtPaciente').val(event.descripcion);
                                        $('#txtTelefono').val(event.descripcioncel);
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
								$.post("<?php echo site_url();?>/Agenda_Controler/deleteEvento",
								{
									id:id
								},
								function(data){
									//alert(data);
									if (data == 1) {
										//$('#calendar').fullCalendar( 'removeEvents', event.id);
										alert('Se elimino correctamente');
									}else{
										alert('ERROR.');
									}
								});
					        }
				        });
				    },
                                    dayClick: function(date, allDay, jsEvent, view){
                                    
                                    var myDate  = new Date();
                                    
                                    myDate.setDate(myDate.getDate()-1);
                                    if (date < myDate) 
                                    {
                                       
                                       alert("No puedes agendar esta fecha!");
                                       
                                       
                                    } 
                                    else {
                                       
                                   //activar y desactivar botones
                                    $('#btnGuardarCita').prop("disabled",false);
                                    $('#btnModificar').prop("disabled",true);
                                    $('#btnEliminar').prop("disabled",true);
                                    
                                    limpiarFormulario();
                                    
                                    $('#txtDia').val(date.format('DD'));
                                    $('#txtMes').val(date.format("MM"));
                                    $('#txtAnio').val(date.format("YYYY"));
                                    
                                    
                                    $('#modalEvento').modal('show');
                                
                                    }
                                    }
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
                background: #C0C0C0;
            }
            
            .fc-past{
                background-color: #F08080;
            }
            
        #dropdownServicio{
            margin: 0;
            max-width: 18%;
            padding: 5px;
            border: 1px solid #d9d9d9;
            background-color: #f0f8ff;
/*          text-align-last: center;*/

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
    
    .inputNombrePaciente{
         width: 180%;
    }
    
  </style>
  
</head>



<body>

    <!--dropdownServicio-->
   <div class="form-" id="dropdownServicio">
        
       <select class="form-control input-lg" id="getServicio" onchange="myFuncion(event)" >
           <option value="">Servicios:</option>
       </select>
       
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
                    <input  type="hidden" id="txtidStatus" class="form-control" value="1" readonly="readonly"/>
                    <!--<input type="hidden" id="idPaciente">-->
                    
                    <div class="form-group">
                        
                        <input type="hidden" class="form-control" id="txtidServicio"  readonly="readonly"/>
                        
                        <input type="hidden" class="form-control" id="idPaciente" readonly="readonly"/>
                        
                        
                    </div>
	            
                    <div class="form-row">
	                <div class="form-group col-md-10">
	                  <label>Paciente</label>
                          <input type="text" class="inputNombrePaciente" id="txtPaciente" required="required"/>
	               </div>
                        <div class="form-group col-md-2">
                            <label>-</label>
                            <button class="form-control btn btn-info" data-toggle="modal" data-target="#modalEventoCliente">Add</button>
                        </div>
                    </div>
                    <div class="form-row">
	                <div class="form-group col-md-12">
	                  <label>Telefono</label>
                          <input type="text" class="form-control" id="txtTelefono" readonly="readonly"/>
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
                                <input  class="form-control" id="txtHora"/>
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
                    
                    <div class="form-row">
	                <div class="form-group col-md-10">
	                  <label>Nombre:</label>
                          <input type="text" class="form-control" id="txtNombrePaciente" name="NombrePaciente">
                          <label>Apellidos:</label>
                          <input type="text" class="form-control" id="txtApellidosPaciente" name="ApellidosPaciente">
                          
                        </div>
                        
                    </div>
                    <div class="form-group col-md-5">
	                  <label>Telefono</label>
                          <input type="text" class="form-control" id="txtTelefonoPaciente" name="TelefonoPaciente">
                    </div>
                    <div class="form-group col-md-2">
                            <label>-</label>
                            
                            <input type="submit" name="submitPaciente" value="Enviar" class="btn btn-success" id="btnGuardarPaciente">
                            
                    </div>
                   
              </div><br>
	      <div class="modal-footer"></div>
	    </div>
	  </div>
	</div>
        


<script type="text/javascript">
    //llamando a la clase clockpicker del reloj
    $('.clockpicker').clockpicker({
        //twelvehour: true
    });
    
    
    
    //input autocomplete Nombre
    var optionsNombre = {
        url: "<?php echo site_url();?>/agenda_controler/autocompleteNombre",
        getValue: function (element){
                        return element.Nombre + " " + element.Apellidos;
                    },
        template: {
            type: "custom",
            method: function(value, item){
                return item.Nombre + " " + item.Apellidos;
                
                
            }
        },
        list: {
            maxNumberOfElements: 5,
            match:{
                enabled:true
            }, 
            
            onClickEvent: function(){
            
            
                
                var value = $("#txtPaciente").getSelectedItemData().IdPaciente;
                var valueTel = $("#txtPaciente").getSelectedItemData().NumCelular;
                
                $("#idPaciente").val(value).trigger("change");
                $("#txtTelefono").val(valueTel).trigger("change");
            
            },
            
            onChooseEvent: function()
            {
                var value = $("#txtPaciente").getSelectedItemData().IdPaciente;
                var valueTel = $("#txtPaciente").getSelectedItemData().NumCelular;
                
                $("#idPaciente").val(value).trigger("change");
                $("#txtTelefono").val(valueTel).trigger("change");
            }
            
//            onClickEvent: function() {},
//				onSelectItemEvent: function() {},
//				onLoadEvent: function() {},
//				onChooseEvent: function() {},
//				onKeyEnterEvent: function() {},
//				onMouseOverEvent: function() {},
//				onMouseOutEvent: function() {},	
//				onShowListEvent: function() {},
//				onHideListEvent: function() {}
            
           
                
        },
        theme: "plate-dark"
    };
    
    $('#txtPaciente').easyAutocomplete(optionsNombre);
    
    
        
    
    
     //http://easyautocomplete.com/examples
     //https://stackoverflow.com/questions/4718968/detecting-no-results-on-jquery-ui-autocomplete
    
   
//    var text = document.getElementById("txtPaciente");
//    var result = document.getElementById("idPaciente");

//    text.addEventListener("keypress", function(evento){
//        if(evento.keyCode === 13)
//           
//    })


//        function uniKeyCode(event) {
//            if(event.keyCode === 13){
//                
//            }
//        }
    
      
    //id en input del idServicio
    function myFuncion(e) {
    document.getElementById("txtidServicio").value = e.target.value;
    //alert("Tu seleccionaste el id: " + e.target.value);
   

    RefreshFullCalendar(e.target.value);
                
    }
    
    function RefreshFullCalendar(IdServicioSel)
    {
         var events ={
                                url:"<?php echo site_url();?>/Agenda_Controler/getEventos",
                                type: 'POST',
                                data: {
                                    IdServicio:IdServicioSel
                                    }
                                };

                    $('#calendar').fullCalendar('removeEventSource', events);
                    $('#calendar').fullCalendar('addEventSource', events);
                    $('#calendar').fullCalendar('refetchEvents');
    }
    
    
    
    //limpiar formulario en la ventana modal
    function limpiarFormulario(){
        $('#idEvento').val('');
	$('#mtitulo').html('');
        $('#txtPaciente').val('');
        $('#idPaciente').val('');
        $('#txtHora').val('');
        $('#txtNombrePaciente').val('');
        $('#txtApellidosPaciente').val('');
        $('#txtTelefonoPaciente').val('');
        $('#txtTelefono').val('');
        
    }
        
        //acualizar eventos
	$('#btnModificar').click(function(){
		var IdPaciente = $('#idPaciente').val();
                var HoraCita = $('#txtHora').val();
		var IdCitaServicio = $('#idEvento').val();

		$.post("<?php echo site_url();?>/Agenda_Controler/ActualizarCita",
		{
			IdPaciente: IdPaciente,
			HoraCita: HoraCita,
                        IdCitaServicio: IdCitaServicio
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
                var idServicio = $('#txtidServicio').val();
                var DiaCita = $('#txtDia').val();
                var MesCita = $('#txtMes').val();
                var AnioCita = $('#txtAnio').val();
                var HoraCita = $('#txtHora').val();
                var IdStatusCita = $('#txtidStatus').val();
                //yo
                var nombrePaciente = $('#txtPaciente').val();
                
                
                
                var fechaHr=new Date();

                var hora=fechaHr.getHours()-1;
                var minutos=fechaHr.getMinutes();
                var dia = fechaHr.getDate();
                //var segundos=quehora.getSeconds();
//                var dia = fechaHr.getDate();
//                var mes = fechaHr.getMonth()+1;
//                var anio = fechaHr.getFullYear();
                //fechaHr.setDate(fechaHr.getDate());
                                    

                //alert("  son las  : "+ hora + " : " +minutos + " : " + segundos);
                
                if(idPaciente === ""){
                    alert("No existe Paciente \n\
                Agrega un nuevo paciente");
                
                return false;
                }else if(HoraCita === ""){
                    alert("Agrega la Hr de la cita");
                }else if(parseInt(DiaCita) <= dia && HoraCita < hora+":"+minutos){
                    
                    alert("No se permite agregar una cita antes de la hr actual");
                }else{
                
		$.post("<?php echo site_url();?>/Agenda_Controler/agregarEvento",
		{
			IdPaciente: idPaciente,
                        IdServicio: idServicio,
                        DiaCita: DiaCita,
                        MesCita: MesCita,
			AnioCita: AnioCita,
                        HoraCita: HoraCita,
                        IdStatusCita: IdStatusCita
		},
		function(data){
                   
			if (data == 1) {
				//$('#btnCerrarModal').click();
                                alert('La informacion se ha guardado');
                                $('#modalEvento').modal('hide');
                                
                                RefreshFullCalendar(idServicio);
			}
                    
		});
            }
	});
        
        
        //Guardar nuevo paciente en ventana modal 
            $('#btnGuardarPaciente').click(function(){
		var nombre = $('#txtNombrePaciente').val();
                var apellidos = $('#txtApellidosPaciente').val();
                var telefono = $('#txtTelefonoPaciente').val();
		
               
                if(nombre === ""){
                alert("Agrega un Nombre");
                return false;
                }else if(apellidos === ""){
                    alert("Agrega los Apellidos");
                }else if(telefono === ""){
                    alert("Agrega un Telefono");
                }else{
                
		$.post("<?php echo site_url();?>/agenda_controler/agregarNuevoPaciente",
		{
			nombre: nombre,
                        apellido: apellidos,
                        telefono: telefono
		},
		function(data){
			if (data == 1) {
				//$('#btnCerrarModal').click();
                                alert('El paciente se ha guardado');
			}
		});
            }
            });
            
            //eliminar cita por medio del boton borrar
            $('#btnEliminar').click(function(){
                    var ide = $('#idEvento').val();
                    $.post("<?php echo site_url();?>/agenda_controler/deleteEvento",
                    {
                    id:ide
                    },
                    function(data){
                            if (data == 1) {
                                //$('#calendar').fullCalendar( 'removeEvents', event.id);
                                alert('Se elimino correctamente');
                            }else{
                                alert('ERROR.');
                            }
                    });
            });
        
</script>
</body>
</html>
