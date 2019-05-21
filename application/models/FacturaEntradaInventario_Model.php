<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FacturaEntradaInventario_Model
 *
 * @author SigueMED
 */
class FacturaEntradaInventario_Model extends CI_Model {
    
    private $table;
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->table = "facturaentradainventario";
    }
    
    public function CrearNuevaFactura($NuevaFactura)
    {
        $result = $this->db->insert($this->table,$NuevaFactura);
        
        if ($result>=1)
        {
            $Factura = $this->ConsultarFactura($NuevaFactura['NumeroFactura'],$NuevaFactura['IdProveedor']);
            if($Factura!==FALSE)
            {
                return $Factura->IdFacturaEntradaInventario;
            }
    
        }
        return false;
    }
        
        
    public function ConsultarFactura($NumeroFactura, $IdProveedor)
    {
        $this->db->select($this->table.'.*');
        $this->db->from($this->table);
        $this->db->where('NumeroFactura',$NumeroFactura);
        $this->db->where('IdProveedor',$IdProveedor);
        
        $query = $this->db->get();
        
        if($query->num_rows()>=1)
        {
            return $query->row();
        }
        else
        {
            return false;
        }
    }
    //put your code here
}
