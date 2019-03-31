<?php require_once("php7_mysql_shim.php"); @session_start();
if(!isset($_POST['ordem']) && !isset($_GET['padrao'])){
	echo "<meta http-equiv='refresh' content='0; url=admin.php'>";	
	exit();
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<?php 

$tabela = "

<table id='tab_lista'  border='1'>
  <thead>
  <tr>
  	<th scope='col'style='padding:5px;'>&nbsp;</th>
    <th scope='col'style='width:300px;'>Nome</th>
	<th scope='col'style='width:150px;'>RG/CPF</th>
    <th scope='col'style='width:100px;'>Nascimento</th>
    <th scope='col'style='width:300px;'>Endereço</th>
	<th scope='col'style='width:200px;'>Email</th>
	<th scope='col'style='width:100px;'>Telefone</th>
	<th scope='col'style='width:150px;'>Atividade de Extensão da UFPA</th>
	<th scope='col'style='width:100px;'>INEP</th>
	<th scope='col'style='width:300px;'>Secretária da Escola</th>
	<th scope='col'style='width:300px;'>Função</th>
	<th scope='col'style='width:300px;'>Programas</th>
  </tr>
  </thead>
  <tbody>
" ;
  

include_once('../class/conecta.php');
$conex = new Conecta();
$ordem = "";
$filtro = "";

// Ordenação
if (!empty($_POST["ordem"])){
	$ordem = $_POST["ordem"].", ";
	
}

if (!empty($_POST["secretaria"]) && !empty($_POST["inep"])){
	$secretaria = $_POST["secretaria"];
	$inep = $_POST["inep"];
	$filtro = "WHERE secretaria = '$secretaria' AND inep = '$inep'";
}
else {
	//Filtrar Orgão
	if (!empty($_POST["secretaria"])){
		$secretaria = $_POST["secretaria"];
		$filtro = "WHERE secretaria = '$secretaria'";
	}
	
	//Filtrar Profissão
	else if (!empty($_POST["inep"])){
		$inep = $_POST["inep"];
		$filtro = "WHERE inep = '$inep'";
	}
}
	
	$sql = "SELECT * FROM 1_formulario $filtro ORDER BY $ordem nome";

	$query = mysql_query($sql);
	$cont = 1;
	
	$result = "";
	
	while($l = mysql_fetch_array($query)) {
		$nome 		= $l["nome"];
		$rg			= $l["rg"];
		$orgao		= $l["orgao"];
		$cpf		= $l["cpf"];
		$sexo		= $l["sexo"];
		$nascimento	= implode("/", array_reverse(explode("-", $l["nascimento"])));
		$pai		= $l["pai"];
		$mae		= $l["mae"];
		$endereco	= $l["endereco"];
		$complemento= $l["complemento"];
		$cep		= $l["cep"];
		$cidade		= $l["cidade"];
		$email		= $l["email"];
		$telefone1	= $l["telefone1"];
		$telefone2	= $l["telefone2"];
		$escolaridade= $l["escolaridade"];
		$extensao	= $l["extensao"];
		$inep		= $l["inep"];
		$secretaria	= $l["secretaria"];
		$reserva	= $l["reserva"];
		$nivel_ensino	= $l["nivel_ensino"];
		$funcao		= $l["funcao"];   
		$outra_funcao	= $l["outra_funcao"];
		$programa	= $l["programa"];
		
		$result .= "
		<tr>
			<td>$cont</td>
			<td>$nome</td>
			<td>$rg - $orgao <br>$cpf</td>
			<td>$nascimento</td>
			<td>$endereco<br>$complemento<br>$cidade - $cep</td>
			<td>$email</td>
			<td>$telefone1 <br>$telefone2</td>
			<td>$extensao</td>
			<td>$inep</td>
			<td>$secretaria";
			if($secretaria == "RESERVA SOCIAL") $result .= "<br>ÁREA: $reserva";
		$result .= "</td>
			<td>$funcao <br> $outra_funcao </td>
			<td>$programa</td>
		</tr>\n";
		
		$cont++;
	}
	
	$conex->desconecta();
	
	echo $tabela . $result;
	
?>
</tbody>
</table>



</body>
</html>
