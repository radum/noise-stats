<?php

class Download extends Controller {

	function Download()
	{
		parent::Controller();
		$this->load->helper('url');
		$this->load->library('DX_Auth');
		$this->load->model('userskit_model', 'usersModel');
	}
	
	function index()
	{
		$usersListQuery = $this->usersModel->getLastXUsers(6);
		$footerWidebarData['usersListArr'] = $usersListQuery;
		
		$this->load->view('header');
		$this->load->view('download');
		$this->load->view('footer_widebar',$footerWidebarData);
		$this->load->view('footer');
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/download.php */