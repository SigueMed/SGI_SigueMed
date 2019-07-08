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
        $this->load->model('Servicio_Model');
        $this->load->model('CatalogoRespuestaSeguimiento_Model');
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
        $Consulta = $this->input->post('TipoConsulta');

        switch ($Consulta) {
          //CONSULTAR SEGUIMIENTOS ABIERTOS
          case '1':
            $SeguimientosPaciente = $this->SeguimientoMedico_Model->ConsultarSeguimientosPendientes();

            break;
          //CONSULTAR LOS SEGUIMIENTOS DEL DIA DE HOY
          case '2':
            $condicion = "seguimientomedico.IdEstatusSeguimiento < 3 AND FechaSeguimiento <= '".mdate('%Y-%m-%d',now())."'";
            $SeguimientosPaciente = $this->SeguimientoMedico_Model->ConsultarSeguimientosPendientes($condicion);

            break;
          //CONSULTAR LOS SEGUIMIENTOS CERRADOS
          case '3':
            $condicion = "seguimientomedico.IdEstatusSeguimiento >=3";
            $SeguimientosPaciente = $this->SeguimientoMedico_Model->ConsultarSeguimientosPendientes($condicion);
            break;
          case '4':
            $condicion = "seguimientomedico.IdEstatusSeguimiento <3";
            $SeguimientosPaciente = $this->SeguimientoMedico_Model->ConsultarSeguimientosPendientes($condicion);
            // code...
            break;

          default:
            // code...
            break;
        }


        for ($i=0;$i<sizeof($SeguimientosPaciente);$i++)
        {
            switch($SeguimientosPaciente[$i]['IdEstatusSeguimiento'])
            {
                case 1:
                    $SeguimientosPaciente[$i]['Respuesta1']='<button type="button" class="btn btn-primary" id="btnllamar" onclick="ConfirmarSeguimientoPaciente('.$SeguimientosPaciente[$i]['IdSeguimientoMedico'].','.$SeguimientosPaciente[$i]['IdEstatusSeguimiento'].',1)">Llamar</button>';
                    break;
                case 2:
                    if($SeguimientosPaciente[$i]['Respuesta2']== null && ($SeguimientosPaciente[$i]['IdEstatusSeguimiento']==2))
                    {
                        $SeguimientosPaciente[$i]['Respuesta2']='<button type="button" class="btn btn-primary" id="btnllamar" onclick="ConfirmarSeguimientoPaciente('.$SeguimientosPaciente[$i]['IdSeguimientoMedico'].','.$SeguimientosPaciente[$i]['IdEstatusSeguimiento'].',2)">Llamar</button>';
                    }
                    else if ($SeguimientosPaciente[$i]['Respuesta3']== null && ($SeguimientosPaciente[$i]['IdEstatusSeguimiento']==2))
                    {
                        $SeguimientosPaciente[$i]['Respuesta3']='<button type="button" class="btn btn-primary" id="btnllamar" onclick="ConfirmarSeguimientoPaciente('.$SeguimientosPaciente[$i]['IdSeguimientoMedico'].','.$SeguimientosPaciente[$i]['IdEstatusSeguimiento'].',3)">Llamar</button>';
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

 //***************************************AJAX*************************************************
    public function ConsultarTotalSeguimientos_ajax()
    {
        $TotalSeguimientos = $this->SeguimientoMedico_Model->ConsultarSeguimientosDia();

        echo json_encode($TotalSeguimientos);


    }

    public function CargarRespuestas_ajax()
    {
        $RespuestasSeguimiento = $this->CatalogoRespuestaSeguimiento_Model->ConsultarCatalogoRespuestasSeguimiento();


        $output='<option value="">Selecciona una opción</option>';
        foreach($RespuestasSeguimiento as $item)
        {
            $output .= '<option value="'.$item['IdRespuestaSeguimiento'].'">'.$item['DescripcionRespuestaSeguimiento'].'</option>';
        }
        echo $output;


    }
 //*******************************************************************************************
    public function ActualizarSeguimiento()
    {
        $action =$this->input->post('action');

        if ($action =='GuardarSeguimiento')
        {
            $IdSeguimiento = $this->input->post('ModalLlamada_IdSeguimientoMedico');
            $FechaLlamada = $this->input->post('ModalLlamada_FechaLlamada');
            $IdRespuestaSeguimiento = $this->input->post('ModalLlamada_cbRespuestaLlamada');
            $Comentarios = $this->input->post('ModalLamada_Comentarios');
            $IdEstatusSegumiento = $this->input->post('ModalLlamada_cbEstatusSeguimiento');
            $FechaSeguimiento = $this->input->post('ModalLlamada_FechaSigLlamada');
            $NumeroSeguimiento = $this->input->post('NumeroSeguimiento');

            $EstatusSeguimiento = array(

                'FechaRespuesta_'.$NumeroSeguimiento=> $FechaLlamada,
                'IdRespuestaSeguimiento_'.$NumeroSeguimiento=>$IdRespuestaSeguimiento,
                'Respuesta_'.$NumeroSeguimiento=>$Comentarios,
                'IdEmpleado_'.$NumeroSeguimiento=>$this->session->userdata('IdEmpleado'),
                'FechaSeguimiento'=> $FechaSeguimiento,
                'IdEstatusSeguimiento'=>$IdEstatusSegumiento
                    );



            $result = $this->SeguimientoMedico_Model->ActualizarSeguimiento($IdSeguimiento,$EstatusSeguimiento);

            if ($result >= 1)
            {
                echo "<script>
                    alert('Seguimiento actualizado');
                    window.location.href='".site_url('Paciente/SeguimientoPaciente')."';
                    </script>";
            }
        }
        else
        {
            redirect(site_url('Paciente/SeguimientoPaciente'));
        }

    }

    public function AgregarNuevoSeguimiento()
    {
        $IdPaciente = $this->input->post('idPaciente');
        $IdServicio = $this->input->post('IdServicio');
        $DescripcionSeguimiento = $this->input->post('DescripcionSeguimiento');
        $FechaSeguimiento = $this->input->post('FechaSeguimiento');
        $PrioridadSeguimiento = $this->input->post('cbPrioridadSeguimiento');

        $Seguimiento = array(
            'DescripcionSeguimiento'=> $DescripcionSeguimiento,
            'IdServicio'=>$IdServicio,
            'IdPaciente' => $IdPaciente,
             'IdEstatusSeguimiento'=>1,
             'IdElaboradoPor'=> $this->session->userdata('IdEmpleado'),
             'FechaSeguimiento' => $FechaSeguimiento,
             'IdClinica'=>$this->session->userdata('IdClinica'),
             'Prioridad'=>$PrioridadSeguimiento);

        $this->SeguimientoMedico_Model->InsertarSeguimiento($Seguimiento);

         echo "<script>
            alert('Se ha registrado el nuevo seguimiento');
            window.location.href='".site_url('Paciente/SeguimientoPaciente')."';
            </script>";

    }

    public function CargarServicios_ajax()
    {
        $Servicios = $this->Servicio_Model->ConsultarServicios();

        $output='<option value="">Selecciona un Producto</option>';
        foreach($Servicios as $servicio)
        {
            $output .= '<option value="'.$servicio['IdServicio'].'">'.$servicio['DescripcionServicio'].'</option>';
        }
        echo $output;
    }

    public function EditarSeguimiento_ajax()
    {

      $IdSeguimiento = $this->input->post('IdSeguimiento');
      $DescripcionSeguimiento =$this->input->post('DescripcionSeguimiento');

      $this->SeguimientoMedico_Model->EditarDescripcionSeguimiento($IdSeguimiento,$DescripcionSeguimiento);


      // code...
    }

    public function EliminarSeguimiento_ajax()
    {

      $IdSeguimiento = $this->input->post('IdSeguimiento');

      $this->SeguimientoMedico_Model->EliminarSeguimiento($IdSeguimiento);
      // code...
    }
}
