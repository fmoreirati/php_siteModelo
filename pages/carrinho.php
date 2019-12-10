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
    // echo "<pre>";
    // var_dump($_SESSION["produtos"]);
    // echo "</pre>";
}

if (isset($_GET['add'])) {
    $produto = new Produto;
    $dadosProd = $produto->get($_GET['add']);
    array_push($produtos, $dadosProd);
    $_SESSION["produtos"] = $produtos;
    header("Location: index.php?p=carrinho");
}

if (isset($_GET['remove'])) {
    array_splice($produtos, $_GET['remove'], 1);
    $_SESSION["produtos"] = $produtos;
}

if (isset($_POST)) {
    var_dump($_POST);
    // $venda = new Venda;
    // $user = $_SESSION["user"];
    // $venda->uid_usuario = $user["id"];
    // $venda->valor = $_POST['total'];
    // $venda->add();
    // $venda->get($user["id"]);
}

//session_destroy();
?>

<style>
    .produtopq {
        max-width: 50px
    }
</style>
<section class="container">
    <form method="post">
        <div class="row">
            <p class="col-md-6">
                <a href="index.php">
                    <button type="button" class="btn btn-primary"> Escolher + Produto </button>
                </a>
            </p>
            <p class="col-md-6 text-right">
                <button class="btn btn-danger"> Realizar Pagamento </button>
                <input type="hidden" value='' name="total" class="form-control campo total" disabled />
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

                <?php foreach ($produtos as $key => $p) { ?>
                    <input type="hidden" value="" name="id" />
                    <tr>
                        <!-- Foto e nome do produto -->
                        <td class="row">
                            <div class="col-6">
                                <img src='<?= "img/produtos/" . $p->foto1 ?>' title="" alt="" class="img-fluid produtopq">
                            </div>
                            <div class="col-6"><?= $p->nome ?></div>
                        </td>
                        <!-- Quantidade -->
                        <td class="">
                            <input type="number" name="quant" value="1" min="1" max='<?= $p->quant ?>' step="1" class="form-control quant" onchange="calc()" />
                        </td>
                        <!-- Valor Unitario -->
                        <td class="">
                            <input type="number" name="valor" min="0.00" step="0.01" value='<?= $p->valor ?>' disabled class="form-control campos" />
                        </td>
                        <!-- Valor da Venda -->
                        <td class="">
                            <input type="number" name="valorItem" min="0.00" step="0.01" disabled class="form-control valores" />
                        </td>

                        <td class=""><a href=<?= "index.php?p=carrinho&remove=$key" ?> onclick="return confirm('Remover Produto')"><i class="fa fa-remove"></i></a></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </form>

    <div class="row">
        <div class="col-md-8">
            <p> Simule o prazo de entrega e o frete para seu CEP abaixo:</p>
            <form action="index.php?p=carrinho&frete" method="get" class="form-inline">
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
                <p>Produtos: <span id="totalprodutos"></span></p>
                <p>Frete(?): <span id="frete"></span></p>
            </strong>
            <h3 style="border-top: solid 2px #222;padding: 10px 0">Total:<span class="total"></span>
            </h3>

            <p><strong>Possui cupom ou vale? </strong>Você poderá usá-los na etapa de pagamento.</p>
        </div>

    </div>

    <script>
        calc()

        // function execute(frm) {
        //     frm.action = "index.php?p=carrinho&acao=calc";
        //     frm.submit();
        // }

        function calc() {
            //Pegar elementos
            let quants = document.getElementsByClassName("quant")
            let campos = document.getElementsByClassName("campos")
            let valores = document.getElementsByClassName("valores")
            let total = document.getElementsByClassName("total")
            let totalproduto = document.getElementById("totalprodutos")
            let frete = document.getElementById("frete")
            var soma = 0.0
            //Atualizar valores
            for (let x = 0; x < quants.length; x++) {
                valores[x].value = (parseFloat(quants[x].value) * parseFloat(campos[x].value))
                soma += parseFloat(valores[x].value)
            }
            //Calcular totais
            let valorFrete = soma * 0.1
            let valorTotal = soma + valorFrete
            total[0].value = valorTotal
            //Mostrar Valores
            totalproduto.innerHTML = "R$" + soma.toFixed(2)
            frete.innerHTML = "R$" + valorFrete.toFixed(2)
            total[1].innerHTML = "R$" + valorTotal.toFixed(2)
        }
    </script>
</section>