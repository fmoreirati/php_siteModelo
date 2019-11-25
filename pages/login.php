<section class="container">
    <form method="POST">
        <div class="form-group">
            <label for="exampleInputEmail1">E-mail</label>
            <input type="email" class="form-control" id="exampleInputEmail1" name="email">
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Senha</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="pws">
        </div>

        <button type="submit" class="btn btn-primary">Entrar</button>
        <button type="reset" class="btn btn-primary">Cancelar</button>
    </form>
</section>
<?php
if (isset($_POST["email"]) && isset($_POST["pws"])) {
    if (!empty($_POST["email"]) || !empty($_POST["pws"])) {
        require_once("./model/usuario.php");
        $user = new Usuario;
        $result = $user->login($_POST['email'], $_POST['pws']);
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        if ($result) {
            $user = $result[0];
            $user->pws = "";
            $_SESSION["user"] = $user;
            //header("Location: index.php");
            echo '<script> location.replace("/"); </script>';
        } else {
            erro("Usuario não localizado!");
        }
    } else {
        erro("Campo em branco!");
    }
}
?>