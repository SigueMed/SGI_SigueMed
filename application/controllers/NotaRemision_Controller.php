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
        
    }
        public function index(){
                $this->load->view('templates/headerMenu');
		
	}
        
        public function Load_RegistrarNotaRemision()
        {
            $data['title'] = 'Registrar Nueva Nota de Remisión';
            $data['VentaInventario']=0;
            
            
            $data['ProductosNotaActionsEnabled']= false;
            $data['Servicios'] = $this->Servicio_Model->ConsultarServicios();
            
            $data['ResumenNotaRemisionActionsEnabled'] = true;
            $data['ResumenNotaRemisionSubmitTitle'] = "Crear Nota";
            $data['ResumenNotaRemisionSubmitAction'] = "crear";
   
            $this->load->view('templates/MainContainer',$data);
            $this->load->view('templates/HeaderContainer',$data);
            $this->load->view('NotaRemision/FormCrearNotaRemision');
            $this->load->view('NotaRemision/CardNotaRemision',$data);
            
            $this->load->view('NotaMedica/CardProductosNotaMedica',$data);
            $this->load->view('NotaMedica/CardSeguimiento',$data);
            $this->load->view('NotaRemision/CardResumenNotaRemision',$data);
            $this->load->view('templates/FormFooter',$data); 
            $this->load->view('templates/FooterContainer');
        }
        
         public function Load_RegistrarNotaRemisionInventario()
        {
            $data['title'] = 'Registrar Venta Inventario';
            
            
            $data['ProductosNotaActionsEnabled']= false;
            $data['Servicios'] = $this->Servicio_Model->ConsultarServicios();
            $data['VentaInventario']=TRUE;
            
            $data['ResumenNotaRemisionActionsEnabled'] = true;
            $data['ResumenNotaRemisionSubmitTitle'] = "Crear Nota";
            $data['ResumenNotaRemisionSubmitAction'] = "crear";
   
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
                    $TotalNota = $this->input->post('resumenTotalNota');
                    $TotalPagadoNota = $this->input->post('resumenTotalPago');
                    
                    
                   
                    if ($this->input->post('RequiereFactura')==1)
                    {
                        $RequiereFactura = TRUE;
                    }
                    else
                    {
                        $RequiereFactura = FALSE;
                    }
                    
                    
                    $TotalPagado = $this->PagarAdeudosAnteriores($IdPaciente,$TotalPagadoNota);
                    
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
                    
                    
                    //CREAR NOTA DE REMISION
                    $NotaRemision = array(
                        'IdPaciente'=> $IdPaciente,
                        'FechaNotaRemision'=> mdate('%Y-%m-%d',$FechaNotaRemision),
                        'IdEmpleado' =>$IdEmpleado,
                        'IdTurno'=> $IdTurno,
                        'TotalNotaRemision'=>$TotalNota,
                        'TotalPagado'=> $TotalPagado,
                        'IdEstatusNotaRemision'=>$EstatusNotaRemision,
                        'RequiereFactura'=>$RequiereFactura,
                        'IdClinica'=>$this->session->userdata('IdClinica')
                    );
                    
                    $IdNuevaNotaRemision = $this->NotaRemision_Model->CrearNotaDeRemision($NotaRemision);
                    
                    
                    if($IdNuevaNotaRemision !=null)
                    {
                        
                       //CARGAR DETALLE NOTA REMISION
                        $IdProductos = $this->input->post('IdProducto');
                        
                        $cantidadProductos = $this->input->post('cantidad');
                        $precioProductos = $this->input->post('precio');
                        $CodigoSubProducto = $this->input->post('CodigoSubProducto');
                        $Lote = $this->input->post('Lote');
                        $DescuentoProductos = $this->input->post('descuento');
                        $SubTotal = $this->input->post('subtotal');
                        $IdEmpleado = $this->input->post('IdEmpleado');
                        
                       

                        if (isset($IdProductos))
                        {
                           
                           for ($i=0;$i<sizeof($IdProductos); $i++)
                           {
                               
                               if ($CodigoSubProducto[$i] !== "")
                               {
                                   $strCodigoSubProducto =$CodigoSubProducto[$i] ;
                               }
                               else
                               {
                                   
                                   $strCodigoSubProducto = null; 
                               }
                               if($Lote[$i]!== "")
                               {
                                   $strLote = $Lote[$i];
                               }
                               else
                               {
                                   $strLote = null;
                               }
 
                               $DetalleNotaRemision = array(
                                   'IdNotaRemision'=>$IdNuevaNotaRemision->IdUltimaNotaRemision,
                                   'IdProducto'=>$IdProductos[$i],
                                   'Cantidad'=>$cantidadProductos[$i],
                                   'CostoUnitario'=> $precioProductos[$i],
                                   'Descuento'=>$DescuentoProductos[$i],
                                   'IdCodigoSubProducto'=>$strCodigoSubProducto,
                                   'Lote'=>$strLote,
                                   'SubTotalDetalle'=>$SubTotal[$i]
                                   
                                   
                               );

                                $this->DetalleNotaRemision_Model->AgregarDetalleNotaRemision($DetalleNotaRemision);
                                
                                                                
                                //REGISTRAR SALIDA DE INVENTARIO
                                
                                if ($strCodigoSubProducto!== null)
                                {
                                    $this->MovimientoInventario_Model->RegistrarSalidaInventario($CodigoSubProducto[$i],$Lote[$i],$cantidadProductos[$i],$this->session->userdata('IdClinica'));
                                      
                                }
                                
                           }

                        }
                        
                        
                        
                        if($TotalPagado>0)
                        {
                            //REGISTRAR PAGO NOTA MEDICA
                            $PorcentajePagado = $TotalPagado/ $TotalNota;

                            $PagoNotaRemision = array(
                                'IdNotaRemision'=> $IdNuevaNotaRemision->IdUltimaNotaRemision,
                                'FechaPago'=> mdate('%Y-%m-%d',$FechaNotaRemision),
                                'IdEmpleado'=> $this->session->userdata('IdEmpleado'),
                                'PorcentajeNotaRemision'=>$PorcentajePagado,
                                'TotalPago'=>$TotalPagado,
                                'IdTipoPago'=>$this->input->post('cb_FormaPago')
                            );

                            $IdNuevoPagoNotaRemision = $this->PagoNotaRemision_Model->RegistrarPagoNotaRemision($PagoNotaRemision);

                           if($IdNuevoPagoNotaRemision ===FALSE)
                           {
                                throw new Exception('Error al registrar pago');
                           }
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
                                    'IdTipoPago'=>$this->input->post('cb_FormaPago'),
                                    'IdClinica'=>$this->session->userdata('IdClinica')

                                );

                                $this->MovimientoCuenta_Model->RegistrarNuevoMovimientoCuenta($NuevoMovimientoCuenta);
                            }
                            
                        }
           
                        
                        
                        
                        
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
            
            
            
                        redirect (site_url().'/NotaRemision/CargarNotaRemision/'.$IdNuevaNotaRemision->IdUltimaNotaRemision);
                        
                                             
                        
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
            
        }
        
        public function PagarAdeudosAnteriores($IdPaciente, $TotalPagado)
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
                if ($TotalPagado > $TotalAdeudo)
                {

                    $TotalPagoAdeudo = $TotalAdeudo;
                    $EstatusAdeudo = NR_PAGADO;

                    $TotalPagado = $TotalPagado - $TotalAdeudo;
                }
                else
                {

                    $TotalPagoAdeudo = $TotalAdeudo - $TotalPagado;
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
                    'IdTipoPago'=>$this->input->post('cb_FormaPago')
                );
                $IdNuevoPagoNotaRemision = $this->PagoNotaRemision_Model->RegistrarPagoNotaRemision($PagoAdeudo);

                $TotalPagadoNota = $adeudo['TotalPagado'] + $TotalAdeudo;


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
                        'IdPagoNotaRemision'=>$adeudo['IdNotaRemision'],
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
            
            $output='<option value="">Forma de Pago </option>';
            foreach($TiposPago as $tipoPago)
            {
                $output .= '<option value="'.$tipoPago['IdTipoPago'].'">'.$tipoPago['DescripcionTipoPago'].'</option>';
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
        
        public function generarPDFNotaRemision($IdNotaRemision)
        {
            
            $data['IdNotaRemision'] = $IdNotaRemision;
            $data['NotaRemision'] = $this->NotaRemision_Model->ConsultarNotaRemision($IdNotaRemision);
            $data['DetalleNotaRemision']= $this->DetalleNotaRemision_Model->ConsultarDetalleNotaRemision($IdNotaRemision);
            $data['PagosNotaRemision']= $this->PagoNotaRemision_Model->ConsultarPagosNotaRemision($IdNotaRemision);
            

            $htmlContent = $this->load->view('NotaRemision/PDFNotaRemision',$data,TRUE);
            $NombreArchivoPDF = 'NotaRemision_'.$IdNotaRemision.'.pdf';
            
            $this->createPDF($NombreArchivoPDF, $htmlContent);
            
            
            
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
        
        
}