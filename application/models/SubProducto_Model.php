<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SubProducto_Model
 *
 * @author SigueMED
 */
class SubProducto_Model extends CI_Model{
    private $table;
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->table="subproducto";
    }

    public function ConsultarSubProducto($CodigoSubProducto)

    {
        $this->db->select($this->table.'.*');
        $this->db->from($this->table);
        $this->db->where('IdCodigoSubProducto',$CodigoSubProducto);

        $query = $this->db->get();

        if ($query->num_rows()>=1)
        {
            return $query->row();
        }
        return false;


    }
    public function AgregarNuevoSubProducto($NuevoSubProducto)
    {
        $result = $this->db->insert($this->table,$NuevoSubProducto);

        return $result;

    }

    public function ConsultarSubProductosProducto($IdProducto,$IdClinica)
    {
        $this->db->select($this->table.'.*, NombreProveedor, lotesubproducto.Lote, Costo, FechaCaducidad, CantidadInventario');
        $this->db->from($this->table);
        $this->db->join('proveedor', 'proveedor.IdProveedor = '.$this->table.'.IdProveedor');
        $this->db->join('lotesubproducto', 'lotesubproducto.IdCodigoSubProducto ='.$this->table.'.IdCodigoSubProducto');
        $this->db->join('existenciainventario','existenciainventario.IdCodigoSubProducto = lotesubproducto.IdCodigoSubProducto AND existenciainventario.Lote=lotesubproducto.Lote');
        $this->db->where('IdClinica', $IdClinica);
        $this->db->where ($this->table.'.IdProducto',$IdProducto);

        $query = $this->db->get();
        return $query->result_array();

//        if ($query->num_rows()>0)
//        {
//            return $query->result_array();
//        }
//
//        return false;
    }

    public function ConsultarExistenciaPorCaducidadSubProducto($IdCodigoSubProducto, $IdClinica, $IdFoliador)
    {
        $query=$this->db->query('call NotaRemision_ConsultaExistenciaSubProductoPorFecha('.$IdCodigoSubProducto.','.$IdClinica.','.$IdFoliador.')');

      return $query->row();

    }


    //put your code here
}
