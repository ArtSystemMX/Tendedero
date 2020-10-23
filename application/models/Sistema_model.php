<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sistema_model extends CI_Model{

  function cargarModuloClientes($query){
    $data = array();
    $this->db->select("*");
    $this->db->from("tCliente");
    if($query!=''){
      $this->db->like("vNombre",$query);
      $this->db->or_like("vTelefono",$query);
    }
    $this->db->order_by('vNombre','DESC');
    $consultaBd=$this->db->get();
    if ($consultaBd->num_rows() > 0) {
      foreach ($consultaBd->result_array() as $result) {
        $data[]=array(
          'clienteNombre' => $result['vNombre'],
          'clienteTelefono' => $result['vTelefono'],
          'clienteModificar' => '<form action="modificar/'.$result['vTelefono'].'" method="POST"><input class="Submit" type="Submit" value="Modificar"/></form>',
          'clienteEliminar' => '<form action="eliminar/'.$result['vTelefono'].'" method="POST"><input class="Submit" type="Submit" value="Eliminar"/></form>'
        );
      }
      return $data;
    }
  }

  function cargarModuloServicios($query){

  }

  function cargarModuloEmpleados($query){
    
  }

  function cargarModuloEncargos($query){
    
  }

}
