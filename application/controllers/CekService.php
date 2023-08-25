<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CekService extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Models', 'm');
        $this->load->library('encrypt');
    }
    public function progress()
    {
        $table = 'user';
        $where = array(
            'id_user'      =>   $this->session->userdata('id_user')
        );

        $data['user'] = $this->m->Get_Where($where, $table);

        // $select = $this->db->select('*, count(kode_barang) as jumlahbarang');
        // $data['read']=$this->m->Get_All('barang',$select);
        $data['title'] = 'Service Center | Progress Service';
        // echo "Selamat Datang" . $data->nama;


        $this->load->view('pages/progress/cekprogress', $data);
        $this->load->view('templates/script', $data);
    }
    function searchdata()
    {
        $nomorservice   = $this->input->post("nomorservice");

        $table = 'user';
        $where = array(
            'id_user'      =>   $this->session->userdata('id_user')
        );

        $data['user'] = $this->m->Get_Where($where, $table);
        $data['title'] = 'Service Center | Progress Service';

        $select = $this->db->select('*');
        $select = $this->db->join('tbl_pelanggan', 'tbl_pelanggan.id_pelanggan = tbl_barang.id_pelanggan');
        $select = $this->db->where('tbl_barang.nomorservice', $nomorservice);
        $data['service'] = $this->m->Get_All('barang', $select);

        $this->load->view('pages/progress/progressservice', $data);
    }
}
