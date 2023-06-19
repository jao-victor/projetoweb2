<?php
if (!isset($_SESSION)) session_start();

if (!isset($_SESSION['login'])) {
    // Destrói a sessão por segurança
    session_destroy();
    // Redireciona o visitante de volta pro login
    header("Location: login.html"); exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<?php $path = 'http://' . $_SERVER["HTTP_HOST"] . '/projetoweb2'; ?>

<head>
    <meta charset="UTF-8">
    <title>Cadastro de Curso</title>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <link href="<?php echo $path; ?>/arquivos/css/bootstrap.min.css" rel="stylesheet">
    <script src="<?php echo $path; ?>/arquivos/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="<?php echo $path; ?>/arquivos/js/busca.cep.js"></script>
</head>

<body>
    <?php include("../../menu.php") ?>
    <div class="container">
        <div class="row mb-4 mt-4">
            <div class="alert alert-light" role="alert">
                <h1>Cadastro de Curso</h1>
            </div>
        </div>
        <form action="<?php echo $path; ?>/repositorio/curso/salvarCurso.php" method="POST">
            <div class="row mb-3">
                <div class="col col-md-9">
                    <label class="form-label" for="idnome">Nome do Curso</label>
                    <input class="form-control" type="text" name="nome" id="idnome">
                </div>
                <div class="col col-md-3">
                    <label class="form-label" for="idnota">Nota do Curso</label>
                    <input class="form-control" type="number" name="nota" id="idnota">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col col-md-6">
                    <label class="form-label" for="idarea">Área</label>
                    <?php
            try{
                $conexao = new PDO("mysql:host=localhost; dbname=projetoweb2", "root", "root123");
            }catch(PDOException $e){
                die('aconteceu um erro: ' . $e->getMessage());
            }

            try{
                $sql = "select * from area";
                $resultado = $conexao->query($sql);
                if($resultado->rowCount() > 0){
                    ?>
                    
                    <select class="form-control" name="area" id="idArea">

                    <?php
                    while($linha = $resultado->fetch()){
                       echo "<option value=\"". $linha['idArea'] ."\">". $linha['nomeArera'] ."</option>";
                    }
                    ?>
                    </select>
                    <?php
                }
            }catch(PDOException $e){
                die('aconteceu um erro: ' . $e->getMessage());
            }
            ?>
                </div>
                <div class="col col-md-6">
                    <label class="form-label" for="idcampus">Campus</label>
                    <?php
                        try{
                            $sql = "select * from campus";
                            $resultado = $conexao->query($sql);
                            if($resultado->rowCount() > 0){
                                ?>
                                
                                <select class="form-control" name="campus" id="idCampus">
            
                                <?php
                                while($linha = $resultado->fetch()){
                                   echo "<option value=\"". $linha['idCampus'] ."\">". $linha['nomeCampus'] ."</option>";
                                }
                                ?>
                                </select>
                                <?php
                            }
                        }catch(PDOException $e){
                            die('aconteceu um erro: ' . $e->getMessage());
                        }
                    ?>
                </div>
            </div>            
            <input class="btn btn-primary" type="submit" value="Salvar">
        </form>
    </div>
</body>

</html>