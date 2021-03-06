<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Main extends Sakip 
{
	public $data = array();

	public function __construct()
	{
		parent::__construct();

		$this->load->js(base_url('public/app/dashboard.js'));
		//$this->load->js(base_url('public/app/tour/dashboard-tour.js'));
	}

	public function index()
	{
		$this->page_title->push('Dashboard', 'Selamat datang di Administrator');

		$this->data = array(
			'title' => "Main Dashboard", 
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);
		$this->template->view('main-dashboard', $this->data);
	}

}

/* End of file Main.php */
/* Location: ./application/controllers/Main.php */