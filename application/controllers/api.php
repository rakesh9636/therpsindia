<?php

Class Api extends CI_Controller
{
	function __construct()
	{
    	parent::__construct();
    	$this->load->model('api_m');
    	date_default_timezone_set("Asia/Kolkata");
    	$this->load->helper('date');
	}
	public function login()
	{
		$post = $this->input->post();
		$email = trim($post['email']);
		$password = trim(md5($post['password']));
		$deviceid = $post['deviceid'];

		$user = $this->api_m->login($email, $password);
		if($user)
		{
			$user_id = $user[0]->user_id;
			$role = $user[0]->admin_type;
			if($role == 4 || $role == 5)
			{
				if($role == 4 )
				{
					$user_data = $this->api_m->get_user_detail($user_id);
				$result = array('user_id'=>$user[0]->user_id, 'name'=>$user_data[0]->fname.' '.$user_data[0]->lname, 'email'=>$email, 'role'=>$role, 'image'=>'http://www.therpsindia.com/admin/admin_assets/profile_image/'.$user_data[0]->profile_image);
				}
				elseif($role == 5 )
				{
					$user_data = $this->api_m->get_d_data($user_id);
				$result = array('user_id'=>$user[0]->user_id, 'name'=>$user_data[0]->driver_name, 'email'=>$email, 'role'=>$role, 'image'=>'http://www.therpsindia.com/app_admin/assets/images/'.$user_data[0]->profile_pic);
				}
				$this->api_m->update_deviceid($deviceid, $user_id);
				$data = array('status'=>"1", 'message'=>"success", 'data'=>$result);
			}
			else
			{
				$data = array('status'=>0, 'message'=>"fail");
			}
		}
		else
		{
			$data = array('status'=>0, 'message'=>"fail");
		}
			$output = json_encode($data);
			echo $output;
	}
	public function month_year()
	{
		$time = time();
		$date = unix_to_human($time);
		$current_year = date('Y', strtotime($date));
		$c_month = date('m', strtotime($date));
		$cc_month = explode('0', $c_month);
		$count = count($cc_month);
		if($count == 1)
		{
			$month_id = $cc_month[0];
		}
		else
		{
			$month_id = $cc_month[1];
		}
		$month = $this->api_m->get_month();
		// $month_id = 4;
		foreach($month as $month)
		{
			if($month_id > 3)
			{
				$t_month_id = $month_id+1;
				if($month->month_id > 3 && $month->month_id < $t_month_id)
				{
					$c_year = $current_year;
					$year = $this->api_m->get_year($c_year);
					$result[] = array('month_id'=>$month->month_id, 'month_name'=>$month->name, 'year_id'=>$year[0]->year_id, 'year_name'=>$year[0]->name);
				}
				// else
				// {
				// 	$c_year = $current_year+1;
				// 	$year = $this->api_m->get_year($c_year);
				// 	$result[] = array('month_id'=>$month->month_id, 'month_name'=>$month->name, 'year_id'=>$year[0]->year_id, 'year_name'=>$year[0]->name);
				// }
			}
			else
			{
				$t_month_id = $month_id+1;
				if($month->month_id < 4 && $month->month_id < $t_month_id)
				{
					$c_year = $current_year;
					$year = $this->api_m->get_year($c_year);
					$result[] = array('month_id'=>$month->month_id, 'month_name'=>$month->name, 'year_id'=>$year[0]->year_id, 'year_name'=>$year[0]->name);
				}
				elseif($month->month_id > 3)
				{
					$c_year = $current_year-1;
					$year = $this->api_m->get_year($c_year);
					$result[] = array('month_id'=>$month->month_id, 'month_name'=>$month->name, 'year_id'=>$year[0]->year_id, 'year_name'=>$year[0]->name);
				}
			}
		}
			$output = array('status'=>"1", 'message'=>"success", 'data'=>$result);
			echo json_encode($output);
	}
	public function examlist()
	{
		$exam = $this->api_m->exam_type();
		if($exam)
		{
			foreach($exam as $exam)
			{
				$result[] = array('exam_name'=>$exam->et_name);
			}
			$output = array('status'=>"1", 'message'=>"success", 'data'=>$result);
		}
		else
		{
			$output = array('status'=>0, 'message'=>"fail");
		}
		echo json_encode($output);
	}
	public function examtype()
	{
		$post = $this->input->post();
		$user_id = $post['user_id'];
		if($user_id)
		{
			$user = $this->api_m->get_user($user_id);
			$user_detail = $this->api_m->get_user_detail($user_id);
			$class_id = $user_detail[0]->class;
			$subject = $this->api_m->get_subject($class_id);
			foreach($subject as $subject)
			{
				$result[] = array('exam_name'=>$subject->name);
			}
			$output = array('status'=>"1", 'message'=>"success", 'data'=>$result);
		}
		else
		{
			$output = array('status'=>0, 'message'=>"fail");
		}
		echo json_encode($output);
	}
	public function subject()
	{
		$post = $this->input->post();
		$user_id = $post['user_id'];
		if($user_id)
		{
			$user = $this->api_m->get_user($user_id);
			$user_detail = $this->api_m->get_user_detail($user_id);
			$class_id = $user_detail[0]->class;
			$subject = $this->api_m->get_subject($class_id);
			foreach($subject as $subject)
			{
				$result[] = array('id'=>$subject->subject_id, 'subject_name'=>$subject->name);
			}
			$output = array('status'=>"1", 'message'=>"success", 'data'=>$result);
		}
		else
		{
			$output = array('status'=>0, 'message'=>"fail");
		}
		echo json_encode($output);
	}
	public function profile()
	{
		$post = $this->input->post();
		$user_id = $post['user_id'];
		if($user_id)
		{
			$user = $this->api_m->get_user($user_id);
			$user_detail = $this->api_m->get_user_detail($user_id);
			$class_id = $user_detail[0]->class;
			$class = $this->api_m->get_class($class_id);
			$result = array('name'=>$user_detail[0]->fname.' '.$user_detail[0]->lname, 'father_name'=>$user_detail[0]->fathers_name, 'address'=>$user_detail[0]->address, 'dob'=>$user_detail[0]->dob, 'class'=>$class[0]->name, 'email_id'=>$user[0]->email, 'contact_no'=>$user_detail[0]->whatsapp_no, 'whatsapp_no'=>$user_detail[0]->whatsapp_no, 'pincode'=>$user_detail[0]->pin_code, 'previous_school'=>$user_detail[0]->pre_school, 'previous_class'=>$user_detail[0]->pre_class, 'percentage'=>$user_detail[0]->percentage, 'previous_roll_number'=>$user_detail[0]->pre_roll_no, 'date_of_admission'=>$user_detail[0]->admission_date, 'img_url'=>"http://www.therpsindia.com/admin/admin_assets/profile_image/".$user_detail[0]->profile_image);
			$output = array('status'=>"1", 'message'=>"success", 'data'=>$result);
		}
		else
		{
			$output = array('status'=>0, 'message'=>"fail");
		}
		echo json_encode($output);
	}
	public function syllabus()
	{
		$post = $this->input->post();
		
		if($post['user_id'] && isset($post['subject']))
		{
			$user_id = $post['user_id'];
			$subject_name = $post['subject'];

			$user = $this->api_m->get_user($user_id);
			$user_detail = $this->api_m->get_user_detail($user_id);
			$class_id = $user_detail[0]->class;
			$subject = $this->api_m->subject($subject_name, $class_id);
			$subject_id = $subject[0]->subject_id;
			$syllabus = $this->api_m->syllabus($class_id, $subject_id);
			if($syllabus)
			{
				foreach($syllabus as $syllabus)
				{
					$count = @++$count;
					$result[] = array('id'=>$count, 'lesson_name'=>$syllabus->lession, 'lesson_content'=>$syllabus->lession);
				}	
				$output = array('status'=>"1", 'message'=>"success", 'data'=>$result);
			}
			else
			{
				$output = array('status'=>0, 'message'=>"No Data Found");
			}
		}
		else
		{
			$output = array('status'=>0, 'message'=>"fail");
		}
		echo json_encode($output);
	}
	public function event()
	{
		$post = $this->input->post();
		if(isset($post['user_id']) && isset($post['month_id']) && isset($post['year_id']))
		{
			$user_id = $post['user_id'];
			$month_id = $post['month_id'];
			$year_id = $post['year_id'];
			$month = $this->api_m->month($month_id);
			$year = $this->api_m->year($year_id);
			if($month_id > 9)
			{
				$monthid = $month_id;
			}
			else
			{
				$monthid = '0'.$month_id;
			}
			$date = $year[0]->name.'-'.$monthid.'-'.'00';
			$last_date = $year[0]->name.'-'.$monthid.'-'.'32';
			$event = $this->api_m->get_event($date);
			if($event)
			{
				foreach($event as $event)
					{
						if($date < $event->event_date && $last_date > $event->event_date)
						{
							if($event->event_id == 1)
							{	$count = @++$count;
								$event_date = date('d-M-Y', strtotime($event->event_date));
								$events[] = array('event_id'=>$count, 'event_img'=>"http://www.therpsindia.com/admin/admin_assets/events_images/".$event->image, 'event_name'=>$event->name, 'event_date'=>$event_date);
							}
							elseif($event->event_id == 2)
							{
								$count = @++$count;
								$event_date = date('d-M-Y', strtotime($event->event_date));
								$leaves[] = array('leave_id'=>$count, 'leave_name'=>$event->name, 'leave_date'=>$event_date);
							}
						}
					}
					if(isset($events))
					{
						$result['events'] = $events;
					}
					if(isset($leaves))
					{
						$result['leaves'] = $leaves;
					}
					$output = array('status'=>"1", 'message'=>"success", 'data'=>$result);
			}
			else
			{
				$output = array('status'=>0, 'message'=>"fail");
			}
		}
		else
		{
			$output = array('status'=>0, 'message'=>"fail");
		}
		echo json_encode($output);
	}
	public function fee_detail()
	{
		$post = $this->input->post();
		if(isset($post['user_id']))
		{
			$user_id = $post['user_id'];
			$user_detail = $this->api_m->get_user_detail($user_id);
			$class_id = $user_detail[0]->class;
			$class_f = $this->api_m->class_fee($class_id);
			$class_fee = $class_f[0]->amount;

			$time = time();
			$date = unix_to_human($time);
			$current_year = date('Y', strtotime($date));
			$c_month = date('m', strtotime($date));
			$cc_month = explode('0', $c_month);
			$count = count($cc_month);
			if($count == 1)
			{
				$month_id = $cc_month[0];
			}
			else
			{
				$month_id = $cc_month[1];
			}
			if($month_id > 3)
			{
				$session = $current_year.'-04-00 00:00:00';
			}
			else
			{
				$yr = $current_year-1;
				$session = $yr.'-04-00 00:00:00';
			}
			$deposit = $this->api_m->deposit($session, $user_id);
			if($deposit)
			{
				foreach($deposit as $deposit)
				{
					$count = @++$count;
					$date = date('d-M-Y', strtotime($deposit->fees_paid_date));
					$result[] = array('id'=>$count, 'pay_for'=>$deposit->fees_paid_for, 'date'=>$date, 'amount'=>$deposit->fees_paid);
					$total_paid[] = $deposit->fees_paid;
				}
				$paid = array_sum($total_paid);
				$dew = $class_fee-$paid;
				$data = array('total_fees'=>$class_fee, 'total_dew'=>$dew, 'deposit_details'=>$result);
				$output = array('status'=>"1", 'message'=>"success", 'data'=>$data);

			}
			else
			{
				$output = array('status'=>0, 'message'=>"fail");
			}
		}
		else
		{
			$output = array('status'=>0, 'message'=>"fail");
		}
		echo json_encode($output);
	}
	public function get_month_for_leave_event()
	{
		$post = $this->input->post();
		$time = time();
		$date = unix_to_human($time);
		$current_year = date('Y', strtotime($date));
		$c_month = date('m', strtotime($date));
		$cc_month = explode('0', $c_month);
		$count = count($cc_month);
		if($count == 1)
		{
			$month_id = $cc_month[0];
		}
		else
		{
			$month_id = $cc_month[1];
		}
		$month = $this->api_m->get_month();
		$january = $month;
		foreach($month as $month)
		{
			if($month_id < 12)
			{
				$next_month = $month_id+1;
				$c_year = $current_year;
				$year = $this->api_m->get_year($c_year);
				if($month->month_id == $month_id || $month->month_id == $next_month)
				{
					$result[] = array('month_id'=>$month->month_id, 'month_name'=>$month->name, 'year_id'=>$year[0]->year_id, 'year_name'=>$year[0]->name);
				}

			}
			else
			{
				if($month_id == 12)
				{
					if($month->month_id == 12)
					{
						$c_year = $current_year;
						$year = $this->api_m->get_year($c_year);
						$result[] = array('month_id'=>$month->month_id, 'month_name'=>$month->name, 'year_id'=>$year[0]->year_id, 'year_name'=>$year[0]->name);

						$c_year = $current_year+1;
						$year = $this->api_m->get_year($c_year);
						$result[] = array('month_id'=>$january[9]->month_id, 'month_name'=>$january[9]->name, 'year_id'=>$year[0]->year_id, 'year_name'=>$year[0]->name);
					}
				}
			}
		}
		$output = array('status'=>"1", 'message'=>"success", 'data'=>$result);
		echo json_encode($output);
	}
	public function album_list()
	{
		$this->otherdb = $this->load->database('otherdb', TRUE);
		$data = $this->api_m->get_album_list();
		if($data)
		{
			foreach($data as $data)
			{
				$count = @++$count;
				$pic = $data->image;
				$pics = explode(',', $pic);
				$image = $pics[0];

				$total_pic = count($pics);
				$result[] = array('album_id'=>$data->id, 'album_title'=>$data->title, 'album_cover_photo'=>"http://www.therpsindia.com/site_panel/uploads/gallery/".$image, 'pic_count'=>$total_pic);

			}
			$output = array('status'=>"1", 'message'=>"successfully", 'data'=>$result);
		}
		else
		{
			$output = array('status'=>0, 'message'=>"fail");	
		}
		echo json_encode($output);
	}
	public function gallery_list()
	{
		$post = $this->input->post();
		$user_id = $post['user_id'];
		$album_id = $post['album_id'];

		$this->otherdb = $this->load->database('otherdb', TRUE);
		$gallery = $this->api_m->get_gallery($album_id);
		if($gallery)
		{
			$title = $gallery[0]->title;
			foreach($gallery as $gallery)
			{
				$count = @++$count;
				$gallery_pic_id = $count;
				$gallery_pic_name = $gallery->title;
				$pic = $gallery->image;
				$pics = explode(',', $pic);

				foreach($pics as $pics)
				{
					$result01[] = array('gallery_pic_id'=>$gallery_pic_id, 'gallery_pic_name'=>$gallery_pic_name, 'gallery_pic_url'=>"http://www.therpsindia.com/site_panel/uploads/gallery/".$pics);
				}
				$date = date('d-M-Y', strtotime($gallery->date));
				$result02[] = array('gallery_date'=>$date, 'gallery_pics'=>$result01);
			}
			$output = array('status'=>"1", 'message'=>"successfully", 'album_title'=>$title, 'data'=>$result02);
		}
		else
		{
			$output = array('status'=>0, 'message'=>"fail");	
		}
		echo json_encode($output);
		
	}
	public function dashboard()
	{
		$post = $this->input->post();
		$user_id = $post['user_id'];
		$time = time();
		$date = unix_to_human($time);
		$c_date = date('d', strtotime($date));
		$c_month = date('m', strtotime($date));
		$c_year = date('Y', strtotime($date));
		$first_date = $c_year.'-'.$c_month.'-00';
		$last_date = $c_year.'-'.$c_month.'-31';
		$data = date('Y-m-d', strtotime($date));
		// $attendance = $this->api_m->get_attendance($user_id, $first_date, $last_date);
		$attendance = $this->api_m->get_month_attendance($user_id, $first_date, $last_date);
		
		if($attendance)
		{
		foreach($attendance as $attendance)
		{
				$att_date = $attendance['date_created'];

					$day = $attendance;

					for($x=1;$x<10;$x++)
					{
						if(isset($day['0'.$x]))
						{
							$result[] = $day['0'.$x];
						}
					}
					for($y=0;$y<10;$y++)
					{
						if(isset($day['1'.$y]))
						{
							$result[] = $day['1'.$y];
						}
					}
					for($z=0;$z<10;$z++)
					{
						if(isset($day['2'.$z]))
						{
							$result[] = $day['2'.$z];
						}
					}
					for($w=0;$w<2;$w++)
					{
						if(isset($day['3'.$w]))
						{
							$result[] = $day['3'.$w];
						}
					}
		}
		}

		if(isset($result))
		{
			foreach($result as $result)
			{
				if($result == 'yes' || $result == 'no')
				{
					$final = @++$count;  //Total working Days of School//
					$working_day[] = $result;  
				}
			}
			foreach($working_day as $working_day)
			{
				if($working_day == 'yes')
				{
					$present[] = $working_day;
				}
			}
			$st_present = count($present);
			$final_att = $st_present.'/'.$final; //Final Attendence Report
		}
		else
		{
			$final = 0;
			$st_present = 0;
			$final_att = '0/0'; //Final Attendence Report
		}

		/////////////////////////////////    Fee Detail     ////////////////////////////////

		if($user_id)
		{
			$user_id = $post['user_id'];
			$user_detail = $this->api_m->get_user_detail($user_id);
			$class_id = $user_detail[0]->class;
			$class_f = $this->api_m->class_fee($class_id);
			$class_fee = $class_f[0]->amount;

			$time = time();
			$date = unix_to_human($time);
			$current_year = date('Y', strtotime($date));
			$c_month = date('m', strtotime($date));
			$cc_month = explode('0', $c_month);
			$count = count($cc_month);
			if($count == 1)
			{
				$month_id = $cc_month[0];
			}
			else
			{
				$month_id = $cc_month[1];
			}
			if($month_id > 3)
			{
				$session = $current_year.'-04-00 00:00:00';
			}
			else
			{
				$yr = $current_year-1;
				$session = $yr.'-04-00 00:00:00';
			}
			$deposit = $this->api_m->deposit($session, $user_id);
			if($deposit)
			{
				foreach($deposit as $deposit)
				{
					$count = @++$count;
					$date = date('d-M-Y', strtotime($deposit->fees_paid_date));
					$result[] = array('id'=>$count, 'pay_for'=>$deposit->fees_paid_for, 'date'=>$date, 'amount'=>$deposit->fees_paid);
					$total_paid[] = $deposit->fees_paid;
				}
				$paid = array_sum($total_paid);
				$dew = $class_fee-$paid; // Fee Detail
				// $data = array('total_fees'=>$class_fee, 'total_dew'=>$dew, 'deposit_details'=>$result);
				// $output = array('status'=>"1", 'message'=>"success", 'data'=>$data);

			}
			else
			{
				$dew = "No Data"; // Fee Detail
			}
		}
		$upcoming_event = $this->api_m->upcoming_event($data);
		if($upcoming_event)
		{
			$event_result = $upcoming_event[0]->name;	//	upcoming_event
			$event_dt = $upcoming_event[0]->event_date;
			$event_date = date('d M Y', strtotime($event_dt));
		}
		else
		{
			$event_result = 'No Data';	//	upcoming_event
			$event_date = 'No Data';
		}
		$upcoming_exam = $this->api_m->upcoming_exam($data, $class_id);
		if($upcoming_exam)
		{
			$subject_id = $upcoming_exam[0]->subject_id;
			$subject = $this->api_m->gett_subject($subject_id);

			$u_exam = $subject[0]->name;			//	Exam 
			$up_exam_date = $upcoming_exam[0]->exam_date;
			$u_exam_date = date('d M Y', strtotime($up_exam_date));	//	Exam Date

		}
		else
		{
			$u_exam = 'No Data';	//	Exam
			$u_exam_date = 'No Data';	//	//	Exam Date
		}

		if($st_present | $final)
		{
			$total_school_working_days = $final;
			$total_attendance_of_student = $st_present;
		}
		else
		{
			$total_school_working_days = 100;
			$total_attendance_of_student = 0;
		}

		////////////////////////////////// 		Exam Marks		///////////////////////////////////

		$n_session = date('Y-m-d', strtotime($session));
		$student_ans = $this->api_m->student_ans($user_id, $n_session);
		if($student_ans)
		{
			foreach($student_ans as $student_ans)
			{
				$total_ques = @++$count;
				$st_ans = $student_ans->ans;
				$ques_id = $student_ans->question_paper_detail_id;

				$question = $this->api_m->get_question($ques_id);
				$right_ans = $question[0]->ans;

				if($st_ans == $right_ans)
				{
					$r_answer[] = $st_ans;
				}
			}
			$total_marks_of_all_exam = $total_ques;
			$total_marks_of_student_for_all_exam = count($r_answer);
		}
		else
		{
			$total_marks_of_all_exam = 100;
			$total_marks_of_student_for_all_exam = 0;
		}
		//////////////////////////////		Today Topic 	/////////////////////////////////

		$topic_date = $this->api_m->topic_date($class_id);
		if($topic_date)
		{
			$last_topic_date = $topic_date[0]->date_created;
			$topic = $this->api_m->get_topic($last_topic_date);
			foreach($topic as $topic)
			{
				$cnt = @++$count;
				$today_topic[] = array('sr_no'=>''.$count.'', 'subject'=>$topic->subject, 'topic'=>$topic->topic);
			}
		}
		else
		{
			$today_topic[] = array('sr_no'=>'1', 'subject'=>"No", 'topic'=>"Data");
		}
		
		$result = array('attendance_of_month'=>$final_att, 'fees_updates'=>''.$dew.'', 'upcoming_event'=>$event_result, 'upcoming_event_date'=>$event_date, 'upcoming_exam'=>$u_exam, 'upcoming_exam_date'=>$u_exam_date, 'total_school_working_days'=>''.$total_school_working_days.'', 'total_attendance_of_student'=>''.$total_attendance_of_student.'', 'total_marks_of_all_exam'=>''.$total_marks_of_all_exam.'', 'total_marks_of_student_for_all_exam'=>''.$total_attendance_of_student.'', 'today_topic'=>$today_topic);

		$output = array('status'=>1, 'message'=>"success", 'data'=>$result);
		echo json_encode($output);

	}
	public function attendance()
	{
			$post = $this->input->post();
			$user_id = $post['user_id'];
			$user_detail = $this->api_m->get_user_detail($user_id);
			$class_id = $user_detail[0]->class;
			$class_f = $this->api_m->class_fee($class_id);
			$class_fee = $class_f[0]->amount;

			$time = time();
			$date = unix_to_human($time);
			$current_year = date('Y', strtotime($date));
			$c_month = date('m', strtotime($date));
			$cc_month = explode('0', $c_month);
			$count = count($cc_month);
			if($count == 1)
			{
				$month_id = $cc_month[0];
			}
			else
			{
				$month_id = $cc_month[1];
			}
			if($month_id > 3)
			{
				$session = $current_year.'-04-00';
			}
			else
			{
				$yr = $current_year-1;
				$session = $yr.'-04-00';
			}

			$attendance = $this->api_m->get_year_attendance($user_id, $session);

		if($attendance)
		{
		foreach($attendance as $attendance)
		{
					$day = $attendance;
					for($x=1;$x<10;$x++)
					{
						if(isset($day['0'.$x]))
						{
							$result[] = $day['0'.$x];
						}
					}
					for($y=0;$y<10;$y++)
					{
						if(isset($day['1'.$y]))
						{
							$result[] = $day['1'.$y];
						}
					}
					for($z=0;$z<10;$z++)
					{
						if(isset($day['2'.$z]))
						{
							$result[] = $day['2'.$z];
						}
					}
					for($w=0;$w<2;$w++)
					{
						if(isset($day['3'.$w]))
						{
							$result[] = $day['3'.$w];
						}
					}
			}
		}
			if(isset($result))
		{
			foreach($result as $result)
			{
				if($result == 'yes' || $result == 'no')
				{
					$final = @++$count;  //Total working Days of School//
					$working_day[] = $result;  
				}
			}
			foreach($working_day as $working_day)
			{
				if($working_day == 'yes')
				{
					$present[] = $working_day;
				}
			}
			$st_present = count($present);
			$total_days_in_this_year = $final;
			$total_attendance_of_this_year = $st_present;
		}
		else
		{
			$total_days_in_this_year = 100;
			$total_attendance_of_this_year = 0;
		}

		////////////////////////////////	Month Report ///////////////////////////

		$month_id = $post['month_id'];
		$year_id = $post['year_id'];
		$month = $this->api_m->month($month_id);
		$year = $this->api_m->year($year_id);
		$first_date = $year[0]->name.'-'.$month[0]->month_id.'-00';

		$last_date = $year[0]->name.'-'.$month[0]->month_id.'-31';
		$data = date('Y-m-d', strtotime($date));
		$attendance01 = $this->api_m->get_month_attendance($user_id, $first_date, $last_date);

		
		if($attendance01)
		{
		foreach($attendance01 as $attendance01)
		{

				// $att_date = $attendance01['date_created'];
				// if(($att_date == $first_date || $att_date > $first_date) && ($att_date == $last_date || $att_date < $last_date))
				// {
					$day = $attendance01;
					for($x=1;$x<10;$x++)
					{
						if(isset($day['0'.$x]))
						{
							$result01[] = $day['0'.$x];

						}
					}
					for($y=0;$y<10;$y++)
					{
						if(isset($day['1'.$y]))
						{
							$result01[] = $day['1'.$y];
						}
					}
					for($z=0;$z<10;$z++)
					{
						if(isset($day['2'.$z]))
						{
							$result01[] = $day['2'.$z];
						}
					}
					for($w=0;$w<2;$w++)
					{
						if(isset($day['3'.$w]))
						{
							$result01[] = $day['3'.$w];
						}
					}
				// }

		}
		}
		if(isset($result01))
		{
			foreach($result01 as $result01)
			{
				if($result01 == 'yes' || $result01 == 'no')
				{
					// $final01 = $result01;  //Total working Days of School//
					$working_day01[] = $result01;  
				}
			}
			$final01 = count($working_day01);
			foreach($working_day01 as $working_day01)
			{
				if($working_day01 == 'yes')
				{
					$present01[] = $working_day01;
				}
			}
			$st_present01 = count($present01);
			// $final_att = $st_present01.'/'.$final01; //Final Attendence Report

			$total_days_in_this_month = $final01;
			$total_attendance_of_this_month = $st_present01;
			$total_absent_of_this_month = $final01-$st_present01;
		}
		else
		{
			$total_days_in_this_month = 0;	//	Month report
			$total_attendance_of_this_month = 0;
			$total_absent_of_this_month = 0;
		}

		/////////////////////////////		Reports			/////////////////////////////

		$attendance02 = $this->api_m->get_month_attendance($user_id, $first_date, $last_date);

		$attendance03 =	$attendance02;
		foreach($attendance03 as $attendance03)
		{
			for($x=1; $x<10; $x++)
			{
				if(isset($attendance03['0'.$x]))
				{
					$date = $year[0]->name.'/'.$month[0]->month_id.'/0'.$x;
					if($attendance03['0'.$x] == 'yes')
					{
						$record[] = array('date'=>$date, 'attendance_type'=>'P');
					}
					elseif($attendance03['0'.$x] == 'no')
					{
						$record[] = array('date'=>$date, 'attendance_type'=>'A');
					}
					
				}
			}
			for($y=0; $y<10; $y++)
			{
				if(isset($attendance03['1'.$y]))
				{
					$date = $year[0]->name.'/'.$month[0]->month_id.'/1'.$y;
					if($attendance03['1'.$y] == 'yes')
					{
						$record[] = array('date'=>$date, 'attendance_type'=>'P');
					}
					elseif($attendance03['1'.$y] == 'no')
					{
						$record[] = array('date'=>$date, 'attendance_type'=>'A');
					}
					
				}
			}
			for($z=0; $z<10; $z++)
			{
				if(isset($attendance03['2'.$z]))
				{
					$date = $year[0]->name.'/'.$month[0]->month_id.'/2'.$z;
					if($attendance03['2'.$z] == 'yes')
					{
						$record[] = array('date'=>$date, 'attendance_type'=>'P');
					}
					elseif($attendance03['2'.$z] == 'no')
					{
						$record[] = array('date'=>$date, 'attendance_type'=>'A');
					}
					
				}
			}
			for($w=0; $w<3; $w++)
			{
				if(isset($attendance03['3'.$w]))
				{
					$date = $year[0]->name.'/'.$month[0]->month_id.'/3'.$w;
					if($attendance03['3'.$w] == 'yes')
					{
						$record[] = array('date'=>$date, 'attendance_type'=>'P');
					}
					elseif($attendance03['3'.$w] == 'no')
					{
						$record[] = array('date'=>$date, 'attendance_type'=>'A');
					}
					
				}
			}
		}

		if(empty($record))
		{
			$record[] = array('date'=>"No Data Found", 'attendance_type'=>'.');
		}

		////////////////////////////	Yearly Report 		/////////////////////////

		$time = time();
		$time = unix_to_human($time);
		$month = date('m', strtotime($time));
		$year = date('Y', strtotime($time));

		if($month > 3)
		{
			for($a=4; $a<$month+1; $a++)
			{
				// $a = '4';
				$month_id = $a;
				$month_name = $this->api_m->month($month_id);
				$month_name = $month_name[0]->name;
				$first_date = $year.'-'.$a.'-00';
				$last_date = $year.'-'.$a.'-31';

				$yr_att = $this->api_m->get_month_attendance($user_id, $first_date, $last_date);
				if($yr_att)
				{
					$yr_att = $yr_att[0];
					for($w=1; $w<10; $w++)
					{
						if($yr_att['0'.$w] == 'yes')
						{
							$result03[] = $yr_att['0'.$w];
						}
						elseif($yr_att['0'.$w] == 'no')
						{
							$result03[] = $yr_att['0'.$w];
						}
					}
					for($x=0; $x<10; $x++)
					{
						if($yr_att['1'.$x] == 'yes')
						{
							$result03[] = $yr_att['1'.$x];
						}
						elseif($yr_att['1'.$x] == 'no')
						{
							$result03[] = $yr_att['1'.$x];
						}
					}
					for($y=0; $y<10; $y++)
					{
						if($yr_att['2'.$y] == 'yes')
						{
							$result03[] = $yr_att['2'.$y];
						}
						elseif($yr_att['2'.$y] == 'no')
						{
							$result03[] = $yr_att['2'.$y];
						}
					}
					for($z=0; $z<2; $z++)
					{
						if($yr_att['3'.$z] == 'yes')
						{
							$result03[] = $yr_att['3'.$z];
						}
						elseif($yr_att['3'.$z] == 'no')
						{
							$result03[] = $yr_att['3'.$z];
						}
					}
				}
				if(isset($result03))
				{
					foreach($result03 as $result03)
					{
						if($result03 == 'yes')
						{
							$yes[] = $result03;
						}
						elseif($result03 == 'no')
						{
							$no[] = $result03;
						}
					}
					$no_count = count($no);
					$yearly_report[] = array('month_name'=>$month_name, 'total_attendance'=>count($yes), 'total_absent'=>$no_count, 'total_working_days'=>count($yes)+$no_count);
					unset($result03, $yes);
				}
			}
			
		}
		else
		{
			echo "March";
		}
		unset($data);
		$data = array('total_days_in_this_year'=>$total_days_in_this_year, 'total_attendance_of_this_year'=>$total_attendance_of_this_year, 'total_days_in_this_month'=>$total_days_in_this_month, 'total_attendance_of_this_month'=>$total_attendance_of_this_month, 'total_absent_of_this_month'=>$total_absent_of_this_month, 'monthly_report'=>$record, 'yearly_report'=>$yearly_report);

		$output = array('status'=>'1', 'message'=>'success', 'data'=>$data);

		echo json_encode($output);
	}
	public function timetable()
	{
		$post = $this->input->post();
		$user_id = $post['user_id'];
		if($user_id)
		{
			$user = $this->api_m->get_user($user_id);
			$user_detail = $this->api_m->get_user_detail($user_id);
			$exam_type = $post['exam_type'];
			$class_id = $user_detail[0]->class;

			$time = time();
			$new_time = unix_to_human($time);
			$year = date('Y', strtotime($new_time));
			$month = date('m', strtotime($new_time));
			$date02 = date('d', strtotime($new_time));
			$date01	= $date02-1;
			$date = $year.'-'.$month.'-'.$date01;
			unset($result);

			$timetable = $this->api_m->get_time_table($class_id, $date, $exam_type);
			if($timetable)
			{
				foreach($timetable as $timetable)
				{
					$subject_id = $timetable->subject_id;
					$subject = $this->api_m->gett_subject($subject_id);
					$ex_date = $timetable->exam_date;
					$day = date('D', strtotime($ex_date));

					$result[] = array('subject_name'=>$subject[0]->name, 'date'=>$ex_date, 'day'=>$day);
				}
				$output = array('status'=>'1', 'message'=>'success', 'data'=>$result);
			}
			else
			{
				$output = array('status'=>0, 'message'=>"fail");	
			}
			
		}
		else
		{
			$output = array('status'=>0, 'message'=>"fail");
		}
		echo json_encode($output);
	}
	public function marks_report()
	{
		$post = $this->input->post();
		$user_id = $post['user_id'];
		$subject = $post['exam_type'];
		$user = $this->api_m->get_user($user_id);
		$user_detail = $this->api_m->get_user_detail($user_id);
		$class_id = $user_detail[0]->class;
		$subjectid = $this->api_m->get_subject_id($class_id, $subject);
		$subject_id = $subjectid[0]->subject_id;

		$time = time();
			$date = unix_to_human($time);
			$current_year = date('Y', strtotime($date));
			$c_month = date('m', strtotime($date));
			$cc_month = explode('0', $c_month);
			$count = count($cc_month);
			if($count == 1)
			{
				$month_id = $cc_month[0];
			}
			else
			{
				$month_id = $cc_month[1];
			}
			if($month_id > 3)
			{
				$session = $current_year.'-04-00';
			}
			else
			{
				$yr = $current_year-1;
				$session = $yr.'-04-00';
			}
			$exam_controller = $this->api_m->get_exam_controller($class_id, $subject_id, $session);
			foreach($exam_controller as $exam_controller)
			{
				$ex_date = $exam_controller->date_created;
				$st_ans = $this->api_m->get_st_ans($user_id, $class_id, $subject_id, $ex_date);
				foreach($st_ans as $st_ans)
				{
					$question_paper_detail_id = $st_ans->question_paper_detail_id;
					$question_paper_detail = $this->api_m->get_question_paper_detail($question_paper_detail_id);
					$r_answer = 'option'.$question_paper_detail[0]->ans;
					$st_answer = 'option'.$st_ans->ans;
					if($r_answer == $st_answer)
					{
						$right[] = $st_answer;
					}
					else
					{
						$wrong[] = $st_answer;
					}
				}
				$right_count = count($right);
				$ans_count = @++$count;
				$result[] = array('sr_no'=>$ans_count, 'subject'=>$ex_date, 'total_marks'=>$right_count+count($wrong), 'obedient_marks'=>$right_count);
			}

			$output = array('status'=>'1', 'message'=>'success', 'data'=>$result);

			echo json_encode($output);

	}
	
	
	
	
	// ===================================================================================================
	//                                            Driver API
	// ===================================================================================================

	public function view_student()
	{
		$user_id = $this->input->post('user_id');
		$d_data = $this->api_m->get_d_data($user_id);
		$vehicle_id = $d_data[0]->vehicle_id;
		$v_student = $this->api_m->v_student($vehicle_id);
		if($v_student)
		{
			foreach($v_student as $v_student)
			{
				$name = $v_student->fname.' '.$v_student->lname;
				$class_id = $v_student->class;
				$class = $this->api_m->get_class($class_id);
				$c_name = $class[0]->name;
				$drop_point = $v_student->drop_point_id;
				if(!$drop_point == 0)
				{
					$dp_name = $this->api_m->get_drop_point($drop_point);
					$drop_name = $dp_name[0]->drop_point_name;
				}
				else
				{
					$drop_name = 'No Update';
				}
				$result[] = array('class'=>$c_name, 'student_name'=>$name, 'drop_point'=>$drop_name);
			}
			$output = array('status'=>'1', 'message'=>'success', 'data'=>$result);
		}
		else
		{
			$output = array('status'=>0, 'message'=>"fail");
		}
		echo json_encode($output);
	}

	public function d_profile()
	{
		$post = $this->input->post();
		$user_id = $post['user_id'];

		$d_data = $this->api_m->get_d_data($user_id);
		if($d_data)
		{
			$vehicle_id = $d_data[0]->vehicle_id;
			$vehicle = $this->api_m->get_vehicle($vehicle_id);
			$route_id = $vehicle[0]->route_id;
			$route = $this->api_m->get_route($route_id);
			$result = array('name'=>$d_data[0]->driver_name, 'email_id'=>$d_data[0]->driver_email, 'image_url'=>'http://www.therpsindia.com/app_admin/assets/images/'.$d_data[0]->profile_pic, 'mobile'=>$d_data[0]->contact_no, 'route'=>'School to '.$route[0]->route_name, 'vehical_name'=>$d_data[0]->vehicle_name, 'vehical_number'=>$d_data[0]->registration_no);
			$output = array('status'=>'1', 'message'=>'success', 'data'=>$result);
		}
		else
		{
			$output = array('status'=>"0", 'message'=>"fail");
		}
		echo json_encode($output);

	}

	public function getRoutesForDropPoint()
	{
		$user_id = $this->input->post('user_id');
		$d_data = $this->api_m->get_d_data($user_id);
		$vehicle_id = $d_data[0]->vehicle_id;
		$vehicle = $this->api_m->get_vehicle($vehicle_id);
		$route_id = $vehicle[0]->route_id;
		$route = $this->api_m->get_route($route_id);
		$school_route = $this->api_m->get_school_route();
		
		foreach($route as $route)
		{
			$r_count = @++$count;
			$result[] = array('route_id'=>$route->route_id, 'route_name'=>$school_route[0]->route_name.' to '.$route->route_name);
		}
		$output = array('status'=>"1", 'message'=>"success", 'data'=>$result);
		echo json_encode($output);
	}

	public function add_drop()
	{
		$post = $this->input->post();

		$user_id = $post['user_id'];
		$location_id = $post['location_id'];
		$lat = $post['latitudue'];
		$long = $post['longitude'];

		$this->api_m->update_drop_point($location_id, $lat, $long);
		$output = array('status'=>"1", 'message'=>"Drop point added successfully");
		echo json_encode($output);
		
	}

	public function add_route()
	{
		$post = $this->input->post();
		$user_id = $post['user_id'];
		$sod_id = $post['sod_id'];
		$lat = $post['latitudue'];
		$long = $post['longitude'];

		$this->api_m->update_route($sod_id, $lat, $long);
		$output = array('status'=>"1", 'message'=>"Route update successfully");
		echo json_encode($output);
		
	}

	public function start_route()
	{
		$post = $this->input->post();

		$user_id = $post['user_id'];
		$lat = $post['lat'];
		$long = $post['long'];
		$started = $post['started'];
		$speed = $post['speed'];
		$ride_id = $post['ride_id'];
		$ride = $this->api_m->get_ride($ride_id);
		$route_from = $ride[0]->route_from;

		$d_data = $this->api_m->get_d_data($user_id);
		$vehicle_id = $d_data[0]->vehicle_id;
		$v_student = $this->api_m->v_student($vehicle_id);
		if($v_student)
		{
			$driver_id = $user_id;
			$ride_location = $this->api_m->get_ride_location($driver_id);
			if($ride_location)
			{
				$time = time();
				$date = unix_to_human($time);
				$this->api_m->update_ride_location($user_id, $lat, $long, $started, $speed, $ride_id, $date);
			}
			else
			{
				$this->api_m->set_ride_location($user_id, $lat, $long, $started, $speed, $ride_id);
			}

			$this->load->library('gcm_notification');
			if($started == 'start')
			{
				if($route_from == 0)
				{
					$opts_array = array(
				'noti_id'	=>	$ride_id,
		    	'message'   => 'Bas has been started Home to School.',
		    	'title'     => 'Bus has been started.',
		    	'sound'     => 3
								);
				}
				else
				{
					$opts_array = array(
				'noti_id'	=>	$ride_id,
		    	'message'   => 'Bas has been started School to Home.',
		    	'title'     => 'Bus has been started.',
		    	'sound'     => 3
								);
				}
				
			}

			foreach($v_student as $v_student)
			{
				$token = $v_student->token;
				if($token)
				{
					$reg_ids[] = $token;
					$this->gcm_notification->setRecipients($reg_ids);
				$this->gcm_notification->setTTL(20);
				$this->gcm_notification->setCollapseKey('GCM_Library');
				$this->gcm_notification->setDelay(true);
				$this->gcm_notification->setOptions($opts_array);
				$this->gcm_notification->setDebug(true);
				$this->gcm_notification->send();
				}
			}
			
		}
		$output = array('status'=>'1', 'message'=>'Update successfully');
		echo json_encode($output);

	}

	public function get_route_data()
	{
		$post = $this->input->post();

		$user_id = $post['user_id'];

		$d_data = $this->api_m->get_d_data($user_id);
		if($d_data)
		{
			$vehicle_id = $d_data[0]->vehicle_id;
			$vehicle = $this->api_m->get_vehicle($vehicle_id);
			$route_id = $vehicle[0]->route_id;
			$route = $this->api_m->get_route($route_id);
			$school_route = $this->api_m->get_school_route();

			$result[] = array('source_id'=>$school_route[0]->route_id, 'source'=>$school_route[0]->route_name, 'source_lat'=>$school_route[0]->route_latitude, 'source_long'=>$school_route[0]->route_longitude, 'source_status'=>$school_route[0]->route_status, 'destination_id'=>$route[0]->route_id, 'destination'=>$route[0]->route_name, 'destination_lat'=>$route[0]->route_latitude, 'destination_long'=>$route[0]->route_longitude, 'destination_status'=>$route[0]->route_status);

			$output = array('status'=>'1', 'message'=>'List of Route', 'data'=>$result);
		}
		else
		{
			$output = array('status' =>"0", 'message'=>"failed");
		}
		
		echo json_encode($output);
	}

	public function GetLocationBetweenRoutes()
	{
		$post = $this->input->post();

		$user_id = $post['user_id'];
		$route_id = $post['route_id'];

		$drop_point = $this->api_m->get_route_drop_point($route_id);
		if($drop_point)
		{
			foreach($drop_point as $drop_point)
			{
				$drop_count = @++$count;
				$result[] = array('location_id'=>$drop_point->drop_point_id, 'location'=>$drop_point->drop_point_name, 'location_latitude'=>$drop_point->drop_point_lat, 'location_latitude'=>$drop_point->drop_point_long);
			}
			$output = array('status'=>"1", 'message'=>"successful", 'data'=>$result);
		}
		else
		{
			$output = array('status'=>"0", 'message'=>"Failed");
		}

		echo json_encode($output);
	}

	public function start_ride_int()
	{
		$post = $this->input->post();

		$user_id = $post['user_id'];
		$route_from = $post['route_from'];

		$this->api_m->set_ride_status($user_id, $route_from);
		$ride = $this->api_m->get_ride_id($user_id);
		$school = $this->api_m->get_school_route();
		$result = array('school_lat'=>$school[0]->route_latitude, 'school_long'=>$school[0]->route_longitude, 'route_from'=>$route_from, 'ride_id'=>$ride[0]->ride_id);

		$d_data = $this->api_m->get_d_data($user_id);

		$output = array('status'=>"1", 'message'=>"success", 'data'=>$result);

		echo json_encode($output);
	}
	public function remaining_fees()
 {
  $post = $this->input->post();

  $user_id = $post['user_id'];

  $data = array('remaining_fees'=>"5500");
  if($user_id)
  {
    $output = array('status'=>"1", 'message'=>"successfully", 'data'=>$data);
   }
   else
   {
    $output = array('status'=>"0", 'message'=>"Failed");
   }

   echo json_encode($output);
 }
 public function payment_history()
 {
  $post = $this->input->post();

  $user_id = $post['user_id'];
  $amount = $post['amount'];
  $comments = $post['comments'];
  $transcation_id = $post['payment_transcation_id'];

  $hashvalue = "jsdkfhkj";

  if($user_id)
  {
   $output = array('status'=>"1", 'message'=>"Payment history successfully stored", 'hashvalue'=>$hashvalue);
  }
  else
  {
   $output = array('status'=>"0", 'message'=>"Payment history failed to store");
  }

  echo json_encode($output);
 }
 public function update_fcm_token()
	{
		$post = $this->input->post();
		if($post['user_id'])
		{
			$user = $post['user_id'];
			if(isset($post['fcm_token']))
			{
				$token = $post['fcm_token'];
				$this->load->model('api_m');
				$this->api_m->update_token($user, $token);

				$data = array('status'=>'1', 'message'=>'success');
				echo json_encode($data);
			}
			else
			{
				$data = array('status'=>'0', 'message'=>'fail');
				echo json_encode($data);
			}
		}
		else
		{
			$data = array('status'=>'0', 'message'=>'fail');
			echo json_encode($data);
		}
	}
	public function notification()
	{
		$post = $this->input->post();
		$user_id = $post['user_id'];

		$notification = $this->api_m->get_notification();
		if($notification)
		{
			foreach($notification as $notification)
			{
				$notification_students = $notification->notification_students;
				$notification_title = $notification->notification_title;
				$notification_message = $notification->notification_message;
				$date = $notification->date;
				$date01 = date('d-M-Y', strtotime($date));

				$student_array = explode(',', $notification_students);
				foreach($student_array as $student_array)
				{
					$student_id = $student_array;
					if($user_id == $student_id)
					{
						$not_count = @++$count;
						$result[] = array('id'=>$not_count, 'title'=>$notification_title, 'message'=>$notification_message, 'date'=>$date01);
					}
				}
			}
		}
		else
		{
			$result[] = array('id'=>1, 'title'=>'No Notifications are available.', 'message'=>'', 'date'=>'');
		}
		if(empty($result))
		{
			$result[] = array('id'=>1, 'title'=>'No Notifications are available.', 'message'=>'', 'date'=>'');	
		}
		$output = array('status'=>'1', 'message'=>'success', 'data'=>$result);
		echo json_encode($output);
	}
	public function bus_tracking()
	{
		$user_id = $this->input->post('user_id');

		$school = $this->api_m->get_school_route();
		$school_lat = $school[0]->route_latitude;
		$school_long = $school[0]->route_longitude;
		$user_data = $this->api_m->get_user_detail($user_id);
		$vehicle_id = $user_data[0]->vehicle_id;
		$vehicle = $this->api_m->get_vehicle($vehicle_id);
		if($vehicle_id == 0)
		{
			$output = array('status'=>"0", 'message'=>"fail");
		}
		else
		{
			$drop_point_id = $user_data[0]->drop_point_id;
			if($drop_point_id == 0)
			{
				$user_home_lat = $school_lat;
				$user_home_long = $school_long;
			}
			else
			{
				$drop_point = $drop_point_id;
				$dp = $this->api_m->get_drop_point($drop_point);

				$user_home_lat = $dp[0]->drop_point_lat;
				$user_home_long = $dp[0]->drop_point_long;
			}
			$driver = $this->api_m->get_driver($vehicle_id);

			$driver_detail = array('name'=>$driver[0]->driver_name, 'mobile'=>$driver[0]->contact_no,'address'=>$driver[0]->address, 'vechcal_number'=>$vehicle[0]->registration_no,'profile_imgae'=>"http://www.therpsindia.com/app_admin/assets/images/".$driver[0]->profile_pic);

			$data = array('schol_lat'=>$school_lat, 'schol_long'=>$school_long, 'user_home_latitude'=>$user_home_lat, 'user_home_longitude'=>$user_home_long, 'driver_detail'=>$driver_detail);

		$output = array('status'=>"1", 'message'=>"success", 'data'=>$data);

		}

		echo json_encode($output);
	}
	public function bus_update()
	{
		$user_id = $this->input->post('user_id');
		$user_data = $this->api_m->get_user_detail($user_id);
		$vehicle_id = $user_data[0]->vehicle_id;
		$driver = $this->api_m->get_driver($vehicle_id);
		$driver_id = $driver[0]->user_id;
		$ride_location = $this->api_m->get_ride_location($driver_id);
		$started = $ride_location[0]->started;
		if($started == 'continue')
		{
			$data = array('other_lat'=>$ride_location[0]->latitude, 'other_long'=>$ride_location[0]->longitude, 'speed'=>$ride_location[0]->speed, 'started'=>'start');

			$output = array('status'=>"1", 'message'=>"success", 'data'=>$data);
		}
		else
		{
			$output = array('status'=>"0", 'message'=>"fail");
		}

		echo json_encode($output);
	}
}