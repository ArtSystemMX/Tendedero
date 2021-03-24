<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model{

  //Función para verificar Usuario y Contraseña
  function validate($usuario,$password){
    $this->db->where('vUsuarioNombre',$usuario);
    //Hacemos un hash en md5 para comprarar las contraseñas almacenadas con la ingresada
    $this->db->where('vUsuarioPassword', $password);
    //Almacenamos y devolvemos los resultados de la consulta
    $result = $this->db->get('tUsuario',1);
    return $result;
  }

}
