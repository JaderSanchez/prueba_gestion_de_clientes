<?php 

require_once(ROOTPATH . '/layout/header.php'); 

$action = !isset($employee) ? 'add' : 'update'; 
$title = !isset($employee) ? 'Crear' : 'Modificar'; 

?>

<main>

    <form action="index.php?controller=employees&action=<?= $action ?>" method="post">

        <input type="hidden" name="id" value="<?= $employee->id ?? '' ?>">

        <div class="col-6 offset-3">
            <h1 class="title"><?= $title ?> empleado</h1>
            <div class="alert alert-info" role="alert">
                Los campos con asteriscos (*) son obligatorios
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-2 offset-3 text-end">Nombre completo *</label>
            <div class="col-4">
                <input type="text" name="full-name" class="form-control form-control" placeholder="Nombre completo del empleado" value="<?= $employee->nombre ?? '' ?>" required>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-2 offset-3 text-end">Correo electrónico *</label>
            <div class="col-4">
                <input type="email" name="email" class="form-control form-control" placeholder="Correo electrónico" value="<?= $employee->email ?? '' ?>" required>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-2 offset-3 text-end">Sexo *</label>
            <div class="col-4">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" value="M" <?= (isset($employee) && $employee->sexo == 'M') ? 'checked' : '' ?> required>
                    <label class="form-check-label">Masculino</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" value="F" <?= (isset($employee) && $employee->sexo == 'F') ? 'checked' : '' ?>>
                    <label class="form-check-label">Femenino</label>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <label for="area" class="col-2 offset-3 text-end">Área *</label>
            <div class="col-4">
                <select class="form-select" name="area-id" required>
                    
                    <?php if(!isset($employee)): ?>
                        <option value="" disabled selected>Seleccionar</option>
                    <?php endif; ?>

                    <?php while($area = $areas->fetch_object()): ?>
                        <option value="<?= $area->id ?>" <?= (isset($employee) && $employee->area_id == $area->id) ? 'selected' : '' ?>><?= $area->nombre ?></option>
                    <?php endwhile; ?>

                </select>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-2 offset-3 text-end">Descripción *</label>
            <div class="col-4">
                <textarea name="description" class="form-control form-control" placeholder="Descripción de la experiencia del empleado" required><?= $employee->descripcion ?? '' ?></textarea>
            </div>
        </div>

        <div class="row mb-3">
            <div class="form-check offset-5">
                <input class="form-check-input" type="checkbox" value="1" name="release" <?= (isset($employee) && $employee->boletin == 1) ? 'checked' : '' ?>>
                <label class="form-check-label">Deseo recibir boletín informativo</label>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-2 offset-3 text-end">Roles *</label>
            <div class="col-4">
                <?php while($rol = $roles->fetch_object()): ?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="roles[]" value="<?= $rol->id ?>" <?= (isset($employee) && in_array($rol->id, $employeeRoles)) ? 'checked' : '' ?>>
                        <label class="form-check-label"><?= $rol->nombre ?></label>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>

        <input type="submit" class="btn btn-primary offset-5" value="Guardar">

    </form>

</main>

<?php require_once(ROOTPATH . '/layout/footer.php'); ?>