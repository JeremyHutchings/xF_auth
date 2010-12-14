<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
* xf_auth
*
* Authentication library for xenForo
*  
*/
class Xf_auth 
{
	/**
	 * The path to the xenForo install
	 * 
	 * @var string
	 */
	private $fileDir = '';

	
	/**
	 * The base URL to xenForo 
	 * 
	 * @var string
	 */
	private $forumUrl = '';

	
	/**
	 * The xFUser instance
	 */
	private $xfUser = null;
	

	/**
	 * The Codeigniter Instance
	 */
	private $cI;
	
	
	/**
	 * Get the CodeIngiter Instance, load up the config
	 * and then try to auth a session with xF to see
	 * if there is one.
	 * 
	 */
	function __construct()  
	{
		$cI =& get_instance();
		
		// Load up and init the config
		$cI->config->load('xf_auth');
        
        $config = $cI->config->item('xfAuth');

        
		$this->fileDir  = $config['fileDir'];
		$this->forumUrl = $config['forumUrl'];

		$this->authenticateSession();
		
		// DO we need this here ?
		#$this->set_userinfo($this->default_user);
	}

	
	/**
	* Uses the XenForo_Autoloader to initialize and startPublicSession to get
	* and instance of the Visitor, if there is one. 
	*
	* @return int
	*/
	function authenticateSession()
	{
		/**
		 * Get the xenForo Autoloader
		 */
		if (is_dir($this->fileDir))
		{
			require ($this->fileDir . '/library/XenForo/Autoloader.php');
			XenForo_Autoloader::getInstance()->setupAutoloader($this->fileDir . '/library');
	
			/**
			 * initialize
			 */
			XenForo_Application::initialize($this->fileDir . '/library', $this->fileDir);
	
			XenForo_Session::startPublicSession();
			
			$this->xfUser = XenForo_Visitor::getInstance();
			
			return $this->xfUser->getUserId();
		}
		die('no path');
		// TODO: CI error log
		return false;
	}

	
	/**
	 * Wrapper function to get User Id.
	 * 
	 * @return int 
	 */
	public function getUserId()
	{
		return $this->xfUser->getUserId();
	}
	

	/**
	* Checks if the current user is logged in to xenForo
	*
	* @return boolean
	*/
	public function isLoggedIn()
    {
        return (bool)$this->xfUser->getUserId();
    }
    
	/**
	* Checks if the current user is a xF super administrator
	*
	* @return bool
	*/
	public function isSuperAdmin()
    {
    	return $user->isSuperAdmin();
    }
    
    
    /**
     * Wrapper function for xF Visitor instance
     */
	public function get($name)
	{
		return $this->xfUser->get($name);
	}
}