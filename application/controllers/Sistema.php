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

  function cargarModuloClientes(){

    $query='';
    $this->load->model('sistema_model');
    if($this->input->post('query')){
      $query=$this->input->post('query');
    }
    $this->table->set_heading(array('Nombre', 'Telefono','Modificar','Eliminar'));
    $consulta = $this->sistema_model->cargarModuloClientes($query);
    $template = array(
      'table_open' => '<style>
                        #clientes {
                        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
                        border-collapse: collapse;
                        width: 100%;
                        }

                        #botones{
                          align:"right";
                          }

                        #clientes td, #clientes th {
                        border: 1px solid #ddd;
                        padding: 8px;
                        }

                        #clientes tr:nth-child(even){background-color: #f2f2f2;}

                        #clientes tr:hover {background-color: #ddd;}

                        #clientes th {
                        padding-top: 12px;
                        padding-bottom: 12px;
                        text-align: left;
                        background-color: #FF5679;
                        color: white;
                        }

                        input[type=submit] {
                        width: 100%;
                        background-color: #FF5679;
                        color: white;
                        padding: 5px 5px;
                        margin: 8px 0;
                        border: none;
                        border-radius: 4px;
                        cursor: pointer;
                        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
                        font-size:16px;
                      }
                      input[type=text]{
                        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
                        font-size:16px;
                        }

                        input[type=submit]:hover {
                          background-color: #FF8099;
                        }

                      </style><table id="clientes">',

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
