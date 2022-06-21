<?php
    require_once "Database.class.php";

    class Forma extends Database{
        private $idQuadrado;
        private $cor;
        private $idTabuleiro;
        
        public static $contador = 0;

        public function __construct($id, $cor, $tabuleiro){
            $this->setIdQuadrado($id);
            $this->setCor($cor);
            $this->setIdTabuleiro($tabuleiro);

            self::$contador = self::$contador + 1;
            
            // Ao invés de "=", pode ser "+="
        }

        public function setIdQuadrado($id){
            $this->idQuadrado = $id;
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
    }
?>