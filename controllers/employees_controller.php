<?php

require_once('models/employees_model.php');

class EmployeesController
{
    private $employeeModel = null;

    function __construct()
    {
        $this->employeeModel = new EmployeesModel();   
    }

    function getEmployees()
    {
        $employees = $this->employeeModel->getEmployees();
        require_once(ROOTPATH.'/views/employees/employees_view.php');
    }

    function showAddForm()
    {
        $areas = $this->employeeModel->getAreas();
        $roles = $this->employeeModel->getRoles();
        require_once(ROOTPATH.'/views/employees/add_or_update_employee.php');
    }

    function addEmployee() 
    {
        $con = Database::getConnection();

        $name = mysqli_real_escape_string($con, $_POST['full-name']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $gender = mysqli_real_escape_string($con, $_POST['gender']);
        $area_id = mysqli_real_escape_string($con, $_POST['area-id']);
        $description = mysqli_real_escape_string($con, $_POST['description']);
        $release = (isset($_POST['release'])) ? mysqli_real_escape_string($con, $_POST['release']) : '0';
        $roles = $_POST['roles'];

        $successful = $this->employeeModel->addEmployee($name, $email, $gender, $area_id, $release, $description, $roles);

        $message = $successful ? 'Empleado agregado correctamente' : 'Ocurrió un error al agregar el empleado';

        session_start();
        $_SESSION['message'] = $message;

        header('location: index.php?controller=employees&action=get');
    }

    function showUpdateForm() 
    {
        $con = Database::getConnection();
        $id = mysqli_real_escape_string($con, $_GET['id']);
        $areas = $this->employeeModel->getAreas();
        $roles = $this->employeeModel->getRoles();
        $employee = $this->employeeModel->getEmployee($id)->fetch_object();
        $employeeRolesQuery = $this->employeeModel->getEmployeeRoles($id);

        $employeeRoles = [];

        while($rol = $employeeRolesQuery->fetch_object())
            $employeeRoles[] = $rol->rol_id;

        require_once(ROOTPATH.'/views/employees/add_or_update_employee.php');
    }

    function updateEmployee() 
    {
        $con = Database::getConnection();

        $id = mysqli_real_escape_string($con, $_POST['id']);
        $name = mysqli_real_escape_string($con, $_POST['full-name']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $gender = mysqli_real_escape_string($con, $_POST['gender']);
        $area_id = mysqli_real_escape_string($con, $_POST['area-id']);
        $description = mysqli_real_escape_string($con, $_POST['description']);
        $release = (isset($_POST['release'])) ? mysqli_real_escape_string($con, $_POST['release']) : '0';
        $roles = $_POST['roles'];

        $successful = $this->employeeModel->updateEmployee($id, $name, $email, $gender, $area_id, $release, $description, $roles);

        $message = $successful ? 'Empleado modificado correctamente' : 'Ocurrió un error al modificar el empleado';

        session_start();
        $_SESSION['message'] = $message;

        header('location: index.php?controller=employees&action=get');
    }

    function deleteEmployee() 
    {
        $con = Database::getConnection();
        $id = mysqli_real_escape_string($con, $_GET['id']);

        $successful = $this->employeeModel->deleteEmployee($id);

        $message = $successful ? 'Empleado eliminado correctamente' : 'Ocurrió un error al eliminar el empleado';

        session_start();
        $_SESSION['message'] = $message;

        header('location: index.php?controller=employees&action=get');
    }
}
