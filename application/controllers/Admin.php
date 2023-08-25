<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
   public function __construct()
   {
      parent::__construct();
      $this->load->model('Models', 'm');
      $this->load->library('encrypt');
      cekuser();
   }

   function listadmin()
   {
      $table = 'user';
      $where = array(
         'id_user'      =>   $this->session->userdata('id_user')
      );

      $data['user'] = $this->m->Get_Where($where, $table);
      $data['title'] = 'Service Center | List Admin';


      $select = $this->db->select('*');
      $select = $this->db->order_by('nama', "ASC");
      $data['read'] = $this->m->Get_All('admin', $select);


      $this->load->view('templates/head', $data);
      $this->load->view('templates/navigation', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('pages/admin/listadmin', $data);
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
   function createadmin()
   {

      $this->form_validation->set_rules(
         'namaadmin',
         'namaadmin',
         'required|trim',
         [
            'required' => 'Field nama admin tidak boleh kosong'
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

         $data['title'] = 'Service Center | Tambah Data admin';

         $this->load->view('templates/head', $data);
         $this->load->view('templates/navigation', $data);
         $this->load->view('templates/sidebar', $data);
         $this->load->view('pages/admin/createadmin', $data);
         $this->load->view('templates/footer');
         $this->load->view('templates/script', $data);
      } else {

         date_default_timezone_set('Asia/Jakarta');
         $now = date('Y-m-d');
         $namaadmin = $this->input->post('namaadmin'); // Misalnya, "John Doe Smith"

         // Menghapus semua spasi dari teks 'namaadmin'
         $namaadmin_no_space = str_replace(' ', '', $namaadmin); // Hasilnya: "JohnDoeSmith"

         // Mengubah teks menjadi huruf kecil
         $username = strtolower($namaadmin_no_space); // Hasilnya: "johndoesmith"

         $this->db->select_max('tbl_admin.id_admin');
         $this->db->order_by('id_admin', 'desc');

         $this->db->limit(1);
         $query = $this->db->get('tbl_admin');
         if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->id_admin) + 1;
         } else {
            $kode = 1;
         }
         $batas = str_pad($kode, "0", STR_PAD_LEFT);
         $id_admin = $batas;


         $data = array(
            'id_admin'                     =>   $id_admin,
            'nama'                         =>   $this->input->post('namaadmin'),
            'alamat'                       =>   $this->input->post('alamat'),
            'telepon'                      =>   $this->input->post('telepon'),
            'jeniskelamin'                 =>   $this->input->post('jeniskelamin'),
         );
         $this->m->Save($data, 'admin');

         $data = array(
            'nama'                        =>  $this->input->post('namaadmin'),
            'username'                    =>  $username,
            'image'                       =>  "default.png",
            'role_id'                     =>  2,
            'password'                    =>  password_hash('12345', PASSWORD_DEFAULT),
            'is_active'                   =>  1,
            'tanggal_daftar'              =>  $now,
         );
         $this->m->Save($data, 'user');

         $this->session->set_flashdata('success', 'Data admin berhasil ditambah');
         redirect('listadmin');
      }
   }

   function editadmin($id_admin)
   {

      $decrypt_id = $this->encrypt->decode($id_admin);

      $data = [
         'title' => 'Service Center | Edit Data admin'
      ];
      $role_id = $this->session->userdata('role_id');

      $table = 'user';
      $where = array(
         'id_user'      =>   $this->session->userdata('id_user')
      );

      $data['user'] = $this->m->Get_Where($where, $table);

      $select = $this->db->select('*');
      $select = $this->db->where('tbl_admin.id_admin', $decrypt_id);
      $data['admin'] = $this->m->Get_All('admin', $select);


      $this->load->view('templates/head', $data);
      $this->load->view('templates/navigation', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('pages/admin/updateadmin', $data);
      $this->load->view('templates/footer');
      $this->load->view('templates/script', $data);
   }
   function updateadmin()
   {
      $id_admin = $this->input->post('idadmin');

      $decrypt_id = $this->encrypt->decode($id_admin);

      $table = 'admin';
      $where = array(
         'id_admin'          =>   $decrypt_id
      );


      $data = array(
         'nama'                         =>   $this->input->post('namaadmin'),
         'alamat'                       =>   $this->input->post('alamat'),
         'jeniskelamin'                 =>   $this->input->post('jeniskelamin'),
         'telepon'                      =>   $this->input->post('telepon'),
      );
      $this->m->Update($where, $data, $table);


      $this->session->set_flashdata('success', 'Data admin berhasil diubah');
      redirect('listadmin');
   }
   function deleteadmin()
   {
      $id_admin = $this->input->post('id');

      $decrypt_id = $this->encrypt->decode($id_admin);


      $table = 'admin';
      $where = array(
         'id_admin'          =>   $decrypt_id
      );

      $this->m->Delete($where, $table);


      $this->session->set_flashdata('success', 'Data admin berhasil dihapus');
      redirect('listadmin');
   }

   function detailadmin($id_admin)
   {

      $decrypt_id = $this->encrypt->decode($id_admin);

      $data = [
         'title' => 'Service Center | Detail Data admin'
      ];
      $role_id = $this->session->userdata('role_id');

      $table = 'user';
      $where = array(
         'id_user'      =>   $this->session->userdata('id_user')
      );

      $data['user'] = $this->m->Get_Where($where, $table);

      $select = $this->db->select('*, tbl_barang.nomorservice as nomorserviceadmin');
      $select = $this->db->join('tbl_barang', 'tbl_barang.id_admin = tbl_admin.id_admin');
      $select = $this->db->where('tbl_admin.id_admin', $decrypt_id);
      $data['admin'] = $this->m->Get_All('admin', $select);


      $this->load->view('templates/head', $data);
      $this->load->view('templates/navigation', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('pages/admin/detailadmin', $data);
      $this->load->view('templates/footer');
      $this->load->view('templates/script', $data);
   }
}
