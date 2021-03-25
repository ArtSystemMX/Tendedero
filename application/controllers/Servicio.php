<?php

    class Servicio extends CI_Controller{

        public function __construct(){
            parent::__construct();
            $this->load->library('table');
            $this->load->model('servicio_model');
        }

        function insertarServicio(){
            $this->load->model('servicio_model');
            $array=$this->input->post('array');
            $respuesta=$this->servicio_model->insertarServicio($array);
            echo $respuesta;
        }
    
        function modificarServicio(){
            $this->load->model('servicio_model');
            $array=$this->input->post('array');
            $servicioModificarNombre=$this->input->post('servicioModificarNombre');
            $respuesta=$this->servicio_model->modificarServicio($array,$servicioModificarNombre);
            echo $respuesta;
        }
    
        function eliminarServicio(){
            $this->load->model('servicio_model');
            $servicioEliminarNombre=$this->input->post('servicioEliminarNombre');
            $respuesta=$this->servicio_model->eliminarServicio($servicioEliminarNombre);
            echo $respuesta;
        }

        public function tablaServicios(){
            $clave='';
            if($this->input->post('clave')){
              $clave=$this->input->post('clave');
            }
            $this->table->set_heading(array('Servicio', 'Precio','',''));
            $consulta=$this->servicio_model->cargarModuloServicios($clave);
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
        public function cargarModuloServicios(){
            echo ($this->load->view('servicio_view','',TRUE));
        }

    }