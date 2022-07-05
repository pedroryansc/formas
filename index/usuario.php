<!DOCTYPE html>
<?php
    require("../utils.php");

    $acao = isset($_GET["acao"]) ? $_GET["acao"] : "";
    $id = isset($_GET["id"]) ? $_GET["id"] : 0;

    $tipo = isset($_POST["tipo"]) ? $_POST["tipo"] : 0;
    $info = isset($_POST["info"]) ? $_POST["info"] : "";

    $vetor = listaUsuario(1, $id);
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuário</title>
</head>
<body>
    <form action="../ctrl/ctrl_usuario.php?id=<?php echo $id; ?>" method="post">
        Nome: <input type="text" name="nome" value="<?php if($acao == "editar") echo $vetor[0]["nome"]; ?>">
        Login: <input type="text" name="login" value="<?php if($acao == "editar") echo $vetor[0]["login"]; ?>">
        Senha <input type="text" name="senha" value="<?php if($acao == "editar") echo $vetor[0]["senha"]; ?>">
        <br><br>
        <button type="submit" name="acao" value="salvar">Cadastrar</button>
    </form>
    <br>
    <br>
    <form method="post">
        Pesquisar por: <br>
        <input type="radio" name="tipo" value="1" <?php if($tipo == 1) echo "checked"; ?>> ID
        <input type="radio" name="tipo" value="2" <?php if($tipo == 2) echo "checked"; ?>> Nome
        <input type="radio" name="tipo" value="3" <?php if($tipo == 3) echo "checked"; ?>> Login
        <input type="radio" name="tipo" value="4" <?php if($tipo == 4) echo "checked"; ?>> Senha
        <br>
        <input type="search" name="info" placeholder="pesquisa" value="<?php echo $info; ?>"><br>
        <button type="submit">Pesquisar</button>
    </form>
    <br>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Login</th>
                <th>Senha</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <?php
            $lista = listaUsuario($tipo, $info);
            foreach($lista as $linha){
        ?>
            <tr>
                <th><?php echo $linha["idusuario"]; ?></th>
                <td><?php echo $linha["nome"]; ?></td>
                <td><?php echo $linha["login"]; ?></td>
                <td><?php echo $linha["senha"]; ?></td>
                <td><a href="usuario.php?acao=editar&id=<?php echo $linha["idusuario"]; ?>">Editar</a></td>
                <td><a href="javascript:excluirRegistro('../ctrl/ctrl_usuario.php?acao=excluir&id=<?php echo $linha["idusuario"]; ?>')">Excluir</a></td>
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