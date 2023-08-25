<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Teknisi extends CI_Controller
{
   public function __construct()
   {
      parent::__construct();
      $this->load->model('Models', 'm');
      $this->load->library('encrypt');
      cekuser();
   }

   function listteknisi()
   {
      $table = 'user';
      $where = array(
         'id_user'      =>   $this->session->userdata('id_user')
      );

      $data['user'] = $this->m->Get_Where($where, $table);
      $data['title'] = 'Service Center | List Teknisi';


      $select = $this->db->select('*');
      $select = $this->db->order_by('nama', "ASC");
      $data['read'] = $this->m->Get_All('teknisi', $select);


      $this->load->view('templates/head', $data);
      $this->load->view('templates/navigation', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('pages/teknisi/listteknisi', $data);
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
   function createteknisi()
   {

      $this->form_validation->set_rules(
         'namateknisi',
         'namateknisi',
         'required|trim',
         [
            'required' => 'Field nama teknisi tidak boleh kosong'
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

      if ($this->form_validation->run() == false) {
         $role_id = $this->session->userdata('role_id');

         $table = 'user';
         $where = array(
            'id_user'      =>   $this->session->userdata('id_user')
         );

         $data['user'] = $this->m->Get_Where($where, $table);

         $data['title'] = 'Service Center | Tambah Data Teknisi';

         $this->load->view('templates/head', $data);
         $this->load->view('templates/navigation', $data);
         $this->load->view('templates/sidebar', $data);
         $this->load->view('pages/teknisi/createteknisi', $data);
         $this->load->view('templates/footer');
         $this->load->view('templates/script', $data);
      } else {

         date_default_timezone_set('Asia/Jakarta');
         $now = date('Y-m-d');
         $namateknisi = $this->input->post('namateknisi'); // Misalnya, "John Doe Smith"

         // Menghapus semua spasi dari teks 'namateknisi'
         $namateknisi_no_space = str_replace(' ', '', $namateknisi); // Hasilnya: "JohnDoeSmith"

         // Mengubah teks menjadi huruf kecil
         $username = strtolower($namateknisi_no_space); // Hasilnya: "johndoesmith"

         $this->db->select_max('tbl_teknisi.id_teknisi');
         $this->db->order_by('id_teknisi', 'desc');

         $this->db->limit(1);
         $query = $this->db->get('tbl_teknisi');
         if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->id_teknisi) + 1;
         } else {
            $kode = 1;
         }
         $batas = str_pad($kode, "0", STR_PAD_LEFT);
         $id_teknisi = $batas;


         $data = array(
            'id_teknisi'                   =>   $id_teknisi,
            'nama'                         =>   $this->input->post('namateknisi'),
            'alamat'                       =>   $this->input->post('alamat'),
            'telepon'                      =>   $this->input->post('telepon'),
            'jeniskelamin'                 =>   $this->input->post('jeniskelamin'),
         );
         $this->m->Save($data, 'teknisi');

         $data = array(
            'nama'                        =>  $this->input->post('namateknisi'),
            'username'                    =>  $username,
            'image'                       =>  "default.png",
            'role_id'                     =>  3,
            'password'                    =>  password_hash('12345', PASSWORD_DEFAULT),
            'is_active'                   =>  1,
            'tanggal_daftar'              =>  $now,
         );
         $this->m->Save($data, 'user');

         $this->session->set_flashdata('success', 'Data teknisi berhasil ditambah');
         redirect('listteknisi');
      }
   }

   function editteknisi($id_teknisi)
   {

      $decrypt_id = $this->encrypt->decode($id_teknisi);

      $data = [
         'title' => 'Service Center | Edit Data Teknisi'
      ];
      $role_id = $this->session->userdata('role_id');

      $table = 'user';
      $where = array(
         'id_user'      =>   $this->session->userdata('id_user')
      );

      $data['user'] = $this->m->Get_Where($where, $table);

      $select = $this->db->select('*');
      $select = $this->db->where('tbl_teknisi.id_teknisi', $decrypt_id);
      $data['teknisi'] = $this->m->Get_All('teknisi', $select);


      $this->load->view('templates/head', $data);
      $this->load->view('templates/navigation', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('pages/teknisi/updateteknisi', $data);
      $this->load->view('templates/footer');
      $this->load->view('templates/script', $data);
   }
   function updateteknisi()
   {
      $id_teknisi = $this->input->post('idteknisi');

      $decrypt_id = $this->encrypt->decode($id_teknisi);

      $table = 'teknisi';
      $where = array(
         'id_teknisi'          =>   $decrypt_id
      );


      $data = array(
         'nama'                         =>   $this->input->post('namateknisi'),
         'alamat'                       =>   $this->input->post('alamat'),
         'jeniskelamin'                 =>   $this->input->post('jeniskelamin'),
         'telepon'                      =>   $this->input->post('telepon'),
      );
      $this->m->Update($where, $data, $table);


      $this->session->set_flashdata('success', 'Data teknisi berhasil diubah');
      redirect('listteknisi');
   }
   function deleteteknisi()
   {
      $id_teknisi = $this->input->post('id');

      $decrypt_id = $this->encrypt->decode($id_teknisi);


      $table = 'teknisi';
      $where = array(
         'id_teknisi'          =>   $decrypt_id
      );

      $this->m->Delete($where, $table);


      $this->session->set_flashdata('success', 'Data teknisi berhasil dihapus');
      redirect('listteknisi');
   }

   function detailteknisi($id_teknisi)
   {

      $decrypt_id = $this->encrypt->decode($id_teknisi);

      $data = [
         'title' => 'Service Center | Detail Data teknisi'
      ];
      $role_id = $this->session->userdata('role_id');

      $table = 'user';
      $where = array(
         'id_user'      =>   $this->session->userdata('id_user')
      );

      $data['user'] = $this->m->Get_Where($where, $table);

      $select = $this->db->select('*, tbl_barang.nomorservice as nomorserviceteknisi');
      $select = $this->db->join('tbl_barang', 'tbl_barang.id_teknisi = tbl_teknisi.id_teknisi');
      $select = $this->db->where('tbl_teknisi.id_teknisi', $decrypt_id);
      $data['teknisi'] = $this->m->Get_All('teknisi', $select);


      $this->load->view('templates/head', $data);
      $this->load->view('templates/navigation', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('pages/teknisi/detailteknisi', $data);
      $this->load->view('templates/footer');
      $this->load->view('templates/script', $data);
   }
}
