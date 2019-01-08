<?php
class ProductosNotaMedica_Model extends CI_Model{
    private $table;
    private $IdProducto;
    private $CantidadProductoNM;
    private $Descuento;
    private $IdNotaMedica;
    
    private function LoadRow($row){
        $this->IdProducto = $row->IdProducto;
        $this->CantidadProductoNM = $row->CantidadProductoNM;
        $this->Descuento = $row->Descuento;
        $this->IdNotaMedica = $row->IdNotaMedica;
    }
    
    public function __construct(){
        parent::__construct();
        $this->table = "productosnotamedica";
        $this->load->database();
    }
    
    public function ConsultarProductobyId($IdProducto){
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
    
    public function ConsultarProductosPorNotaMedica($IdNotaMedica)
    {
        $this->db->select ($this->table.'.*, DescripcionProducto, DescripcionServicio, CostoProducto');
        $this->db->from($this->table.',catalogoproductos, servicio');
        //JOIN
        $this->db->where($this->table.'.IdProducto = catalogocroductos.IdProducto');
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


