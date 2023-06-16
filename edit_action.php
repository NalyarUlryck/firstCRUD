<?php 
session_start();
require "databaseConnection/backend.php";


## SETANDO O RECEBIMENTO DOS DADOS DO FORMULÁRIO edit.php: ##
$id = filter_input(INPUT_POST,'id');
$name = filter_input(INPUT_POST, 'name');
$age = filter_input(INPUT_POST, 'age', FILTER_SANITIZE_NUMBER_INT); //RETIRA
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL); //COM O FILTER_VALIDATE_EMAIL POSSO VERIFICAR SE O DADO É UM EMAIL VÁLIDO.

if ($name && $email) {
    //CONSULTA PARA VERIFICAR SE O EMAIL INFORMADO PELO USUÁRIO JÁ EXISTE NO BANCO
    $bdConsult = $pdo->prepare("SELECT * FROM tb_users WHERE email = :email");
    $bdConsult->bindParam(':email', $email);
    $bdConsult->execute();
    
    ## VERIFICANDO SE OS DOIS DADOS FORAM PREENCHIDOS: ##
    if ($bdConsult->rowCount() === 0) {
    
        //FAZ A ATUALIZAÇÃO DOS DADOS QUE ESTÃO NO BANCO BASEANDO-SE PELO ID
        $bdConsult = $pdo->prepare('UPDATE tb_users SET nome = :name, age = :age, email = :email WHERE id = :id');
        $bdConsult->bindValue(':name',$name);
        $bdConsult->bindValue(':age', $age);
        $bdConsult->bindValue(':email', $email);
        $bdConsult->bindValue(':id',$id);
        $bdConsult->execute();
        echo "não deu";
       header("Location: index.php");
       exit;
    

    }else{
        $_SESSION['aviso'] = '<script> alert("O e-mail informado já existe") </script>';
        $_SESSION['id'] = $id;
        var_dump($id);
        header("Location: edit.php");// PERMANECE NA MESMA PÁGINA, OBRIGANDO O USUÁRIO PREENCHER CORRETAMENTE.
        exit;
    }

}


