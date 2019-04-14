<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

require_once JPATH_COMPONENT . '/formulario/classe/Usuario.php';
require_once JPATH_COMPONENT . '/formulario/classe/Convencao.php';
require_once JPATH_COMPONENT . '/formulario/classe/Comprovante.php';
require_once JPATH_COMPONENT . '/formulario/classe/InscricaoConvencao.php';

/**
 * Reset view class for Users.
 *
 * @since  1.5
 */
class UsersViewManage extends JViewLegacy
{

	protected $user;

	protected $db;

	protected $convencao; 

	protected $inscritos;

	protected $Ninscricoes;

	protected $estado;

	protected $cidade;

	protected $clube;

	protected $inscricao; 

	protected $comprovante; 

	/**
	 * Method to display the view.
	 *
	 * @param   string  $tpl  The template file to include
	 *
	 * @return  mixed
	 *
	 * @since   1.5
	 */
	public function display($tpl = null)
	{        
		$this->user 	= JFactory::getUser();
		$app    		= JFactory::getApplication();
		$convencaoId 	= $app->getUserState('com_users.manage.convencao');	
		
		if (!$this->user->id || !$convencaoId)
		{
			$app->enqueueMessage(JText::_('JGLOBAL_YOU_MUST_LOGIN_FIRST'), 'error');
			$app->redirect(JRoute::_('index.php?option=com_users&view=login', false));
			return false;
		}		

		$this->db			= JFactory::getDbo();
		$this->convencao 	= Convencao::getById($convencaoId, $this->db);

		if($app->input->getString("layout") == "comprovante")
		{
			$inscricaoId = $app->getUserState('com_users.manage.inscricao');

			if(!$inscricaoId)
			{
				$app->enqueueMessage(JText::_('JGLOBAL_AUTH_ACCESS_DENIED'), 'error');
				$app->redirect(JRoute::_('index.php?option=com_users&view=login', false));
				return false;
			}

			$this->inscricao 	= InscricaoConvencao::getById($inscricaoId, $this->db);
			$this->comprovante 	= Comprovante::getById($this->inscricao->getComprovante(), $this->db);

			$usuario 			= Usuario::getById($this->inscricao->getUsuario_id(), $this->db);
			$this->user 		= JFactory::getUser($usuario->getUser_id());

			parent::display($tpl);
			exit();
		}
		else
		{
			$app->setUserState('com_users.manage.comprovante', null);

			$this->estado		= $app->input->getString("estado"); 
			$this->cidade		= $app->input->getString("cidade"); 
			$this->clube		= $app->input->getString("clube"); 		
			
			$this->inscritos 	= InscricaoConvencao::getInscricoesGerencia($convencaoId, $this->estado, $this->cidade, $this->clube, $this->db);		

			return parent::display($tpl);
		}
	}


}
