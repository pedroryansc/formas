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
        private $id;
        private $cor;
        private $idTabuleiro;
        private static $contador = 0;
        public function __construct($id, $cor, $tabuleiro){
            $this->setId($id);
            $this->setCor($cor);
            $this->setIdTabuleiro($tabuleiro);
            self::$contador = self::$contador + 1;
            // Ou self::$contador += 1;
        }

        public function setId($id){
            $this->id = $id;
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
    
        public function getId(){ return $this->id; }
        public function getCor(){ return $this->cor; }
        public function getIdTabuleiro(){ return $this->idTabuleiro; }

        // Métodos abstratos que devem implementados nas classes filhas

        public abstract function desenha();
        public abstract function calculaArea();
        
        public abstract function insere();
        public abstract static function listar($tipo = 0, $info = "");
        public abstract function editar();
        public abstract function excluir();
    }
?>