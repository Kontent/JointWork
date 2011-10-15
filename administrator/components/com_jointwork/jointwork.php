<?php
/**
* JointWork - The Joomla Project Manager
* @package JointWork.Adminitrator
* @copyright (C) 2011 Kontent Design. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* @link http://extensions.kontentdesign.com
*/
defined ( '_JEXEC' ) or die ();

// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_jointwork')) {
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

// Include dependencies.
jimport('joomla.application.component.controller');
require_once JPATH_ADMINISTRATOR . '/components/com_jointwork/api.php';

// Initialize error handlers.
JointworkError::initialize ();

// Load and execute controller.
$controller = JController::getInstance('Jointwork');
$controller->execute(JRequest::getCmd('task'));
$controller->redirect();

// Cleanup error handlers.
JointworkError::cleanup ();
