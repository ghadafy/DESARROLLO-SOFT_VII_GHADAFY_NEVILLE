<?php include 'funciones_tienda.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda</title>
</head>

<body>
    <h1>TIENDA ONLINE UTP</h1>

    <?php
    $arreglo_prod = [
        'camisa' => 50,
        'pantalon' => 70,
        'zapatos' => 80,
        'calcetines' => 10,
        'gorra' => 25
    ];

    $carrito = [
        'camisa' => 2,
        'pantalon' => 1,
        'zapatos' => 1,
        'calcetines' => 3,
        'gorra' => 0
    ];


    ?>


    <table border=1>
        <tr>
            <th colspan="4">Facturacion</th>
        </tr>
        <tr>
            <td colspan="4">Detalle de Compra</td>
        </tr>
        <tr>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Costo</th>
        </tr>
        <?php
        $subtotal = 0;
        foreach ($arreglo_prod as $item => $value) {

            $costo = $carrito[$item] * $value;
            if ($carrito[$item] != 0) {
                echo "<tr><td>" . $item . "</td><td>" . $carrito[$item] . "</td><td>" . number_format($arreglo_prod[$item], 2) . "</td><td align='right'> B/." . number_format($costo, 2) . "</td></tr>";
            }
            $subtotal += $costo;
        }

        $descuento = calcular_descuento($subtotal);
        $impuestos = aplicar_impuesto($subtotal);
        $total_compra = calcular_total($subtotal, $descuento, $impuestos)


        ?>
        <tr>
            <th align="left" colspan="3">Subtotal:</th>
            <td align="right"><?php echo "B/." . number_format($subtotal, 2); ?></td>
        </tr>

        <tr>
            <th align="left" colspan="3">Descuentos Aplicado:</th>
            <td align="right"><?php echo "B/." . number_format($descuento, 2); ?></td>
        </tr>

        <tr>
            <th align="left" colspan="3">Impuesto (7%):</th>
            <td align="right"><?php echo "B/." . number_format($impuestos, 2); ?></td>
        </tr>

        <tr>
            <th align="left" colspan="3">Total a Pagar:</th>
            <th align="right"><?php echo "B/." . number_format($total_compra, 2); ?></th>
        </tr>

    </table>

</body>

</html>