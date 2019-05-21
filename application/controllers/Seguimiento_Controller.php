<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Seguimiento_Controller
 *
 * @author SigueMED
 */
class Seguimiento_Controller extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        
        $this->load->model('SeguimientoMedico_Model');
        $this->load->helper('date');
    }
    
    /*------------------------------------------------SEGUIMIENTO PACIENTES----------------------------------*/
    
    public function Load_ConsultarSeguimientoPacientes()
    {
        $data['title']='Consulta Seguimientos de Pacientes';
        
        $this->load->view('templates/MainContainer',$data);
        $this->load->view('templates/HeaderContainer',$data);
        $this->load->view('Paciente/CardConsultaSeguimientoPacientes',$data);
        $this->load->view('templates/FormFooter',$data); 
        $this->load->view('templates/FooterContainer');
    }
    
    public function ConsultarSeguimientoPacientes_ajax()
    {
        
        $SeguimientosPaciente = $this->SeguimientoMedico_Model->ConsultarSeguimientosPendientes();
        
        for ($i=0;$i<sizeof($SeguimientosPaciente);$i++)
        {
            switch($SeguimientosPaciente[$i]['IdEstatusSeguimiento'])
            {
                case 1:
                    $SeguimientosPaciente[$i]['Respuesta1']='<button type="button" class="btn btn-primary" id="btnllamar" onclick="ConfirmarSeguimientoPaciente('.$SeguimientosPaciente[$i]['IdSeguimientoMedico'].','.$SeguimientosPaciente[$i]['IdEstatusSeguimiento'].')">Llamar</button>';
                    break;
                case 2:
                    if($SeguimientosPaciente[$i]['Respuesta2']== null && ($SeguimientosPaciente[$i]['IdEstatusSeguimiento']==2))
                    {
                        $SeguimientosPaciente[$i]['Respuesta2']='<button type="button" class="btn btn-primary" id="btnllamar" onclick="ConfirmarSeguimientoPaciente('.$SeguimientosPaciente[$i]['IdSeguimientoMedico'].','.$SeguimientosPaciente[$i]['IdEstatusSeguimiento'].')">Llamar</button>';
                    }
                    else if ($SeguimientosPaciente[$i]['Respuesta3']== null && ($SeguimientosPaciente[$i]['IdEstatusSeguimiento']==2))
                    {
                        $SeguimientosPaciente[$i]['Respuesta3']='<button type="button" class="btn btn-primary" id="btnllamar" onclick="ConfirmarSeguimientoPaciente('.$SeguimientosPaciente[$i]['IdSeguimientoMedico'].','.$SeguimientosPaciente[$i]['IdEstatusSeguimiento'].')">Llamar</button>';
                    }
                    break;
                case 3:
                    break;
            }
            
        }
        
        echo json_encode($SeguimientosPaciente);
        
        
    }
    
    public function ConsultarRespuestasSeguimiento_ajax()
    {
        $RespuestasSeguimiento = $this->CatalogoRespuestaSeguimiento_Model->ConsultarCatalogoRespuestasSeguimiento();
        
        echo json_encode($RespuestasSeguimiento);
    }
    
    public function ConsultarTotalSeguimientos_ajax()
    {
        $TotalSeguimientos = $this->SeguimientoMedico_Model->ConsultarSeguimientosDia();
        
        echo json_encode($TotalSeguimientos);
        
    
    }
    //put your code here
}
