<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * School for Simer 
 *
 * A CLI tool for rapid bootstrapping in CI
 *
 * @package		CodeIgniter
 * @subpackage	Simer
 * @author		KesAkp <@bourgeois247> 
 * @since		CodeIgniter Version 2.1.3
 * @link 		http://twitter.com/bourgeois247
| -------------------------------------------------------------------
| SCHOOL TABLES
| Tables to be created when initializing a school
| -------------------------------------------------------------------
| This file maintains nav link name with icons;
*/

$config['tables'] = [	

						'accounts'=>	[
											"id"=>["type"=>"int", "auto_increment"=>TRUE],	
											"name"=>["type"=>"varchar", "constraint"=>120],	
											"number"=>["type"=>"int", "constraint"=>50],
											"description"=>["type"=>"text"],
											"type"=>["type"=>"varchar","constraint"=>25],											
											"created"=>["type"=>"int"],
											"modified"=>["type"=>"int"]
										],

						'assessments'=>	[
											"id"=>["type"=>"int", "auto_increment"=>TRUE],	
											"staff_subject_id"=>["type"=>"int", "constraint"=>20],	
											"name"=>["type"=>"varchar", "constraint"=>50],
											"max_score"=>["type"=>"int"],
											"term"=>["type"=>"varchar","constraint"=>25],
											"session"=>["type"=>"varchar", "constraint"=>25],									
											"created"=>["type"=>"int"],
											"modified"=>["type"=>"int"]
										],

						'attendance'=>	[
											"id"=>["type"=>"int", "auto_increment"=>TRUE],	
											"staff_id"=>["type"=>"int", "constraint"=>25],										 
											"staff_subject_id"=>["type"=>"int", "constraint"=>20],	
											"student_id"=>["type"=>"int","constraint"=>25],			
											"term"=>["type"=>"varchar","constraint"=>25],
											"session"=>["type"=>"varchar", "constraint"=>25],	
											"modified"=>["type"=>"int"],
											"created"=>["type"=>"int"]
										],

							'classes'=>	[
											"id"=>["type"=>"int", "auto_increment"=>TRUE],	
											"name"=>["type"=>"varchar", "constraint"=>20],										 
											"level"=>["type"=>"varchar", "constraint"=>20],	
											"staff_id"=>["type"=>"int"],											
											"created"=>["type"=>"int"]
										],

						'courseware'=>	[
											"id"=>["type"=>"int", "auto_increment"=>TRUE],										 
											"course_outline_id"=>["type"=>"int"],
											"resource_id"=>["type"=>"int", "constraint"=>255],
											"created"=>["type"=>"int"],			
											"modified"=>["type"=>"int"]							
										],

					'course_outline'=>	[
											"id"=>["type"=>"int", "auto_increment"=>TRUE],										 
											"staff_subject_id"=>["type"=>"int"],
											"week"=>["type"=>"int"],
											"outline"=>["type"=>"text"],
											"description"=>["type"=>"text"],
											"term"=>["type"=>"varchar","constraint"=>25],
											"session"=>["type"=>"varchar", "constraint"=>25],
											"done"=>["type"=>"tinyint"],				
											"created"=>["type"=>"int"],
											"modified"=>["type"=>"int"]
										],

							'levels'=>  [
											"id"=>["type"=>"int", "auto_increment"=>TRUE],
											"name"=>["type"=>"varchar","constraint"=>25],
											"grades"=>["type"=>"text"]
										],

							'parents'=>	[
											"id"=>["type"=>"int", "auto_increment"=>TRUE],										 
											"user_id"=>["type"=>"int", "constraint"=>255],										
											"created"=>["type"=>"int"],
											"modified"=>["type"=>"int"]
										],					

						'postings'=>	[
											"id"=>["type"=>"int", "auto_increment"=>TRUE],											
											"account_id"=>["type"=>"int", "constraint"=>25],
											"transaction_id"=>["type"=>"int", "constraint"=>25],
											"amount"=>["type"=>"int", "constraint"=>255],												
											"created"=>["type"=>"int"],
											"modified"=>["type"=>"int"]							
										],

							'records'=>	[
											"id"=>["type"=>"int", "auto_increment"=>TRUE],											
											"staff_subject_id"=>["type"=>"int", "constraint"=>25],
											"student_id"=>["type"=>"int", "constraint"=>25],
											"ca_score"=>["type"=>"int", "constraint"=>25],
											"exam_score"=>["type"=>"int", "constraint"=>25],
											"term"=>["type"=>"varchar","constraint"=>25],
											"session"=>["type"=>"varchar", "constraint"=>25],				
											"created"=>["type"=>"int"],
											"modified"=>["type"=>"int"]							
										],								

							'staff'=>	[
											"id"=>["type"=>"int", "auto_increment"=>TRUE],										 
											"user_id"=>["type"=>"int", "constraint"=>255],											
											"role"=>["type"=>"varchar", "constraint"=>30],
											"created"=>["type"=>"int"],
											"modified"=>["type"=>"int"]
										],

					'staff_subjects'=>	[
											"id"=>["type"=>"int", "auto_increment"=>TRUE],										 
											"subject_id"=>["type"=>"int", "constraint"=>25],
											"staff_id"=>["type"=>"int", "constraint"=>25],
											"class_id"=>["type"=>"int", "constraint"=>25],
											"created"=>["type"=>"int"],
											"modified"=>["type"=>"int"]											
										],

						'students'=>	[
											"id"=>["type"=>"int", "auto_increment"=>TRUE],			
											"user_id"=>["type"=>"int", "constraint"=>255],
											"created"=>["type"=>"int"],
											"modified"=>["type"=>"int"]
										],

				'student_subjects'=>	[
											"id"=>["type"=>"int", "auto_increment"=>TRUE],			
											"student_id"=>["type"=>"int", "constraint"=>25],
											"staff_subject_id"=>["type"=>"int"],
											"created"=>["type"=>"int"],
											"modified"=>["type"=>"int"]
										],

					'student_scores'=>	[
											"id"=>["type"=>"int", "auto_increment"=>TRUE],			
											"user_id"=>["type"=>"int", "constraint"=>255],
											"created"=>["type"=>"int"],
											"modified"=>["type"=>"int"]
										],

						'subjects'=>	[
											"id"=>["type"=>"int", "auto_increment"=>TRUE],										 
											"name"=>["type"=>"varchar", "constraint"=>25],											
											"created"=>["type"=>"int"],
											"modified"=>["type"=>"int"]
										],

						'timetable'=>	[
											"id"=>["type"=>"int", "auto_increment"=>TRUE],										 
											"staff_subject_id"=>["type"=>"int"],
											"day"=>["type"=>"varchar","constraint"=>11],											
											"start"=>["type"=>"varchar","constraint"=>11],
											"end"=>["type"=>"varchar","constraint"=>11],
											"created"=>["type"=>"int"],
											"modified"=>["type"=>"int"]
										],

					'transactions'=>	[
											"id"=>["type"=>"int", "auto_increment"=>TRUE],										 
											"description"=>["type"=>"text"],
											"amount"=>["type"=>"int"],
											"created_by"=>["type"=>"int"],
											"approved_by"=>["type"=>"int"],
											"amount"=>["type"=>"int"],											
											"created"=>["type"=>"int"],
											"modified"=>["type"=>"int"]
										]
					];


											