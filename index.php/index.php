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
?>
