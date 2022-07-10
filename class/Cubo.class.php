<?php
    require_once("../autoload.php");

    class Cubo extends Quadrado{
        private $idQuadrado;
        public function __construct($id, $idQuadrado, $lado, $cor, $tabuleiro){
            parent::__construct($id, $lado, $cor, $tabuleiro);
            $this->setIdQuadrado($idQuadrado);
        }

        public function setIdQuadrado($idQuadrado){
            $this->idQuadrado = $idQuadrado;
        }

        public function getIdQuadrado(){ return $this->idQuadrado; }

        public function insere(){
            $sql = "INSERT INTO cubo (quadrado_idquadrado) VALUES(:quadrado)";
            $par = array(":quadrado"=>$this->getIdQuadrado());
            return parent::executaComando($sql, $par);
        }

        public static function listar($tipo = 0, $info = ""){
            $sql = "SELECT * FROM cubo";
            if($tipo > 0 && $info <> ""){
                switch($tipo){
                    case(1): $sql .= " WHERE idcubo = :info"; break;
                    case(2): $sql .= " WHERE quadrado_idquadrado LIKE :info"; break;
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
            $sql = "UPDATE cubo
                    SET quadrado_idquadrado = :quadrado
                    WHERE idcubo = :id";
            $par = array(":quadrado"=>$this->getIdQuadrado(),
                        ":id"=>$this->getId());
            return parent::executaComando($sql, $par);
        }
        
        public function excluir(){
            $sql = "DELETE FROM cubo WHERE idcubo = :id";
            $par = array(":id"=>$this->getId());
            return parent::executaComando($sql, $par);
        }

        public function calculaArea(){
            return 6 * pow($this->getLado(), 2);
        }
        public function calculaVolume(){
            return pow($this->getLado(), 3);
        }
        public function calculaDiagonal(){
            return number_format($this->getLado() * sqrt(3), 3, ",", ".");
        }

        public function __toString(){
            return "<a href='cubo.php'>Voltar à página de cubos</a> <br>".
                    "<br>".
                    "<header>".
                        "<h2>Cubo ".$this->getId()."</h2>".
                    "</header>".
                    "<br>".
                    "Lado: ".$this->getLado()." <br>".
                    "Área Total: ".$this->calculaArea()." <br>".
                    "Volume: ".$this->calculaVolume()." <br>".
                    "Diagonal: ".$this->calculaDiagonal()." <br>".
                    "<br>";
        }
        public function desenha(){
            return $this->__toString().
                    "<style>
                        .scene{
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            min-height: 50vh;
                            perspective: 500px;
                        }
                        .cube{
                            width: ".$this->getLado()."em;
                            height: ".$this->getLado()."em;
                            animation: rotate 20s infinite alternate;
                            transform-style: preserve-3d;
                        }
                        .face{
                            background: ".$this->getCor().";
                            border: 1px solid;
            
                            width: ".$this->getLado()."em;
                            height: ".$this->getLado()."em;
                            position: absolute;
                        }
            
                        .face--front{
                            transform: translateZ(".($this->getLado() / 2)."em);
                        }
                        .face--right{
                            transform: rotateY(90deg) translateZ(".($this->getLado() / 2)."em);
                        }
                        .face--back{
                            transform: rotateY(180deg) translateZ(".($this->getLado() / 2)."em);
                        }  
                        .face--left{
                            transform: rotateY(-90deg) translateZ(".($this->getLado() / 2)."em);
                        }
                        .face--top{
                            transform: rotateX(90deg) translateZ(".($this->getLado() / 2)."em);
                        } 
                        .face--bottom{
                            transform: rotateX(-90deg) translateZ(".($this->getLado() / 2)."em);
                        }
            
                        @keyframes rotate{
                            from{
                                transform: rotateX(-20deg) rotateY(-10deg);
                            }
                            50%{
                                transform: rotateX(20deg) rotateY(320deg);
                            }
                            to{
                                transform: rotateX(-20deg) rotateY(-20deg);
                            }
                        }
                    </style>
                    <div class='scene'>
                        <div class='cube'>
                            <div class='face face--front'></div>
                            <div class='face face--right'></div>
                            <div class='face face--back'></div>
                            <div class='face face--left'></div>
                            <div class='face face--top'></div>
                            <div class='face face--bottom'></div>
                        </div>
                    </div>";
        }
    }
?>