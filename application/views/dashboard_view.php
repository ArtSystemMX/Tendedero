<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Sign In</title>
    <link href="<?php echo base_url('css/bulma.min.css');?>" rel="stylesheet">
  </head>
  <body>
    <aside class="menu">
      <p class="menu-label">
        Caja
      </p>
      <p class="menu-label">
        Punto de Venta
      </p>
      <?php if($this->session->set_userdata('nivel')==='ADMINISTRADOR'):?>
      <ul class="menu-list">
        <li><a>Catalogos</a></li>
          <ul>
            <li><a>categoriasClientes</a></li>
            <li><a>Clientes</a></li>
            <li><a>Productos</a></li>
            <li><a>Empleados</a></li>
          </ul>
      </ul>
      <p class="menu-label">
        Inventarios
      </p>
      <p class="menu-label">
        Movimientos y Reportes
      </p>
      <?php endif;?>
    </aside>
  </body>
</html>
