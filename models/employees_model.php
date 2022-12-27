<?php

require_once('settings/database.php');

class EmployeesModel
{
    private $connection = null;

    function __construct()
    {
        $this->connection = Database::getConnection();
    }

    function getEmployees()
    {
        return mysqli_query($this->connection, "SELECT e.id, e.nombre, e.email, e.sexo, a.nombre AS 'area', e.boletin, e.descripcion FROM `empleados` AS e INNER JOIN `areas` AS a ON a.id = e.area_id;");
    }

    function getEmployee($id)
    {
        return mysqli_query($this->connection, "SELECT e.id, e.nombre, e.email, e.sexo, e.area_id, e.boletin, e.descripcion FROM `empleados` AS e WHERE e.id = $id;");
    }

    function getEmployeeRoles($id) 
    {
        return mysqli_query($this->connection, "SELECT `rol_id` FROM `empleado_rol` WHERE `empleado_id` = '$id';");
    }

    function getAreas() 
    {
        return mysqli_query($this->connection, "SELECT `id`, `nombre` FROM `areas`;");
    }

    function getRoles() 
    {
        return mysqli_query($this->connection, "SELECT `id`, `nombre` FROM `roles`;");
    }

    function addEmployee($name, $email, $gender, $area_id, $release, $description, $roles)
    {
        $result = mysqli_query($this->connection, "INSERT INTO `empleados`(`nombre`, `email`, `sexo`, `area_id`, `boletin`, `descripcion`) 
                                                    VALUES ('$name', '$email', '$gender', '$area_id', '$release', '$description');");

        $employeeId = $this->connection->insert_id;

        foreach($roles as $rol)
            mysqli_query($this->connection, "INSERT INTO `empleado_rol`(`empleado_id`, `rol_id`) VALUES ('$employeeId', '$rol')");
        
        return $result;
    }

    function updateEmployee($id, $name, $email, $gender, $area_id, $release, $description, $roles)
    {
        $result = mysqli_query($this->connection, "UPDATE `empleados` SET 
                                                        `nombre` = '$name', 
                                                        `email` = '$email', 
                                                        `sexo` = '$gender', 
                                                        `area_id` = '$area_id', 
                                                        `boletin` = '$release', 
                                                        `descripcion` = '$description' 
                                                        WHERE `id` = '$id';");

        mysqli_query($this->connection, "DELETE FROM `empleado_rol` WHERE `empleado_id` = '$id';");

        foreach($roles as $rol)
            mysqli_query($this->connection, "INSERT INTO `empleado_rol`(`empleado_id`, `rol_id`) VALUES ('$id', '$rol')");

        return $result;
    }

    function deleteEmployee($id)
    {
        mysqli_query($this->connection, "DELETE FROM `empleado_rol` WHERE `empleado_id` = '$id';");

        return mysqli_query($this->connection, "DELETE FROM `empleados` WHERE `id` = $id;");
    }
}
