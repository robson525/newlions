<?php 
    require_once 'formulario/classe/Persistencia.php';
    require_once 'formulario/classe/ResetSenha.php';
    require_once 'formulario/classe/Email.php';
    
    if(isset($_POST['recuperar_cpf']) && $_POST['recuperar_cpf']){
        $recupera = ResetSenha::verificaCPF($_POST['recuperar_cpf']);
        if($recupera){
            $erro = false;
            $msg = "Um email foi enviado para ". $recupera . " com as informações para recuperação da senha.<br>Caso esteja com dificuldade entre em contado pelo Fale Conosco.";
        }else{
            $erro = true;
            $msg = "O CPF fornecido não está cadastrado na nossa base de dados.";
        }   
    }  
    
    if(isset($_POST['redefinir']) && $_POST['redefinir']){
        $reset = ResetSenha::getByPk($_POST['redefinir']);
        if($reset->alteraSenha($_POST['senha1'])){
            $erro = false;
            $msg = "Senha Alterada Com Sucesso";
        }else{
            $erro = true;
            $msg = "Ocorreu um erro na sua Solicitação.";
        }
    }
?>

<script type="text/javascript">
    function verificaSenhas(){
        var senha1 = document.getElementById("senha1").value;
        var senha2 = document.getElementById("senha2").value;
        if(senha1 === senha2){
            return true;
        }else{
            document.getElementById("msgerro").style.display = 'inline';
            document.getElementById("msgerro").focus();
            return false;
        }
    }
</script>

<center>
<h3>Redefinir Senha</h3>
</center>
<?php if(isset($msg)):?>
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

<?php if(is_numeric($_GET['redefinirsenha'])): ?>
<br>
<form action="" method="POST">
    <table style="width: 50%; margin: auto;">
        <tr>
            <td style="width:50%; font-weight:bold; text-align:center;">Digite seu CPF:</td>
            <td style="width:50%; text-align: left;"><input name="recuperar_cpf" value="" style="width: 100%;" title="Apenas Numeros" maxlength="11" required="true" placeholder="Apenas Numeros"/> </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align:center;"><br><button class="button" type="submit">Enviar</button></td>
        </tr>
    </table>
</form>

<?php elseif(strlen($_GET['redefinirsenha']) == 32): ?>

    <?php if($reset = ResetSenha::verificaCode($_GET['redefinirsenha'])): ?>
        <form action="cadastro.html?redefinirsenha=1" method="POST" onsubmit="return verificaSenhas();">
            <table style="width: 50%; margin: auto;">
                <tr>
                    <td></td>
                    <td style="color:red; font-weight:bold; text-align:center; display:none;" id="msgerro">As senhas não coincidem</td>
                </tr>
                <tr>
                    <td style="width:50%; font-weight:bold; text-align:center;">Nova Senha:</td>
                    <td style="width:50%; text-align: left;"><input type="password" name="senha1" id="senha1" value="" style="width: 100%;" title="Máximo 20 Caracteres" maxlength="20" required="true" placeholder="Máximo 20 Caracteres"/> </td>
                </tr>
                <tr>
                    <td style="width:50%; font-weight:bold; text-align:center;">Repetir Senha:</td>
                    <td style="width:50%; text-align: left;"><input type="password" name="senha2" id="senha2" value="" style="width: 100%;" maxlength="20" required="true"/> </td>
                </tr>
                <tr>
                    <input type="hidden" name="redefinir" value="<?php echo $reset->getId() ?>" />
                    <td colspan="2" style="text-align:center;"><br><button class="button" type="submit">Alterar</button></td>
                </tr>
            </table>
        </form>
            
    <?php 
    else:
        $msg2 = "Código Invalido";
    endif; 
    ?>

<?php 
else:
    $msg2 = "Ação Inválida";
endif; 
?>


<?php if(isset($msg2)): ?>
    <div id="system-message" style="text-align: center;">
        <dd class="error">
            <ul>
                <li>
                    <?php echo $msg2; ?>
                </li>
            </ul>
        </dd>
    </div>
<?php endif; ?>


  

