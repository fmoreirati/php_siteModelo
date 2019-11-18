<section class="container">
    <form method="POST">
        <div class="form-group">
            <label for="exampleInput1">Nome</label>
            <input type="text" class="form-control" id="exampleInput1" name="nome" require>
        </div>
        <div class="form-group">
            <label for="exampleInputNick1">NickName</label>
            <input type="text" class="form-control" id="exampleInputNick1" name="nickname" require>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">E-mail</label>
            <input type="email" class="form-control" id="exampleInputEmail1" name="email" require pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Senha</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="pws">
        </div>

        <div class="form-group">
            <label for="exampleInputPassword2">Confirmar senha</label>
            <input type="password" class="form-control" id="exampleInputPassword2" name="condpws">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <button type="reset" class="btn btn-primary">Cancelar</button>
        </div>
    </form>
</section>
<?php

if (!empty($_POST)) {
    try {
        require_once("./model/usuario.php");
        $user = new Usuario;
        // var_dump($_POST);
        $user->nome = $_POST['nome'];
        $user->email = $_POST['email'];
        $user->nickname = $_POST['nickname'];
        $user->pws = $_POST['pws'];
        $user->add();
    } catch (Exception $e) {
        erro("Erro: " . $e->getMessage());
    }
}
?>