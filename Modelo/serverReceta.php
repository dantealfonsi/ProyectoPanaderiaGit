<?php 
    define('Acceso', TRUE);
    include_once "../Vista/Includes/paths.php";
    include "iniciarSesion.php";
        
    
    //Conexion a la base de datos 
    include "conexion.php"; 
    
    function readCodeInsumo($nombre){
        $sql ="select codigo from insumos where nombre='{$nombre}'";
        $resultado= mysqli_query($GLOBALS['conn'], $sql);
        $row = mysqli_fetch_array($resultado);
        return $row['codigo'];
    }

    function readNombreInsumo($codigoInsumo){
        $sql ="select nombre from insumos where codigo='{$codigoInsumo}'";
        $resultado= mysqli_query($GLOBALS['conn'], $sql);
        $row = mysqli_fetch_array($resultado);
        return $row['nombre'];
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
        $Q_borra_receta = "DELETE FROM recetas where idreceta='".$data['codigo']."'";
        $Q_borra_item = "DELETE FROM itemrecetas where idreceta='".$data['codigo']."'";
        $resultado= mysqli_query($GLOBALS['conn'], $Q_borra_receta);    
        $resultado2= mysqli_query($GLOBALS['conn'], $Q_borra_item);    
    }

// ... (código para insertar en la base de datos)

    /*$Q_update_producto ="update productos set idreceta='$codigo', habilitado=1 where idreceta='".$data['codigo']."'";
    $resultado= mysqli_query($GLOBALS['conn'], $Q_update_producto);*/

    $sql = "insert into recetas (idreceta,nombre,notas) values ('$codigo','".$data["nombre_receta"]."','".$data["nota"]."')";
    $resultado= mysqli_query($GLOBALS['conn'], $sql);

    if (isset($data["productos"]) && is_array($data["productos"])) {
        foreach ($data["productos"] as $producto) {
            $cantidad = $producto["cantidad"];
            $gramos = $producto["gramos"];
            $nombreProducto = $producto["producto"];
            $codigoInsumo = readCodeInsumo($nombreProducto);
            
            $sql = "insert into itemrecetas (idreceta,codigoinsumo,cantidad,uni) values ('$codigo','".$codigoInsumo."',".$cantidad.",'$gramos')";
            $resultado= mysqli_query($GLOBALS['conn'], $sql);
        }
    }
    $response = ["message" => "Receta guardada correctamente"];
    echo json_encode($response);    
}

// Enviar una respuesta (puedes devolver un mensaje de éxito o error)

if(isset($_GET['receta'])){
    
    $consulta = "select * from itemrecetas where idreceta='".$_GET['receta']."'";
    $resultado = mysqli_query($GLOBALS['conn'], $consulta);
    $obj = array();
    while($row = mysqli_fetch_assoc($resultado)) {      
        $obj[]=array('cantidad'=>$row['cantidad'], 'gramos'=>$row['uni'], 'producto'=>readNombreInsumo($row['codigoinsumo']));
    }   
    echo json_encode($obj); 
}

?>





