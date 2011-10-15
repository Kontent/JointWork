<?php
/**
* JointWork - The Joomla Project Manager
* @package JointWork.Installer
* @copyright (C) 2011 Kontent Design. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* @link http://extensions.kontentdesign.com
*/
defined ( '_JEXEC' ) or die ();

class Com_JointworkInstallerScript {

	function install($parent) {}

	function update($parent) {}

	function uninstall($parent) {
		require_once JPATH_ADMINISTRATOR . '/components/com_jointwork/api.php';
	}

	function preflight($type, $parent) {}

	function postflight($type, $parent) {}
}
