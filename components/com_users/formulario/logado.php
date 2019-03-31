<script type="text/javascript">
    function cadConvencao(convId, inscId){
        var btn = document.getElementById("btnInscricao");
        if(btn){
            btn.setAttribute("disabled", "disabled");
        }
        inscId =  inscId ? '&inscricao=' + inscId : '';
        window.location='cadastro.html?convencao=' + convId + inscId;
    }
    function gerConvencao(id){
        window.location='cadastro.html?gerenciar=' + id;
    }
</script>

<?php 

if(isset($_GET['atualizar']) && $_GET['atualizar']):
    require_once 'formulario/formulario.php';
else:
    
    $convencoes = Convencao::getAbertas($db);
    $inscricoes = InscricaoConvencao::getByUsuario($usuario->getId(), $db);
    $gerenciaCconvencao = in_array(13, $user->groups);
    ?>
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


    <div>

        <?php if(isset($convencoes) && count($convencoes)): ?>

        <table class="category" title="Cadastro de Conveção" style="width: 80%; margin: auto; margin-top: 50px; ">
            <caption><h4>Convenções Abertas</h4></caption>
            <tr>
                <th style="text-align:center;" >Título</th>
                <th style="text-align:center;" width="25%">Inscrever-se</th>
                <th style="text-align:center;" width="25%">Inscrições</th>
                <?php if($gerenciaCconvencao):?>      
                    <th style="text-align:center;" width="15%">Gerenciar</th>        
                <?php endif;?>
            </tr>
            <?php foreach ($convencoes as $convencao): ?>
                <tr>
                    <td style="text-align:center;">
                        <?php echo $convencao->getTitulo() ?>
                        </td>										<?php $Inscrito = false; ?>					<?php $inscricaoID = 0; ?>					<?php foreach ($inscricoes as $inscricao): ?>						<?php if($inscricao->getConvencao_id() == $convencao->getId()): ?>							<?php $Inscrito = true; ?>							<?php $inscricaoID = $inscricao->getId(); ?>							<?php break;; ?>						<?php endif;?>					<?php endforeach; ?>
                        <td style="text-align:center;"> 												<?php if($Inscrito == false): ?>
                        <button id="btnInscricao" class="button" onclick="cadConvencao('<?php echo $convencao->getId() ?>')" title="Inscrever-se na Convenção">Inscrever-se na Convenção</button>						<?php endif;?>
                    </td>
                    <td style="text-align:center;"> 
                        <?php if($Inscrito == true): ?>                      
                            <button class="button" onclick="cadConvencao('<?php echo $convencao->getId() ?>','<?php echo $inscricaoID ?>')" title="Gerenciar Inscrição Principal">Inscrição Principal</button>
                        <?php endif;?>
                    </td>
                    <?php if($gerenciaCconvencao):?>      
                        <td style="text-align:center;">
                            <button class="button" onclick="gerConvencao('<?php echo $convencao->getId() ?>')" title="Gerenciar Cadastros">Gerenciar</button>
                        </td>          
                    <?php endif;?>
                </tr>                
            <?php endforeach; ?>
        </table>

    <?php endif;?>

</div>

<div>

    <table class="category" title="Informações Cadastrais" style="width: 80%; margin: auto; margin-top: 50px;">
        <caption><h4>Informações Cadastrais</h4></caption>
        <tr>
            <th style="width:25%">CPF / Login</th>
            <td style="width:75%"><?php echo substr($user->username, 0, 3) . '.' . substr($user->username, 3, 3) . '.' . substr($user->username, 6, 3) . '-' . substr($user->username, 9, 2); ?></td>
        </tr>
        <tr>
            <th>E-mail</th>
            <td><?php echo $user->email ?></td>
        </tr>
        <tr>
            <th>Matricula</th>
            <td><?php echo $usuario->getMatricula() ?></td>
        </tr>
        <tr>
            <th>Data Nascimento</th>
            <td><?php echo $usuario->getDataNascimento(); ?></td>
        </tr>
        <tr>
            <th>Endereço</th>
            <td>
                <?php 
                echo $usuario->getEndereco() . "<br>" ;
                echo $usuario->getComplemento() ? $usuario->getComplemento() . '<br>' : "";
                echo $usuario->getCidade() . " - " . $usuario->getEstado();
                ?>
            </td>
        </tr>
        <tr>
            <th>Clube</th>
            <td><?php echo $usuario->getClube() ?></td>
        </tr>
        <tr>
            <th>Cargo no Clube</th>
            <td><?php echo $usuario->getCargo_clube()!="OUTRO" ? $usuario->getCargo_clube() : $usuario->getQual_cc() ?></td>
        </tr>
        <tr>
            <th>Cargo no Distrito</th>
            <td><?php echo $usuario->getCargo_distrito()!="OUTRO" ? $usuario->getCargo_distrito() : $usuario->getQual_cd() ?></td>
        </tr>
        <tr>
            <th>CL Melvim Jones </th>
            <td><?php echo $usuario->getCl_mj() ?></td>
        </tr>
        <tr>
            <th>Tamanho de Camisa </th>
            <td><?php echo $usuario->getCamisa() ?></td>
        </tr>

    </table>
    <center>
        <form action="" method="GET">
            <input type="hidden" name="atualizar" value="1">
            <button class="button" type="submit">Atualizar Informações</button>
        </form>
    </center>

</div>


<?php endif; ?>