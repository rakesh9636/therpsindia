<?php

Class Api_m extends CI_Model
{
	public function login($email, $password)
	{
		$query = $this->db
						->select('*')
						->from('user a')
						->where(['email'=>$email, 'password'=>$password])
						->get();
		return $query->result();
	}
	public function update_deviceid($deviceid, $user_id)
	{
		$data = array('deviceid'=>$deviceid);
		$this->db
				->where(['user_id'=>$user_id])
				->update('user', $data);
		return;
	}
	public function get_month()
	{
		$query = $this->db
						->select('*')
						->from('month')
						->order_by('sequence_id', 'asc')
						->get();
		return $query->result();
	}
	public function get_year($c_year)
	{
		$query = $this->db
						->select('*')
						->from('year')
						->where(['name'=>$c_year])
						->get();
		return $query->result();
	}
	public function exam_type()
	{
		$query = $this->db
						->select('*')
						->from('exam_type')
						->get();
		return $query->result();
	}
	public function get_user($user_id)
	{
		$query = $this->db
						->select('*')
						->from('user a')
						->where(['user_id'=>$user_id])
						->get();
		return $query->result();
	}
	public function get_user_detail($user_id)
	{
		$query = $this->db
						->select('*')
						->from('user_detail')
						->where(['user_id'=>$user_id])
						->get();
		return $query->result();
	}
	public function get_subject($class_id)
	{
		$query = $this->db
						->select('*')
						->from('subjects')
						->where(['class_id'=>$class_id])
						->get();
		return $query->result();
	}
	public function get_class($class_id)
	{
		$query = $this->db
						->select('*')
						->from('classes')
						->where(['class_id'=>$class_id])
						->get();
		return $query->result();
	}
	public function subject($subject_name, $class_id)
	{
		$query = $this->db
						->select('*')
						->from('subjects')
						->where(['name'=>$subject_name, 'class_id'=>$class_id])
						->get();
		return $query->result();
	}
	public function syllabus($class_id, $subject_id)
	{
		$query = $this->db
						->select('*')
						->from(' syllabus')
						->where(['class_id'=>$class_id, 'subject_id'=>$subject_id])
						->get();
		return $query->result();
	}
	public function month($month_id)
	{
		$query = $this->db
						->select('*')
						->from('month')
						->where(['month_id'=>$month_id])
						->get();
		return $query->result();
	}
	public function year($year_id)
	{
		$query = $this->db
						->select('*')
						->from('year')
						->where(['year_id'=>$year_id])
						->get();
		return $query->result();
	}
	public function get_event($date)
	{
		$query = $this->db
						->select('*')
						->from('leaves')
						->where(['event_date >'=>$date])
						->get();
		return $query->result();
	}
	public function class_fee($class_id)
	{
		$query = $this->db
						->select('*')
						->from('fees')
						->where(['class_id'=>$class_id])
						->get();
		return $query->result();
	}
	public function deposit($session, $user_id)
	{
		$query = $this->db
						->select('*')
						->from('student')
						->where(['user_id'=>$user_id, 'fees_paid_date >'=>$session])
						->get();
		return $query->result();
	}
	public function get_album_list()
	{
		$query = $this->otherdb
						->select('*')
						->from('gallery')
						->get();
		return $query->result();
	}
	public function get_gallery($album_id)
	{
		$query = $this->otherdb
						->select('*')
						->from('gallery')
						->where(['id'=>$album_id])
						->get();
		return $query->result();
	}
	public function get_attendance($user_id, $first_date, $last_date)
	{
		$data = array('student_user_id'=>$user_id, 'date_created >'=>$first_date, 'date_created <'=>$last_date);
		$query = $this->db
						->select('*')
						->from('attendance_report')
						->where($data)
						->get();
		return $query->result_array();
	}
	public function upcoming_event($data)
	{
		$query = $this->db
						->select('*')
						->from('leaves')
						->where(['event_date >'=>$data])
						->get();
		return $query->result();
	}
	public function upcoming_exam($data, $class_id)
	{
		$query = $this->db
						->select('*')
						->from('exam_time_table a')
						->where(['exam_date >'=>$data, 'class_id'=>$class_id])
						->get();
		return $query->result();
	}
	public function gett_subject($subject_id)
	{
		$query = $this->db
						->select('*')
						->from('subjects')
						->where(['subject_id'=>$subject_id])
						->get();
		return $query->result();
	}
	public function student_ans($user_id, $n_session)
	{
		$query = $this->db
						->select('*')
						->from('exam_ans_given_by_student')
						->where(['student_id'=>$user_id, 'date_created >'=>$n_session])
						->get();
		return $query->result();
	}
	public function get_question($ques_id)
	{
		$query = $this->db
						->select('*')
						->from('question_paper_detail')
						->where(['question_paper_detail_id'=>$ques_id])
						->get();
		return $query->result();
	}
	public function topic_date($class_id)
	{
		$query = $this->db
						->select('*')
						->from('topic')
						->where(['class_id'=>$class_id])
						->order_by('topic_id', 'desc')
						->limit(1)
						->get();
		return $query->result();
	}
	public function get_topic($last_topic_date)
	{
		$query = $this->db
						->select('*')
						->from('topic')
						->where(['date_created'=>$last_topic_date])
						->get();
		return $query->result();
	}
	public function get_year_attendance($user_id, $session)
	{
		$query = $this->db
						->select('*')
						->from('attendance_report')
						->where(['student_user_id'=>$user_id, 'date_created >'=>$session])
						->get();
		return $query->result_array();
	}
	public function get_month_attendance($user_id, $first_date, $last_date)
	{
		$data = array('student_user_id'=>$user_id, 'date_created >'=>$first_date, 'date_created <'=>$last_date);
		$query = $this->db
						->select('*')
						->from('attendance_report')
						->where($data)
						->get();
		return $query->result_array();
	}
	public function get_time_table($class_id, $date, $exam_type)
	{
		$data = array('class_id'=>$class_id, 'exam_date >'=>$date, 'exam_type'=>$exam_type);
		$query = $this->db
						->select('*')
						->from('exam_time_table')
						->where($data)
						->get();
		return $query->result();
	}
	public function get_subject_id($class_id, $subject)
	{
		$query = $this->db
						->select('*')
						->from('subjects')
						->where(['class_id'=>$class_id, 'name'=>$subject])
						->get();
		return $query->result();
	}
	public function get_exam_controller($class_id, $subject_id, $session)
	{
		$data = array('class_id'=>$class_id, 'subject_id'=>$subject_id, 'date_created >'=>$session);
		$query = $this->db
						->select('*')
						->from('exam_controller')
						->where($data)
						->get();
		return $query->result();
	}
	public function get_st_ans($user_id, $class_id, $subject_id, $ex_date)
	{
		$data = array('student_id'=>$user_id, 'class_id'=>$class_id, 'subject_id'=>$subject_id, 'date_created'=>$ex_date);
		$query = $this->db
						->select('*')
						->from('exam_ans_given_by_student')
						->where($data)
						->get();
		return $query->result();
	}
	public function get_question_paper_detail($question_paper_detail_id)
	{
		$query = $this->db
						->select('*')
						->from('question_paper_detail')
						->where(['question_paper_detail_id'=>$question_paper_detail_id])
						->get();
		return $query->result();
	}
	public function get_d_data($user_id)
	{
		$query = $this->db
						->select('*')
						->from('user a')
						->where(['user_id'=>$user_id])
						->join('driver b', 'b.driver_email=a.email')
						->join('vehicle c', 'c.vehicle_id=b.vehicle_id')
						->get();
		return $query->result();
	}
	public function get_vehicle($vehicle_id)
	{
		$query = $this->db
						->select('*')
						->from('vehicle')
						->where(['vehicle_id'=>$vehicle_id])
						->get();
		return $query->result();
	}
	public function get_route($route_id)
	{
		$query = $this->db
						->select('*')
						->from('route')
						->where(['route_id'=>$route_id])
						->get();
		return $query->result();
	}
	public function get_school_route()
	{
		$query = $this->db
						->select('*')
						->from('route')
						->where(['route_id'=>1])
						->get();
		return $query->result();
	}
	public function update_route($sod_id, $lat, $long)
	{
		$data = array('route_latitude'=>$lat, 'route_longitude'=>$long, 'route_status'=>1);
		$this->db
					->where(['route_id'=>$sod_id])
					->update('route', $data);
					return;
	}
	public function update_token($user, $token)
	{
		$array = array('token'=>$token);
		return $this->db
						->where(['user_id'=>$user])
						->update('user', $array);
	}
	public function get_notification()
	{
		$query = $this->db
						->select('*')
						->from('notification')
						->order_by('notification_id', 'DESC')
						->get();
		return $query->result();
	}
	public function v_student($vehicle_id)
	{
		$query = $this->db
						->select('*')
						->from('user_detail a')
						->where(['vehicle_id'=>$vehicle_id])
						->join('user b', 'b.user_id=a.user_id')
						->get();
		return $query->result();
	}
	public function get_drop_point($drop_point)
	{
		$query = $this->db
						->select('*')
						->from('drop_point')
						->where(['drop_point_id'=>$drop_point])
						->get();
		return $query->result();
	}
	public function get_route_drop_point($route_id)
	{
		$query = $this->db
						->select('*')
						->from('drop_point')
						->where(['route_id'=>$route_id, 'status'=>0])
						->get();
		return $query->result();
	}
	public function update_drop_point($location_id, $lat, $long)
	{
		$data = array('drop_point_lat'=>$lat, 'drop_point_long'=>$long, 'status'=>1);
		$this->db
				->where(['drop_point_id'=>$location_id])
				->update('drop_point', $data);
				return;
	}
	public function set_ride_status($user_id, $route_from)
	{
		$data = array('driver_id'=>$user_id, 'route_from'=>$route_from);
		return $this->db->insert('ride_status', $data);
	}
	public function get_ride_id($user_id)
	{
		$query = $this->db
						->select('*')
						->from('ride_status')
						->where(['driver_id'=>$user_id])
						->order_by('ride_id', 'DESC')
						->limit(1)
						->get();
		return $query->result();
	}
	public function set_ride_location($user_id, $lat, $long, $started, $speed, $ride_id)
	{
		$data = array('driver_id'=>$user_id, 'latitude'=>$lat, 'longitude'=>$long, 'started'=>$started, 'speed'=>$speed, 'ride_id'=>$ride_id);

		return $this->db->insert('ride_location', $data);
	}
	public function update_ride_location($user_id, $lat, $long, $started, $speed, $ride_id, $date)
	{
		$data = array('latitude'=>$lat, 'longitude'=>$long, 'started'=>$started, 'speed'=>$speed, 'ride_id'=>$ride_id, 'time'=>$date);
		$this->db
				->where(['driver_id'=>$user_id])
				->update('ride_location', $data);
		return;
	}
	public function get_ride($ride_id)
	{
		$query = $this->db
						->select('*')
						->from('ride_status')
						->where(['ride_id'=>$ride_id])
						->get();
		return $query->result();
	}
	public function get_driver($vehicle_id)
	{
		$query = $this->db
						->select('*')
						->from('driver a')
						->where(['vehicle_id'=>$vehicle_id])
						->join('user b', 'b.email=driver_email')
						->get();
		return $query->result();
	}
	public function get_ride_location($driver_id)
	{
		$query = $this->db
						->select('*')
						->from('ride_location')
						->where(['driver_id'=>$driver_id])
						->order_by('rl_id', 'DESC')
						->limit(1)
						->get();
		return $query->result();
	}
	
	// this function is use for getting year id 
	public function get_current_year_id($year)
	{
		$query = $this->db
						->select('*')
						->from('year')
						->where(['name'=>$year])
						->get();
		return $query->row();
	}
	
	// this function is use for getting current seassion id 
	public function get_current_session_id($current_year_id)
	{
		$query = $this->db
						->select('*')
						->from('session')
						->where(['to_year_id'=>$current_year_id])
						->get();
		return $query->row();
	}
	
	// this function is use for getting student fee info
	public function student_fee_info($user_id,$current_session_id, $class_id)
	{
		$query = $this->db
						->select('*')
						->from('student_fee')
						->where(['student_id'=>$user_id])
						->where(['session_id'=>$current_session_id])
						->where(['class_id'=>$class_id])
						->get();
		return $query->row();
	}
	
	// this function is use for getting student fee all transection
	public function student_fee_transection($sf_id)
	{
		$query = $this->db
						->select('*')
						->from('transection')
						->where(['sf_id'=>$sf_id])
						->get();
		return $query->result();
	}
}