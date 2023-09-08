<?php include('includes/db.php'); ?>

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

            <div class="card">
                <div class="card-header text-center">
                    REGISTRAR FACTURA
                </div>
                <div class="card-body">
                    <form action="save_bill.php" method="POST">
                        <div class="mb-3">
                            <!-- <label class="form-label">Fecha</label> -->
                            <input type="date" class="form-control">
                        </div>
                        <div class="mb-3">
                            <input type="text" name="num_bill" class="form-control" placeholder="Numero">
                        </div>
                        <div class="mb-3">
                            <select class="form-select" aria-label="Default select example" name="name">
                                <option selected>Nombre</option>
                                <?php
                                $query = "SELECT * FROM person";
                                $result_company = mysqli_query($conn, $query);

                                while ($row = mysqli_fetch_array($result_company)) { ?>
                                    <option value="1"><?php echo $row['name'] ?></option>
                                <?php } ?>
                            </select>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#personModal">
                                Agregar nombre a la Lista
                            </button>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="amount" class="form-control" placeholder="Monto">
                        </div>
                        <div class="mb-3">
                            <select class="form-select" aria-label="Default select example" name="company">
                                <option selected>Empresa</option>
                                <?php
                                $query = "SELECT * FROM company";
                                $result_company = mysqli_query($conn, $query);

                                while ($row = mysqli_fetch_array($result_company)) { ?>
                                    <option value="1"><?php echo $row['name'] ?></option>
                                <?php } ?>
                            </select>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Agregar empresa a la Lista
                            </button>
                        </div>
                        <div class="mb-3">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                                <label for="floatingTextarea">Observaciones</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="submit" class="btn btn-success btn-block" name="save_bill" value="Guardar Factura">
                        </div>
                    </form>
                </div>
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
                    $query = "SELECT * FROM bill
                    JOIN company ON bill.id_company = company.id_company
                    JOIN person ON bill.id_person = person.id_person";
                    $result_bills = mysqli_query($conn, $query);

                    $n = 1;
                    while ($row = mysqli_fetch_array($result_bills)) { ?>
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
                                <?php echo $row['name'] ?>
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

<!-- Modal -->
<div class="modal fade" id="personModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Nombre a la Lista</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="person/save_name.php" method="POST">
                <div class="modal-body">
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Escriba el nombre aqui" name="name">
                    <div id="emailHelp" class="form-text">Escriba el nombre de la manera mas clara, ordenada posible</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" name="save_name">Guardar Nombre</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php include('includes/footer.php') ?>