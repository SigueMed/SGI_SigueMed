<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MovimientoCuenta_Model
 *
 * @author SigueMED
 */
class MovimientoCuenta_Model extends CI_Model {
    private $table;
    public function __construct() {
        parent::__construct();
        $this->table = 'movimientocuenta';

        $this->load->database();
    }

    public function RegistrarNuevoMovimientoCuenta($MovimientoCuenta)
    {
        return $this->db->insert($this->table,$MovimientoCuenta);
    }

    public function ConsultarDetalleMovimientosCuenta($IdCuenta, $IdEstatusMovimiento)
    {

        $query = $this->db->query('call SalidaCaja_ConsultaDetalleMovimientosCuenta('.$IdCuenta.','.$IdEstatusMovimiento.','.$this->session->userdata('IdClinica').')');

        $result =  $query->result_array();

        $query->next_result();
        $query->free_result();

        return $result;
    }

    public function ConsultarTotalMovimientosCuenta($IdCuenta, $IdEstatusMovimiento, $IdTipoPago)
    {
        $query = $this->db->query('call SalidaCaja_TotalMovimientosCuenta('.$IdCuenta.','.$IdEstatusMovimiento.','.$IdTipoPago.','.$this->session->userdata('IdClinica').')');

        $result =  $query->row();

        $query->next_result();
        $query->free_result();

        return $result;
    }

    public function RegistrarSalidaMovimientos($IdCuenta,$IdSalida,$IdTipoPago, $IdClinica)
    {
        $this->db->set('IdSalidaCaja',$IdSalida);
        $this->db->set('IdEstatusMovimientoCuenta', MC_PAGADO);
        $this->db->where('IdCuenta',$IdCuenta);
        $this->db->where('IdTipoPago', $IdTipoPago);
        $this->db->where('IdClinica',$IdClinica);
        $this->db->where('IdSalidaCaja is NULL', null, false );


        return $this->db->update($this->table);




    }

    public function ConsultarDetalleSalida($IdSalida)
    {
        $this->db->select($this->table.'.*, DescripcionTipoPago, notaremision.IdNotaRemision, FechaNotaRemision, DescripcionTipoMovimientoCuenta');
        $this->db->from ($this->table);
        $this->db->join('catalogotipopago',$this->table.'.IdTipoPago = catalogotipopago.IdTipoPago');
        $this->db->join('catalogotipomovimientocuenta', $this->table.'.IdTipoMovimientoCuenta = catalogotipomovimientocuenta.IdTipoMovimientoCuenta');
        $this->db->join('pagonotaremision',$this->table.'.IdPagoNotaRemision = pagonotaremision.IdPagoNotaRemision');
        $this->db->join('notaremision','pagonotaremision.IdNotaRemision = notaremision.IdNotaRemision');
        $this->db->where('IdSalidaCaja',$IdSalida);

        $query = $this->db->get();

        return $query->result_array();
    }

    public function ConsultarResumenMovimientosCuentaSinCorte()
    {
        $query = $this->db->query('call CorteCaja_ConsultaResumenMovimientosCuentaSinCorte('.$this->session->userdata('IdClinica').')');

        $result =  $query->result_array();

        $query->next_result();
        $query->free_result();

        return $result;

    }

    public function ConsultarResumentMovimientosCuentaPorTipoPago($IdTipoMovimientoCuenta, $IdClinica, $IdCuenta, $IdCorte=FALSE, $FechaInicio=FALSE, $FechaFin=FALSE)
    {


        $this->db->select_sum('TotalMovimiento','TotalTipoPago');
        $this->db->select('IdTipoPago');
        $this->db->from($this->table);

        if ($IdCorte==FALSE)
        {
            $this->db->where('IdCorteCaja is NULL');

        }
        else
        {
            $this->db->where('IdCorteCaja',$IdCorte);
        }
        $this->db->group_by('IdTipoPago');

        if ($FechaInicio!== FALSE)
        {
            $this->db->where('FechaMovimientoCuenta >=', $FechaInicio);
            $this->db->where('FechaMovimientoCuenta <=', $FechaFin);

        }

        $this->db->where('IdClinica', $IdClinica);
        $this->db->where('IdCuenta',$IdCuenta);

        $this->db->where('IdTipoMovimientoCuenta',$IdTipoMovimientoCuenta);
        $this->db->where('IdEstatusMovimientoCuenta <>',3);

        $subquery = $this->db->get_compiled_select();

        $this->db->reset_query();

        $this->db->select('ctp.IdTipoPago,DescripcionTipoPago, TotalTipoPago');
        $this->db->from ('catalogotipopago ctp');
        $this->db->join("($subquery) t", "ctp.IdTipoPago = t.IdTipoPago","left");

        $query = $this->db->get();

        return $query->result_array();


    }

    public function ConsultarBalanceCorte($IdTipoPago, $IdCuenta)
    {
        $this->db->select_sum('TotalMovimiento', 'TotalEntradas');
        $this->db->from($this->table);
        $this->db->where('IdCuenta',$IdCuenta);
        $this->db->where('IdCorteCaja is NULL');
        $this->db->where('IdTipoMovimientoCuenta',1);
        $this->db->where('IdEstatusMovimientoCuenta <>',3);
        $this->db->where('IdTipoPago', $IdTipoPago);
        $this->db->where('IdClinica', $this->session->userdata('IdClinica'));

        $query = $this->db->get();

        $TotalEntradas = $query->row();

        $this->db->select_sum('TotalMovimiento', 'TotalSalidas');
        $this->db->from($this->table);
        $this->db->where('IdCuenta',$IdCuenta);
        $this->db->where('IdCorteCaja is NULL');
        $this->db->where('IdTipoMovimientoCuenta',2);
        $this->db->where('IdEstatusMovimientoCuenta <>',3);
        $this->db->where('IdTipoPago', $IdTipoPago);
        $this->db->where('IdClinica', $this->session->userdata('IdClinica'));

        $query = $this->db->get();

        $TotalSalidas = $query->row();

        $BalanceCaja = $TotalEntradas->TotalEntradas - $TotalSalidas->TotalSalidas;

        return $BalanceCaja;

    }

    public function ConsultarBalanceCuentaCorte($IdCuenta, $IdCorteCaja=FALSE)
    {
      $IdClinica = $this->session->userdata('IdClinica');
      if ($IdCorteCaja == FALSE)
      {
        $query = $this->db->query('call CorteCaja_BalanceCuentasCorte('.$IdClinica.','.$IdCuenta.')');
      }
      else {

        $query = $this->db->query('call CorteCaja_BalanceCuentasCortePorId('.$IdCorteCaja.')');
      }



        $result =  $query->result_array();

        $query->next_result();
        $query->free_result();

        return $result;

    }


    public function AsignarCorteMovimientosCuentas($IdCorteCaja,$IdCuenta)
    {
        $this->db->set('IdCorteCaja',$IdCorteCaja);
        $this->db->where('IdCorteCaja', NULL);
        $this->db->where('IdCuenta',$IdCuenta);
        $this->db->where('IdClinica', $this->session->userdata('IdClinica'));
        return $this->db->update($this->table);
    }

    public function ConsultarDetalleMovimientosCuentaPorCorte($IdCorteCaja)
    {

      $this->db->select($this->table.'.*');
      $this->db->select('nr.IdNotaRemision, Folio, FechaNotaRemision');
      $this->db->select('CONCAT(NombreEmpleado," ",ApellidosEmpleado) as Empleado');
      $this->db->select('CONCAT(Nombre," ",Apellidos) as Paciente');
      $this->db->select('DescripcionTipoMovimientoCuenta');
      $this->db->select('DescripcionTipoPago');
      $this->db->select('DescripcionCuenta');
      $this->db->from($this->table);
      $this->db->join('pagonotaremision pnr',$this->table.'.IdPagoNotaRemision = pnr.IdPagoNotaRemision');
      $this->db->join('notaremision nr','pnr.IdNotaRemision = nr.IdNotaRemision');
      $this->db->join('empleado e','nr.IdEmpleado = e.IdEmpleado');
      $this->db->join('paciente p','p.IdPaciente = nr.IdPaciente');
      $this->db->join('catalogotipomovimientocuenta ctm',$this->table.'.IdTipoMovimientoCuenta = ctm.IdTipoMovimientoCuenta');
      $this->db->join('catalogotipopago ctp','ctp.IdTipoPago ='.$this->table.'.IdTipoPago');
      $this->db->join('cuenta c','c.IdCuenta = '.$this->table.'.IdCuenta');

      $this->db->where($this->table.'.IdCorteCaja',$IdCorteCaja);
      $this->db->where($this->table.'.IdClinica', $this->session->userdata('IdClinica'));
      $this->db->where($this->table.'.IdEstatusMovimientoCuenta <>3');

      $query = $this->db->get();

      return $query->result_array();
      // code...
    }

    public function ConsultarDetalleMovimientosCuentaSinCorte($IdCuenta)
    {

      $this->db->select($this->table.'.*');
      $this->db->select('nr.IdNotaRemision, Folio, FechaNotaRemision');
      $this->db->select('CONCAT(NombreEmpleado," ",ApellidosEmpleado) as Empleado');
      $this->db->select('CONCAT(Nombre," ",Apellidos) as Paciente');
      $this->db->select('DescripcionTipoMovimientoCuenta');
      $this->db->select('DescripcionTipoPago');
      $this->db->select('DescripcionCuenta');
      $this->db->from($this->table);
      $this->db->join('pagonotaremision pnr',$this->table.'.IdPagoNotaRemision = pnr.IdPagoNotaRemision');
      $this->db->join('notaremision nr','pnr.IdNotaRemision = nr.IdNotaRemision');
      $this->db->join('empleado e','nr.IdEmpleado = e.IdEmpleado');
      $this->db->join('paciente p','p.IdPaciente = nr.IdPaciente');
      $this->db->join('catalogotipomovimientocuenta ctm',$this->table.'.IdTipoMovimientoCuenta = ctm.IdTipoMovimientoCuenta');
      $this->db->join('catalogotipopago ctp','ctp.IdTipoPago ='.$this->table.'.IdTipoPago');
      $this->db->join('cuenta c','c.IdCuenta = '.$this->table.'.IdCuenta');

      $this->db->where($this->table.'.IdCorteCaja',NULL);
      $this->db->where($this->table.'.IdClinica', $this->session->userdata('IdClinica'));
      $this->db->where($this->table.'.IdCuenta',$IdCuenta);
      $this->db->where($this->table.'.IdEstatusMovimientoCuenta <>3');


      $query = $this->db->get();

      return $query->result_array();
      // code...
    }

    public function CancelarMovimientosCuentaNotaRemision($IdNotaRemision)
    {
      $this->db->set('IdEstatusMovimientoCuenta',3);
      $Condition = 'IdPagoNotaRemision IN (SELECT IdPagoNotaRemision FROM pagonotaremision WHERE IdNotaRemision='.$IdNotaRemision.')';
      $this->db->where($Condition);
      return $this->db->update($this->table);
      // code...
    }
    //put your code here
}
