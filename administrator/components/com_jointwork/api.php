<?php
/**
* JointWork - The Joomla Project Manager
* @package JointWork.Framework
* @copyright (C) 2011 Kontent Design. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* @link http://extensions.kontentdesign.com
*/
defined ( '_JEXEC' ) or die ();

if (defined ( 'JOINTWORK_LOADED' ))
	return;

// Manually enable code profiling by setting value to 1
define ( 'JOINTWORK_PROFILER', 0 );

// Component name amd database prefix
define ( 'JOINTWORK_COMPONENT_NAME', basename ( dirname ( __FILE__ ) ) );
define ( 'JOINTWORK_NAME', substr ( JOINTWORK_COMPONENT_NAME, 4 ) );

// Component location
define ( 'JOINTWORK_COMPONENT_LOCATION', basename ( dirname ( dirname ( __FILE__ ) ) ) );

// Component paths
define ( 'JOINTWORK_PATH_RELATIVE', JOINTWORK_COMPONENT_LOCATION . '/' . JOINTWORK_COMPONENT_NAME );
define ( 'JOINTWORK_PATH_SITE', JPATH_ROOT .'/'. JOINTWORK_PATH_RELATIVE );
define ( 'JOINTWORK_PATH_ADMIN', JPATH_ADMINISTRATOR .'/'. JOINTWORK_PATH_RELATIVE );
define ( 'JOINTWORK_PATH_MEDIA', JPATH_ROOT .'/media/'. JOINTWORK_NAME );

// Register Joomla and Jointwork autoloader
if (function_exists('__autoload')) spl_autoload_register('__autoload');
spl_autoload_register('JointworkAutoload');

// Give access to all Jointwork tables
jimport('joomla.database.table');
JTable::addIncludePath(JOINTWORK_PATH_ADMIN.'/libraries/tables');
// Give access to all JHTML functions
jimport('joomla.html.html');
JHTML::addIncludePath(JOINTWORK_PATH_ADMIN.'/libraries/html');

/**
 * Jointwork auto loader
 *
 * @param string $class Class to be registered (case sensitive)
 */
function JointworkAutoload($class) {
	if (substr($class, 0, 9) != 'Jointwork') return;
	$file = JOINTWORK_PATH_ADMIN . '/libraries' . strtolower(preg_replace( '/([A-Z])/', '/\\1', substr($class, 9)));
	if (is_dir($file)) {
		$file .= '/'.array_pop( explode( '/', $file ) );
	}
	$file .= '.php';
	if (file_exists($file)) {
		require_once $file;
	}
}

// Jointwork has been initialized
define ( 'JOINTWORK_LOADED', 1 );
