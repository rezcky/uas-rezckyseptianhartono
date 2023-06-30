<?php
defined('BASEPATH') or exit('No direct script access allowed');

class kota extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library("form_validation");
    }
    
    public function index(){

        

        $data['title'] = 'list kota';
        $data['user'] = $this->db->get_where('user_data', ['email' => $this->session->userdata('email')])->row_array();
        $data['kota'] = $this->db->get('destinasi')->result_array();

        $this->form_validation->set_rules('kota', "kota", 'required|is_unique[destinasi.kota]', [
            'required' => 'Nama kota tidak boleh kosong',
            'is_unique' => 'kota ' . $this->input->post('kota') .  ' sudah ada!'
        ]);
        $this->form_validation->set_rules('harga', "harga", 'required', [
            'required' => 'Nama harga tidak boleh kosong',
        ]);
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('layout/topbar', $data);
            $this->load->view('layout/sidebar', $data);
            $this->load->view('kota/index', $data);
            $this->load->view('layout/footer');
        } else{

            // //
            // $upload_image = $_FILES['image']['name'];

            // if ($upload_image) {
            //     // $path_file = base_url('assets/img/profile/') . $data['user']['image'];
            //     // unlink($path_file);
            //     $config['allowed_types'] = 'gif|jpg|png|svg';
            //     $config['max_size'] = '2048';
            //     $config['upload_path'] = './assets/img/destinasi/';

            //     $this->load->library('upload', $config);

            //     if ($this->upload->do_upload('image')) {
            //         $gambar_baru = $this->upload->data('file_name');
            //         $this->db->set('image', $gambar_baru);
            //     } else {
            //         echo $this->upload->display_errors();
            //     }
            // }

            $data=[
                "kota" => $this->input->post('kota'),
                "harga" => $this->input->post('harga'),
                "image" => "default.jpeg"

            ];

            $this->db->insert('destinasi', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success neu-brutalism mb-4">Destinasi berhasil ditambahkan!</div>');
            redirect('kota');
        }

    }
    public function get_kota($id){
        $kota = $this->db->query('SELECT * FROM destinasi WHERE id = ' . $id . '')->row();
        exit(json_encode((array)$kota));

    }
    public function ubah(){

        $data['user'] = $this->db->get_where('user_data', ['email' => $this->session->userdata('email')])->row_array();

        $upload_image = $_FILES['image']['name'];
       

            if ($upload_image) {
                // $path_file = base_url('assets/img/profile/') . $data['user']['image'];
                // unlink($path_file);
                $config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
                $config['max_size'] = '2048';
                $config['upload_path'] = './assets/img/destinasi/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $gambar_lama = $data['user']['image'];
                    if ($gambar_lama != "default.jpeg") {
                        unlink(FCPATH . 'assets/img/destinasi/' . $gambar_lama);
                    }
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }


            $id = $this->input->post('id');
            $this->db->set('kota', $this->input->post('kotaubah'));
            $this->db->set('harga', $this->input->post('hargaubah'));
            $this->db->where('id', $id);
            $this->db->update('destinasi');
            $this->session->set_flashdata('message', '<div class="alert alert-success neu-brutalism mb-4">Destinasi berhasil diubah!</div>');
            redirect('kota');
    }
    public function hapus(){
        $kota_id = $this->uri->segment(3);
        $kota_name = $this->db->get_where('destinasi', ['id' => $kota_id])->row_array()['kota'];
        $this->db->where('id', $kota_id);
        $this->db->delete('destinasi');
        $this->session->set_flashdata('message', '<div class="alert alert-danger neu-brutalism mb-4">kota <b>' . $kota . '</b> berhasil dihapus!</div>');
        redirect("kota");
    }
    }
