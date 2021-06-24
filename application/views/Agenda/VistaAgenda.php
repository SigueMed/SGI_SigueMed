
<head>
<meta charset='utf-8' />
<link href='<?php echo base_url();?>assets/fullcalendar/fullcalendar.css' rel='stylesheet' />
<link href='<?php echo base_url();?>assets/fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />

<!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/css/bootstrap.css">
    <!-- font icons-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/fonts/icomoon.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/fonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/vendors/css/extensions/pace.css">

    <!-- BEGIN ROBUST CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/css/app.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/css/colors.css">


<!-- Bootstrap 3.3.6 -->
  <!--<link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css">-->
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>



<title>Agenda Citas</title>

<script>
	$(document).ready(function() {
                //llama la funcion getEventos para mostrar los eventos de la bd en el calendario

                 ////muestra los servicios en el dropdown
                $.post("<?php echo site_url();?>/Agenda_Controler/getServiciosAgenda",

                    function(data){
                        var servi = JSON.parse(data);
                        var selected = true;
                        $('#getServicio').append('<option value="*">Todos</option>');
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

                        CargarMedicosServicio();

                });

        $('#calendar').fullCalendar({
          aspectRatio: 2,
					header: {
						left: 'prev,next today',
						center: 'title',
						right: 'month, agendaWeek, agendaDay'
					},

					defaultDate: new Date(),
					navLinks: true, // can click day/week names to navigate views
					editable: true,
					eventLimit: true, // allow "more" link when too many events
					editable: true,

          allDaySlot: false,
                                        //llama a data de la funcion getEvetos
					events: {
            url:"<?php echo site_url();?>/Agenda_Controler/getEventos",
            type: 'POST',
            data: {
                IdServicio: 1// $('#getServicio').val()
                }
          },
          defaultView:'agendaWeek',
          handleWindowResize: 'true',

          //height:'parent',
          scrollTime: new Date().getHours()+":00:00",

                                                        ////$.parseJSON(data),
                                        //alert('prueba');
                                        //eventDrop es para poder guardar la fechaHr al moverla de posicion
					eventDrop: function(event, delta, revertFunc){
						var IdCitaServicio = event.id;
            var IdEmpleado = event.IdEmpleado;
            var IdServicio =event.IdServicio;
            var Comentarios = event.Comentarios;

						if (!confirm("Esta seguro de mover la fecha del evento?")) {
							revertFunc();
						}else{

							$.post("<?php echo site_url();?>/Agenda_Controler/ActualizarCita",
                  {

                          IdCitaServicio: IdCitaServicio,
                          Inicio:event.start.format("YYYY-MM-DD HH:mm"),
                          Fin:event.end.format("YYYY-MM-DD HH:mm"),

                          IdEmpleado:IdEmpleado,
                          Comentarios:Comentarios

                  },

							function(data){
								if (data == 1) {
									alert('Se actualizo correctamente');
								}else if(data==2)
                    {
                        alert('La cita ya ha sido confirmada');
                    }else{
									alert('ERROR.');
								}
                  RefreshFullCalendar(IdServicio);
							});
						}
					},

                                        //eventResize guada la fechaHr al agregar o quitar dias del evento.
					eventResize: function(event, delta, revertFunc)
          {
              var id = event.id;
              var IdCitaServicio = event.id;
              var IdEmpleado = event  .IdEmpleado;
              var IdServicio =event.IdServicio;
              var Comentarios = event.Comentarios;

              if (!confirm("¿Está seguro de cambiar la cita?")) {
                revertFunc();
              }else{

                $.post("<?php echo site_url();?>/Agenda_Controler/ActualizarCita",
                    {

                            IdCitaServicio: IdCitaServicio,
                            Inicio:event.start.format("YYYY-MM-DD HH:mm"),
                            Fin:event.end.format("YYYY-MM-DD HH:mm"),

                            IdEmpleado:IdEmpleado,
                            Comentarios:Comentarios

                    },

                function(data){
                  if (data == 1) {
                    alert('Se actualizo correctamente');
                  }else if(data==2)
                      {
                          alert('La cita ya ha sido confirmada');
                      }else{
                    alert('ERROR.');
                  }
                    RefreshFullCalendar(IdServicio);
                });
              }
				    },
                                        eventClick: function(event, jsEvent, view) {


                                          if (event.idpac!==null)
                                          {
                                            //activar y desactivar botones
                                            $('#btnGuardarCita').prop("disabled",true);
                                            $('#btnModificar').prop("disabled",false);
                                            $('#btnEliminar').prop("disabled",false);

                              				    	// alert(event.title);
                              				    	$('#idEvento').val(event.id);
                                            $('#idPaciente').val(event.idpac);




                              				    	$('#mtitulo').html(event.descripcion);
                              				    	$('#txtPaciente').val(event.title);
                                            $('#txtTelefono').val(event.descripcioncel);
                                            //alert(event.IdEmpleado);
                                            $('#Medico').val(event.IdEmpleado);
                                            $('#txtComentarios').val(event.Comentarios);

                                            $('#FechaInicio').val(moment(event.start).format("YYYY-MM-DD"));
                                            $('#HoraInicio').val(moment(event.start).format("HH:mm"));



                                            $('#HoraFin').val(moment(event.end).format("HH:mm"));

	    	                                   $('#modalEvento').modal();


                                          }
                                          else {
                                            $('#idEventoAbierto').val(event.id);
                                            $('#mtituloEvento').html(event.descripcion);
                                            $('#EventoFechaInicio').val(moment(event.start).format("YYYY-MM-DD"));
                                            $('#EventoHoraInicio').val(moment(event.start).format("HH:mm"));

                                            $('#EventoFechaFin').val(moment(event.end).format("YYYY-MM-DD"));
                                            $('#EventoHoraFin').val(moment(event.end).format("HH:mm"));
                                            $("#txtTituloEvento").val(event.title);

                                            $('#btnGuardarEvento').prop("disabled",true);
                                            $('#btnModificarEvento').prop("disabled",false);
                                            $('#btnEliminarEvento').prop("disabled",false);

                                            $('#modalEventoAbierto').modal();


                                          }


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
                                    dayClick: function(date, allDay, jsEvent, view, event){
                                      var HoraInicio = date.format("HH:mm");
                                      var DiaSemanaCita = moment(date).day();
                                      var IdServicio = document.getElementById("getServicio").value;





                                        var myDate  = new Date();


                                        document.getElementById("txtidServicio").value = IdServicio;
                                        var DescServicio = $("#getServicio option:selected").html();;


                                        if(IdServicio !=='*')
                                        {

                                        myDate.setDate(myDate.getDate()-1);
                                        if (date < myDate)
                                        {

                                           alert("No puedes agendar esta fecha!");


                                        }
                                        else {
                                          
                                              $.ajax({
                                                url: '<?=site_url()?>/Agenda_Controler/ValidarHorarioCita_ajax',
                                                type: 'POST',
                                                data: {
                                                  DiaSemana: DiaSemanaCita,
                                                  HoraCita: HoraInicio,
                                                  IdServicio: IdServicio
                                                }
                                              })
                                              .done(function(data) {

                                                var CitaValida = JSON.parse(data);

                                                if (CitaValida == true)
                                                {
                                                  //activar y desactivar botones
                                                   $('#btnGuardarCita').prop("disabled",true);
                                                   $('#btnModificar').prop("disabled",true);
                                                   $('#btnEliminar').prop("disabled",true);

                                                   limpiarFormulario();

                                                   $('#mtitulo').html(DescServicio);
                                                   $('#FechaInicio').val(date.format("YYYY-MM-DD"));
                                                   $('#HoraInicio').val(date.format("HH:mm"));

                                                   var end = moment(date).add(0.5,"hour");
                                                   $('#HoraFin').val(end.format("HH:mm"));
                                                   CargarMedicosServicio();
                                                   $('#modalEvento').modal('show');
                                                }
                                                else
                                                {


                                                  Swal.fire({
                                                      title:'El servicio no esta Disponible para el día y hora indicado',
                                                      type: 'error',
                                                      showConfirmButton: true
                                                  });
                                                }


                                              });


                                             }
                                        }
                                        else
                                        {
                                            alert('Selecciona un servicio para agendar una cita');
                                        }

                                    }
				});

			});

</script>

<style>

/*	body {
		margin: 40px 10px;
		padding: 0;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		font-size: 130%;
	}*/

	#calendar {
		/*max-width: 60%;*/
		margin: 0 auto;
                margin-top: -5%;
                max-height: 100%;

	}
        .fc th{
                padding: 10px 0px;
                vertical-align: middle;
                background: #C0C0C0;
            }

            .fc-past{
                background-color: #B5CCCD;
            }



</style>


<style>
/*    .example-modal .modal {
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
    }*/

    .inputNombrePaciente{
         width: 145%;

    }

  </style>

</head>


<body>
    <div class="row match-height">
        <div class="col-md-12">
            <div class="card">
    <div class="card-body collapse in">
        <div class="card-block">
            <div class="form-body">
    <!--dropdownServicio-->
   <div class="row" id="dropdownServicio">
       <div class="col-md-7 col-xs-7">
           <div class="form-group">

               <select class="form-control" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Servicios" id="getServicio" onchange="myFuncion(event)"  name="getServicio" >
                <option value="">Servicios:</option>
               </select>
           </div>

       </div>
       <div class="col-md-3 col-xs-3">
           <div class="form-group">
              <button type="button" class="btn btn-primary" id="btnNuevaCita"><i class="icon-android-add"></i>Cita</button>
              <button type="button" class="btn btn-primary" id="btnNuevoEvento"><i class="icon-android-add"></i>Evento</button>
           </div>

       </div>

    </div>
    <br><br>

    <div class ="row">
        <div class="col-md-12">
            <div  id='calendar'></div>
        </div>

    </div>
    </div>
        </div>
    </div>
            </div>
        </div>
    </div>


	<!-- Modal 1 (Agregar, modificar, eliminar) (ventana modal con Bootstrap) -->
	<div class="modal fade" id="modalEvento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog modal-body" role="document">
	    <div class="modal-content">
	      <div class="modal-header bg-blue-gradient">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="mtitulo"></h4>
                <select class="form-control" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Medico" id="Medico"  name="Medico" >
                    <option value="">Medico:</option>
               </select>

	      </div>

	      <div class="modal-body">
	            <!-- form start -->
                    <input  type="hidden" id="idEvento" readonly="readonly">
                    <input  type="hidden" id="txtidStatus" class="form-control" value="1" readonly="readonly"/>
                    <!--<input type="hidden" id="idPaciente">-->

                    <div class="form-group">

                        <input type="hidden" class="form-control" id="txtidServicio"  readonly="readonly"/>

                        <input  type="hidden"  class="form-control" id="idPaciente" readonly="readonly" />


                    </div>

                    <div class="form-row">
	                <div class="form-group col-md-5">
	                  <label>Paciente</label>
                          <input type="text" class="inputNombrePaciente" id="txtPaciente" required="required" placeholder="Buscar" />
	               </div>
                        <div class="form-group col-md-5">
	                  <label>Telefono</label>
                          <input type="text" class="form-control"  id="txtTelefono" readonly="readonly" placeholder="telefóno Paciente" required/>
	               </div>
                        <div class="form-group col-md-2">
                            <label>-</label>
                            <button class="form-control btn btn-info" data-toggle="modal"id="btnAddPaciente" >Nuevo</button>
                        </div>
                    </div>
                    <div class="form-row">
	                <div class="form-group col-md-12">
	                  <label>Comentarios Cita</label>
                          <input type="text" class="form-control" id="txtComentarios" placeholder="Razón de la Cita"/>
	               </div>
                    </div>
	                <div class="row">

                        <div class="form-group col-md-4">
                            <label>Fecha Inicio</label>
                            <input type="date" class="form-control" id="FechaInicio"/>
      	                </div>
                              <div class="form-group col-md-4">
                                  <label>Hora Inicio</label>
                                  <input type="time" class="form-control" id="HoraInicio" onchange ="ActualizarHoraFin()"/>
      	                </div>
                        <div class="form-group col-md-4">
                            <label>Hora Fin</label>
                            <input type="time" class="form-control" id="HoraFin"/>
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
                          <input type="text" class="form-control" id="txtNombrePaciente" name="NombrePaciente" required>
                          <label>Apellidos:</label>
                          <input type="text" class="form-control" id="txtApellidosPaciente" name="ApellidosPaciente" required>

                        </div>

                    </div>
                    <div class="form-group col-md-5">
	                  <label>Telefono</label>
                          <input type="text" class="form-control" id="txtTelefonoPaciente"  name="TelefonoPaciente" required>
                    </div>
                    <div class="form-group col-md-2">
                            <label>-</label>

                            <input type="submit" name="btnGuardarPaciente" value="Guardar" class="btn btn-success" id="btnGuardarPaciente">

                    </div>

              </div><br>
	      <div class="modal-footer"></div>
	    </div>
	  </div>
	</div>

  <!-- Modal 3 (Agregar, modificar, eliminar) (ventana modal con Bootstrap) -->
  <div class="modal fade" id="modalEventoAbierto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-body" role="document">
      <div class="modal-content">
        <div class="modal-header bg-blue-gradient">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="mtituloEvento"></h4>


        </div>

        <div class="modal-body">
              <!-- form start -->
                    <input  type="hidden" id="idEventoAbierto" readonly="readonly">
                    <input  type="hidden" id="txtidStatus" class="form-control" value="1" readonly="readonly"/>
                    <!--<input type="hidden" id="idPaciente">-->

                    <div class="form-group">

                        <input type="hidden" class="form-control" id="txtidServicio"  readonly="readonly"/>




                    </div>


                    <div class="form-row">
                  <div class="form-group col-md-12">
                    <label>Titulo Evento</label>
                          <input type="text" class="form-control" id="txtTituloEvento" placeholder="Razón de la Cita"/>
                 </div>
                    </div>
                  <div class="row">

                        <div class="form-group col-md-4">
                            <label>Fecha Inicio</label>
                            <input type="date" class="form-control" id="EventoFechaInicio"/>
                        </div>
                              <div class="form-group col-md-4">
                                  <label>Hora Inicio</label>
                                  <input type="time" class="form-control" id="EventoHoraInicio"/>
                        </div>



                  </div>
                  <div class="row">


                        <div class="form-group col-md-4">
                            <label>Fecha Fin</label>
                            <input type="date" class="form-control" id="EventoFechaFin"/>
                        </div>
                              <div class="form-group col-md-4">
                                  <label>Hora Fin</label>
                                  <input type="time" class="form-control" id="EventoHoraFin"/>
                        </div>


                  </div>

              <div class="modal-footer">

          <button type="button" class="btn btn-success" id="btnGuardarEvento">Guardar</button>
                <button type="button" id="btnModificarEvento" class="btn btn-success">Modificar</button>
                <button type="button" id="btnEliminarEvento" class="btn btn-danger">Borrar</button>

        </div>
      </div>
    </div>
  </div>
</div>



<script type="text/javascript">



    //input autocomplete Nombre
    var optionsNombre = {
        url: "<?php echo site_url();?>/Agenda_Controler/autocompleteNombre",
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

                if (value !== null)
                {
                    $('#btnGuardarCita').prop("disabled",false);
                }


            },

            onChooseEvent: function()
            {
                var value = $("#txtPaciente").getSelectedItemData().IdPaciente;
                var valueTel = $("#txtPaciente").getSelectedItemData().NumCelular;

                $("#idPaciente").val(value).trigger("change");
                $("#txtTelefono").val(valueTel).trigger("change");

                 if (value !== null)
                {
                    $('#btnGuardarCita').prop("disabled",false);
                }
            }

        },
        theme: "plate-dark"
    };

    $('#txtPaciente').easyAutocomplete(optionsNombre);





    //id en input del idServicio
    function myFuncion(e) {

            document.getElementById("txtidServicio").value = e.target.value;
            document.getElementById("mtitulo").innerHTML = e.target.value;

            RefreshFullCalendar(e.target.value);
            CargarMedicosServicio();
    }

    function CargarMedicosServicio()
    {
        var IdServicio = $("#getServicio").val();
        //alert(IdServicio);

        if(IdServicio!== null)
        {
            $.ajax({
                  url:"<?php echo site_url();?>/Agenda_Controler/ConsultarMediciosServicio",
                  method:"POST",
                  data:{IdServicio:IdServicio},
                  success: function(data)
                    {
                        $('#Medico').html(data);
                        //alert(data);
                    }
              });
        }


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
        $('#txtComentarios').val('');
        $('#idPaciente').val('');
        $('#txtHora').val('');
        $('#txtNombrePaciente').val('');
        $('#txtApellidosPaciente').val('');
        $('#txtTelefonoPaciente').val('');
        $('#txtTelefono').val('');
        $('#Medico').val('');

    }

    $('#btnAddPaciente').click(function(){
        $('#modalEventoCliente').modal('show');
    });

    $('#btnModificarEvento').click(function(){


  		var IdCitaServicio = $('#idEventoAbierto').val();
                  var idServicio = $('#txtidServicio').val();
                  var FechaInicio = $("#EventoFechaInicio").val();
                  var FechaFin = $("#EventoFechaFin").val();
                  var HoraInicio = $("#EventoHoraInicio").val();
                  var HoraFin = $("#EventoHoraFin").val();
                  //var IdEmpleado = $('#Medico').val();

                  var Inicio = FechaInicio +" " + HoraInicio;
                  var Fin = FechaFin + " " + HoraFin;

                  //var Comentarios = $('#txtComentarios').val();


                  var tituloCita = $("#txtTituloEvento").val();

                  alert(tituloCita);






  		$.post("<?php echo site_url();?>/Agenda_Controler/ActualizarCita",
  		{
                          IdCitaServicio: IdCitaServicio,
                          Inicio:Inicio,
                          Fin:Fin,
                          TituloCita:tituloCita


  		},
  		function(data){

  			if (data === '1') {
  				//$('#btnCerrarModal').click();
                                  alert('La informacion se modifico correctamente');
                                  $('#modalEventoAbierto').modal('hide');

                                  RefreshFullCalendar(idServicio);
  			}
                          else if(data==='2')
                          {
                              alert('No se puede modificar una cita que ya fue atendida o confirmada');
                          }
                          else if(data==='3')
                          {
                              alert('Error al modificar la cita.');
                          }

  		});

  	});
        //acualizar eventos
	$('#btnModificar').click(function(){


		var IdCitaServicio = $('#idEvento').val();
                var idServicio = $('#txtidServicio').val();
                var FechaInicio = $("#FechaInicio").val();
                var HoraInicio = $("#HoraInicio").val();
                var HoraFin = $("#HoraFin").val();
                var IdEmpleado = $('#Medico').val();

                var Inicio = FechaInicio +" " + HoraInicio;
                var Fin = FechaInicio + " " + HoraFin;

                var Comentarios = $('#txtComentarios').val();

                var fechaHr=new Date();


                var dateInicio = new Date (Inicio);


                if(HoraInicio === ""){
                    alert('Agrega la hora de la cita');
                }else if(dateInicio.getTime() < fechaHr.getTime()){
                    alert("No se permite modificar una cita a una fecha anterior a la actual.");
                }else{
                    alert('Modificar');



		$.post("<?php echo site_url();?>/Agenda_Controler/ActualizarCita",
		{
                        IdCitaServicio: IdCitaServicio,
                        Inicio:Inicio,
                        Fin:Fin,
                        IdEmpleado: IdEmpleado,
                        Comentarios:Comentarios
		},
		function(data){

			if (data === '1') {
				//$('#btnCerrarModal').click();
                                alert('La informacion se modifico correctamente');
                                $('#modalEvento').modal('hide');

                                RefreshFullCalendar(idServicio);
			}
                        else if(data==='2')
                        {
                            alert('No se puede modificar una cita que ya fue atendida o confirmada');
                        }
                        else if(data==='3')
                        {
                            alert('Error al modificar la cita.');
                        }

		});
            }
	});

        //guardar nuevos eventos
        $('#btnGuardarCita').click(function(){
		            var idPaciente = $('#idPaciente').val();
                var idServicio = $('#txtidServicio').val();
                var FechaInicio = $("#FechaInicio").val();
                var HoraInicio = $("#HoraInicio").val();
                var HoraFin = $("#HoraFin").val();

                var Inicio = FechaInicio +" " + HoraInicio;
                var Fin = FechaInicio + " " + HoraFin;

                var IdStatusCita = $('#txtidStatus').val();
                var IdEmpleado = $('#Medico').val();
                var Comentarios = $('#txtComentarios').val();


                var fechaHr=new Date();

                var hora=fechaHr.getHours();
                var minutos=fechaHr.getMinutes();

                if(idPaciente === ""){
                    alert("No existe Paciente \n\
                Agrega un nuevo paciente");

                return false;
                }else if(HoraInicio < hora){

                    alert("No se permite agregar una cita ("+ HoraInicio +") antes de la hr actual. Hora Actual: " + hora+":"+minutos);
                }else if(IdEmpleado ===""){

                    alert("Seleccione un Médico");
                }else{

		$.post("<?php echo site_url();?>/Agenda_Controler/agregarEvento",
		{
			IdPaciente: idPaciente,
                        IdServicio: idServicio,
                        FechaInicio: Inicio,
                        FechaFin: Fin,
                        IdStatusCita: IdStatusCita,
                        IdEmpleado: IdEmpleado,
                        Comentarios:Comentarios
		},
		function(data){

			if (data != "0") {
        Swal.fire({
            title:'Nueva cita registrada',
            text:'No. de cita: '+data,
            type: 'success',
            showConfirmButton: true
        });
				//$('#btnCerrarModal').click();

                                $('#modalEvento').modal('hide');

                                RefreshFullCalendar(idServicio);
			}
                        else
                        {
                            alert('Error al crear la cita');
                        }


		});
            }
	});
  //guardar nuevos eventos
  $('#btnGuardarEvento').click(function(){

          var idServicio = $('#txtidServicio').val();
          var FechaInicio = $("#EventoFechaInicio").val();
          var HoraInicio = $("#EventoHoraInicio").val();
          var FechaFin = $("#EventoFechaFin").val();
          var HoraFin = $("#EventoHoraFin").val();
          var tituloCita = $("#txtTituloEvento").val();

          var Inicio = FechaInicio +" " + HoraInicio;
          var Fin = FechaFin + " " + HoraFin;

          var IdStatusCita = $('#txtidStatus').val();

          var Comentarios = $('#txtComentarios').val();


          var fechaHr=new Date();

          var hora=fechaHr.getHours();
          var minutos=fechaHr.getMinutes();

          if(idPaciente === ""){
              alert("No existe Paciente \n\
          Agrega un nuevo paciente");

          return false;
          }else if(HoraInicio < hora){

              alert("No se permite agregar una cita ("+ HoraInicio +") antes de la hr actual. Hora Actual: " + hora+":"+minutos);
          }else {

  $.post("<?php echo site_url();?>/Agenda_Controler/agregarEvento",
  {

                  IdServicio: idServicio,
                  FechaInicio: Inicio,
                  FechaFin: Fin,
                  IdStatusCita: IdStatusCita,

                  Comentarios:Comentarios,
                  TituloCita: tituloCita
  },
  function(data){

  if (data == 1) {
  //$('#btnCerrarModal').click();
                          alert('La informacion se ha guardado');
                          $('#modalEventoAbierto').modal('hide');

                          RefreshFullCalendar(idServicio);
  }
                  else
                  {
                      alert('Error al crear la cita');
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

		$.post("<?php echo site_url();?>/Agenda_Controler/agregarNuevoPaciente",
		{
			nombre: nombre,
                        apellido: apellidos,
                        telefono: telefono
		},
		function(data){
                        var result = JSON.parse(data);

                        if (result === 2)
                        {
                            alert("Parece que el paciente YA existe, favor de verificar");



                        }
                        else
                        {
                            alert('El paciente se ha guardado');

                             $('#modalEventoCliente').modal('hide');

                                document.getElementById("idPaciente").value = result['IdPaciente'];

                                document.getElementById("txtPaciente").value = result['Nombre']+ " " + result ['Apellidos']; //document.getElementById("txtNombrePaciente").value + " " + document.getElementById("txtApellidosPaciente").value;

                                document.getElementById("txtTelefono").value = result['NumCelular'];//document.getElementById("txtTelefonoPaciente").value;
                                $('#btnGuardarCita').prop("disabled",false);

                        }



		});
            }
            });

            //eliminar cita por medio del boton borrar
            $('#btnEliminar').click(function(){
                    var ide = $('#idEvento').val();
                    var idServicio = $('#txtidServicio').val();
                    $.post("<?php echo site_url();?>/Agenda_Controler/deleteEvento",
                    {
                    id:ide
                    },
                    function(data){
                            if (data == 1) {
                                //$('#calendar').fullCalendar( 'removeEvents', event.id);
                                alert('Se elimino correctamente');
                                $('#modalEvento').modal('hide');

                                RefreshFullCalendar(idServicio);
                            }else{
                                alert('ERROR.');
                            }
                    });
            });

            $('#btnNuevaCita').click(function(){

                        var date  = new Date();

                        var IdServicio = document.getElementById("getServicio").value;
                        document.getElementById("txtidServicio").value = IdServicio;
                        var DescServicio = $("#getServicio option:selected").html();


                        if(IdServicio !=='*')
                        {
                            //activar y desactivar botones
                             $('#btnGuardarCita').prop("disabled",true);
                             $('#btnModificar').prop("disabled",true);
                             $('#btnEliminar').prop("disabled",true);

                             limpiarFormulario();

                           var month = date.getMonth()+1;

                           if (month<10)
                           {
                               month = '0'+ month;
                           }

                           var dia = date.getDate();
                           if(dia<10)
                           {
                             dia = '0'+dia;
                           }

                           //alert(date.getFullYear()+'-'+month+'-'+dia);
                           $('#FechaInicio').val(date.getFullYear()+'-'+month+'-'+dia);

                            $('#HoraInicio').val(date.getHours()+":"+date.getMinutes());

                            var end = moment(date).add(0.5,"hour");

                            $('#HoraFin').val(end.format("HH:mm"));

                             $('#mtitulo').html(DescServicio);


                             CargarMedicosServicio();


                             $('#modalEvento').modal('show');





                             }
                        else
                        {
                            alert('Selecciona un servicio para agendar una cita');
                        }

                    });
                    $('#btnNuevoEvento').click(function(){

                                var date  = new Date();

                                var IdServicio = document.getElementById("getServicio").value;
                                document.getElementById("txtidServicio").value = IdServicio;
                                var DescServicio = $("#getServicio option:selected").html();


                                if(IdServicio !=='*')
                                {

                                     //limpiarFormularioEvento();

                                   var month = date.getMonth()+1;

                                   if (month<10)
                                   {
                                       month = '0'+ month;
                                   }

                                   var dia = date.getDate();
                                   if(dia<10)
                                   {
                                     dia = '0'+dia;
                                   }

                                   //activar y desactivar botones
                                    $('#btnGuardarEvento').prop("disabled",false);
                                    $('#btnModificarEvento').prop("disabled",true);
                                    $('#btnEliminarEvento').prop("disabled",true);
                                   $('#mtituloEvento').html(DescServicio);
                                   //alert(date.getFullYear()+'-'+month+'-'+dia);
                                   $('#EventoFechaInicio').val(date.getFullYear()+'-'+month+'-'+dia);
                                   $('#EventoFechaFin').val(date.getFullYear()+'-'+month+'-'+dia);

                                    $('#EventoHoraInicio').val(date.getHours()+":"+date.getMinutes());



                                     $('#mtitulo').html(DescServicio);





                                     $('#modalEventoAbierto').modal('show');





                                     }
                                else
                                {
                                    alert('Selecciona un servicio para agendar una cita');
                                }

                            });

            function ActualizarHoraFin()
            {

                var FechaInicio = $("#FechaInicio").val();
                var HoraInicio = $("#HoraInicio").val();


                var Inicio = FechaInicio +" " + HoraInicio;

                var dateInicio = new Date(Inicio);

                var end = moment(dateInicio).add(0.5,"hour");

                $('#HoraFin').val(end.format("HH:mm"));


            }

            $(function() {
    $('input').keyup(function() {
        this.value = this.value.toLocaleUpperCase();
    });
});

$("#txtTelefonoPaciente").keyup(function(){
  var regex = /[^\d]/g;
  //var regex = /^([0-9]{3})([0-9]{3})([0-9]{4})$/;

   $("#txtTelefonoPaciente").val($("#txtTelefonoPaciente").val().replace(regex, ""));
});


</script>
</body>
</html>
