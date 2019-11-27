<?php
require_once("./model/produto.php");
$produto = new Produto;
if (!empty($_GET)) {
    $item = $produto->get($_GET['id']);
    ?>
    <section class="container">
        <h2> <?= $item->nome ?> </h2>
        <p> <?= $item->descricao ?> </p>
        <p> <?= $item->valor ?> </p>
        <p> <?= $item->quant ?></p>
        <p> <?= $item->foto1 ?></p>
        <?= "<a href='?p=carrinho&add=$item->id' class='btn btn-danger'>Comprar</a>" ?>
    </section>
    
<?php } ?>