<?php

include('db.php');

//obtenemos en el formulario los datos de la base de datos por el id del boton del index
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM bill WHERE id = $id";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $date = $row['date'];
        $num_bill = $row['num_bill'];
        $name = $row['name'];
        $amount = $row['amount'];
        $observation = $row['observation'];
        $company = $row['company'];
    }
}

//caundo presionamos el boton actualizar
if (isset($_POST['update'])) {
    $id = $_GET['id'];
    $date = $_POST['date'];
    $num_bill = $_POST['num_bill'];
    $name = $_POST['name'];
    $amount = $_POST['amount'];
    $observation = $_POST['observation'];
    $company = $_POST['company'];

    $query = "UPDATE bill set date ='$date', num_bill ='$num_bill', name = '$name', amount = '$amount', observation = '$observation',company = '$company' WHERE id = $id";
    mysqli_query($conn, $query);

    $_SESSION['message'] = 'Factura actualizada Satisfactoriamente';
    $_SESSION['message_type'] = 'warning';
    header("Location: index.php");

}

?>

<?php include('includes/header.php') ?>

<div class="container p-4">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card card-body">
                <!--estamos mandando ala misma pagina cuando presionamos el boton-->
                <form action="edit.php?id=<?php echo $_GET['id'] ?>" method="POST">
                    <div class="form-group">
                        <input type="date" name="date" class="form-control" value="<?php echo $date ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" name="num_bill" class="form-control" value="<?php echo $num_bill ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" value="<?php echo $name ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" name="amount" class="form-control" value="<?php echo $amount ?>">
                    </div>
                    <div class="form-group">
                        <textarea name="observation" rows="2"><?php echo $observation ?>
                        </textarea>
                    </div>
                    <div class=" form-group">
                        <input type="text" name="company" class="form-control" value="<?php echo $company ?>">
                    </div>
                    <button class="btn btn-success" name="update">
                        Actualizar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php') ?>