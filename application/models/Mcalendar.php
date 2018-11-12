<?php
/**
* 
*/
class Mcalendar extends CI_Model
{
	//obtener los datos de la bd
	public function getEventos(){
		$this->db->select('idEvento id, nombre title, fecInicio start, fecFin end, url');
		$this->db->from('eventospruebas');

		return $this->db->get()->result();
	}

	public function updEvento($param){
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
	public function deleteEvento($id){
		$this->db->where('idEvento', $id);
		return $this->db->delete('eventospruebas');
	}

        //actualizar cita
	public function updEvento2($param){
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
        
        //Guardar Cita
        public function agregarEvento($param){
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
}