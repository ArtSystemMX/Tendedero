<?php

    class Cliente extends CI_Controller{

        public function __construct(){
            parent::__construct();
            $this->load->library('table');
            $this->load->model('cliente_model');
        }

        function insertarCliente(){
            $this->load->model('cliente_model');
            $array=$this->input->post('array');
            $respuesta=$this->cliente_model->insertarCliente($array);
            echo $respuesta;
        }
    
        function modificarCliente(){
            $this->load->model('cliente_model');
            $array=$this->input->post('array');
            $clienteModificarClave=$this->input->post('clienteModificarClave');
            $respuesta=$this->cliente_model->modificarCliente($array,$clienteModificarClave);
            echo $respuesta;
        }
    
        function eliminarCliente(){
            $this->load->model('cliente_model');
            $clienteEliminarClave=$this->input->post('clienteEliminarClave');
            $respuesta=$this->cliente_model->eliminarCliente($clienteEliminarClave);
            echo $respuesta;
        }

        public function tablaClientes(){
            $clave='';
            if($this->input->post('clave')){
              $clave=$this->input->post('clave');
            }
            $this->table->set_heading(array('Nombre', 'Telefono','',''));
            $consulta=$this->cliente_model->cargarModuloClientes($clave);
            $template = array(
                'table_open' => '<table id="tablaDatos">',
        
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
        
                'table_close' => '</table></td></tr>'
            );
        
            $this->table->set_template($template);
            echo $this->table->generate($consulta);
        }

        public function tablaClientesVenta(){
            $clave='';
            if($this->input->post('clave')){
              $clave=$this->input->post('clave');
            }
            $this->table->set_heading(array('Nombre', 'Telefono',''));
            $consulta=$this->cliente_model->cargarClientesVenta($clave);
            $template = array(
                'table_open' => '<table id="tablaDatos">',
        
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
        
                'table_close' => '</table></td></tr>'
            );
        
            $this->table->set_template($template);
            echo $this->table->generate($consulta);
        }
        public function cargarModuloClientes(){
            echo ($this->load->view('cliente_view','',TRUE));
        }

    }