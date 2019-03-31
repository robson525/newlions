<?php
/**
* @package     Joomla.Site
* @subpackage  com_users
*
* @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
* @license     GNU General Public License version 2 or later; see LICENSE.txt
*/

defined('_JEXEC') or die;


if(isset($_POST['cadastro']) && $_POST['cadastro']):
	include JPATH_COMPONENT . '/formulario/salvar.php';
endif; 
?>

<div id="user" style="font-size: 14px;">

	<form action="<?php echo JRoute::_('index.php?option=com_users&task=user.logout'); ?>" method="post" class="pull-right">
		<div class="control-group">
			<div class="controls">
				<button type="submit" class="btn btn-danger">
					<span class="icon-arrow-left icon-white"></span>
					<?php echo JText::_('JLOGOUT'); ?>
				</button>
			</div>
		</div>
		<?php if ($this->params->get('logout_redirect_url')) : ?>
			<input type="hidden" name="return" value="<?php echo base64_encode($this->params->get('logout_redirect_url', $this->form->getValue('return'))); ?>" />
			<?php else : ?>
				<input type="hidden" name="return" value="<?php echo base64_encode($this->params->get('logout_redirect_menuitem', $this->form->getValue('return'))); ?>" />
			<?php endif; ?>
			<?php echo JHtml::_('form.token'); ?>
		</form>

		<font style="font-weight:bold;"> Bem Vindo </font> <h1> <?php echo $this->user->name ?> </h1>
	</div>


	<?php echo $this->loadTemplate('convencao'); ?>

	<?php echo $this->loadTemplate('profile'); ?>

