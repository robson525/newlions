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

use Joomla\Registry\Registry;

/**
 * Profile model class for Users.
 *
 * @since  1.6
 */
class UsersModelProfile extends JModelForm
{
	/**
	 * @var		object	The user profile data.
	 * @since   1.6
	 */
	protected $data;

	/**
	 * Constructor
	 *
	 * @param   array  $config  An array of configuration options (name, state, dbo, table_path, ignore_request).
	 *
	 * @since   3.2
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

		// Load the helper and model used for two factor authentication
		JLoader::register('UsersModelUser', JPATH_ADMINISTRATOR . '/components/com_users/models/user.php');
		JLoader::register('UsersHelper', JPATH_ADMINISTRATOR . '/components/com_users/helpers/users.php');
	}

	public function validate($form, $requestData, $group = NULL){

		$return = true;

		if(strlen($requestData['registration']) != 10){
			$this->setError('A Matrícula digitada é inválida. Informe outra matrícula.');
			$return = false;
		}			
		elseif ($requestData['registration'] != "0000000000"  && $this->verifica('matricula', $requestData['registration']) !== false) {
			$this->setError('A Matrícula digitada já está em uso. Informe outra matrícula.');	
			$return = false;			
		}

		$validate = parent::validate($form, $requestData, $group);

		if(!$return || !$validate)
			return false;

		return $validate;
	}

	private function verifica($campo, $valor) {
	    $tabela = $campo=='matricula' ? '__usuario' : 'jom1_users';
	    $campo = $campo=='matricula' ? 'matricula' : 'username';
	   	$db = $this->getDbo();		   	
	    $sql = "SELECT * FROM $tabela WHERE $campo = '$valor';";
	    $db->setQuery($sql);
    	$results = $db->loadObjectList();
	    if (count($results) > 0) {
	    	if($results[0]->$campo == $valor)
	    		return false;
	    	else
	        	return $results[0]->id;
	    } else
	        return false;
	}

	/**
	 * Method to check in a user.
	 *
	 * @param   integer  $userId  The id of the row to check out.
	 *
	 * @return  boolean  True on success, false on failure.
	 *
	 * @since   1.6
	 */
	public function checkin($userId = null)
	{
		// Get the user id.
		$userId = (!empty($userId)) ? $userId : (int) $this->getState('user.id');

		if ($userId)
		{
			// Initialise the table with JUser.
			$table = JTable::getInstance('User');

			// Attempt to check the row in.
			if (!$table->checkin($userId))
			{
				$this->setError($table->getError());

				return false;
			}
		}

		return true;
	}

	/**
	 * Method to check out a user for editing.
	 *
	 * @param   integer  $userId  The id of the row to check out.
	 *
	 * @return  boolean  True on success, false on failure.
	 *
	 * @since   1.6
	 */
	public function checkout($userId = null)
	{
		// Get the user id.
		$userId = (!empty($userId)) ? $userId : (int) $this->getState('user.id');

		if ($userId)
		{
			// Initialise the table with JUser.
			$table = JTable::getInstance('User');

			// Get the current user object.
			$user = JFactory::getUser();

			// Attempt to check the row out.
			if (!$table->checkout($user->get('id'), $userId))
			{
				$this->setError($table->getError());

				return false;
			}
		}

		return true;
	}

	/**
	 * Method to get the profile form data.
	 *
	 * The base form data is loaded and then an event is fired
	 * for users plugins to extend the data.
	 *
	 * @return  mixed  	Data object on success, false on failure.
	 *
	 * @since   1.6
	 */
	public function getData()
	{
		if ($this->data === null)
		{
			$userId = $this->getState('user.id');

			// Initialise the table with JUser.
			$this->data = new JUser($userId);

			// Set the base user data.
			$this->data->email1 = $this->data->get('email');
			$this->data->email2 = $this->data->get('email');

			// Override the base user data with any data in the session.
			$temp = (array) JFactory::getApplication()->getUserState('com_users.edit.profile.data', array());

			foreach ($temp as $k => $v)
			{
				$this->data->$k = $v;
			}

			// Unset the passwords.
			unset($this->data->password1, $this->data->password2);

			$registry           = new Registry($this->data->params);
			$this->data->params = $registry->toArray();
		}

		return $this->data;
	}

	/**
	 * Method to get the profile form.
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
		$form = $this->loadForm('com_users.profile', 'profile', array('control' => 'jform', 'load_data' => $loadData));

		if (empty($form))
		{
			return false;
		}

		// Check for username compliance and parameter set
		$isUsernameCompliant = true;
		$username = $loadData ? $form->getValue('username') : $this->loadFormData()->username;

		if ($username)
		{
			$isUsernameCompliant  = !(preg_match('#[<>"\'%;()&\\\\]|\\.\\./#', $username) || strlen(utf8_decode($username)) < 2
				|| trim($username) !== $username);
		}

		$this->setState('user.username.compliant', $isUsernameCompliant);

		if ($isUsernameCompliant && !JComponentHelper::getParams('com_users')->get('change_login_name'))
		{
			$form->setFieldAttribute('username', 'class', '');
			$form->setFieldAttribute('username', 'filter', '');
			$form->setFieldAttribute('username', 'description', 'COM_USERS_PROFILE_NOCHANGE_USERNAME_DESC');
			$form->setFieldAttribute('username', 'validate', '');
			$form->setFieldAttribute('username', 'message', '');
			$form->setFieldAttribute('username', 'readonly', 'true');
			$form->setFieldAttribute('username', 'required', 'false');
			$form->setFieldAttribute('username', 'class', 'span4');
		}

		// When multilanguage is set, a user's default site language should also be a Content Language
		if (JLanguageMultilang::isEnabled())
		{
			$form->setFieldAttribute('language', 'type', 'frontend_language', 'params');
		}

		// If the user needs to change their password, mark the password fields as required
		if (JFactory::getUser()->requireReset)
		{
			$form->setFieldAttribute('password1', 'required', 'true');
			$form->setFieldAttribute('password2', 'required', 'true');
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

		$this->preprocessData('com_users.profile', $data, 'user');

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
	 * @throws	Exception if there is an error in the form event.
	 *
	 * @since   1.6
	 */
	protected function preprocessForm(JForm $form, $data, $group = 'user')
	{
		if (JComponentHelper::getParams('com_users')->get('frontend_userparams'))
		{
			$form->loadFile('frontend', false);

			if (JFactory::getUser()->authorise('core.login.admin'))
			{
				$form->loadFile('frontend_admin', false);
			}
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
		$params = JFactory::getApplication()->getParams('com_users');

		// Get the user id.
		$userId = JFactory::getApplication()->getUserState('com_users.edit.profile.id');
		$userId = !empty($userId) ? $userId : (int) JFactory::getUser()->get('id');

		// Set the user id.
		$this->setState('user.id', $userId);

		// Load the parameters.
		$this->setState('params', $params);
	}

	/**
	 * Method to save the form data.
	 *
	 * @param   array  $data  The form data.
	 *
	 * @return  mixed  The user id on success, false on failure.
	 *
	 * @since   1.6
	 */
	public function save($data)
	{
		$userId = (!empty($data['id'])) ? $data['id'] : (int) $this->getState('user.id');

		$user = new JUser($userId);

		// Prepare the data for the user object.
		$data['email']    = JStringPunycode::emailToPunycode($data['email1']);
		$data['password'] = $data['password1'];

		// Unset the username if it should not be overwritten
		$isUsernameCompliant = $this->getState('user.username.compliant');

		if ($isUsernameCompliant && !JComponentHelper::getParams('com_users')->get('change_login_name'))
		{
			unset($data['username']);
		}

		// Unset block and sendEmail so they do not get overwritten
		unset($data['block'], $data['sendEmail']);

		// Handle the two factor authentication setup
		if (array_key_exists('twofactor', $data))
		{
			$model = new UsersModelUser;

			$twoFactorMethod = $data['twofactor']['method'];

			// Get the current One Time Password (two factor auth) configuration
			$otpConfig = $model->getOtpConfig($userId);

			if ($twoFactorMethod !== 'none')
			{
				// Run the plugins
				FOFPlatform::getInstance()->importPlugin('twofactorauth');
				$otpConfigReplies = FOFPlatform::getInstance()->runPlugins('onUserTwofactorApplyConfiguration', array($twoFactorMethod));

				// Look for a valid reply
				foreach ($otpConfigReplies as $reply)
				{
					if (!is_object($reply) || empty($reply->method) || ($reply->method != $twoFactorMethod))
					{
						continue;
					}

					$otpConfig->method = $reply->method;
					$otpConfig->config = $reply->config;

					break;
				}

				// Save OTP configuration.
				$model->setOtpConfig($userId, $otpConfig);

				// Generate one time emergency passwords if required (depleted or not set)
				if (empty($otpConfig->otep))
				{
					$model->generateOteps($userId);
				}
			}
			else
			{
				$otpConfig->method = 'none';
				$otpConfig->config = array();
				$model->setOtpConfig($userId, $otpConfig);
			}

			// Unset the raw data
			unset($data['twofactor']);

			// Reload the user record with the updated OTP configuration
			$user->load($userId);
		}

		// Bind the data.
		if (!$user->bind($data))
		{
			$this->setError(JText::sprintf('COM_USERS_PROFILE_BIND_FAILED', $user->getError()));

			return false;
		}

		// Load the users plugin group.
		JPluginHelper::importPlugin('user');

		// Retrieve the user groups so they don't get overwritten
		unset($user->groups);
		$user->groups = JAccess::getGroupsByUser($user->id, false);

		// Store the data.
		if (!$user->save())
		{
			$this->setError($user->getError());

			return false;
		}

		$birthday	= null;
		if($data['birthday'])
		{
			$date = explode("-", $data['birthday']);
			$birthday =  $date[2] . "-" . $date[1] . "-" . $date[0];
		}

		$usuario = Usuario::getByUser($user->id, $this->getDbo());
		$usuario->setMatricula($data['registration']);
		$usuario->setNascimento($birthday);
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
		
		if(!$usuario->save())
		{
			$this->setError(JText::sprintf('COM_USERS_REGISTRATION_SAVE_FAILED', $usuario->getError()));

			return false;
    	}

		return $user->id;
	}

	/**
	 * Gets the configuration forms for all two-factor authentication methods
	 * in an array.
	 *
	 * @param   integer  $user_id  The user ID to load the forms for (optional)
	 *
	 * @return  array
	 *
	 * @since   3.2
	 */
	public function getTwofactorform($user_id = null)
	{
		$user_id = (!empty($user_id)) ? $user_id : (int) $this->getState('user.id');

		$model = new UsersModelUser;

		$otpConfig = $model->getOtpConfig($user_id);

		FOFPlatform::getInstance()->importPlugin('twofactorauth');

		return FOFPlatform::getInstance()->runPlugins('onUserTwofactorShowConfiguration', array($otpConfig, $user_id));
	}

	/**
	 * Returns the one time password (OTP) – a.k.a. two factor authentication –
	 * configuration for a particular user.
	 *
	 * @param   integer  $user_id  The numeric ID of the user
	 *
	 * @return  stdClass  An object holding the OTP configuration for this user
	 *
	 * @since   3.2
	 */
	public function getOtpConfig($user_id = null)
	{
		$user_id = (!empty($user_id)) ? $user_id : (int) $this->getState('user.id');

		$model = new UsersModelUser;

		return $model->getOtpConfig($user_id);
	}
}
