<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Activities extends Admin_Controller
{

	//--------------------------------------------------------------------

	/**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}//end __construct()

	//--------------------------------------------------------------------

	//--------------------------------------------------------------------
	// HMVC METHODS
	//--------------------------------------------------------------------

	/**
	 * Displays the Activities for a module
	 *
	 * @param string $module Name of the module
	 * @param int    $limit  The number of activities to return
	 *
	 * @return string Displays the activities
	 */
	public function activity_list($module=null, $limit=25)
	{
		if (empty($module))
		{
			logit('No module provided to `activity_list`.');
			return;
		}
		$this->load->helper('date');
		$activities = $this->activity_model->order_by('created_on', 'desc')->limit($limit,0)->find_by_module($module);

		$this->load->view('activity_list', array('activities' => $activities));
	}//end activity_list()

	//--------------------------------------------------------------------


}//end class
