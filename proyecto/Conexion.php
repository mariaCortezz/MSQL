<?php
function conexion(){

    $conn = null;
    $host = 'localhost';
    $db ='proyecto';
    $user = 'root';
    $pwd = '';


    try{
     $conn = new PDO('mysql:host='.$host.'; dbname='.$db,$user,$pwd,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'')); 
     //echo "conexion hecha....";

    }catch (PDOExecption $e){
        echo "<center><h2 style='color:green'>Error al tratar de conectar a la BD.";
        echo "consulte al soporte tecnico</h2></center>";
        exit();
    }
    return $conn;
}

//conexion();
?>