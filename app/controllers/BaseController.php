<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
        var $data = array();
        var $session = array();
        
        public function __construct(){   
            
	} 
	protected function setupLayout()
	{
            if ( ! is_null($this->layout))
            {
                $this->layout = View::make($this->layout);
            }
	}
        protected function getSession()
	{
            if(Session::get('userdata')){
                $session["userdata"]= Session::get('userdata');
                $session["is_login"]= Session::get('is_login');
                return $session;
            }
        }
        
        protected function checkSession()
	{
            $session = $this->getSession();
            if($session["is_login"] == true)
            {
                return true;
            }
            else{
                return false;
            }
        }
        
        
}
