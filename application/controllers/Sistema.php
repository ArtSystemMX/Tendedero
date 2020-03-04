<?php

class Sistema extends CI_Controller{

  public function __construct(){
    parent::__construct();
    $this->load->library('session');
    //Redirigir a la pagina de LOGIN si no se encuentra una sesión activa
    if($this->session->userdata(3) !== TRUE){
      //redirect('login');
      echo $this->session->userdata(3);
      //echo $this->session->userdata();
    }
  }

  function administrador(){
    //Permitir acceso solo a usuarios ADMINISTRADORES
    if($this->session->userdata('nivel')=='ADMINISTRADOR'){
      $this->load->view('dashboard_view');
    }else{
      echo $this->session->userdata('nivel');
      echo "Acceso Denegado";
    }
  }

  function vendedor(){
    //Permitir acceso solo a usuarios VENDEDORES
    if($this->session->userdata('nivel')=='VENDEDOR'){
      $this->load->view('dashboard_view');
    }else{
      echo "Acceso Denegado";
    }
  }

}
