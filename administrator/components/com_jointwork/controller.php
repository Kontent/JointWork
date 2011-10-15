<?php
/**
* JointWork - The Joomla Project Manager
* @package JointWork.Administrator
* @copyright (C) 2011 Kontent Design. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* @link http://extensions.kontentdesign.com
*/
defined('_JEXEC') or die;

jimport('joomla.application.component.controller');

/**
 * JointWork Controller.
 */
class JointworkController extends JController {
	/**
	 * @var		string	The default view.
	 */
	protected $default_view = 'dashboard';

	/**
	 * Constructor.
	 */
	function __construct($config = array()) {
		JOINTWORK_PROFILER ? $this->profiler = JointworkProfiler::instance() : null;

		parent::__construct($config);
	}

	/**
	 * Method to display a view.
	 *
	 * @param	boolean			If true, the view output will be cached
	 * @param	array			An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
	 *
	 * @return	JController		This object to support chaining.
	 */
	public function display($cachable = false, $urlparams = false) {
		JOINTWORK_PROFILER ? $this->profiler->mark('beforeDisplay') : null;
		JOINTWORK_PROFILER ? JointworkProfiler::instance()->start('function '.__CLASS__.'::'.__FUNCTION__.'()') : null;

		parent::display($cachable, $urlparams);

		JOINTWORK_PROFILER ? JointworkProfiler::instance()->stop('function '.__CLASS__.'::'.__FUNCTION__.'()') : null;

		return $this;
	}

	public function setRedirectBack($fragment = '') {
		$httpReferer = JRequest::getVar ( 'HTTP_REFERER', JURI::base ( true ), 'server' );
		$this->setRedirect ( $httpReferer.($fragment ? '#'.$fragment : '') );
	}
}