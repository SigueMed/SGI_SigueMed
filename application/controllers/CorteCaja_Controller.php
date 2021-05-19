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
      $this->load->view('CorteCaja/FormInicioCorteCaja');
      $this->load->view('CorteCaja/CardInicioCorteCaja');
      $this->load->view('templates/FormFooter');
      $this->load->view('templates/FooterContainer');

      // code...
    }

    public function Load_RealizarCorteCajaCuenta()
    {
      $action = $this->input->post('action');
      if ($action="RealizarCorteCaja")
      {

        $data['title'] = 'Relizar Corte Caja';

        //CONSULTAR INFORMACIÒN DE LA CLINICA
        $this->load->model('Clinica_Model');
        $IdClinica = $this->session->userdata('IdClinica');
        $Clinica = $this->Clinica_Model->ConsultarClinicaPorId($IdClinica);
        $data['Clinica'] =$Clinica;

        //$this->load->model('Cuenta_Model');
        //$IdCuenta = $this->input->post('cbCuentas');
        log_message('debug','[CORTECAJA] IdClinica='.$this->session->userdata('IdClinica').' ');
        //$Cuenta = $this->Cuenta_Model->ConsultarCuentaPorId($IdCuenta);
        //log_message('debug','[CORTECAJA] DescrpcionCuenta='.$Cuenta->DescripcionCuenta);
        $this->load->model('CatalogoTipoPago_Model');
        $TiposPago = $this->CatalogoTipoPago_Model->ConsultarTipoPago();

        foreach ($TiposPago as $tipoPago) {
            $MontosTipoPago[] = array(
              'IdTipoPago'=> $tipoPago['IdTipoPago'],
              'Monto'=>$this->input->post('TipoPago-'.$tipoPago['IdTipoPago'])

            );
            log_message('debug','[CORTECAJA] TipoPago-'.$tipoPago['IdTipoPago'].'='.$this->input->post('TipoPago-'.$tipoPago['IdTipoPago']));

        }

        // foreach ($TiposPago as $tipoPago) {
        //   log_message('debug','[CORTECAJA] IdTipoPago='.$MontosTipoPago['IdTipoPago'].' Monto='.$MontosTipoPago['Monto']);
        // }
        //log_message('debug',$MontosTipoPago);

        $data['MontosTipoPago']=$MontosTipoPago;
        $data['EfectivoEnCaja'] = $this->input->post('TipoPago-CAJA');
        //$data['IdCuenta']=$IdCuenta;
        //$data['Cuenta'] =$Cuenta;



        $this->load->view('templates/MainContainer',$data);
        $this->load->view('templates/HeaderContainer',$data);
        $this->load->view('CorteCaja/FormCorteCaja',$data);
        $this->load->view('CorteCaja/CardCorteCaja', $data);
        $this->load->view('templates/FormFooter',$data);
        $this->load->view('templates/FooterContainer');

      }

      // code...
    }

    public function  Load_ConsultarDetalleCorteCaja($IdCorteCaja) {

      $data['title']='Consultar Detalle Corte No. '.$IdCorteCaja;
      $data['CorteCaja'] = $this->CorteCaja_Model->ConsultarCorteCajaPorId($IdCorteCaja);
      $data['Imprimir'] = 0;

      $this->load->view('templates/MainContainer',$data);
      $this->load->view('templates/HeaderContainer',$data);

      $this->load->view('CorteCaja/CardResumenCorteCaja', $data);
      $this->load->view('templates/FormFooter',$data);
      $this->load->view('templates/FooterContainer');
      // code...
    }

    public function ConsultarResumenMovimientosCuenta()
    {

        $MovimientosCuenta = $this->MovimientoCuenta_Model->ConsultarResumenMovimientosCuentaSinCorte();

        echo  json_encode($MovimientosCuenta);
    }

    public function ConsultarDetalleMovimientosCuentaPorCorte_ajax()
    {

      $IdCorteCaja = $this->input->post('IdCorteCaja');
      $DetalleMovimientos = $this->MovimientoCuenta_Model->ConsultarDetalleMovimientosCuentaPorCorte($IdCorteCaja);

      echo json_encode($DetalleMovimientos);
      // code...
    }

    public function ConsultarDetalleTipoPago_ajax()
    {

      $this->load->model('DetallePagosCorteCaja_Model');
      $IdCorteCaja = $this->input->post('IdCorteCaja');

      $DetalleTipoPago = $this->DetallePagosCorteCaja_Model->ConsultarDetallesPagoCorte($IdCorteCaja);

      echo json_encode($DetalleTipoPago);
      // code...
    }

    public function ConsultarDetalleMovimientosCuentaSinCorte_ajax()
    {

      $IdCuenta = $this->input->post('IdCuenta');
      $DetalleMovimientos = $this->MovimientoCuenta_Model->ConsultarDetalleMovimientosCuentaSinCorte($IdCuenta);

      echo json_encode($DetalleMovimientos);
      // code...
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

    public function ConsultarBalanceCorteTipoPago($value='')
    {
      $BalanceCorteTipoPago = $this->MovimientoCuenta_Model->ConsultarBalanceCorteTipoPago();

      echo json_encode($BalanceCorteTipoPago);
    }

    // public function ConsultarBalanceCortePorTipoPago()
    // {
    //     $IdTipoPago = $this->input->post('IdTipoPago');
    //     $IdCuenta = $this->input->post('IdCuenta');
    //
    //     $TotalBalanceEfectivo = $this->MovimientoCuenta_Model->ConsultarBalanceCorte($IdTipoPago,$IdCuenta);
    //
    //     echo json_encode($TotalBalanceEfectivo);
    // }

    public function ConsultarBalanceCorteCuentas()
    {

        //$IdClinica = $this->input->post('IdClinica');
        $IdCorteCaja = $this->input->post('IdCorteCaja');

        if (isset($IdCorteCaja))
        {
            $BalanceCuentasCorte = $this->MovimientoCuenta_Model->ConsultarBalanceCuentaCorte($IdCorteCaja);
        }
        else {

          $BalanceCuentasCorte = $this->MovimientoCuenta_Model->ConsultarBalanceCuentaCorte();
        }



        echo json_encode($BalanceCuentasCorte);


    }

    public function ConsultarResumenProducto_ajax()
    {
        $IdCorteCaja = $this->input->post('IdCorteCaja');
        $ResumenProductos = $this->CatalogoProductos_Model->ConsultarResumenProductosServicio($IdCorteCaja);

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

                    "TotalEntregado"=>$TotalEntregado,
                    //"IdCuenta" => $IdCuenta,
                    "Comentarios"=>$Comentarios,
                    "HoraCorte"=>mdate('%H:%i',now()),

                    "IdClinica"=>$this->session->userdata('IdClinica')


                );
                $IdCorteCaja = $this->CorteCaja_Model->CrearCorteCaja($dataCorteCaja);

                $IdTiposPago = $this->input->post('IdTiposPago');
                $TotalesCorte = $this->input->post('TotalesCorte');
                $TotalesEntregado = $this->input->post('TotalesEntregado');
                $this->load->model('DetallePagosCorteCaja_Model');
                for($i=0;$i<sizeof($IdTiposPago);$i++)
                {

                  if ($TotalesCorte[$i]>0 || $TotalesEntregado[$i]>0 )
                  {
                    $PagoCorte = array(
                      "IdCorteCaja"=>$IdCorteCaja,
                      "IdTipoPago"=>$IdTiposPago[$i],
                      "TotalCorteCaja"=>$TotalesCorte[$i],
                      "TotalEntregado" =>$TotalesEntregado[$i]
                    );

                    $this->DetallePagosCorteCaja_Model->AgregarPagoCorteCaja($PagoCorte);
                  }

                }

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
                text: 'El corte se realizo por un Total de $".$TotalCorte." y se entrego $".$TotalEntregado."',
                type: 'success',

                showConfirmButton: true,
                confirmButtonText:'<i class=\"icon-print\"></i> Imprimir Corte',
                showCancelButton: true,
                cancelButtonText: '<i class=\"icon-th-list\"></i> Consultar Cortes'";

                $data['swalAction'] = ".then((result)=> {
                  if (result.value) {
                    window.open('".site_url("CorteCaja/ImprimirTicketCorteCaja/".$IdCorteCaja)."','_blank');
                  }
                  else {
                    window.location.href = '".site_url("CorteCaja/ConsultarCortesCaja")."';
                  }


                });";

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
      //$IdCuenta = $this->input->post('IdCuenta');
      $FechaInicial = $this->input->post('FechaInicial');
      $FechaFinal = $this->input->post('FechaFinal');

      if (isset($FechaInicial))
      {
        if(isset($FechaFinal))
        {
          $CortesCaja = $this->CorteCaja_Model->ConsultarCortesCaja($FechaInicial,$FechaFinal);
        }
        else {
          $CortesCaja = $this->CorteCaja_Model->ConsultarCortesCaja($FechaInicial);
        }

      }
      else {
        $CortesCaja = $this->CorteCaja_Model->ConsultarCortesCaja();
      }


      echo json_encode($CortesCaja);

    }

    public function ConsultarDetalleNotasCorteCuenta_ajax()
    {

      $IdCuenta = $this->input->post('IdCuenta');
      $IdCorteCaja = $this->input->post('IdCorteCaja');

      $this->load->model('NotaRemision_Model');

      if (isset($IdCorteCaja) && $IdCorteCaja !== null)
      {
          $DetalleNotas = $this->NotaRemision_Model->ConsultarNotasCorteCuenta($IdCuenta,$IdCorteCaja);
      }
      else {
        $DetalleNotas = $this->NotaRemision_Model->ConsultarNotasCorteCuenta($IdCuenta);
      }


      echo json_encode($DetalleNotas);
      // code...
    }


    public function ConsultarDetallePagosCorte_ajax()
    {
      $IdCorteCaja = $this->input->post('IdCorteCaja');

      $this->load->model('DetallePagosCorteCaja_Model');

      $DetallePagosCorte = $this->DetallePagosCorteCaja_Model->ConsultarDetallesPagoCorte($IdCorteCaja);

      echo json_encode($DetallePagosCorte);
      // code...
    }

    public function ImprimirCorte($IdCorteCaja)
    {

      $data['title']='Detalle Corte No. '.$IdCorteCaja;
      $data['CorteCaja'] = $this->CorteCaja_Model->ConsultarCorteCajaPorId($IdCorteCaja);
      $data['Imprimir'] = 1;

      $this->load->view('templates/MainContainerEmpty',$data);


      $this->load->view('CorteCaja/CardResumenCorteCaja', $data);

      $this->load->view('templates/FooterContainer');


      // code...
    }

    public function ImprimirTicketCorte($IdCorteCaja)
    {

      $data['CorteCaja'] = $this->CorteCaja_Model->ConsultarCorteCajaPorId($IdCorteCaja);
      $this->load->model('Clinica_Model');
      $data['Clinica'] = $this->Clinica_Model->ConsultarClinicaPorId($this->session->userdata('IdClinica'));
      $this->load->model('DetallePagosCorteCaja_Model');
      $data['DetalleCorteCaja']=$this->DetallePagosCorteCaja_Model->ConsultarDetallesPagoCorte($IdCorteCaja);

      $this->load->view('CorteCaja/TicketCierreCaja',$data);


      // code...
    }

}
