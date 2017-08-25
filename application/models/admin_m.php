<?php

Class Admin_m extends CI_Model
{
	public function add_vihicle($post)
	{
		return $this->db->insert('vehicle', $post);
	}
	public function get_vehicle()
	{
		$query = $this->db
						->select('*')
						->from('vehicle')
						->get();
		return $query->result();
	}
	public function add_driver($post)
	{
		return $this->db->insert('driver', $post);
	}
	public function check_driver($vehicle_id)
	{
		$query = $this->db
						->select('*')
						->from('driver')
						->where(['vehicle_id'=>$vehicle_id])
						->get();
		return $query->result();
	}
	public function check_route($name)
	{
		$query = $this->db
						->select('*')
						->from('route_location')
						->where(['rl_name'=>$name])
						->get();
		return $query->result();
	}
	public function add_route($post)
	{
		return $this->db->insert('route_location', $post);
	}
	public function get_route()
	{
		$query = $this->db
						->select('*')
						->from('route_location')
						->get();
		return $query->result();
	}
	public function get_driver($v_id)
	{
		$query = $this->db
						->select('*')
						->from('driver')
						->where(['vehicle_id'=>$v_id])
						->get();
		return $query->result();
	}
	public function get_rl_id($rl_id)
	{
		$query = $this->db
						->select('*')
						->from('route_location')
						->where(['rl_id'=>$rl_id])
						->get();
		return $query->result();
	}
}