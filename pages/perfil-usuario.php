<!-- PHP -->
<?php
require_once("./model/usuario.php");
$user = new Usuario;

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
if (isset($_SESSION["user"])) {
    if (!empty($_POST)) {
        try {
            $user->nome = $_POST['nome'];
            $user->email = $_POST['email'];
            $user->nickname = $_POST['nickname'];
            $user->uid = $_SESSION["user"]->uid;
            $user->update();
        } catch (Exception $e) {
            erro("Erro: " . $e->getMessage());
        }
    }
    $dados = $user->get($_SESSION["user"]->uid);
    //var_dump($dados);
} else {
    header("Location: index.php");
}

?>

<section class="container">
    <div class="form-group">
        <button type="button" class="btn btn-primary" onclick="editar()">Editar</button>
    </div>
    <form method="POST">
        <div class="form-group">
            <label for="exampleInput1">Nome</label>
            <input type="text" class="form-control campo" id="exampleInput1" name="nome" value=<?= "$dados->nome" ?> require disabled>
        </div>
        <div class="form-group">
            <label for="exampleInputNick1">NickName</label>
            <input type="text" class="form-control campo" id="exampleInputNick1" name="nickname" value=<?= "$dados->nickname" ?> require disabled>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">E-mail</label>
            <input type="email" class="form-control campo" id="exampleInputEmail1" name="email" require pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" value=<?= "$dados->email" ?> disabled>
        </div>

        <!--  
        <div class="form-group">
            <label for="exampleInputPassword1">Senha</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="pws">
        </div>

        <div class="form-group">
            <label for="exampleInputPassword2">Confirmar senha</label>
            <input type="password" class="form-control" id="exampleInputPassword2" name="condpws">
        </div> -->

        <div class="form-group editar" style="display: none;">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <button type="reset" class="btn btn-primary" onclick="editar()">Cancelar</button>
        </div>

    </form>
</section>

<!-- JavaScrip -->
<script>
    function editar() {
        var objetos = document.querySelectorAll(".editar");
        objetos.forEach(
            function(o) {
                console.log(o);
                if (o.style.display == "none") {
                    o.style.display = "block";
                } else {
                    o.style.display = "none";
                }
            }
        )
        habilitarCampos();
    }

    function habilitarCampos() {
        var campos = document.querySelectorAll(".campo");
        campos.forEach(
            function(c) {
                console.log(c);
                if (c.disabled) {
                    c.disabled = false;
                } else {
                    c.disabled = true;
                }
            }
        )
    }
</script>
