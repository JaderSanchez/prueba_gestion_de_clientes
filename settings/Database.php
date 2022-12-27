<?php

class Database
{
    private const HOST = 'localhost';
    private const USER = 'my_root';
    private const PASSWORD = '111';
    private const DATABASE = 'prueba_gestion_de_clientes';

    static function getConnection()
    {
        try {

            $connection = mysqli_connect(self::HOST, self::USER, self::PASSWORD, self::DATABASE);

            if (mysqli_connect_errno())
                echo "Error en la conexión (1): " . mysqli_connect_error();
            else
                return $connection;
        } catch (Exception $e) {
            echo "Error en la conexión (2): " . $e->getMessage();
            die();
        }
    }
}
