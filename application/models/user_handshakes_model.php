<?php

class User_Handshakes_Model extends Model
{
	function User_Handshakes_Model()
	{
		parent::Model();
	}
	
	// Add a new handeshake session
	function addNewHandeshake($handshake_data)
	{
		$insert = array(
			    'user_id' => $handshake_data['user_id'], 
			    'handshake_session' => $handshake_data['handshake_session'],
			    'last_activity' => $handshake_data['last_activity']			    		
		);
	
		if ($this->db->insert('user_handshakes', $insert)) 
		{
			$id = $this->db->insert_id();
			return $id;
		}
		else
		{
			return FALSE;
		} 
	}
	
	// Update handeshake session
	function updateHandeshake($handshake_id, $handshake_data)
	{
		$insert = array(
			    /*user_id' => $handshake_data['user_id'],*/ 
			    'handshake_session' => $handshake_data['handshake_session'],
			    'last_activity' => $handshake_data['last_activity']			    		
		);
		
		if( $this->db->update('user_handshakes', $insert, "id = ".$handshake_id) )
		{
			$id = $this->db->affected_rows();
			return $id;
		}
		else
		{
			return FALSE;
		}
	}
	
	// Check if handeshake session exist for this user
	function isHandeshakeForUserId($user_id)
	{
		$query = $this->db->get_where('user_handshakes', array('user_id' => $user_id));
		
		if( $query->num_rows() == 1 )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function isHandeshakeValid($handshake_session)
	{
		$query = $this->db->get_where('user_handshakes', array('handshake_session' => $handshake_session));
		
		if( $query->num_rows() == 1 )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function getHandeshakeIdForUserId($user_id)
	{
		return $this->db->get_where('user_handshakes', array('user_id' => $user_id))->row()->id;
	}
	
	function getUserIdForHandeshake($handshake_session)
	{
		return $this->db->get_where('user_handshakes', array('handshake_session' => $handshake_session))->row()->user_id;
	}
}

/* End of file user_handshakes_model.php */
/* Location: ./system/application/models/user_handshakes_model.php */