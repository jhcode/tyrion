<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

/**********************************
*	School Model
*	Handles most database calls to the
*	Schools table.
*	@ver Simer2.0
*	@author bourgeois247
* 	Copyright (c) 2014
*/

class School_model extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/**
    *Just check db if school name is unique
    */
    public function is_unique_school($school)
    {         
        return !(bool)$this->get_by(array('name'=>$school));
    }

    /**
    *Create Tables
    *Cruch tables for a new school
    *@param school_id (int)
    */
    public function create($school_id)
    {
        //load dbforge class 
        $this->load->dbforge();

        //get table data
        $this->config->load('school_tables');
        $tables = $this->config->item('tables');
        
        //loop over table data
        foreach($tables as $table=>$fields):

            $this->dbforge->add_field($fields);
            $this->dbforge->add_key("id",true);
            $this->dbforge->create_table($school_id.'_'.$table, true);
           
        endforeach;
    }
}
/* End of file Users.php*/
/* Location: ./application/models/school_model.php*/