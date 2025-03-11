<?php
$conexion = mysqli_connect("IP_Servidor:Puerto","Usuario","Contraseña", "Catálogo") or die ("No se pudo conectar a la base de datos.");

// Función para obtener los valores de la tabla param filtrado por nombre="SO",
// separar los valores CSV y ordenar
function obtenerValorCSV ($conexion)
{
    $sql = "SELECT valor FROM param WHERE nombre = 'SO'";
    $resultadoSQL = mysqli_query($conexion, $sql);
    //Obtenemos el valor del campo "valor" del primer registro (sólo debería obtenerse uno)
    $valorCSV = mysqli_fetch_row($resultadoSQL))[0];
    //Separamos en un array los valores en formato CSV separados por punto y coma y comillas dobles
    $arrayCSV = str_getcsv($valorCSV, ";", '"');
    //Ordenamos el array por orden alfabético
    sort($arrayCSV);
    //Devolvemos el array ordenado
    return $arrayCSV;
}

// Ejemplo de uso de la función
$listaSO = obtenerValorCSV($conexion);
?>
<form>
<select name="SistemaOperativo">
<?php foreach ($listaSO as $so): ?>
<option value="<?php echo $so; ?>"
<?php if ($so == "Windows Server") { echo "selected"; } ?>>
<?php echo $so; ?>
</option>
<?php endforeach; ?>
</select>
</form>