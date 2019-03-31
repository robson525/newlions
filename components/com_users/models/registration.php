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
	require_once JPATH_COMPONENT . '/formulario/classe/Email.php';

	/**
	 * Registration model class for Users.
	 *
	 * @since  1.6
	 */
	class UsersModelRegistration extends JModelForm
	{
		/**
		 * @var    object  The user registration data.
		 * @since  1.6
		 */
		protected $data;

		/**
		 * Constructor
		 *
		 * @param   array  $config  An array of configuration options (name, state, dbo, table_path, ignore_request).
		 *
		 * @since   3.6
		 *
		 * @throws  Exception
		 */
		public function __construct($config = array())
		{
			$config = array_merge(
				array(
					'events_map' => array('validate' => 'user')
				), $config
			);

			parent::__construct($config);
		}

		public function validate($form, $requestData, $group = NULL){

			$return = true;

			if(strlen($requestData['username']) != 11){
				$this->setError('O CPF informado é inválido. Informe outro CPF.');
				$return = false;
			}
			elseif ($this->verifica('cpf', $requestData['username']) !== false) {
				$this->setError('O CPF infrmado já está em uso. Informe outro CPF.');
				$return = false;
			}

			if(strlen($requestData['registration']) != 10){
				$this->setError('A Matrícula digitada é inválida. Informe outra matrícula.');
				$return = false;
			}			
			elseif ($requestData['registration'] != "0000000000"  && $this->verifica('matricula', $requestData['registration']) !== false) {
				$this->setError('A Matrícula digitada já está em uso. Informe outra matrícula.');	
				$return = false;			
			}

			return parent::validate($form, $requestData, $group) && $return;
		}

		private function verifica($campo, $valor) {
		    $tabela = $campo=='matricula' ? '__usuario' : 'jom1_users';
		    $campo = $campo=='matricula' ? 'matricula' : 'username';
		   	$db = $this->getDbo();		   	
		    $sql = "SELECT * FROM $tabela WHERE $campo = '$valor';";
		    $db->setQuery($sql);
        	$results = $db->loadObjectList();

		    if (count($results) > 0) {
		        return $results['id'];
		    } else
		        return false;
		}

		/**
		 * Method to get the user ID from the given token
		 *
		 * @param   string  $token  The activation token.
		 *
		 * @return  mixed   False on failure, id of the user on success
		 *
		 * @since   3.8.13
		 */
		public function getUserIdFromToken($token)
		{
			$db = $this->getDbo();

			// Get the user id based on the token.
			$query = $db->getQuery(true);
			$query->select($db->quoteName('id'))
				->from($db->quoteName('#__users'))
				->where($db->quoteName('activation') . ' = ' . $db->quote($token))
				->where($db->quoteName('block') . ' = ' . 1)
				->where($db->quoteName('lastvisitDate') . ' = ' . $db->quote($db->getNullDate()));
			$db->setQuery($query);

			try
			{
				return (int) $db->loadResult();
			}
			catch (RuntimeException $e)
			{
				$this->setError(JText::sprintf('COM_USERS_DATABASE_ERROR', $e->getMessage()), 500);

				return false;
			}
		}

		/**
		 * Method to activate a user account.
		 *
		 * @param   string  $token  The activation token.
		 *
		 * @return  mixed    False on failure, user object on success.
		 *
		 * @since   1.6
		 */
		public function activate($token)
		{
			$config     = JFactory::getConfig();
			$userParams = JComponentHelper::getParams('com_users');
			$userId     = $this->getUserIdFromToken($token);

			// Check for a valid user id.
			if (!$userId)
			{
				$this->setError(JText::_('COM_USERS_ACTIVATION_TOKEN_NOT_FOUND'));

				return false;
			}

			// Load the users plugin group.
			JPluginHelper::importPlugin('user');

			// Activate the user.
			$user = JFactory::getUser($userId);

			// Admin activation is on and user is verifying their email
			if (($userParams->get('useractivation') == 2) && !$user->getParam('activate', 0))
			{
				$linkMode = $config->get('force_ssl', 0) == 2 ? 1 : -1;

				// Compile the admin notification mail values.
				$data = $user->getProperties();
				$data['activation'] = JApplicationHelper::getHash(JUserHelper::genRandomPassword());
				$user->set('activation', $data['activation']);
				$data['siteurl'] = JUri::base();
				$data['activate'] = JRoute::link('site', 'index.php?option=com_users&task=registration.activate&token=' . $data['activation'], false, $linkMode);

				$data['fromname'] = $config->get('fromname');
				$data['mailfrom'] = $config->get('mailfrom');
				$data['sitename'] = $config->get('sitename');
				$user->setParam('activate', 1);
				$emailSubject = JText::sprintf(
					'COM_USERS_EMAIL_ACTIVATE_WITH_ADMIN_ACTIVATION_SUBJECT',
					$data['name'],
					$data['sitename']
				);

				$emailBody = JText::sprintf(
					'COM_USERS_EMAIL_ACTIVATE_WITH_ADMIN_ACTIVATION_BODY',
					$data['sitename'],
					$data['name'],
					$data['email'],
					$data['username'],
					$data['activate']
				);

				// Get all admin users
				$db = $this->getDbo();
				$query = $db->getQuery(true)
					->select($db->quoteName(array('name', 'email', 'sendEmail', 'id')))
					->from($db->quoteName('#__users'))
					->where($db->quoteName('sendEmail') . ' = 1')
					->where($db->quoteName('block') . ' = 0');

				$db->setQuery($query);

				try
				{
					$rows = $db->loadObjectList();
				}
				catch (RuntimeException $e)
				{
					$this->setError(JText::sprintf('COM_USERS_DATABASE_ERROR', $e->getMessage()), 500);

					return false;
				}

				// Send mail to all users with users creating permissions and receiving system emails
				foreach ($rows as $row)
				{
					$usercreator = JFactory::getUser($row->id);

					if ($usercreator->authorise('core.create', 'com_users'))
					{
						$return = JFactory::getMailer()->sendMail($data['mailfrom'], $data['fromname'], $row->email, $emailSubject, $emailBody);

						// Check for an error.
						if ($return !== true)
						{
							$this->setError(JText::_('COM_USERS_REGISTRATION_ACTIVATION_NOTIFY_SEND_MAIL_FAILED'));

							return false;
						}
					}
				}
			}
			// Admin activation is on and admin is activating the account
			elseif (($userParams->get('useractivation') == 2) && $user->getParam('activate', 0))
			{
				$user->set('activation', '');
				$user->set('block', '0');

				// Compile the user activated notification mail values.
				$data = $user->getProperties();
				$user->setParam('activate', 0);
				$data['fromname'] = $config->get('fromname');
				$data['mailfrom'] = $config->get('mailfrom');
				$data['sitename'] = $config->get('sitename');
				$data['siteurl'] = JUri::base();
				$emailSubject = JText::sprintf(
					'COM_USERS_EMAIL_ACTIVATED_BY_ADMIN_ACTIVATION_SUBJECT',
					$data['name'],
					$data['sitename']
				);

				$emailBody = JText::sprintf(
					'COM_USERS_EMAIL_ACTIVATED_BY_ADMIN_ACTIVATION_BODY',
					$data['name'],
					$data['siteurl'],
					$data['username']
				);

				$return = JFactory::getMailer()->sendMail($data['mailfrom'], $data['fromname'], $data['email'], $emailSubject, $emailBody);

				// Check for an error.
				if ($return !== true)
				{
					$this->setError(JText::_('COM_USERS_REGISTRATION_ACTIVATION_NOTIFY_SEND_MAIL_FAILED'));

					return false;
				}
			}
			else
			{
				$user->set('activation', '');
				$user->set('block', '0');
			}

			// Store the user object.
			if (!$user->save())
			{
				$this->setError(JText::sprintf('COM_USERS_REGISTRATION_ACTIVATION_SAVE_FAILED', $user->getError()));

				return false;
			}

			return $user;
		}

		/**
		 * Method to get the registration form data.
		 *
		 * The base form data is loaded and then an event is fired
		 * for users plugins to extend the data.
		 *
		 * @return  mixed  Data object on success, false on failure.
		 *
		 * @since   1.6
		 */
		public function getData()
		{
			if ($this->data === null)
			{
				$this->data = new stdClass;
				$app = JFactory::getApplication();
				$params = JComponentHelper::getParams('com_users');

				// Override the base user data with any data in the session.
				$temp = (array) $app->getUserState('com_users.registration.data', array());

				// Don't load the data in this getForm call, or we'll call ourself
				$form = $this->getForm(array(), false);

				foreach ($temp as $k => $v)
				{
					// Here we could have a grouped field, let's check it
					if (is_array($v))
					{
						$this->data->$k = new stdClass;

						foreach ($v as $key => $val)
						{
							if ($form->getField($key, $k) !== false)
							{
								$this->data->$k->$key = $val;
							}
						}
					}
					// Only merge the field if it exists in the form.
					elseif ($form->getField($k) !== false)
					{
						$this->data->$k = $v;
					}
				}

				// Get the groups the user should be added to after registration.
				$this->data->groups = array();

				// Get the default new user group, Registered if not specified.
				$system = $params->get('new_usertype', 2);

				$this->data->groups[] = $system;

				// Unset the passwords.
				unset($this->data->password1, $this->data->password2);

				// Get the dispatcher and load the users plugins.
				$dispatcher = JEventDispatcher::getInstance();
				JPluginHelper::importPlugin('user');

				// Trigger the data preparation event.
				$results = $dispatcher->trigger('onContentPrepareData', array('com_users.registration', $this->data));

				// Check for errors encountered while preparing the data.
				if (count($results) && in_array(false, $results, true))
				{
					$this->setError($dispatcher->getError());
					$this->data = false;
				}
			}

			return $this->data;
		}

		/**
		 * Method to get the registration form.
		 *
		 * The base form is loaded from XML and then an event is fired
		 * for users plugins to extend the form with extra fields.
		 *
		 * @param   array    $data      An optional array of data for the form to interogate.
		 * @param   boolean  $loadData  True if the form is to load its own data (default case), false if not.
		 *
		 * @return  JForm  A JForm object on success, false on failure
		 *
		 * @since   1.6
		 */
		public function getForm($data = array(), $loadData = true)
		{
			// Get the form.
			$form = $this->loadForm('com_users.registration', 'registration', array('control' => 'jform', 'load_data' => $loadData));

			if (empty($form))
			{
				return false;
			}

			// When multilanguage is set, a user's default site language should also be a Content Language
			if (JLanguageMultilang::isEnabled())
			{
				$form->setFieldAttribute('language', 'type', 'frontend_language', 'params');
			}

			return $form;
		}

		/**
		 * Method to get the data that should be injected in the form.
		 *
		 * @return  mixed  The data for the form.
		 *
		 * @since   1.6
		 */
		protected function loadFormData()
		{
			$data = $this->getData();

			if (JLanguageMultilang::isEnabled() && empty($data->language))
			{
				$data->language = JFactory::getLanguage()->getTag();
			}

			$this->preprocessData('com_users.registration', $data);

			return $data;
		}

		/**
		 * Override preprocessForm to load the user plugin group instead of content.
		 *
		 * @param   JForm   $form   A JForm object.
		 * @param   mixed   $data   The data expected for the form.
		 * @param   string  $group  The name of the plugin group to import (defaults to "content").
		 *
		 * @return  void
		 *
		 * @since   1.6
		 * @throws  Exception if there is an error in the form event.
		 */
		protected function preprocessForm(JForm $form, $data, $group = 'user')
		{
			$userParams = JComponentHelper::getParams('com_users');

			// Add the choice for site language at registration time
			if ($userParams->get('site_language') == 1 && $userParams->get('frontend_userparams') == 1)
			{
				$form->loadFile('sitelang', false);
			}

			parent::preprocessForm($form, $data, $group);
		}

		/**
		 * Method to auto-populate the model state.
		 *
		 * Note. Calling getState in this method will result in recursion.
		 *
		 * @return  void
		 *
		 * @since   1.6
		 */
		protected function populateState()
		{
			// Get the application object.
			$app = JFactory::getApplication();
			$params = $app->getParams('com_users');

			// Load the parameters.
			$this->setState('params', $params);
		}

		/**
		 * Method to save the form data.
		 *
		 * @param   array  $temp  The form data.
		 *
		 * @return  mixed  The user id on success, false on failure.
		 *
		 * @since   1.6
		 */
		public function register($temp)
		{
			$params = JComponentHelper::getParams('com_users');

			// Initialise the table with JUser.
			$user = new JUser;
			$data = (array) $this->getData();

			// Merge in the registration data.
			foreach ($temp as $k => $v)
			{
				$data[$k] = $v;
			}

			// Prepare the data for the user object.
			$data['email'] = JStringPunycode::emailToPunycode($data['email1']);
			$data['password'] = $data['password1'];
			$useractivation = $params->get('useractivation');
			$sendpassword = $params->get('sendpassword', 1);

			// Check if the user needs to activate their account.
			if (($useractivation == 1) || ($useractivation == 2))
			{
				$data['activation'] = JApplicationHelper::getHash(JUserHelper::genRandomPassword());
				//$data['block'] = 1;
			}

			// Bind the data.
			if (!$user->bind($data))
			{
				$this->setError(JText::sprintf('COM_USERS_REGISTRATION_BIND_FAILED', $user->getError()));

				return false;
			}

			// Load the users plugin group.
			JPluginHelper::importPlugin('user');

			// Store the data.
			if (!$user->save())
			{
				$this->setError(JText::sprintf('COM_USERS_REGISTRATION_SAVE_FAILED', $user->getError()));

				return false;
			}

			$config = JFactory::getConfig();
			$db = $this->getDbo();
			$query = $db->getQuery(true);

			$usuario = new Usuario();
			$usuario->setConnection($db);
			$usuario->setUser_id($user->id);
			$usuario->setMatricula($data['registration']);
			$usuario->setNascimento(strrev($data['birthday']));
			$usuario->setEndereco($data['addres']);
			$usuario->setComplemento($data['addres-comp']);
			$usuario->setEstado($data['state']);
			$usuario->setCidade($data['city']);
			$usuario->setClube($data['club']);
			$usuario->setDelegado($data['club-delegate']);
			$usuario->setCargo_clube($data['club-office']);
			$usuario->setQual_cc($data['club-other']);
			$usuario->setCargo_distrito($data['district-office']);
			$usuario->setQual_cd($data['district-other']);
			$usuario->setCl_mj($data['melvin-jones']);
			$usuario->setPrefixo($data['prefix']);
			$usuario->setCamisa($data['shirt']);
			
			if($usuario->save())
			{
				$email = new Email();
		    	$email->setDestinatario($user->email, $user->name);
		    	$email->inscricaoSite();
		        $email->enviar();
	    	}
	    	else
	    	{
				$this->setError(JText::sprintf('COM_USERS_REGISTRATION_SAVE_FAILED', $usuario->getError()));

				return false;
	    	}

			
			return $user->id;		
		}
	}
