<?php //Clase para la tabla catalogoantecedentes en nuestra base de datos.
Class CatalogoAntecedentes_Model extends CI_Model{
    
    //Variables para la tabla y para cada uno de las columnas que la tabla tiene en la BD. 
    private $table;
    public $IdAntecedente;
    public $DescripcionAntecedente;
    public $IdServicio;
    
    //El constructor se encarga de resumir las acciones de inicializacion de los objetos.
    public function __construct() {
        parent::__construct();
        
        //Igualamos la variable table al nombre de la tabla de nuestra BD.
        $this->table = "CatalogoAntecedente";
        
        //Cargamos la libreria database.
        $this->load->database();
    }
    
    /*
    Descripción: Funcion que se encarga de cargar los datos de la tabla; 
    igualando las variables al nombre de las columnas.
    */ 
    public function LoadRow($row){
        $this->IdAntecedente = $row->IdAntecedente;
        $this->DescripcionAntecedente = $row->DescripcionAntecedente;
        $this->IdServicio = $row->IdServicio;
    }
    
    
    /*
    Descripción: Funcion que se encarga de consultar el catalogo del antecedente por id.
    Salida: Devuelve el id del catalogo de antecedentes.
    */
    public function ConsultarCatalogoAntecedentesPorId($IdAntecedente){
        $condition = "IdAntecedente =" . $IdAntecedente;
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        
        if($query->num_rows()==1){
            $row = $query->row();
            $this->LoadRow($row);
            return $query->row_array();
        }else{
            return false;
        }
    }
}