<?php

Class Page_m extends CI_Model
{
	public function login($email, $password)
	{
		$query = $this->db
						->select('*')
						->from('user')
						->where(['email'=>$email, 'password'=>$password, 'admin_type'=>1])
						->get();
		return $query->result();
	}
}