<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sistema_model extends CI_Model{

  function cargarModuloClientes($query){
    $data = array();
    $this->db->select("*");
    $this->db->from("tCliente");
    if($query!=''){
      $this->db->like("clienteNombre",$query);
      $this->db->or_like("clienteTelefono",$query);
    }
    $this->db->order_by('clienteCodigo','DESC');
    $consultaBd=$this->db->get();
    if ($consultaBd->num_rows() > 0) {
      foreach ($consultaBd->result_array() as $result) {
        $data[]=array(
          'clienteCodigo' => $result['clienteCodigo'],
          'clienteNombre' => $result['clienteNombre'],
          'clienteTelefono' => $result['clienteTelefono'],
          'clienteModificar' => '<form action="modificar/'.$result['clienteCodigo'].'" method="POST"><input class="Submit" type="Submit" value="Modificar"/></form>',
          'clienteEliminar' => '<form action="eliminar/'.$result['clienteCodigo'].'" method="POST"><input class="Submit" type="Submit" value="Eliminar"/></form>'
        );
      }
      return $data;
    }
  }

}
