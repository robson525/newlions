<?php require_once("php7_mysql_shim.php"); 

$user = new JUser();
$user->name = "teste2";
$user->username = "teste2";
$user->password = "teste2";
$user->email = "teste2@teste2.com.br";
$user->password = md5("teste2");
$user->block = '0';
$user->sendEmail = '0';
$user->groups = array('2'=>'2');

var_dump($user);

//$user->save();
var_dump($user);

?>

<?php 
die();
?>

<?php 
	if(!$_POST){
		echo "Acesso Negado";
		exit();
	}
	include "conn.php";
	$conecta = new Conecta();
		
	extract ($_POST);
	
	$nascimento = "{$ano}-{$mes}-{$dia}";
	
	if($dia==NULL && $mes==NULL && $ano==NULL){ $nascimento = '';} 
	if($endereco == NULL){ $endereco = ''; }
	if($complemento == NULL){ $complemento = ''; }	
	if($cargo_clube == NULL){ $cargo_clube = ''; }
	if($outro_cargo_clube == NULL){ $outro_cargo_clube = ''; }
	if($cargo_distrito == NULL){ $cargo_distrito = ''; }
	if($outro_cargo_distrtito == NULL){ $outro_cargo_distrtito = ''; }
	
	if($botao == "Enviar"){
		$sql = "INSERT INTO xv_convencao (nome, matricula, cpf, email, nascimento, endereco, complemento, estado, cidade, clube, delegado, cargo_clube, qual_cc, cargo_distrito, qual_cd, cl_mj, prefixo, camisa , data) 
				VALUES ('$nome', '$matricula', '$cpf', '$email', '$nascimento', '$endereco', '$complemento', '$estado', '$cidade', '$clube', '$delegado', '$cargo_clube', '$outro_cargo_clube', '$cargo_distrito', '$outro_cargo_distrtito', '$cl_mj', '$prefixo', '$camisa' '".date('y-m-d H:m:s')."' );";
	}
	elseif($botao == "Atualizar"){
		$sql = "UPDATE xv_convencao SET nome='$nome', matricula='$matricula', email='$email', nascimento='$nascimento', endereco='$endereco', complemento='$complemento', estado='$estado', cidade='$cidade', clube='$clube', delegado='$delegado', cargo_clube='$cargo_clube', qual_cc= '$outro_cargo_clube', cargo_distrito='$cargo_distrito', qual_cd='$outro_cargo_distrtito', cl_mj='$cl_mj', prefixo='$prefixo', camisa='$camisa'
				WHERE cpf = '$cpf';";
	}
	else {
		echo "Acesso Negadooo";
		exit();
	}
	
	$query = mysql_query($sql);
	
	if(mysql_error($conecta->conn)){
		echo "Ocorreu um Erro ao realizar Cadastro.<br>Por Favor, tente Novamente.";//mysql_error($conecta->conn)."<br>SQL = ".$sql;
	}
	else{
		include "email.php";
	}
	$conecta->desconecta();
	
?>
