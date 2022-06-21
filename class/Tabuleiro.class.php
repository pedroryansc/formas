<?php
    require_once("../conf/Conexao.php");

    class Tabuleiro{
        private $idTabuleiro;
        private $lado;
        public function __construct($id, $lado){
            $this->setIdTabuleiro($id);
            $this->setLado($lado);
        }

        public function setIdTabuleiro($id){
            $this->idTabuleiro = $id;
        }
        public function setLado($lado){
            if($lado > 0)
                $this->lado = $lado;
            else
                throw new Exception("Valor do lado inválido: $lado");
        }

        public function getIdTabuleiro(){ return $this->idTabuleiro; }
        public function getLado(){ return $this->lado; }

        public function insere(){
            $conexao = Conexao::getInstance();
            $sql = "INSERT INTO tabuleiro (lado) VALUES(:lado)";
            $comando = $conexao->prepare($sql);
            $comando->bindParam(":lado", $this->getLado());
            if($comando->execute())
                return $conexao->lastInsertId();
            else{
                return 0;
                $comando->debugDumpParams();
            }
        }
        public function listar($tipo, $info){
            $conexao = Conexao::getInstance();
            $sql = "SELECT * FROM tabuleiro";
            if($tipo > 0 && $info <> ""){
                switch($tipo){
                    case(1): $sql .= " WHERE idtabuleiro = :info"; break;
                    case(2): $sql .= " WHERE lado LIKE :info"; $info .= "%"; break;
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
            $sql = "UPDATE tabuleiro
                    SET lado = :lado
                    WHERE idtabuleiro = :id";
            $comando = $conexao->prepare($sql);
            $comando->bindParam(":lado", $this->getLado());
            $comando->bindParam(":id", $this->getIdTabuleiro());
            if($comando->execute())
                return $conexao->lastInsertId();
            else{
                return 0;
                $comando->debugDumpParams();
            }
        }
        public function excluir(){
            $conexao = Conexao::getInstance();
            $sql = "DELETE FROM tabuleiro WHERE idtabuleiro = :id";
            $comando = $conexao->prepare($sql);
            $comando->bindParam(":id", $this->getIdTabuleiro());
            if($comando->execute())
                return $conexao->lastInsertId();
            else{
                return 0;
                $comando->debugDumpParams();
            }
        }

        public function area(){
            return pow($this->getLado(), 2);
        }
        public function perimetro(){
            return $this->getLado() * 4;
        }

        public function __toString(){
            return "<a class='btn btn-success' href='tabuleiro.php'>Voltar à página de tabuleiros</a> <br>".
                    "<br>".
                    "<header>".
                        "<h2>Tabuleiro ".$this->getIdTabuleiro()."</h2>".
                    "</header>".
                    "<br>".
                    "Lado: ".$this->getLado()." <br>".
                    "Área: ".$this->area()." <br>".
                    "Perímetro: ".$this->perimetro()." <br>".
                    "<br>";
        }
        public function desenha(){
            return $this->__toString().
                    "<div style='
                        width: ".$this->getLado()."em;
                        height: ".$this->getLado()."em;
                        background: #000000;
                    '></div>";
        }
    }
?>