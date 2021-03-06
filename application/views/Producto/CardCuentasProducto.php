<div class="row match-height">
        <div class="col-md-12">
            <div class="card">
                <!--CARD HEADER-->
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form">Cuentas Producto</h4>
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



                        </div>
                        <!-- FORM ACTIONS-->
                        <div class="form-actions">
                            <?php
                                if($CuentasProductoActionsEnabled == true)
                                {
                                    echo '<button type="submit" class="btn btn-warning mr-1" name="action" value="cerrar">';
                                    echo '<i class="icon-cross2"></i> Cerrar';
                                    echo '</button>';
                                    if($CuentasProductoCancelActionEnabled==true)
                                    {
                                        echo '<button type="submit" class="btn btn-danger mr-1" name="action" value="'.$CuentasProductoCancelAction.'">';
                                        echo '<i class="icon-cross2"></i>'.$CuentasProductoCancelTitle;
                                        echo '</button>';

                                    }

                                    echo '<button type="submit" class="btn btn-success" name="action" value='.$CuentasProductoSubmitAction.'>';
                                    echo '<i class="icon-check2"></i>'.$CuentasProductoSubmitTitle;
                                    echo '</button>';
                                }
                            ?>


                        </div>
                    </div>
                </div>
            </div><!--DIV CARD-->
        </div><!--DIV COL-MD-->
</div><!--DIV ROW MATCH-->

<script type="text/javascript">
    $(document).ready(function(){

       CargarValores();

        //Agregar nueva fila a la tabla productos



    });

    

</script>
