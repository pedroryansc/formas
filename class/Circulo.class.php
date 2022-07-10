<?php
    require_once("../autoload.php");

    class Circulo extends Forma{
        private $raio;
        public function __construct($id, $raio, $cor, $tabuleiro){
            parent::__construct($id, $cor, $tabuleiro);
            $this->setRaio($raio);
        }

        public function setRaio($raio){
            if($raio > 0)
                $this->raio = $raio;
            else
                throw new Exception("Valor do raio inválido: $raio");
        }

        public function getRaio(){ return $this->raio; }

        public function insere(){
            $sql = "INSERT INTO circulo (raio, cor, tabuleiro_idtabuleiro) VALUES(:raio, :cor, :tabuleiro)";
            $par = array(":raio"=>$this->getRaio(), ":cor"=>$this->getCor(), ":tabuleiro"=>$this->getIdTabuleiro());
            return parent::executaComando($sql, $par);
        }

        public static function listar($tipo = 0, $info = ""){
            $sql = "SELECT * FROM circulo";
            if($tipo > 0 && $info <> ""){
                switch($tipo){
                    case(1): $sql .= " WHERE idcirculo = :info"; break;
                    case(2): $sql .= " WHERE raio LIKE :info"; $info .= "%"; break;
                    case(3): $sql .= " WHERE cor LIKE :info"; $info = "%".$info."%"; break;
                    case(4): $sql .= " WHERE tabuleiro_idtabuleiro = :info"; break;
                }
                $par = array(":info"=>$info);
            } else
                $par = array();
            return parent::buscar($sql, $par);
        }

        /**
         * 1. Montar SQL - Comando para inserir os dados
         * 2. "Vincular" os parâmetros
         * 3. Executar e retornar o resultado
         * @access public
         * @return String
         */

        public function editar(){
            $sql = "UPDATE circulo
                    SET raio = :raio, cor = :cor, tabuleiro_idtabuleiro = :tabuleiro
                    WHERE idcirculo = :id";
            $par = array(":raio"=>$this->getRaio(),
                        ":cor"=>$this->getCor(),
                        ":tabuleiro"=>$this->getIdTabuleiro(),
                        ":id"=>$this->getId());
            return parent::executaComando($sql, $par);
        }
        
        public function excluir(){
            $sql = "DELETE FROM circulo WHERE idcirculo = :id";
            $par = array(":id"=>$this->getId());
            return parent::executaComando($sql, $par);
        }

        public function calculaDiametro(){
            return $this->getRaio() * 2;
        }
        public function calculaArea(){
            return M_PI * pow($this->getRaio(), 2);
        }
        public function calculaCircunferencia(){
            return 2 * M_PI * $this->getRaio();
        }

        public function __toString(){
            return "<a href='circulo.php'>Voltar à página de círculos</a> <br>".
                    "<br>".
                    "<header>".
                        "<h2>Círculo ".$this->getId()."</h2>".
                    "</header>".
                    "<br>".
                    "Raio: ".number_format($this->getRaio(), 2, ",", ".")." <br>".
                    "Diâmetro: ".number_format($this->calculaDiametro(), 2, ",", ".")." <br>".
                    "Área: ".number_format($this->calculaArea(), 2, ",", ".")." <br>".
                    "Circunferência: ".number_format($this->calculaCircunferencia(), 2, ",", ".")." <br>".
                    "<br>";
        }
        public function desenha(){
            return $this->__toString().
                    "<svg width='1910' height='735'>
                        <circle cx=".(20 + $this->getRaio())." cy=".(10 + $this->getRaio())." r=".$this->getRaio()." fill=".$this->getCor().">
                    </svg>";
        }
    }
?>