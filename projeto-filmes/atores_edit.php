<?php

if($_SERVER['REQUEST_METHOD']=="GET"){
	if(isset($_GET['ator'])&& is_numeric($_GET['ator'])){
		$idAtor=$_GET['ator'];
		$con = new mysqli ("localhost","root","","ator");

		if($con->connect_errno!=0){
			echo "<h1>Ocorreu um erro no acesso à base de dados. <br>".$con->connect_error."</h1>";
			exit();
		}
		$sql="Select * from atores where id_ator=?";
		$stm=$con->prepare($sql);
		if($stm!=false){
		$stm->bind_param("i",$idAtor);
		$stm-> execute();

		$res=$stm->get_result();
		$livro=$res->fetch_assoc();
		$stm->close();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="ISO_8859-1">
	<title>Editar Ator</title>
</head>
<body>
<h1>Editar Ator</h1>
<form action="atores_update.php"method="post">
<label>nome</label><input type="text" name="nome" required value="<?php echo $livro['nome'];?>"><br>
<label>nacionalidade</label><input type="text" name="nacionalidade" required value="<?php echo $livro['nacionalidade'];?>"><br>
<label>data</label><input type="date" name="data" required value="<?php echo $livro['data'];?>"><br>

<input type="hidden" name="id_ator" required value="<?php echo $livro['id_ator'];?>">
<input type="submit" name="enviar"><br>
</form>
</body>
<?php
}
else{
	echo ('<h1>Houve um erro ao processar o seu pedido.<br>Dentro de segundos será reencaminhado!</h1>');
	header("refresh:5,url=index_atores.php");
}
}
