<?php
defined('_JEXEC') or die;
?>
<div id="user" style="font-size: 14px;">

	<a class="btn btn-small pull-right btn-out" href="<?php echo JRoute::_('index.php?option=com_users&view=profile'); ?>" title="Voltar">
		<i class="icon-arrow-left"></i>Voltar
	</a>

	<font class="bold"> Bem Vindo </font> <h1> <?php echo $this->user->name ?> </h1>
</div>

<h1 class="center bold">
	<?= $this->convencao->getTitulo() ?>		
</h1>

<?php 
	if(isset($this->inscricao))
		echo $this->loadTemplate('visualizar'); 
	else
		 echo $this->loadTemplate('confirmar'); 


?>
