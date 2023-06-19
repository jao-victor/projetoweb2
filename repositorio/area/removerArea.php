<?php
try{
    $conexao = new PDO("mysql:host=localhost; dbname=projetoweb2","root","root123");
}catch(PDOException $e){
    die("Ocorreu um erro inesperado " . $e->getMessage());
}

$idArea = $_GET['idArea'];

try{
    $sql = "delete from area where idArea = " . $idArea;
    $conexao->exec($sql);
    echo "Removido com sucesso !!!";
}catch(PDOException $e){
    die("Ocorreu um erro " . $e->getMessage());
}
header('Location: ../../view/campus/buscarCampus.php');
?>