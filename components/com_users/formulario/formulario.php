<link href="formulario/css/formulario.css" rel="stylesheet" type="text/css"/>
<script src="formulario/js/formulario.js" type="text/javascript"></script>
<script src="formulario/js/jquery.js" type="text/javascript"></script>
<script src="formulario/js/jquery.mask.js" type="text/javascript"></script>
<script src="formulario/js/jquery.blockUI.js" type="text/javascript"></script>

<script type="text/javascript">
    jQuery.noConflict();
    jQuery(document).ready(function($) {
        $("#cpf").mask("000.000.000-00");
        $("#matricula").mask("0000000000");
    });
    
    function Estado(cidade, clube) {
        jQuery(document).ready(function($) {

            $.post('../../../formulario/auxi/cidades.php', {estado: $('#estado').val()},
            function(resposta) {
                $('#cidade').html(resposta);
                if (cidade) {
                    Selecionar('cidade', cidade);
                }
            });
            
            $.post('../../../formulario/auxi/clubes.php', {estado: $('#estado').val()},
            function(resposta) {
                $('#clube').html(resposta);
                if (clube) {
                    Selecionar('clube', clube);
                }
            });
        
        });

    }
    
    var matricula = "<?php echo isset($usuario) ? $usuario->getMatricula() : "-1" ?>"
    var email = "<?php echo isset($user) ? $user->email : "-1" ?>"
    var matTeste = false;
    var cpfTeste = false;
    var emailTeste = false;
    var senhaTeste = false;
    jQuery(document).ready(function($) {

        //********************** VERIFICA SE MATRICULA JÁ EXISTE ************************************
        $('#matricula').change(function() {
            
            if($(this).val() != matricula && $(this).val() != '0000000000'){
                $.post('../../../formulario/auxi/verificar.php', {matricula: $(this).val()},
                function(resposta) {
                    if (resposta != false ) {
                        matTeste = true;
                        $('#span_matricula').show();
                    }
                    else {
                        $('#span_matricula').hide();
                        matTeste = false;
                    }
                });
            }
            else{
                $('#span_matricula').hide();
                matTeste = false;
            }
        });

        //********************** VERIFICA SE CPF JÁ EXISTE ************************************
        $('#cpf').change(function() {
            //if(document.getElementById('matricula').value.length == 10){
            $.post('../../../formulario/auxi/verificar.php', {cpf: $(this).val()},
            function(resposta) {
                if (resposta != false) {
                    cpfTeste = true;
                    $('#span_cpf').show();
                }
                else {
                    $('#span_cpf').hide();
                    cpfTeste = false;
                }
            });
            //	}
        });
        
        //********************** VERIFICA SE EMAIl JÁ EXISTE ************************************
        /*
        $('#email').change(function() {
            if($(this).val() != email){
                $.post('../../../formulario/auxi/verificar.php', {email: $(this).val()},
                function(resposta) {
                    if (resposta != false) {
                        emailTeste = true;
                        $('#span_email').show();
                    }
                    else {
                        $('#span_email').hide();
                        emailTeste = false;
                    }
                });
            }
        });
        */
        //********************** VERIFICA SE SENHAS COINCIDEM ************************************
        $('#senha2').change(function() {
            if($(this).val() == $('#senha1').val()){
                senhaTeste = false;
                $('#span_senha').hide();
            }else{
                senhaTeste = true;
                $('#span_senha').show();
            }
        });

    });



</script>


<?php
if(!isset($usuario)){
    $usuario = false;
}
?>

<div id="div_formulario">
    <form id="formulario" name="formulario" action="cadastro.html" method="POST" onSubmit="return validaForm();">
        <table id="tabela" align="center" border="0" width="100%" >
            <tr>
                <td width="30%" class="col-1">Nome Completo <span class="span_obg">*</span></td>
                <td width="70%"><input id="nome" name="nome" type="text" maxlength="100" style="width:98%" onChange="maiuscula(this)" onKeyUp="maiuscula(this)" value="<?php if ($usuario) echo $user->name; ?>" required /></td>
            </tr>
            <tr>
                <td class="col-1">Número de Matricula <span class="span_obg">*</span></td>
                <td>
                    <input id="matricula" name="matricula" type="text" maxlength="10" style="width:25%" value="<?php if ($usuario) echo $usuario->getMatricula(); ?>"  required />
                    <span id="span_matricula" style="color:red; font-weight:bold; display:none;">&ensp;Numero de Matricula já está cadastrada.</span>
                    <br>
                    <span class="span_pequeno">
                        Vide: <a href="http://www.lionsdla6.com.br/index.php/distrito/lista-de-associados.html" target="_blank">Lista de Associados do Distrito</a>
                    </span><br/>
                    <span class="span_pequeno">Caso você seja uma Domadora e não tenha um numero de matricula ou um Convidado de um Clube LIONS coloque a seguinte matricula: 0000000000</span><br/>
                    <span class="span_pequeno" style="font-weight:bold;">OBS: Convidados não podem Votar ou ser Votados nas eleições.</span>
                </td>
            </tr>
            <tr>
                <td class="col-1">CPF <span class="span_obg">*</span></td>
                <td>
                    <input id="cpf" name="cpf" type="text" style="width:25%;" onKeyPress="tirarShadow('cpf')" value="<?php if ($usuario) echo $user->username; ?>" required <?php echo $usuario?'disabled="true"':'' ?>/>
                    <span id="span_cpf" style="color:red; font-weight:bold; display:none;">&ensp;CPF já está cadastrado.</span>
                </td>
            </tr>
            <tr>
                <td class="col-1">E-mail <span class="span_obg">*</span></td>
                <td>
                    <input id="email" name="email" type="email" maxlength="50" style="width:50%;" onKeyUp="minuscula(this)" value="<?php if ($usuario) echo $user->email; ?>" required/>
                    <span id="span_email" style="color:red; font-weight:bold; display:none;">&ensp;Email já está cadastrado.</span>
                </td>
            </tr>
            <?php if(!$usuario): ?>
            <tr>
                <td class="col-1">Senha <span class="span_obg">*</span></td>
                <td>
                    <input id="senha1" name="senha1" type="password" value="" maxlength="20" style="width:37%;" required placeholder="Máximo 20 Caracteres" title="Máximo 20 Caracteres" />
                    <span id="span_senha" style="color:red; font-weight:bold; display:none;">&ensp;As Senhas não Coincidem.</span>
                </td>
            </tr>
            <tr>
                <td class="col-1">Repita a Senha <span class="span_obg">*</span></td>
                <td><input id="senha2" name="senha2" type="password" value="" maxlength="20" style="width:37%;" required size="20" /></td>
            </tr>
            <?php endif; ?>
            <tr>
                <?php $data = $usuario ? explode("-", $usuario->getDataNascimento()) : null;?>
                <td class="col-1">Data de Nascimento &nbsp;</td>
                <?php $dia = $usuario && $data ? $data[0] : "";?>
                <td><select id="dia" name="dia" onChange="tirarShadow('dia');
                        tirarShadow('mes');
                        tirarShadow('ano');">
                            <?php echo monta_dia($dia); ?>
                    </select>
                <?php $mes = $usuario && $data ? $data[1] : "";?>
                    <select id="mes" name="mes" onChange="tirarShadow('dia');
                            tirarShadow('mes');
                            tirarShadow('ano');">
                                <?php echo monta_mes($mes); ?>
                    </select>
                <?php $ano = $usuario && $data ? $data[2] : "";?>
                    <select id="ano" name="ano" onChange="tirarShadow('dia');
                            tirarShadow('mes');
                            tirarShadow('ano');">
                                <?php echo monta_ano($ano); ?>
                    </select></td>
            </tr>
            <tr>
                <td class="col-1" id="end">Endereço &nbsp;</td>
                <td id="enderec"><input id="endereco" name="endereco" type="text" maxlength="100" onChange="maiuscula(this)" onKeyUp="maiuscula(this)" style="width:98%" value="<?php if ($usuario) echo $usuario->getEndereco(); ?>"/>
                    <span class="span_pequeno">Endereço</span></td>
            </tr>
            <tr>
                <td></td>
                <td id="compl"><input id="complemento" name="complemento" maxlength="100" onChange="maiuscula(this)" onKeyUp="maiuscula(this)" style="width:98%;" value="<?php if ($usuario) echo $usuario->getComplemento() ?>"/>
                    <span class="span_pequeno">Complemento</span></td>
            </tr>
            <tr>
                <td colspan="2"><span class="span_pequeno">OBS1: Caso você seja um Convidado selecione o Lions Clube que o convidou.<br>
                                                OBS2: Caso você seja um Convidado e não pertença aos Estados e Cidades listados abaixo, coloque seu Estado e Cidade no campo "Complemento" do Endereço.
                    </span><br/></td>
            </tr>
            <tr>
                <td class="col-1">Estado <span class="span_obg">*</span></td>
                <td><select id="estado" name="estado" onChange="Estado(false, false);" required>
                        <option value=""></option>
                        <option value="AMAPÁ">AMAPÁ</option>
                        <option value="MARANHÃO" >MARANHÃO</option>
                        <option value="PARÁ" >PARÁ</option>
                        <option value="PIAUÍ">PIAUÍ</option>
                    </select></td>
            <?php if ($usuario) { ?> <script>  Selecionar('estado', "<?php echo $usuario->getEstado(); ?>")</script> <?php } ?>
            </tr>
            <tr>
                <td class="col-1">Cidade <span class="span_obg">*</span></td>
                <td><select id="cidade" name="cidade" size="1" style="min-width:100px" required >
                        <option id="padrao" value="" >SELECIONE UM ESTADO</option>    
                    </select></td>
            </tr>
            <tr>
                <td class="col-1">Clube <span class="span_obg">*</span></td>
                <td><select id="clube" name="clube" style="min-width:100px" required>
                        <option value="">SELECIONE UM ESTADO</option>
                    </select></td>
            </tr>
            <?php if ($usuario) { ?> <script>  Estado("<?php echo $usuario->getCidade() ?>", "<?php echo $usuario->getClube() ?>");</script> <?php } ?>
            <tr>
                <td class="col-1">Delegado do Clube ? </td>
                <td><select id="delegado" name="delegado" onChange="Delegado()">
                        <option value=""></option>
                        <option value="SIM">SIM</option>
                        <option value="NÃO">NÃO</option>
                    </select>
                    <?php if ($usuario) { ?> <script>  Selecionar('delegado', "<?php echo $usuario->getDelegado(); ?>")</script> <?php } ?>
                    <br>
                    <span id="span_delegado">Ao Delegado é obrigatório a apresentação da carta de credenciamento e copia das cartas internacional e distrital dos dois semestres anteriores para votação no dia do evento.</span></td>
            </tr>
            <tr>
                <td class="col-1">Cargo no Clube &nbsp;</td>
                <td><select id="cargo_clube" name="cargo_clube" onChange="mostrarQual()" >
                        <option value=""></option>
                        <option value="PRESIDENTE">PRESIDENTE</option>
                        <option value="SECRETÁRIO">SECRETÁRIO</option>
                        <option value="TESOUREIRO">TESOUREIRO</option>
                        <option value="LEO">LEO</option>
                        <option value="OUTRO">OUTRO</option>
                    </select></td>
            <?php if ($usuario) { ?> <script>  Selecionar('cargo_clube', "<?php echo $usuario->getCargo_clube(); ?>")</script> <?php } ?>
            </tr>
            <tr class="ocultar" id="qual_clube">
                <td class="col-1">Qual ? &nbsp;</td>
                <td><input id="outro_cargo_clube" name="outro_cargo_clube" type="text" maxlength="30" onChange="maiuscula(this)" onKeyUp="maiuscula(this)" style="width:40%" value="<?php if ($usuario) echo $usuario->getQual_cc(); ?>"/></td>
            </tr>
            <tr>
                <td class="col-1">Cargo no Distrito &nbsp;</td>
                <td><select id="cargo_distrito" name="cargo_distrito" onChange="mostrarQual()">
                        <option value="0"></option>
                        <option value="GOVERNADOR">GOVERNADOR</option>
                        <option value="VICE GOVERNADOR">VICE GOVERNADOR</option>
                        <option value="PDG">PDG</option>
                        <option value="ASSESSOR">ASSESSOR</option>
                        <option value="ASSISTENTE">ASSISTENTE</option>
                        <option value="ASSOCIADO">ASSOCIADO</option>
                        <option value="CONVIDADO">CONVIDADO</option>
                        <option value="COORDENADOR">COORDENADOR</option>
                        <option value="DIRETOR">DIRETOR</option>
                        <option value="DOMADORA">DOMADORA</option>
                        <option value="PRESIDENTE DA RAGIÃO">PRESIDENTE DA RAGIÃO</option>
                        <option value="PRESIDENTE DA DIVISÃO">PRESIDENTE DA DIVISÃO</option>
                        <option value="COORDENADOR">COORDENADOR</option>
                        <option value="EX-PRESIDENTE CONSELHO">EX-PRESIDENTE CONSELHO</option>
                        <option value="VOGAL">VOGAL</option>
                        <option value="SECRETARIO">SECRETARIO</option>
                        <option value="TESOUREIRO">TESOUREIRO</option>
                        <option value="VICE PRESIDENTE">VICE PRESIDENTE</option>
                        <option value="OUTRO">OUTRO</option>
                    </select></td>
            <?php if ($usuario) { ?> <script>  Selecionar('cargo_distrito', "<?php echo $usuario->getCargo_distrito(); ?>")</script> <?php } ?>
            </tr>
            <tr class="ocultar" id="qual_distrito" >
                <td class="col-1">Qual ? &nbsp;</td>
                <td><input id="outro_cargo_distrtito" name="outro_cargo_distrtito" type="text" maxlength="30" onChange="maiuscula(this)" onKeyUp="maiuscula(this)" style="width:40%" value="<?php if ($usuario) echo $usuario->getQual_cd(); ?>"/></td>
            </tr>
            <?php if ($usuario) { ?> <script>  mostrarQual();</script> <?php } ?>
            <tr>
                <td class="col-1">CL Melvin Jones ? <span class="span_obg">*</span></td>
                <td><select id="cl_mj" name="cl_mj" required>
                        <option value=""></option>
                        <option value="SIM">SIM</option>
                        <option value="NÃO">NÃO</option>
                    </select></td>
            <?php if ($usuario) { ?> <script>  Selecionar('cl_mj', "<?php echo $usuario->getCl_mj(); ?>")</script> <?php } ?>
            </tr>
            <tr>
                <td class="col-1">Prefixo <span class="span_obg">*</span></td>
                <td><select id="prefixo" name="prefixo" required>
                        <option value=""></option>
                        <option value="Cal">Cal</option>
                        <option value="CL">CL</option>
                        <option value="DM">DM</option>
                        <option value="CCLEO">CCLEO</option>
                        <option value="Convidado">Convidado</option>
                    </select></td>
            <?php if ($usuario) { ?> <script>  Selecionar('prefixo', "<?php echo $usuario->getPrefixo(); ?>")</script> <?php } ?>
            </tr>
            <tr>
                <td class="col-1">Tamanho Camisa <span class="span_obg">*</span></td>
                <td><select id="camisa" name="camisa" required>
                        <option value=""></option>
                        <option value="P">P</option>
                        <option value="M">M</option>
                        <option value="G">G</option>
                        <option value="GG">GG</option>
                    </select></td>
            <?php if ($usuario) { ?> <script>  Selecionar('camisa', "<?php echo $usuario->getCamisa(); ?>")</script> <?php } ?>
            </tr>
            <tr>
                <td colspan="2" >Campos marcados com <span class="span_obg">*</span> são Obrigatórios.</td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center">
                    <button id="botao" class="button" type="submit" name="cadastro" value="<?php echo $usuario?'2':'1';?>"><?php echo $usuario ? "Atualizar" : "Cadastrar"; ?></button>
                </td>
            </tr>
            
        </table>
    </form>
</div>

<?php if($usuario): ?>
    <div style="text-align: right;">
        <button class="button" onclick="window.location='cadastro.html'">Voltar</button>
    </div>
<?php endif;?>


<?php

function monta_dia($dia = 0) {

    $option = "<option value=''>Dia</option>";

    for ($i = 1; $i <= 31; $i++) {
        $option .= "\t<option value=\"" . sprintf("%02d", $i) . "\" ". ($dia == sprintf("%02d", $i) ? 'selected="true"' : "") .">" . sprintf("%02d", $i) . "</option>\n";
    }
    return $option;
}

function monta_mes($mes = 0) {

    $option = "<option value=''>Mês</option>";
    $option .= "<option value='01' ". ($mes == '01' ? 'selected="true"' : "") .">Janeiro</option>";
    $option .= "<option value='02' ". ($mes == '02' ? 'selected="true"' : "") .">Fevereiro</option>";
    $option .= "<option value='03' ". ($mes == '03' ? 'selected="true"' : "") .">Março</option>";
    $option .= "<option value='04' ". ($mes == '04' ? 'selected="true"' : "") .">Abril</option>";
    $option .= "<option value='05' ". ($mes == '05' ? 'selected="true"' : "") .">Maio</option>";
    $option .= "<option value='06' ". ($mes == '06' ? 'selected="true"' : "") .">Junho</option>";
    $option .= "<option value='07' ". ($mes == '07' ? 'selected="true"' : "") .">Julho</option>";
    $option .= "<option value='08' ". ($mes == '08' ? 'selected="true"' : "") .">Agosto</option>";
    $option .= "<option value='09' ". ($mes == '09' ? 'selected="true"' : "") .">Setembro</option>";
    $option .= "<option value='10' ". ($mes == '10' ? 'selected="true"' : "") .">Outubro</option>";
    $option .= "<option value='11' ". ($mes == '11' ? 'selected="true"' : "") .">Novembro</option>";
    $option .= "<option value='12' ". ($mes == '12' ? 'selected="true"' : "") .">Dezembro</option>";

    return $option;
}

function monta_ano($ano = 0) {

    $option = "<option value=''>Ano</option>";

    for ($i = 2013; $i >= 1900; $i--) {
        $option .= "\t<option value=\"" . sprintf("%02d", $i) . "\" ". ($ano == sprintf("%02d", $i) ? 'selected="true"' : "") .">" . sprintf("%02d", $i) . "</option>\n";
    }

    return $option;
}
?>
</html>