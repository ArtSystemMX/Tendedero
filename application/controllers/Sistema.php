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

  function insertarCliente(){
    $this->load->model('sistema_model');
    $array=$this->input->post('array');
    $respuesta=$this->sistema_model->insertarCliente($array);
    echo $respuesta;
  }

  function modificarCliente(){
    $this->load->model('sistema_model');
    $array=$this->input->post('array');
    $clienteModificarClave=$this->input->post('clienteModificarClave');
    $respuesta=$this->sistema_model->modificarCliente($array,$clienteModificarClave);
    echo $respuesta;
  }

  function eliminarCliente(){
    $this->load->model('sistema_model');
    $clienteEliminarClave=$this->input->post('clienteEliminarClave');
    $respuesta=$this->sistema_model->eliminarCliente($clienteEliminarClave);
    echo $respuesta;
  }

  function cargarModuloClientes(){

    $query='';
    $this->load->model('sistema_model');
    if($this->input->post('query')){
      $query=$this->input->post('query');
    }
    $this->table->set_heading(array('Nombre', 'Telefono','',''));
    $consulta = $this->sistema_model->cargarModuloClientes($query);
    $template = array(
      'table_open' => '<table id="clientes">',

      'thead_open' => '<thead>',
      'thead_close' => '</thead>',

      'heading_row_start' => '<tr>',
      'heading_row_end' => '</tr>',
      'heading_cell_start' => '<th>',
      'heading_cell_end' => '</th>',

      'tbody_open' => '<tbody>',
      'tbody_close' => '</tbody>',

      'row_start' => '<tr>',
      'row_end' => '</tr>',
      'cell_start' => '<td>',
      'cell_end' => '</td>',

      'row_alt_start' => '<tr>',
      'row_alt_end' => '</tr>',
      'cell_alt_start' => '<td>',
      'cell_alt_end' => '</td>',

      'table_close' => '</table>'
    );

    $this->table->set_template($template);
    echo $this->table->generate($consulta);
  }

}
