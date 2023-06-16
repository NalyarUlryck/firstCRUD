<?php 
    require "databaseConnection/backend.php";

    $id = filter_input(INPUT_GET,'id'); // varivel que vai receber o ID
    
    if ($id) { //aqui estou verificando se o ID não é nulo
        $bdConsult = $pdo->prepare('DELETE FROM tb_users WHERE id = :id');
        $bdConsult->bindValue(':id', $id);
        $bdConsult->execute();
    }
    // DANDO CERTO OU ERRADO ELE TERÁ DE VOLTAR PRO INDEX, LOGO, TEM QUE FIACAR DO LADO DE FORA.
    header("Location: index.php");
        exit;
?>