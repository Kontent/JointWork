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
	 * View method for MVC based architecture
	 *
	 * @param   boolean  $cachable   If true, the view output will be cached
	 * @param   array    $urlparams  An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
	 *
	 * @return  JController  A JController object to support chaining.
	 * @since   11.1
	 */
	public function display($cachable = false, $urlparams = false)
	{
		JOINTWORK_PROFILER ? $this->profiler->mark('beforeDisplay') : null;
		JOINTWORK_PROFILER ? JointworkProfiler::instance()->start('function '.__CLASS__.'::'.__FUNCTION__.'()') : null;

		$document	= JFactory::getDocument();
		$viewType	= $document->getType();
		$viewName	= JRequest::getCmd('view', $this->default_view);
		$viewLayout	= JRequest::getCmd('layout', 'default');

		$config = array(
			'base_path' => $this->basePath,
			'template_path' => JOINTWORK_PATH_MEDIA."/templates/default/html/{$viewName}"
		);

		$view = $this->getView($viewName, $viewType, '', $config);

		// Get/Create the model
		$model = $this->getModel($viewName);
		if ($model) {
			// Push the model into the view (as default)
			$view->setModel($model, true);
		}

		// Set the layout
		$view->setLayout($viewLayout);

		$view->assignRef('document', $document);

		$conf = JFactory::getConfig();

		// Display the view
		if ($cachable && $viewType != 'feed' && $conf->get('caching') >= 1) {
			$option	= JRequest::getCmd('option');
			$cache	= JFactory::getCache($option, 'view');

			if (is_array($urlparams)) {
				$app = JFactory::getApplication();

				$registeredurlparams = $app->get('registeredurlparams');

				if (empty($registeredurlparams)) {
					$registeredurlparams = new stdClass;
				}

				foreach ($urlparams AS $key => $value)
				{
					// Add your safe url parameters with variable type as value {@see JFilterInput::clean()}.
					$registeredurlparams->$key = $value;
				}

				$app->set('registeredurlparams', $registeredurlparams);
			}

			$cache->get($view, 'display');

		}
		else {
			$view->display();
		}

		JOINTWORK_PROFILER ? JointworkProfiler::instance()->stop('function '.__CLASS__.'::'.__FUNCTION__.'()') : null;

		return $this;
	}

	public function setRedirectBack($fragment = '') {
		$httpReferer = JRequest::getVar ( 'HTTP_REFERER', JURI::base ( true ), 'server' );
		$this->setRedirect ( $httpReferer.($fragment ? '#'.$fragment : '') );
	}
}