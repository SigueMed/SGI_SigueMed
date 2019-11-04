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

    public function Load_RealizarCorteCajaCuenta($IdCuenta, $MontoEnCaja)
    {

      $data['title'] = 'Relizar Corte Caja';

      $this->load->model('Cuenta_Model');
      $Cuenta = $this->Cuenta_Model->ConsultarCuentaPorId($IdCuenta);
      $data['IdCuenta']=$IdCuenta;
      $data['Cuenta'] =$Cuenta;
      $data['MontoEnCaja']=$MontoEnCaja;

      $this->load->view('templates/MainContainer',$data);
      $this->load->view('templates/HeaderContainer',$data);
      $this->load->view('CorteCaja/FormCorteCaja');
      $this->load->view('CorteCaja/CardCorteCaja', $data);
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
        $IdCuenta = $this->input->post('IdCuenta');

        $IdTipoMovimientoCuenta = TMC_DEPOSITO;
        $IdClinica = $this->session->userdata('IdClinica');

        $ResumenEntradas = $this->MovimientoCuenta_Model->ConsultarResumentMovimientosCuentaPorTipoPago($IdTipoMovimientoCuenta,$IdClinica,$IdCuenta);

        echo json_encode($ResumenEntradas);
    }

    public function ConsultarBalanceCortePorTipoPago()
    {
        $IdTipoPago = $this->input->post('IdTipoPago');
        $IdCuenta = $this->input->post('IdCuenta');

        $TotalBalanceEfectivo = $this->MovimientoCuenta_Model->ConsultarBalanceCorte($IdTipoPago,$IdCuenta);

        echo json_encode($TotalBalanceEfectivo);
    }

    public function ConsultarBalanceCorteCuentas()
    {

        $IdCuenta = $this->input->post('IdCuenta');

        $BalanceCuentasCorte = $this->MovimientoCuenta_Model->ConsultarBalanceCuentaCorte($IdCuenta);

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
        $IdCuenta = $this->input->post('IdCuenta');
        $TotalEntregado = $this->input->post('TotalEntregado');

        $this->load->model('Cuenta_Model');

        $Cuenta = $this->Cuenta_Model->ConsultarCuentaPorId($IdCuenta);


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
                    "TotalEntregado"=>$TotalEntregado,
                    "IdCuenta" => $IdCuenta,
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
                $data['title'] = 'Corte Exitoso';
                $data['swal']=true;
                $data['swalMessage']="title:'Corte registrado con exito',
                text: 'El corte de la cuenta ".$Cuenta->DescripcionCuenta." se realizo por un Total en efectivo de $".$TotalEfectivo." y se recibio en efectivo $".$TotalEntregado."',
                type: 'success',
                showConfirmButton: true";


                $this->load->view('templates/MainContainer',$data);
                $this->load->view('templates/HeaderContainer',$data);
                $this->load->view('templates/FormFooter',$data);
                $this->load->view('templates/FooterContainer');



            } catch (Exception $ex) {

                log_message('error','[CORTE_CAJA]:'.$ex->getMessage());
                $this->db->trans_rollback();

            }

        }
        else {
          echo "<script>window.location.href='".site_url()."/CorteCaja/ElaborarCorteCaja';</script>";
        }
    }

    public function ConsultarRangosNotas_ajax()
    {
        $
        $RangoNotas = $this->NotaRemision_Model->ConsultarRangosNotasCorte();

        echo json_encode($RangoNotas);
    }

    //------- CONSULTA CORTES DE Caja

    public function Load_ConsultarCortesCaja()
    {

      $data['title'] = 'Consulta Cortes de Caja';
      $this->load->view('templates/MainContainer',$data);
      $this->load->view('templates/HeaderContainer',$data);

      $this->load->view('CorteCaja/CardConsultaCortes', $data);

      $this->load->view('templates/FooterContainer');
    }

    public function ConsultarCortesCaja_ajax()
    {
      $IdCuenta = $this->input->post('IdCuenta');
      $CortesCaja = $this->CorteCaja_Model->ConsultarCortesCaja($IdCuenta);

      echo json_encode($CortesCaja);

    }

}
