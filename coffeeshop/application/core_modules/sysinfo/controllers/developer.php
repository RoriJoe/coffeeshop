<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Developer extends Admin_Controller
{

	/**
	 * Loads required classes
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();

		// restrict access - View
		$this->auth->restrict('Coffeeshop.Sysinfo.View');

		$this->lang->load('sysinfo');

		Template::set('toolbar_title', lang('si.system_info'));

		Template::set_block('sub_nav', 'developer/_sub_nav');

	}//end __construct()

	//--------------------------------------------------------------------

	/**
	 * Display the system information, including Coffeeshop and PHP versions,
	 * to the user
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function index()
	{
		Template::render();

	}//end index()

	//--------------------------------------------------------------------

	/**
	 * Display the list of modules in the Coffeeshop installation
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function modules()
	{
		$modules = module_list();
		$configs = array();

		foreach ($modules as $module)
		{
			$configs[$module] = module_config($module);

			if (!isset($configs[$module]['name']))
			{
				$configs[$module]['name'] = ucwords($module);
			}
		}

		ksort($configs);
		Template::set('modules', $configs);

		Template::render();

	}//end modules()

	//--------------------------------------------------------------------

	/**
	 * Display the PHP info settings to the user
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function php_info()
	{
		ob_start();

		phpinfo();

		$buffer = ob_get_contents();

		ob_end_clean();

		$output = (preg_match("/<body.*?".">(.*)<\/body>/is", $buffer, $match)) ? $match['1'] : $buffer;
		$output = preg_replace("/<a href=\"http:\/\/www.php.net\/\">.*?<\/a>/", "", $output);
		$output = preg_replace("/<a href=\"http:\/\/www.zend.com\/\">.*?<\/a>/", "", $output);
		$output = preg_replace("/<h2 align=\"center\">PHP License<\/h2>.*?<\/table>/si", "", $output);
		$output = preg_replace("/<h2>PHP License.*?<\/table>/is", "", $output);
		$output = preg_replace("/<table(.*?)bgcolor=\".*?\">/", "\n\n<table\\1>", $output);
		$output = preg_replace("/<table(.*?)>/", "\n\n<table\\1 class=\"table table-striped\" cellspacing=\"0\">", $output);
		$output = preg_replace("/<a.*?<\/a>/", "", $output);
		$output = preg_replace("/<th(.*?)>/", "<th \\1 >", $output);
		$output = preg_replace("/<hr.*?>/", "<br />", $output);
		$output = preg_replace("/<tr(.*?).*?".">/", "<tr \\1>\n", $output);
		$output = preg_replace('/<h(1|2)\s*(class="p")?/i', '<h\\1', $output);

		Template::set('phpinfo', $output);

		Template::render();

	}//end php_info()

	//--------------------------------------------------------------------

}//end Developer