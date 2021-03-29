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
                    td[3].innerHTML=Number(td[1].innerHTML)*Number(td[2].innerHTML);
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
                celdaPrecio.innerHTML=precioServicio;
                celdaCantidad.innerHTML=1;
                celdaTotal.innerHTML=precioServicio*1;
            }
        }else{
            var fila=table.insertRow(-1);
            var celdaNombre=fila.insertCell(0);
            var celdaPrecio=fila.insertCell(1);
            var celdaCantidad=fila.insertCell(2);
            var celdaTotal=fila.insertCell(3);
            celdaNombre.innerHTML=nombreServicio;
            celdaPrecio.innerHTML=precioServicio;
            celdaCantidad.innerHTML=1;
            celdaTotal.innerHTML=precioServicio*1;
        }
        $totalVenta=$totalVenta+precioServicio;
        $celdaTotal.innerHTML="Total: "+formatter.format(Number($totalVenta));
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
            <td id="datosCliente" style="border: 1px solid #ffccd6; width:25%;">
            </td>
            <td id="datosVenta" style="font-size:24px; text-align:right; border: 1px solid #ffccd6; width:50%;">
                <div id="totalVenta">Total: </div>
            </td>          
            <td id="metodoPago" style="border: 1px solid #ffccd6; width:25%;">
            </td>
        </tr>
    </table>
</body>