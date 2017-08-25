<?php

Class Page extends CI_Controller
{
	function __construct()
	{
    	parent::__construct();
    	if($this->session->userdata('admin_id'))
    	{
    		redirect(base_url('admin'));
    	}
	}

	public function index()
	{
		$this->load->view('page/login');
	}
	public function do_login()
	{
		$post = $this->input->post();
		$email = trim($post['username']);
		$password = trim(md5($post['password']));
		$this->load->model('page_m');
		$user = $this->page_m->login($email, $password);
		if($user)
		{
			$admin_id = $user[0]->user_id;
			$this->session->set_userdata('admin_id', $admin_id);
			redirect(base_url('admin'));
		}
		else
		{
			$this->session->set_flashdata('fail', "Invailid username or password.");
			redirect(base_url());
		}
	}
}