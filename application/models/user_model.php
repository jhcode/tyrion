<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

/**********************************
*	User Model
*	H&&les most database calls to the
*	Users table.
*	@ver Simer2.0
*	@author bourgeois247
* 	Copyright (c) 2014
*/
class User_model extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/**
    *Just check db if email is unique
    */
    public function is_unique_email($email = false)
    {   
        if(!(bool)$email)
        {
            return false;
        }       
        return !(bool)$this->get_by(array('email'=>$email));
    }


    /**
    *Get users based onn serach criteria
    *
    */
    public function get_searched_users($where,$like)
    {       

        $this->db->like(['firstname'=>$like]);
        $this->db->or_like(['lastname'=>$like]);
        $this->db->where($where);

        return $this->db->get($this->_table)->result();
    }

    /**
    *Is_regular
    *evaluates if a user is a regular user
    */
    public function is_regular($user)
    {
        if(is_string($user))
            $user = $this->get($user_id);

        $crunch  = !$user->is_sadmin && !$user->is_admin && 
                   !$user->is_teacher && !$user->is_student &&
                   !$user->is_parent && !$user->is_manager && !$user->is_bursar;
                
        if($crunch)
            return true;

        return false;
    }

    /**
    *Get User Roles
    *Collates all roles of the user
    */
    public function get_roles($user_id)
    {           
        $user = $this->get($user_id);       

        $roles =    [
                        'is_parent'=>$user->is_parent,
                        'is_teacher'=>$user->is_teacher,
                        'is_bursar'=>$user->is_bursar,
                        'is_student'=>$user->is_student,
                        'is_manager'=>$user->is_manager,
                        'is_admin'=>$user->is_admin,
                        'is_sadmin'=>$user->is_sadmin,
                        'is_regular'=>(int)$this->is_regular($user)
                    ];

        //get roles for user
        foreach ($roles as $key=>$val):
            
            if(!$val):
                unset($roles[$key]);
            endif;

        endforeach;

        return $roles;
    }
}
/* End of file Users.php*/
/* Location: ./application/models/users_model.php*/