<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{

  public function __construct(){
    parent::__construct();
    $this->load->model('login_model');
  }

  function index(){
    $this->load->view('login_view');
  }

  function auth(){
    //Recibimos mediante POST las variables para el usuario y la contraseña
    $usuario = $this->input->post('usuario',TRUE);
    $password = md5($this->input->post('password',TRUE));
    //Mediante el modelo de Login validamos el usuario y la contraseña
    $validarUsuario = $this->login_model->validate($usuario,$password);
    //Si obtenemos valores de regreso (es decir, si la validación fue exitosa)
    if($validate->num_rows() > 0){
        $datosUsuario = $validarUsuario->row_array();
        $usuarioNombre= $datosUsuario['vUuarioNombre'];
        $usuarioEmpleado = $datosUsuario['vUsuarioEmpleado'];
        $usuarioNivel = $datosUsuario['vUsuarioNivel'];
        $datosSesion = array(
            'usuario' => $usuarioNombre,
            'empleado' => $usuarioEmpleado,
            'nivel' => $usuarioNivel,
            'logged_in' => TRUE
        );
        $this->session->set_userdata($datosSesion);
        // access login for admin
        if($level === 'ADMINISTRADOR'){
            redirect('sistema/administrador');

        // access login for staff
      }elseif($level === 'VENDEDOR'){
            redirect('sistema/vendedor');
    }else{
        echo $this->session->set_flashdata('msg','Usuario o Contraseña Incorrectos');
        redirect('login');
    }
  }

  function logout(){
      $this->session->sess_destroy();
      redirect('login');
  }

}
