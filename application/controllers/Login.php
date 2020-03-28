<?php

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
    if($validarUsuario->num_rows() > 0){
      $datosUsuario = $validarUsuario->row_array();
      $usuarioNombre= $datosUsuario['vUsuarioNombre'];
      $usuarioEmpleado = $datosUsuario['vUsuarioEmpleado'];
      $usuarioNivel = $datosUsuario['vUsuarioNivel'];
      $datosSesion = array(
        'usuario' => $usuarioNombre,
        'empleado' => $usuarioEmpleado,
        'nivel' => $usuarioNivel,
        'logged' => TRUE
      );
      $this->session->set_userdata($datosSesion);
      var_dump($this->session->userdata());
      if($this->session->userdata('nivel') === 'ADMINISTRADOR'){
        redirect('sistema/administrador');

      }elseif($usuarioNivel === 'VENDEDOR'){
        redirect('sistema/vendedor');
      }else{
        echo $this->session->set_flashdata('msg','Usuario o Contraseña Incorrectos');
        redirect('login');
      }
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
