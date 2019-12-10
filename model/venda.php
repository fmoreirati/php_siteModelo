<?php
class Venda
{
    public $id;
    public $data;
    public $valor;
    public $aberto;
    public $uid_usuario;
   

    public function add()
    {
        try {
            require_once("dao.php");
            $sql = "insert into venda(valor, uid_usuario)
            value (:valor, :uid)";
            $dao = new Dao;
            $stman = $dao->conecta()->prepare($sql);
            $stman->bindParam(":valor", $this->valor);
            $stman->bindParam(":uid", $this->uid_usuario);
            $stman->execute();
            aviso("Cadastrado!");
        } catch (Exception $e) {
            erro("Erro: " .  $e->getMessage());
        }
    }

    public function listAll(){
        $result = null;
        try {
            require_once("dao.php");
            $sql = "select * from venda where uid_usuario = :uid_usuario";
            $dao = new Dao;
            $stman = $dao->conecta()->prepare($sql);
            $stman->bindParam(":uid", $this->uid_usuario);
            $stman->execute();
            $result = $stman->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            erro("erro " .  $e->getMessage());
        }
        return $result;
    }

    public function get($uid)
    {
        $result = null;
        try {
            require_once("dao.php");
            $sql = "select * from venda where uid_usuario = :id";
            $dao = new Dao;
            $stman = $dao->conecta()->prepare($sql);
            $stman->bindParam(":id", $uid);
            $stman->execute();
            $result = $stman->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            erro("Erro: " .  $e->getMessage());
        }
        return $result;
    }
}
