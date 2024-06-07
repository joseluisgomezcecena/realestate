<?php

class Dashboards extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Chart_model');
        $this->load->model('Projects_model');
    }

    public function index()
    {
        $data['active'] = 'home';

        $data['title'] = 'Dashboard';

    
        $this->load->view('_templates/header', $data);
        $this->load->view('_templates/topnav', $data);
        $this->load->view('_templates/sidebar', $data);
        $this->load->view('dashboard/index', $data);
        $this->load->view('_templates/footer', $data);
    }
}