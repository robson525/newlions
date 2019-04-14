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
	<table class="table" title="Cadastro de Conveção" style="margin: auto; margin-top: 50px; ">
		<caption><h4>Convenções</h4></caption>
		<tr>
			<th>Título</th>
			<th>Ações</th>
		</tr>
		<?php foreach ($this->convencoes as $convencao): ?>
			<tr>
				<td >
					<?php echo $convencao->getTitulo() ?>
				</td>										
				<?php 
					$Inscrito = false;				
					$inscricaoID = 0;				
					foreach ($this->inscricoes as $inscricao){				
						if($inscricao->getConvencao_id() == $convencao->getId()){					
							$Inscrito = true; 		
							$inscricaoID = $inscricao->getId();						
							break;			
						}		
					}
				?>
				<td> 												
					<?php if($Inscrito == false): ?>
						<a class="button" href="<?php echo JRoute::_('index.php?option=com_users&task=profile.inscrever&convencao=' . (int) $convencao->getId()); ?>" title="Inscrever-se na Convenção">Inscrever-se</a>						
					<?php elseif($Inscrito == true): ?>                      
						<a class="button" href="<?php echo JRoute::_('index.php?option=com_users&task=profile.visualizar&inscricao=' . (int) $inscricaoID); ?>" title="Ver Inscrição da Convenção">Ver Inscrição</a>
					<?php endif;?>

					<?php if($this->gerenciaConvencao):?> 
						<a class="button" href="<?php echo JRoute::_('index.php?option=com_users&task=manage.gerenciar&convencao=' . (int) $convencao->getId()); ?>" title="Gerenciar Convenções">Gerenciar</a>		       
					<?php endif;?>
				</td>   
			</tr>                
		<?php endforeach; ?>
	</table>

</div>
<?php endif;?>
