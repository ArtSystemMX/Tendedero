<script>

    $(document).ready(function(){
        cargarServicios();
    });

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

</script>
<body>
    <table style="border: 2px solid #ffccd6; width:100%; height:75%;">
        <tr style="border: 2px solid #ffccd6; height:100%;">
            <td style="border: 2px solid #ffccd6; width:75%" id="tablaDatos">
                <table id="tablaDatos">
                    <tr style="border: 2px solid #ffccd6;">
                        <th style="width:50%;">Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                    </tr>
                </table>
            </td>
            <td style="padding:2px; width:25%; border: 2px solid #ffccd6;" id="listaServicios">                
            </td>
        </tr>
    </table>
    <table style="border: 2px solid #ffccd6; width:100%; height:25%;">
        <tr style="border: 2px solid #ffccd6;">            
            <td id="datosCliente" style="border: 2px solid #ffccd6; width:25%;">
            </td>
            <td id="datosVenta" style="font-size:24px; text-align:right; border: 2px solid #ffccd6; width:50%;">
                <div>Total: </div>
            </td>          
            <td id="metodoPago" style="border: 2px solid #ffccd6; width:25%;">
            </td>
        </tr>
    </table>
</body>