<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JLoader::register('UsersController', JPATH_COMPONENT . '/controller.php');

require_once JPATH_COMPONENT . '/formulario/classe/Convencao.php';
require_once JPATH_COMPONENT . '/formulario/classe/InscricaoConvencao.php';
require_once JPATH_COMPONENT . '/formulario/classe/Comprovante.php';

/**
 * Reset controller class for Users.
 *
 * @since  1.6
 */
class UsersControllerManage extends UsersController
{
	/**
	 * Method to request a username reminder.
	 *
	 * @return  boolean
	 *
	 * @since   1.6
	 */
	public function gerenciar()
	{
		$app         	= JFactory::getApplication();		
		$db 			= JFactory::getDbo();
		$user        	= JFactory::getUser();
		$convencaoId	= $this->input->getInt('convencao');

		if (!$user->id)
		{
			$app->enqueueMessage(JText::_('JGLOBAL_YOU_MUST_LOGIN_FIRST'), 'error');
			$this->setRedirect(JRoute::_('index.php?option=com_users&view=login', false));
			return false;
		}

		if (!in_array(13, $user->groups) || !$convencaoId)
		{
			$app->enqueueMessage(JText::_('JGLOBAL_AUTH_ACCESS_DENIED'), 'error');
			$this->setRedirect(JRoute::_('index.php?option=com_users&view=login', false));
			return false;
		}

		$convencao = Convencao::getById($convencaoId, $db);

		if (!$convencao)
		{
			$app->enqueueMessage(JText::_('JGLOBAL_AUTH_ACCESS_DENIED'), 'error');
			$this->setRedirect(JRoute::_('index.php?option=com_users&view=login', false));
			return false;
		}

		$app->setUserState('com_users.manage.convencao', $convencaoId);
		$this->setRedirect(JRoute::_('index.php?option=com_users&view=manage', false));		
		
	}


	public function comprovante(){
		$app         	= JFactory::getApplication();		
		$db 			= JFactory::getDbo();
		$user        	= JFactory::getUser();
		$inscricaoId	= $this->input->getInt('inscricao');

		if (!$user->id)
		{
			$app->enqueueMessage(JText::_('JGLOBAL_YOU_MUST_LOGIN_FIRST'), 'error');
			$this->setRedirect(JRoute::_('index.php?option=com_users&view=login', false));
			return false;
		}

		if (!in_array(13, $user->groups) || !$inscricaoId)
		{
			$app->enqueueMessage(JText::_('JGLOBAL_AUTH_ACCESS_DENIED'), 'error');
			$this->setRedirect(JRoute::_('index.php?option=com_users&view=login', false));
			return false;
		}

		$app->setUserState('com_users.manage.inscricao', $inscricaoId);
		$this->setRedirect(JRoute::_('index.php?option=com_users&view=manage&layout=comprovante', false));
		return true;
	}




}
