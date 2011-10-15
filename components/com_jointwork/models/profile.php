<?php
/**
* JointWork - The Joomla Project Manager
* @package JointWork.Site
* @subpackage Models
* @copyright (C) 2011 Kontent Design. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* @link http://extensions.kontentdesign.com
*/
defined ( '_JEXEC' ) or die ();

/**
 * Profile Model.
 */
class JointworkModelProfile extends JModel {
	protected function populateState() {
		$id = $this->getInt ( 'id', 0 );
		$this->setState ( 'item.id', $id );

		$value = $this->getInt ( 'limit', 0 );
		if ($value < 1) $value = 5;
		$this->setState ( 'list.limit', $value );

		$value = $this->getInt ( 'limitstart', 0 );
		if ($value < 0) $value = 0;
		$this->setState ( 'list.start', $value );
	}
}
