function maiuscula(lstr){
	var str=lstr.value; //obtem o valor
	lstr.value=str.toUpperCase(); //converte as strings e retorna ao campo
}
function minuscula(lstr){
	var str=lstr.value; //obtem o valor
	lstr.value=str.toLowerCase(); //converte as strings e retorna ao campo
}

//**************************************************************************

function mostrarQual(){

	if (document.getElementById('cargo_clube').value == "OUTRO"){
		document.getElementById('qual_clube').style.display = 'table-row';
	}
	else{
		document.getElementById('qual_clube').style.display = 'none';
	}

	if (document.getElementById('cargo_distrito').value == "OUTRO"){
		document.getElementById('qual_distrito').style.display = 'table-row';
	}
	else{
		document.getElementById('qual_distrito').style.display = 'none';
	}

}

//**************************************************************************

function Delegado(){
	
	if (document.getElementById('delegado').value == "SIM"){
		document.getElementById('span_delegado').style.display = 'table-cell';
	}
	else{
		document.getElementById('span_delegado').style.display = 'none';
	}
}

//*************** Exibe Mensagem de Atualização da Inscrição ******************
 function testeMatCpf(){
	if (matTeste == true && cpfTeste == true){
		document.getElementById('cadastrado').style.display = 'table-row';
	}
	else{
		document.getElementById('cadastrado').style.display = 'none';
	}
}

//**************************************************************************

function validaForm(){
	//Valida CPF
	if(!validaCPF()){
		document.getElementById('cpf').focus();
		document.getElementById('cpf').style.boxShadow = "0.1px 0.1px 3px red";
		alert("Favor fornecer um CPF válido.");
		return false;	
	}
        else
	if(cpfTeste == true){
		document.getElementById('cpf').focus();
		document.getElementById('cpf').style.boxShadow = "0.1px 0.1px 3px red";
		alert("CPF Já está Cadastrado.");
		return false;	
	}
        else
	if(matTeste == true){
		document.getElementById('matricula').focus();
		document.getElementById('matricula').style.boxShadow = "0.1px 0.1px 3px red";
		alert("Matricula Já está Cadastrada.");
		return false;		
	}
	else
	if(emailTeste == true){
		document.getElementById('email').focus();
		document.getElementById('email').style.boxShadow = "0.1px 0.1px 3px red";
		alert("Email Já está Cadastrado.");
		return false;	
	}
        else
	if(senhaTeste == true){
		document.getElementById('senha1').focus();
		document.getElementById('senha1').style.boxShadow = "0.1px 0.1px 3px red";
                document.getElementById('senha2').style.boxShadow = "0.1px 0.1px 3px red";
		alert("As Senhas não coincidem.");
		return false;	
	}
        //Valida Data
	else
	if(!validaData()){
		alert("Favor preencher a Data de Nasciemento Corretamente.");
		return false;
	}
	if(document.getElementById('botao').value == "Atualizar"){
		certeza = confirm('Tem Certeza que deseja modifiar seus dados?');
		if (certeza == false){
			return false;
		}
		document.getElementById('cpf').disabled = false;
	}
	
	return true;
}

//*****************************

function validaCPF(){
	cpf1 = document.getElementById('cpf').value;
	cpf = cpf1.replace(/[^\d]+/g,'');
	if (cpf1.length < 14) 
 		return  false;
	
	else if (cpf == '00000000000' || cpf == '11111111111' || cpf == '22222222222' || cpf == '33333333333' || cpf == '44444444444' || cpf == '55555555555' || cpf == '66666666666' || cpf == '77777777777' || cpf == '88888888888' || cpf == '99999999999'){
		return false;
	}
	
	else{ //um validador que achei na internet
		cpf = cpf.replace(/[^\d]+/g,'');
		for (var t = 9; t < 11; t++) {
			for (var d = 0, c = 0; c < t; c++) {
				d += cpf[c] * ((t + 1) - c);
			}
		
			d = ((10 * d) % 11) % 10;
		
			if (cpf[c] != d) {
				return false;
			}
		}
	}
	//OUTRO VALIDADOR QUE ACHEI NA INTERNET
	add = 0;	
	for (i=0; i < 9; i ++)		
		add += parseInt(cpf.charAt(i)) * (10 - i);	
	rev = 11 - (add % 11);	
	if (rev == 10 || rev == 11)		
		rev = 0;	
	if (rev != parseInt(cpf.charAt(9)))		
		return false;		
	// Valida 2o digito	
	add = 0;	
	for (i = 0; i < 10; i ++)		
		add += parseInt(cpf.charAt(i)) * (11 - i);	
	rev = 11 - (add % 11);	
	if (rev == 10 || rev == 11)		
		rev = 0;	
	if (rev != parseInt(cpf.charAt(10)))		
		return false;
	
	return true;
}

function validaData(){
	var dia = document.getElementById('dia').value;
	var mes = document.getElementById('mes').value;
	var ano = document.getElementById('ano').value;

	if((dia=="" && mes!="") || (dia=="" && ano!="") || (mes=="" && dia!="") || (mes=="" && ano!="") || (ano=="" && dia!="") || (ano=="" && mes!="") ){

		document.getElementById('dia').focus();
		document.getElementById('dia').style.boxShadow = "0.1px 0.1px 3px red";
		document.getElementById('mes').style.boxShadow = "0.1px 0.1px 3px red";
		document.getElementById('ano').style.boxShadow = "0.1px 0.1px 3px red";

		return false;
	}
	else{
		return true;	
	}
	
}

//**************************************************************************

function tirarShadow(id){
	document.getElementById(id).style.boxShadow = "none";
}

//**************************************************************************

function Selecionar(selecionar , Option){
	var Select = document.getElementById(selecionar); 
	for ( i =0; i < Select.length; i++){
		if (Select[i].value == Option){
			Select[i].selected = true;
		}
	} 
}





