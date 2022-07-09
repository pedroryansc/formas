<?php
    require_once("../autoload.php");

    $acao = isset($_GET["acao"]) ? $_GET["acao"] : "";
    $id = isset($_GET["id"]) ? $_GET["id"] : 0;

    if($acao == "excluir"){
        try{
            $tri = new Triangulo($id, 1, 1, 1, 1, 1);
            $tri->excluir();
            header("location:../index/triangulo.php");
        } catch(Exception $e){
            echo "Erro ao excluir triângulo <br>".
                "<br>".
                $e->getMessage();
        }
    }

    $acao = isset($_POST["acao"]) ? $_POST["acao"] : "";

    if($acao == "salvar"){
        $ladoA = isset($_POST["ladoA"]) ? $_POST["ladoA"] : 0;
        $ladoB = isset($_POST["ladoB"]) ? $_POST["ladoB"] : 0;
        $ladoC = isset($_POST["ladoC"]) ? $_POST["ladoC"] : 0;
        $cor = isset($_POST["cor"]) ? $_POST["cor"] : "";
        $tabuleiro = isset($_POST["tabuleiro"]) ? $_POST["tabuleiro"] : 0;
        $tri = new Triangulo($id, $ladoA, $ladoB, $ladoC, $cor, $tabuleiro);
        if($id == 0){
            try{
                $tri->insere();
            } catch(Exception $e){
                echo "Erro ao criar triângulo <br>".
                    "<br>".
                    $e->getMessage();
            }
        } else{
            try{
                $tri->editar();
            } catch(Exception $e){
                echo "Erro ao editar os dados do triângulo <br>".
                    "<br>".
                    $e->getMessage();
            }
        }
        header("location:../index/triangulo.php");
    }
?>