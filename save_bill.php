<?php

include('db.php');

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

$query = "INSERT INTO bill(date,num_bill,name,amount,observation,company) VALUES ('$date','$num_bill','$name','$amount','$observation','$company')";
$result = mysqli_query($conn, $query);
if (!$result) {
    die("Query fallido");
}

$_SESSION['message'] = 'Factura Guardada satisfactoriamente';
$_SESSION['message_type'] = 'success';

header("Location: index.php");

?>