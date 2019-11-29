<?php
require_once("./model/venda_produto.php");
require_once("./model/produto.php");
require_once("./model/usuario.php");

$produtos = array();

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (isset($_SESSION["produtos"])) {
    $produtos = $_SESSION["produtos"];
    echo "<pre>";
    var_dump($_SESSION["produtos"]);
}

if (isset($_GET['add'])) {
    $produto = new Produto;
    $dadosProd = $produto->get($_GET['add']);
    array_push($produtos, $dadosProd);
    $_SESSION["produtos"] = $dadosProd;
}
//session_destroy();
?>

<style>
    .produtopq {
        max-width: 50px
    }
</style>
<section class="container">
    <div class="row">
        <p class="col-md-6">
            <a href="index.jsp">
                <button type="button" class="btn btn-primary"> Escolher + Produto </button>
            </a>
        </p>
        <p class="col-md-6 text-right">
            <button class="btn btn-danger"> Realizar Pagamento </button>
            <input type="hidden" value='' name="total" class="form-control campo" id="total" disabled />
        </p>
    </div>

    <div class="table-responsive">
        <table class="table">
            <tr class=''>
                <th class="">Produto</th>
                <th class="">Quantidade</th>
                <th class="">Valor Unit.</th>
                <th class="">Valor Total</th>
                <th class=""> <i class="fa fa-remove"></i></th>
            </tr>

            <?php foreach ($produtos as $p) { ?>
                <input type="hidden" value="" name="id" />
                <tr>
                    <td class="row">
                        <div class="col-6">
                            <img src='<?= "img/produtos/" . $p->foto1 ?>' title="" alt="" class="img-fluid produtopq">
                        </div>
                        <div class="col-6"><?= $p->nome ?></div>
                    </td>

                    <td class="">
                        <input type="number" name="quant" value="<?= $p->quant ?>" min="1" max="10" step="1" class="form-control" onchange="execute(this.form)" />
                    </td>

                    <td class="">
                        <input type="text" name="valor" min="0.00" step="0.01" value='' disabled class="form-control campo" />
                    </td>

                    <td class="">
                        <input type="text" name="valorItem" min="0.00" step="0.01" value='' disabled class="form-control campo valores" />
                    </td>

                    <td class=""><a href=""></i></a></td>
                </tr>
            <?php } ?>
        </table>
    </div>
    </form>

    <div class="row">
        <div class="col-md-8">
            <p> Simule o prazo de entrega e o frete para seu CEP abaixo:</p>
            <form action="index.php?p=carrinho&acao=frete" method="get" class="form-inline">
                <div class="form-group">
                    <input type="text" name="cep" class="form-control" />
                    <button class="btn btn-primary"> OK </button>
                </div>
                <div class="form-group ml-1">
                    <a href="">
                        <button class="btn btn-danger"> Não sei meu CEP </button>
                    </a>
                </div>
                <div class="well pt-5">
                    <h4>Atenção:</h4>
                    <p>
                        O prazo começa a contar a partir da aprovação do pagamento.<br>
                        Os produtos podem ser entregues separadamente.<br>
                    </p>
                </div>
            </form>
        </div>
        <div class="col-md-4 well">
            <strong>
                <p>Produtos: </p>
                <p>Frete(?): </p>
            </strong>
            <h3 style="border-top: solid 2px #222;padding: 10px 0">Total:
            </h3>

            <p><strong>Possui cupom ou vale? </strong>Você poderá usá-los na etapa de pagamento.</p>
        </div>

    </div>

    <script>
        // window.onload(execute(this.form));
        function execute(frm) {
            frm.action = "sys?logica=Carrinho&acao=calc";
            frm.submit();
        }
    </script>
</section>