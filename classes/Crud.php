<?php
require_once'DB.php';

abstract class Crud implements ICrud {
    
    protected $tabela = 'usuarios';
    protected $tbl_cursos = 'cursos';

        public function find() {
        $sql = "SELECT Nome, idCurso FROM  $this->tbl_cursos";
        $stm = DB::prepare($sql);
        $stm->execute();
        return $stm->fetchAll();
    }
    
    public function findUnit($id) {
        $sql = "SELECT * FROM $this->tabela WHERE id = :id";
        $stm = DB::prepare($sql);
        $stm->bindParam(':id', $id, PDO::PARAM_INT);
        $stm->execute();
        return $stm->fetch();
    }
    
    public function findAll() {
        $sql = "SELECT $this->tabela.id, $this->tabela.nome, $this->tabela.email, $this->tbl_cursos.Nome FROM $this->tabela JOIN $this->tbl_cursos ON $this->tbl_cursos.IdCurso = $this->tabela.idCurso";
        $stm = DB::prepare($sql);
        $stm->execute();
        return $stm->fetchAll();
    }
    
    
    
    public function insert() {
        $sql = "INSERT INTO $this->tabela (nome, email, idCurso) VALUES (:nome, :email, :idCurso)";
        $stm = DB::prepare($sql);
        $stm->bindParam(':nome', $this->nome);
        $stm->bindParam(':email', $this->email);
        $stm->bindParam(':idCurso', $this->idCurso->idCurso);
        return $stm->execute();

    }
    
    
    public function update($id) {
        $sql = "UPDATE $this->tabela SET nome = :nome, email = :email, idCurso = :idCurso WHERE id = :id";
        $stm = DB::prepare($sql);
        $stm->bindParam(':id', $id, PDO::PARAM_INT);
        $stm->bindParam(':nome', $this->nome);
        $stm->bindParam(':email', $this->email);
        $stm->bindParam(':idCurso', $this->idCurso->idCurso);
        return $stm->execute();
    }
    
    public function delete($id) {
        $sql = "DELETE FROM $this->tabela WHERE id = :id";
        $stm = DB::prepare($sql);
        $stm->bindParam(':id', $id, PDO::PARAM_INT);
        return $stm->execute();
    }
    
}
