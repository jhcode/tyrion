<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
* Youtube Library
* For uploading videos to youtube channel through simer platform
*
*/

class Youtube
{
	var $youtube_email;
	var $youtube_password;
	var $key;
	var $source;
	var $postdata;
    
    /**
     *
     */
    public function youtube()
    {
    	$this->youtube_email = "simerapp@gmail.com";
    	$this->youtube_password = "2014xibudega:)";
    	$this->key = "AI39si5QBznZU8aogUhMnOTJ9i-Oia_s9TCvHDLIxjeZC3KZi3n5bRx7fUfXl03DfzcF0gi8LGU4dODURuTSXstTZrGFX6w9Cg"; 
    	$this->source = 'Simerapp';
    	$this->postdata = "Email=".$this->youtube_email."&Passwd=".$this->youtube_password."&service=youtube&source=".$this->source;
    }

    public function get_token($video_title,$video_description)
    {
    	//authentication
    	$curl = curl_init( "https://www.google.com/youtube/accounts/ClientLogin" );
	    curl_setopt( $curl, CURLOPT_HEADER, "Content-Type:application/x-www-form-urlencoded" );
	    curl_setopt( $curl, CURLOPT_POST, 1 );
	    curl_setopt( $curl, CURLOPT_POSTFIELDS, $this->postdata );
	    curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, 0 );
	    curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
	    curl_setopt( $curl, CURLOPT_SSL_VERIFYHOST, 1 );
	    $response = curl_exec( $curl );
	    curl_close( $curl );

	    //after authentication...
	    list( $auth, $youtubeuser ) = explode( "\n", $response );
	    list( $authlabel, $authvalue ) = array_map( "trim", explode( "=", $auth ) );
	    list( $youtubeuserlabel, $youtubeuservalue ) = array_map( "trim", explode( "=", $youtubeuser ) );

	    //build query to get access token
	    $youtube_video_title = $video_title; // This is the uploading video title.
	    $youtube_video_description = $video_description; // This is the uploading video description.   
	    $youtube_video_keywords = "simerapp"; // This is the uploading video keywords.
	    $youtube_video_category = "Education";
    
	    $data = '<?xml version="1.0"?>
	                <entry xmlns="http://www.w3.org/2005/Atom"
	                  xmlns:media="http://search.yahoo.com/mrss/"
	                  xmlns:yt="http://gdata.youtube.com/schemas/2007">
	                  <media:group>
	                    <media:title type="plain">' . stripslashes( $youtube_video_title ) . '</media:title>
	                    <media:description type="plain">' . stripslashes( $youtube_video_description ) . '</media:description>
	                    <media:category
	                      scheme="http://gdata.youtube.com/schemas/2007/categories.cat">'.$youtube_video_category.'</media:category>
	                    <media:keywords>'.$youtube_video_keywords.'</media:keywords>
	                  </media:group>
	                </entry>';

	    $headers = array( "Authorization: GoogleLogin auth=".$authvalue,
	                 "GData-Version: 2",
	                 "X-GData-Key: key=".$this->key,
	                 "Content-length: ".strlen( $data ),
	                 "Content-Type: application/atom+xml; charset=UTF-8" );

		$curl = curl_init( "http://gdata.youtube.com/action/GetUploadToken");
		curl_setopt( $curl, CURLOPT_USERAGENT, $_SERVER["HTTP_USER_AGENT"] );
		curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $curl, CURLOPT_TIMEOUT, 10 );
		curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $curl, CURLOPT_POST, 1 );
		curl_setopt( $curl, CURLOPT_FOLLOWLOCATION, 1 );
		curl_setopt( $curl, CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $curl, CURLOPT_POSTFIELDS, $data );
		curl_setopt( $curl, CURLOPT_REFERER, true );
		curl_setopt( $curl, CURLOPT_FOLLOWLOCATION, 1 );
		curl_setopt( $curl, CURLOPT_HEADER, 0 );

		$response = simplexml_load_string( curl_exec( $curl ) );
		curl_close( $curl );

		return $response;
    }
    
}

// End of file: MY_Encrypt.php
