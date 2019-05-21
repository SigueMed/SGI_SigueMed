<div class="row match-height">
        <div class="col-md-12">
            <div class="card">
                <!--CARD HEADER-->
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form">Seguimiento</h4>
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
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group">
                                            <label for="DescripcionSeguimiento">Seguimiento</label>
                                            <input type="text" name="DescripcionSeguimiento" id="DescripcionSeguimiento" class="form-control" placeholder="Descripción Seguimiento"/>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                            <label for="diasSeguimiento">días</label>
                                            <input type="text" name="diasSeguimiento" id="diasSeguimiento" class="form-control" placeholder="Días" value ="3" onchange="EstablecerFechaSeguimiento(this.value)"/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="FechaSeguimiento">Fecha Seguimiento</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="date" id="FechaSeguimiento" class="form-control" name="FechaSeguimiento" value=""/>
                                            <div class="form-control-position">
                                                    <i class="icon-calendar5"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        
                                        <button type="button" class="btn btn-blue" id="btnAgregarSeg">
                                           +
                                        </button>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table" id="tablaSeguimiento">
                                            <thead class="thead-inverse">
                                                <tr>
                                                    <th width="5%">#</th>
                                                    <th width="55%">Seguimento</th>
                                                    <th width="30%">Fecha Seguimiento</th>
                                                    <th width="10%"></th>
                                                    
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
     EstablecerFechaSeguimiento(3);
          //Agregar nueva fila a la tabla productos
        $('#btnAgregarSeg').click(function(){
        
 
            
            var descSeguimiento = $("#DescripcionSeguimiento").val();
            var fechaSeguimiento = $("#FechaSeguimiento").val();
            
            var numFila = $('#tablaSeguimiento tbody tr').length+1;
  
           
            
            
            if(descSeguimiento!=="" && fechaSeguimiento !== "")
            {
                $('#tablaSeguimiento').append(
                    '<tr id=row'+numFila+'>'+
                    '<td>'+numFila+'</td>'+
 
                    '<td nowrap><input class="form-control" name="ColDescSeguimiento[]" value="'+descSeguimiento+'" readonly></td>'+
                    '<td><input class="form-control" name="ColFechaSeguimiento[]" value="'+fechaSeguimiento+'"readonly></td>'+
                    
                    '<td type="button" name="removeSeg" class="btn btn-danger btn-xs removeSeg" data-row="row'+numFila+'"><i class="icon-ios-trash"></i></td>'+
                    '</tr>'
                    );
                
            }
            $("#DescripcionSeguimiento").val('');
                     
            
        });
        
        $('#FechaSeguimiento').on('change',function(){
            var dias = $('#diasSeguimiento').val();
            EstablecerFechaSeguimiento(dias);
        });
            
        //Borrar filas de la tabla seguimiento
        $(document).on('click', '.removeSeg', function(){
            var delete_row = $(this).data("row");
            
           
            $('#' + delete_row).remove();
            
            
        });
    });
    
    function EstablecerFechaSeguimiento(dias)
    {
     var hoy = new Date();
     
     
     
    hoy.setDate(hoy.getDate()+dias);
    var m =  parseInt(hoy.getMonth())+1;
    if (m <10)
     {
         m = '0'+m;
     }
     
     //alert(hoy);
     $('#FechaSeguimiento').val(hoy.getFullYear()+'-'+m+'-'+hoy.getDate());
    }
</script>
