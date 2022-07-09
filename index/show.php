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
    <title>Apresentação</title>
</head>
<body>
    <?php
        if($obj == "quad"){
            $linha = listaQuadrado(1, $id);
            $quad = new Quadrado($linha[0]["idquadrado"], $linha[0]["lado"], $linha[0]["cor"], $linha[0]["tabuleiro_idtabuleiro"]);
            echo $quad->desenha();
        } else if($obj == "tri"){
            $linha = listaTriangulo(1, $id);
            $tri = new Triangulo($linha[0]["idtriangulo"], $linha[0]["ladoA"], $linha[0]["ladoB"], $linha[0]["ladoC"], $linha[0]["cor"], $linha[0]["tabuleiro_idtabuleiro"]);
            echo $tri->desenha();
        } else if($obj == "ret"){
            $linha = listaRetangulo(1, $id);
            $ret = new Retangulo($linha[0]["idretangulo"], $linha[0]["base"], $linha[0]["altura"], $linha[0]["cor"], $linha[0]["tabuleiro_idtabuleiro"]);
            echo $ret->desenha();
        } else{
            $linha = listaTabuleiro(1, $id);
            $tab = new Tabuleiro($linha[0]["idtabuleiro"], $linha[0]["lado"]);
            echo $tab->desenha();
        }
    ?>
</body>
</html>