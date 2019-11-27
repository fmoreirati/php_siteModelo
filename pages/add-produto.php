<?php
require_once("./model/produto.php");
if (!isset($produto))
    $produto = new Produto;
if (!empty($_POST)) {
    try {
        $produto->nome = $_POST['nome'];
        $produto->descricao = $_POST['descricao'];
        $produto->quant = $_POST['quant'];
        $produto->valor = $_POST['valor'];
    
        $erros = $produto->validar();
        if ($erros == "") {
            $produto->add();
            $produto = new Produto;
        } else {
            erro($erros);
        }
    } catch (Exception $e) {
        erro("Erro: " . $e->getMessage());
    }
}
?>

<section class="container">
    <form method="POST"  method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" require value='<?= $produto->nome; ?>'>
        </div>
        
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <input type="text" class="form-control" id="descricao" name="descricao" require value='<?= $produto->descricao; ?>'>
        </div>

        <div class="form-group">
            <label for="quant">Quantidade</label>
            <input type="number" class="form-control" id="quant" name="quant" require value='<?= $produto->quant; ?>'>
        </div>

        <div class="form-group">
            <label for="valor">Valor</label>
            <input type="number" class="form-control" id="valor" name="valor" require value='<?= $produto->valor; ?>'>
        </div>

        <div class="form-group">
            <label for="foto1">Foto 1</label>
            <input type="file" class="form-control" id="foto1" name="fotos[]" require value='<?= $produto->foto1; ?>'>
        </div>
        <div class="form-group">
            <label for="foto2">Foto 2</label>
            <input type="file" class="form-control" id="foto2" name="fotos[]" require value='<?= $produto->foto2; ?>'>
        </div>
        <div class="form-group">
            <label for="foto3">Foto 3</label>
            <input type="file" class="form-control" id="foto3" name="fotos[]" require value='<?= $produto->foto3; ?>'>
        </div>
        <div class="form-group">
            <label for="foto4">Foto 4</label>
            <input type="file" class="form-control" id="foto4" name="fotos[]" require value='<?= $produto->foto4; ?>'>
        </div>
        <div class="form-group">
            <label for="foto5">Foto 5</label>
            <input type="file" class="form-control" id="foto5" name="fotos[]" require value='<?= $produto->foto5; ?>'>
        </div>
      
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <button type="reset" class="btn btn-primary">Cancelar</button>
        </div>
    </form>
</section>