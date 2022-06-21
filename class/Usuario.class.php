<?php
    require_once("../conf/Conexao.php");

    class Usuario{
        private $idUsuario;
        private $nome;
        private $login;
        private $senha;
        public function __construct($id, $nome, $login, $senha){
            $this->setIdUsuario($id);
            $this->setNome($nome);
            $this->setLogin($login);
            $this->setSenha($senha);
        }

        public function setIdUsuario($id){
            $this->idUsuario = $id;
        }
        public function setNome($nome){
            if($nome <> "")
                $this->nome = $nome;
            else
                throw new Exception("Nome inválido: $nome");
        }
        public function setLogin($login){
            if($login <> "")
                $this->login = $login;
            else
                throw new Exception("Login inválido: $login");
        }
        public function setSenha($senha){
            if($senha <> "")
                $this->senha = $senha;
            else
                throw new Exception("Senha inválida: $senha");
        }

        public function getIdUsuario(){ return $this->idUsuario; }
        public function getNome(){ return $this->nome; }
        public function getLogin(){ return $this->login; }
        public function getSenha(){ return $this->senha; }

        public function insere(){
            $conexao = Conexao::getInstance();
            $sql = "INSERT INTO usuario (nome, login, senha) VALUES(:nome, :login, :senha)";
            $comando = $conexao->prepare($sql);
            $comando->bindValue(":nome", $this->getNome());
            $comando->bindValue(":login", $this->getLogin());
            $comando->bindValue(":senha", $this->getSenha());
            if($comando->execute())
                return $conexao->lastInsertId();
            else{
                return 0;
                $comando->debugDumpParams();
            }
        }
        public function listar($tipo, $info){
            $conexao = Conexao::getInstance();
            $sql = "SELECT * FROM usuario";
            if($tipo > 0 && $info <> ""){
                switch($tipo){
                    case(1): $sql .= " WHERE idusuario = :info"; break;
                    case(2): $sql .= " WHERE nome LIKE :info"; $info = "%".$info."%"; break;
                    case(3): $sql .= " WHERE login LIKE :info"; $info = "%".$info."%"; break;
                    case(4): $sql .= " WHERE senha LIKE :info"; $info = "%".$info."%"; break;
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
            $sql = "UPDATE usuario
                    SET nome = :nome, login = :login, senha = :senha
                    WHERE idusuario = :id";
            $comando = $conexao->prepare($sql);
            $comando->bindValue(":nome", $this->getNome());
            $comando->bindValue(":login", $this->getLogin());
            $comando->bindValue(":senha", $this->getSenha());
            $comando->bindValue(":id", $this->getIdUsuario());
            if($comando->execute())
                return $conexao->lastInsertId();
            else{
                return 0;
                $comando->debugDumpParams();
            }
        }
        public function excluir(){
            $conexao = Conexao::getInstance();
            $sql = "DELETE FROM usuario WHERE idusuario = :id";
            $comando = $conexao->prepare($sql);
            $comando->bindParam(":id", $this->getIdUsuario());
            if($comando->execute())
                return $conexao->lastInsertId();
            else{
                return 0;
                $comando->debugDumpParams();
            }
        }

        public function efetuaLogin($lg, $sn){
            require_once("../utils.php");
            $lista = listaUsuario(0, 0);
            foreach($lista as $linha){
                if($lg == $linha["login"] && $sn == $linha["senha"])
                    return true;
            }
            return false;
        }
    }
?>