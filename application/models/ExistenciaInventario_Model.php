<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ExistenciaInventario_Model
 *
 * @author SigueMED
 */
class ExistenciaInventario_Model extends CI_Model {
    private $table;
    public function __construct() {
        parent::__construct();
        $this->table="existenciainventario";
        $this->load->database();
    }

    public function ConsultarExistencias($IdClinica,$IdCodigoSubProducto,$Lote)
    {
        $this->db->select('CantidadInventario');
        $this->db->from($this->table);
        $this->db->where('IdClinica',$IdClinica);
        $this->db->where('IdCodigoSubProducto',$IdCodigoSubProducto);
        $this->db->where('Lote',$Lote);
        $query = $this->db->get();

        if ($query->num_rows()>=1)
        {
            $result = $query->row();

            return $result->CantidadInventario;
        }
        return false;
    }

    public function ActualizarExistencia($ExistenciaInventario)
    {
        $this->db->set('CantidadInventario',$ExistenciaInventario['CantidadInventario']);

        $this->db->where('IdClinica',$ExistenciaInventario['IdClinica']);
        $this->db->where('IdCodigoSubProducto',$ExistenciaInventario['IdCodigoSubProducto']);
        $this->db->where('Lote',$ExistenciaInventario['Lote']);

        return $this->db->update($this->table);

    }

    /*
     * DESCRIPCION: Consultar la existencia de un producto por IdProducto
     * SALIDA: Fila con el resultado de la CantidadProducto
     * AUTOR: Constanzo Manuel Basurto Chipolini
     */
    public function ConsultarExistenciaPorProducto($IdProducto)
    {
        $this->db->select_sum('CantidadInventario');
        $this->db->select('catalogoproductos.IdProducto');
        $this->db->from($this->table);
        $this->db->join('subproducto',$this->table.'.IdCodigoSubProducto = subproducto.IdCodigoSubProducto');
        $this->db->join('catalogoproductos',$this->table.'.IdProducto = '.$IdProducto);
        $this->db->grou_by('IdProducto');

        $query = $this->db->get();

        return $query->row();

    }

    public function RegistrarNuevaExistencia($ExistenciaInventario)
    {
        return $this->db->insert($this->table,$ExistenciaInventario);
    }
    //put your code here
}
