<?php
    class Quadrado{
        private $idQuadrado;
        private $lado;
        private $cor;
        private $idTabuleiro;
        public function __construct($id, $lado, $cor, $tabuleiro){
            $this->setIdQuadrado($id);
            $this->setLado($lado);
            $this->setCor($cor);
            $this->setIdTabuleiro($tabuleiro);
        }

        public function setIdQuadrado($id){
            $this->idQuadrado = $id;
        }
        public function setLado($lado){
            if($lado > 0)
                $this->lado = $lado;
            else
                throw new Exception("Valor do lado inválido: $lado");
        }
        public function setCor($cor){
            if($cor <> "")
                $this->cor = $cor;
            else
                throw new Exception("Cor inválida: $cor");
        }
        public function setIdTabuleiro($tabuleiro){
            if($tabuleiro <> 0)
                $this->idTabuleiro = $tabuleiro;
            else
                throw new Exception("Tabuleiro inválido: $tabuleiro");
        }

        public function getIdQuadrado(){ return $this->idQuadrado; }
        public function getLado(){ return $this->lado; }
        public function getCor(){ return $this->cor; }
        public function getIdTabuleiro(){ return $this->idTabuleiro; }

        public static function iniciaConexao(){
            //Adicionar arquivo de conexão
            require_once("Conexao.classs.php");
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

        /**
        * Insere um quadrado no banco de dados
        * @access public
        * @return String
        * */

        public static function insere($sql, $parametros = array()){
            $conexao = self::iniciaConexao();
            $comando = $conexao->prepare($sql);
            $comando = self::vinculaParametros($comando, $parametros);
            if($comando->execute())
                return $conexao->lastInsertId();
            else{
                throw new Exception($comando->debugDumpParams());
            }
        }
        public static function listar($tipo, $info){
            $conexao = Conexao::getInstance();
            $sql = "SELECT * FROM quadrado";
            if($tipo > 0 && $info <> ""){
                switch($tipo){
                    case(1): $sql .= " WHERE idquadrado = :info"; break;
                    case(2): $sql .= " WHERE lado LIKE :info"; $info .= "%"; break;
                    case(3): $sql .= " WHERE cor LIKE :info"; $info = "%".$info."%"; break;
                    case(4): $sql .= " WHERE tabuleiro_idtabuleiro = :info"; break;
                }
            }
            $comando = $conexao->prepare($sql);
            if($tipo > 0 && $info <> "")
                $comando->bindValue(":info", $info);
            $comando->execute();
            return $comando->fetchAll();
        }
        public function editar(){
            $conexao = Conexao::getInstance();
            $sql = "UPDATE quadrado
                    SET lado = :lado, cor = :cor, tabuleiro_idtabuleiro = :tabuleiro
                    WHERE idquadrado = :id";
            $comando = $conexao->prepare($sql);
            $comando->bindValue(":lado", $this->getLado());
            $comando->bindValue(":cor", $this->getCor());
            $comando->bindValue(":tabuleiro", $this->getIdTabuleiro());
            $comando->bindValue(":id", $this->getIdQuadrado());
            if($comando->execute())
                return $conexao->lastInsertId();
            else{
                return 0;
                $comando->debugDumpParams();
            }
        }
        public static function excluir(){
            $conexao = self::iniciaConexao();
            $comando = $conexao->prepare($sql);
            $comando = self::vinculaParametros($comando, $parametros);
            return $comando->execute();
        }
    }
?>