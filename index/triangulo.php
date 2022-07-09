<!DOCTYPE html>
<?php
    require("../utils.php");

    $acao = isset($_GET["acao"]) ? $_GET["acao"] : "";
    $id = isset($_GET["id"]) ? $_GET["id"] : 0;

    $tipo = isset($_POST["tipo"]) ? $_POST["tipo"] : 0;
    $info = isset($_POST["info"]) ? $_POST["info"] : "";

    $vetor = listaTriangulo(1, $id);
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Triângulo</title>
</head>
<body>
    <?php
        include_once("../menu.html");
    ?>
    <br>
    <form action="../ctrl/ctrl_triangulo.php?id=<?php echo $id; ?>" method="post">
        Lado A: <input type="text" name="ladoA" value="<?php if($acao == "editar") echo $vetor[0]["ladoA"]; ?>"><br>
        <br>
        Lado B: <input type="text" name="ladoB" value="<?php if($acao == "editar") echo $vetor[0]["ladoB"]; ?>"><br>
        <br>
        Lado C: <input type="text" name="ladoC" value="<?php if($acao == "editar") echo $vetor[0]["ladoC"]; ?>"><br>
        <br>
        Cor: <input type="color" name="cor" value="<?php if($acao == "editar") echo $vetor[0]["cor"]; ?>"><br>
        <br>
        Tabuleiro:
        <select name="tabuleiro">
            <?php
                $lista = listaTabuleiro(0, 0);
                foreach($lista as $linha){
            ?>
                <option value="<?php echo $linha["idtabuleiro"]; ?>" <?php if($acao == "editar" && $linha["idtabuleiro"] == $vetor[0]["tabuleiro_idtabuleiro"]) echo "selected"; ?>>
                    <?php echo "Tab. ".$linha["idtabuleiro"]." (Lado - ".$linha["lado"].")"; ?>
                </option>
            <?php
                }
            ?>
        </select><br>
        <br>
        <button type="submit" name="acao" value="salvar">Criar</button>
    </form>
    <br><br>
    <form method="post">
        Pesquisar por: <br>
        <br>
        <input type="radio" name="tipo" value="1" <?php if($tipo == 1) echo "checked"; ?>> ID <br>
        <input type="radio" name="tipo" value="2" <?php if($tipo == 2) echo "checked"; ?>> Lado A <br>
        <input type="radio" name="tipo" value="3" <?php if($tipo == 3) echo "checked"; ?>> Lado B <br>
        <input type="radio" name="tipo" value="4" <?php if($tipo == 4) echo "checked"; ?>> Lado C <br>
        <input type="radio" name="tipo" value="5" <?php if($tipo == 5) echo "checked"; ?>> Cor <br>
        <input type="radio" name="tipo" value="6" <?php if($tipo == 6) echo "checked"; ?>> Tabuleiro <br>
        <br>
        <input type="search" name="info" placeholder="Pesquisa" value="<?php echo $info; ?>"><br>
        <br>
        <button type="submit">Pesquisar</button>
    </form>
    <br>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Lado A</th>
                <th>Lado B</th>
                <th>Lado C</th>
                <th>Cor</th>
                <th>Tabuleiro (ID)</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <?php
            $lista = listaTriangulo($tipo, $info);
            foreach($lista as $linha){
        ?>
        <tr>
            <th><?php echo $linha["idtriangulo"]; ?></th>
            <td><?php echo $linha["ladoA"]; ?></td>
            <td><?php echo $linha["ladoB"]; ?></td>
            <td><?php echo $linha["ladoC"]; ?></td>
            <td><?php echo $linha["cor"]; ?></td>
            <td><?php echo $linha["tabuleiro_idtabuleiro"]; ?></td>
            <td><a href="show.php?obj=tri&id=<?php echo $linha["idtriangulo"]; ?>">Visualizar triângulo</a></td>
            <td><a href="triangulo.php?acao=editar&id=<?php echo $linha["idtriangulo"]; ?>">Editar</a></td>
            <td><a href="javascript:excluirRegistro('../ctrl/ctrl_triangulo.php?acao=excluir&id=<?php echo $linha["idtriangulo"]; ?>')">Excluir</a></td>
        </tr>
        <?php
            }
        ?>
    </table>
</body>
</html>
<script>
    function excluirRegistro(url){
        if(confirm("Este registro será excluído. Tem certeza?"))
            location.href = url;
    }
</script>