<?php
    class Database{
        
        /**
         * 1. Adicionar arquivo de conexão
         * 2. Abrir conexão com o banco
         * @access public
         * @return String
         */
        
        public static function iniciaConexao(){
            require_once("../conf/Conexao.php");
            return Conexao::getInstance();
        }

        /**
         * Vincular os parâmetros (Ex: [":lado"=>20])
         * @access public
         * @return String
         */
        
        public static function vinculaParametros($comando, $parametros = array()){
            foreach($parametros as $chave=>$valor){
                $comando->bindValue($chave, $valor);
            }
            return $comando;
        }

        /**
         * Insere, editar e excluir em uma única função
         * 
         * (PDOException = PDO = MySQL)
         * @access public
         * @return String
         */

        public static function executaComando($sql, $parametros = array()){
            $conexao = self::iniciaConexao();
            $comando = $conexao->prepare($sql);
            $comando = self::vinculaParametros($comando, $parametros);
            try{
                return $comando->execute();
            } catch(PDOException $e){
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