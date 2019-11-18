<section class="container">
    <table class="table">
        <tr>
            <th> ID </th>
            <th> Nome </th>
            <th> NickName </th>
            <th> E-mail </th>
            <th> Senha </th>
        </tr>
        <?php
        require_once("./model/usuario.php");
        $user = new Usuario;
        foreach ($user->listAll() as $u) {
            echo "
                <tr>
                    <td> $u->uid </td>
                    <td> $u->nome </td>
                    <td> $u->nickname </td>
                    <td> $u->email </td>
                    <td> $u->senha </td>
                </tr>";
        }
        ?>
    </table>
</section>