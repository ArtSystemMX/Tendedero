<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sistema extends CI_Controller{

  public function __construct(){
    parent::__construct();
    //Redirigir a la pagina de LOGIN si no se encuentra una sesión activa
    if($this->session->userdata('logged_in') !== TRUE){
      redirect('login');
    }
  }

  function administrador(){
    //Permitir acceso solo a usuarios ADMINISTRADORES
      if($this->session->userdata('level')==='ADMINISTRADOR'){
          $this->load->view('administrador_view');
      }else{
          echo "Acceso Denegado";
      }
  }

  function vendedor(){
    //Permitir acceso solo a usuarios VENDEDORES
      if($this->session->userdata('level')==='VENDEDOR'){
          $this->load->view('vendedor_view');
      }else{
          echo "Acceso Denegado";
      }
  }

}
