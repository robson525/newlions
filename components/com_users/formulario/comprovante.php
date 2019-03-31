<?php 
define('_JEXEC', 1);
define('DS', DIRECTORY_SEPARATOR);

if (file_exists(dirname(__FILE__) . '/../defines.php')) {
	include_once dirname(__FILE__) . '/../defines.php';
}

if (!defined('_JDEFINES')) {
	define('JPATH_BASE', dirname(__FILE__) . "/..");
	require_once JPATH_BASE.'/includes/defines.php';
}

require_once JPATH_BASE.'/includes/framework.php';
require_once dirname(__FILE__) . '/classe/Persistencia.php';
require_once dirname(__FILE__) . '/classe/Comprovante.php';
require_once dirname(__FILE__) . '/classe/Usuario.php';
require_once dirname(__FILE__) . '/classe/InscricaoConvencao.php';

$app = JFactory::getApplication('site');

$user = isset($_SESSION["__default"]['user']) ? $_SESSION["__default"]['user'] : null;

$validUser = false;
if(isset($_GET['U']) && $_GET['U']){
	if($user->id == $_GET['U']){
		$validUser = true;
	}
}


$inscricao = new InscricaoConvencao();
if($validUser && isset($_GET['I']) && $_GET['I']){
	$inscricao = InscricaoConvencao::getById($_GET['I'], JFactory::getDbo());
}

$usuario = new Usuario();
if($validUser && isset($_GET['I']) && $_GET['I']){
	$usuario = Usuario::getById($inscricao->getUsuario_id());
	$usuario = JFactory::getUser($usuario->getUser_id());
}

$comprovante = new Comprovante();
if($validUser && $inscricao){
	$comprovante = Comprovante::getById($inscricao->getComprovante(), JFactory::getDbo());
}

//var_dump($inscricao);
//var_dump($usuario);

?>

<html>
<head>
	<title>Comprovante</title>
	<style type="text/css">
		*{
			font-family: 'Ubuntu', 'Helvetica', arial, serif;
		}
		h1{
			color: #174e9c;
			margin-top: 50px;
		}
		body{
			text-align: center;;
		}
		table{
			margin: 50px auto;
			font-size: 18px;
		}
	</style>
</head>
<body>

	<?php if ($validUser): ?>

		<h1>Informações</h1>
		<table>
			<tr>
				<td>Nome:</td><td><?php echo $usuario->name; ?></td>
			</tr>
			<tr>
				<td>Email:</td><td><?php echo $usuario->email; ?></td>
			</tr>
				<td>Pago:</td><td><?php echo ($inscricao->getPago() ? "Sim" : "Não"); ?></td>
			</tr>
		</table>

		<?php $title = "title='" . $comprovante->getNome() . "'" ?>
		<?php $src = "src='../" . $comprovante->getLocal()  . $comprovante->getMd5() . $comprovante->getTipo() . "'"  ?>
		
		<?php if($comprovante->getTipo() == ".pdf"): ?>

			<iframe type="divxapplication/pdf" style="border: 2px solid #132d54; display: block; margin-left: auto; margin-right: auto;" <?php echo $title ?> <?php echo $src  ?> frameborder="1" scrolling="auto" height="600" width="850"></iframe>
		
		<?php else: ?>

			<img <?php echo $title ?> <?php echo $src  ?> alt="Imagem Não Encontrada" style="width: 600;" />

		<?php endif; ?>
	<?php else: ?>

		<h1>Acesso Inválido</h1>

	<?php endif; ?>
</body>
</html>