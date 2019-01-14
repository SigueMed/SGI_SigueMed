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
                                <div class="col-md-5">
                                    <div class="form-group">
                                            <label for="DescripcionSeguimiento">Seguimiento</label>
                                            <input type="text" name="DescripcionSeguimiento" id="DescripcionSeguimiento" class="form-control" placeholder="Apellidos"/>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="FechaSeguimiento">Fecha Seguimiento</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="date" id="FechaSeguimiento" class="form-control" name="FechaSeguimiento" value="<?php echo $Paciente->FechaNacimiento; ?>"/>
                                            <div class="form-control-position">
                                                    <i class="icon-calendar5"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="btnAgregarDiag">Agregar</label>
                                        <button type="button" class="btn btn-blue" id="btnAgregarDiag">
                                           >>
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
                                                    <th>#</th>
                                                    <th>Seguimento</th>
                                                    <th>Fecha Seguimiento</th>
                                                    <th></th>
                                                    
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

