<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
function actual_time($format,$offset,$timestamp){
   //Offset is in hours from gmt, including a - sign if applicable.
   //So lets turn offset into seconds
   $offset = $offset*60*60;
   $timestamp = $timestamp + $offset;
    //Remember, adding a negative is still subtraction ;)
   return gmdate($format,$timestamp);
}

function mysql2date( $mysqlstring )
{
	$i = mktime(
		(int) substr( $mysqlstring, 11, 2 ), (int) substr( $mysqlstring, 14, 2 ), (int) substr( $mysqlstring, 17, 2 ),
		(int) substr( $mysqlstring, 5, 2 ), (int) substr( $mysqlstring, 8, 2 ), (int) substr( $mysqlstring, 0, 4 )
	); 
	
	return $i;
}