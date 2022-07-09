<?php
    require_once("../autoload.php");

    $acao = isset($_GET["acao"]) ? $_GET["acao"] : "";
    $id = isset($_GET["id"]) ? $_GET["id"] : 0;
    
    if($acao == "excluir"){
        try{
            $ret = new Retangulo($id, 1, 1, 1, 1);
            $ret->excluir();
            header("location:../index/retangulo.php");
        } catch(Exception $e){
            echo "Erro ao excluir retângulo <br>".
                "<br>".
                $e->getMessage();
        }
    }

    $acao = isset($_POST["acao"]) ? $_POST["acao"] : "";

    if($acao == "salvar"){
        $base = isset($_POST["base"]) ? $_POST["base"] : 0;
        $altura = isset($_POST["altura"]) ? $_POST["altura"] : 0;
        $cor = isset($_POST["cor"]) ? $_POST["cor"] : "";
        $tabuleiro = isset($_POST["tabuleiro"]) ? $_POST["tabuleiro"] : 0;
        $ret = new Retangulo($id, $base, $altura, $cor, $tabuleiro);
        if($id == 0){
            try{
                $ret->insere();
            } catch(Exception $e){
                echo "Erro ao criar retângulo <br>".
                    "<br>".
                    $e->getMessage();
            }
        } else{
            try{
                $ret->editar();
            } catch(Exception $e){
                echo "Erro ao editar os dados do retângulo <br>".
                    "<br>".
                    $e->getMessage();
            }
        }
        header("location:../index/retangulo.php");
    }
?>