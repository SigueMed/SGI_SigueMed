<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class NotaRemision_Model extends CI_Model {
    
    //Atributos NotaMedica
    private $table;
    
    
    public function __construct() {
        parent::__construct();
        $this->table ="notaremision";
        
        $this->load->database();
        
        $this->load->model('NotaMedica_Model');
        $this->load->model('NotaRemision_Model');
        $this->load->model('ProductosNotaMedica_Model');
        
        $this->load->model('Paciente_Model');
        $this->load->helper('date');
        $this->load->helper('array');
        
        
       }
          
    public function CrearNotaDeRemision($NotaRemisionArray)
    {
        $result = $this->db->insert($this->table,$NotaRemisionArray);
        
        if ($result>=1)
        {
            $this->db->select_max('IdNotaRemision','IdUltimaNotaRemision');
            $this->db->from($this->table);
            $IdUltimaNotaRemision = $this->db->get()->row();
            
            return $IdUltimaNotaRemision;
            
        }
        else
        {
            return null;
        }
     
      
    }
    
    public function ConsultarMovimientosCuentaNota($IdNotaRemision)
    {
        $query=$this->db->query('call NotaRemision_ConsultaDetalleMovimientosCuenta('.$IdNotaRemision.')');
      
        $result =  $query->result_array();
        
        $query->next_result();        
        $query->free_result();
        
        return $result;
    }
    
    public function ConsultarNotaRemision($IdNotaRemision)
    {
        $this->db->select($this->table.'.*,CONCAT (Nombre," ",Apellidos) as NombrePaciente, CONCAT( NombreEmpleado," ", ApellidosEmpleado) AS ElaboradaPor, DescripcionTurno, email, RFC,NumCelular,DescripcionEstatusNotaRemision ');
        $this->db->from($this->table);
        $this->db->join('paciente', $this->table.'.IdPaciente = paciente.IdPaciente');
        $this->db->join('empleado', $this->table.'.IdEmpleado = empleado.IdEmpleado');
        $this->db->join('catalogoturno',$this->table.'.IdTurno = catalogoturno.IdTurno');
        $this->db->join('catalogoestatusnotaremision',$this->table.'.IdEstatusNotaRemision = catalogoestatusnotaremision.IdEstatusNotaRemision');
        $this->db->where ('IdNotaRemision',$IdNotaRemision);
        
        $query = $this->db->get();
        
        return $query->row();
    }
    
    public function ConsultarTotalAdeudoPaciente($IdPaciente)
    {
        $query = $this->db->query('call NotaRemision_ConsultaTotalAdeudoPaciente('.$IdPaciente.')');
        
       
            return $query->row();
       
        
        
    }
    
    public function ConsultarDetalleAdeudoPaciente($IdPaciente)
    {
        $this->db->select($this->table.'.*, (TotalNotaRemision - TotalPagado) as TotalAdeudo');
        $this->db->from ($this->table);
        $this->db->where('IdPaciente',$IdPaciente);
        $this->db->where('IdEstatusNotaRemision',NR_NO_PAGADO);
        $this->db->or_where('IdEstatusNotaRemision', NR_PAGO_PARCIAL);
        $this->db->order_by('IdNotaRemision', 'asc');
        
        $query = $this->db->get();
        
        
        return $query->result_array();
        
    }
    
    public function ActualizarNotaRemision($IdNotaRemision,$NotaArray)
    {
        $this->db->where('IdNotaRemision',$IdNotaRemision);
        return $this->db->update($this->table,$NotaArray);
    }
    
    public function ConsultarNotasRemision($FechaInicio, $FechaFin, $IdClinica, $IdEstatusNota = FALSE)
    {
        $this->db->select($this->table.'.*, CONCAT(NombreEmpleado, " ",ApellidosEmpleado) as ElaboradaPor, DescripcionTurno');
        $this->db->select('CONCAT(Nombre, " ",Apellidos) as NombrePaciente, DescripcionEstatusNotaRemision');
        $this->db->from($this->table);
        $this->db->join('empleado',$this->table.'.IdEmpleado = empleado.IdEmpleado');
        $this->db->join('catalogoestatusnotaremision',$this->table.'.IdEstatusNotaRemision = catalogoestatusnotaremision.IdEstatusNotaRemision');
        $this->db->join('paciente',$this->table.'.IdPaciente = paciente.IdPaciente');
        $this->db->join('catalogoturno',$this->table.'.IdTurno = catalogoturno.IdTurno');
        $this->db->where('IdClinica',$IdClinica);
        $this->db->where('FechaNotaRemision >=',$FechaInicio);
        $this->db->where('FechaNotaRemision <=', $FechaFin);
        if($IdEstatusNota!== FALSE)
        {
            $this->db->where ($IdEstatusNota);
        }
        
        $this->db->order_by('FechaNotaRemision','desc');
        
        $query = $this->db->get();
        
        return $query->result_array();
        
    }
    
    public function AsignarCorteNotasRemision($IdCorteCaja)
    {
        $this->db->set('IdCorteCaja',$IdCorteCaja);
        $this->db->where('IdCorteCaja', NULL);
        return $this->db->update($this->table);

    }
    
    public function ConsultarRangosNotasCorte()
    {
        $this->db->select_max('IdNotaRemision','NotaFinal');
        $this->db->select_min('IdNotaRemision','NotaInicial');
        $this->db->from($this->table);
        $this->db->where('IdCorteCaja',NULL);
        $query = $this->db->get();
        
        return $query->row();
    }
}