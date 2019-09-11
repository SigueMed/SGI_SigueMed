<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CorteCaja_Controller
 *
 * @author SigueMED
 */
class CorteCaja_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper('form');

        $this->load->helper('url_helper');
        $this->load->helper('date');

        $this->load->model('MovimientoCuenta_Model');
        $this->load->model('CatalogoProductos_Model');
        $this->load->model('CorteCaja_Model');
        $this->load->model('NotaRemision_Model');


    }

    
    public function Load_IniciarCorteCaja()
    {

      $data['title'] = 'Capturar Monto en Caja';

      $this->load->view('templates/MainContainer',$data);
      $this->load->view('templates/HeaderContainer',$data);
      $this->load->view('CorteCaja/CardInicioCorteCaja');

      $this->load->view('templates/FooterContainer');

      // code...
    }

    public function IniciarCorteCaja()
    {

      $data['title'] = 'Relizar Corte Caja';

      $this->load->view('templates/MainContainer',$data);
      $this->load->view('templates/HeaderContainer',$data);
      $this->load->view('CorteCaja/FormCorteCaja');
      $this->load->view('CorteCaja/CardResumenCorteCaja');
      $this->load->view('CorteCaja/CardCorteCaja');


      $this->load->view('templates/FormFooter',$data);
      $this->load->view('templates/FooterContainer');
      // code...
    }

    public function ConsultarResumenMovimientosCuenta()
    {

        $MovimientosCuenta = $this->MovimientoCuenta_Model->ConsultarResumenMovimientosCuentaSinCorte();

        echo  json_encode($MovimientosCuenta);
    }


    public function ConsultarResumenEntradas()
    {
        $IdTurno = $this->session->userdata('IdTurno');

        $IdTipoMovimientoCuenta = TMC_DEPOSITO;
        $IdClinica = $this->session->userdata('IdClinica');

        $ResumenEntradas = $this->MovimientoCuenta_Model->ConsultarResumentMovimientosCuentaPorTipoPago($IdTipoMovimientoCuenta,$IdClinica);

        echo json_encode($ResumenEntradas);
    }

    public function ConsultarBalanceCortePorTipoPago()
    {
        $IdTipoPago = $this->input->post('IdTipoPago');

        $TotalBalanceEfectivo = $this->MovimientoCuenta_Model->ConsultarBalanceCorte($IdTipoPago);

        echo json_encode($TotalBalanceEfectivo);
    }

    public function ConsultarBalanceCorteCuentas()
    {

        $IdClinica = $this->session->userdata('IdClinica');
        $BalanceCuentasCorte = $this->MovimientoCuenta_Model->ConsultarBalanceCuentaCorte($IdClinica);

        echo json_encode($BalanceCuentasCorte);


    }

    public function ConsultarResumenProducto_ajax()
    {
        $ResumenProductos = $this->CatalogoProductos_Model->ConsultarResumenProductosServicio();

        echo json_encode($ResumenProductos);

    }

    public function CerrarCaja()
    {
        $action = $this->input->post('action');
        $TotalEntradas = $this->input->post('TotalEntradas');
        $TotalSalidas = $this->input->post('TotalSalidas');
        $TotalCorte = $this->input->post('BalanceCorte');
        $TotalEfectivo = $this->input->post('TotalCorteEfectivo');
        $TotalTC = $this->input->post('TotalTarjetaCredito');
        $TotalTransferencias =$this->input->post('TotalTransferencias');
        $TotalVales = $this->input->post('TotalTransferencias');
        $Comentarios = $this->input->post('ComentariosCorte');


        if ($action =='RegistrarSalida')
        {
            try
            {
//--------------------------------INICIAR TRANSACCIÓN
                $this->db->trans_start();
                $dataCorteCaja = array(
                    "FechaCorte"=> mdate('%Y-%m-%d',now()),
                    "IdEmpleado"=> $this->session->userdata('IdEmpleado'),
                    "IdTurno"=>$this->session->userdata('IdTurno'),
                    "TotalEntradas"=>$TotalEntradas,
                    "TotalSalidas"=>$TotalSalidas,
                    "TotalCorte"=>$TotalCorte,
                    "TotalEnEfectivo"=>$TotalEfectivo,
                    "TotalEnTC"=>$TotalTC,
                    "TotalTransferencias"=>$TotalTransferencias,
                    "TotalVales"=>$TotalVales,
                    "Comentarios"=>$Comentarios

                );
                $IdCorteCaja = $this->CorteCaja_Model->CrearCorteCaja($dataCorteCaja);

                //Actualizar Notas Remision
                $this->NotaRemision_Model->AsignarCorteNotasRemision($IdCorteCaja);

                //Actualizar Movimientos de Cuentas
                $this->MovimientoCuenta_Model->AsignarCorteMovimientosCuentas($IdCorteCaja);

                $transStatus = $this->db->trans_complete();

                if ($transStatus == true)
                {
                    $this->db->trans_commit();
                }
                else
                {
                    $this->db->trans_rollback();
                    throw new Exception('Error al Crear Corte de Caja');
                }
//---------------FIN TRANSACCION


            } catch (Exception $ex) {

                log_message('error','[CORTE_CAJA]:'.$ex->getMessage());
                $this->db->trans_rollback();

            }

        }
    }

    public function ConsultarRangosNotas_ajax()
    {
        $RangoNotas = $this->NotaRemision_Model->ConsultarRangosNotasCorte();

        echo json_encode($RangoNotas);
    }

}
