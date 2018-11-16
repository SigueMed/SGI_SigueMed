<?php
/**
* 
*/
class AgendaCitas_controller extends CI_Controller
{
    
    
	//Ccalendar
	function __construct()
	{
		parent::__construct();
		$this->load->model('agendacitas_model');
	}

	public function index(){
                //crear variable - mostrar los servicios en el dropdown 
                $data['servicio']= $this->agendacitas_model->obtenerServicio();
		$this->load->view('AgendaCitas', $data);
                
               
	}

	public function getCitas(){
		$r = $this->agendacitas_model->getCitas();
		echo json_encode($r);
	}

	public function moverFechaCita(){
		$param['id'] = $this->input->post('id');
		$param['fecini'] = $this->input->post('fecini');
		$param['fecfin'] = $this->input->post('fecfin');

		$r = $this->agendacitas_model->moverFechaCita($param);

		echo $r;
	}

	public function deleteCita(){
		$id = $this->input->post('id');
		$r = $this->agendacitas_model->deleteCita($id);
		echo $r;
	}

	public function actualizarCita(){
		$param['id'] = $this->input->post('id');
		$param['nome'] = $this->input->post('nom');
		$param['web'] = $this->input->post('web');

		$r = $this->agendacitas_model->actualizarCita($param);

		echo $r;
	}
        
        public function agregarCita(){
        $param['nome'] = $this->input->post('nom');
        $param['fecini'] = $this->input->post('fecini');
	$param['fecfin'] = $this->input->post('fecfin');
        $param['web'] = $this->input->post('web');
        
        
        $r = $this->agendacitas_model->agregarCita($param);
        echo $r;
    }
    
    public function agregarNuevoPaciente(){
        
        $param['nombre'] = $this->input->post('nombre');
        $param['apellido'] = $this->input->post('apellido');
	$param['telefono'] = $this->input->post('telefono');
        

        $r = $this->agendacitas_model->agregarNuevoPaciente($param);
        echo $r;
    }
    
    public function nombrePacienteAutocomplete(){
        if(isset($_GET['term'])){
            $result = $this->agendacitas_model->nombrePacienteAutocomplete($_GET['term']);
            if(count($result)>0){
                foreach ($result as $row)
                $arr_result[] = $row->Nombre;
            echo json_encode($arr_result);
            }
        }
    }
    
    
}