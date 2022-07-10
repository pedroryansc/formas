<!DOCTYPE html>
<?php
    require("../utils.php");
    
    $acao = isset($_GET["acao"]) ? $_GET["acao"] : "";
    $id = isset($_GET["id"]) ? $_GET["id"] : 0;

    $tipo = isset($_POST["tipo"]) ? $_POST["tipo"] : 0;
    $info = isset($_POST["info"]) ? $_POST["info"] : "";

    $vetor = listaCubo(1, $id);
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cubo</title>
</head>
<body>
    <?php
        include_once("../menu.html");
    ?>
    <br>
    <form action="../ctrl/ctrl_cubo.php?id=<?php echo $id; ?>" method="post">
        Quadrado:
        <select name="quadrado">
            <?php
                $lista = listaQuadrado(0, 0);
                foreach($lista as $linha){
            ?>
                <option value="<?php echo $linha["idquadrado"]; ?>" <?php if($acao == "editar" && $linha["idquadrado"] == $vetor[0]["quadrado_idquadrado"]) echo "selected"; ?>>
                    <?php echo "Quad. ".$linha["idquadrado"]." (Lado - ".$linha["lado"].", Cor - ".$linha["cor"].")"; ?>
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
        <input type="radio" name="tipo" value="2" <?php if($tipo == 2) echo "checked"; ?>> Quadrado (ID) <br>
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
                <th>Quadrado (ID)</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <?php
            $lista = listaCubo($tipo, $info);
            foreach($lista as $linha){
        ?>
        <tr>
            <th><?php echo $linha["idcubo"]; ?></th>
            <td><?php echo $linha["quadrado_idquadrado"]; ?></td>
            <td><a href="show.php?obj=cubo&id=<?php echo $linha["idcubo"]; ?>">Visualizar cubo</a></td>
            <td><a href="cubo.php?acao=editar&id=<?php echo $linha["idcubo"]; ?>">Editar</a></td>
            <td><a href="javascript:excluirRegistro('../ctrl/ctrl_cubo.php?acao=excluir&id=<?php echo $linha["idcubo"]; ?>')">Excluir</a></td>
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