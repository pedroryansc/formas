<?php
    require_once("../autoload.php");

    $acao = isset($_GET["acao"]) ? $_GET["acao"] : "";
    $id = isset($_GET["id"]) ? $_GET["id"] : 0;
    
    if($acao == "excluir"){
        try{
            $cir = new Circulo($id, 1, 1, 1);
            $cir->excluir();
            header("location:../index/circulo.php");
        } catch(Exception $e){
            echo "Erro ao excluir círculo <br>".
                "<br>".
                $e->getMessage();
        }
    }

    $acao = isset($_POST["acao"]) ? $_POST["acao"] : "";

    if($acao == "salvar"){
        $raio = isset($_POST["raio"]) ? $_POST["raio"] : 0;
        $cor = isset($_POST["cor"]) ? $_POST["cor"] : "";
        $tabuleiro = isset($_POST["tabuleiro"]) ? $_POST["tabuleiro"] : 0;
        $cir = new Circulo($id, $raio, $cor, $tabuleiro);
        if($id == 0){
            try{
                $cir->insere();
            } catch(Exception $e){
                echo "Erro ao criar círculo <br>".
                    "<br>".
                    $e->getMessage();
            }
        } else{
            try{
                $cir->editar();
            } catch(Exception $e){
                echo "Erro ao editar os dados do círculo <br>".
                    "<br>".
                    $e->getMessage();
            }
        }
        header("location:../index/circulo.php");
    }
?>