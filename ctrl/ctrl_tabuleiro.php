<?php
    require_once("../class/Tabuleiro.class.php");

    $acao = isset($_GET["acao"]) ? $_GET["acao"] : "";
    $id = isset($_GET["id"]) ? $_GET["id"] : 0;

    if($acao == "excluir"){
        try{
            $tab = new Tabuleiro($id, 1);
            $tab->excluir();
        } catch(Exception $e){
            echo "Erro ao excluir tabuleiro <br>".
                "<br>".
                $e->getMessage();
        }
        header("location:../index/tabuleiro.php");
    }

    $acao = isset($_POST["acao"]) ? $_POST["acao"] : "";

    if($acao == "salvar"){
        $lado = isset($_POST["lado"]) ? $_POST["lado"] : 0;
        $tab = new Tabuleiro($id, $lado);
        if($id == 0){
            try{
                $tab->insere();
            } catch(Exception $e){
                echo "Erro ao criar tabuleiro <br>".
                    "<br>".
                    $e->getMessage();
            }
        } else{
            try{
                $tab->editar();
            } catch(Exception $e){
                echo "Erro ao editar os dados do tabuleiro <br>".
                    "<br>".
                    $e->getMessage();
            }
        }
        header("location:../index/tabuleiro.php");
    }
?>