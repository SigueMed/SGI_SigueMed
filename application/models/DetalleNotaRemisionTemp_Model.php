<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Salida_Model
 *
 * @author SigueMED
 */
class DetalleNotaRemisionTemp_Model extends CI_Model {
    private $table;
    public function __construct() {
        parent::__construct();

        $this->table="detallenotaremision_temp";

        $this->load->database();

    }

    public function GuardarDetalleNotaRemisionTemp($DetalleNotaRemisionTemp)
    {

        try {

            $this->db->insert($this->table,$DetalleNotaRemisionTemp);

            return $this->db->insert_id();

        } catch (\Exception $e) {
          log_message('ERROR','GuardarDetalleNotaRemisionTemp.Insert.error='.$e->getMessage());
          throw new \Exception("Error al insertar producto de nota temporal en la BD", 1);
        }



    }

    public function ConsultarDetalleNotaRemisionTemp($IdNotaRemisionTemp)
    {
      $this->db->select($this->table.'.*');

      $this->db->select('DescripcionProducto, CostoProducto, PrecioProveedor');
      $this->db->select('DescripcionServicio, EsProveedor');
      $this->db->from($this->table);

      $this->db->join('catalogoproductos cp', $this->table.'.IdProducto = cp.IdProducto');
      $this->db->join('servicio s','cp.IdServicio = s.IdServicio');
      $this->db->join('gruposervicio gs','s.IdGrupoServicio = gs.IdGrupoServicio');


      $this->db->where('IdNotaRemision_Temp',$IdNotaRemisionTemp);

      $query = $this->db->get();

      return $query->result_array();

    }
    public function DetallesNotaRemisionTemp($IdDetalleNota)
    {
      $this->db->select('*, Cantidad, Descuento');
      $this->db->from($this->table);
      $this->db->join("catalogoproductos cp",$this->table.".IdProducto = cp.IdProducto");
      //$this->db->from("notaremision_temp nt");
      $this->db->where('IdNotaRemision_Temp',$IdDetalleNota);

      $query = $this->db->get();
      return $query->result_array();

      // code...
    }

    public function BorrarDetalleNotaRemisionTemp($IdNotaRemisionTemp)
    {
      $this->db->where('IdNotaRemision_Temp',$IdNotaRemisionTemp);
      $this->db->delete($this->table);

      return true;
      // code...
    }
}
