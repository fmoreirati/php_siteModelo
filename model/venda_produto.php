<?php
class Venda_Produto
{
    public $id_venda;
    public $id_produto;
    public $quant;
    public $valor_produto;
    public $valor_total;

    public function add()
    {
        try {
            require_once("dao.php");
            $sql = "insert into venda_produto(id_venda, id_produto, quant, valor_produto, valor_total)
            value (:id_venda, :id_produto, :quant, :valor_produto, :valor_total)";
            $dao = new Dao;
            $stman = $dao->conecta()->prepare($sql);
            $stman->bindParam(":id_venda", $this->id_venda);
            $stman->bindParam(":id_produto", $this->id_produto);
            $stman->bindParam(":quant", $this->quant);
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
            $sql = "select * from venda_produto where id_venda = :id_venda";
            $dao = new Dao;
            $stman = $dao->conecta()->prepare($sql);
            $stman->bindParam(":id_venda", $this->id_venda);
            $stman->execute();
            $result = $stman->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            erro("erro " .  $e->getMessage());
        }
        return $result;
    }
}
