<?php 
extract ($_POST);

if($estado == "PARÁ"){
$resposta = "
	<option class='para' value='' ></option>
	<option class='para' value='ABAETETUBA'>ABAETETUBA</option>
	<option class='para' value='ALTAMIRA'>ALTAMIRA</option>
	<option class='para' value='BELÉM'>BELÉM</option>
	<option class='para' value='BENEVIDES'>BENEVIDES</option>
	<option class='para' value='BRAGANÇA'>BRAGANÇA</option>
	<option class='para' value='BREU BRANCO'>BREU BRANCO</option>
	<option class='para' value='CANAÃ DOS CARAJÁS'>CANAÃ DOS CARAJÁS</option>
	<option class='para' value='CASTANHAL'>CASTANHAL</option>
	<option class='para' value='CAPITÃO POÇO'>CAPITÃO POÇO</option>
	<option class='para' value='DOM ELISEU'>DOM ELISEU</option>
	<option class='para' value='ELDORADO DO CARAJÁS'>ELDORADO DO CARAJÁS</option>
	<option class='para' value='ICOARACI'>ICOARACI</option>
	<option class='para' value='ITAITUBA'>ITAITUBA</option>
	<option class='para' value='IPIXUNA DO PARÁ'>IPIXUNA DO PARÁ</option>
	<option class='para' value='ITUPIRANGA'>ITUPIRANGA</option>
	<option class='para' value='JACUNDÁ'>JACUNDÁ</option>
	<option class='para' value='MARABÁ'>MARABÁ</option>
	<option class='para' value='MOJU'>MOJU</option>
	<option class='para' value='NOVO PROGRESSO'>NOVO PROGRESSO</option>
	<option class='para' value='PARAGOMINAS'>PARAGOMINAS</option>
	<option class='para' value='PARAUAPEBAS'>PARAUAPEBAS</option>
	<option class='para' value='RONDON DO PARÁ'>RONDON DO PARÁ</option>
	<option class='para' value='TAILÂNDIA'>TAILÂNDIA</option>
	<option class='para' value='TUCURUÍ'>TUCURUÍ</option> ";
}

elseif($estado == "MARANHÃO"){
$resposta = "
	<option class='maranhao' value='' ></option>
	<option class='maranhao' value='CAXIAS'>CAXIAS</option>
	<option class='maranhao' value='CODÓ'>CODÓ</option>
	<option class='maranhao' value='SANTA INÊS'>SANTA INÊS</option>
	<option class='maranhao' value='SANTA LUZIA'>SANTA LUZIA</option>
	<option class='maranhao' value='SÃO LUIZ'>SÃO LUIZ</option>
	<option class='maranhao' value='TIMON'>TIMON</option>
	<option class='maranhao' value='ZÉ DOCA'>ZÉ DOCA</option> ";
}

elseif($estado == "PIAUÍ"){
$resposta = "	
	<option class='piaui' value='' ></option>
	<option class='piaui' value='CAMPO MAIOR'>CAMPO MAIOR</option>
	<option class='piaui' value='FLORIANO'>FLORIANO</option>
	<option class='piaui' value='LUÍS CORREIA'>LUÍS CORREIA</option>
	<option class='piaui' value='PARNAIBA'>PARNAIBA</option>
	<option class='piaui' value='PICOS'>PICOS</option>
	<option class='piaui' value='TERESINA'>TERESINA</option> ";
}

elseif($estado == "AMAPÁ"){
$resposta = "	
	<option class='amapa' value='' ></option>
	<option class='amapa' value='MACAPÁ'>MACAPÁ</option> ";
}

else{
	$resposta = "<option value='' >Selecione um estado</option>";
}

echo $resposta;

?>
