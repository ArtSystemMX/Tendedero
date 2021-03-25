<?php

class Sistema extends CI_Controller{

  public function __construct(){
    parent::__construct();
    $this->load->model('login_model');
    $this->load->library('table');
    //Redirigir a la pagina de LOGIN si no se encuentra una sesión activa
    if($this->session->userdata('logged') !== TRUE){
      redirect('login');
    }
  }

  function administrador(){
    //Cargar la página con las opciones de ADMINISTRADOR, redirigir si se
    //intenta acceder con un nivel distinto
    if($this->session->userdata('nivel')=='ADMINISTRADOR'){
      $this->load->view('dashboard_view');
    }else{
      redirect('login');
    }
  }

  function vendedor(){
    //Cargar la página con las opciones de VENDEDOR, redirigir si se
    //intenta acceder con un nivel distinto
    if($this->session->userdata('nivel')=='VENDEDOR'){
      $this->load->view('dashboard_view');
    }else{
      redirect('login');
    }
  }
}
