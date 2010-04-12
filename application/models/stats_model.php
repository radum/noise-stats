<?php

class Stats_Model extends Model
{
	function Stats_Model()
	{
		parent::Model();
		$this->load->helper('site_helper');
	}
	
	// Returneaza Top 5 Artisti pentru toti userii
	function getTop5Artists()
	{
		$sql = 	"SELECT artists.artist, count(scrobbled_songs.track_id) AS trackId FROM scrobbled_songs INNER JOIN tracks ON (scrobbled_songs.track_id = tracks.id) INNER JOIN artists ON (tracks.artist_id = artists.id) GROUP BY scrobbled_songs.track_id ORDER BY trackId DESC;";		
		
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
	
	// Returneaza toti artistii sortati pentru user 
	function getTopArtistForUser($user)
	{
		//$sql = "SELECT artists.artist, count(scrobbled_songs.track_id) AS trackId FROM scrobbled_songs INNER JOIN tracks ON (scrobbled_songs.track_id = tracks.id) INNER JOIN users ON (scrobbled_songs.user_id = users.id) INNER JOIN artists ON (tracks.artist_id = artists.id) WHERE (users.username = '".$user."') GROUP BY scrobbled_songs.track_id ORDER BY trackId DESC;";
		$sql = "SELECT artists.artist , count(scrobbled_songs.track_id) AS artistCount FROM scrobbled_songs INNER JOIN tracks ON (scrobbled_songs.track_id = tracks.id) INNER JOIN users ON (scrobbled_songs.user_id = users.id) INNER JOIN artists ON (tracks.artist_id = artists.id) WHERE (users.username ='".$user."') GROUP BY artists.artist ORDER BY artistCount DESC, artists.artist ASC;";
		
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
	
	// Returneaza toate melodiile sortate pentru user
	function getTopSongsForUser($user)
	{
		$sql = 	"SELECT tracks.trackName , artists.artist , count(scrobbled_songs.track_id) AS trackIdCount FROM scrobbled_songs INNER JOIN tracks ON (scrobbled_songs.track_id = tracks.id) INNER JOIN users ON (scrobbled_songs.user_id = users.id) INNER JOIN artists ON (tracks.artist_id = artists.id) WHERE (users.username ='".$user."') GROUP BY scrobbled_songs.track_id ORDER BY trackIdCount DESC;";
		
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
	
	// Returneaza toate albumele sortate pentru user
	function getTopAlbumsForUser($user)
	{
		$sql = 	"SELECT tracks.album , artists.artist , count(scrobbled_songs.track_id) AS trackIdCount FROM scrobbled_songs INNER JOIN tracks ON (scrobbled_songs.track_id = tracks.id) INNER JOIN users ON (scrobbled_songs.user_id = users.id) INNER JOIN artists ON (tracks.artist_id = artists.id) WHERE (users.username ='".$user."') GROUP BY tracks.album ORDER BY trackIdCount DESC;";
		
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
	
	// Returneaza numarul de artists pentru user
	function getNoOfScrobbledArtistsForUser($user)
	{
		$sql = 	"SELECT count(artists.id) AS scrobbledArtists FROM scrobbled_songs INNER JOIN users ON (scrobbled_songs.user_id = users.id) INNER JOIN tracks ON (scrobbled_songs.track_id = tracks.id) INNER JOIN artists ON (tracks.artist_id = artists.id) WHERE (users.username ='".$user."') GROUP BY artists.id, users.username;";
		
		$query = $this->db->query($sql);
		
		if ($query->num_rows() > 0)
		{
			return $query->num_rows();
		}
		else
		{
			return false;
		}
	}
	
	// Returneaza numarul de trackuri pentru user
	function getNoOfScrobbledSongsForUser($user)
	{
		$sql = 	"SELECT count(scrobbled_songs.track_id) AS scrobbledTracks FROM scrobbled_songs INNER JOIN users ON (scrobbled_songs.user_id = users.id) WHERE (users.username ='".$user."') GROUP BY users.username;";
		
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
	
	// Returneaza numarul de albume pentru user
	function getNoOfScrobbledAlbumsForUser($user)
	{
		$sql = 	"SELECT count(tracks.album) AS scrobbledAlbum FROM scrobbled_songs INNER JOIN users ON (scrobbled_songs.user_id = users.id) INNER JOIN tracks ON (scrobbled_songs.track_id = tracks.id) INNER JOIN artists ON (tracks.artist_id = artists.id) WHERE (users.username ='".$user."') GROUP BY tracks.album, users.username;";
		
		$query = $this->db->query($sql);
		
		if ($query->num_rows() > 0)
		{
			return $query->num_rows();
		}
		else
		{
			return false;
		}
	}
	
	// Returneaza ultima melodie ascultata de user
	function getLastScrobbledSongForUser($user)
	{
		$sql = 	"SELECT scrobbled_songs.scrobble_time AS lastScrobbledTime , tracks.trackName , artists.artist FROM scrobbled_songs INNER JOIN users ON (scrobbled_songs.user_id = users.id) INNER JOIN tracks ON (scrobbled_songs.track_id = tracks.id) INNER JOIN artists ON (tracks.artist_id = artists.id) WHERE (users.username ='".$user."') GROUP BY lastScrobbledTime, users.username ORDER BY lastScrobbledTime DESC LIMIT 0,1;";
		
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