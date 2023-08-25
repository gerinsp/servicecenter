<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggan extends CI_Controller
{
   public function __construct()
   {
      parent::__construct();
      $this->load->model('Models', 'm');
      $this->load->library('encrypt');
      cekuser();
   }

   function listpelanggan()
   {
      $table = 'user';
      $where = array(
         'id_user'      =>   $this->session->userdata('id_user')
      );

      $data['user'] = $this->m->Get_Where($where, $table);
      $data['title'] = 'Service Center | List Pelanggan';


      $select = $this->db->select('*');
      $select = $this->db->join('barang', 'barang.id_pelanggan = pelanggan.id_pelanggan');
      $select = $this->db->order_by('pelanggan.namapelanggan', "ASC");
      $data['read'] = $this->m->Get_All('pelanggan', $select);


      $this->load->view('templates/head', $data);
      $this->load->view('templates/navigation', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('pages/pelanggan/listpelanggan', $data);
      $this->load->view('templates/footer');
      $this->load->view('templates/script', $data);
   }
   function cekurutan()
   {
      $urutan = $this->input->post('urutan');

      $this->db->select('*');
      $this->db->where('id_brand_sort', $urutan);
      $query = $this->db->get('masterbrand');

      if ($query->num_rows() > 0) {
         echo "<span class='status-available' style='color:red'>Data sortir sudah ada</span>
			";
      } else {
      }
   }
   function createpelanggan()
   {

      // $this->form_validation->set_rules(
      // 	'brand',
      // 	'brand',
      // 	'required|trim',
      // 	[
      // 		'required' => 'Field master id tidak boleh kosong'
      // 	]
      // );
      $this->form_validation->set_rules(
         'nomorservice',
         'nomorservice',
         'required|trim',
         [
            'required' => 'Field nomor service tidak boleh kosong'
         ]
      );
      $this->form_validation->set_rules(
         'namapelanggan',
         'namapelanggan',
         'required|trim',
         [
            'required' => 'Field nama pelanggan tidak boleh kosong'
         ]
      );
      $this->form_validation->set_rules(
         'merklaptop',
         'merklaptop',
         'required|trim',
         [
            'required' => 'Field merk laptop tidak boleh kosong'
         ]
      );
      $this->form_validation->set_rules(
         'telepon',
         'telepon',
         'required|trim',
         [
            'required' => 'Field telepon tidak boleh kosong'
         ]
      );
      $this->form_validation->set_rules(
         'layar',
         'layar',
         'required|trim',
         [
            'required' => 'Field layar tidak boleh kosong'
         ]
      );
      $this->form_validation->set_rules(
         'keyboard',
         'keyboard',
         'required|trim',
         [
            'required' => 'Field keyboard tidak boleh kosong'
         ]
      );
      $this->form_validation->set_rules(
         'speaker',
         'speaker',
         'required|trim',
         [
            'required' => 'Field speaker tidak boleh kosong'
         ]
      );
      $this->form_validation->set_rules(
         'batrei',
         'batrei',
         'required|trim',
         [
            'required' => 'Field batrei tidak boleh kosong'
         ]
      );
      $this->form_validation->set_rules(
         'casing',
         'casing',
         'required|trim',
         [
            'required' => 'Field casing tidak boleh kosong'
         ]
      );
      $this->form_validation->set_rules(
         'touchpad',
         'touchpad',
         'required|trim',
         [
            'required' => 'Field touchpad tidak boleh kosong'
         ]
      );


      if ($this->form_validation->run() == false) {
         $role_id = $this->session->userdata('role_id');

         $table = 'user';
         $where = array(
            'id_user'      =>   $this->session->userdata('id_user')
         );

         $data['user'] = $this->m->Get_Where($where, $table);


         $data['nomorservice'] = $this->m->nomorservice();

         $data['title'] = 'Service Center | Tambah Data Pelanggan';

         $this->load->view('templates/head', $data);
         $this->load->view('templates/navigation', $data);
         $this->load->view('templates/sidebar', $data);
         $this->load->view('pages/pelanggan/createpelanggan', $data);
         $this->load->view('templates/footer');
         $this->load->view('templates/script', $data);
      } else {

         date_default_timezone_set('Asia/Jakarta');
         $now = date('Y-m-d');
         $namapelanggan = $this->input->post('namapelanggan'); // Misalnya, "John Doe Smith"

         // Menghapus semua spasi dari teks 'namapelanggan'
         $namapelanggan_no_space = str_replace(' ', '', $namapelanggan); // Hasilnya: "JohnDoeSmith"

         // Mengubah teks menjadi huruf kecil
         $username = strtolower($namapelanggan_no_space); // Hasilnya: "johndoesmith"

         $this->db->select_max('tbl_pelanggan.id_pelanggan');
         $this->db->order_by('id_pelanggan', 'desc');

         $this->db->limit(1);
         $query = $this->db->get('tbl_pelanggan');
         if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->id_pelanggan) + 1;
         } else {
            $kode = 1;
         }
         $batas = str_pad($kode, "0", STR_PAD_LEFT);
         $id_pelanggan = $batas;


         $data = array(
            'id_pelanggan'                =>   $id_pelanggan,
            'nomorservice'                =>   $this->input->post('nomorservice'),
            'tanggalservice'              =>   $now,
            'layar'                       =>   $this->input->post('layar'),
            'keyboard'                    =>   $this->input->post('keyboard'),
            'speaker'                     =>   $this->input->post('speaker'),
            'batrei'                      =>   $this->input->post('batrei'),
            'casing'                      =>   $this->input->post('casing'),
            'touchpad'                    =>   $this->input->post('touchpad'),
            'batrei'                      =>   $this->input->post('batrei'),
            'status'                      =>   1,
         );
         $this->m->Save($data, 'barang');

         $data = array(
            'id_pelanggan'                 =>   $id_pelanggan,
            'namapelanggan'                =>   $this->input->post('namapelanggan'),
            'merklaptop'                   =>   $this->input->post('merklaptop'),
            'keluhan'                      =>   $this->input->post('keluhan'),
            'telepon'                      =>   $this->input->post('telepon'),
            'kelengkapan'                  =>   $this->input->post('kelengkapan'),
         );
         $this->m->Save($data, 'pelanggan');

         $data = array(
            'nama'                        =>  $this->input->post('namapelanggan'),
            'username'                    =>  $username,
            'image'                       =>  "default.png",
            'role_id'                     =>  4,
            'password'                    =>  password_hash('12345', PASSWORD_DEFAULT),
            'is_active'                   =>  1,
            'tanggal_daftar'              =>  $now,
         );
         $this->m->Save($data, 'user');

         $this->session->set_flashdata('success', 'Data pelanggan berhasil ditambah');
         redirect('listpelanggan');
      }
   }

   function editpelanggan($id_pelanggan)
   {

      $decrypt_id = $this->encrypt->decode($id_pelanggan);

      $data = [
         'title' => 'Service Center | Edit Data Pelanggan'
      ];
      $role_id = $this->session->userdata('role_id');

      $table = 'user';
      $where = array(
         'id_user'      =>   $this->session->userdata('id_user')
      );

      $data['user'] = $this->m->Get_Where($where, $table);

      $select = $this->db->select('*, tbl_barang.nomorservice as nomorservicepelanggan');
      $select = $this->db->join('tbl_barang', 'tbl_barang.id_pelanggan = tbl_pelanggan.id_pelanggan');
      $select = $this->db->where('tbl_pelanggan.id_pelanggan', $decrypt_id);
      $data['pelanggan'] = $this->m->Get_All('pelanggan', $select);


      $this->load->view('templates/head', $data);
      $this->load->view('templates/navigation', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('pages/pelanggan/updatepelanggan', $data);
      $this->load->view('templates/footer');
      $this->load->view('templates/script', $data);
   }
   function updatepelanggan()
   {
      $id_pelanggan = $this->input->post('idpelanggan');

      $decrypt_id = $this->encrypt->decode($id_pelanggan);

      $table = 'pelanggan';
      $where = array(
         'id_pelanggan'          =>   $decrypt_id
      );


      $data = array(
         'namapelanggan'                =>   $this->input->post('namapelanggan'),
         'merklaptop'                   =>   $this->input->post('merklaptop'),
         'keluhan'                      =>   $this->input->post('keluhan'),
         'telepon'                      =>   $this->input->post('telepon'),
         'kelengkapan'                  =>   $this->input->post('kelengkapan'),
      );
      $this->m->Update($where, $data, $table);

      $table = 'barang';
      $where = array(
         'id_pelanggan'          =>   $decrypt_id
      );
      $data = array(
         'layar'                       =>   $this->input->post('layar'),
         'keyboard'                    =>   $this->input->post('keyboard'),
         'speaker'                     =>   $this->input->post('speaker'),
         'batrei'                      =>   $this->input->post('batrei'),
         'casing'                      =>   $this->input->post('casing'),
         'touchpad'                    =>   $this->input->post('touchpad'),
         'batrei'                      =>   $this->input->post('batrei'),
      );
      $this->m->Update($where, $data, $table);


      $this->session->set_flashdata('success', 'Data pelanggan berhasil diubah');
      redirect('listpelanggan');
   }
   function deletepelanggan()
   {
      $id_pelanggan = $this->input->post('id');

      $decrypt_id = $this->encrypt->decode($id_pelanggan);


      $table = 'pelanggan';
      $where = array(
         'id_pelanggan'          =>   $decrypt_id
      );

      $this->m->Delete($where, $table);

      $table = 'barang';
      $where = array(
         'id_pelanggan'          =>   $decrypt_id
      );

      $this->m->Delete($where, $table);

      $this->session->set_flashdata('success', 'Data pelanggan berhasil dihapus');
      redirect('listpelanggan');
   }

   function detailpelanggan($id_pelanggan)
   {

      $decrypt_id = $this->encrypt->decode($id_pelanggan);

      $data = [
         'title' => 'Service Center | Detail Data Pelanggan'
      ];
      $role_id = $this->session->userdata('role_id');

      $table = 'user';
      $where = array(
         'id_user'      =>   $this->session->userdata('id_user')
      );

      $data['user'] = $this->m->Get_Where($where, $table);

      $select = $this->db->select('*, tbl_barang.nomorservice as nomorservicepelanggan');
      $select = $this->db->join('tbl_barang', 'tbl_barang.id_pelanggan = tbl_pelanggan.id_pelanggan');
      $select = $this->db->where('tbl_pelanggan.id_pelanggan', $decrypt_id);
      $data['pelanggan'] = $this->m->Get_All('pelanggan', $select);


      $this->load->view('templates/head', $data);
      $this->load->view('templates/navigation', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('pages/pelanggan/detailpelanggan', $data);
      $this->load->view('templates/footer');
      $this->load->view('templates/script', $data);
   }
}
