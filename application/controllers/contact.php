<?php

class Contact extends Controller {

	function Contact()
	{
		parent::Controller();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('email');
		$this->load->library('email');

		$this->load->library('DX_Auth');
		$this->load->model('userskit_model', 'usersModel');
	}
	
	function index()
	{
		$usersListQuery = $this->usersModel->getLastXUsers(6);
		$footerWidebarData['usersListArr'] = $usersListQuery;
		$contactStatus['contactStatus'] = false;

		if($this->input->post('submit'))
		{
			$name = (string)$this->input->post('name', TRUE);
			$email = (string)$this->input->post('email', TRUE);
			$subject = (string)$this->input->post('subject', TRUE);
			$message = (string)$this->input->post('message', TRUE);
			
			if(empty($name) OR empty($email) OR empty($subject) OR empty($message))
			{
				show_error("Toate campurile sunt obligatorii. Te rog sa completezi toate campurile si sa incerci din nou.");
			}

			if(!valid_email($email))
			{
				show_error("Adresa de mail nu este valida.");
			}
			
			$config['protocol'] = 'sendmail';			
			$this->email->initialize($config);
			$this->email->from($email, $name);
			$this->email->to('radu.micu@radumicu.info');
			$this->email->subject('NoiseStats Contact - '.$subject);
			$this->email->message($message);
			$this->email->send();
			
			$contactStatus['contactStatus'] = true;
			
			$this->load->view('header');
			$this->load->view('contact',$contactStatus);
			$this->load->view('footer_widebar',$footerWidebarData);
			$this->load->view('footer');
		}
		else
		{
			$this->load->view('header');
			$this->load->view('contact',$contactStatus);
			$this->load->view('footer_widebar',$footerWidebarData);
			$this->load->view('footer');
		}
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/contact.php */