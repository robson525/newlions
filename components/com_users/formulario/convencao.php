<?php require_once("php7_mysql_shim.php");
    $ouro = isset($_POST['ouro']) ? (int) $_POST['ouro'] : false;
    $inscricao_n = isset($_GET['inscricao']) ? (int) $_GET['inscricao'] : false;
    $convencao_id = (int) $_GET['convencao'];
    $convencao = Convencao::getById($convencao_id, $db);
    if(!$convencao || !$convencao->getAberta()):
        $erro = true;
        $msg = "Você não tem permissão para acessar esta área.";
        
    else:
       
        $inscricoes = InscricaoConvencao::getByUsuario($usuario->getId(), $db);
        
        $inscricao = false;
        $Ninscricoes = 0;
        $pago = false;
        foreach ($inscricoes as $inscri){
            if($inscri->getConvencao_id() == $convencao_id){
                $Ninscricoes++;
                if($inscri->getId() == $inscricao_n){
                    $inscricao = $inscri;
                    $ouro = $Ninscricoes - 1;
                    $inscricao->setConnection($db);
                    if($inscri->getPago()){
                        $pago = true;
                        $comprovante = Comprovante::getById($inscricao->getComprovante(), $db);
                    }
                }
            }
        }
        
    endif;
    
    if(isset($_POST['inscrever']) && isset($_POST['convencao'])):
        $inscricao = new InscricaoConvencao($db);
        $inscricao->setUsuario_id($usuario->getId());
        $inscricao->setConvencao_id($_POST['convencao']);
        $erro = !$inscricao->save();
        if($erro){
            $msg = "Falha ao cadastrar.";
        }else{
            $msg = "Cadastro realizado com sucesso.";
            $email = new Email();
            $email->setDestinatario($user->email, $user->name);
            $email->inscricaoConvencao($convencao->getTitulo());
            $email->enviar();
        }
    endif;
    
    if(isset($_FILES['comprovante'])): 
        $pastaAnexo = "formulario/conprovante/convencao-20/";
        $extPermitidas = array("pdf", "jpg", "png", "jpeg");
        $tamanhoMax = 4194304; //4M
        $extensao = strtolower(end(explode('.', $_FILES['comprovante']['name'])));
       
        if(in_array($extensao, $extPermitidas)){
            if($_FILES['comprovante']['size'] <= $tamanhoMax){
                $comprovante = new Comprovante($db);
                $comprovante->setNome($_FILES['comprovante']['name']);
                $comprovante->setTipo(".".$extensao);
                $comprovante->setMd5(md5($_FILES['comprovante']['name'] . date("Y-m-d H-i-s")));
                $comprovante->setLocal($pastaAnexo);
                $comprovante->setTempName($_FILES['comprovante']['tmp_name']);
                $pago = $inscricao->InsereComprovante($comprovante);
                if($pago){
                    $erro = false;
                    $msg = "Comprovante de pagamento anexado com sucesso.";
                }else{
                    $erro = true;
                    $msg = "Houve um erro ao anexar seu comprovante. Tente novamente." . mysql_error();
                }
            }else{
                $erro = true;
                $msg = "Tamanho do arquivo é superior ao permitido.";
            }
        }else{
            $erro = true;
            $msg = "Extensão do arquivo não é permitida.";
        }
    endif;
    
?>
<script type="text/javascript">
    var extPermitidas = ["pdf", "jpg", "png", "jpeg"];
    var tamanhoMax = 4194304;
    function validaArquivo(){
        var doc = document.getElementById('comprovante');
        var extensao = doc.value.split('.');
        extensao = extensao[extensao.length - 1].toLowerCase() ;
        if(extPermitidas.indexOf(extensao.toLowerCase()) < 0){
            alert("Extensão do arquivo não é permitida.");
            return false;
        }else if(doc.files[0].size > tamanhoMax){
            alert("Tamanho do arquivo é superior ao permitido.");
            return false;
        }else{
            
            return true;
        }
    }

    function confirmar(){
        console.log("AAA");
        var btn = document.getElementById("btnConfirmar");
        if(btn){
            btn.setAttribute("disabled", "disabled");
        }
        var form = document.getElementById("formConfirmar");
        if(form){
            form.submit();
        }
        return true;
    }
</script>

<?php if(isset($msg)): ?>
    <div id="system-message" style="text-align: center;">
        <dd class="<?php echo $erro ? 'error' : '' ?>">
            <ul>
                <li>
                    <?php echo $msg ?>
                </li>
            </ul>
        </dd>
    </div>
<?php endif; ?>
<br>
<?php
if($convencao && $convencao->getAberta()):  
?>
    
    <?php if($inscricao): ?>

        <div style=" margin-top: 20px;">
            <center><h2><?php echo $convencao->getTitulo(); ?></h2></center>            
            <center><h4>28 a 30 de abril de 2019</h4></center>						
			<center><h4>Luiz Correa - Parnaiba - PI</h4></center>
			<center><h5>SESC PRAIA</h5></center>
            
            <table class="category" style="width:80%; margin:auto; margin-top: 50px;">
                <caption style="display:none;"><h4>Conta para Depósito:</h4></caption>
                <tr>
                    <td style="text-align: center; max-width: 100%;">
						<div style="">
							<p style="font-weight: bold;">Banco do Brasil</p>												
							<p style="">
								Agência: 3506-8 <br>
								Conta Corrente: 42056-5                 
							</p>
							<p style="font-weight: bold;">
								Titular: Assoc. Int. de Lions - XXª Convenção
							</p>
						</div>
						<table style="margin: auto;">
							<caption><h5>Valores das Incrições</h5></caption>
							<tr>
								<td>Até dia 31/01/2019</td>
								<td>Convencional R$ 270,00</td>
								<td>LEO R$ 120,00</td>
							</tr>
							<tr>
								<td>Até dia 06/04/2019</td>
								<td>Convencional R$ 300,00</td>
								<td>LEO R$ 150,00</td>
							</tr>
						</table>
                        <br/>
                    </td>
                    
                </tr>
            </table>
            
            <table class="category" style="width:50%; margin:auto; margin-top: 50px;">
                <tr>
                    <td style="text-align: center; max-width: 100%; padding-top: 20px;">
                        <h2>Inscrição <?php echo $ouro ? ("Ouro " .  $ouro) : "Principal" ?></h2>
                        <h4>Número de Inscrição : <?php echo $inscricao->getNinscricao(); ?></h4>
                    </td>
                </tr>
            </table>
          
            
            <table class="category" style="width:60%; margin:auto; margin-top: 50px;">
                <caption><h4>Situação</h4></caption>
                <tr>
                    <td style="text-align: center; max-width: 100%">
                        <?php echo  $pago ? "Comprovante de Pagamento Anexado" : "Pendente do Comprovante Pagamento"?>
                    </td>
                </tr>
                <?php if($pago): ?>
                <tr>
                    <td style="text-align: center;"> <?php echo $comprovante->getNome(); ?></td>
                </tr>
                <?php endif;?>
            </table>
            
            
            <form method="POST" action="cadastro.html?convencao=<?php echo $convencao->getId() ?>&inscricao=<?php echo $inscricao->getId(); ?>" enctype="multipart/form-data" onsubmit="return validaArquivo()">
                <table class="category" style="width: 80%; margin:auto; margin-top: 50px;">
                    <caption><h4>Comprovante de Pagamento</h4></caption>
                    <tr>
                        <td style="text-align:right;"><?php echo $pago ? "Alterar" : "Anexar"; ?> comprovante:</td>
                        <td style="max-width: 100%"><input type="file" name="comprovante" id="comprovante" accept="image/jpg,image/jpeg,image/png,application/pdf" required style="max-width:100%"/></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:center;">Extensões permitidas: .pdf , .jpg , .png , .jpeg </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:center;">Tamanho máximo do arquivo: 4M </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:center;"> <button class="button" type="submit">Enviar</button> </td>
                    </tr>
                </table>    
            </form>
          
        </div>

    <?php else: ?>

        <div style="text-align: center;  margin-top: 50px;">
            <h2>Confirmar <?php echo $Ninscricoes ? $Ninscricoes.'&ordf; Inscrição Ouro' : 'Inscrição' ?> na <?php echo $convencao->getTitulo() ?> :</h2>
            <form method="POST" action="" id="formConfirmar">
                <input type="hidden" name="convencao" value="<?php echo $convencao->getId() ?>" />
                <input type="hidden" name="inscrever" value="1" />
                <input type="hidden" name="ouro" value="<?php echo $Ninscricoes ?>" />
                <button id="btnConfirmar" class="button" type="submit" onclick="confirmar();">Confirmar</button>
            </form>
        </div>  
    <?php endif; ?>   
    
<?php endif; ?>    

<br/><br/>
<div style="text-align: right;">
    <button class="button" onclick="window.location='cadastro.html'">Voltar</button>
</div>