<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Tela de Login</title>
<style type="text/css">
body{
	font-family: Times, serif;
	text-shadow:1px 1px 5px #666;
}
input{
	font-family: Times, serif;
	height: 20px;
	font-weight:bold;	
}
#submit{
	height:25px;
}
select {
	font-family: Times, serif;
	padding: 3px;
	font-weight:bold;	
}
#div_erro {
	position:relative;
	margin:auto;
	text-align:center;
	width: 300px;
	height: 20px;
	margin-top: 130px;
	color: red;
	font-weight:bold;
	text-shadow:0 3px 0 rgba(0, 0, 0, .3);
}
#div_login {
	position:relative;
	margin:auto;
	text-align:center;
	width: 300px;
	height: 180px;
	background-image:  url(../img/login.png);
	background-repeat: no-repeat;
	background-size: 300px 180px;	
	border:solid 1px #006;
	border-radius: 3px;
	box-shadow: 0 3px 0 rgba(0, 0, 0, .3), 0 2px 7px #000033;
}
#tab_login{
	font-weight:bold;
	position:relative;
	margin-left: 70px;
	margin-top: 50px;
}
</style>

<script src="../js/jquery.js" type="text/javascript"></script>
<script src="../js/jquery.form.js" type="text/javascript"></script>
<script type="text/javascript">

// Quando carregado a página
$(function($) {
	
	// Tratamento de Login de Usuario
	$('#form_login').submit(function() {

		// Limpando mensagem de erro
		$('#div_erro').html('');

		// Enviando informações do formulário via AJAX
		$(this).ajaxSubmit(function(resposta) {
			// Se não retornado nenhum erro
			if (resposta.length <= 1){
				// Redirecionando
				window.location = 'admin.php';				
			}else{
				// Exibimos a mensagem de erro
				$('#div_erro').html(resposta);
			}
		});
		// Retornando false para que o formulário não envie as informações da forma convencional
		return false;
	}); // Final Tratamento do Formulario
	
	
});
</script>

</head>


<body>

<div id="div_erro"> </div>
<div id="div_login">

	<form id="form_login" name="form_login" action="validaLogin.php" method="post">
    	<table id="tab_login" border="0">
        	<tr>
            	<td>Login: </td> 
                <td><input id="login" name="login" type="text" /></td>
            </tr>
            <tr>
            	<td>Senha: </td>
                <td><input id="senha" name="senha" type="password" /> </td>
            </tr>
            <tr>
            	<td></td>
                <td><input id="submit" name="submit" type="submit" value="Logar" style="cursor:pointer; "/> </td>
            </tr>
        </table>
    </form>
</div>

</body>
</html>