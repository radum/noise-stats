<?php

class Profile extends Controller {

	function Profile()
	{
		parent::Controller();
		$this->load->helper('url');
		$this->load->library('DX_Auth');
		$this->load->model('stats_model', 'statsDB');
		$this->load->model('userskit_model', 'usersModel');
	}
	
	function index()
	{
		header( 'Location: http://noisestats.radumicu.info/profile/usr/'.$this->dx_auth->get_username() );
	}
	
	function usr($user)
	{
		$this->load->model('dx_auth/users', 'users');
		$userData = $this->users->check_username($user)->row();
		if( empty($userData) )
		{
			header( 'Location: http://noisestats.radumicu.info/' );
		}
		else
		{
			//artists returned as array ...
			/*$topArtistQuery = $this->statsDB->getTopArtistForUser($user);
			$topArtistArr   = array();
			foreach ($topArtistQuery->result() as $row)
			{$topArtistArr[] = $row->artist;}
			$profileData['topArtistArr'] = array_values(array_unique($topArtistArr));*/
			
			$topArtistArr = $this->statsDB->getTopArtistForUser($user);
			$topSongsQuery = $this->statsDB->getTopSongsForUser($user);
			$topAlbumsQuery = $this->statsDB->getTopAlbumsForUser($user);
			
			// In cazul in care profilul nu are date se afiseaza ca nu are date :)
			if($topArtistArr == false || $topSongsQuery == false || $topAlbumsQuery == false)
			{
				$profileData['hasData'] = false;
				$profileData['userName'] = $user;
			}
			else
			{
				$noOfUserArtists = $this->statsDB->getNoOfScrobbledArtistsForUser($user);
				$noOfUserTracks = $this->statsDB->getNoOfScrobbledSongsForUser($user)->row()->scrobbledTracks;
				$noOfUserAlbums = $this->statsDB->getNoOfScrobbledAlbumsForUser($user);
				$lastScrobbledTrack = $this->statsDB->getLastScrobbledSongForUser($user);
				
				$profileData['hasData'] = true;
				
				$profileData['userName'] = $user;
				$profileData['topArtistArr'] = $topArtistArr;
				$profileData['topSongsArr'] = $topSongsQuery;
				$profileData['topAlbumsArr'] = $topAlbumsQuery;				
				$profileData['noOfUserArtists'] = $noOfUserArtists;
				$profileData['noOfUserTracks'] = $noOfUserTracks;
				$profileData['noOfUserAlbums'] = $noOfUserAlbums;
				$profileData['lastScrobbledTrack'] = $lastScrobbledTrack;
			}
			
			$usersListQuery = $this->usersModel->getLastXUsers(6);
			$footerWidebarData['usersListArr'] = $usersListQuery;
			
			$this->load->view('header');
			$this->load->view('profile_detail',$profileData);
			$this->load->view('footer_widebar',$footerWidebarData);
			$this->load->view('footer');
		}
	}
}

/* End of file profile.php */
/* Location: ./system/application/controllers/profile.php */