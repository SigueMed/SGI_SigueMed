<div class="row match-height">
        <div class="col-md-12">
            <div class="card">
                <!--CARD HEADER-->
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form">Familiares Responsables</h4>
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
                            <button type="button" class="btn btn-info btn-sm" onclick="ShowModal()">Nuevo Familiar</button>
                            
                            <table id="tblFamiliaresResponsables" class="table table-striped table-bordered table-responsive" style="width:80%">
                                    <thead>
                                        <tr>
                                            <th>Parentesco</th>
                                            <th>Nombre(s)</th>
                                            <th>Apellidos</th>
                                            <th>Teléfono</th> 
                                            <th>Fecha Nacimiento</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                            </table>
                            <!-- Modal 1 (Agregar, modificar, eliminar) (ventana modal con Bootstrap) -->
                            <div class="modal fade" id="modalNuevoFamiliar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog modal-lg" role="document">
                                  <div class="modal-content">
                                    <div class="modal-body">
                                       
                                            <h4 class="form-section"><i class="icon-head"></i>Datos Personales</h4>
                                            <input type="text" hidden="true" name="IdFamiliarResponsable" id="IdFamiliarResponsable"/>
                                            <div class="row">
                                                    <div class="col-md-4">
                                                            <div class="form-group">
                                                                    <label for="FRParentesco">Parentesco</label>
                                                                    <input type="text" name="FRParentesco" id="FRParentesco" class="form-control" placeholder="Parentesco"/>
                                                            </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                            <div class="form-group">
                                                                    <label for="FRNombre">Nombre</label>
                                                                    <input type="text" name="FRNombre" id="FRNombre" class="form-control" placeholder="Nombre"/>
                                                            </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                            <div class="form-group">
                                                                    <label for="FRApellidos">Apellidos</label>
                                                                    <input type="text" name="FRApellidos" id="FRApellidos" class="form-control" placeholder="Apellidos"/>
                                                            </div>
                                                    </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 col-xs-6">
                                                    <div class="form-group">
                                                        <label for="FRFechaNacimiento">Fecha Nacimiento</label>
                                                        <div class="position-relative has-icon-left">
                                                            <input type="date" id="FRFechaNacimiento" class="form-control" name="FRFechaNacimiento" value="" onchange="FRActualizarEdad()"/>
                                                            <div class="form-control-position">
                                                                    <i class="icon-calendar5"></i>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-md-2 col-xs-6">
                                                    <div class="form-group">
                                                            <label for="FREdad">Edad</label>
                                                            <input type="text" name="FREdad" id ="FREdad" class="form-control" placeholder="Edad" readonly/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="FRCelular">Celular:</label>
                                                        <input type="text" id = "FRCelular" name="FRCelular" class="form-control" placeholder="Celular"/>
                                                    </div>
                                                </div>
                                                


                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="FRcbEscolaridad">Escolaridad:</label>
                                                        <select name="FRcbEscolaridad" id="FRcbEscolaridad" class="form-control" onchange="">
                                                            <option value="">Escolaridad</option>

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="FREscolaridad">Otro:</label>
                                                        <input type="text" id = "FREscolaridad" name="FREscolaridad" class="form-control" placeholder="Otro-Escolaridad"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="FRcbEstadoCivil">Estado Civil:</label>
                                                        <select name="FRcbEstadoCivil" id="FRcbEstadoCivil" class="form-control" onchange="">
                                                            <option value="">Estado Civil</option>

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="FRViveCon">Vive con:</label>
                                                        <input type="text" name="FRViveCon" id="FRViveCon" class="form-control" placeholder="Vive con"/>
                                                    </div>
                                                </div>


                                            </div>

                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="FRcbReligion">Religion:</label>
                                                        <select name="FRcbReligion" id="FRcbReligion" class="form-control" onchange="">
                                                            <option value="">Religion</option>

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="FRReligion">Otro:</label>
                                                        <input type="text" id = "FRReligion" name="FRReligion" class="form-control" placeholder="Otro-Religion"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="FRcbOcupacion">Ocupación:</label>
                                                        <select name="FRcbOcupacion" id="FRcbOcupacion" class="form-control" onchange="">
                                                            <option value="">Ocupación</option>

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="FROcupacion">Otro:</label>
                                                        <input type="text" name="FROcupacion" id="FROcupacion" class="form-control" placeholder="Otro-Ocupación"/>
                                                    </div>
                                                </div>


                                            </div>

                                            

                                            <h4 class="form-section"><i class="icon-clipboard4"></i> Dirección</h4>


                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="FRDondeVive">Donde Vive:</label>
                                                        <select name="FRDondeVive" id="FRDondeVive" class="form-control" onchange="">
                                                            <option value="">Seleccione una opción</option>
                                                            <option value="1">Zona Urbana</option>
                                                            <option value="0">Zona Rural</option>

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="FRCalle">Calle</label>
                                                        <input type="text" name="FRCalle" id="FRCalle" class="form-control" placeholder="Calle"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="FRcolonia">Colonia</label>
                                                        <input type="text" name="FRColonia" id="FRColonia" class="form-control" placeholder="Colonia"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                         <label for="FRCP">Código Postal</label>
                                                        <input type="text" id="FRCP" name="FRCP" class="form-control" placeholder="C.P."/>
                                                    </div>
                                                </div>
                                                
                                            </div>

                                            <!-- FORM ACTIONS-->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-warning mr-1" data-dismiss="modal">
                                                    <i class="icon-cross2"></i>Cerrar
                                                </button>
                                                <button type="button" class="btn btn-success mr-1" name="btnAgregarFamiliar" id ="btnAgregarFamiliar" onclick="GuardarNuevoFamiliar(event)">
                                                    <i class="icon-check2"></i>Insertar
                                                </button>
                                                <button type="button" class="btn btn-success mr-1" name="btnModificarFamiliar" id ="btnModificarFamiliar" onclick="ModificarFamiliar(event)" disabled="true">
                                                    <i class="icon-edit"></i>Modificar
                                                </button>
                                                




                                            </div>
                                          
                                              
                                        
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
    $(document).ready(function()
    {
        FRCargaEscolaridad();
        FRCargarEstadoCivil();
        FRCargarReligion();
        FRCargarOcupacion();
        FRCargarRecursosMedicos();
        FRCargarFamiliaresPaciente();
    });
    
    function GuardarNuevoFamiliar(event)
    {
        event.preventDefault();
        if($("#FRParentes").val()==="")
        {
          
            alert("El parentesco es requerido");
        }
        else if($("#FRNombre").val()==="")
        {
          
            alert("El nombre es requerido");
        }
        else
        {
            
            var Paciente = <?= json_encode($Paciente)?>;
            var IdPaciente= Paciente['IdPaciente'];
            var Parentesco= $("#FRParentesco").val();
            var Nombre =$("#FRNombre").val();
            var Apellidos = $("#FRApellidos").val();
            var Telefono = $("#FRCelular").val();
            var FechaNacimiento =$("#FRFechaNacimiento").val();
            var IdEscolaridad = $("#FRcbEscolaridad").val();
            var Escolaridad =$("#FREscolaridad").val();
            var IdEstadoCivil=$("#FRcbEstadoCivil").val();
            var IdReligion =$("#FRcbReligion").val();
            var Religion=$("#FRReligion").val();
            var IdOcupacion= $("#FRcbOcupacion").val();
            var Ocupacion= $("#FROcupacion").val();
            var DondeVive =$("#FRDondeVive").val();
            var Calle =$("#FRCalle").val();
            var Colonia =$("#FRColonia").val();
            var CodigoPostal =$("#FRCP").val();
            


            
             $.ajax({
                type: "POST",
                url: "<?php echo site_url();?>/Paciente_Controller/AgregarNuevoFamiliar_ajax",
                
                data: {
                    IdPaciente:IdPaciente,
                    Parentesco:Parentesco,
                    Nombre:Nombre,
                    Apellidos:Apellidos,
                    Telefono:Telefono,
                    FechaNacimiento:FechaNacimiento,
                    IdEscolaridad:IdEscolaridad,
                    Escolaridad:Escolaridad,
                    IdEstadoCivil:IdEstadoCivil,
                    IdReligion:IdReligion,
                    Religion:Religion,
                    IdOcupacion:IdOcupacion,
                    Ocupacion:Ocupacion,
                    DondeVive:DondeVive,
                    Calle:Calle,
                    Colonia:Colonia,
                    CodigoPostal:CodigoPostal
                    
                },
                success: function(r){
                    
                    if(r==='1')
                    {
                        alert('Familiar agregado exitosamente');
                        $("#modalNuevoFamiliar").modal('hide');
                        FRCargarFamiliaresPaciente();
                    }
                    else
                    {
                        alert ('Error al agregar un nuevo familiar');
                    }
                     

                }
            });
        }
    }
    
    function FRActualizarEdad()
    {
        edad = CalcularEdad($("#FRFechaNacimiento").val());
        $("#FREdad").val(edad);
    }
    
    
    function FRCalcularEdad(FechaNacimiento)
    {
        var hoy = new Date();
        var cumpleanos = new Date(FechaNacimiento);
        var edad = hoy.getFullYear() - cumpleanos.getFullYear();
        var m = hoy.getMonth() - cumpleanos.getMonth();

        if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
            edad--;
        }

        return edad;  
    }
    
    function FRCargaEscolaridad()
    {
        $.ajax({
                  url:"<?php echo site_url();?>/Paciente_Controller/CargarEscolaridad_ajax",
                  method:"POST",
                  success: function(data)
                    {
                        
                        $('#FRcbEscolaridad').html(data);
                        
                        
                    }
              });
    }   
    
    function FRCargarEstadoCivil()
    {
        $.ajax({
                  url:"<?php echo site_url();?>/Paciente_Controller/CargarEstadoCivil_ajax",
                  method:"POST",
                  success: function(data)
                    {
                        
                        $('#FRcbEstadoCivil').html(data);
                        
                       
                    }
              });
    }
    
    
    function FRCargarReligion()
    {
        $.ajax({
                  url:"<?php echo site_url();?>/Paciente_Controller/CargarReligion_ajax",
                  method:"POST",
                  success: function(data)
                    {
                        
                        $('#FRcbReligion').html(data);
                        
                       
                    }
              });
    }
    
    function FRCargarOcupacion()
    {
        $.ajax({
                  url:"<?php echo site_url();?>/Paciente_Controller/CargarOcupacion_ajax",
                  method:"POST",
                  success: function(data)
                    {
                        
                        $('#FRcbOcupacion').html(data);
                        
                       
                    }
              });
    }
    
    function FRCargarRecursosMedicos()
    {
        $.ajax({
                  url:"<?php echo site_url();?>/Paciente_Controller/CargarRecursosMedicos_ajax",
                  method:"POST",
                  success: function(data)
                    {
                        
                        $('#FRcbRecursosMedicos').html(data);
                        
                        
                    }
              });
    }
    
    function FRCargarFamiliaresPaciente()
    {
        
        var Paciente = <?= json_encode($Paciente)?>;
        
        
        if (Paciente !== null)
        {
            
           $.ajax({
                  url:"<?php echo site_url();?>/Paciente_Controller/ConsultarFamiliaresPaciente",
                  method:"POST",
                  data: {IdPaciente:Paciente['IdPaciente']},
                  success: function(r)
                    {
                        
                       var Familiares = JSON.parse(r);
                     
                       var t = $('#tblFamiliaresResponsables').DataTable({
                               "destroy":true,
                               "language": {
                                    "lengthMenu": "Mostrando _MENU_ registros por pag.",
                                    "zeroRecords": "Sin Datos - disculpa",
                                    "info": "Motrando pag. _PAGE_ de _PAGES_",
                                    "infoEmpty": "Sin registros disponibles",
                                    "infoFiltered": "(filtrado de _MAX_ total)"
                                }
                               
                                });   
                        t.clear();
                        t.draw();
                       for(i=0;i<Familiares.length;i++)
                       {
                           t.row.add([
                               Familiares[i]['Parentesco'],
                               Familiares[i]['Nombre'],
                               Familiares[i]['Apellidos'],
                               Familiares[i]['Telefono'],
                               Familiares[i]['FechaNacimiento'],
                               '<a classs = "btn" onclick="ConsultarFamiliarModal('+Familiares[i]['IdFamiliarResponsable']+')"><i class="icon-edit" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Editar"></i></a>'
                               
                           ]).draw(false);
                        
                           
                          
                           
                       }
                    }
              });
        }

    }
    
    function ConsultarFamiliarModal(IdFamiliarResponsable)
    {
         $.ajax({
                  url:"<?php echo site_url();?>/Paciente_Controller/ConsultarFamiliarResponsable",
                  data:{
                        IdFamiliar: IdFamiliarResponsable
              
                    },
                  method:"POST",
                  success: function(data)
                    {
                        
                        var FamiliarResponsable = JSON.parse(data);
                        if (FamiliarResponsable !== null)
                        {
                            LimpiarModal();
                            $("#IdFamiliarResponsable").val(FamiliarResponsable['IdFamiliarResponsable']);
                            $("#FRParentesco").val(FamiliarResponsable['Parentesco']);
                            $("#FRNombre").val(FamiliarResponsable['Nombre']);
                            $("#FRApellidos").val(FamiliarResponsable['Apellidos']);
                            $("#FRFechaNacimiento").val(FamiliarResponsable['FechaNacimiento']);
                            FRActualizarEdad();
                            $("#FRCelular").val(FamiliarResponsable['Telefono']);
                            $("#FRcbEscolaridad").val(FamiliarResponsable['IdEscolaridad']);
                            $("#FREscolaridad").val(FamiliarResponsable['Escolaridad']);
                            $("#FRcbOcupacion").val(FamiliarResponsable['IdOcupacion']);
                            $("#FROcupacion").val(FamiliarResponsable['Ocupacion']);
                            $("#FRcbEstadoCivil").val(FamiliarResponsable['IdEstadoCivil']);
                            $("#FREstadoCivil").val(FamiliarResponsable['EstadoCivil']);
                            $("#FRcbReligion").val(FamiliarResponsable['IdReligion']);
                            $("#FRReligion").val(FamiliarResponsable['Religion']);
                            $("#FRDondeVive").val(FamiliarResponsable['DondeVive']);
                            $("#FRCalle").val(FamiliarResponsable['Calle']);
                            $("#FRColonia").val(FamiliarResponsable['Colonia']);
                            $("#FRCP").val(FamiliarResponsable['CodigoPostal']);
                            $('#btnAgregarFamiliar').prop("disabled",true);
                            $('#btnModificarFamiliar').prop("disabled",false);
                            $("#modalNuevoFamiliar").modal('show');
                        }
                            
                    }
              });
    }
    
    
    
    function ModificarFamiliar(event)
    {
        event.preventDefault();
        if($("#FRParentes").val()==="")
        {
          
            alert("El parentesco es requerido");
        }
        else if($("#FRNombre").val()==="")
        {
          
            alert("El nombre es requerido");
        }
        else
        {
            
            
            var IdFamiliarResponsable= $("#IdFamiliarResponsable").val();
            var Parentesco= $("#FRParentesco").val();
            var Nombre =$("#FRNombre").val();
            var Apellidos = $("#FRApellidos").val();
            var Telefono = $("#FRCelular").val();
            var FechaNacimiento =$("#FRFechaNacimiento").val();
            var IdEscolaridad = $("#FRcbEscolaridad").val();
            var Escolaridad =$("#FREscolaridad").val();
            var IdEstadoCivil=$("#FRcbEstadoCivil").val();
            var IdReligion =$("#FRcbReligion").val();
            var Religion=$("#FRReligion").val();
            var IdOcupacion= $("#FRcbOcupacion").val();
            var Ocupacion= $("#FROcupacion").val();
            var DondeVive =$("#FRDondeVive").val();
            var Calle =$("#FRCalle").val();
            var Colonia =$("#FRColonia").val();
            var CodigoPostal =$("#FRCP").val();
            


            
             $.ajax({
                type: "POST",
                url: "<?php echo site_url();?>/Paciente_Controller/ModificarFamiliar_ajax",
                
                data: {
                    IdFamiliarResponsable:IdFamiliarResponsable,
                    Parentesco:Parentesco,
                    Nombre:Nombre,
                    Apellidos:Apellidos,
                    Telefono:Telefono,
                    FechaNacimiento:FechaNacimiento,
                    IdEscolaridad:IdEscolaridad,
                    Escolaridad:Escolaridad,
                    IdEstadoCivil:IdEstadoCivil,
                    IdReligion:IdReligion,
                    Religion:Religion,
                    IdOcupacion:IdOcupacion,
                    Ocupacion:Ocupacion,
                    DondeVive:DondeVive,
                    Calle:Calle,
                    Colonia:Colonia,
                    CodigoPostal:CodigoPostal
                    
                },
                success: function(r){
                    
                    if(r==='1')
                    {
                        alert('Familiar actualizado exitosamente');
                        $("#modalNuevoFamiliar").modal('hide');
                        FRCargarFamiliaresPaciente();
                    }
                    else
                    {
                        alert ('Error al guardar un nuevo familiar');
                    }
                     

                }
            });
        }
    }
    
        
    
   function ShowModal()
    {
        LimpiarModal();
        $('#btnAgregarFamiliar').prop("disabled",false);
        $('#btnModificarFamiliar').prop("disabled",true);
        $("#modalNuevoFamiliar").modal('show');
    }
    
    function LimpiarModal()
    {
        $("#IdFamiliarResponsable").val('');
        $("#FRParentesco").val('');
        $("#FRNombre").val('');
        $("#FRApellidos").val('');
        $("#FRFechaNacimiento").val('');
        $("#FREdad").val('');
        $("#FRCelular").val('');
        $("#FRcbEscolaridad").val('');
        $("#FREscolaridad").val('');
        $("#FRcbOcupacion").val('');
        $("#FROcupacion").val('');
        $("#FRcbEstadoCivil").val('');
        $("#FREstadoCivil").val('');
        $("#FRcbReligion").val('');
        $("#FRReligion").val('');
        $("#FRDondeVive").val('');
        $("#FRCalle").val('');
        $("#FRColonia").val('');
        $("#FRCP").val('');
        
    }
    
    
    
    
</script>
