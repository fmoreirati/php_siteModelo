<?php
class Produto
{
    public $id;
    public $nome;
    public $descricao;
    public $valor;
    public $quant;
    public $foto1;
    public $foto2;
    public $foto3;
    public $foto4;
    public $foto5;


    public function add()
    {
        try {
            require_once("dao.php");
            $sql = "insert into produto(nome, descricao, quant, valor, foto1, foto2, foto3, foto4, foto5)
            value (:nome, :descricao, :quant, :valor, :foto1, :foto2, :foto3, :foto4, :foto5)";
            $dao = new Dao;
            $stman = $dao->conecta()->prepare($sql);
            $stman->bindParam(":nome", $this->nome);
            $stman->bindParam(":descricao", $this->descricao);
            $stman->bindParam(":quant", $this->quant);
            $stman->bindParam(":valor", $this->valor);
            $stman->bindParam(":foto1", $this->foto1);
            $stman->bindParam(":foto2", $this->foto2);
            $stman->bindParam(":foto3", $this->foto3);
            $stman->bindParam(":foto4", $this->foto4);
            $stman->bindParam(":foto5", $this->foto5);
            $stman->execute();
            aviso("Cadastrado!");
        } catch (Exception $e) {
            erro("Erro: " .  $e->getMessage());
        }
    }

    public function listAll()
    {
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

    public function get($id)
    {
        $result = null;
        try {
            require_once("dao.php");
            $sql = "select * from produto where id = :id";
            $dao = new Dao;
            $stman = $dao->conecta()->prepare($sql);
            $stman->bindParam(":id", $id);
            $stman->execute();
            $result = $stman->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            erro("Erro: " .  $e->getMessage());
        }
        return $result;
    }


    public function validar()
    {
        $erros = "";
        if (empty($this->nome)) {
            $erros .= "Nome embranco!<br>";
        }

        if (empty($this->descricao)) {
            $erros .= "Descrição embranco!<br>";
        }

        if ($this->quant <= 0) {
            $erros .= "Quantidade embranco ou zerada!<br>";
        }

        if ($this->valor <= 0) {
            $erros .= "Valor embranco ou zerada!<br>";
        }

        if (empty($this->foto1)) {
            $erros .= "Foto embranco. Será necessario uma foto!<br>";
        }

        return $erros;
    }
}
