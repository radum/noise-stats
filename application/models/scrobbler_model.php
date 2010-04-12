<?php

class Scrobbler_Model extends Model
{
	function Scrobbler_Model()
	{
		parent::Model();
		$this->load->helper('site_helper');
	}
	
	// Checks if the Track is in the database...
	function isTrackInDB($artist, $track)
	{
		$query = $this->db->get_where('tracks', array('artist_id' => $artist, 'trackName' => $track));
		
		if( $query->num_rows() > 0 )
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	// Checks if the Artist is in the database...
	function isArtistInDB($artist)
	{
		$query = $this->db->get_where('artists', array('artist' => $artist));
		
		if( $query->num_rows() > 0 )
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	
	// Returns the Track data fom the database...
	function getTrackData($artist, $track)
	{
		$query = $this->db->get_where('tracks', array('artist_id' => $artist, 'trackName' => $track));
		
		if( $query->num_rows() > 0 )
		{
			return $query;
		}
		else
		{
			return FALSE;
		}
	}
	
	// Returns the artist id by name
	function getArtistIdByName($artistName)
	{
		$query = $this->db->get_where('artists', array('artist' => $artistName));
		$id = null;
		foreach ($query->result() as $row)
		{$id = $row->id;}
		
		if($id != null) {return $id;}
		else {return false;}
	}
	
	//Adds the scrobbled song to users stats
	function scrobbleTrack($userID, $trackID)
	{
		$now = date("Y-m-d H:i:s"); 
		$gmt = actual_time("Y-m-d H:i:s",0,time());
		
		$insert = array(
		   'user_id' => $userID, 
		   'track_id' => $trackID,
		   'scrobble_time' => $gmt 			    		
		);
	
		if ($this->db->insert('scrobbled_songs', $insert)) 
		{
			$id = $this->db->insert_id();
			return $id;
		}
		else
		{
			return FALSE;
		}
	}
	
	// Insert new artist in DB
	function insertArtist($artist_name)
	{
		$insert = array(
		   'artist' => utf8_encode($artist_name)
		);
	
		if ($this->db->insert('artists', $insert)) 
		{
			$id = $this->db->insert_id();
			return $id;
		}
		else
		{
			return FALSE;
		}
	}
	
	// Insert a new track in DB
	function insertNewTrack($track_data)
	{
		$insert = array(
		   'artist_id' => utf8_encode($track_data['artist_id']), 
		   'trackName' => utf8_encode($track_data['trackName']),
		   'trackDuration' => utf8_encode($track_data['trackDuration']),
		   'album' => utf8_encode($track_data['album']),
		   'mbTrackId' => utf8_encode($track_data['mbTrackId'])
		);
	
		if ($this->db->insert('tracks', $insert)) 
		{
			$id = $this->db->insert_id();
			return $id;
		}
		else
		{
			return FALSE;
		}
	}
}