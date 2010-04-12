<?php

class Welcome extends Controller {

	function Welcome()
	{
		parent::Controller();
		$this->load->helper('url');	
		$this->load->library('DX_Auth');
		$this->load->model('stats_model', 'statsDB');
		$this->load->model('userskit_model', 'usersModel');
	}
	
	function index()
	{
		//$topArtists = array_unique($this->statsDB->getTop5Artists()->row_array());
		$topArtistsQuery = $this->statsDB->getTop5Artists();		
		$topArtistsArr   = array();
		if( $topArtistsQuery != false )
		{
			foreach ($topArtistsQuery->result() as $row)
			{$topArtistsArr[] = $row->artist;}
		}
		else
		{
			$topArtistsArr[] = "Baza goala";
		}
		
		$indexData['topArtists'] = array_values(array_unique($topArtistsArr));
		
		$usersListQuery = $this->usersModel->getLastXUsers(6);
		$footerWidebarData['usersListArr'] = $usersListQuery;

		$this->load->view('header');
		$this->load->view('welcome', $indexData);
		$this->load->view('footer_widebar',$footerWidebarData);
		$this->load->view('footer');
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */