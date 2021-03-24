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
          'clienteNombre' => '<b class="columnaNombre">'.$result['vNombre'].'</b>',
          'clienteTelefono' => $result['vTelefono'],
          'clienteModificar' => '<button type="button" class="modal-button" idCliente="' . $result['vTelefono'] . '" name="clienteModificar" value="clienteModificar">Modificar</button>',
          'clienteEliminar' => '<button type="button" class="modal-button" idCliente="' . $result['vTelefono'] . '" name="clienteEliminar" value="clienteEliminar">Eliminar</button>'
        );
      }
      return $data;
    }
  }

  function insertarCliente($array){
    $data = $this->db->insert("tCliente",$array);
    return $data;
  }

  function modificarCliente($array,$claveCliente){
    $this->db->where('vTelefono',$claveCliente);
    $data=$this->db->update('tCliente',$array);
    return $data;
  }

  function eliminarCliente($clienteEliminarClave){
    $this->db->where('vTelefono',$clienteEliminarClave);
    $data=$this->db->delete('tCliente');
  }

  function cargarModuloServicios($query){

  }

  function cargarModuloEmpleados($query){
    
  }

  function cargarModuloEncargos($query){
    
  }

}
