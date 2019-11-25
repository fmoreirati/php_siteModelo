<?php
class Dao
{
    // const HOST = "localhost";
    // const USER = "root";
    // const PASS = "usbw";
    // const DB = "php_sitemodelo";

    const HOST = "localhost";
    const USER = "id11511692_admin";
    const PASS = "Abc@12345";
    const DB = "id11511692_lomop";

    function conecta()
    {
        $pdo = null;
        try {
            $pdo = new PDO('mysql:host=' . self::HOST . ';dbname=' . self::DB, self::USER, self::PASS);
            //$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        return $pdo;
    }
}
