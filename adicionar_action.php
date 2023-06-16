<?php 
session_start();
require "databaseConnection/backend.php";

## RECEBENDO OS DADOS DO FORMULÁRIO: ##
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS); // Não permite que o digire algum dado malicioso: <script> alert('Você é gay') </script>
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL); //COM O FILTER_VALIDATE_EMAIL POSSO VERIFICAR SE O DADO É UM EMAIL VÁLIDO.
$age = filter_input(INPUT_POST, 'age', FILTER_SANITIZE_NUMBER_INT); // O FILTER_SANITIZE_NUMBER_INT RETIRA TODO DADO QUE NÃO FOR NÚMERO E DEIXAR APENAS NÚMERO. KSKSKS

## VERIFICANDO SE OS DOIS DADOS FORAM PREENCHIDOS: ##
if ($name && $email) {
    //CONSULTA PARA VERIFICAR SE O EMAIL INFORMADO PELO USUÁRIO JÁ EXISTE NO BANCO
    $bdConsult = $pdo->prepare("SELECT * FROM tb_users WHERE email = :email");
    $bdConsult->bindParam(':email', $email);
    $bdConsult->execute();
   
    if ($bdConsult->rowCount() === 0) { // NESSE CASO AQUI ESTOU VERIFICANDO COMO NÃO EXITE NENHUMA LINHA COM E-MAIL IGUAL, POSSO FAZER A INSERÇÃO
        $bdConsult = $pdo->prepare("INSERT INTO tb_users (nome, email, age) VALUES (:name, :email, :age)"); // PREPARANNDO A CONSULTA
        $bdConsult->bindParam(':name', $name); //ATRIBUINDO O DADO RECEBIDO DO FORMULÁRIO NA CONSULTA
        $bdConsult->bindParam(':email', $email);
        $bdConsult->bindParam(':age', $age);
        $bdConsult->execute(); // JOGANDO TAIS DADOS NA QUERY
        header("Location: index.php"); // RETORNANDO À PAGINA PRINCIPAL
        exit; // ENCERRANDO O IF POR COMPLETO.
   }else {
        $_SESSION['aviso'] = '<script> alert("E-MAIL INFORMADO JÁ EXISTE") </script>';
        header("Location: adicionar.php");// PERMANECE NA MESMA PÁGINA, OBRIGANDO O USUÁRIO PREENCHER CORRETAMENTE.
        exit;
   }
    
    

}

