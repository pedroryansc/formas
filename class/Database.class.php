<?php
    class Database{
        public static function iniciaConexao(){
            //Adicionar arquivo de conexão
            require_once("Conexao.class.php");
            //Abrir conexão com o banco
            return Conexao::getInstance();
        }

        public static function vinculaParametros($comando, $parametros = array()){
            //Vincular os parâmetros
            //[':lado'=>20]
            foreach($parametros as $chave=>$valor){
                $comando->bindValue($chave, $valor);
            }
            return $comando;
        }

        //Insere, editar e excluir em uma única função:

        public static function executaComando($sql, $parametros = array()){
            $conexao = self::iniciaConexao();
            $comando = $conexao->prepare($sql);
            $comando = self::vinculaParametros($comando, $parametros);
            try{
                return $comando->execute();
            } catch(PDOException $e){
                // PDOException = PDO = MySQL
                throw new Exception("Erro na execução do comando: ".$e->getMessage());
            }
        }

        public static function buscar($sql, $parametros = array()){
            $conexao = self::iniciaConexao();
            $comando = $conexao->prepare($sql);
            $comando = self::vinculaParametros($comando, $parametros);
            $comando->execute();
            return $comando->fetchAll();
        }
    }
?>