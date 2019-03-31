<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

?>
<div>

	<table class="category" title="Informações Cadastrais" style="width: 80%; margin: auto; margin-top: 50px;">
		<caption><h4>Informações Cadastrais</h4></caption>
		<tr>
			<th style="width:25%">CPF / Login</th>
			<td style="width:75%"><?php echo substr($this->user->username, 0, 3) . '.' . substr($this->user->username, 3, 3) . '.' . substr($this->user->username, 6, 3) . '-' . substr($this->user->username, 9, 2); ?></td>
		</tr>
		<tr>
			<th>E-mail</th>
			<td><?php echo $this->user->email ?></td>
		</tr>
		<tr>
			<th>Matricula</th>
			<td><?php echo $this->usuario->getMatricula() ?></td>
		</tr>
		<tr>
			<th>Data Nascimento</th>
			<td><?php echo $this->usuario->getDataNascimento(); ?></td>
		</tr>
		<tr>
			<th>Endereço</th>
			<td>
				<?php 
				echo $this->usuario->getEndereco() . "<br>" ;
				echo $this->usuario->getComplemento() ? $this->usuario->getComplemento() . '<br>' : "";
				echo $this->usuario->getCidade() . " - " . $this->usuario->getEstado();
				?>
			</td>
		</tr>
		<tr>
			<th>Clube</th>
			<td><?php echo $this->usuario->getClube() ?></td>
		</tr>
		<tr>
			<th>Cargo no Clube</th>
			<td><?php echo $this->usuario->getCargo_clube()!="OUTRO" ? $this->usuario->getCargo_clube() : $this->usuario->getQual_cc() ?></td>
		</tr>
		<tr>
			<th>Cargo no Distrito</th>
			<td><?php echo $this->usuario->getCargo_distrito()!="OUTRO" ? $this->usuario->getCargo_distrito() : $this->usuario->getQual_cd() ?></td>
		</tr>
		<tr>
			<th>CL Melvim Jones </th>
			<td><?php echo $this->usuario->getCl_mj() ?></td>
		</tr>
		<tr>
			<th>Tamanho de Camisa </th>
			<td><?php echo $this->usuario->getCamisa() ?></td>
		</tr>

	</table>
	<center>
		<form action="" method="GET">
			<input type="hidden" name="atualizar" value="1">
			<a class="button" href="<?php echo JRoute::_('index.php?option=com_users&task=profile.edit&user_id=' . (int) $this->data->id); ?>">
				<span class="icon-user"></span>
				<?php echo JText::_('COM_USERS_EDIT_PROFILE'); ?>
			</a>
		</form>
	</center>

</div>