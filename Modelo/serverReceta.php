<?php 
    define('Acceso', TRUE);
    include_once "../Vista/Includes/paths.php";
    include "iniciarSesion.php";
        
    
    //Conexion a la base de datos 
    include "conexion.php"; 
    
    function readCodeInsumo($nombre){
        $sql ="select CODIGO from INSUMOS where NOMBRE='{$nombre}'";
        $resultado= mysqli_query($GLOBALS['conn'], $sql);
        $row = mysqli_fetch_array($resultado);
        return $row['CODIGO'];
    }

    function readNombreInsumo($codigoInsumo){
        $sql ="select NOMBRE from INSUMOS where CODIGO='{$codigoInsumo}'";
        $resultado= mysqli_query($GLOBALS['conn'], $sql);
        $row = mysqli_fetch_array($resultado);
        return $row['NOMBRE'];
    }    
?>

<?php
// Recibir el JSON enviado desde el frontend
$json = file_get_contents("php://input");
$data = json_decode($json, true);
$bytes = random_bytes(5);
$codigo = bin2hex($bytes);

// Validar y procesar los datos (por ejemplo, insertar en la base de datos)
// $data["nombre_receta"] contiene el nombre de la receta
// $data["nombre_producto"] contiene el nombre del producto

if(isset($data["nombre_receta"])){
    
    if(isset($data['update']) && $data['update']=="yes"){
        $Q_borra_receta = "DELETE FROM recetas where IDreceta='".$data['codigo']."'";
        $Q_borra_item = "DELETE FROM itemrecetas where IDreceta='".$data['codigo']."'";
        $resultado= mysqli_query($GLOBALS['conn'], $Q_borra_receta);    
        $resultado2= mysqli_query($GLOBALS['conn'], $Q_borra_item);    
    }

// ... (código para insertar en la base de datos)

    $sql = "insert into recetas (IDreceta,nombre,IDproducto,notas) values ('$codigo','".$data["nombre_receta"]."',".$data["nombre_producto"].",'".$data["nota"]."')";
    $resultado= mysqli_query($GLOBALS['conn'], $sql);

    if (isset($data["productos"]) && is_array($data["productos"])) {
        foreach ($data["productos"] as $producto) {
            $cantidad = $producto["cantidad"];
            $gramos = $producto["gramos"];
            $nombreProducto = $producto["producto"];
            $codigoInsumo = readCodeInsumo($nombreProducto);
            
            $sql = "insert into itemrecetas (IDreceta,IDproducto,codigoInsumo,cantidad,uni) values ('$codigo',".$data["nombre_producto"].",'".$codigoInsumo."',".$cantidad.",'$gramos')";
            $resultado= mysqli_query($GLOBALS['conn'], $sql);
        }
    }
    $response = ["message" => "Receta guardada correctamente"];
    echo json_encode($response);    
}



// Enviar una respuesta (puedes devolver un mensaje de éxito o error)

if(isset($_GET['receta'])){
    
    $consulta = "select * from itemrecetas where IDreceta='".$_GET['receta']."'";
    $resultado = mysqli_query($GLOBALS['conn'], $consulta);
    $obj = array();
    while($row = mysqli_fetch_assoc($resultado)) {      
        $obj[]=array('cantidad'=>$row['cantidad'], 'gramos'=>$row['uni'], 'producto'=>readNombreInsumo($row['codigoInsumo']));
    }   
    echo json_encode($obj); 
}

?>





