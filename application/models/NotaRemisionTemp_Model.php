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

      $this->db->select($this->table.'*');
      $this->db->select('CONCAT(Nombre," ",Apellidos) as NombrePaciente');
      $this->db->from($this->table);
      $this->db->join('paciente p',$this->table.'.IdPaciente = p.IdPaciente');

      // code...
    }


    //put your code here
}
