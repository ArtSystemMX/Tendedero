<?php

class Sistema extends CI_Controller{

  public function __construct(){
    parent::__construct();
    //Redirigir a la pagina de LOGIN si no se encuentra una sesión activa
    if($this->session->userdata('logged') !== TRUE){
      redirect('login');
    }
  }

  function administrador(){
    //Permitir acceso solo a usuarios ADMINISTRADORES
    if($this->session->userdata('nivel')=='ADMINISTRADOR'){
      $this->load->view('dashboard_view');
    }else{
      redirect('login');
    }
  }

  function vendedor(){
    //Permitir acceso solo a usuarios VENDEDORES
    if($this->session->userdata('nivel')=='VENDEDOR'){
      $this->load->view('dashboard_view');
    }else{
      redirect('login');
    }
  }

}
