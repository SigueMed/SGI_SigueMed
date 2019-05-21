<?php
class ProductosNotaMedica_Model extends CI_Model{
    private $table;
    
    
    public function __construct(){
        parent::__construct();
        $this->table = "productosnotamedica";
        $this->load->database();
    }
   
      
    public function ConsultarProductosPorNotaMedica($IdNotaMedica)
    {
        $this->db->select ($this->table.'.*, DescripcionProducto, DescripcionServicio, CostoProducto');
        
        $this->db->from($this->table.',catalogoproductos, servicio');
        //JOIN
        $this->db->where($this->table.'.IdProducto = catalogoproductos.IdProducto');
        $this->db->where('catalogoproductos.IdServicio = servicio.IdServicio');
        //Condicion
        $this->db->where($this->table.'.IdNotaMedica='.$IdNotaMedica);
        
        $query = $this->db->get();
        
        return $query->result_array();
        
    }
    
    public function AgregarProductoNotaMedica($IdNotaMedica, $NuevoProductoArray)
            
    {
        
        $NuevoProducto = array(
            'IdNotaMedica'=>$IdNotaMedica,
            'IdProducto'=>$NuevoProductoArray['IdProducto'],
            'precio'=>$NuevoProductoArray['precio'],
            'CantidadProductoNM'=>$NuevoProductoArray['cantidad'],
            'Descuento'=>$NuevoProductoArray['descuento']
            
        );
        $resultado = $this->db->insert($this->table,$NuevoProducto);
        return $resultado;
        
    }
}


