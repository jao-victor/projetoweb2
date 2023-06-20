<?php

session_start();


$login = $_POST['login'];
$senha = $_POST['senha'];

try {
    $conexao = new PDO("pgsql:host=localhost; port=5432 ;dbname= web2", "postgres", "@JoaoVictor10");
    
}catch(PDOException $e) {
      echo 'Erro ao conectar ao banco de dados: : ' . $e->getMessage();
}


try{

    $sql = "SELECT * FROM aluno WHERE login = '{$login}' AND senha = '{$senha}'";
    $stmt = $conexao->prepare($sql);
    $stmt->execute();
    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //var_dump($resultado);

    //var_dump($resultado[0]['login']);

    if ($resultado) {

        $_SESSION['login'] = $resultado[0]['login'];
        $_SESSION['senha'] = $resultado[0]['senha'];
        

        setcookie('login', $resultado[0]['nome'], time() + (86400 * 30), "/");
        //var_dump($_COOKIE['login']);
        header("Location: index.php");
        exit();
    }
    else {
        // A linha não foi encontrada
        echo "Nenhum resultado encontrado.";
    }


}catch(PDOException $e){
    die("Ocorreu um erro " . $e->getMessage());
}


?>