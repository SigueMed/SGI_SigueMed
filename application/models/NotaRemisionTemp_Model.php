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
class NotaRemisionTemp_Model extends CI_Model {
    private $table;
    public function __construct() {
        parent::__construct();

        $this->table="notaremision_temp";

        $this->load->database();

    }

    public function GuardarNotaRemisionTemp($NotaRemisionTemp)
    {

        try {

            $this->db->insert($this->table,$NotaRemisionTemp);

            return $this->db->insert_id();

        } catch (\Exception $e) {
          log_message('ERROR','GuardarNotaRemisionTemp.Insert.error='.$e->getMessage());
          throw new \Exception("Error al insertar nueva nota remision temporal en la BD", 1);
        }



    }

    public function ConsultarNotasRemisionTemp()
    {

      $this->db->select($this->table.'.*');
      $this->db->select('CONCAT(Nombre," ",Apellidos) as NombrePaciente');
      $this->db->select('DescripcionFoliador');
      $this->db->select('NombreClinica');
      $this->db->from($this->table);
      $this->db->join('paciente p',$this->table.'.IdPaciente = p.IdPaciente');
      $this->db->join('foliador f',$this->table.'.IdFoliador = f.IdFoliador');
      $this->db->join('clinicas c',$this->table.'.IdClinica = c.IdClinica');


      $query = $this->db->get();
      return $query->result_array();
      
    }

    public function ConsultarNotaTemporalPorId($IdNotaRemisionTemp)
    {
      $this->db->select($this->table.'.*');
      $this->db->select('CONCAT(Nombre," ",Apellidos) as NombrePaciente');

      $this->db->from($this->table);
      $this->db->join('paciente p',$this->table.'.IdPaciente = p.IdPaciente');


      $this->db->where('IdNotaRemisionTemp',$IdNotaRemisionTemp);

      $query = $this->db->get();

      return $query->row();

    }

    public function EliminarNotaRemisionTemp($IdNotaRemisionTemp)
    {

      try {

        $this->db->where('IdNotaRemisionTemp',$IdNotaRemisionTemp);
        return $this->db->delete($this->table);


      } catch (\Exception $e) {
        log_message('ERROR','NotaRemisionTemp_ModelEliminarNotaRemisionTemp.delete.error='.$e->getMessage());
        throw new \Exception("Error al eliminar nota temporal BD", 1);
      }




    }


    //put your code here
}
