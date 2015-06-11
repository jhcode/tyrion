<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *An HMVC Adapter class for the wiredesignz HMVC Module v5.4
 *To use the modular xtensions functionality from within a controller, 
 *That controller needs to extend the MX_Controller itself,
 *This prevents the use of other Base classes.
 *
 *This adapter acts as the middle man, as it extends MX_Controller
 *and can be called from within controllers that dont themselves extend MX_Controller
 *
 * @author @bourgeois247 
 * @package Simer v2.0 
 * @category
 * @version 1.0
 */

class Hmvc extends MX_Controller 
{
    public function test_adapt()
    {
    	return Modules::run('notifications');
    }

    public function test_load()
    {
    	$this->load->module('notifications');
    	return $this->notifications;
    }
}