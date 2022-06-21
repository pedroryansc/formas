<?php
    require_once("class/Tabuleiro.class.php");
    require_once("class/Quadrado.class.php");
    require_once("class/Usuario.class.php");

    function listaTabuleiro($tipo, $info){
        $tab = new Tabuleiro(1, 1);
        $lista = $tab->listar($tipo, $info);
        return $lista;
    }

    function listaQuadrado($tipo, $info){
        $quad = new Quadrado(1, 1, 1, 1);
        $lista = $quad->listar($tipo, $info);
        return $lista;
    }

    function listaUsuario($tipo, $info){
        $user = new Usuario(1, 1, 1, 1);
        $lista = $user->listar($tipo, $info);
        return $lista;
    }
?>