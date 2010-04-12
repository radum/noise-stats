<?php

class Userskit_Model extends Model
{
	function Userskit_Model()
	{
		parent::Model();
		$this->load->helper('site_helper');
	}	

	// Returneaza primii X useri din baza sortati dupa ultima accesare a paginii
	function getLastXUsers($noOfUsers)
	{
		$sql = 	"SELECT username FROM users ORDER BY last_login DESC LIMIT 0, ".$noOfUsers;		
		
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