<body>
        <!-- Header -->
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">SigueMED</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
        <li><a href="#">Citas</a></li>
        <li><a href="lista_pacientes.php">Listas</a></li>
        <li><a href="#">Page 3</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="registro.php"><span class="glyphicon glyphicon-user"></span>Nombre</a></li>
    </ul>
  </div>
</nav>
  <!-- Header -->
    
    
<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;}

input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

button:hover {
    opacity: 0.8;
}

.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}

.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
}

img.avatar {
    width: 40%;
    border-radius: 50%;
}

.container {
    padding: 16px;
}

span.psw {
    float: right;
    padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
       display: block;
       float: none;
    }
    .cancelbtn {
       width: 100%;
    }
}
</style>
    <?php
        if (isset($errorMessage)) {
            echo "<div class='message'>";
            echo $errorMessage;
            echo "</div>";
        }
    ?>
    
    <table>
        <tr>
            <th>Hora</th>
            <th>Paciente</th>
            <th>Servicio</th>
            <th>Nota Medica</th>
            <th>Estatus</th>
        </tr>
        <?php
        
            if ($this->session->has_userdata('logged_in'))
            {
                $SessionData = $this->session->userdata('logged_in');
                echo '<h1>Si hay datos </h1>';
                echo '<h2>'.$this->session->userdata('IdPerfil').'</h2>';
            }
            else
            {
                echo '<h1>Datos Borrados</h1>';
            }
            

            foreach($Citas as $Cita_item)
            {
                echo "<tr>";
                echo "<td>".date('H:i',strtotime($Cita_item['HoraCita']))."</td>";
                echo "<td>".$Cita_item['Nombre'].' '.$Cita_item['Apellidos']."</td>";
                echo "<td>".$Cita_item['DescripcionServicio']."</td>";
                echo "<td>".$Cita_item['IdNotaMedica']."</td>";
                echo "<td>"; 
                    if ($Cita_item['IdStatusCita'] == AGENDADA)
                    {
                        echo  "<a href=".site_url('Agenda/ConfirmarCita/'.$Cita_item['IdCitaServicio']).">".$Cita_item['DescripcionEstatusCita']."</a>";

                    }
                    else
                    {
                        if($Cita_item['IdStatusCita']== CONFIRMADA)
                        {
                            echo "<a href=".site_url('NotaMedica/Registrar/'.$Cita_item['IdCitaServicio']).">".$Cita_item['DescripcionEstatusCita']."</a>";
                        }
                        else
                        {

                        echo $Cita_item['DescripcionEstatusCita'];
                        }
                    }
                echo "</td>";
                 
                if($Cita_item['IdStatusCita']== REGISTRADA)
                {
                    
                    //$this->load->model('Servicio_Model');
                    if ($this->session->userdata('IdPerfil')== MEDICO) //Administrador
                    {
                        echo "<td>";
                        echo "<a href=".site_url('NotaMedica/ElaborarNota/'.$Cita_item['IdCitaServicio']).">Crear Nota</a>";
                        echo "</td>";
                    }
                   
                }
               
                echo "</tr>";
            }
        ?>
        
    </table>
    
    
    
</body>