<?php

define('ROOTPATH', realpath(__DIR__));

$controller = $_GET['controller'] ?? 'home';
$action = $_GET['action'] ?? '';

if ($controller != 'home') require_once(ROOTPATH.'/controllers/'.$controller.'_controller.php');

switch ($controller) {

    case 'home':
        require_once(ROOTPATH.'/views/home.php');
        break;

    case 'employees':
        $controllerObj = new EmployeesController();
        switch($action) {
            case 'get':
                $controllerObj->getEmployees();
                break;

            case 'show_add_form':
                $controllerObj->showAddForm();
                break;

            case 'add':
                $controllerObj->addEmployee();
                break;

            case 'show_update_form':
                $controllerObj->showUpdateForm();
                break;

            case 'update':
                $controllerObj->updateEmployee();
                break;

            case 'delete':
                $controllerObj->deleteEmployee();
                break;
        }
        break;
}
