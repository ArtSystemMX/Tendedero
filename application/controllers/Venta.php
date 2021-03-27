<?php

    class Venta extends CI_Controller{

        public function __construct(){
            parent::__construct();
            $this->load->library('table');
            $this->load->model('venta_model');
        }

        public function cargarModuloVenta(){
            echo ($this->load->view('venta_view','',TRUE));
        }

        public function botonesServicios(){
            $consulta=$this->venta_model->cargarServicios();
            $tablaBotones='<table style="padding:0;"><tr>';
            $contador=0;
            foreach ($consulta as $servicio) {
                if ($contador==0) {
                    $tablaBotones=$tablaBotones.'<td style="padding:4px;">'.$servicio['servicioNombre'].'</td>';
                    $contador=1;
                }else{
                    $tablaBotones=$tablaBotones.'<td style="padding:4px;">'.$servicio['servicioNombre'].'</td></tr><tr>';
                    $contador=0;
                }
            }
            $tablaBotones=$tablaBotones.'</tr></table>';
            echo $tablaBotones;
        }

    }
?>