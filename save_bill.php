<?php

include('db.php');
session_start();
//validar el envio
// if (isset($_POST['save_task'])) {
//     echo 'saving';
//}

$date = $_POST['date'];
$num_bill = $_POST['num_bill'];
$name = $_POST['name'];
$amount = $_POST['amount'];
$observation = $_POST['observation'];
$company = $_POST['company'];

// Iniciar una transacción
mysqli_begin_transaction($conn);

try {

   
    // Ahora, inserta los datos en la tabla "bill" relacionando con el ID de la persona
    $queryBill = "INSERT INTO bill(num_bill, date,  amount, observation, id_company, id_person) VALUES ('$num_bill', '$date',  '$amount', '$observation', '$billId', '$billId')";
    $resultBill = mysqli_query($conn, $queryBill);
    if (!$resultBill) {
        throw new Exception("Error al insertar en la tabla 'bill': " . mysqli_error($conn));
    }
    // Obtener el ID autoincremental de la factura insertada
    $billId = mysqli_insert_id($conn);

    // Primero, inserta los datos en la tabla "company"
    $queryCompany = "INSERT INTO company(id_company, name) VALUES 
    ('$billId', '$company')";
    $resultCompany = mysqli_query($conn, $queryCompany);
    if (!$resultCompany) {
        throw new Exception("Error al insertar en la tabla 'company': " . mysqli_error($conn));
    }

    // Primero, inserta los datos en la tabla "person"
    $queryPerson = "INSERT INTO person(id_person, name) VALUES 
    ('$billId', '$name')";
    $resultPerson = mysqli_query($conn, $queryPerson);
    if (!$resultPerson) {
        throw new Exception("Error al insertar en la tabla 'person': " . mysqli_error($conn));
    }

    // Confirmar la transacción
    mysqli_commit($conn);

    // Si todo se ha realizado con éxito, establece un mensaje de éxito y redirige
    $_SESSION['message'] = 'Datos guardados satisfactoriamente';
    $_SESSION['message_type'] = 'success';

    header("Location: index.php");
} catch (Exception $e) {
    // Si ocurre algún error, realiza un rollback de la transacción
    mysqli_rollback($conn);

    // Establece un mensaje de error y redirige a una página de error o muestra un mensaje de error
    $_SESSION['message'] = 'Error al guardar los datos: ' . $e->getMessage();
    $_SESSION['message_type'] = 'error';

    header("Location: error.php"); // Reemplaza "error.php" con la página de error apropiada
}
?>