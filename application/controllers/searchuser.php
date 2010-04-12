<?php

class SearchUser extends Controller {

	function SearchUser()
	{
		parent::Controller();
		$this->load->helper('url');	
		$this->load->library('DX_Auth');		
		$this->load->model('userskit_model', 'usersModel');
		$this->load->model('searchuser_model', 'searchModel');
	}
	
	function index()
	{
		$usersListQuery = $this->usersModel->getLastXUsers(6);		
		$footerWidebarData['usersListArr'] = $usersListQuery;
		
		$userName = (string)$this->input->post('searchInput', TRUE);
		if(empty($userName)){show_error("Nimicul nu poate fi cautat :)");}		
		$foundUsersArr = $this->searchModel->searchForUsers($userName);
								
		$foundUsers['foundUsers'] = $foundUsersArr;
		
		$this->load->view('header');
		$this->load->view('search', $foundUsers);
		$this->load->view('footer_widebar', $footerWidebarData);
		$this->load->view('footer');
	}
}