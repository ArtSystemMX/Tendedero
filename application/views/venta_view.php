<script>

    $totalVenta=0;
    $celdaTotal=document.getElementById("totalVenta");

    $(document).ready(function(){
        cargarServicios();
    });
    var formatter = new Intl.NumberFormat('es-MX', {
        style: 'currency',
        currency: 'MXN',
    })

    function cargarServicios() {
        $.ajax({
            url: "<?php echo site_url('Venta/botonesServicios'); ?>",
            method: "POST",
            success: function(data) {
                $("#listaServicios").html(data);
            },
            error: function(result) {
                $("#listaServicios").html(result.responseText);
            },
            fail: (function(status) {
                $("#listaServicios").html("Fail");
            })

        });
    }

    function agregarServicio($nombreServicio, $precioServicio){
        var nombreServicio, precioServicio, table, tr, td, i, txtValue, valorExistente;
        valorExistente=false;
        precioServicio=$precioServicio;
        nombreServicio=$nombreServicio;
        table=document.getElementById("tablaDatos");
        tr=table.getElementsByTagName("tr");
        if(tr.length>1){
            for(i=1;i<tr.length;i++){
                td=tr[i].cells;
                if(td[0].innerHTML==nombreServicio){
                    td[2].innerHTML=Number(td[2].innerHTML)+1;
                    td[3].innerHTML=formatter.format(Number(precioServicio)*Number(td[2].innerHTML));
                    valorExistente=true;
                    break;
                }
            }
            if(!valorExistente){
                var fila=table.insertRow(-1);
                var celdaNombre=fila.insertCell(0);
                var celdaPrecio=fila.insertCell(1);
                var celdaCantidad=fila.insertCell(2);
                var celdaTotal=fila.insertCell(3);
                celdaNombre.innerHTML=nombreServicio;
                celdaPrecio.innerHTML=formatter.format(Number(precioServicio));
                celdaCantidad.innerHTML=1;
                celdaTotal.innerHTML=formatter.format(Number(precioServicio)*1);
            }
        }else{
            var fila=table.insertRow(-1);
            var celdaNombre=fila.insertCell(0);
            var celdaPrecio=fila.insertCell(1);
            var celdaCantidad=fila.insertCell(2);
            var celdaTotal=fila.insertCell(3);
                celdaNombre.innerHTML=nombreServicio;
                celdaPrecio.innerHTML=formatter.format(Number(precioServicio));
                celdaCantidad.innerHTML=1;
                celdaTotal.innerHTML=formatter.format(Number(precioServicio)*1);
        }
        $totalVenta=$totalVenta+precioServicio;
        $celdaTotal.innerHTML="Total: "+formatter.format(Number($totalVenta));
    }



    function mostrarVentanaNuevo(){
        $("#mClienteNuevo").addClass("is-active");

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


    function cerrarModal(){
        $(".modal").removeClass("is-active");
    }
    


</script>
<body>
    <table style="padding:0; width:100%; height:75%; ">
        <tr style=" height:100%;">
            <td style="padding:0; background-color:lightgray; width:74%;">
                <table style="padding:0;" id="tablaDatos">
                    <tr >
                        <th style="width:50%;">Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                    </tr>
                </table>
            </td>
            <td style="padding:2px; width:25%;" id="listaServicios">                
            </td>
        </tr>
    </table>
    <table style="height:1%;"></table>
    <table style=" width:100%; height:24%;">
        <tr>            
            <td id="datosCliente" style="border: 1px solid #ffccd6; width:50%; margin:auto;">
            <button onclick="mostrarVentanaNuevo()" style="font-size:24px; width:49%;" class="modal-button" name="clienteNuevo" id="clienteNuevo" type="button">Nuevo Cliente</button>
            <button onclick="mostrarVentanaBuscar()" style="font-size:24px; width:49%;" class="modal-button" name="clienteNuevo" id="clienteNuevo" type="button">Buscar Cliente</button>
            </td>
            <td id="datosVenta" style="font-size:32px; margin: auto; border: 1px solid #ffccd6; width:25%;">
                <div id="totalVenta" style="margin:auto; padding: auto;">Total: </div>
            </td>          
            <td id="metodoPago" style="border: 1px solid #ffccd6; width:25%;">
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

<div class="modal" id="mClienteBuscar">
    <div class="modal-background"></div>
    <div class="modal-card" style="position:absolute; top:50px;">
        <header class="modal-card-head" style="background-color: #FF5679;">
            <p class="modal-card-title" style=" color: white;">Buscar Cliente</p>
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