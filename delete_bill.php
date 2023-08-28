<?php

include("db.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM bill WHERE id = $id";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Query Fallida");
    }

    $_SESSION['message'] = "Factura Eliminada Eliminada Satisfactoriamente";
    $_SESSION['message_type'] = "danger";
    header("Location: index.php");
}

?>