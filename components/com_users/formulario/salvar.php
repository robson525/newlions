<?php
require_once 'formulario/classe/Conecta.php';
require_once 'formulario/classe/Usuario.php';
require_once 'formulario/classe/Email.php';

if (isset($_POST['cadastro']) && $_POST['cadastro']):
    extract($_POST);
    
    $novo = isset($user) ? false : true;
    
    $nascimento = "{$ano}-{$mes}-{$dia}";
    if ($dia == NULL && $mes == NULL && $ano == NULL) {
        $nascimento = '';
    }
    
    if($novo){
        $user = new JUser();
        $user->name = $nome;
        $user->username = preg_replace('/[^[:digit:]_]/', '', $cpf);
        $user->password = md5($senha1);
        $user->email = $email;
        $user->block = '0';
        $user->sendEmail = '0';
        $user->groups = array('2' => '2');
    }else{
        $user->name = $nome;
        $user->email = $email;
    }
    
    if($novo){
        $usuario = new Usuario();
    }
    $usuario->setConnection($db);
    $usuario->setMatricula($matricula);
    $usuario->setNascimento($nascimento);
    $usuario->setEndereco($endereco);
    $usuario->setComplemento($complemento);
    $usuario->setEstado($estado);
    $usuario->setCidade($cidade);
    $usuario->setClube($clube);
    $usuario->setDelegado($delegado);
    $usuario->setCargo_clube($cargo_clube);
    $usuario->setQual_cc($outro_cargo_clube);
    $usuario->setCargo_distrito($cargo_distrito);
    $usuario->setQual_cd($outro_cargo_distrtito);
    $usuario->setCl_mj($cl_mj);
    $usuario->setPrefixo($prefixo);
    $usuario->setCamisa($camisa);
    
    $email = new Email();
    $email->setDestinatario($user->email, $user->name);
    
    if($user->save(!$novo)):
        
        $usuario->setUser_id($user->id);
        
        if($usuario->save()):
            $erro = false;
            if($novo){
                $email->inscricaoSite();
                $email->enviar();
                $msg = "Usuário Cadastrado com Sucesso. <br/> Por favor faça login para confirmar sua participação na convenção;";
            }
            else{
                $msg = "Usuário Atualizado com Sucesso.";
            }
        else:
            $erro = true;
            $msg = $usuario->getError();
        endif;
        
    else:
        $erro = true;
        $msg = $user->getError();
        if($novo){
            $_GET['cadastrar'] = '1';
        }
        else{
            $_GET['atualizar'] = '1';
        }
    endif;

else:
    $erro = true;
    $msg = "Acesso Inválido.";
endif;
?>


<?php if($novo || $erro): ?>
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


<?php 


?>


