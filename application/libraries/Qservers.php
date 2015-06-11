<?php

require_once "Mail.php"; // PEAR Mail package
require_once ('Mail/mime.php'); // PEAR Mail_Mime packge

class Qservers
{	

	public function __construct()
	{

	}

	public function send_mail($name,$email,$subject,$message)
	{		
		$to = $email;
		$from = "no-reply@simerapp.com";
		$headers = array ('From' => $from,'To' => $to, 'Subject' => $subject);

		$text = ''; // text versions of email.
		$html = $message; // html versions of email.

		$crlf = "\n";

		$mime = new Mail_mime($crlf);
		$mime->setTXTBody($text);
		$mime->setHTMLBody($html);

		//do not ever try to call these lines in reverse order
		$body = $mime->get();
		$headers = $mime->headers($headers);

		$host = "localhost"; // all scripts must use localhost
		$username = "no-reply@simerapp.com"; //  your email address (same as webmail username)
		$password = "2014xibudega:)"; // your password (same as webmail password)

		$smtp = Mail::factory('smtp', array ('host' => $host, 'auth' => true,
		'username' => $username,'password' => $password));

		$mail = $smtp->send($to, $headers, $body);

		if (PEAR::isError($mail)) {
			return false;
		}

		return true;
	}		 		
}
?>