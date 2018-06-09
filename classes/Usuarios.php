<?php


 class Usuarios extends Crud {
    
    public $nome;
    public $email;
    public $idCurso;
    
    public function setNome($nome) {
        $this->nome = $nome;
    }
    public function getNome() {
        return $this->nome;
    }
    
    
    public function setEmail($email) {
        $this->email = $email;
    }
    public function getEmail() {
        return $this->email;
    }

    public function setIdCurso($idCurso){
        $this->idCurso = $idCurso;
    }

    public function getIdCurso(){
        return $this->idCurso;
    }

    
    
}
