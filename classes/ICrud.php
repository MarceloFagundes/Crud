<?php 

interface ICrud{

	public function find();
    
    public  function findUnit($id);
    
    public  function findAll();

    public  function insert(); 

    public  function update($id); 
    
    public  function delete($id);
    
}

?>
