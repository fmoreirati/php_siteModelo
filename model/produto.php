<?php
class Produto
{
    public $uid;
    public $nome;
    public $descricao;

    public function add()
    {
        try {
            require_once("dao.php");
            $sql = "insert into produto(nome, descricao) value (:nome, :descricao)";
            $dao = new Dao;
            $stman = $dao->conecta()->prepare($sql);
            $stman->bindParam(":nome", $this->nome);
            $stman->bindParam(":descricao", $this->descricao);
            $stman->execute();
            aviso("salvo!");
        } catch (Exception $e) {
            erro("erro " .  $e->getMessage());
        }
    }

    public function listAll(){
        $result = null;
        try {
            require_once("dao.php");
            $sql = "select * from produto";
            $dao = new Dao;
            $stman = $dao->conecta()->prepare($sql);
            //$stman->bindParam(":nome", $this->nome);
            $stman->execute();
            $result = $stman->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            erro("erro " .  $e->getMessage());
        }
        return $result;
    }
}
?>