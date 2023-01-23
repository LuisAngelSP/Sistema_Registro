<?php 

$servidor="localhost"; //127.0.0.1
$baseDatos="app";
$usuario="root";
$contraseña="";

try{
    $conexion= new PDO("mysql:host=$servidor;dbname=$baseDatos",$usuario,$contraseña) ;   
    
}catch(Exception $e){
    echo $e->getMessage();
}

?>