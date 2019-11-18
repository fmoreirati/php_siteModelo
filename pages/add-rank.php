<?php
include_once("../config.php");
include_once("mensagens.php");
if (!empty($_REQUEST)) {
    var_dump($_REQUEST);
    try {
        require_once("../model/dao.php");
        $sql = "insert into ranck(uid_usuario, uid_game, pontos) values (:uid_usuario, :uid_game, :pontos)";
        $dao = new Dao;
        $stman = $dao->conecta()->prepare($sql);
        $stman->bindParam(":uid_usuario",$_REQUEST['id']);
        $stman->bindParam(":uid_game", $_REQUEST['game']);
        $stman->bindParam(":pontos", $_REQUEST['pontos']);
        $stman->execute();
        aviso("Salvo!");
    } catch (Exception $e) {
        erro("Erro: " .  $e->getMessage());
    }
   
}
?>