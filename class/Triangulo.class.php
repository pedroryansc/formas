<?php
    require_once("../autoload.php");

    class Triangulo extends Forma{
        private $ladoA;
        private $ladoB;
        private $ladoC;
        public function __construct($id, $ladoA, $ladoB, $ladoC, $cor, $tabuleiro){
            parent::__construct($id, $cor, $tabuleiro);
            $this->setLadoA($ladoA);
            $this->setLadoB($ladoB);
            $this->setLadoC($ladoC);
        }

        public function setLadoA($ladoA){
            if($ladoA > 0)
                $this->ladoA = $ladoA;
            else
                throw new Exception("Valor do lado A inválido: $ladoA");
        }
        public function setLadoB($ladoB){
            if($ladoB > 0)
                $this->ladoB = $ladoB;
            else
                throw new Exception("Valor do lado B inválido: $ladoB");
        }
        public function setLadoC($ladoC){
            if($ladoC > 0)
                $this->ladoC = $ladoC;
            else
                throw new Exception("Valor do lado 2 inválido: $ladoC");
        }

        public function getLadoA(){ return $this->ladoA; }
        public function getLadoB(){ return $this->ladoB; }
        public function getLadoC(){ return $this->ladoC; }

        public function insere(){
            $sql = "INSERT INTO triangulo (ladoA, ladoB, ladoC, cor, tabuleiro_idtabuleiro) VALUES(:ladoA, :ladoB, :ladoC, :cor, :tabuleiro)";
            $par = array(":ladoA"=>$this->getLadoA(),
                        ":ladoB"=>$this->getLadoB(),
                        ":ladoC"=>$this->getLadoC(),
                        ":cor"=>$this->getCor(),
                        ":tabuleiro"=>$this->getIdTabuleiro());
            return parent::executaComando($sql, $par);
        }

        public static function listar($tipo = 0, $info = ""){
            $sql = "SELECT * FROM triangulo";
            if($tipo > 0 && $info <> ""){
                switch($tipo){
                    case(1): $sql .= " WHERE idtriangulo = :info"; break;
                    case(2): $sql .= " WHERE ladoA LIKE :info"; $info .= "%"; break;
                    case(3): $sql .= " WHERE ladoB LIKE :info"; $info .= "%"; break;
                    case(4): $sql .= " WHERE ladoC LIKE :info"; $info .= "%"; break;
                    case(5): $sql .= " WHERE cor LIKE :info"; $info = "%".$info."%"; break;
                    case(6): $sql .= " WHERE tabuleiro_idtabuleiro = :info"; break;
                }
                $par = array(":info"=>$info);
            } else
                $par = array();
            return parent::buscar($sql, $par);
        }

        public function editar(){
            $sql = "UPDATE triangulo
                    SET ladoA = :ladoA, ladoB = :ladoB, ladoC = :ladoC, cor = :cor, tabuleiro_idtabuleiro = :tabuleiro
                    WHERE idtriangulo = :id";
            $par = array(":ladoA"=>$this->getLadoA(),
                        ":ladoB"=>$this->getLadoB(),
                        ":ladoC"=>$this->getLadoC(),
                        ":cor"=>$this->getCor(),
                        ":tabuleiro"=>$this->getIdTabuleiro(),
                        ":id"=>$this->getId());
            return parent::executaComando($sql, $par);
        }

        public function excluir(){
            $sql = "DELETE FROM triangulo WHERE idtriangulo = :id";
            $par = array(":id"=>$this->getId());
            return parent::executaComando($sql, $par);
        }

        public function verificaTipo(){
            if($this->getLadoA() == $this->getLadoB() && $this->getLadoA() == $this->getLadoC())
                return "Equilátero";
            else if($this->getLadoA() == $this->getLadoB() || $this->getLadoA() == $this->getLadoC() || $this->getLadoB() == $this->getLadoC())
                return "Isósceles";
            else
                return "Escaleno";
        }

        public function calculaPerimetro(){
            return $this->getLadoA() + $this->getLadoB() + $this->getLadoC();
        }
        public function calculaArea(){
            $semiP = $this->calculaPerimetro() / 2;
            return sqrt(abs($semiP * ($semiP - $this->getLadoA()) * ($semiP - $this->getLadoB()) * ($semiP - $this->getLadoC())));
        }

        public function __toString(){
            return "<a href='triangulo.php'>Voltar à página de triângulos</a> <br>".
                    "<br>".
                    "<header>".
                        "<h2>Triângulo ".$this->getId()." (".$this->verificaTipo().")</h2>".
                    "</header>".
                    "<br>".
                    "Lado A: ".number_format($this->getLadoA(), 2, ",", ".")." <br>".
                    "Lado B: ".number_format($this->getLadoB(), 2, ",", ".")." <br>".
                    "Lado C: ".number_format($this->getLadoC(), 2, ",", ".")." <br>".
                    "Perímetro: ".number_format($this->calculaPerimetro(), 2, ",", ".")." <br>".
                    "Área: ".number_format($this->calculaArea(), 2, ",", ".")." <br>".
                    "<br>";
        }
        public function desenha(){
            return $this->__toString().
                    "<div style='
                        width: 0em;
                        height: 0em;
                        border-left: ".$this->getLadoA()."em solid transparent;
                        border-right: ".$this->getLadoC()."em solid transparent;
                        border-bottom: ".$this->getLadoB()."em solid ".$this->getCor().";
                    '></div>";
        }
    }
?>