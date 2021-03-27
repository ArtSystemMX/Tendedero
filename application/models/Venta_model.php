<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Venta_model extends CI_Model{
    function cargarServicios(){
    $data = array();
    $this->db->select("*");
    $this->db->from("tServicio");
    $this->db->order_by('vServicioNombre','ASC');
    $consultaBd=$this->db->get();
    if ($consultaBd->num_rows() > 0) {
      foreach ($consultaBd->result_array() as $result) {
        $data[]=array(
          'servicioNombre' => '<button style="font-size:1vw; width:100%; overflow:auto;" class="modal-button" onClick="agregarProducto(\''.$result['vServicioNombre'].'\','.$result['deServicioPrecio'].')">'.$result['vServicioNombre'].'</button>');
      }
      return $data;
    }
  }
}