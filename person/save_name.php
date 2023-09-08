<?php

include('../includes/db.php');

//validar el envio
// if (isset($_POST['save_task'])) {
//     echo 'saving';
//}

$name = $_POST['name'];

$query = "INSERT INTO person(name) VALUES ('$name')";
$result = mysqli_query($conn, $query);
if (!$result) {
    die("Query fallido");
}

$_SESSION['message'] = 'Tarea Guardada satisfactoriamente';
$_SESSION['message_type'] = 'success';

header("Location: index.php");

?>