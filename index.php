<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pdo</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section class="hero">
        <h1 class="hero__h1">CRUD</h1>
        <div class="hero__contenedor">
            <div class="hero__izquierda">
                <h2 class="hero__h2">Agregar Nuevo Producto</h2>
                <form class="hero__formulario--agregar" action="index.php" method="POST">
                    <input id="ropar" class="hero__input--agregar" name="ropa" type="text" placeholder="Ropa" required>
                    <input class="hero__input--agregar" name="precio" type="number" placeholder="Precio" required>
                    <input class="hero__input--agregar" name="talle" type="text" placeholder="Talle" required>
                    <input class="hero__input--agregar" name="color" type="text" placeholder="Color" required>
                    <input class="hero__submit--agregar" type="submit">
                </form>
            </div>

            <div class="hero__derecha">
                <form class="hero__formulario" action="index.php" metod="POST">
                     <input type="number" metod="post" value="null" id="precio1" name="precio1">
                     <br>
                     <input type="submit" value="actualizar">
                </form>
            </div>
        </div>
    </section>
</body>
</html>



<!-- CONSULTA CON SENTENCIA PREPARADA -->

<?php   

// VINCULACION A LA BASE DE DATOS
$db = new PDO ('mysql:host=localhost; dbname=crud', 'root' , 'root');

$query = "SELECT * FROM productos";

$stmt = $db->prepare($query);

$stmt->execute();

$resultado = $stmt -> fetchAll( PDO::FETCH_ASSOC);

/* conseguir datos */

$productos_detalles = "SELECT ropa, precio, talle, color FROM productos";
$stmt = $db->prepare($productos_detalles);
$stmt->execute();
/*fetch all recupera todos los elementos de la fila y fetch assoc lo convierte en array */
$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($resultados as $detalles_obtenidos) {
    /* convierte cada email del array en un string */
    $cadena = implode(", ", $detalles_obtenidos);
}    
// INSERTAR PRODUCTOS
if (isset($_POST["ropa"]) &&  $_POST["ropa"] ===$cadena &&
    isset($_POST["precio"]) && is_numeric($_POST["precio"]) &&  $_POST["precio"] ===$cadena  && 
    isset($_POST["talle"]) &&  $_POST["talle"] ===$cadena  && 
    isset($_POST["color"]) &&  $_POST["color"] ===$cadena ){
    $ropa = $_POST['ropa'];
    $precio = $_POST['precio'];
    $talle = $_POST['talle'];
    $color = $_POST['color'];
    
    $crear = "INSERT INTO productos (ropa, precio, talle, color) VALUES ('$ropa', $precio, '$talle', '$color')";
    
    $stmt = $db->prepare($crear);
    
    $stmt->execute();
    echo"se envio";
}


if ($resultado && isset($_POST["ropa"]) && isset($_POST["precio"]) && is_numeric($_POST["precio"]) && isset($_POST["talle"]) && isset($_POST["color"])) {
    echo "<table>";
    echo "<tr><th>Ropa</th><th>Precio</th><th>Talle</th><th>Color</th></tr>";

    foreach ($resultado as $fila) {
        echo "<tr>";
        echo "<td>" . $fila['ropa'] . "</td>";
        echo "<td>" . $fila['precio'] . "</td>";
        echo "<td>" . $fila['talle'] . "</td>";
        echo "<td>" . $fila['color'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No se encontraron resultados.";
}

//VINCULAR CON EL HTML


// 



?>