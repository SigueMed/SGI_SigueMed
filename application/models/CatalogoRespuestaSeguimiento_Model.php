<?php //Clase para la tabla catalogorespuestaseguimiento en nuestra base de datos.
Class CatalogoRespuestaSeguimiento_Model extends CI_Model{
    
    //Variables para la tabla y para cada uno de las columnas que la tabla tiene en la BD. 
    private $table;
    
    
    //El constructor se encarga de resumir las acciones de inicializacion de los objetos.
    public function __construct() {
        parent::__construct();
        
        //Igualamos la variable table al nombre de la tabla de nuestra BD.
        $this->table = "catalogorespuestaseguimiento";
        
        //Cargamos la libreria database.
        $this->load->database();
    }
    
    public function ConsultarCatalogoRespuestasSeguimiento()
    {
        $this->db->select($this->table.'.*');
        $this->db->from($this->table);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    /*
    Descripción: Funcion que se encarga de consultar el catalogo de respuesta de seguimiento por id.
    Salida: Devuelve el id del catalogo de respuesta de seguimiento.
    */
    public function ConsultarCatalogoRespuestaSeguimietoPorId($IdRespuestaSeguimiento){
        $condition = "IdRespuestaSeguimiento =" . $IdRespuestaSeguimiento;
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        
        if($query->num_rows() == 1){
            $row = $query->row();
            $this->LoadRow($row);
            return $query->row_array();
        }else{
            return false;
        }
    }
}
