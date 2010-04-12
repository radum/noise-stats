<?php

class Searchuser_Model extends Model
{
	function Searchuser_Model()
	{
		parent::Model();
		$this->load->helper('site_helper');
	}
	
	// Cauta toata lista de utilizatori
	function searchForUsers($username)
	{
		$sql = 	"SELECT username FROM users WHERE username LIKE '%".$username."%';";		
		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			return $query;
		}
		else
		{
			return false;
		}
	}
}