<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servicio_model extends CI_Model{

  function cargarModuloServicios($query){
    $data = array();
    $this->db->select("*");
    $this->db->from("tServicio");
    if($query!=''){
      $this->db->like("vServicioNombre",$query);
    }
    $this->db->order_by('vServicioNombre','DESC');
    $consultaBd=$this->db->get();
    if ($consultaBd->num_rows() > 0) {
      foreach ($consultaBd->result_array() as $result) {
        $data[]=array(
          'servicioNombre' => '<b>'.$result['vServicioNombre'].'</b>',
          'servicioPrecio' => $result['deServicioPrecio'],
          'servicioModificar' => '<button type="button" class="modal-button" onclick="mostrarVentanaModificar(\''.$result['vServicioNombre'].'\','.$result['deServicioPrecio'].')" >Modificar</button>',
          'servicioEliminar' => '<button type="button" class="modal-button" onclick="mostrarVentanaEliminar(\''.$result['vServicioNombre'].'\')">Eliminar</button>'
        );
      }
      return $data;
    }
  }

  function insertarServicio($array){
    $data = $this->db->insert("tServicio",$array);
    return $data;
  }

  function modificarServicio($array,$servicioModificarNombre){
    $this->db->where('vServicioNombre',$servicioModificarNombre);
    $data=$this->db->update('tServicio',$array);
    return $data;
  }

  function eliminarServicio($servicioEliminarNombre){
    $this->db->where('vServicioNombre',$servicioEliminarNombre);
    $data=$this->db->delete('tServicio');
  }
}