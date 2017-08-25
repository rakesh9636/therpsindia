<?php

Class Admin extends CI_Controller
{
	function __construct()
	{
    	parent::__construct();
    	$this->load->model('admin_m');
    	if(! $this->session->userdata('admin_id'))
    	{
    		redirect(base_url());
    	}
	}

	public function index()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/dashboard');
		$this->load->view('admin/footer');
	}
	public function view_vehicle()
	{
		$vehicle = $this->admin_m->get_vehicle();
		$this->load->view('admin/header');
		$this->load->view('admin/view_vehicle', ['vehicle'=>$vehicle]);
		$this->load->view('admin/footer');	
	}
	public function add_vehicle()
	{
		$route = $this->admin_m->get_route();
		$this->load->view('admin/header');
		$this->load->view('admin/add_vehicle', ['route'=>$route]);
		$this->load->view('admin/footer');
	}
	public function addd_vehicle()
	{
		$post = $this->input->post();
		$post['time'] = time();
		$this->admin_m->add_vihicle($post);
		$this->session->set_flashdata('success', "Vihivle Successfully Added.");
		redirect(base_url('admin/add_vehicle'));
	}
	public function add_driver()
	{
		$vehicle = $this->admin_m->get_vehicle();
		foreach($vehicle as $vehicle)
		{
			$vehicle_id = $vehicle->vehicle_id;
			$driver = $this->admin_m->check_driver($vehicle_id);
			if(empty($driver))
			{
				$free_vehicle[] = $vehicle;
			}
		}
		if(isset($free_vehicle))
		{
			$this->load->view('admin/header');	
			$this->load->view('admin/add_driver', ['vehicle'=>$free_vehicle]);
		}
		else
		{
			$this->load->view('admin/header');
			$this->load->view('admin/add_driver');
		}
		$this->load->view('admin/footer');
	}
	public function addd_driver()
	{
		$post = $this->input->post();
		$post['time'] = time();
		$this->admin_m->add_driver($post);
		redirect(base_url('admin/add_driver'));
	}
	public function add_route()
	{
		// $this->load->view('admin/header');
		$this->load->view('admin/add_route');
		// $this->load->view('admin/footer');
	}
	public function addd_route()
	{
		$post = $this->input->post();
		$name = $post['rl_name'];
		$check_route = $this->admin_m->check_route($name);
		if($check_route)
		{
			$this->session->set_flashdata('fail', $name.' is already exists.');
			redirect(base_url().'admin/add_route');
		}
		else
		{
			$this->admin_m->add_route($post);
			redirect(base_url().'admin/add_route');
		}
	}
	public function logout()
	{
		$this->session->unset_userdata('admin_id');
		redirect(base_url());
	}
}