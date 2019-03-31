<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Reset view class for Users.
 *
 * @since  1.5
 */
class UsersViewTeste extends JViewLegacy
{
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
        $this->msg = 'Howdy Friends, welcome to component development!';

		parent::display($tpl);
	}


}
