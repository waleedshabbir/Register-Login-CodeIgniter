<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {


	public function index()
	{
		$this->login();
	}


	public function login()
	{
		$this->load->view('login');

	}


	public function signup()
	{
		$this->load->view('signup');
	}


	public function members()
	{

		if($this->session->userdata('is_logged_in')){
			$this->load->view('members');

		}
		else{
			redirect('main/restricted');
		}
	}


	public function restricted()
	{
		$this->load->view('restricted');
	}


	public function login_validation()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('email','Email','required|trim|xss_clean|callback_validate_credentials');
		$this->form_validation->set_rules('password','Password','required|md5|trim');

		

		if($this->form_validation->run())
		{
			$data = array(
				'email' => $this->input->post('email'),
				'is_logged_in' => 1
			);

			$this->session->set_userdata($data);
			redirect('main/members');
		}
		else{
			$this->load->view('login');
		}

	}


	public function signup_validation()
	{
		$this->load->library('form_validation');

		$this->load->model('model_users');


		$this->form_validation->set_rules('email','Email','required|trim|valid_email|is_unique[users.email]');

		$this->form_validation->set_rules('password','Password','required|trim');

		$this->form_validation->set_rules('cpassword','Confirm Password','required|trim|matches[password]');


		$this->form_validation->set_message('is_unique','This Email already exists');


		if($this->form_validation->run())	{

			$key = md5(uniqid());


			//Send Email to the user
			$this->load->library('email',array('mailtype' => 'html'));

			$this->email->from('waleedshabbir1@gmail.com','waleed');

			$this->email->to($this->input->post('email'));

			$this->email->subject("Confirm you account");

			$url = base_url('main/register_user/'.$key);

			//$message= "<p>Thankyou for signing up <a href='".base_url()."main/register_user/$key'>Click here</a>to confirm your account</p>";

			//$message = "<p>Thankyou for signing up <br> <a href=".$url.">Click here</a> to confirm your account</p>";


			$message1="<p>Thankyou for signing up <br></p>";
			$message2="<a href='".$url."'>Click here</a>";
			$message3="<p>to confirm your account</p>";

			$message = $message1.$message2.$message3;


			$this->email->message($message);


			if($this->model_users->add_temp_users($key)){
				if($this->email->send()){
					echo "email sent";
				}
				else{
					echo "email send fail";
				}
			}
			else{
				echo "problem adding to database";
			}


		}
		else{
			echo "you shall not pass!";
			$this->load->view('signup');
		}

	}



	public function validate_credentials()
	{
		$this->load->model('model_users');

		if($this->model_users->can_log_in()){
			return true;

		}
		else{
			$this->form_validation->set_message('validate_credentials','Incorrect Username/Password');

			return false;
		}
	}



	public function logout()
	{
		$this->session->sess_destroy();
		redirect('main/login');
	}



	public function register_user($key)
	{
		$this->load->model('model_users');


		if($this->model_users->is_key_valid())
		{
			echo 'valid key';

		}
		else{
			echo 'invalid key';
		}

	}


	

}

