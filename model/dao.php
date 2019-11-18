<?php
class Dao
{
    const HOST = "localhost";
    const USER = "root";
    const PASS = "Fsm@12345";
    const DB = "jogo";

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
