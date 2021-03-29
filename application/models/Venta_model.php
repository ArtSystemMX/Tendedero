<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Venta_model extends CI_Model{
    function cargarServicios(){
    $data = array();
    $this->db->select("*");
    $this->db->from("tServicio");
    $consultaBd=$this->db->get();
    if ($consultaBd->num_rows() > 0) {
      foreach ($consultaBd->result_array() as $result) {
        $data[]=array(
          'servicioNombre' => '<button style="width:100%; display:inline-block; height:100%;overflow:auto;" class="modal-button" onClick="agregarServicio(\''.$result['vServicioNombre'].'\','.$result['deServicioPrecio'].')">'.$result['vServicioNombre'].'</button>');
      }
      return $data;
    }
  }
}