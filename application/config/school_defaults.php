<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * SCHOOL DEFAULTS
 *
 * A CLI tool for rapid bootstrapping in CI
 *
 * @package		CodeIgniter
 * @subpackage	Simer
 * @author		KesAkp <@bourgeois247> 
 * @since		CodeIgniter Version 2.1.3
 * @link 		http://twitter.com/bourgeois247
| -------------------------------------------------------------------
| SCHOOL DEFAULTS
| -------------------------------------------------------------------
| This file maintains default options for school;
*/

$config['levels'] = [
						'Classic Nigerian Standard'=>['JSSS 1','JSSS 2','JSSS 3','SSS 1','SSS 2','SSS 3'],
						'New Nigerian Standard'=>['BASIC 1','BASIC 2','BASIC 3','BASIC 4','BASIC 5','BASIC 6'],
						'Bristish Standard'=>['YEAR 1','YEAR 2', 'YEAR 3', 'YEAR 4', 'YEAR 5', 'YEAR 6'],
						'American Standard'=>[
												'GRADE 1', 'GRADE 2', 'GRADE 3', 'GRADE 4', 'GRADE 5', 'GRADE 6',
											  	'GRADE 7', 'GRADE 8', 'GRADE 9', 'GRADE 10', 'GRADE 11', 'GRADE 12'
											 ]
					];

$config['grades'] = [

						'WAEC SENIOR SCHOOL STANDARD'=>[

															[
																'grade'=>'A1',
																'min_score'=>75,
																'comment'=>'Excellent Performance',
															],
															[
																'grade'=>'B2',
																'min_score'=>70,
																'comment'=>'Excellent Performance',
															],
															[
																'grade'=>'B3',
																'min_score'=>65,
																'comment'=>'Excellent Performance',
															],
															[
																'grade'=>'C4',
																'min_score'=>60,
																'comment'=>'Excellent Performance',
															],
															[
																'grade'=>'C5',
																'min_score'=>55,
																'comment'=>'Excellent Performance',
															],
															[
																'grade'=>'C6',
																'min_score'=>50,
																'comment'=>'Excellent Performance',
															],
															[
																'grade'=>'D7',
																'min_score'=>40,
																'comment'=>'Excellent Performance',
															],
															[
																'grade'=>'E8',
																'min_score'=>30,
																'comment'=>'Excellent Performance',
															],
															[
																'grade'=>'F9',
																'min_score'=>0,
																'comment'=>'Excellent Performance',
															]
														],
						'WAEC JUNIOR SCHOOL STANDARD'=>[

															[
																'grade'=>'A',
																'min_score'=>75,
																'comment'=>'Excellent Performance.',
															],
															[
																'grade'=>'B',
																'min_score'=>60,
																'comment'=>'Excellent Performance.',
															],
															[
																'grade'=>'C',
																'min_score'=>50,
																'comment'=>'Excellent Performance.',
															],
															[
																'grade'=>'D',
																'min_score'=>40,
																'comment'=>'Pass.',
															],
															[
																'grade'=>'E',
																'min_score'=>30,
																'comment'=>'Slight Ode.',
															],
															[
																'grade'=>'F',
																'min_score'=>0,
																'comment'=>'Failure.',
															]
														]
					];


$config['subjects'] = 	[
							'Mathematics','English Language','Physics','Chemistry','Biology','Commerce',
							'Business Studies','Economics','Government','Art','Geography','Further Mathematics',
							'Introduction To Technology', 'Integrated Science','Literature','Music','Yoruba','Igbo','Hausa',
							'Integrated Science','Technical Drawing'
						];