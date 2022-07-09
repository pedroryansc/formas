<?php
    require_once("../autoload.php");

    class Retangulo extends Forma{
        private $base;
        private $altura;
        public function __construct($id, $base, $altura, $cor, $tabuleiro){
            parent::__construct($id, $cor, $tabuleiro);
            $this->setBase($base);
            $this->setAltura($altura);
        }

        public function setBase($base){
            if($base > 0)
                $this->base = $base;
            else
                throw new Exception("Valor da base inválido: $base");
        }
        public function setAltura($altura){
            if($altura > 0)
                $this->altura = $altura;
            else
                throw new Exception("Valor da altura inválido: $altura");
        }

        public function getBase(){ return $this->base; }
        public function getAltura(){ return $this->altura; }

        public function insere(){
            $sql = "INSERT INTO retangulo (base, altura, cor, tabuleiro_idtabuleiro) VALUES(:base, :altura, :cor, :tabuleiro)";
            $par = array(":base"=>$this->getBase(), ":altura"=>$this->getAltura(), ":cor"=>$this->getCor(), ":tabuleiro"=>$this->getIdTabuleiro());
            return parent::executaComando($sql, $par);
        }

        public static function listar($tipo = 0, $info = ""){
            $sql = "SELECT * FROM retangulo";
            if($tipo > 0 && $info <> ""){
                switch($tipo){
                    case(1): $sql .= " WHERE idretangulo = :info"; break;
                    case(2): $sql .= " WHERE base LIKE :info"; $info .= "%"; break;
                    case(3): $sql .= " WHERE altura LIKE :info"; $info .= "%"; break;
                    case(4): $sql .= " WHERE cor LIKE :info"; $info = "%".$info."%"; break;
                    case(5): $sql .= " WHERE tabuleiro_idtabuleiro = :info"; break;
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
            $sql = "UPDATE retangulo
                    SET base = :base, altura = :altura, cor = :cor, tabuleiro_idtabuleiro = :tabuleiro
                    WHERE idretangulo = :id";
            $par = array(":base"=>$this->getBase(),
                        ":altura"=>$this->getAltura(),
                        ":cor"=>$this->getCor(),
                        ":tabuleiro"=>$this->getIdTabuleiro(),
                        ":id"=>$this->getId());
            return parent::executaComando($sql, $par);
        }
        
        public function excluir(){
            $sql = "DELETE FROM retangulo WHERE idretangulo = :id";
            $par = array(":id"=>$this->getId());
            return parent::executaComando($sql, $par);
        }

        public function calculaArea(){
            return $this->getBase() * $this->getAltura();
        }
        public function calculaPerimetro(){
            return ($this->getBase() * 2) + ($this->getAltura() * 2);
        }

        public function __toString(){
            return "<a href='retangulo.php'>Voltar à página de retângulos</a> <br>".
                    "<br>".
                    "<header>".
                        "<h2>Retângulo ".$this->getId()."</h2>".
                    "</header>".
                    "<br>".
                    "Base: ".number_format($this->getBase(), 2, ",", ".")." <br>".
                    "Altura: ".number_format($this->getAltura(), 2, ",", ".")." <br>".
                    "Área: ".number_format($this->calculaArea(), 2, ",", ".")." <br>".
                    "Perímetro: ".number_format($this->calculaPerimetro(), 2, ",", ".")." <br>".
                    "<br>";
        }
        public function desenha(){
            return $this->__toString().
                    "<div style='
                        width: ".$this->getBase()."em;
                        height: ".$this->getAltura()."em;
                        background: ".$this->getCor().";
                    '></div>";
        }
    }
?>