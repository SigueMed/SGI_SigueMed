<?php
/**
* 
*/
class AgendaCitas_Model extends CI_Model
{   //Mcalendar
	//obtener los datos de la bd
	public function getCitas(){
//		$this->db->select('idEvento id, nombre title, fecInicio start, fecFin end, url' );
//		$this->db->from('eventospruebas');
//                    
//		return $this->db->get()->result();
            
                $this->db->select('IdCitaServicio id, DiaCita dia, HoraCita start, MesCita end, AñoCita url');
                $this->db->from('citasservicio');

                return $this->db->get()->result();
	}
                //updEvento
	public function moverFechaCita($param){
		$campos = array(
			'fecInicio' => $param['fecini'],
			'fecFin' => $param['fecfin']
			);

		$this->db->where('idEvento',$param['id']);
		$this->db->update('eventospruebas',$campos);

		if ($this->db->affected_rows() == 1) {
			return 1;
		}else{
			return 0;
		}
	}

        //eliminar cita
	public function deleteCita($id){
		$this->db->where('IdCitaServicio', $id);
		return $this->db->delete('citasservicio');
	}

        //actualizar cita - updEvento2
	public function actualizarCita($param){
		$campos = array(
			'nombre' => $param['nome'],
			'url' => $param['web']
			);

		$this->db->where('idEvento',$param['id']);
		$this->db->update('eventospruebas',$campos);

		if ($this->db->affected_rows() == 1) {
			return 1;
		}else{
			return 0;
		}
	}
        
        //Guardar Cita - agregarEvento
        public function agregarCita($param){
        $campos = array(
            'nombre' => $param['nome'],
            'fecInicio' => $param['fecini'],
            'fecFin' => $param['fecfin'],
            'url' => $param['web'],
        );
        
        $this->db->insert('eventospruebas', $campos);
        
        if ($this->db->affected_rows() == 1) {
			return 1;
		}else{
			return 0;
		}
        }
        
        public function agregarNuevoPaciente($param){
            
        $campos = array(
            'Nombre' => $param['nombre'],
            'Apellido' => $param['apellido'],
            'Telefono' => $param['telefono'],
            
        );
        
        $this->db->insert('paciente', $campos);
        
        if ($this->db->affected_rows() == 1) {
			return 1;
		}else{
			return 0;
		}
        }
        
        
        public function nombrePacienteAutocomplete($nombre){
            $this->db->like('Nombre', $nombre, 'both');
            $this->db->order_by('Nombre', 'ASC');
            $this->db->limit(10);
            return $this->db->get('paciente')->result();
            
        }
        
        public function obtenerServicio(){
            $this->db->order_by('DescripcionServicio', "ASC");
            $query = $this->db->get('servicio');
            return $query->result();
        }
    
}