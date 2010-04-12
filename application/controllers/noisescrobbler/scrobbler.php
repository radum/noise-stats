<?php

class Scrobbler extends Controller {

	function __construct()
	{
		parent::Controller();
		$this->load->helper('url');
		$this->load->database();
		$this->load->model('User_Handshakes_Model');
		$this->load->model('Scrobbler_Model');
		// Load DX Auth config
		$this->ci =& get_instance();
		$this->load->config('dx_auth');
	}
	
	function index()
	{
		echo 'Noise-Scrobbler Version 0.1';
	}
	
	function Scrobble($hs, $clientid, $user, $timestamp, $auth)
	{
		if( $hs == 'true' )
		{
			//Check if the user is valid, and set ok the handshake
		
			// Load Models
			$this->ci->load->model('dx_auth/users', 'users');
		
			// Default user_id set to none
			$user_id = 0;
			$pass_hash = '';

			if ($query = $this->ci->users->get_user_by_username($user) AND $query->num_rows() == 1)
			{ $user_id = $query->row()->id; }
			
			if ($query = $this->ci->users->get_user_field($user_id, 'password') AND $query->num_rows() == 1)
			{ $pass_hash = $query->row()->password; }
								
			if(md5($pass_hash.$timestamp) === $auth)//Verfica credentialele
			{
				$sessionID = md5($this->ci->users->get_user_field($user_id, 'email')->row()->email.time());
				
				$handshake_data = array(
			    'user_id' => $user_id, 
			    'handshake_session' => $sessionID,
			    'last_activity' => time()			    		
				);
				
				if( $this->User_Handshakes_Model->isHandeshakeForUserId($user_id) )
				{
					$handshake_id = $this->User_Handshakes_Model->getHandeshakeIdForUserId($user_id);
					$id = $this->User_Handshakes_Model->updateHandeshake($handshake_id, $handshake_data);
				}
				else
				{ $id = $this->User_Handshakes_Model->addNewHandeshake($handshake_data); }
			
				if(is_int($id))//Daca totul decurge bine in baza atunci OK
				{					
					//Am pus " in loc de ' ca sa pot sa folosesc \n :)
					//$this->output->set_header("HTTP/1.1 200 OK");
					echo "OK\n";
					echo $sessionID."\n";//Session ID
					echo "http://noisestats.radumicu.info/noisescrobbler/scrobbler/scrobblesong/";
				}
				else
				{
					echo "SERVERERR\n";
				}				
			}
			else
			{
				echo "BADAUTH";				
			}
		}
		else
		{
			echo 'If no handshake then no cake!';
		}
	}
	
	function ScrobbleSong($sessionString, $artistName, $track, $trackDuration, $album, $mbTrackId)
	{
		$artistName = html_entity_decode(urldecode($artistName));		
		$track = html_entity_decode(urldecode($track));
		$trackDuration = html_entity_decode(urldecode($trackDuration));
		$album = html_entity_decode(urldecode($album));
		$mbTrackId = html_entity_decode(urldecode($mbTrackId));
		
		//Check if session is valid and get username
		if( $this->User_Handshakes_Model->isHandeshakeValid($sessionString) )
		{
			$user_id = $this->User_Handshakes_Model->getUserIdForHandeshake($sessionString);
			$artist_id = -1;
			
			//Verifica daca artistul este in baza si returneaza id-ul
			if( $this->Scrobbler_Model->isArtistInDB($artistName) )
			{
				$artist_id = $this->Scrobbler_Model->getArtistIdByName($artistName);
			}
			else//in cazul in care nu este il adauga in baza
			{
				$artist_id = $this->Scrobbler_Model->insertArtist($artistName);
			}
			
			//Verifica daca daca track-ul este in baza
			if( $this->Scrobbler_Model->isTrackInDB($artist_id, $track) )
			{
				$trackData = $this->Scrobbler_Model->getTrackData($artist_id, $track);
				//Update the user stats with the current track
				$insertScrobbleId = $this->Scrobbler_Model->scrobbleTrack($user_id, $trackData->row()->id);
				if(is_int($insertScrobbleId))//Daca totul decurge bine in baza atunci OK
				{
					$this->output->set_header("HTTP/1.1 200 OK");
					echo "OK\n";
					echo "Song Scrobbled.";
				}				
				else
				{
					echo "DBERR1\n";
				}
			}//Daca track-ul nu este in baza adauga si scrobble pentru user
			else
			{
				if(is_int(intval($artist_id)))
				{				
					$track_data = array(
					'artist_id' => $artist_id, 
				    'trackName' => $track,
				    'trackDuration' => $trackDuration,
					'album' => $album,
					'mbTrackId' => $mbTrackId			    		
					);
				
					$insertTrackId = $this->Scrobbler_Model->insertNewTrack($track_data);					
					if(is_int($insertTrackId))//Daca totul decurge bine in baza atunci OK
					{
						//Update the user stats with the current track
						$insertScrobbleId = $this->Scrobbler_Model->scrobbleTrack($user_id, $insertTrackId);
						if(is_int($insertScrobbleId))//Daca totul decurge bine in baza atunci OK
						{
							echo "OK\n";
							echo "Song Scrobbled..\n";
						}
						else
						{
							echo "DBERR1\n";
						}
					}
					else
					{
						echo "DBERR2\n";
					}
				}
				else
				{
					echo "DBERR3\n";
				}							
			}
		}
		else
		{
			echo "BADSESSION\n";
		}
	}
}

/* End of file scrobbler.php */
/* Location: ./system/application/controllers/scrobbler/scrobbler.php */