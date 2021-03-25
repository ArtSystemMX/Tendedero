<script>

$(document).ready(function() {
    cargarTablaServicios("");
});

    function buscarServicio(obj){
        var consulta = $(obj).val();
        console.log(consulta);
        if (consulta != '') {
            cargarTablaServicios(consulta);
        } else {
        }
    }

    function cerrarModal(){
        $(".modal").removeClass("is-active");
    }

    function mostrarVentanaNuevo(){
        $("#mServicioNuevo").addClass("is-active");

    }
    function mostrarVentanaModificar($servicio, $precio) {
        $("#servicioModificarNombre").val($servicio);
        $("#servicioModificarPrecio").val($precio);
        $("#mServicioModificar").addClass("is-active");
    }
    function mostrarVentanaEliminar($servicio){
        eliminarServicio($servicio);
    }

    function cargarTablaServicios($clave) {
        var clave = $clave;
        $.ajax({
            url: "<?php echo site_url('Servicio/tablaServicios'); ?>",
            method: "POST",
            data: {clave:clave},
            success:function(data){
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

    function insertarServicio() {
        var array = {
            vServicioNombre: document.getElementById('servicioNuevoNombre').value.toUpperCase(),
            deServicioPrecio: document.getElementById('servicioNuevoPrecio').value
        };
        $.ajax({
            url: "<?php echo site_url('Servicio/insertarServicio'); ?>",
            method: "POST",
            data: {
                array: array
            },
            success: function() {
                $(".modal").removeClass("is-active");
                cargarTablaServicios("");
            },
            error: function(jqHZR, exception) {
                alert("El servicio ya se encuentra registrado.");
            },
            fail: (function(status) {
                alert("wut?");
            })
        });
    }

    function modificarServicio() {
        var servicioModificarNombre=document.getElementById('servicioModificarNombre').value.toUpperCase();
        var array = {
            vServicioNombre: servicioModificarNombre,
            deServicioPrecio: document.getElementById('servicioModificarPrecio').value
        };
        $.ajax({
            url: "<?php echo site_url('Servicio/modificarServicio'); ?>",
            method: "POST",
            data: {
                array: array,
                servicioModificarNombre: servicioModificarNombre
            },
            success: function() {
                $(".modal").removeClass("is-active");
                cargarTablaServicios("");
            },
            error: function(jqHZR, exception) {
                alert("Ya se encuentra un servicio registrado con el mismo nombre.");
            },
            fail: (function(status) {
                alert("wut?");
            })
        });
    }

    function eliminarServicio($servicioEliminarNombre) {
        if (window.confirm("¿Eliminar servicio?")) {
            var servicioEliminarNombre=$servicioEliminarNombre;
            $.ajax({
                url: "<?php echo site_url('Servicio/eliminarServicio'); ?>",
                method: "POST",
                data: {
                    servicioEliminarNombre: servicioEliminarNombre
                },
                success: function() {
                    $(".modal").removeClass("is-active");
                    cargarTablaServicios("");
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
                <button onclick="mostrarVentanaNuevo()" style="font-size:24px;" class="modal-button" name="servicioNuevo" id="servicioNuevo" type="button">Nuevo Servicio</button>
            </td>
        </tr>
        <tr>
            <td id="tablaDatos">
            </td>
        </tr>
    </table>
</body>



<div class="modal" id="mServicioNuevo">
    <div class="modal-background"></div>
    <div class="modal-card" style="position:absolute; top:50px;">
        <header class="modal-card-head" style="background-color: #FF5679;">
            <p class="modal-card-title" style=" color: white;">Nuevo Servicio</p>
            <button onclick="cerrarModal()" class="delete" aria-label="close"></button>
        </header>
        <form action="#" onsubmit="insertarServicio(); return false;">
            <section class="modal-card-body">
                <div>
                    <label for="servicioNuevoNombre">Nombre:</label>
                    <input class="input is-rounded is-primary" type="text" style="width:100%;  border-color:#FF5679; text-transform: uppercase;" id="servicioNuevoNombre" placeholder="Nombre..." required>
                </div><br>
                <div>
                    <label for="servicioNuevoPrecio">Precio:</label>
                    <input class="input is-rounded is-primary" type="number" style="width:100%; border-color:#FF5679; text-transform: uppercase;" id="servicioNuevoPrecio" placeholder="Precio..." required>
                </div>
            </section>
            <footer class="modal-card-foot">
                <button class="button is-success modal-button">Guardar</button>
                <button onclick="cerrarModal()" class="button is-delete modal-button">Cancelar</button>
            </footer>
        </form>
    </div>
</div>

<div class="modal" id="mServicioModificar">
    <div class="modal-background"></div>
    <div class="modal-card" style="position:absolute; top:50px;">
        <header class="modal-card-head" style="background-color: #FF5679;">
            <p class="modal-card-title" style="color: white;">Modificar Servicio</p>
            <button onclick="cerrarModal()" class="delete" aria-label="close"></button>
        </header>
        <form action="#" onsubmit="modificarServicio(); return false;">
            <section class="modal-card-body">
                <div>
                    <label for="servicioModificarNombre">Nombre:</label>
                    <input class="input is-rounded is-primary" type="text" style="width:100%;  border-color:#FF5679; text-transform: uppercase;" id="servicioModificarNombre" placeholder="Nombre..." required>
                </div><br>
                <div>
                    <label for="servicioModificarPrecio">Precio:</label>
                    <input class="input is-rounded is-primary" type="text" style="width:100%; border-color:#FF5679; text-transform: uppercase;" id="servicioModificarPrecio" placeholder="Precio..." required>
                </div>
            </section>
            <footer class="modal-card-foot">
                <button class="button is-success modal-button">Guardar Cambios</button>
                <button onclick="cerrarModal()" class="button is-delete modal-button">Cancelar</button>
            </footer>
        </form>
    </div>
</div>