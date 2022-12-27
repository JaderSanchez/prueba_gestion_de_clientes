<?php 

require_once(ROOTPATH . '/layout/header.php');

?>

<main>

    <h1 class="title">Lista de empleados</h1>

    <div class="d-flex justify-content-end mb-3">
        <a class="btn btn-primary" href="index.php?controller=employees&action=show_add_form"><i class="fa-solid fa-user-plus"></i> Crear</a>
    </div>

    <table id="products-table" class="table table-ligth table-striped">
        <thead>
            <tr>
                <th><i class="fa-solid fa-user"></i> Nombre</th>
                <th><i class="fa-solid fa-at"></i> Email</th>
                <th><i class="fa-solid fa-venus-mars"></i> Sexo</th>
                <th><i class="fa-solid fa-briefcase"></i> Área</th>
                <th><i class="fa-solid fa-envelope"></i> Boletín</th>
                <th>Modificar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($employees->num_rows == 0) : ?>
                <tr>
                    <td colspan="7" class="text-center">Aún no hay empleados registrados</td>
                </tr>
            <?php endif; ?>
            <?php while ($employee = $employees->fetch_object()) : ?>
                <tr>
                    <td><?= $employee->nombre ?></td>
                    <td><?= $employee->email ?></td>
                    <td><?= ($employee->sexo == 'M') ? 'Masculino' : 'Femenino' ?></td>
                    <td><?= $employee->area ?></td>
                    <td><?= ($employee->boletin == 1) ? 'Si' : 'No' ?></td>
                    <td><a class="table-icon" href="index.php?controller=employees&action=show_update_form&id=<?= $employee->id ?>"><i class="fa-solid fa-pen-to-square"></i></a></td>
                    <td><a class="table-icon" href="index.php?controller=employees&action=delete&id=<?= $employee->id ?>"><i class="fa-solid fa-trash"></i></a></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</main>

<!-- <script src="views/employees/employees.js"></script> -->

<?php require_once(ROOTPATH . '/layout/footer.php'); ?>