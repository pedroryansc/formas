<?php
    require_once("../autoload.php");

    $acao = isset($_GET["acao"]) ? $_GET["acao"] : "";
    $id = isset($_GET["id"]) ? $_GET["id"] : 0;
    
    if($acao == "excluir"){
        try{
            $cubo = new Cubo($id, 1, 1, 1, 1);
            $cubo->excluir();
            header("location:../index/cubo.php");
        } catch(Exception $e){
            echo "Erro ao excluir cubo <br>".
                "<br>".
                $e->getMessage();
        }
    }

    $acao = isset($_POST["acao"]) ? $_POST["acao"] : "";

    if($acao == "salvar"){
        $quadrado = isset($_POST["quadrado"]) ? $_POST["quadrado"] : 0;
        require_once("../utils.php");
        $linha = listaQuadrado(1, $quadrado);
        $cubo = new Cubo($id, $quadrado, $linha[0]["lado"], $linha[0]["cor"], $linha[0]["tabuleiro_idtabuleiro"]);
        if($id == 0){
            try{
                $cubo->insere();
            } catch(Exception $e){
                echo "Erro ao criar cubo <br>".
                    "<br>".
                    $e->getMessage();
            }
        } else{
            try{
                $cubo->editar();
            } catch(Exception $e){
                echo "Erro ao editar os dados do cubo <br>".
                    "<br>".
                    $e->getMessage();
            }
        }
        header("location:../index/cubo.php");
    }
?>