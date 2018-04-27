<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Applicant extends CI_Controller {	
	function __constructor(){
		parent::__constructor();
	}

	public function dashboard(){
        $data['content'] = 'applicant/dashboard';
        
		$this->load->view('templates/applicant/content', $data);
	}
	
	public function application() {
		$data['content'] = 'applicant/application';
        
		$this->load->view('templates/applicant/content', $data);
	}

	public function biodata() {
		$data['content'] = 'applicant/biodata';
        
		$this->load->view('templates/applicant/content', $data);
	}

	public function resume() {
		$data['content'] = 'applicant/resume';
        
		$this->load->view('templates/applicant/content', $data);
	}


	//Functionals (Biodata)

	public function show_bio(){
		$result = $this->applicant->show_bio();
		$msg['success'] = false;
		if($result[0]){
			$msg['success'] = true;
			$msg['data'] = $result[1];
		}

		echo json_encode($msg);
		
	}

	public function edit_bio(){
		$result = $this->applicant->edit_bio();
		$msg['success'] = false;

		if($result[0]){
			$msg['success'] = true;
			$msg['operation'] = $result[1];
		}
		echo json_encode($msg);
	}

	//Functionals (Resume)

	public function edit_resume(){
		$data_input = $this->input->post('data_input');
		$msg['success'] = false;

		switch ($data_input){
			case 'skill':
				$result = $this->applicant->insert_skill();

				if($result[0]){
					$msg['success'] = true;
					$msg['operation'] = $result[1];
				}
				break;
	
			default:
				$msg['operation'] = 'failed';
				
       
		}
		echo json_encode($msg);		


	}

	public function to_pdf(){
		$this->load->library('Pdf');
		$this->load->view('templates/applicant/to_resume');
	}
}