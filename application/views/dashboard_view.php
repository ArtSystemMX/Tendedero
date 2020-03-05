<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>El Tendedero de Luna</title>
    <script src="https://use.fontawesome.com/4a3b3d9687.js"></script>
    <link rel="stylesheet" href="http://tendederodeluna.com/css/css/bulma.min.css" />
  </head>
  <body>
    <aside class="menu">
      <ul class="menu-list">
        <p class="menu-label">
          Ventas
        </p>
        <li><a>Caja</a></li>
      </ul>
      <ul class="menu-list">
        <li><a>Punto de Venta</a></li>
      </ul>
      <?php if($this->session->userdata('nivel')==='ADMINISTRADOR'):?>
      <ul class="menu-list">
        <p class="menu-label">
          Catalogos
        </p>
          <ul>
            <li><a>Clientes</a></li>
            <li><a>Clientes</a></li>
            <li><a>Productos</a></li>
            <li><a>Empleados</a></li>
          </ul>
      </ul>
      <ul class="menu-list">
        <p class="menu-label">
          Inventarios
        </p>
        <li><a>Fisico</a></li>
        <li><a>Entradas</a></li>
        <li><a>Salidas</a></li>
      </ul>
      <ul class="menu-list">
        <p class="menu-label">
          Administrador
        </p>
        <li><a>Movimientos</a></li>
        <li><a>Reportes</a></li>
        <li><a>Configuracion</a></li>
      </ul>
      <?php endif;?>
    </aside>
  </body>
</html>
