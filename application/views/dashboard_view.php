<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>El Tendedero de Luna</title>
  <script src="https://use.fontawesome.com/4a3b3d9687.js"></script>
  <link rel="stylesheet" href="http://tendederodeluna.com/css/css/bulma.min.css" />
  <link rel="stylesheet" href="../../css/tabla.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      var nombreModulo;
      $("a").click(function() {
        $("a").removeClass('is-active');
        $(this).addClass("is-active");
        //Obtenemos el nombre del módulo al que intenta accesar el Usuario
        nombreModulo = $(this).attr('name');
        //codigo para cargar cada una de las páginas a según la opción del menú a la que se hace click
        switch (nombreModulo) {
          //En el caso del módulo de clientes
          case 'clientes':
            //Llamada a la función para cargar el módulo clientes
            cargarModuloClientes();
            break;
          case 'servicios':
            cargarModuloServicios();
            break;
          case 'venta':
            cargarModuloVenta();
            break;
          default:
            break;
        }
      });
    });

    //Función para llamar el módulo clientes, recibe una variable de tipo String
    //donde viene indicada si se busca algún valor en específico
    function cargarModuloClientes() {
      $.ajax({
        url: "<?php echo site_url('Cliente/cargarModuloClientes'); ?>",
        success: function(result) {
          $("#celdaFormulario").html(result);
        },
        error: function(result) {
          $("#celdaFormulario").html(result.responseText);
        },
        fail: (function(status) {
          $("#celdaFormulario").html("Fail");
        })

      });
    }

    function cargarModuloServicios() {
      $.ajax({
        url: "<?php echo site_url('Servicio/cargarModuloServicios'); ?>",
        success: function(result) {
          $("#celdaFormulario").html(result);
        },
        error: function(result) {
          $("#celdaFormulario").html(result.responseText);
        },
        fail: (function(status) {
          $("#celdaFormulario").html("Fail");
        })
      });
    }

    function cargarModuloVenta(){
      $.ajax({
        url: "<?php echo site_url('Venta/cargarModuloVenta'); ?>",
        success: function(result){
          $("#celdaFormulario").html(result);
        },
        error: function(result){
          $("#celdaFormulario").html(result.responseText);
        },
        fail: (function(status){
          $("#celdaFormulario").html("Fail");
        })
      });
    }
  </script>
</head>

<body style="height:100%;">

  <table class="table" style="width:100%; height:100%;">
    <tr>
      <td style="background-color:lavender; width:10%; height:100%;">
        <aside class="menu">
          <ul class="menu-list">
            <p class="menu-label" style="font-size:18px; margin:3px;">
              Ventas
            </p>
            <li><a class="is-active" name="venta">Punto de Venta</a></li>
            <li><a name="caja">Caja</a></li>
            <li><a name="encargos">Encargos</a></li>
          </ul>
          <?php if ($this->session->userdata('nivel') === 'ADMINISTRADOR') : ?>
            <ul class="menu-list">
              <p class="menu-label" style="font-size:18px; margin:3px">
                Catalogos
              </p>
              <ul>
                <li><a name="clientes">Clientes</a></li>
                <li><a name="servicios">Servicios</a></li>
                <!--<li><a name="insumos">Insumos</a></li>-->
              </ul>
            </ul>
            <!--<ul class="menu-list">
                <p class="menu-label" style="font-size:18px; margin:3px">
                  Inventarios
                </p>
                <li><a name="fisico">Fisico</a></li>
                <li><a name="entradas">Entradas</a></li>
                <li><a name="salidas">Salidas</a></li>
              </ul>-->
            <ul class="menu-list">
              <p class="menu-label" style="font-size:18px; margin:3px">
                Administrador
              </p>
              <li><a name="movimientos">Movimientos</a></li>
              <li><a name="reportes">Reportes</a></li>
            </ul>
          <?php endif; ?>
          <ul class="menu-list">
            <p class="menu-label" style="font-size:18px; margin:3px">
              Configuración
            </p>
            <li><a name="ajustes">Ajustes</a></li>
            <li><a href="<?php echo site_url('login/logout'); ?>" name="logout">Cerrar Sesión</a></li>
          </ul>
        </aside>
      </td>
      <td name="modulo" id="modulo" style="width:95%">
        <table style="width:100%; height:100%">
          <tr>
            <td name="celdaFormulario" id="celdaFormulario"></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>

</html>