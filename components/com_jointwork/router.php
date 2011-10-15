<?php
/**
* JointWork - The Joomla Project Manager
* @package JointWork.Site
* @copyright (C) 2011 Kontent Design. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* @link http://extensions.kontentdesign.com
*/
defined ( '_JEXEC' ) or die ();

require_once JPATH_ADMINISTRATOR . '/components/com_jointwork/api.php';

/**
 * Build SEF URL
 *
 * @param $query
 * @return segments
 */
function JointworkBuildRoute(&$query) {
	JOINTWORK_PROFILER ? JointworkProfiler::instance()->start('function '.__FUNCTION__.'()') : null;

	$segments = array ();

	JOINTWORK_PROFILER ? JointworkProfiler::instance()->stop('function '.__FUNCTION__.'()') : null;
	return $segments;
}

function JointworkParseRoute($segments) {
	$profiler = JProfiler::getInstance('Application');
	JOINTWORK_PROFILER ? $profiler->mark('kunenaRoute') : null;

	$vars = array();

	return $vars;
}
