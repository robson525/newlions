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
require_once JPATH_COMPONENT . '/formulario/classe/InscricaoConvencao.php';

/**
 * Profile view class for Users.
 *
 * @since  1.6
 */
class UsersViewProfile extends JViewLegacy
{
	protected $data;

	protected $form;

	protected $params;

	protected $state;

	protected $user;

	protected $usuario;

	protected $convencoes;

	protected $inscricoes;

	protected $gerenciaConvencao;

	protected $convencao; 

	protected $inscricao;

	/**
	 * An instance of JDatabaseDriver.
	 *
	 * @var    JDatabaseDriver
	 * @since  3.6.3
	 */
	protected $db;

	/**
	 * Execute and display a template script.
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  mixed   A string if successful, otherwise an Error object.
	 *
	 * @since   1.6
	 */
	public function display($tpl = null)
	{
		$this->user = JFactory::getUser();

		// Get the view data.
		$this->data	        = $this->get('Data');
		$this->form	        = $this->getModel()->getForm(new JObject(array('id' => $this->user->id)));
		$this->state            = $this->get('State');
		$this->params           = $this->state->get('params');
		$this->twofactorform    = $this->get('Twofactorform');
		$this->twofactormethods = UsersHelper::getTwoFactorMethods();
		$this->otpConfig        = $this->get('OtpConfig');
		$this->db               = JFactory::getDbo();

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));

			return false;
		}

		// View also takes responsibility for checking if the user logged in with remember me.
		$cookieLogin = $this->user->get('cookieLogin');

		if (!empty($cookieLogin))
		{
			// If so, the user must login to edit the password and other data.
			// What should happen here? Should we force a logout which destroys the cookies?
			$app = JFactory::getApplication();
			$app->enqueueMessage(JText::_('JGLOBAL_REMEMBER_MUST_LOGIN'), 'message');
			$app->redirect(JRoute::_('index.php?option=com_users&view=login', false));

			return false;
		}

		// Check if a user was found.
		if (!$this->data->id)
		{
			JError::raiseError(404, JText::_('JERROR_USERS_PROFILE_NOT_FOUND'));

			return false;
		}

		JPluginHelper::importPlugin('content');
		$this->data->text = '';
		JEventDispatcher::getInstance()->trigger('onContentPrepare', array ('com_users.user', &$this->data, &$this->data->params, 0));
		unset($this->data->text);

		// Check for layout override
		$active = JFactory::getApplication()->getMenu()->getActive();

		if (isset($active->query['layout']))
		{
			$this->setLayout($active->query['layout']);
		}

		// Escape strings for HTML output
		$this->pageclass_sfx = htmlspecialchars($this->params->get('pageclass_sfx'));

		$this->prepareDocument();

		return parent::display($tpl);
	}

	/**
	 * Prepares the document
	 *
	 * @return  void
	 *
	 * @since   1.6
	 */
	protected function prepareDocument()
	{
		$uri = JUri::getInstance();

		if($uri->getVar("layout") == "inscricao")
		{
			$app    = JFactory::getApplication();
			$convencaoId = $app->getUserState('com_users.edit.profile.convencao');
			$inscricaoId = $app->getUserState('com_users.edit.profile.inscricao');

			$this->convencao = Convencao::getById($convencaoId, $this->db);

			if(isset($inscricao))
				$this->inscricao = InscricaoConvencao::getById($inscricaoId);

			var_dump($this->convencao, $this->inscricao);
		}
		else
		{
			$this->usuario = Usuario::getByUser($this->user->id, $this->db);
			$this->usuario->setConnection($this->db);
			$this->convencoes = Convencao::getAbertas($this->db);
			$this->inscricoes = InscricaoConvencao::getByUsuario($this->usuario->getId(), $this->db);
			$this->gerenciaConvencao = in_array(13, $this->user->groups);
		}
		
	}
}
