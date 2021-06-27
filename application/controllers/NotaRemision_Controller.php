  <?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class NotaRemision_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Cargar herramientas para form
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('url_helper');
        $this->load->helper('date');
         //Cargar Modelos usados por el Controlador para el manejo de las Notas de remision
        $this->load->model('NotaMedica_Model');
        $this->load->model('Paciente_Model');
        $this->load->model('ProductosNotaMedica_Model');
        $this->load->model('NotaRemision_Model');
        $this->load->model('Servicio_Model');
        $this->load->model('DetalleNotaRemision_Model');
        $this->load->model('PagoNotaRemision_Model');
        $this->load->model('CatalogoTipoPago_Model');
        $this->load->model('MovimientoCuenta_Model');
        $this->load->model('MovimientoInventario_Model');
        $this->load->model('SeguimientoMedico_Model');
        $this->load->model('NotaRemisionTemp_Model');

    }
        public function index(){
                $this->load->view('templates/headerMenu');

	}

        public function Load_RegistrarNotaRemision()
        {
            $data['title'] = 'Registrar Nueva Nota de Remisión';

            $data['NotaTemporal'] = 0;
            $data['NotaRemisionTemp'] = null;
            $data['DetalleNotaRemisionTemp'] = null;
            $data['IdNotaRemisionTemp'] = null;

            $this->load->view('templates/MainContainer',$data);
            $this->load->view('templates/HeaderContainer',$data);
            $this->load->view('NotaRemision/CardPuntoVenta',$data);
//
            $this->load->view('templates/FooterContainer');
        }

         public function Load_RegistrarNotaRemisionInventario()
        {
            $data['title'] = 'Registrar Venta Inventario';

            $this->load->view('templates/MainContainer',$data);
            $this->load->view('templates/HeaderContainer',$data);
            $this->load->view('NotaRemision/FormCrearNotaRemision');
            $this->load->view('NotaRemision/CardNotaRemision',$data);
            $this->load->view('NotaRemision/CardProductosInventario',$data);
            $this->load->view('NotaMedica/CardProductosNotaMedica',$data);
            $this->load->view('NotaRemision/CardResumenNotaRemision',$data);
            $this->load->view('templates/FormFooter',$data);
            $this->load->view('templates/FooterContainer');
        }

        /*
         * DESCRIPCION: Función para el metodo Submit del formulario NotaRemision. Crear la nota de remisión con los datos
         * capturados por el usuario Action -> crear
         * AUTOR: Constanzo Manuel Basurto Chipolini
         * FECHA U.MOD.: 13/03/2019
         */
        public function RegistrarNotaRemision()
        {
            $action = $this->input->post('action');
            $transStatus = FALSE;

            log_message('DEBUG','NotaRemisionController.RegistrarNotaRemision.action='.$action);

            //Crear Nota de Remisión
            if ($action =="crear")
            {
                try
                {
                    $this->db->trans_start();
                    $IdPaciente = $this->input->post('idPaciente');
                    $FechaNotaRemision = now();
                    $IdEmpleado = $this->session->userdata('IdEmpleado');
                    $IdTurno = $this->session->userdata('IdTurno');
                    $TotalNota = $this->input->post('TotalNota');
                    $TotalPagadoNota = $this->input->post('resumenTotalPago');
                    $MedicoAtendio= $this->input->post('MedicoAtendio');
                    $ComentariosNota = $this->input->post('ComentariosNota');

                    if ($this->input->post('RequiereFactura')==1)
                    {
                        $RequiereFactura = TRUE;
                    }
                    else
                    {
                        $RequiereFactura = FALSE;
                    }

                    $IdFoliador = $this->input->post('IdFoliador');
                    log_message('debug','CREAR NOTAR REMISION=>'.$IdFoliador);
                    $this->load->model('Foliador_Model');
                    $FolioNotaRemision = $this->Foliador_Model->ObtenerFolio($IdFoliador);

                    //CREAR NOTA DE REMISION
                    $NotaRemision = array(
                        'Folio'=> $FolioNotaRemision,
                        'IdFoliador'=>$IdFoliador,
                        'IdPaciente'=> $IdPaciente,
                        'FechaNotaRemision'=> mdate('%Y-%m-%d',$FechaNotaRemision),
                        'IdEmpleado' =>$IdEmpleado,
                        'IdTurno'=> $IdTurno,
                        'TotalNotaRemision'=>$TotalNota,
                        'TotalPagado'=>0,
                        'IdEstatusNotaRemision'=>1,
                        'RequiereFactura'=>$RequiereFactura,
                        'MedicoAtendio'=>$MedicoAtendio,
                        'ComentariosNota'=>$ComentariosNota,
                        'IdClinica'=>$this->session->userdata('IdClinica')
                    );

                    $IdNuevaNotaRemision = $this->NotaRemision_Model->CrearNotaDeRemision($NotaRemision);

                    $this->Foliador_Model->AplicarFolio($IdFoliador);


                    if($IdNuevaNotaRemision !=null)
                    {

                       //CARGAR DETALLE NOTA REMISION
                        $IdProductos = $this->input->post('IdProductos');

                        $cantidadProductos = $this->input->post('cantidad');
                        $precioProductos = $this->input->post('precio');
                        $CodigoSubProducto = $this->input->post('CodigoSubProducto');
                        $Lote = $this->input->post('Lote');
                        $DescuentoProductos = $this->input->post('descuento');
                        $SubTotal = $this->input->post('subtotal');
                        $EsProveedor = $this->input->post('proveedor');
                        $PreciosProveedor = $this->input->post('preciosproveedor');
                        //$IdEmpleado = $this->input->post('IdEmpleado');
                    if (isset($IdProductos))
                        {

                           for ($i=0;$i<sizeof($IdProductos); $i++)
                           {

                               if (isset($CodigoSubProducto)&& is_array($CodigoSubProducto))
                               {
                                   $strCodigoSubProducto =$CodigoSubProducto[$i] ;
                               }
                               else
                               {

                                   $strCodigoSubProducto = null;
                               }
                               if(isset($Lote)&&is_array($Lote))
                               {
                                   $strLote = $Lote[$i];
                               }
                               else
                               {
                                   $strLote = null;
                               }

                               if ($EsProveedor[$i])
                               {
                                 $PrecioProveedor = $PreciosProveedor[$i];
                               }
                               else {
                                 $PrecioProveedor = 0;
                               }

                               $DetalleNotaRemision = array(
                                   'IdNotaRemision'=>$IdNuevaNotaRemision->IdUltimaNotaRemision,
                                   'IdProducto'=>$IdProductos[$i],
                                   'Cantidad'=>$cantidadProductos[$i],
                                   'CostoUnitario'=> $precioProductos[$i],
                                   'Descuento'=>$DescuentoProductos[$i],
                                   'IdCodigoSubProducto'=>$strCodigoSubProducto,
                                   'Lote'=>$strLote,
                                   'SubTotalDetalle'=>$SubTotal[$i],
                                   'PrecioProveedor'=> $PrecioProveedor
                               );

                                $this->DetalleNotaRemision_Model->AgregarDetalleNotaRemision($DetalleNotaRemision);


                                //REGISTRAR SALIDA DE INVENTARIO

                                if ($strCodigoSubProducto!== null)
                                {
                                    $this->MovimientoInventario_Model->RegistrarSalidaInventario($CodigoSubProducto[$i],$Lote[$i],$cantidadProductos[$i],$this->session->userdata('IdClinica'));

                                }

                           }

                        }

                        $IdNotaRemisionTemp = $this->input->post('IdNotaRemisionTemp');

                        if($IdNotaRemisionTemp!== null)
                        {
                          $this->BorrarNotaRemisionTemp($IdNotaRemisionTemp);
                        }

                          //REGISTRAR PAGO NOTA MEDICA
                          $TotalPagado = 0;
                          if ($TotalPagadoNota>0)
                          {

                            $IdFormaPagos = $this->input->post('FormasPago');
                            $Vauchers = $this->input->post('Vauchers');
                            $MontosPago = $this->input->post('MontosPago');



                            for ($i=0; $i < sizeof($IdFormaPagos) ; $i++) {


                              //DESHABILITAR PAGO ADEUDOS ANTERIORES
                              //$TotalDespuesAdeudo = $this->PagarAdeudosAnteriores($IdPaciente,$MontosPago[$i],$IdFormaPagos[$i]);
                              //log_message('debug','PagarAdeudosAnteriores->TotalPagado'.$TotalPagado);

                              // if($TotalDespuesAdeudo>0)
                              // {
                                $PorcentajePagado = $MontosPago[$i]/ $TotalNota;

                                $TotalPagado += $MontosPago[$i];

                                $PagoNotaRemision = array(
                                    'IdNotaRemision'=> $IdNuevaNotaRemision->IdUltimaNotaRemision,
                                    'FechaPago'=> mdate('%Y-%m-%d',$FechaNotaRemision),
                                    'IdEmpleado'=> $this->session->userdata('IdEmpleado'),
                                    'PorcentajeNotaRemision'=>$PorcentajePagado,
                                    'TotalPago'=>$MontosPago[$i],
                                    'IdTipoPago'=>$IdFormaPagos[$i],
                                    'Vaucher'=> $Vauchers[$i]
                                );

                                $IdNuevoPagoNotaRemision = $this->PagoNotaRemision_Model->RegistrarPagoNotaRemision($PagoNotaRemision);

                                if($IdNuevoPagoNotaRemision ===FALSE)
                                {
                                     throw new Exception('Error al registrar pago');
                                }

                                $PorcentajePagado = $MontosPago[$i] / $TotalPagadoNota;

                                //REGISTRAR MOVIMIENTOS A LAS CUENTAS
                                $MovimientosACuenta = $this->NotaRemision_Model->ConsultarMovimientosCuentaNota($IdNuevaNotaRemision->IdUltimaNotaRemision);

                                foreach ($MovimientosACuenta as $movimiento)
                                {
                                    $TotalMovimientoCuenta = $PorcentajePagado * $movimiento['TotalCuenta'];
                                    $NuevoMovimientoCuenta = array(
                                        'IdCuenta'=> $movimiento['IdCuenta'],
                                        'FechaMovimientoCuenta'=> mdate('%Y-%m-%d',now()),
                                        'IdPagoNotaRemision'=>$IdNuevoPagoNotaRemision->IdPagoNotaRemision,
                                        'IdTipoMovimientoCuenta'=> 1,
                                        'TotalMovimiento' => $TotalMovimientoCuenta,
                                        'IdEstatusMovimientoCuenta'=> MC_PENDIENTEPAGO,
                                        'IdTipoPago'=>$IdFormaPagos[$i],
                                        'IdClinica'=>$this->session->userdata('IdClinica')

                                    );

                                    $this->MovimientoCuenta_Model->RegistrarNuevoMovimientoCuenta($NuevoMovimientoCuenta);
                                }

                              //}





                              }

                          }

                          //DETERMINAR ESTATUS DE NOTA
                          if ($TotalPagado >= $TotalNota)
                          {
                              $EstatusNotaRemision = NR_PAGADO;
                          }
                          else if($TotalPagado < $TotalNota && $TotalPagado >0)
                          {
                              $EstatusNotaRemision = NR_PAGO_PARCIAL;
                          }
                          else if ($TotalPagado <= 0)
                          {
                              $EstatusNotaRemision = NR_NO_PAGADO;
                          }

                          $EstatusNotaRemision = array(

                              'TotalPagado'=> $TotalPagado,
                              'IdEstatusNotaRemision'=>$EstatusNotaRemision

                          );

                          $this->NotaRemision_Model->ActualizarNotaRemision($IdNuevaNotaRemision->IdUltimaNotaRemision,$EstatusNotaRemision);

                          //CAMBIAR ESTATUS NOTAS MEDICAS A PAGADAS
                        $NotasMedicasAbiertas = $this->input->post('chkNotasAtendidas');

                        if (!empty($NotasMedicasAbiertas))
                        {
                            for ($i=0;$i<sizeof($NotasMedicasAbiertas); $i++)
                            {

                                $this->NotaMedica_Model->ActualizarEstatusNotaMedica($NotasMedicasAbiertas[$i], NM_PAGADA);
                            }
                        }

                        //REGISTRAR SEGUIMIENTOS A PACIENTE
                        $descripcionesSeguimiento = $this->input->post('ColDescSeguimiento');
                        $fechasSeguimiento = $this->input->post('ColFechaSeguimiento');

                        if (isset($descripcionesSeguimiento))
                        {
                            for($i=0; $i<sizeof($descripcionesSeguimiento);$i++)
                            {
                                $Seguimientos[] = array(
                                    'DescripcionSeguimiento'=> $descripcionesSeguimiento[$i],

                                    'IdPaciente' => $IdPaciente,
                                    'IdEstatusSeguimiento'=>1,
                                    'IdElaboradoPor'=> $this->session->userdata('IdEmpleado'),
                                    'FechaSeguimiento' => $fechasSeguimiento[$i]);
                            }

                            $this->SeguimientoMedico_Model->AgregarSeguimientoNotaMedicaBatch($Seguimientos);



                        }



                        $transStatus = $this->db->trans_complete();

                        if ($transStatus == true)
                        {
                            $this->db->trans_commit();
                        }
                        else
                        {
                            $this->db->trans_rollback();
                        }

                        $data['title'] = 'Nota de Remisión';
                        $data['IdNotaRemision']= $IdNuevaNotaRemision->IdUltimaNotaRemision;

                        $data['title']='Registrar Nuevo Paciente';

                        $data['swal']=true;
                        $data['swalMessage']="title:'Nota registrada',
                        text: 'La Nota No. ".$FolioNotaRemision." ha sido registrada exitosamente',
                        type: 'success',
                        showConfirmButton: true,
                        confirmButtonText:'<i class=\"icon-file-o\"></i> Nueva Nota',
                        showCancelButton: true,
                        cancelButtonText: '<i class=\"icon-printer4\"></i> Ticket'";

                        $data['swalAction'] = ".then((result)=> {
                          if (result.value) {
                            window.location.href ='".site_url("NotaRemision/CrearNota")."';
                          }
                          else {
                            window.open ('".site_url("NotaRemision/CrearPDF/").$IdNuevaNotaRemision->IdUltimaNotaRemision."');
                          }
                        });";
                        $this->load->view('templates/MainContainer',$data);
                        $this->load->view('templates/HeaderContainer',$data);
                        $this->load->view('templates/FormFooter',$data);
                        $this->load->view('templates/FooterContainer');




                    }
                    else
                    {

                        throw new Exception('Error al crear la Nota de Remisión');
                    }


                    //Crear Nota de Remisión

                } catch (Exception $ex)
                {
                    log_message('error', $ex->getMessage());
                    $this->db->trans_rollback();

                }

            }
            else if($action =="guardar")
            {

              $IdNotaRemisionTemp = $this->input->post('IdNotaRemisionTemp');

              if ($IdNotaRemisionTemp==null)
              {
                log_message('DEBUG','GuardarNotaRemisionTemp');
                $this->GuardarNotaRemisionTemporal();

              }
              else {
                log_message('DEBUG','ActualizarNotaRemisionTemp');
                $this->ActualizarNotaRemisionTemp();
              }



            }

              // code...


        }

        public function PagarAdeudosAnteriores($IdPaciente, $TotalPagado, $TipoPago)
        {
            //PAGAR ADEUDOS ANTERIORES
            $TotalAdeudosPaciente = $this->NotaRemision_Model->ConsultarDetalleAdeudoPaciente($IdPaciente);

            foreach ($TotalAdeudosPaciente as $adeudo)
            {
                if ($TotalPagado<=0)
                {
                    return 0;
                }

                $TotalAdeudo = $adeudo['TotalAdeudo'];
                if ($TotalPagado >= $TotalAdeudo)
                {

                    $TotalPagoAdeudo = $TotalAdeudo;
                    $EstatusAdeudo = NR_PAGADO;

                    $TotalPagado = $TotalPagado - $TotalAdeudo;
                }
                else
                {

                    $TotalPagoAdeudo = $TotalPagado;
                    $EstatusAdeudo = NR_PAGO_PARCIAL;
                    $TotalPagado = 0;

                }
                $ProcentajePagadoAdeudo =$TotalPagoAdeudo/ $adeudo['TotalNotaRemision'];
                $PagoAdeudo = array(
                    'IdNotaRemision'=> $adeudo['IdNotaRemision'],
                    'FechaPago'=> mdate('%Y-%m-%d',now()),
                    'IdEmpleado'=> $this->session->userdata('IdEmpleado'),
                    'PorcentajeNotaRemision'=>$ProcentajePagadoAdeudo,
                    'TotalPago'=>$TotalPagoAdeudo,
                    'IdTipoPago'=>$TipoPago
                );
                $IdNuevoPagoNotaRemision = $this->PagoNotaRemision_Model->RegistrarPagoNotaRemision($PagoAdeudo);

                $TotalPagadoNota = $adeudo['TotalPagado'] + $TotalPagoAdeudo;


                $ActualizarNotaArray = array(
                    'IdEstatusNotaRemision'=>$EstatusAdeudo,
                    'TotalPagado' => $TotalPagadoNota
                );
                $this->NotaRemision_Model->ActualizarNotaRemision($adeudo['IdNotaRemision'],$ActualizarNotaArray);

                //REGISTRAR MOVIMIENTOS A LAS CUENTAS
                $MovimientosACuenta = $this->NotaRemision_Model->ConsultarMovimientosCuentaNota($adeudo['IdNotaRemision']);

                foreach ($MovimientosACuenta as $movimiento)
                {
                    $TotalMovimientoCuenta = $ProcentajePagadoAdeudo * $movimiento['TotalCuenta'];
                    $NuevoMovimientoCuenta = array(
                        'IdCuenta'=> $movimiento['IdCuenta'],
                        'FechaMovimientoCuenta'=> mdate('%Y-%m-%d',now()),
                        'IdPagoNotaRemision'=>$IdNuevoPagoNotaRemision->IdPagoNotaRemision,
                        'IdTipoMovimientoCuenta'=> 1,
                        'TotalMovimiento' => $TotalMovimientoCuenta,
                        'IdEstatusMovimientoCuenta'=> MC_PENDIENTEPAGO,
                        'IdTipoPago'=> $this->input->post('cb_FormaPago'),
                        'IdClinica'=>$this->session->userdata('IdClinica')

                    );

                    $this->MovimientoCuenta_Model->RegistrarNuevoMovimientoCuenta($NuevoMovimientoCuenta);
                }

            }

            return $TotalPagado;
        }

        public function ConsultarNotasAtendidasPaciente_ajax()
        {
            $IdPaciente = $this->input->post('IdPaciente');

            if ($IdPaciente !== null)
            {
                $NotasMedicas = $this->NotaMedica_Model->ConsultarNotaMedicaAtendidasPaciente($IdPaciente,$this->session->userdata('IdClinica'));
                echo json_encode($NotasMedicas);
            }
            else
            {
                echo json_encode('0');
            }

        }

        public function ConsultarProductosNotaMedica_ajax()
        {
            $IdNotaMedica = $this->input->post('IdNotaMedica');

            if ($IdNotaMedica!== null)
            {
                $ProductosNotasMedica = $this->ProductosNotaMedica_Model->ConsultarProductosPorNotaMedica($IdNotaMedica);
                echo json_encode($ProductosNotasMedica);
            }
            else
            {
                echo json_encode('0');
            }
        }

        public function ConsultarTipoPago_ajax()
        {
            $TiposPago = $this->CatalogoTipoPago_Model->ConsultarTipoPago();

            $selected = false;

            $output='<option value="">Forma de Pago </option>';
            foreach($TiposPago as $tipoPago)
            {
              if ($selected == false)
              {
                $output .= '<option selected="selected" value="'.$tipoPago['IdTipoPago'].'">'.$tipoPago['DescripcionTipoPago'].'</option>';
                $selected = true;
              }
              else {

                $output .= '<option value="'.$tipoPago['IdTipoPago'].'">'.$tipoPago['DescripcionTipoPago'].'</option>';

              }
            }
            echo $output;




        }

        public function ConsultarNotaRemision_ajax()
        {
            $IdNotaRemision = $this->input->post('IdNotaRemision');

            if ($IdNotaRemision!==null)
            {
                $NotaRemision = $this->NotaRemision_Model->ConsultarNotaRemision($IdNotaRemision);

                echo json_encode($NotaRemision);
            }
            else
            {
                echo json_encode('0');
            }


        }

        public function ConsultarProductosNotaRemision_ajax()
        {
            $IdNotaRemision = $this->input->post('IdNotaRemision');

            if ($IdNotaRemision!==null)
            {
                $DetalleNotaRemision = $this->DetalleNotaRemision_Model->ConsultarDetalleNotaRemision($IdNotaRemision);

                echo json_encode($DetalleNotaRemision);
            }
            else
            {
                echo json_encode('0');
            }

        }

        public function ConsultarPagosNotaRemision_ajax()
        {
            $IdNotaRemision = $this->input->post('IdNotaRemision');

            if ($IdNotaRemision!==null)
            {
                $PagosNotaRemision = $this->PagoNotaRemision_Model->ConsultarPagosNotaRemision($IdNotaRemision);

                echo json_encode($PagosNotaRemision);
            }
            else
            {
                echo json_encode('0');
            }
        }

        public function ConsultarAdeudosPaciente_ajax()
        {
            $IdPaciente = $this->input->post('IdPaciente');

            if ($IdPaciente!== null)
            {
                $TotalAdeudosPaciente = $this->NotaRemision_Model->ConsultarTotalAdeudoPaciente($IdPaciente);

                echo json_encode($TotalAdeudosPaciente);
            }
            else
            {
                echo json_encode('0');
            }
        }

        public function ConsultarDetalleAdeudoPaciente_ajax()
        {
            $IdPaciente = $this->input->post('IdPaciente');

            if ($IdPaciente!== null)
            {
                $TotalAdeudosPaciente = $this->NotaRemision_Model->ConsultarDetalleAdeudoPaciente($IdPaciente);

                echo json_encode($TotalAdeudosPaciente);
            }
            else
            {
                echo json_encode('0');
            }

        }

        public function ConsultarNotaMedica_ajax()
        {
            $IdNotaMedica = $this->input->post('IdNotaMedica');

            $NotaMedica = $this->NotaMedica_Model->ConsultarNotaMedicaPorId($IdNotaMedica);

            echo json_encode($NotaMedica);
        }

        public function generarPDFNotaRemision($IdNotaRemision)
        {

            $data['IdNotaRemision'] = $IdNotaRemision;
            $NotaRemision = $this->NotaRemision_Model->ConsultarNotaRemision($IdNotaRemision);
            $data['NotaRemision'] =  $NotaRemision;
            $data['DetalleNotaRemision']= $this->DetalleNotaRemision_Model->ConsultarDetalleNotaRemision($IdNotaRemision);
            $data['PagosNotaRemision']= $this->PagoNotaRemision_Model->ConsultarPagosNotaRemision($IdNotaRemision);
            $this->load->model('Foliador_Model');
            $data['Foliador']  = $this->Foliador_Model->ConsultarFoliadorPorId($NotaRemision->IdFoliador);
            $this->load->model('Clinica_Model');
            $data['Clinica'] = $this->Clinica_Model->ConsultarClinicaPorId($this->session->userdata('IdClinica'));



            $this->load->view('NotaRemision/PDFNotaRemision',$data);
            //$NombreArchivoPDF = 'NotaRemision_'.$IdNotaRemision.'.pdf';

            //$this->createPDF($NombreArchivoPDF, $htmlContent);
        }

        public function CargarTemplateNotaRemision($IdNotaRemision)
        {
            $data['title'] = 'Nota de Remisión';
            $data['IdNotaRemision']= $IdNotaRemision;

            $this->load->view('templates/MainContainer',$data);
            $this->load->view('templates/HeaderContainer',$data);
            $this->load->view('NotaRemision/template_NotaRemision',$data);

            $this->load->view('templates/FormFooter',$data);
            $this->load->view('templates/FooterContainer');
        }

        // create pdf file
        public function createPDF($fileName,$html) {

           require_once FCPATH.'vendor/autoload.php';


           $mpdf = new \Mpdf\Mpdf();


            $mpdf->WriteHTML($html);
            $mpdf->Output($fileName,"I");


        }

        public function Load_ConsultaNotasRemision()
        {
            $data['title'] = 'Registrar Nueva Nota de Remisión';

            $this->load->view('templates/MainContainer',$data);
            $this->load->view('templates/HeaderContainer',$data);
            $this->load->view('NotaRemision/CardConsultaNotasRemision',$data);
            $this->load->view('templates/FooterContainer');

        }

        public function Load_BuscarNotas()
        {
            $data['title'] = 'Buscar Notas de Remisión';

            $this->load->view('templates/MainContainer',$data);
            $this->load->view('templates/HeaderContainer',$data);
            $this->load->view('NotaRemision/CardConsultaNotasRemisionRecepcion',$data);
            $this->load->view('templates/FooterContainer');

        }

        public function Load_ConsultarNotasRemisionTemp()
        {
            $data['title'] = 'Consultar Notas De Remisión';

            $this->load->view('templates/MainContainer',$data);
            $this->load->view('templates/HeaderContainer',$data);
            $this->load->view('NotaRemision/CardConsultarNotasDeRemision',$data);
            $this->load->view('templates/FooterContainer');

        }

        public function ConsultarNotasRemisionTemp()
        {
          $CatalogoNotas = $this->NotaRemisionTemp_Model->ConsultarNotasRemisionTemp();

          echo json_encode($CatalogoNotas);
          // code...
        }

        public function ConsultarNotasDeRemision()
        {
            $FechaInicio = $this->input->post('FechaInicio');
            $FechaFin = $this->input->post('FechaFin');
            $IdClinica = $this->session->userdata('IdClinica');
            $IdEstatusNotas = $this->input->post('EstatusNota');

            if ($IdEstatusNotas !== null)
            {
                $NotasRemision = $this->NotaRemision_Model->ConsultarNotasRemision($FechaInicio, $FechaFin, $IdClinica, $IdEstatusNotas);
            }
            else
            {
                $NotasRemision = $this->NotaRemision_Model->ConsultarNotasRemision($FechaInicio, $FechaFin, $IdClinica);
            }


            echo json_encode($NotasRemision);
        }

        public function BuscarNotasRemision()
        {

          $CondicionesBusqueda = $this->input->post('CondicionesBusqueda');
          $NotasRemision = $this->NotaRemision_Model->BuscarNotasRemision($CondicionesBusqueda);

          echo json_encode($NotasRemision);
        }

        public function AgregarPaciente_ajax()
        {
          $Nombre = $this->input->post('NombrePaciente');
          $Apellidos = $this->input->post('ApellidosPaciente');
          $Telefono = $this->input->post('TelefonoPaciente');
          $FechaNacimiento = $this->input->post('FechaNacimientoPaciente');
          $RFC = $this->input->post('RFCPaciente');
          $email = $this->input->post('emailPaciente');
          $DondeVive = $this->input->post('DondeVivePaciente');
          $Calle=$this->input->post('callePaciente');
          $Colonia = $this->input->post('Colonia');
          $CP = $this->input->post('CP');
          $Sexo = $this->input->post('Sexo');

          $DatosPaciente = array(
            'Nombre'=>$Nombre,
            'Apellidos'=>$Apellidos,
            'NumCelular'=> $Telefono,
            'FechaNacimiento'=>$FechaNacimiento,
            'RFC'=>$RFC,
            'email'=>$email,
            'DondeVive'=> $DondeVive,
            'Sexo'=>$Sexo,
            'Colonia'=>$Colonia,
            'Calle'=>$Calle,
            'CP'=>$CP
          );
          $result = $this->Paciente_Model->AgregarPaciente($DatosPaciente);


          if ($result !== FALSE) {

            $paciente = $this->Paciente_Model->ConsultarPacientePorId($result);

            echo json_encode($paciente);
          }
          else
          {
            echo json_encode(FALSE);
          }

        }

        public function Load_RegistrarVentaFarmacia()
        {
          $data['title'] = 'Registrar Venta Farmacia';

          $this->load->view('templates/MainContainer',$data);
          $this->load->view('templates/HeaderContainer',$data);
          $this->load->view('NotaRemision/CardPuntoVenta_Farmacia',$data);
          $this->load->view('templates/FooterContainer');
          // code...
        }

        public function ConsultarFoliadorSubProducto_ajax()
        {

          $IdServicio = $this->input->post('IdServicio');
          log_message('debug','FOLIADOR IdServicio='.$IdServicio);
          $this->load->model('Foliador_Model');
          $IdFoliador = $this->Foliador_Model->BuscarFoliadorServicio($this->session->userdata('IdClinica'),$IdServicio);

          echo json_encode($IdFoliador);
          // code...
        }

        public function CancelarNotaRemision_ajax()
        {
          $IdNotaRemision = $this->input->post('IdNotaRemision');
          $ComentariosCancelacion = $this->input->post('ComentariosCancelacion');

          $this->db->trans_start();

          $this->NotaRemision_Model->CancelarNotaRemision($IdNotaRemision,$ComentariosCancelacion);
          $this->MovimientoCuenta_Model->CancelarMovimientosCuentaNotaRemision($IdNotaRemision);

          $transStatus = $this->db->trans_complete();

          if ($transStatus == true)
          {
              $this->db->trans_commit();
          }
          else
          {
              $this->db->trans_rollback();
          }

          // code...
        }

        public function AgregarPagoNotaRemision_ajax()
        {

          $IdNotaRemision = $this->input->post('IdNotaRemision');
          $NotaRemision = $this->NotaRemision_Model->ConsultarNotaRemision($IdNotaRemision);
          $TotalPago = $this->input->post('TotalPago');
          $IdFormaPago = $this->input->post('FormaPago');
          $Vaucher = $this->input->post('Vaucher');


          $this->db->trans_start();


          $PorcentajePagado = $TotalPago/ $NotaRemision->TotalNotaRemision;

          $TotalPagado = $NotaRemision->TotalPagado + $TotalPago;
          $TotalAdeudo = $NotaRemision->TotalNotaRemision - $TotalPagado;


          if ($TotalAdeudo > 0)
          {
              $EstatusNota = NR_PAGO_PARCIAL;
          }
          else
          {
              $EstatusNota = NR_PAGADO;
          }

          $PagoNotaRemision = array(
              'IdNotaRemision'=> $IdNotaRemision,
              'FechaPago'=> mdate('%Y-%m-%d',now()),
              'IdEmpleado'=> $this->session->userdata('IdEmpleado'),
              'PorcentajeNotaRemision'=>$PorcentajePagado,
              'TotalPago'=>$TotalPago,
              'IdTipoPago'=>$IdFormaPago,
              'Vaucher'=> $Vaucher
          );

          $IdNuevoPagoNotaRemision = $this->PagoNotaRemision_Model->RegistrarPagoNotaRemision($PagoNotaRemision);

          if($IdNuevoPagoNotaRemision ===FALSE)
          {
               throw new Exception('Error al registrar pago');
          }

          //REGISTRAR MOVIMIENTOS A LAS CUENTAS
          $MovimientosACuenta = $this->NotaRemision_Model->ConsultarMovimientosCuentaNota($IdNotaRemision);

          foreach ($MovimientosACuenta as $movimiento)
          {
              $TotalMovimientoCuenta = $PorcentajePagado * $movimiento['TotalCuenta'];
              $NuevoMovimientoCuenta = array(
                  'IdCuenta'=> $movimiento['IdCuenta'],
                  'FechaMovimientoCuenta'=> mdate('%Y-%m-%d',now()),
                  'IdPagoNotaRemision'=>$IdNuevoPagoNotaRemision->IdPagoNotaRemision,
                  'IdTipoMovimientoCuenta'=> 1,
                  'TotalMovimiento' => $TotalMovimientoCuenta,
                  'IdEstatusMovimientoCuenta'=> MC_PENDIENTEPAGO,
                  'IdTipoPago'=>$IdFormaPago,
                  'IdClinica'=>$this->session->userdata('IdClinica')

              );

              $this->MovimientoCuenta_Model->RegistrarNuevoMovimientoCuenta($NuevoMovimientoCuenta);
          }



          $ActualizarNotaArray = array(
              'IdEstatusNotaRemision'=>$EstatusNota,
              'TotalPagado' => $TotalPagado
          );
          $this->NotaRemision_Model->ActualizarNotaRemision($IdNotaRemision,$ActualizarNotaArray);


        $transStatus = $this->db->trans_complete();

        if ($transStatus == true)
        {
            $this->db->trans_commit();
        }
        else
        {
            $this->db->trans_rollback();
        }

    }

    //NOTA REMISION temporal

    public function GuardarNotaRemisionTemporal()
    {
      try {

        log_message('DEBUG','GuardarNotaRemisionTemp.INI');

        $this->load->model('NotaRemisionTemp_Model');



        $NotaRemisionTemp = array(
          'IdPaciente'=> $this->input->post('idPaciente'),
          'IdFoliador' => $this->input->post('IdFoliador'),
          'IdClinica' => $this->session->userdata('IdClinica'),
          'FechaNotaRemision_Temp' => mdate('%Y-%m-%d',now())

        );

        $IdProductos = $this->input->post('IdProductos');

        $cantidadProductos = $this->input->post('cantidad');
        $precioProductos = $this->input->post('precio');
        $CodigoSubProducto = $this->input->post('CodigoSubProducto');
        $Lote = $this->input->post('Lote');
        $DescuentoProductos = $this->input->post('descuento');

        $this->db->trans_start();

        $transStatus = false;

        $IdNotaRemisionTemp = $this->NotaRemisionTemp_Model->GuardarNotaRemisionTemp($NotaRemisionTemp);

        //CARGAR DETALLE NOTA REMISION
         $IdProductos = $this->input->post('IdProductos');

         $cantidadProductos = $this->input->post('cantidad');

         $CodigoSubProducto = $this->input->post('CodigoSubProducto');

         $DescuentoProductos = $this->input->post('descuento');

         //log_message('debug','GuardarNotaRemisionTemporal.IdProducto='.$IdProductos);

         //$IdEmpleado = $this->input->post('IdEmpleado');
         if (isset($IdProductos))
             {

               $this->load->model('DetalleNotaRemisionTemp_Model');

                for ($i=0;$i<sizeof($IdProductos); $i++)
                {

                    if (isset($CodigoSubProducto)&& is_array($CodigoSubProducto))
                    {
                        $strCodigoSubProducto =$CodigoSubProducto[$i] ;
                    }
                    else
                    {

                        $strCodigoSubProducto = null;
                    }

                    $DetalleNotaRemision = array(
                        'IdNotaRemision_Temp'=>$IdNotaRemisionTemp,
                        'IdProducto'=>$IdProductos[$i],
                        'Cantidad'=>$cantidadProductos[$i],
                        'Descuento'=>$DescuentoProductos[$i],
                        'IdCodigoSubProducto'=>$strCodigoSubProducto,
                    );

                     $this->DetalleNotaRemisionTemp_Model->GuardarDetalleNotaRemisionTemp($DetalleNotaRemision);
                }
              }

        $transStatus = true;

        $data['title'] = 'Nota de Remisión';


        if ($transStatus == true)
        {
            $this->db->trans_commit();

            $data['swal']=true;
            $data['swalMessage']="title:'Nota guardada',
            text: 'La Nota ha sido guardada exitosamente',
            type: 'success',
            showConfirmButton: true";

            $data['swalAction'] = ".then((result)=> {
              if (result.value) {
                window.location.href ='".site_url("NotaRemision/CrearNota")."';
              }
            });";
        }
        else
        {
            $this->db->trans_rollback();

            $data['swal']=true;
            $data['swalMessage']="title:'Error',
            text: 'Hubo un error al guardar la nota',
            type: 'error',
            showConfirmButton: true";

            $data['swalAction'] = ".then((result)=> {
              if (result.value) {
                window.location.href ='".site_url("NotaRemision/CrearNota")."';
              }
            });";
        }


        $this->load->view('templates/MainContainer',$data);
        $this->load->view('templates/HeaderContainer',$data);
        $this->load->view('templates/FormFooter',$data);
        $this->load->view('templates/FooterContainer');

      } catch (\Exception $e) {

        $this->db->trans_rollback();
        message_log('ERROR','NotaRemision_Controller.GuardarNotaRemisionTemporal_ajax.error = '.$e->getMessage());
        throw new \Exception("Error al guardar nueva nota remision temporal", 1);
      }

    }

    public function ActualizarNotaRemisionTemp()
    {
      try {

        log_message('DEBUG','ActualizarNotaRemisionTemp.INI');




        $IdProductos = $this->input->post('IdProductos');

        $cantidadProductos = $this->input->post('cantidad');
        $precioProductos = $this->input->post('precio');
        $CodigoSubProducto = $this->input->post('CodigoSubProducto');
        $Lote = $this->input->post('Lote');
        $DescuentoProductos = $this->input->post('descuento');

        $this->db->trans_start();

        $transStatus = false;

        $IdNotaRemisionTemp = $this->input->post('IdNotaRemisionTemp');
        $this->load->model('DetalleNotaRemisionTemp_Model');

        $this->DetalleNotaRemisionTemp_Model->BorrarDetalleNotaRemisionTemp($IdNotaRemisionTemp);

        //CARGAR DETALLE NOTA REMISION
         $IdProductos = $this->input->post('IdProductos');

         $cantidadProductos = $this->input->post('cantidad');

         $CodigoSubProducto = $this->input->post('CodigoSubProducto');

         $DescuentoProductos = $this->input->post('descuento');

         //log_message('debug','GuardarNotaRemisionTemporal.IdProducto='.$IdProductos);

         //$IdEmpleado = $this->input->post('IdEmpleado');
         if (isset($IdProductos))
             {



                for ($i=0;$i<sizeof($IdProductos); $i++)
                {

                    if (isset($CodigoSubProducto)&& is_array($CodigoSubProducto))
                    {
                        $strCodigoSubProducto =$CodigoSubProducto[$i] ;
                    }
                    else
                    {

                        $strCodigoSubProducto = null;
                    }

                    $DetalleNotaRemision = array(
                        'IdNotaRemision_Temp'=>$IdNotaRemisionTemp,
                        'IdProducto'=>$IdProductos[$i],
                        'Cantidad'=>$cantidadProductos[$i],
                        'Descuento'=>$DescuentoProductos[$i],
                        'IdCodigoSubProducto'=>$strCodigoSubProducto,
                    );

                     $this->DetalleNotaRemisionTemp_Model->GuardarDetalleNotaRemisionTemp($DetalleNotaRemision);
                }
              }

        $transStatus = true;

        $data['title'] = 'Nota de Remisión';


        if ($transStatus == true)
        {
            $this->db->trans_commit();

            $data['swal']=true;
            $data['swalMessage']="title:'Nota guardada',
            text: 'La Nota ha sido guardada exitosamente',
            type: 'success',
            showConfirmButton: true";

            $data['swalAction'] = ".then((result)=> {
              if (result.value) {
                window.location.href ='".site_url("NotaRemision/CrearNota")."';
              }
            });";
        }
        else
        {
            $this->db->trans_rollback();

            $data['swal']=true;
            $data['swalMessage']="title:'Error',
            text: 'Hubo un error al guardar la nota',
            type: 'error',
            showConfirmButton: true";

            $data['swalAction'] = ".then((result)=> {
              if (result.value) {
                window.location.href ='".site_url("NotaRemision/CrearNota")."';
              }
            });";
        }


        $this->load->view('templates/MainContainer',$data);
        $this->load->view('templates/HeaderContainer',$data);
        $this->load->view('templates/FormFooter',$data);
        $this->load->view('templates/FooterContainer');

      } catch (\Exception $e) {

        $this->db->trans_rollback();
        message_log('ERROR','NotaRemision_Controller.GuardarNotaRemisionTemporal_ajax.error = '.$e->getMessage());
        throw new \Exception("Error al guardar nueva nota remision temporal", 1);
      }

    }

    public function Load_AbrirNotaRemisionTemporal($IdNotaRemisionTemp)
    {
        $data['title'] = 'Registrar Nueva Nota de Remisión';

        //CARGAR NOTA REMISION temporal

        $data['NotaTemporal'] = 1;

        $this->load->model('NotaRemisionTemp_Model');
        $this->load->model('DetalleNotaRemisionTemp_Model');

        $NotaRemisionTemporal = $this->NotaRemisionTemp_Model->ConsultarNotaTemporalPorId($IdNotaRemisionTemp);
        $DetalleNotaRemisionTemporal = $this->DetalleNotaRemisionTemp_Model->ConsultarDetalleNotaRemisionTemp($IdNotaRemisionTemp);
        $data['IdNotaRemisionTemp']= $IdNotaRemisionTemp;

        $data['NotaRemisionTemp'] = $NotaRemisionTemporal;
        $data['DetalleNotaRemisionTemp'] = $DetalleNotaRemisionTemporal;

        $this->load->view('templates/MainContainer',$data);
        $this->load->view('templates/HeaderContainer',$data);

        if ($NotaRemisionTemporal->IdFoliador == 1)
        {
          $this->load->view('NotaRemision/CardPuntoVenta',$data);
        }

        if ($NotaRemisionTemporal->IdFoliador == 2)
        {
          $this->load->view('NotaRemision/CardPuntoVenta_Farmacia',$data);
        }



//
        $this->load->view('templates/FooterContainer');
    }

    public function BorrarNotaRemisionTemp($IdNotaRemisionTemp)
    {

      $this->load->model('NotaRemisionTemp_Model');
      $this->load->model('DetalleNotaRemisionTemp_Model');

      $this->DetalleNotaRemisionTemp_Model->EliminarDetalleNotaRemisionTemp($IdNotaRemisionTemp);

      $this->NotaRemisionTemp_Model->EliminarNotaRemisionTemp($IdNotaRemisionTemp);
      // code...
    }
}
