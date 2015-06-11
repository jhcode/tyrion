<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('simer_redirect'))
{
	function simer_redirect($link)
	{
		$CI =& get_instance();
		$controller = $CI->uri->segment(1);
		$method = $CI->uri->segment(2);

		//breakdown link
		$link_detail = explode('/',$link); 

		//create empty offset for method, in case there is no method specified
		if(!isset($link_detail[1])):
			
			$link_detail[1]  = "";

		endif;
		
		if($link_detail[0] !== $controller AND $link_detail[1] !== $method):
		
			//exit($link.' '.$controller.'/'.$method);
			redirect($link);

		endif;
	}
}

if ( ! function_exists('simer_reveal_msg'))
{
	function simer_reveal_msg()
	{
		$CI =& get_instance();

		$result="";

		//if there are validation errors
		if(validation_errors() !== ""):
			$result .=  validation_errors();
		endif;

		//if there are other messages
		if($CI->message->display() !== ""):
			$result .= $CI->message->display();
		endif;

		return $result;
	}
}

/**
 * Get human readable time difference between 2 dates
 *
 * @param mixed $time1 a time (string or timestamp)
 * @param mixed $time2 a time (string or timestamp)
 * @param integer $precision Optional precision 
 * @return string time difference
 */
if ( ! function_exists('get_date_diff'))
{
    function get_date_diff( $time1, $time2, $precision = 2 ) 
    {
        // If not numeric then convert timestamps
        if( !is_int( $time1 ) ) {
            $time1 = strtotime( $time1 );
        }
        if( !is_int( $time2 ) ) {
            $time2 = strtotime( $time2 );
        }
     
        // If time1 > time2 then swap the 2 values
        if( $time1 > $time2 ) {
            list( $time1, $time2 ) = array( $time2, $time1 );
        }
     
        // Set up intervals and diffs arrays
        $intervals = array( 'year', 'month', 'day', 'hour', 'minute', 'second' );
        $diffs = array();
     
        foreach( $intervals as $interval ) {
            // Create temp time from time1 and interval
            $ttime = strtotime( '+1 ' . $interval, $time1 );
            // Set initial values
            $add = 1;
            $looped = 0;
            // Loop until temp time is smaller than time2
            while ( $time2 >= $ttime ) {
                // Create new temp time from time1 and interval
                $add++;
                $ttime = strtotime( "+" . $add . " " . $interval, $time1 );
                $looped++;
            }
     
            $time1 = strtotime( "+" . $looped . " " . $interval, $time1 );
            $diffs[ $interval ] = $looped;
        }
     
        $count = 0;
        $times = array();
        foreach( $diffs as $interval => $value ) {
            // Break if we have needed precission
            if( $count >= $precision ) {
                break;
            }
            // Add value and interval if value is bigger than 0
            if( $value > 0 ) {
                if( $value != 1 ){
                    $interval .= "s";
                }
                // Add value and interval to times array
                $times[] = $value . " " . $interval;
                $count++;
            }
        }
     
        // Return string with times
        return implode( ", ", $times );
    }
}

/**
 * Return human readable sizes
 * @param       int     $size        size in bytes
 * @param       string  $max         maximum unit
 * @param       string  $system      'si' for SI, 'bi' for binary prefixes
 * @param       string  $retstring   return string format
 */

if ( ! function_exists('size_readable'))
{
    function size_readable($size, $max = null, $system = 'si', $retstring = '%01.2f %s')
    {
        // Pick units
        $systems['si']['prefix'] = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
        $systems['si']['size']   = 1000;
        $systems['bi']['prefix'] = array('B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB');
        $systems['bi']['size']   = 1024;
        $sys = isset($systems[$system]) ? $systems[$system] : $systems['si'];
      
        // Max unit to display
        $depth = count($sys['prefix']) - 1;
        if ($max && false !== $d = array_search($max, $sys['prefix'])) {
            $depth = $d;
        }
      
        // Loop
        $i = 0;
        while ($size >= $sys['size'] && $i < $depth) {
            $size /= $sys['size'];
            $i++;
        }
      
        return sprintf($retstring, $size, $sys['prefix'][$i]);
    }
}

/**
* check_image
* Checks if image of user is uploaded. If uploaded, it gives user image
* else it gives default avatar
* @param image image variable
*/
if(!function_exists('check_image')){
    function check_image($image,$just_img = false){
        if ($image !== "") {
            
            if(!$just_img):
                return img(base_url('uploads/profile/'.$image));
            else:
                return base_url('uploads/profile/'.$image);
            endif;
            
        }else{

            if(!$just_img):
                return img(base_url('assets/imgs/profile-pic.jpg'));
            else:
                return base_url('assets/imgs/profile-pic.jpg');
            endif;
        }
    }
}
/**
* check_group_image
* similar to function above but for group avatars
*/
if (!function_exists('check_group_image')) {
    function check_group_image($image,$just_img = false){

        if ($image !== "") {

            if(!$just_img):
                return img(base_url('./uploads/groups/'.$image));
            else:
                return base_url('./uploads/groups/'.$image);
            endif;
        }else{

            if(!$just_img):
                return img(base_url('assets/imgs/group-pic.jpg'));
            else:
                return base_url('assets/imgs/group-pic.jpg');
            endif;
        }
    }
}

/**
* say you when it's the user
*
*/
if(!function_exists('say_you')){
    function say_you($sess_name,$name){
        if ($name === $sess_name) {
            return "you";
        }else{
            return $name;
        }
    }
}

/**
*
* No_Access
* Used to restrict unwanted users from certain features
* @param owner is the user with content access
* @param user is presently logged user
* @param owner_post content for owner
* @param user_post content for user
*/
if (!function_exists('no_access')) {
    function no_access($owner,$user,$owner_post,$user_post = ""){
        if ($user === $owner) {
           return $owner_post;
        }else{
            return $user_post;
        }
    }
}
/**
* Theme_Pick
* Selects a theme for the groups based on choice theme
* name.
*/
if (!function_exists('theme_pick')) {
    function theme_pick($theme,$orange,$green,$purple){
        if ($theme === 'orange') {
            return $orange;
        }elseif($theme === 'green'){
            return $green;
        }elseif ($theme === 'purple') {
            return $purple;
        }
    }
}

/*
* Singular_Count
* Adds an 's' to plural counts and leaves
* singular counts without the 's'
*
*/
if (!function_exists('singular_count')) {
    function singular_count($count,$suffix){
        if(count($count) === 1){
            return count($count).' '.$suffix;
        }else{
            return count($count).' '.$suffix.'s';
        }
    }
}

/** 
* Exact Day
* Used to display Today, Tommorow, Yesterday
* and other specific days of events
* @param time -> Timestamp
*
*/
if (!function_exists('exact_day')) {
    function exact_day($time){
        $yesterday  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
        $tomorrow  = mktime(0, 0, 0, date("m")  , date("d")+1, date("Y"));
        if(date('d/m/Y',$time) === date('d/m/Y')){
            return "Today";
        }elseif(date('d/m/Y',$time) === date('d/m/Y', $tomorrow)){
            return "Tomorrow";
        }elseif(date('d/m/Y',$time) === date('d/m/Y', $yesterday)){
            return "Yesterday";
        }else{
            $datetime1 = date_create(date('d-m-Y'));
            $datetime2 = date_create(date('d-m-Y',$time));
            $interval = date_diff($datetime1, $datetime2);
            if(substr($interval->format('%R%a days'),0,1) === '-'){
                return substr($interval->format('%R%a days'),1)." ago";
            }elseif(substr($interval->format('%R%a days'),0,1) === '+'){
                return "In ".substr($interval->format('%R%a days'), 1);
            }else{
                return $interval->format('%R%a days');
            }
        }
    }
}

/**
* color_code
* Used for Color-Coding Student scores
* 0 - 25(Red), 26 - 50(Orange), 51 - 75(Blue), 76 - 100(Green)
* @param $val -> Value to be color coded
*/
if (!function_exists('color_code')) {
    function color_code($val){
        if(($val <= 100) and ($val > 75)){
            return "breakpoint-100";
        }elseif(($val < 76) and ($val > 50)){
            return "breakpoint-75";
        }elseif(($val < 51) and ($val) > 25){
            return "breakpoint-50";
        }elseif($val < 26){
            return "breakpoint-25";
        }
    }
}
/**
* Function to get date differences by weeks
* @param time in timestamp
*/
if(!function_exists('week_diff')){
    function week_diff($time){
        $d1 = date_create(date('d-m-Y'));
        $d2 = date_create(date('d-m-Y',$time));
        $diff = date_diff($d1,$d2);
        $interval = $diff->format('%R%a');
        if ($interval > 14) {
            return 'In 2 Weeks';
        }elseif($interval > 7){
            return 'Next Week';
        }elseif($interval < -7){
            return 'Last Week';
        }else{
            return 'This Week';
        }
    }
}

/**
* wraps_links wraps every link in an anchor
* with a target="_blank"
* @param subject to match for links
*/
if (!function_exists('wrap_links')) {
    function wrap_links($subject){
        $pattern = '/(?:http:\/\/|https:\/\/|www)\S+/';
        $replacement = "<a href='//$0' target='_blank'>$0</a>";
        $output = preg_replace($pattern, $replacement, $subject);
        $output = preg_replace('/(\/\/http:\/\/|\/\/https:\/\/)/', '//', $output);
        return $output;
    }
}

/**
* Minutes Only
* @param time in this format HH:MM
*/
if (!function_exists('minutes_only')) {
    function minutes_only($time){
        list($hrs,$mins) = explode(':',$time);
        if($hrs > 1){$hunit = ' hours, ';}else{$hunit = ' hour, ';}
        if($mins > 1){$munit = ' minutes';}else{$munit = ' minute';}
        if($hrs === '0'):
            return $mins.$munit;
        else:
            return $hrs.$hunit.$mins.$munit;
        endif;
    }
}
/**
* get_default_role
* Determine default role of user
* @param $user(object)
*/
if (!function_exists('get_default_role')) {
    function get_default_role($user){
       
        if($user->is_sadmin):
            return "sadmin";

        elseif($user->is_admin):

            return "admin";
        elseif($user->is_teacher):

            return "teacher";
        elseif($user->is_bursar):

            return "bursar";
        elseif($user->is_manager):

            return "manager";
        elseif($user->is_student):

            return "student";

        else:

            return "regular";            
        endif;
    }
}

/**
* get_session_dropdown
* Determine the 2 possible sessions afor a school
* @param $user(object)
*/
if (!function_exists('get_session_dropdown')) {
    function get_session_dropdown(){
       
        $curr_yr = date('Y');
        $last_yr = $curr_yr - 1;
        $next_yr = $curr_yr + 1;

        return '<select><option>'.$last_yr.'/'.$curr_yr.'</option><option>'.$curr_yr.'/'.$next_yr.'</option></select>';
    }
}
/* End of file simer_helper v2.php */
/* Location: ./system/helpers/simer_helper v2.php */