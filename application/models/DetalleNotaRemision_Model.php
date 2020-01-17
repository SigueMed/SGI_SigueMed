<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DetalleNotaRemision
 *
 * @author SigueMED
 */
class DetalleNotaRemision_Model extends CI_Model{
    private $table;
    public function __construct() {
        parent::__construct();
        $this->table = "detallenotaremision";
        $this->load->database();

    }

    public function AgregarDetalleNotaRemision($DetalleNotaRemision)
    {
        return $this->db->insert ($this->table,$DetalleNotaRemision);
    }

    public function ConsultarDetalleNotaRemision($IdNotaRemision)
    {
        $this->db->select($this->table.'.*, catalogoproductos.DescripcionProducto, NombreSubProducto');
        $this->db->from($this->table);
        $this->db->join('catalogoproductos',$this->table.'.IdProducto=catalogoproductos.IdProducto');
        $this->db->join('subproducto',$this->table.'.IdCodigoSubProducto = subproducto.IdCodigoSubProducto','left');
        $this->db->where('IdNotaRemision',$IdNotaRemision);

        $query = $this->db->get();

        return $query->result_array();


    }

    public function ConsultarMovimientosProveedorSinPagar($IdProveedor)
    {

      $this->db->select('dnr.IdNotaRemision, FechaNotaRemision,DescripcionTipoPago,DescripcionProducto,Cantidad, CostoUnitario, dnr.PrecioProveedor, PorcentajeNotaRemision, (Cantidad*(dnr.PrecioProveedor)) as TotalProveedor');
      $this->db->from($this->table.' dnr');
      $this->db->join('catalogoproductos cp','dnr.IdProducto = cp.IdProducto');
      $this->db->join('pagonotaremision pnr','pnr.IdNotaRemision = dnr.IdNotaRemision');
      $this->db->join('notaremision nr','nr.IdNotaRemision = dnr.IdNotaRemision');
      $this->db->join('catalogotipopago ctp','ctp.IdTipoPago = pnr.IdTipoPago');

      $this->db->where('IdServicio',$IdProveedor);
      $this->db->where('IdPagoProveedor',null);

      $query = $this->db->get();

      return $query->result_array();

      // code...
    }

    public function ConsultarResumenTipoPagoProveedor($IdProveedor)
    {
      $this->db->select('DescripcionTipoPago, SUM(Cantidad*(dnr.PrecioProveedor)) as TotalPago');
      $this->db->from($this->table.' dnr');
      $this->db->join('catalogoproductos cp','dnr.IdProducto = cp.IdProducto');
      $this->db->join('pagonotaremision pnr','pnr.IdNotaRemision = dnr.IdNotaRemision');

      $this->db->join('catalogotipopago ctp','ctp.IdTipoPago = pnr.IdTipoPago');
      $this->db->group_by('DescripcionTipoPago');
      $this->db->where('IdServicio',$IdProveedor);
      $this->db->where('IdPagoProveedor',null);

      $query = $this->db->get();

      return $query->result_array();

      // code...
    }

    public function ConsultarTotalPagoProveedor($IdProveedor)
    {
      $this->db->select('SUM(Cantidad*(dnr.PrecioProveedor)) as TotalPago');
      $this->db->from($this->table.' dnr');
      $this->db->join('catalogoproductos cp','dnr.IdProducto = cp.IdProducto');
      $this->db->join('pagonotaremision pnr','pnr.IdNotaRemision = dnr.IdNotaRemision');

      $this->db->join('catalogotipopago ctp','ctp.IdTipoPago = pnr.IdTipoPago');

      $this->db->where('IdServicio',$IdProveedor);
      $this->db->where('IdPagoProveedor',null);

      $query = $this->db->get();

      return $query->row();


      // code...
    }

    public function AsignarPagoProveedor($IdProveedor, $IdPagoProveedor)
    {


      $this->db->select('DISTINCT(IdDetalleNotaRemision)');
      $this->db->from('(SELECT * FROM '.$this->table.') AS dnr');
      $this->db->join('catalogoproductos cp','dnr.IdProducto = cp.IdProducto');
      $this->db->where('IdServicio',$IdProveedor);
      $this->db->where('IdPagoProveedor',null);

      $subquery = $this->db->get_compiled_select();
      $this->db->reset_query();


      $this->db->set('IdPagoProveedor',$IdPagoProveedor);
      $condition = 'IdDetalleNotaRemision IN('.$subquery.')';
      $this->db->where($condition);
      return $this->db->update($this->table);




      // code...
    }

    //put your code here
}
