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
    <title>Usuário - Quabulário</title>
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
        <header>
            <h2>Usuário</h2>
        </header>
        <br>
        <form action="../ctrl/ctrl_usuario.php?id=<?php echo $id; ?>" method="post">
            <div class="form-floating">
                <input type="text" class="form-control" name="nome" placeholder="nome" value="<?php if($acao == "editar") echo $vetor[0]["nome"]; ?>">
                <label for="nome">Nome</label>
            </div>
            <br>
            <div class="form-floating">
                <input type="text" class="form-control" name="login" placeholder="login" value="<?php if($acao == "editar") echo $vetor[0]["login"]; ?>">
                <label for="login">Login</label>
            </div>
            <br>
            <div class="form-floating">
                <input type="text" class="form-control" name="senha" placeholder="senha" value="<?php if($acao == "editar") echo $vetor[0]["senha"]; ?>">
                <label for="senha">Senha</label>
            </div>
            <br><br>
            <div class="d-grid gap-2">
            	<button type="submit" class="btn btn-success btn-lg" name="acao" value="salvar">Cadastrar</button>
        	</div>
        </form>
        <br>
        <br>
        <form method="post">
            Pesquisar por: <br>
            <div class="form-check-sm">
                <input type="radio" class="form-check-input" name="tipo" value="1" <?php if($tipo == 1) echo "checked"; ?>>
                <label class="form-check-label" for="tipo">
                    ID
                </label>
            </div>
            <div class="form-check-sm">
                <input type="radio" class="form-check-input" name="tipo" value="2" <?php if($tipo == 2) echo "checked"; ?>>
                <label class="form-check-label" for="tipo">
                    Nome
                </label>
            </div>
            <div class="form-check-sm">
                <input type="radio" class="form-check-input" name="tipo" value="3" <?php if($tipo == 3) echo "checked"; ?>>
                <label class="form-check-label" for="tipo">
                    Login
                </label>
            </div>
            <div class="form-check-sm">
                <input type="radio" class="form-check-input" name="tipo" value="4" <?php if($tipo == 4) echo "checked"; ?>>
                <label class="form-check-label" for="tipo">
                    Senha
                </label>
            </div>
            <br>
            <div class="form-floating">
                <input type="search" class="form-control" name="info" placeholder="pesquisa" value="<?php echo $info; ?>"><br>
                <label for="pesquisa">Pesquisa</label>
            </div>
            <div class="d-grid gap-2 d-md-flex">
                <button type="submit" class="btn btn-success btn-lg">Pesquisar</button>
        	</div>
        </form>
        <br>
        <table class="table table-hover">
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
        <br><br>
    </div>
    <footer class="footer mt-auto py-3 bg-success">
        <center>  
            <div class="container">
                <span class="text-light"><br>©2022 3º INFO</span>
            </div>
        </center>
    </footer>
</body>
</html>
<script>
    function excluirRegistro(url){
        if(confirm("Este registro será excluído. Tem certeza?"))
            location.href = url;
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>