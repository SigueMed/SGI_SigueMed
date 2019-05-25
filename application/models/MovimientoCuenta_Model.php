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
    
    public function ConsultarResumentMovimientosCuentaPorTipoPago($IdTipoMovimientoCuenta, $IdClinica,$IdCorte=FALSE, $FechaInicio=FALSE, $FechaFin=FALSE)
    {
        $this->db->select_sum('TotalMovimiento','TotalTipoPago');
        $this->db->select('DescripcionTipoPago');
        $this->db->from($this->table);
        $this->db->join('catalogotipopago',$this->table.'.IdTipoPago = catalogotipopago.IdTipoPago');
        if ($IdCorte==FALSE)
        {
            $this->db->where('IdCorteCaja is NULL');
            
        }
        else
        {
            $this->db->where('IdCorteCaja',$IdCorte);
        }
        $this->db->group_by('DescripcionTipoPago');
        
        if ($FechaInicio!== FALSE)
        {
            $this->db->where('FechaMovimientoCuenta >=', $FechaInicio);
            $this->db->where('FechaMovimientoCuenta <=', $FechaFin);
            
        }
        
        $this->db->where('IdClinica', $IdClinica);
        
        $this->db->where('IdTipoMovimientoCuenta',$IdTipoMovimientoCuenta);
        
        $query = $this->db->get();
        
        return $query->result_array();
        
        
    }
    
    public function ConsultarBalanceCorte($IdTipoPago)
    {
        $this->db->select_sum('TotalMovimiento', 'TotalEntradas');
        $this->db->from($this->table);
        $this->db->where('IdCorteCaja is NULL');
        $this->db->where('IdTipoMovimientoCuenta',1);
        $this->db->where('IdTipoPago', $IdTipoPago);
        $this->db->where('IdClinica', $this->session->userdata('IdClinica'));
        
        $query = $this->db->get();
        
        $TotalEntradas = $query->row();
        
        $this->db->select_sum('TotalMovimiento', 'TotalSalidas');
        $this->db->from($this->table);
        $this->db->where('IdCorteCaja is NULL');
        $this->db->where('IdTipoMovimientoCuenta',2);
        $this->db->where('IdTipoPago', $IdTipoPago);
        $this->db->where('IdClinica', $this->session->userdata('IdClinica'));
        
        $query = $this->db->get();
        
        $TotalSalidas = $query->row();
        
        $BalanceCaja = $TotalEntradas->TotalEntradas - $TotalSalidas->TotalSalidas;
        
        return $BalanceCaja;
        
    }
    
    public function ConsultarBalanceCuentaCorte($IdClinica)
    {
        $query = $this->db->query('call CorteCaja_BalanceCuentasCorte('.$IdClinica.')');
        
        $result =  $query->result_array();
        
        $query->next_result();        
        $query->free_result();
        
        return $result;
        
    }
    
    public function AsignarCorteMovimientosCuentas($IdCorteCaja)
    {
        $this->db->set('IdCorteCaja',$IdCorteCaja);
        $this->db->where('IdCorteCaja', NULL);
        return $this->db->update($this->table);
    }
    //put your code here
}
