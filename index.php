<?php include('db.php'); ?>

<?php include('includes/header.php'); ?>

<div class="container p-4">
    <div class="row">
        <div class="col-md-4"> <!--este div es para CREATE -->

            <?php if (isset($_SESSION['message'])) { ?>

                <div class="alert alert-<?= $_SESSION['message_type'] ?> alert-dismissible fade show" role="alert">
                    <?= $_SESSION['message'] ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <?php session_unset();
            } ?> <!--limpiar los datos que tenemos en session -->

            <div class="card card-body">
                <form action="save_bill.php" method="POST">
                    <div class="form-group">
                        <input type="date" name="date" class="form-control" placeholder="Fecha" autofocus>
                    </div>
                    <div class="form-group">
                        <input type="text" name="num_bill" class="form-control" placeholder="Numero de factura">
                    </div>
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Nombre">
                    </div>
                    <div class="form-group">
                        <input type="text" name="amount" class="form-control" placeholder="Monto">
                    </div>
                    <div class="form-group">
                        <textarea name="observation" rows="2" placeholder="Observaciones"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="text" name="company" class="form-control" placeholder="Empresa">
                    </div>
                    <input type="submit" class="btn btn-success btn-block" name="save_bill" value="Guardar Factura">
                </form>
            </div>
        </div>
        <div class="col-md-8">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Fecha</th>
                        <th>N° Factura</th>
                        <th>Monto</th>
                        <th>Observaciones</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM bill";
                    $result_tasks = mysqli_query($conn, $query);

                    $n = 1;
                    while ($row = mysqli_fetch_array($result_tasks)) { ?>
                        <tr>
                            <td>
                                <?php echo $n ?>
                            </td>
                            <td>
                                <?php echo $row['date'] ?>
                            </td>
                            <td>
                                <?php echo $row['num_bill'] ?>
                            </td>
                            <td>
                                <?php echo $row['amount'] ?>
                            </td>
                            <td>
                                <?php echo $row['observation'] ?>
                            </td>
                            <td>
                                <a href="edit.php?id=<?php echo $row['id'] ?>" class="btn btn-secondary">
                                    <i class="fas fa-marker"></i>
                                </a>
                                <a href="delete_bill.php?id=<?php echo $row['id'] ?>" class="btn btn-danger">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                        <?php $n++;
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include('includes/footer.php') ?>