<?php
defined('BASEPATH') or exit('No direct script access allowed');

class destinasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library("form_validation");
    }

    public function index(){

        $data['title'] = 'Pilihan';
        $data['user'] = $this->db->get_where('user_data', ['email' => $this->session->userdata('email')])->row_array();
        $data['kota'] = $this->db->get('destinasi')->result_array();

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('layout/topbar', $data);
            $this->load->view('layout/sidebar', $data);
            $this->load->view('destinasi/index', $data);
            $this->load->view('layout/footer');
        }
        else{

        }
    }
}