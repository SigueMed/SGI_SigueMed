<?php
class CatalogoProductos_model extends CI_Model{
    private $table;
   
    
     public function __construct() {
        parent::__construct();
        $this->table = "catalogoproductos";
        $this->load->database();

    }
    
  
     public function ConsultarCatalogoporproducto($IdProducto){
        $condition = "IdProducto =" . $IdProducto;
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        
        if ($query->num_rows() == 1){
            $row = $query->row();
            $this->LoadRow($row);
            return $query->row_array();
        }else{
            return false;
        }
    }
    
    public function ConsultarProductosPorServicio($IdServicio)
    {
        $this->db->select($this->table.'.*, DescripcionServicio');
        $this->db->from($this->table.',Servicio');
        $this->db->where($this->table.'.IdServicio=Servicio.IdServicio');
        $this->db->where($this->table.'.IdServicio', $IdServicio);
        
        $query= $this->db->get();
        
        return $query->result_array();
    }
    
    public function CargarListaProductosPorServicio($IdServicio)
    {
        $this->db->select($this->table.'.*, DescripcionServicio');
        $this->db->from($this->table.',Servicio');
        $this->db->where($this->table.'.IdServicio=Servicio.IdServicio');
        $this->db->where($this->table.'.IdServicio', $IdServicio);
        
        $query= $this->db->get();
        
        return $query->result_array();
        
       
    }
}
