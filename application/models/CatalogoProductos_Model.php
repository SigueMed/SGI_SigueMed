<?php
class CatalogoProductos_Model extends CI_Model{
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
        $this->db->select($this->table.'.*, DescripcionServicio,gs.EsProveedor');
        $this->db->select('DescripcionTipoProducto, RequiereReceta');
        $this->db->from($this->table);
        $this->db->join('servicio s','s.IdServicio ='.$this->table.'.IdServicio');
        $this->db->join('gruposervicio gs','s.IdGrupoServicio = gs.IdGrupoServicio');
        $this->db->join('catalogotipoproducto ctp','ctp.IdTipoProducto ='.$this->table.'.IdTipoProducto','left');
        $this->db->where($this->table.'.IdServicio', $IdServicio);
        $this->db->order_by('DescripcionProducto','asc');

        $query= $this->db->get();

        return $query->result_array();
    }

    public function ConsultarProductoPorId($IdProducto)
    {
        $this->db->select($this->table.'.*');
        $this->db->select('subproducto.IdCodigoSubProducto, gs.EsProveedor');
        $this->db->from($this->table);
        $this->db->join('subproducto',$this->table.'.IdProducto = subproducto.IdProducto','left');
        $this->db->join('servicio s', $this->table.'.IdServicio = s.IdServicio');
        $this->db->join('gruposervicio gs', 'gs.IdGrupoServicio = s.IdGrupoServicio');
        $this->db->where($this->table.'.IdProducto', $IdProducto);


        $query= $this->db->get();

        return $query->row();
    }

    public function CargarListaProductosPorServicio($IdServicio)
    {
        $this->db->select($this->table.'.*, DescripcionServicio');
        $this->db->from($this->table.',Servicio');
        $this->db->where($this->table.'.IdServicio=Servicio.IdServicio');
        $this->db->where($this->table.'.IdServicio', $IdServicio);
        $this->db->order_by('DescripcionProducto','asc');

        $query= $this->db->get();

        return $query->result_array();


    }

    /*
     * DESCRIPCION: Consultar los productos que tengan subproductos y movimientos de inventario
     * RETURN: Array con la información de los Productos y su existencia
     */
    public function ConsultarProductosInventario($IdClinica)
    {
        $query = $this->db->query('call ConsultarExistenciaInventario('.$IdClinica.')');
        return $query->result_array();

    }

    public function ConsultarResumenProductosServicio($IdCorteCaja)
    {
        $this->db->select('DescripcionServicio, DescripcionProducto, SUM(Cantidad) as TotalProducto');
        $this->db->from($this->table);
        $this->db->join('servicio s',$this->table.'.IdServicio = s.IdServicio');
        $this->db->join('detallenotaremision dn',$this->table.'.IdProducto = dn.IdProducto');
        $this->db->join('notaremision nr','nr.IdNotaRemision = dn.IdNotaRemision');
        $this->db->group_by('DescripcionServicio, DescripcionProducto');
        $this->db->where('nr.IdCorteCaja',$IdCorteCaja);
        $this->db->where('nr.IdEstatusNotaRemision <> 2');
        $this->db->order_by('DescripcionServicio','ASC');
        $this->db->order_by('DescripcionProducto','ASC');


        $query = $this->db->get();
        return $query->result_array();
    }

    public function AgregarNuevoProducto($NuevoProducto_Array)
    {
        $this->db->insert($this->table,$NuevoProducto_Array);

        return $this->db->insert_id();
    }

    public function ActualizarProducto($IdProducto,$Producto)
    {
        $this->db->where ('IdProducto',$IdProducto);
        return $this->db->update($this->table,$Producto);

    }

    public function ActualizarPrecios_Batch($NuevosPrecios)
    {
      return $this->db->update_batch($this->table,$NuevosPrecios,'IdProducto');
      // code...
    }

    public function ConsultarProductosPuntoVenta($IdFoliador,$IdClinica)
    {
      $this->db->select($this->table.'.*, DescripcionServicio, EsProveedor');
      $this->db->from($this->table);
      $this->db->join('servicio',$this->table.'.IdServicio = servicio.IdServicio');
      $this->db->join('folioservicio','servicio.IdServicio = folioservicio.IdServicio');
      $this->db->join('gruposervicio gs','gs.IdGrupoServicio = servicio.IdGrupoServicio');
      $this->db->where($this->table.'.Habilitado', true);
      $this->db->where('servicio.Habilitado', true);
      $this->db->where('folioservicio.IdFoliador',$IdFoliador);
      $this->db->where('folioservicio.IdClinica',$IdClinica);
      $this->db->order_by('DescripcionProducto','asc');

      $query= $this->db->get();

      return $query->result_array();
    }
}
