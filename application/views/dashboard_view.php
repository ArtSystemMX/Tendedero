<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>El Tendedero de Luna</title>
  <script src="https://use.fontawesome.com/4a3b3d9687.js"></script>
  <link rel="stylesheet" href="http://tendederodeluna.com/css/css/bulma.min.css" />

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script>
  $(document).ready(function(){
    $("a").click(function(){
      $("a").removeClass('is-active');
      $(this).addClass("is-active");
      //codigo para cargar cada una de las páginas a según la opción del menú a la que se hace click

    });
  });
  </script>

</head>
<body>
  <table class="table" style="width:100%;">
    <tr>
      <td  style="background-color:lavender; width:15%;">
        <aside class="menu">
          <ul class="menu-list">
            <p class="menu-label" style="font-size:21px; margin:5px;">
              Ventas
            </p>
            <li><a class="is-active" name="venta">Punto de Venta</a></li>
            <li><a name="caja">Caja</a></li>
          </ul>
          <?php if($this->session->userdata('nivel')==='ADMINISTRADOR'):?>
            <ul class="menu-list">
              <p class="menu-label" style="font-size:21px; margin:5px">
                Catalogos
              </p>
              <ul>
                <li><a name="clientes">Clientes</a></li>
                <li><a name="productos">Servicios</a></li>
                <li><a name="prendas">Prendas</a></li>
              </ul>
            </ul>
            <ul class="menu-list">
              <p class="menu-label" style="font-size:21px; margin:5px">
                Inventarios
              </p>
              <li><a name="fisico">Fisico</a></li>
              <li><a name="entradas">Entradas</a></li>
              <li><a name="salidas">Salidas</a></li>
            </ul>
            <ul class="menu-list">
              <p class="menu-label" style="font-size:21px; margin:5px">
                Administrador
              </p>
              <li><a name="movimientos">Movimientos</a></li>
              <li><a name="reportes">Reportes</a></li>
            </ul>
          <?php endif;?>
          <ul class="menu-list">
            <p class="menu-label" style="font-size:21px; margin:5px">
              Configuración
            </p>
            <li><a name="ajustes">Ajustes</a></li>
            <li><a href="<?php echo site_url('login/logout');?>" name="logout">Cerrar Sesión</a></li>
          </ul>
        </aside>
      </td>
      <td name="celdaFormulario" style="width:85%">

      </td>
    </tr>
  </table>
</body>
</html>
