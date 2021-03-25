<script>



    function buscarCliente(obj){
        var consulta = $(obj).val();
        console.log(consulta);
        if (consulta != '') {
            cargarTablaClientes(consulta);
        } else {
        }
    }

    function cerrarModal(){
        $(".modal").removeClass("is-active");
    }

    function mostrarVentanaNuevo(){
        $("#mClienteNuevo").addClass("is-active");

    }
    function mostrarVentanaModificar($telefono,$nombre) {
        $("#clienteModificarTelefono").val($telefono);
        $("#clienteModificarNombre").val($nombre);
        $("#mClienteModificar").addClass("is-active");
    }
    function mostrarVentanaEliminar($telefono){
        eliminarCliente($telefono);
    }

    function cargarTablaClientes($clave) {
        var clave = $clave;
        $.ajax({
            url: "<?php echo site_url('Cliente/tablaClientes'); ?>",
            method: "POST",
            data: {
                clave: clave
            },
            success: function(data) {
                $("#tablaDatos").html(data);
            },
            error: function(result) {
                $("#tablaDatos").html(result.responseText);
            },
            fail: (function(status) {
                $("#tablaDatos").html("Fail");
            })

        });
    }

    function insertarCliente() {
        var array = {
            vNombre: document.getElementById('clienteNuevoNombre').value.toUpperCase(),
            vTelefono: document.getElementById('clienteNuevoTelefono').value
        };
        $.ajax({
            url: "<?php echo site_url('Cliente/insertarCliente'); ?>",
            method: "POST",
            data: {
                array: array
            },
            success: function() {
                $(".modal").removeClass("is-active");
                cargarTablaClientes("");
            },
            error: function(jqHZR, exception) {
                alert("El cliente ya se encuentra registrado.");
            },
            fail: (function(status) {
                alert("wut?");
            })
        });
    }

    function modificarCliente() {
        var clienteModificarClave=document.getElementById('clienteModificarTelefono').value;
        var array = {
            vNombre: document.getElementById('clienteModificarNombre').value.toUpperCase(),
            vTelefono: clienteModificarClave
        };
        $.ajax({
            url: "<?php echo site_url('Cliente/modificarCliente'); ?>",
            method: "POST",
            data: {
                array: array,
                clienteModificarClave: clienteModificarClave
            },
            success: function() {
                $(".modal").removeClass("is-active");
                cargarTablaClientes("");
            },
            error: function(jqHZR, exception) {
                alert("Ya se encuentra un cliente registrado con el mismo número.");
            },
            fail: (function(status) {
                alert("wut?");
            })
        });
    }

    function eliminarCliente($clienteEliminarClave) {
        if (window.confirm("¿Eliminar cliente?")) {
            var clienteEliminarClave=$clienteEliminarClave;
            $.ajax({
                url: "<?php echo site_url('Cliente/eliminarCliente'); ?>",
                method: "POST",
                data: {
                    clienteEliminarClave: clienteEliminarClave
                },
                success: function() {
                    $(".modal").removeClass("is-active");
                    cargarTablaClientes("");
                },
                error: function(jqHZR, exception) {
                    alert("Se requieren permisos de administrador para esta acción.");
                },
                fail: (function(status) {
                    alert("wut?");
                })
            });
        }
    }
</script>

<body>
    <table style="width:100%;">
        <tr>
            <td>
                <button onclick="mostrarVentanaNuevo()" style="font-size:24px;" class="modal-button" name="clienteNuevo" id="clienteNuevo" type="button">Nuevo Cliente</button>
            </td>
        </tr>
        <tr>
            <td>
                <label for="buscadorClientes">Buscar Cliente: </label>
                <input onkeyup="buscarCliente(this)" id="buscadorClientes" style="width:100%;" type="text" placeholder="Buscar Cliente..." />
            </td>
        </tr>
        <tr>
            <td id="tablaDatos">
            </td>
        </tr>
    </table>
</body>



<div class="modal" id="mClienteNuevo">
    <div class="modal-background"></div>
    <div class="modal-card" style="position:absolute; top:50px;">
        <header class="modal-card-head" style="background-color: #FF5679;">
            <p class="modal-card-title" style=" color: white;">Nuevo Cliente</p>
            <button onclick="cerrarModal()" class="delete" aria-label="close"></button>
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
                <button onclick="cerrarModal()" class="button is-delete modal-button">Cancelar</button>
            </footer>
        </form>
    </div>
</div>

<div class="modal" id="mClienteModificar">
    <div class="modal-background"></div>
    <div class="modal-card" style="position:absolute; top:50px;">
        <header class="modal-card-head" style="background-color: #FF5679;">
            <p class="modal-card-title" style="color: white;">Modificar Cliente</p>
            <button onclick="cerrarModal()" class="delete" aria-label="close"></button>
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
                <button onclick="cerrarModal()" class="button is-delete modal-button">Cancelar</button>
            </footer>
        </form>
    </div>
</div>