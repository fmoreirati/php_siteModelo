<section class="container">
    <?php
    require_once("./model/produto.php");
    $produto = new Produto;
    foreach ($produto->listAll() as $p) {
        echo "
            <div class='card col-4'>
            <img src='img\box.png' class='card-img-top' alt='...'>
            <div class='card-body'>
                <h5 class='card-title'>$p->nome</h5>
                <p class='card-text'>$p->descricao</p>
                <p class='card-text text-danger'>$p->valor</p>
                <p class='card-text'>Unidades: $p->quant</p>
                <a href='?p=carrinho&add=$p->id' class='btn btn-danger'>Comprar</a>
            </div>
        </div>";
    }
    ?>
</section>