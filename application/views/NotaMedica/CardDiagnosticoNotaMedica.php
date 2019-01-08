<div class="row match-height">
        <div class="col-md-12">
            <div class="card">
                <!--CARD HEADER-->
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form">Diagnostico</h4>
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
                            <label for="DiagnosticoGeneral">Diagnostico</label>
                            <div class="position-relative has-icon-left">
                                    <textarea id="DiagnosticoGeneral" rows="5" class="form-control" name="DiagnosticoGeneral" placeholder="Diagnostico General"></textarea>
                                    <div class="form-control-position">
                                            <i class="icon-file2"></i>
                                    </div>
                            </div>
                            
                            <div class="row">
                                
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="CategoriasDiagnostico">Producto</label>
                                        <select name="CategoriasDiagnostico" id="CategoriasDiagnostico" class="form-control"  >
                                            <option value="">Categoria</option>
                                        </select>
                                    </div>
                                </div>
                                
                                
                          
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="btnAgregarDiag">Agregar</label>
                                        <button type="button" class="btn btn-blue" id="btnAgregarDiag">
                                           >>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="table-responsive">
                                        <table class="table" id="tablaDiagnosticos">
                                            <thead class="thead-inverse">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Diagnostico</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

<script type="text/javascript">
    $(document).ready(function()
    {
       
       
       $('#btnAgregarDiag').click(function(){
        
 
 
            
        var idDiagnostico = $("#CategoriasDiagnostico").val();
        
       
        var DescripcionDiagnostico = $("#CategoriasDiagnostico option:selected").html();
        var numFila = $('#tablaDiagnosticos tbody tr').length+1;

        if (idDiagnostico !=="")
        {
            $('#tablaDiagnosticos').append(
                '<tr id=rowD'+numFila+'>'+
                '<td>'+numFila+'</td>'+
                '<td><input type="hidden" class="form-control" name="IdDiagnostico[]" value="'+idDiagnostico+'">'+DescripcionDiagnostico+'</td>'+
                '<td type="button" name="removeDiag" class="btn btn-danger btn-xs removeDiag" data-row="rowD'+numFila+'"><i class="icon-ios-trash"></i></td>'+
                '</tr>'
                );
        }
        else
        {
            alert("Seleccione una Categoria de Diagnostico para agregar");
        }
            
    });

    //Borrar filas de la tabla productos
    $(document).on('click', '.removeDiag', function(){
        var delete_row = $(this).data("row");
        
        $('#' + delete_row).remove();

        
    });
    
    CargarDiagnosticos(); 
        
    });
    
    function CargarDiagnosticos()
    {
        var servicio_id = 1;
        $.ajax({
                  url:"<?php echo site_url();?>/NotaMedica_Controller/CargarCBDiagnosticoServicio",
                  method:"POST",
                  data:{servicio_id:servicio_id},
                  success: function(data)
                    {
                        $('#CategoriasDiagnostico').html(data);
                    }
              });
              
        
    }
    
    

    
</script>
