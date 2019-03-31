<?php @session_start();
if(isset($_GET['sair']) && $_GET['sair']){
	session_unset();
	session_destroy();
}

if(!isset($_SESSION['id_admin'])){
	echo "<meta http-equiv='refresh' content='0; url=index.php'>";	
	exit();
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Administração</title>
<?php include "../class/conecta.php";?>
<link type="text/css" href="../css/admin.css" rel="stylesheet" />
<script type='text/javascript' src='../js/jquery.js'></script>
<script type="text/javascript">

// Quando carregado a página
$(function($) {

$('#div_resultado').load('listar.php?padrao=1');

$('#bot_filtro').click(function(evt){
	var ordem = document.getElementById('filtro_ordem').value;
	var secretaria = document.getElementById('filtro_secretaria').value;
	var inep = document.getElementById('filtro_inep').value;

	$.ajax({
		
		type:"POST",
		url: "listar.php",
		data:"ordem="+ordem+"&secretaria="+secretaria+"&inep="+inep,
		
		success:function(data){
			$("#div_resultado").html(data);
		}
		
	});
	
});
	
});
</script>
</head>
<body>
<header>
<div id="div_sair"> <a href="?sair=1">Sair</a> </div>
  <h1>Resultado das Inscrições</h1>
</header>

<div id="div_botao">
  <table class="tb_filtro" border="0" align="center" cellspacing="10">
    <tr>
      <td align="center">Ordenar por: </td>
      <td><select id="filtro_ordem" name="filtro_ordem">
          <option value='' selected></option>
          <option value='nome'>NOME</option>
          <option value='inep'>CODIGO INEP</option>
          <option value='secretaria'>SECRETARIA DA ESCOLA</option>
          <option value='funcao'>FUNÇÃO</option>
        </select></td>
    </tr>
    <tr>
      <td>Fitrar Secretária</td>
      <td><select id="filtro_secretaria" name="filtro_secretaria">
          <option value='' selected></option>
          <option value='SECRETARIA DE EDUCAÇÃO - SEDUC'>SECRETARIA DE EDUCAÇÃO - SEDUC</option>
          <option value='SECRETARIA MUNICIPAL DE EDUCAÇÃO - SEMEC'>SECRETARIA MUNICIPAL DE EDUCAÇÃO - SEMEC</option>
          <option value='SECRETARIA DE EDUCAÇÃO DE ANANINDEUA - SEMED'>SECRETARIA DE EDUCAÇÃO DE ANANINDEUA - SEMED</option>
          <option value='RESERVA SOCIAL'>RESERVA SOCIAL</option>
        </select></td>
    </tr>
    <tr>
      <td> Filtrar Código INEP</td>
      <td><input id="filtro_inep" name="filtro_inep" maxlength="8" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input id="bot_filtro" type="button" value="Filtrar" /></td>
    </tr>
  </table>
</div>

<!--Tabela com Resultados -->


<!--Tabela com Resultados -->
<div id="div_resultado"> 

</div>

</body>
</html>
<?php
$html = ob_get_contents();
?>