<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SalidaCaja_Controller
 *
 * @author SigueMED
 */
class SalidaCaja_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();

         $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('url_helper');
        $this->load->helper('date');

        $this->load->model('Cuenta_Model');
        $this->load->model('MovimientoCuenta_Model');
        $this->load->model('Salida_Model');


    }

    public function Load_PagarServicioMedico()
    {
        $data['title'] = 'Pagar Servicios Medicos';

        $this->load->view('templates/MainContainer',$data);
        $this->load->view('templates/HeaderContainer',$data);
        $this->load->view('SalidaCaja/FormPagarServiciosMedicos');
        $this->load->view('SalidaCaja/CardSalidaServicioMedico',$data);

        $this->load->view('templates/FormFooter',$data);
        $this->load->view('templates/FooterContainer');

    }

    public function PagarServicioMedico()
    {
        $action = $this->input->post('action');
        $TotalSalida = $this->input->post('TotalSalida');

        if ($action =="RegistrarSalida" && (floatval($TotalSalida)>0 || $TotalSalida !==""))
        {
            try
            {
                $this->db->trans_start();

                $IdEmpleado = $this->session->userdata('IdEmpleado');
                $IdTurno = $this->session->userdata('IdTurno');
                $FechaSalida = now();
                $TotalSalida = $this->input->post('TotalSalida');
                $IdCuenta = $this->input->post('cbCuentaSalida');
                $IdClinica = $this->session->userdata('IdClinica');
                $Comentarios = $this->input->post('ComentariosSalida');

                $SalidaArray = array(
                    'IdEmpleado'=>$IdEmpleado,
                    'IdTurno'=> $IdTurno,
                    'FechaSalida'=>mdate('%Y-%m-%d',$FechaSalida),
                    'TotalSalida' => $TotalSalida,
                    'IdCuenta'=>$IdCuenta,
                    'Comentarios'=> $Comentarios,
                    'IdClinica'=>$IdClinica
                );

                $IdNuevaSalida = $this->Salida_Model->RegistrarSalidaCaja($SalidaArray);

                if($IdNuevaSalida != null)
                {
                    $this->MovimientoCuenta_Model->RegistrarSalidaMovimientos($IdCuenta,$IdNuevaSalida->IdUltimaSalida, TIPOPAGO_EFECTIVO,$IdClinica);

                    $MovimientoSalida = array(
                        'FechaMovimientoCuenta' => mdate('%y-%m-%d',now()),
                        'IdCuenta'=> $IdCuenta,
                        'IdTipoMovimientoCuenta'=>2,
                        'TotalMovimiento'=>$TotalSalida,
                        'IdEstatusMovimientoCuenta'=>MC_PAGADO,
                        'IdSalidaCaja'=> $IdNuevaSalida->IdUltimaSalida,
                        'IdTipoPago'=>TIPOPAGO_EFECTIVO,
                        'IdClinica'=> $this->session->userdata('IdClinica')
                        );

                    $this->MovimientoCuenta_Model->RegistrarNuevoMovimientoCuenta($MovimientoSalida);

                    $transStatus = $this->db->trans_complete();

                    if ($transStatus == true)
                    {
                        $this->db->trans_commit();
                    }
                    else
                    {
                        $this->db->trans_rollback();
                    }

                    echo '<script> alert("Nueva Salida Registrada");</script>';
                    $data['URL']= '/SalidaCaja/CargarPDFSalida/'.$IdNuevaSalida->IdUltimaSalida;

                    $data['title'] = 'Recibo Pago Servicios Medicos';
                    $data['Mensaje']='El recibo de la salida se ha generado, para abrirlo haz click en el boton';

                    $this->load->view('templates/MainContainer',$data);
                    $this->load->view('templates/HeaderContainer',$data);
                    $this->load->view('templates/NewWindow',$data);
                    $this->load->view('templates/FooterContainer');

                }
                else
                {

                    throw new Exception('Error al registrar Salida');
                }

            } catch (Exception $ex) {
                log_message('error', $ex->getMessage());
                $this->db->trans_rollback();

            }




        }

        else
        {
            echo "<script>alert('Debe de seleccionar una cuenta o tener movimientos en la cuenta, favor de verificar');</script>";
            $this->Load_PagarServicioMedico();
        }
    }

    public function CargarPDFSalida($IdSalida)
    {

        $Salida = $this->Salida_Model->ConsultarSalidaPorId($IdSalida);
        $data['SalidaCaja'] = $Salida;
        $data['MovimientosSalida'] = $this->MovimientoCuenta_Model->ConsultarDetalleSalida($IdSalida);
        $TotalTransferencias= $this->MovimientoCuenta_Model->ConsultarTotalMovimientosCuenta($Salida->IdCuenta, MC_PENDIENTEPAGO, TIPOPAGO_TRANSFERENCIA);
        if ($TotalTransferencias != null)
        {
            $data['TotalTransferencias'] = $TotalTransferencias;
        }
        else
        {
            $data['TotalTransferencias'] ="0.00";
        }

        $TotalTarjetaCredito = $this->MovimientoCuenta_Model->ConsultarTotalMovimientosCuenta($Salida->IdCuenta, MC_PENDIENTEPAGO, TIPOPAGO_TARJETACREDITO);

        if ($TotalTarjetaCredito != null)
        {
            $data['TotalTarjetaCredito'] = $TotalTarjetaCredito;
        }
        else
        {
            $data['TotalTarjetaCredito'] ="0.00";
        }
        //$this->load->view('SalidaCaja/PDFSalidaCaja',$data);
        $htmlContent = $this->load->view('SalidaCaja/PDFSalidaCaja',$data,TRUE);
        $NombreArchivoPDF = 'NotaSalida'.$IdSalida.'.pdf';

        $this->createPDF($NombreArchivoPDF, $htmlContent);



    }

     public function createPDF($fileName,$html) {

           require_once FCPATH.'vendor\autoload.php';


           $mpdf = new \Mpdf\Mpdf();


            $mpdf->WriteHTML($html);
            $mpdf->Output($fileName,"I");


        }

    public function ConsultarCuentas()
    {
        $Cuentas = $this->Cuenta_Model->ConsultarCuentas(1);

        $output = "<option value=''>Selecciona una cuenta</option>";
        foreach($Cuentas as $cuenta)
        {
            $output.='<option value="'.$cuenta['IdCuenta'].'">'.$cuenta['DescripcionCuenta'].'</option>';

        }

        echo $output;
    }

    public function ConsultarCuentaPorId_ajax()
    {
        $IdCuenta = $this->input->post('IdCuenta');

        if ($IdCuenta !="")
        {
            $cuenta = $this->Cuenta_Model->ConsultarCuentaPorId($IdCuenta);
            echo json_encode($cuenta);
        }
    }

    public function ConsultarDetalleMovimientosCuenta_ajax()
    {
        $IdCuenta = $this->input->post('IdCuenta');

        if($IdCuenta != "")
        {
            $MovimientosCuenta = $this->MovimientoCuenta_Model->ConsultarDetalleMovimientosCuenta($IdCuenta, MC_PENDIENTEPAGO);
            echo json_encode($MovimientosCuenta);
        }

    }

    public function ConsultarTotalMovimientosCuenta_ajax()
    {
        $IdCuenta = $this->input->post('IdCuenta');
        $IdTipoPago = $this->input->post('TipoPago');

        if($IdCuenta != "")
        {
            $TotalMovimientosCuenta = $this->MovimientoCuenta_Model->ConsultarTotalMovimientosCuenta($IdCuenta, MC_PENDIENTEPAGO, $IdTipoPago);


            echo json_encode($TotalMovimientosCuenta);
        }

    }
    //put your code here
}
