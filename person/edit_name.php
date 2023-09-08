<?php

include('db.php');

//obtenemos en el formulario los datos de la base de datos por el id del boton del index
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM person WHERE id = $id";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $name = $row['name'];
    }
}

//caundo presionamos el boton actualizar
if (isset($_POST['update'])) {
    $id = $_GET['id'];
    $name = $_POST['name'];

    $query = "UPDATE person set name ='$name' WHERE id = $id";
    mysqli_query($conn, $query);

    $_SESSION['message'] = 'Tarea actualizada Satisfactoriamente';
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
                <form action="edit_name.php?id=<?php echo $_GET['id'] ?>" method="POST">
                    <div class="form-group">
                        <input type="text" name="name" value="<?php echo $name ?>" class="form-control" placeholder="Actualizar Nombre">
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