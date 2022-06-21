<!DOCTYPE html>
<?php
    require_once("../utils.php");

    $obj = isset($_GET["obj"]) ? $_GET["obj"] : "";
    $id = isset($_GET["id"]) ? $_GET["id"] : 0;
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apresentação - Quabulário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="shortcut icon" href="../fav/favicon.ico">
</head>
<body>
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="../principal.php">
                <img src="../img/IFCriodosul.png" alt="Instituto Federal Catarinense - Campus Rio do Sul" width="230" class="d-inline-block align-top">
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <span><b>Quabulário | </a></span>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-success" aria-current="page" href="quadrado.php">Quadrado</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-success" aria-current="page" href="tabuleiro.php">Tabuleiro</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-success" aria-current="page" href="usuario.php">Usuário</a>
                    </li>
                </ul>
            </div>
            <div class="d-flex">
                <a class="nav-link text-success" href="../menu.html">Sair</a>
            </div>
        </div>
    </nav></b>
    <div id="body">
        <br>
        <?php
            if($obj == "quad"){
                $linha = listaQuadrado(1, $id);
                $quad = new Quadrado($linha[0]["idquadrado"], $linha[0]["lado"], $linha[0]["cor"], $linha[0]["tabuleiro_idtabuleiro"]);
                echo $quad->desenha();
            } else{
                $linha = listaTabuleiro(1, $id);
                $tab = new Tabuleiro($linha[0]["idtabuleiro"], $linha[0]["lado"]);
                echo $tab->desenha();
            }
        ?>
    </div>
    <br>
    <br><br><br><br><br>
    <br><br><br><br><br>
    <br><br><br><br><br>
    <br><br><br><br><br>
    <br>
    <footer class="footer mt-auto py-3 bg-success">
        <center>  
            <div class="container">
                <span class="text-light"><br> ©2022 3º INFO</span>
            </div>
        </center>
    </footer>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>