<?php
	function __autoload($class_name){
		require_once 'classes/' . $class_name . '.php';
	}
?>
<!DOCTYPE HTML>
<html land="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <title>Cadastro de Clientes</title>
 
</head>
<body>

<div class="container">
		<header class="jumbotron">
			<h1 class="display-4">Cadastro de Clientes</h1>
		</header>

                   <?php

                    $usuario = new Usuarios();
                    $curso  = new Cursos();
                
                    // Cadastro de Usuario
                    if ( isset($_POST['cadastrar']) ):
                        $nome  = $_POST['nome'];
                        $email = $_POST['email'];
                        $cursos = $_POST['cursos'];

                        $curso->setIdCurso($cursos);

                        $usuario->setNome($nome);
                        $usuario->setEmail($email);
                        $usuario->setIdCurso($curso);
                                               
                        if ($usuario->insert()) {
                        
                        echo '<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>OK!</strong> Incluido com sucesso!!! </div>';
                        
                    } else {
                        echo '<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>OK!</strong> Erro ao alterar!!! </div>';
                    }
                    endif;
                                       
                    //exclusao de Usuario
             
		if(isset($_GET['acao']) && $_GET['acao'] == 'deletar'):
			$id = (int)$_GET['id'];
			$usuario->delete($id);
				header('Location: http://localhost/Crud_POO/index.php');

		endif;


                    //edição de Usuário

		if(isset($_GET['acao']) && $_GET['acao'] == 'editar'){

			$id = (int)$_GET['id'];
			$resultado = $usuario->findUnit($id);

		    if(isset($_POST['atualizar'])):

			    $id = $_POST['id'];
			    
				$nome  = $_POST['nome'];
                $email = $_POST['email'];
                $cursos = $_POST['cursos'];

                $curso->setIdCurso($cursos);

                $usuario->setNome($nome);
                $usuario->setEmail($email);
                $usuario->setIdCurso($curso);
				

			if($usuario->update($id)){
				 echo '<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>OK!</strong> Alterado com sucesso!!! </div>';

  header('Location: http://localhost/Crud_POO/index.php');
                        
                    } else {
                        echo '<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>OK!</strong> Erro ao alterar!!! </div>';
                    }
                    endif;       
		?>


		<div class="row" style="padding: 20px;">
			<form class="form-inline" method="post" action="">
			 
			 <div class="col">
				<span class="add-on"><i class="icon-user"></i></span>
				<input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" required name="nome" value="<?php echo $resultado->nome ?>" placeholder="Nome:" />
			</div>
			  <div class="col">
				<span class="add-on"><i class="icon-envelope"></i></span>
				<input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" required name="email" value="<?php echo $resultado->email ?>" placeholder="E-mail:" />		
			</div>
			
			<input type="hidden" class="form-control mb-2 mr-sm-2 mb-sm-0" name="id" value="<?php echo $resultado->id ?>">

			<div class="col">
			  <select name='cursos' class="custom-select mb-2 mr-sm-2 mb-sm-0" id="inlineFormCustomSelect">
			    <option selected>Escolha os Cursos</option>
			    <?php foreach ($usuario->find() as $chave => $valor){
			     echo "<option value='".$valor->idCurso."'>".$valor->Nome."</option>";
                }
			    ?>
			  </select>
			  
			</div>		   
			
			 <div class="col">
			<input type="submit" name="atualizar" class="btn btn-primary" value="Atualizar dados">	
			</div>				
		</form>
     
        </div>
     <?php }else{ ?>
		
      <div class="row" style="padding: 20px;">
		<form class="form-inline" method="post" action="">
			<div class="col">
				<span class="add-on"><i class="icon-user"></i></span>
				<input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" required name="nome" placeholder="Nome:" />
			</div>
			<div class="col">
				<span class="add-on"><i class="icon-envelope"></i></span>
				<input type="text"  class="form-control mb-2 mr-sm-2 mb-sm-0" required name="email" placeholder="E-mail:" />
			</div>
            <div class="col">
			  <select name='cursos' class="custom-select mb-2 mr-sm-2 mb-sm-0"  id="inlineFormCustomSelect">
			    <option selected >Escolha o Cursos</option>
			    <?php foreach ($usuario->find() as $chave => $valor){
			     echo '<option value="'.$valor->idCurso.'">'.$valor->Nome.'</option>';
                }
			    ?>
			  </select>
			 
			</div>
			<div class="col">
			<input type="submit" name="cadastrar" class="btn btn-primary" value="Cadastrar dados">	
			</div>				
		</form>
      </div>

    <?php } ?>

		<table class="table table-striped">
			
			<thead>
				<tr>
					<th>#</th>
					<th>Nome:</th>
					<th>E-mail:</th>
					<th>Cursos:</th>
					<th>Ações:</th>
				</tr>
			</thead>
			
			<?php
 			foreach ($usuario->findAll() as $chave => $valor){
 			echo "<tbody>";
				echo "<tr scope='row'>";
					echo "<td>".$valor->id."</td>";
					echo "<td>".$valor->nome."</td>";
					echo "<td>".$valor->email."</td>";
					echo "<td>".$valor->Nome."</td>";
				    echo "<td>";
					echo "<a class='btn btn-primary' style='margin: 0 0 0 8px;' href='index.php?acao=editar&id=".$valor->id."'>Editar</a>";
					echo "<a class='btn btn-danger' style='margin: 0 0 0 8px;' href='index.php?acao=deletar&id=".$valor->id. "' onclick='return confirm(\"Deseja realmente deletar?\")'>Deletar</a>";
					echo "</td>";
				echo "</tr>";
			echo "</tbody>";

 			}
 		?>
		</table>
	</div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</body>
</html>