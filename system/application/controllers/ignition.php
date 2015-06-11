<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Ignition for codeigniter
 *
 * A CLI tool for rapid bootstrapping in CI
 *
 * @package		CodeIgniter
 * @author		KesAkp <@bourgeois247> 
 * @since		CodeIgniter Version 2.1.3
 * @link 		http://twitter.com/bourgeois247
 */
class Ignition extends MY_Controller
{
	
	public function __construct($name = "")
	{
		parent::__construct();

		if(!$this->input->is_cli_request()):
			exit('Cli Interface Only');
		endif;
		
		$this->view = false;
	}
	/**
	 * Ignition index 
	 * redirect to starter
	 *	 
	 * @return 	void
	 */
	public function index($name="")
	{	
		$this->start($name);
	}

	/**
	 * Ignition start to create a new project
	 *
	 * @param 	string 		$name
	 * @return 	void
	 */
	public function start($name = "")
	{		
		if($name == ""):
			$name = "New_Ignition_".date('Y-m-d',time());		
		endif;

		//check if there is an existing directory
		if(is_dir('../'.$name)):
			
			echo "Project Already Exists!".PHP_EOL;
			echo "Ignition turned off";

		//create PROJECT if not exists
		else:			
			if(mkdir('../'.$name)):
				echo "Creating your project '".$name."'".PHP_EOL;

			//get the full file path in the ignition directory to copy into the new directory
			foreach(get_filenames('./',true) as $file):
												
				$file_info = get_file_info($file);
				echo PHP_EOL."Creating the ".str_replace('ignition',$name,$file_info['server_path'])." file".PHP_EOL;	

				//create dirs if they dont exist						
				$dir = str_replace(array('\\'.$file_info['name'],'ignition'), array('',$name), $file_info['server_path']);			
			
				if(!is_dir($dir)):
					mkdir($dir,0,true);
				endif;

				//actual file write	
				if($file_info['name'] === "ignition.php"):
					write_file('../'.$name.'/application/controllers/ignition.php',read_file($file));
				elseif($file_info['name'] === "routes.php"):
					write_file('../'.$name.'/application/config/routes.php',str_replace('ignition',
						$name,read_file($file)));
				else:
					write_file(str_replace('ignition',$name,$file_info['server_path']),read_file($file));
				endif;

			endforeach;

				echo PHP_EOL."Done!";
				echo PHP_EOL."Successfully created your project '".$name."'.".PHP_EOL;
				echo PHP_EOL."<Note:> You have to cd(change directory) to '".$name."' so your subsequent commands can reflect in your
				new project, otherwise, they will be relative to the Ignition directory.".PHP_EOL;
				
				$this->ignite($name,'c',$name);
			else:
				echo "There was a problem creating your project";
			endif;
		endif;
	}

	/**
	 * Ignition create to create a new bare, cont, model or view
	 *
	 * @param 	string 		$type
	 * @return 	void
	 */
	public function ignite()
	{		
		$working_dir="guess";$type = 'c';$name="";
		$defaults = array('working_dir','type','name');

		//allow for easier calling with variable args
		$args = func_get_args();

		if(count($args) == 3):

			$working_dir = $args[0];$type = $args[1];$name=$args[2];
			
		elseif(count($args) == 2):

			$type = $args[0];$name=$args[1];
		
		else:

			exit('Invalid Arguments');
		endif;

		//resolve working dir
		if($working_dir == "guess"):

			$working_dir = getcwd();
		else:

			$working_dir = dirname(getcwd()).'\\'.$working_dir;
		endif;

		//make sure directory is valid
		if(!is_dir($working_dir))exit('Invalid Project Name');

		if($name == ""):
			$name = $working_dir;		
		endif;

		$filename = strtolower($name);
		$name =  ucfirst($filename);

		switch ($type) 
		{
			case 'c':
				write_file($working_dir.'/application/controllers/'.$filename.'.php',
					'<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");'.PHP_EOL.PHP_EOL.
						'class '.$name.' extends MY_Controller'.PHP_EOL.'{'.
							PHP_EOL."\tpublic function __construct()".
								PHP_EOL."\t{".
									PHP_EOL.
									"\t\tparent::__construct();".
								PHP_EOL."\t}".							
								PHP_EOL."\tpublic function index()".
								PHP_EOL."\t{".
									PHP_EOL.									
								PHP_EOL."\t}".
							PHP_EOL.'}'.
							PHP_EOL.
						'/* End of file '.$name.'*/'.PHP_EOL.'/* Location: ./application/controllers/'.$filename.'.php*/'
						);
				echo $name." controller has been created succesfully";
				break;
			case 'm':
				write_file($working_dir.'/application/models/'.$filename.'_model.php',
					'<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");'.PHP_EOL.

						PHP_EOL.'class '.$name.'_model extends MY_Model'.PHP_EOL.'{'.
							PHP_EOL."\tpublic function __construct()".PHP_EOL."\t{".
								PHP_EOL."\t\tparent::__construct();".
							PHP_EOL."\t}".
						PHP_EOL.'}'.
						PHP_EOL.
						'/* End of file '.$name.'*/'.PHP_EOL.'/* Location: ./application/models/'.$filename.'_model.php*/');
				echo $name." model has been created succesfully";
				break;
			case 'v':
				
				$sub_dirs = explode('-',$name);
				
				if(count($sub_dirs) > 1): //there are subdirectory creation requests

					$link = $working_dir.'/application/views/';
					foreach ($sub_dirs as $count=>$dir):						

						if($count == count($sub_dirs)-1):
							$name = str_replace('-','/',$name);
							break;
						else:
							$link .= '/'.$dir;		
						endif;
					endforeach;

					//ensure the folder dosent already exist
					if(!is_dir($link)):
						mkdir($link,0,true);//recursive creation
					endif;

				endif;
				write_file($working_dir.'/application/views/'.$name.'.php','<?=echo validation_errors()?>');
					
				echo $name." view has been created succesfully";
				break;
			case 'f':
				//create form from table

				if(!$this->db->table_exists($name)):					
					exit("Invalid table name");
				endif;	

				$fields = $this->db->field_data($name);			

				//get the settings for different field types
				$config = $this->config->item('auto_form');

				$form_data = '<?='."\t".'form_open(<!--Script to submit to-->,array("class"=>"'.$config['form_class'].'"));?>'.PHP_EOL;
				foreach ($fields as $field):
					
					if((bool)$field->primary_key)continue;

					if(strtolower($field->type) === "int"):

						$form_data .= PHP_EOL."\t".'<?=form_input(array("name"=>"'.$field->name.'","type"=>"number","class"=>"'.$config['number_input_class'].'"));?>.'.PHP_EOL;
					
					elseif(strtolower($field->type) === "tinyint"):

						$form_data .= PHP_EOL."\t".'<?=form_dropdown("'.$field->name.'",array("1"=>"Yes","0"=>"No"),"1","'.$config['select_input_class'].'"));?>'.PHP_EOL;
					
					elseif(strtolower($field->type) === "datetime" || strtolower($field->type) === "date"):

						$form_data .= PHP_EOL."\t".'<?=form_input(array("name"=>"'.$field->name.'","type"=>"date","class"=>"'.$config['date_input_class'].'"));?>'.PHP_EOL;
					
					else:

						$form_data .= PHP_EOL."\t".'<?=form_input(array("name"=>"'.$field->name.'","type"=>"text","class"=>"'.$config['text_input_class'].'"));?>'.PHP_EOL;
					endif;

				endforeach;
				$form_data .= PHP_EOL.'<?=form_close();'."?>";
			
				//write the view to file
				write_file($working_dir.'\\application\views\\'.$filename.'.php',$form_data);
				echo "Successfully created a view file from table ".$name;
				break;
			default:
				echo "No such option.".PHP_EOL."Use c for new controller, m for new model and v for new view".PHP_EOL.
				"Usage: [project_name(optional)] [c|m|v(use the '-' to indicate subdirectory)] [name(optional)]";
				break;
		}
	}

	/**
	 * Ignition cwd
	 * helper to change current working directory
	 *
	 * @param 	string 		$type
	 * @return 	void
	 */
	public function cwd($dest)
	{
		echo "cd c:\\xampp\\htdocs\\$dest".PHP_EOL;
		shell_exec("cd c:\\xampp\\htdocs\\$dest");
		echo 'Working dir changed succesfully';
	}

	/** 
	 *Ignition crank
	 *
	 *creates specified table with associated model
	 * @access public
	 * @param 	string 	$direction
	 * @param 	string 	$table name
	 * @param 	string 	$table colunms with corresponding properties
	 *					eg id:int name:string created:date
	 * @return 	void
	 */
	public function crank()
	{
		$args = func_get_args();

		if(sizeof($args) !== 0):
		
		$direction = isset($args[0]) ? $args[0] : "";
		$tbl_name = isset($args[1]) ? $args[1] : "";
		$cols = isset($args[2]) ? $args[2] : "";

		if($direction === "up"):
			
			if($tbl_name === "")exit('Specify a table name');
			if($cols === "")exit('Specify at least one column');

			//create model
			$this->ignite('m',singular($tbl_name));

			//create colunms
			
			if(!stristr($cols,','))exit('Invalid colunm listings');					
			$cols = explode(',',$cols);

			//process cols and properties
			$fields = "";$types = array('int','string','date','datetime');$cont = array();
			echo PHP_EOL."Column Summary:".PHP_EOL;

			//load dbforge class to do manual table creation, migratiions not working for some reason
			$this->load->dbforge();
			
			foreach ($cols as $key => $col):

				echo "Column Number ".$key.PHP_EOL;
				print_r(explode(':',$col));

				list($name,$type) = explode(':',$col);

				$name = trim($name);$col = trim($col);
				if(!in_array($type,$types))exit("Invalid colunnm \"$type\"");
				$type = str_replace('string','TEXT', $type);

				//auto add the id field
				if($name === "id")continue;
				if($key == 0):
					$fields .= "\t\t\tarray(".PHP_EOL.'"id"=>array("type"=>"int",
												  "auto_increment"=>TRUE),'.PHP_EOL;
					
				endif;				

				if($key !== sizeof($cols)-1):
					$fields .= "\t\t\t\"".$name.'"=>array("type"=>"'.$type.'"),'.PHP_EOL;
					$cont[$name] = array("type"=>$type);
				//is last entry
				else:
					$fields .= "\t\t\t\"".$name.'"=>array("type"=>"'.$type.'"))'.PHP_EOL;
					$cont[$name] = array("type"=>$type);
					$this->dbforge->add_field($cont);

					//CTREATE the table
					$this->dbforge->create_table($tbl_name,TRUE);
										
				endif;
			endforeach;

			$field_data = '$this->dbforge->add_field('.$fields."\t\t".');'.PHP_EOL."\t\t".'$this->dbforge->create_table("'.$tbl_name.'");';

			//create the migration...
			$num = sizeof(get_filenames(getcwd().'/application/migrations/')); //number of existing migrations
			$num = sprintf('%03d',$num);

			write_file(getcwd().'/application/migrations/'.$num.'_'.$tbl_name.'.php',
					'<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");'.PHP_EOL.

						PHP_EOL.'class Migration_'.$num.'_'.$tbl_name.' extends CI_Migration'.PHP_EOL.'{'.
							PHP_EOL."\tpublic function up()".PHP_EOL."\t{".								
								PHP_EOL."\t\t".$field_data.
							PHP_EOL."\t}".
							PHP_EOL."\tpublic function down()".PHP_EOL."\t{".								
								PHP_EOL."\t\t".'$this->dbforge->drop_table("'.$tbl_name.'");'.
							PHP_EOL."\t}".
						PHP_EOL.'}'.
						PHP_EOL.
						'/* End of file '.$num.'_'.$tbl_name.'*/'.PHP_EOL.'/* Location: ./application/migrations/Migration_'.$num.'_'.$tbl_name.'.php */');
			//run migration
			
			//if($CI->db['default']['database'])exit('No database has been set'.PHP_EOL.'New miration created though.');

			$this->load->library('migration');
			$this->migration->version($num);			

			//create the view for form entry
			$this->ignite('f',$tbl_name);
			
			echo PHP_EOL.'Cranking complete.'.PHP_EOL."Table: $tbl_name and Model: ".singular($tbl_name)." were created!";

		elseif($direction === "down"):

			$this->load->dbforge();

			//handle actual table delete
			if($tbl_name !=="" AND $this->db->table_exists($tbl_name)):
				$this->dbforge->drop_table($tbl_name);
				echo singular($tbl_name).'successfully deleted.'.PHP_EOL;
			else:
				exit('That table does not exist. Enter table name to crank down');
			endif;

			//handle model delete
			if(file_exists(getcwd().'\application\models\\'.singular($tbl_name).'_model.php')):

				unlink(getcwd().'/application/models/'.singular($tbl_name).'_model.php');
				echo PHP_EOL.'Table successfully cranked down, '.singular($tbl_name).'_model was deleted';

			else:				
				echo ('No such model '.singular($tbl_name).'_model');
			endif;
		else:

			echo PHP_EOL."You need to specify the direction of your crank and the table name!".PHP_EOL;
			echo PHP_EOL."Usage:".PHP_EOL."[direction: up|down (up: create table info, down: destroy table info)],".PHP_EOL."[table_name(plural version)],
					".PHP_EOL."[colunm:type,colunm:type,colunm:type...so on. Dont bother to add the \"id\" column though)]".PHP_EOL."(types include: int,string,text,date)".PHP_EOL;					
		endif;
		
		else:
			echo PHP_EOL."You need to specify the direction of your crank and the table name!".PHP_EOL;
			echo PHP_EOL."Usage:".PHP_EOL."[direction: up|down (up: create table info, down: destroy table info)],".PHP_EOL."[table_name(plural version)],
					".PHP_EOL."[colunm:type,colunm:type,colunm:type...so on. Dont bother to add the \"id\" column though)]".PHP_EOL."(types include: int,string,text,date)".PHP_EOL;
		endif;
	}

	/** 
	 *Ignition create to create a new bare, cont, model or view
	 *
	 *helper to retrieve current working directory
	 * @param 	string 		$type
	 * @return 	void
	 */
	public function gwd()
	{
		echo getcwd();
	}
	public function migrate($id)
	{
		$this->load->library('migration');
		$this->migration->version(0);
	}
	/** 
	 *Ignition stop
	 *
	 *deletes a project from working directory
	 * @param 	string 		$type
	 * @return 	void
	 */
	public function stop($dir="")
	{
		if($dir==""):
			exit('Specify a project to delete');
		endif;
		
		$project_name = $dir;

		$dir = str_replace('ignition', $dir, getcwd());
		echo "Are you sure you want to delete project \"".$project_name."\" ?[y/n]";		
		shell_exec('rmdir /s '.$dir);		
	
		if (!is_dir($dir)):
			echo "Project $project_name succesfully deleted.";	
		endif;
		
	}
}

/* End of file Ignition.php */
/* Location: ./application/controllers/Ignition.php */