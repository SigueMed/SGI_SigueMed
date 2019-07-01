<?php
class SeguimientoMedico_Model extends CI_Model{
    private $table;


    public function __construct() {
        parent::__construct();
        $this->table = "seguimientomedico";
        $this->load->database();

    }

    public function AgregarSeguimientoNotaMedicaBatch($data)
    {
        $resultado = $this->db->insert_batch($this->table,$data);

        return $resultado;
    }

    public function InsertarSeguimiento($data)
    {
        $resultado = $this->db->insert($this->table,$data);

        return $resultado;
    }


    public function ConsultarSeguimientobyid($IdNotaMedica) {
        $condition = "IdNotaMedica =" . $IdNotaMedica;
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1){
            $row = $query->row();
            $this->LoadRow($row);
            return $query->row_array();
        }else{
            return false;
        }

    }

    public function ConsultarSeguimientosPendientes($condicion = FALSE)
    {
        $this->db->select($this->table.'.*, CONCAT(p.Nombre," ",p.Apellidos) as NombrePaciente, NumCelular');
        $this->db->select('DescripcionEstatusSeguimiento, nm.IdNotaMedica, nm.FechaNotaMedica');
        $this->db->select('IF (nm.IdNotaMedica IS NULL, ss.DescripcionServicio, snm.DescripcionServicio) AS DescripcionServicio');
        $this->db->select('CONCAT(em.NombreEmpleado," ",em.ApellidosEmpleado) as NombreElaboradoPor');
        $this->db->select('cr1.DescripcionRespuestaSeguimiento as Respuesta1');
        $this->db->select('cr2.DescripcionRespuestaSeguimiento as Respuesta2');
        $this->db->select('cr3.DescripcionRespuestaSeguimiento as Respuesta3');
        $this->db->select('CONCAT(em1.NombreEmpleado," ",em1.ApellidosEmpleado) as NombreEmpleado_1');
        $this->db->select('CONCAT(em2.NombreEmpleado," ",em2.ApellidosEmpleado) as NombreEmpleado_2');
        $this->db->select('CONCAT(em3.NombreEmpleado," ",em3.ApellidosEmpleado) as NombreEmpleado_3');
        $this->db->from($this->table);
        $this->db->join('paciente p',$this->table.'.IdPaciente = p.IdPaciente');
        $this->db->join('empleado em',$this->table.'.IdElaboradoPor = em.IdEmpleado');
        $this->db->join('catalogestatusseguimiento ces',$this->table.'.IdEstatusSeguimiento = ces.IdEstatusSeguimiento');
        $this->db->join('notamedica nm',$this->table.'.IdNotaMedica = nm.IdNotaMedica','left');
        $this->db->join('servicio snm','nm.IdServicio = snm.IdServicio','left');
        $this->db->join('servicio ss','ss.IdServicio ='.$this->table.'.IdServicio', 'left');
        $this->db->join('catalogorespuestaseguimiento cr1',$this->table.'.IdRespuestaSeguimiento_1 = cr1.IdRespuestaSeguimiento','left');
        $this->db->join('catalogorespuestaseguimiento cr2',$this->table.'.IdRespuestaSeguimiento_2 = cr2.IdRespuestaSeguimiento','left');
        $this->db->join('catalogorespuestaseguimiento cr3',$this->table.'.IdRespuestaSeguimiento_3 = cr3.IdRespuestaSeguimiento','left');
        $this->db->join('empleado em1',$this->table.'.IdEmpleado_1 = em1.IdEmpleado','left');
        $this->db->join('empleado em2',$this->table.'.IdEmpleado_2 = em2.IdEmpleado','left');
        $this->db->join('empleado em3',$this->table.'.IdEmpleado_3 = em3.IdEmpleado','left');

        if ($condicion==FALSE) {
          $this->db->where($this->table.'.IdEstatusSeguimiento',1);
          $this->db->or_where($this->table.'.IdEstatusSeguimiento',2);
        }
        else {
          $this->db->where($condicion);
        }


        $query = $this->db->get();

        return $query->result_array();


    }

    public function ConsultarSeguimientosDia()
    {
        $this->db->select('COUNT(IdSeguimientoMedico) as TotalSeguimientos');
        $this->db->from($this->table);
        $this->db->where('FechaSeguimiento <=', mdate('%Y-%m-%d',now()));
        $this->db->where('IdEstatusSeguimiento', 1);
        $this->db->or_where('IdEstatusSeguimiento',2);

        $query = $this->db->get();

        return $query->row();
    }

    public function ActualizarSeguimiento($IdSeguimiento, $Seguimiento)
    {
        $this->db->where('IdSeguimientoMedico',$IdSeguimiento);
        return $this->db->update($this->table,$Seguimiento);
    }

    public function EditarDescripcionSeguimiento($IdSeguimiento,$NuevaDescripcion)
    {
      $this->db->set('DescripcionSeguimiento',$NuevaDescripcion);
      $this->db->where('IdSeguimientoMedico',$IdSeguimiento);

      return $this->db->update($this->table);

      // code...
    }

    public function EliminarSeguimiento($IdSeguimiento)
    {
      $this->db->where('IdSeguimientoMedico',$IdSeguimiento);
      return $this->db->delete($this->table);
      // code...
    }
}
