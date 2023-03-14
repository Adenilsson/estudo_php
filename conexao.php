<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 

    $id = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
    $nome = (isset($_POST["nome"]) && $_POST["nome"] != null) ? $_POST["nome"] : "";
    $email = (isset($_POST["email"]) && $_POST["email"] != null) ? $_POST["email"] : "";
    $celular = (isset($_POST["celular"]) && $_POST["celular"] != null) ? $_POST["celular"] : NULL;
    echo "nome ".$_POST["nome"]."<br>";
    echo "email ".$_POST["email"]."<br>";
    echo "celular ".$_POST["celular"]."<br>";
} else if (!isset($id)) {
    // Se não se não foi setado nenhum valor para variável $id
    $id = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
    $nome = NULL;
    $email = NULL;
    $celular = NULL;
}
 try {
    $conexao = new PDO("mysql:host=localhost; dbname=crudsimples", "root", NULL);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexao->exec("set names utf8");
} catch (PDOException $erro) {
    echo "Erro na conexão:" . $erro->getMessage();
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $nome != "") {
    try {
        $stmt = $conexao->prepare("INSERT INTO contatos (nome, email, celular) VALUES (?, ?, ?)");
        $stmt->bindParam(1, $nome);
        $stmt->bindParam(2, $email);
        $stmt->bindParam(3, $celular);
         
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                echo "Dados cadastrados com sucesso!";
                $id = null;
                $nome = null;
                $email = null;
                $celular = null;
            } else {
                echo "Erro ao tentar efetivar cadastro";
            }
        } else {
               throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: " . $erro->getMessage();
    }
}
?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
 </head>
 <body>
    <form action="?act=save" method="POST" name="form1">
        <h1>Agenda de Contatos</h1>
        <hr>
        <input Type="hidden" name="id" <?php 
        if(isset($id)&& $id != null || $id != ""){
            echo "values=\"{$id}\"";
        }
        ?>>

        Nome:
        <input type="text" name="nome" <?php 
        if(isset($nome) && $nome != null || $nome != ""){
            echo "value=\"{$nome}\"";
        }
        ?>>
        Email: 
        <input type="email" name="email" <?php 
        if(isset($email) && $email != null || $email != ""){
            echo "value=\"{$email}\"";
        }
        ?>>
        Celular:
        <input type="text" name="celular" <?php 
        if(isset($celular) && $celular != null || $celular != ""){
            echo "value=\"{$celular}\"";
        }
        ?>>
        <input type="submit" value="Salvar">
        <input type="reset" value="Novo">
        <hr>
 </body>
 </html>

  <!--https://alexandrebbarbosa.wordpress.com/2016/09/04/php-pdo-crud-completo/-->