<?php
/**
 * A base controller for CodeIgniter with view autoloading, layout support,
 * model loading, asides/partials and per-controller 404
 *
 * @link http://github.com/jamierumbelow/codeigniter-base-controller
 * @copyright Copyright (c) 2012, Jamie Rumbelow <http://jamierumbelow.net>
 */

/**HMVC CODE STUFF*
* load the MX_Controller class*/

//require APPPATH."third_party/MX/Controller.php";

/**END HMVC CODE STUFF*/

class MY_Controller extends CI_Controller
{    

    /* --------------------------------------------------------------
     * SIMER v2.0 VARIABLES
     * ------------------------------------------------------------ */

    /*Holds the  user object once there's a valid session
    */
    public $user_details; 
    public $user_id;

    /**
    *Holds response for json requests
    */
    public $response;

    /* --------------------------------------------------------------
     * END SIMER VARIABLES
     * ------------------------------------------------------------ */

    /* --------------------------------------------------------------
     * VARIABLES
     * ------------------------------------------------------------ */

    /**
     * The current request's view. Automatically guessed 
     * from the name of the controller and action
     */
    protected $view = '';
    
    /**
     * An array of variables to be passed through to the 
     * view, layout and any asides
     */
    protected $data = array();
    
    /**
     * The name of the layout to wrap around the view.
     */
    protected $layout;
    
    /**
     * An arbitrary list of asides/partials to be loaded into
     * the layout. The key is the declared name, the value the file
     */
    protected $asides = array();
    
    /**
     * A list of models to be autoloaded
     */
    //protected $models = array('location','request','service','servicecategory','serviceprovider','state','transaction','user');
    protected $models = array('user');
    /**
     * A formatting string for the model autoloading feature.
     * The percent symbol (%) will be replaced with the model name.
     */
    protected $model_string = '%_model';
    
    /* --------------------------------------------------------------
     * GENERIC METHODS
     * ------------------------------------------------------------ */
    
    /**
     * Initialise the controller, tie into the CodeIgniter superobject
     * and try to autoload the models
     */
    public function __construct()
    {
        parent::__construct();

        $this->_load_models();        

        $this->_enforcer();   

        $this->_load_assets();  
                
        //$this->output->enable_profiler(true);
    }


    /* --------------------------------------------------------------
     * VIEW RENDERING
     * ------------------------------------------------------------ */
        
    /**
     * Override CodeIgniter's despatch mechanism and route the request
     * through to the appropriate action. Support custom 404 methods and
     * autoload the view into the layout.
     */
    public function _remap($method)
    {
        if (method_exists($this, $method))
        {
            call_user_func_array(array($this, $method), array_slice($this->uri->rsegments, 2));
        }
        else
        {
            if (method_exists($this, '_404'))
            {
                call_user_func_array(array($this, '_404'), array($method));
            }
            else
            {
                show_404(strtolower(get_class($this)).'/'.$method);
            }
        }
        
        $this->_load_view();
    }
    /**
     * A helper method to check if a request has been
     * made through XMLHttpRequest (AJAX) or not 
     *
     * @return bool
     * @author Jamie Rumbelow
     */
    protected function _is_ajax() {
        return ($this->input->server('HTTP_X_REQUESTED_WITH') == 'XMLHttpRequest') ? TRUE : FALSE;
    }
    
    protected function _is_json() {
        return strstr($this->input->get_request_header("Accept",TRUE),"json");
    }
    
    /**
     * Automatically load the view, allowing the developer to override if
     * he or she wishes, otherwise being conventional.
     */
    protected function _load_view()
    {

        if($this->_is_ajax())
        {
            $this->layout = FALSE;       
            if($this->_is_json())
            {                 
                $this->view = false;
                //$this->output->set_content_type('application/json')->set_output($this->response);
            }
        }
        
        // If $this->view == FALSE, we don't want to load anything
        if ($this->view !== FALSE)
        {
            // If $this->view isn't empty, load it. If it isn't, try and guess based on the controller and action name
            $view = (!empty($this->view)) ? $this->view : $this->router->directory . $this->router->class . '/' . $this->router->method;
            
            // Load the view into $yield
            $data['yield'] = $this->load->view($view, $this->data, TRUE);
            
            // Do we have any asides? Load them.
            if (!empty($this->asides))
            {
                foreach ($this->asides as $name => $file)
                {
                    $data['yield_'.$name] = $this->load->view($file, $this->data, TRUE);
                }
            }
            
            // Load in our existing data with the asides and view
            $data = array_merge($this->data, $data);
            $layout = FALSE;

            // If we didn't specify the layout, try to guess it
            if (!isset($this->layout))
            {
                if (file_exists(APPPATH . 'views/layouts/' . $this->router->class . '.php'))
                {
                    $layout = 'layouts/' . $this->router->class;
                } 
                else
                {
                    $layout = 'layouts/application';
                }
            }

            // If we did, use it
            else if ($this->layout !== FALSE)
            {
                $layout = $this->layout;
            }

            // If $layout is FALSE, we're not interested in loading a layout, so output the view directly
            if ($layout == FALSE)
            {
                $this->output->set_output($data['yield']);
            }

            // Otherwise? Load away :)
            else
            {
                $this->load->view($layout, $data);
            }
        }
    }

    /* --------------------------------------------------------------
     * MODEL LOADING
     * ------------------------------------------------------------ */
    
    /**
     * Load models based on the $this->models array
     */
    private function _load_models()
    {
        foreach ($this->models as $model)
        {
            $this->load->model($this->_model_name($model), $model);
        }
    }
    
    /**
     * Returns the loadable model name based on
     * the model formatting string
     */
    protected function _model_name($model)
    {
        return str_replace('%', $model, $this->model_string);
    }

    public function _validate_input($string) {
        $value = '(\s)?[A-Z]+((\s|-)?[A-Z]+)*(\s)?';
        $match = "~^$value$~i";
        if(preg_match($match, $string)) {
            return true;
        } else {
            return false;
        }
    }

    /* --------------------------------------------------------------
     * SIMER FUNCTIONALITY
     * --------------------------------------------------------------*/

    /**
     * Loads all the necessary assets for the project
     */
    private function _load_assets()
    {
        //set default page title
        $this->data['title'] = "";

        $this->data['base'] = $this->config->item("base_url");
        
        if(count($this->config->item('assets')) > 1):
            foreach($this->config->item('assets') as $asset_name => $location):            
                $this->data[$asset_name] = base_url($location);
            endforeach;
        endif;

        //load Simer variables
        if($user_details = $this->session->userdata('user_details')):

            //then user is logged in
            $this->user_details = $user_details;
            $this->user_id = $user_details->id;
            $this->data['user_details'] =$user_details;//setup user details globally for views
            $this->data['custom_nav'] = $this->build_nav();

        endif;
    }

    /**
    *Is logged In
    *Check if a user is logged in
    *@param null
    *@return bool
    */
    public function is_logged_in()
    {
        $is_logged_in = (bool)$this->session->userdata('user_details');
        
        //$is_logged_in = false;
        $controller = $this->uri->segment(1);
        $method = $this->uri->segment(2);

        $uri = $controller.'/'.$method;

        if($this->_is_json() && $uri === 'welcome/is_logged_in'):
            $this->output->set_content_type('application/json')->set_output(json_encode(['uri'=>$uri,'is_true'=>$is_logged_in]));
        else:
            return $is_logged_in;
        endif;
    }

    /**
    *Enforcer
    *define rules to be enforced here
    *@param null
    *@return null
    */
    public function _enforcer()
    {
        //1. Enforce restrictions on controllers that reqiures a user to be logged in
            //a. Define exceptions to which the user does not have to be logged in to access

        $exceptions = array('welcome','login','migration','logout','verify_account','');

            //b. Obtain the controller from the uri segment
        $controller = $this->uri->segment(1);
       
        if(!$this->is_logged_in() && !in_array(trim($controller), $exceptions)):        
            
            $this->message->set('error','You need to login first.');
            simer_redirect('login');                   

        endif;     
    }

    /**
    *Notify User
    *@param user_id
    *@param type
    */
    public function notify($user_id,$type)
    {

    }

    /**
    *Upload function
    *Used by dropzone
    */
    public function upload_img()
    {
        if(!is_dir('./uploads/groups'))mkdir(('./uploads/groups'));      
        if (!empty($_FILES)) 
        {        
            $tempFile = $_FILES['file']['tmp_name'];        

            $file_info = explode('.',$_FILES['file']['name']);
            $file_ext = $file_info[1];

            $targetPath = './uploads/groups';  

            $newFile = time().'.'.$file_ext;
             
            $targetFile =  $targetPath.$newFile; 
         
            move_uploaded_file($tempFile,$targetFile); 

            $this->output->set_output(json_encode($newFile));
        }
    }

    /**
    *Build user navigation
    *based on role
    */
    protected function build_nav()
    {
        //$this->view = false;
        $this->load->model('privilege_model','nav');

        $roles = $this->user->get_roles($this->user_id);
        $nav_links = $this->nav->get($roles);                

        $this->load->config('nav_icons');
        $nav_icons = $this->config->item('icons');
        $result = '<ul id="nav">';   
        
        //loop over returned top level navs
        foreach($nav_links as $nav_link):

            if($nav_link->name == "school-logo"):

                if(!$this->user_details->is_parent): //parent can belong to multiple schools

                    $result .= '<li class="'.$nav_link->name.'">'.
                                    anchor('schools/profile/1', img(base_url('assets/imgs/xlogo.jpg')))
                                .'</li>';    

                endif;// only add school logo if not a regular user
            else:
                
                //Preferential nav load
                $result .= '<li class="'.$nav_link->name.'">'.
                                anchor($nav_link->controller.'/'.$nav_link->method, ' ', array('class' => $nav_icons[$nav_link->name]))
                            .''.
                                anchor($nav_link->controller.'/'.$nav_link->method, ucfirst($nav_link->name))
                            .'</li>';                   
                //End preferential nav load                 

            endif;
        endforeach;

        $result .= '</ul>';
        return $result;
    }

    /* -------------------------------------------------------------
     * END SIMER FUNCTIONALITY
     * -------------------------------------------------------------*/
}
