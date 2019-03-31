<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

if(isset($this->convencoes) && count($this->convencoes)): 

?>

<div>
	<table class="category" title="Cadastro de Conveção" style="width: 80%; margin: auto; margin-top: 50px; ">
		<caption><h4>Convenções Abertas</h4></caption>
		<tr>
			<th style="text-align:center;" >Título</th>
			<th style="text-align:center;" width="25%">Inscrever-se</th>
			<th style="text-align:center;" width="25%">Inscrições</th>
			<?php if($this->gerenciaConvencao):?>      
				<th style="text-align:center;" width="15%">Gerenciar</th>        
			<?php endif;?>
		</tr>
		<?php foreach ($this->convencoes as $convencao): ?>
			<tr>
				<td style="text-align:center;">
					<?php echo $convencao->getTitulo() ?>
					</td>										<?php $Inscrito = false; ?>					<?php $inscricaoID = 0; ?>					<?php foreach ($this->inscricoes as $inscricao): ?>						<?php if($inscricao->getConvencao_id() == $convencao->getId()): ?>							<?php $Inscrito = true; ?>							<?php $inscricaoID = $inscricao->getId(); ?>							<?php break;; ?>						<?php endif;?>					<?php endforeach; ?>
					<td style="text-align:center;"> 												<?php if($Inscrito == false): ?>
					<button id="btnInscricao" class="button" onclick="cadConvencao('<?php echo $convencao->getId() ?>')" title="Inscrever-se na Convenção">Inscrever-se na Convenção</button>						<?php endif;?>
				</td>
				<td style="text-align:center;"> 
					<?php if($Inscrito == true): ?>                      
						<button class="button" onclick="cadConvencao('<?php echo $convencao->getId() ?>','<?php echo $inscricaoID ?>')" title="Gerenciar Inscrição Principal">Inscrição Principal</button>
					<?php endif;?>
				</td>
				<?php if($this->gerenciaConvencao):?>      
					<td style="text-align:center;">
						<button class="button" onclick="gerConvencao('<?php echo $convencao->getId() ?>')" title="Gerenciar Cadastros">Gerenciar</button>
					</td>          
				<?php endif;?>
			</tr>                
		<?php endforeach; ?>
	</table>

</div>
<?php endif;?>


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