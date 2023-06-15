<?php

try {
    $conn= new PDO('mysql:host=localhost;dbname=aplicacion','root','');
    echo "conexión exitosa";
} catch (PDOException $e) {
    echo "erros de conexión ".$e->getMessage();
}

if (isset($_POST['agregar_tarea'])) {
    $tarea=($_POST['tarea']);
    $sql='INSERT INTO tareas (tarea) VALUES(?)';
    $sentencia= $conn->prepare($sql);
    $sentencia->execute([$tarea]);
}

if (isset($_GET['id'])) {
    $id=$_GET['id'];
    $sql="DELETE FROM tareas WHERE id=?";
    $sentencia=$conn->prepare($sql);
    $sentencia->execute([$id]);
}

if (isset($_POST['id'])) {
    $id=$_POST['id'];
    $compleatada=(isset($_POST['tarea_check'])) ? 1 : 0;

    $sql="UPDATE tareas SET completada=? WHERE id=?";
    $sentencia=$conn->prepare($sql);
    $sentencia->execute([$compleatada, $id]);

}

$sql="SELECT * FROM tareas";
$registros=$conn->query($sql);

?>