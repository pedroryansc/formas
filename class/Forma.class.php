<?php
    require_once("../autoload.php");

    /**
     * Superclasse/Classe pai, a qual contém e define o que é comum para todas as subclasses.
     * 
     * abstract = "Incompleta". Utilizada em classes que servem para padronizar o código (template).
     * @access public
     * @return String
     */

    abstract class Forma extends Database{
        private $idQuadrado;
        private $cor;
        private $idTabuleiro;
        private static $contador = 0;
        public function __construct($id, $cor, $tabuleiro){
            $this->setIdQuadrado($id);
            $this->setCor($cor);
            $this->setIdTabuleiro($tabuleiro);
            self::$contador = self::$contador + 1;
            // Ou self::$contador += 1;
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
        public function getCor(){ return $this->cor; }
        public function getIdTabuleiro(){ return $this->idTabuleiro; }

        // Métodos abstratos que devem implementados nas classes filhas

        public abstract function desenha();
        public abstract function area();
        
        public abstract function insere();
        public abstract static function listar($tipo = 0, $info = "");
        public abstract function editar();
        public abstract function excluir();
    }
?>