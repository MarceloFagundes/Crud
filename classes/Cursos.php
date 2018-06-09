<?php

 Class Cursos extends Crud{

	public $cursos;
	public $idCurso;

	public function setCursos($cursos){
        $this->cursos = $cursos;
	}

	public function getCursos(){
		return $this->cursos;
	}

	public function setIdCurso($idCurso){
        $this->idCurso = $idCurso;
	}

	public function getIdCurso(){
		return $this->idCurso;
	}

	    public function find() {
        $sql = "SELECT Nome, idCurso FROM  $this->tbl_cursos";
        $stm = DB::prepare($sql);
        $stm->execute();
        return $stm->fetchAll();
    }

	
} 

 ?>