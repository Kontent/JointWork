<?php
/**
* JointWork - The Joomla Project Manager
* @package JointWork.Site
* @copyright (C) 2011 Kontent Design. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* @link http://extensions.kontentdesign.com
*/
defined ( '_JEXEC' ) or die ();

// Include dependencies
jimport('joomla.application.component.controller');
require_once JPATH_ADMINISTRATOR . '/components/com_jointwork/api.php';

// Display time it took to create the entire page in the footer.
$jointwork_profiler = JointworkProfiler::instance('Jointwork');
$jointwork_profiler->start('Total Time');
JOINTWORK_PROFILER ? $jointwork_profiler->mark('afterLoad') : null;

// Initialize error handlers.
JointworkError::initialize ();

// Load and execute controller.
$controller = JController::getInstance('Jointwork');
$controller->execute(JRequest::getCmd('task'));
$controller->redirect();

// Cleanup error handlers.
JointworkError::cleanup ();

// Display profiler information.
$kunena_time = $jointwork_profiler->stop('Total Time');
if (JOINTWORK_PROFILER) {
	echo '<div class="jw-profiler">';
	echo "<h3>JointWork Profile Information</h3>";
	foreach($jointwork_profiler->getAll() as $item) {
		if ($item->getTotalTime()<0.002 && $item->calls < 20) continue;
		echo sprintf ("Kunena %s: %0.3f / %0.3f seconds (%d calls)<br/>", $item->name, $item->getInternalTime(), $item->getTotalTime(), $item->calls);
	}
	echo '</div>';
}
