<?php

include("db.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM person WHERE id = $id";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Query Fallida");
    }

    $_SESSION['message'] = "Nombre eliminado Satisfactoriamente";
    $_SESSION['message_type'] = "danger";
    header("Location: index.php");
}

?>