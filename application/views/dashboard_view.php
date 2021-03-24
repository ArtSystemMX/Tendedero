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
  <link rel="stylesheet" href="../../css/tabla.css"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script>

    var clienteModificarClave;
    var clienteEliminarClave;

    $(document).ready(function(){
      var columnaVentana = $('td#celdaFormulario');
      var nombreModulo;
      $("a").click(function(){
        $("a").removeClass('is-active');
        $(this).addClass("is-active");
        //Obtenemos el nombre del módulo al que intenta accesar el Usuario
        nombreModulo = $(this).attr('name');
        //codigo para cargar cada una de las páginas a según la opción del menú a la que se hace click
        switch (nombreModulo) {
          //En el caso del módulo de clientes
          case 'clientes':
          //Buscador de cliente
          $("#formulario").html('<table style="width:100%;"><tr><td>' +
          '<button style="font-size=36px;" class="modal-button" name="clienteNuevo" id="clienteNuevo" type="button">Nuevo Cliente</button></td></tr>' +
          '<tr><td><label for="buscadorClientes">Buscar Cliente: </label><input id="buscadorClientes" style="width:100%;" type="text" placeholder="Buscar Cliente..."/></td></tr></table>');
          //Llamada a la función para cargar el módulo clientes
          cargarModuloClientes('');
          break;
          default:
          break;
        }
      });

      $("body").on("click",'.modal-button',function(){
        nombreFuncion=$(this).attr("name");
        switch (nombreFuncion){
          case "clienteNuevo":
            $("#mClienteNuevo").addClass("is-active");
          break;
          case "clienteModificar":
            clienteModificarClave=$(this).attr("idCliente");
            $("#clienteModificarTelefono").val(clienteModificarClave);
            var $row=$(this).closest("tr");
            $("#clienteModificarNombre").val($row.find(".columnaNombre").text());
            $("#mClienteModificar").addClass("is-active");
          break;
          case "clienteEliminar":
            clienteEliminarClave=$(this).attr("idCliente");
            eliminarCliente(clienteEliminarClave);
          default:
          break;
        }
      });

      $(".delete, .is-delete").click(function() {
        $(".modal").removeClass("is-active");
      });

      $("body").on("keyup",'#buscadorClientes',function(){
        var consulta=$(this).val();
        console.log(consulta);
        if(consulta!=''){
          cargarModuloClientes(consulta);
        }else{
          cargarModuloClientes('');
        }
      });


    });

    
    //Función para llamar el módulo clientes, recibe una variable de tipo String
    //donde viene indicada si se busca algún valor en específico
    function cargarModuloClientes(query){
      $.ajax({
        url:"<?php echo site_url('Sistema/cargarModuloClientes');?>",
        method: "POST",
        data:{query:query},
        success:function(data){
          $("#celdaFormulario").html(data);
        },
        error: function(result)
        {
          $("#celdaFormulario").html(result.responseText);
        },
        fail:(function(status) {
          $("#celdaFormulario").html("Fail");
        })

      });
    }

    function insertarCliente(){
      var array={
        vNombre: document.getElementById('clienteNuevoNombre').value.toUpperCase(),
        vTelefono: document.getElementById('clienteNuevoTelefono').value
      };
      $.ajax({
        url:"<?php echo site_url('Sistema/insertarCliente');?>",
        method: "POST",
        data:{array:array},
        success:function(){
          $(".modal").removeClass("is-active");
          cargarModuloClientes("");
        },
        error: function(jqHZR, exception){
          alert("El cliente ya se encuentra registrado.");
        },
        fail:(function(status) {
          alert("wut?");
        })
      });
    }

    function modificarCliente(){
      var array={
        vNombre: document.getElementById('clienteModificarNombre').value.toUpperCase(),
        vTelefono: document.getElementById('clienteModificarTelefono').value
      };
      $.ajax({
        url:"<?php echo site_url('Sistema/modificarCliente'); ?>",
        method: "POST",
        data:{array:array,clienteModificarClave:clienteModificarClave},
        success:function(){
          $(".modal").removeClass("is-active");
          cargarModuloClientes("");
        },
        error: function(jqHZR, exception){
          alert("Ya se encuentra un cliente registrado con el mismo número.");
        },
        fail:(function(status) {
          alert("wut?");
        })
      });
    }

    function eliminarCliente(){
      if(window.confirm("¿Eliminar cliente?")){
        $.ajax({
          url:"<?php echo site_url('Sistema/eliminarCliente'); ?>",
          method: "POST",
          data:{clienteEliminarClave:clienteEliminarClave},
          success:function(){
            $(".modal").removeClass("is-active");
            cargarModuloClientes("");
          },
          error: function(jqHZR, exception){
            alert("Se requieren permisos de administrador para esta acción.");
          },
          fail:(function(status) {
            alert("wut?");
          })
        });
      }
    }

    </script>
  </head>
  <body style="height:100%;">

    <table class="table" style="width:100%; height:100%;">
      <tr>
        <td  style="background-color:lavender; width:15%; height=100%;">
          <aside class="menu">
            <ul class="menu-list">
              <p class="menu-label" style="font-size:18px; margin:3px;">
                Ventas
              </p>
              <li><a class="is-active" name="venta">Punto de Venta</a></li>
              <li><a name="caja">Caja</a></li>
              <li><a name="encargos">Encargos</a></li>
            </ul>
            <?php if($this->session->userdata('nivel')==='ADMINISTRADOR'):?>
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
            <?php endif;?>
            <ul class="menu-list">
              <p class="menu-label" style="font-size:18px; margin:3px">
                Configuración
              </p>
              <li><a name="ajustes">Ajustes</a></li>
              <li><a href="<?php echo site_url('login/logout');?>" name="logout">Cerrar Sesión</a></li>
            </ul>
          </aside>
        </td>
        <td name="modulo" id="modulo" style="width:85%">
          <table style="width:100%;">
            <tr><td name="formulario" id="formulario"></td></tr>
            <tr><td name="celdaFormulario" id="celdaFormulario"></td></tr>
          </table>
        </td>
      </tr>
    </table>

    
    <div class="modal"id="mClienteNuevo">
      <div class="modal-background"></div>
      <div class="modal-card"  style="position:absolute; top:50px;" >
        <header class="modal-card-head" style="background-color: #FF5679;">
          <p class="modal-card-title" style=" color: white;">Nuevo Cliente</p>
          <button class="delete" aria-label="close"></button>
        </header>
        <form action="#" onsubmit="insertarCliente(); return false;">
          <section class="modal-card-body">
            <div>
              <label for="clienteNuevoNombre">Nombre:</label>
              <input class="input is-rounded is-primary" type="text" style="width:100%;  border-color:#FF5679; text-transform: uppercase;" id="clienteNuevoNombre" placeholder="Nombre..." required>
            </div><br>
            <div>
              <label for="clienteNuevoTelefono">Telefono:</label>
              <input class="input is-rounded is-primary" type="text" style="width:100%; border-color:#FF5679; text-transform: uppercase;" id="clienteNuevoTelefono" placeholder="Telefono..." required>
            </div>
          </section>
          <footer class="modal-card-foot">
            <button class="button is-success modal-button">Guardar</button>
            <button class="button is-delete modal-button">Cancelar</button>
          </footer>
        </form>
      </div>
    </div>

    <div class="modal"id="mClienteModificar">
      <div class="modal-background"></div>
      <div class="modal-card"  style="position:absolute; top:50px;" >
        <header class="modal-card-head" style="background-color: #FF5679;">
          <p class="modal-card-title" style="color: white;">Modificar Cliente</p>
          <button class="delete" aria-label="close"></button>
        </header>
        <form action="#" onsubmit="modificarCliente(); return false;">
          <section class="modal-card-body">
            <div>
              <label for="clienteModificarNombre">Nombre:</label>
              <input class="input is-rounded is-primary" type="text" style="width:100%;  border-color:#FF5679; text-transform: uppercase;" id="clienteModificarNombre" placeholder="Nombre..." required>
            </div><br>
            <div>
              <label for="clienteModificarTelefono">Telefono:</label>
              <input class="input is-rounded is-primary" type="text" style="width:100%; border-color:#FF5679; text-transform: uppercase;" id="clienteModificarTelefono" placeholder="Telefono..." required>
            </div>
          </section>
          <footer class="modal-card-foot">
            <button class="button is-success modal-button">Guardar Cambios</button>
            <button class="button is-delete modal-button">Cancelar</button>
          </footer>
        </form>
      </div>
    </div>

  </body>
</html>
