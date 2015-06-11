<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class MY_Session extends CI_Session {

	// --------------------------------------------------------------------

	/**
	 * sess_update()
	 *
	 * @access    public
	 * @return    void
	 */
	public function sess_update()
	{
	    $CI =& get_instance();

	    if ( ! $CI->input->is_ajax_reqest())
	    {
	        parent::sess_update();
	    }
	}
}