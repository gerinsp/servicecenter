<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
   public function __construct()
   {
      parent::__construct();
      $this->load->model('Models', 'm');
      cekuser();
   }

   function listuser()
   {
      $table = 'user';
      $where = array(
         'id_user'      =>   $this->session->userdata('id_user')
      );

      $data['user'] = $this->m->Get_Where($where, $table);
      $data['title'] = 'PT.MMM | List User';
      $select = $this->db->select('*');
      $select = $this->db->join('tbl_role', 'tbl_role.id = tbl_user.role_id');
      $select = $this->db->order_by('role');
      $data['read'] = $this->m->Get_All('user', $select);

      $select = $this->db->select('*');
      $select = $this->db->order_by('role');
      $data['role'] = $this->m->Get_All('role', $select);


      $select = $this->db->select('*');
      $select = $this->db->order_by('bagian');
      $select = $this->db->where('deleted', '0');
      $data['bagian'] = $this->m->Get_All('bagian', $select);

      // $select = $this->db->select('*');
      // $select = $this->db->order_by('mastername');
      // $select = $this->db->where('deleted', '0');
      // // $select = $this->db->where('masterid', 'lokasi');
      // $data['lokasi'] = $this->m->Get_All('masterid', $select);

      $this->load->view('templates/head', $data);
      $this->load->view('templates/navigation', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('pages/master/user/listuser', $data);
      $this->load->view('templates/footer');
      $this->load->view('templates/script', $data);
   }
   function createuser()
   {

      $this->form_validation->set_rules(
         'nik',
         'nik',
         'trim|is_unique[user.username]',
         [
            'required' => 'Field NIK tidak boleh kosong',
            'is_unique'  => "Username yang dimasukkan sudah terdaftar pada database"
         ]
      );
      $this->form_validation->set_rules(
         'nama',
         'nama',
         'required|trim',
         [
            'required' => 'Field nama tidak boleh kosong'
         ]
      );
      $this->form_validation->set_rules(
         'email',
         'email',
         'valid_email|trim',
         [
            'valid_email' => 'Format email tidak sesuai'
         ]
      );

      if ($this->form_validation->run() == false) {
         $role_id = $this->session->userdata('role_id');

         $table = 'user';
         $where = array(
            'id_user'      =>   $this->session->userdata('id_user')
         );

         $data['user'] = $this->m->Get_Where($where, $table);
         $data['title'] = 'PT.MMM | Tambah Data User';

         $select = $this->db->select('*');
         $select = $this->db->order_by('role');
         $data['role'] = $this->m->Get_All('role', $select);


         $this->load->view('templates/head', $data);
         $this->load->view('templates/navigation', $data);
         $this->load->view('templates/sidebar', $data);
         $this->load->view('pages/master/user/createuser', $data);
         $this->load->view('templates/footer');
         $this->load->view('templates/script', $data);
      } else {

         $data = array(
            'nama'              =>   $this->input->post('nama'),
            'image'             =>   'default.png',
            'username'          =>   $this->input->post('username'),
            'password'          =>   password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'role_id'           =>   $this->input->post('role'),
            'is_active'         =>   1,
            'tanggal_daftar'    =>   date("Y-m-d"),
         );

         $this->m->Save($data, 'user');

         $this->session->set_flashdata('success', 'Data user berhasil ditambah');
         redirect('listuser');
      }
   }
   function edituser($id_user)
   {

      $data = [
         'title' => 'PT.MMM | Edit Data User'
      ];
      $role_id = $this->session->userdata('role_id');

      $table = 'user';
      $where = array(
         'id_user'      =>   $this->session->userdata('id_user')
      );

      $data['user'] = $this->m->Get_Where($where, $table);

      $select = $this->db->select('*');
      $select = $this->db->join('tbl_role', 'tbl_role.id = tbl_user.role_id');
      $select = $this->db->order_by('role_id');
      $select = $this->db->where('id_user', $id_user);
      $data['read'] = $this->m->Get_All('user', $select);

      $select = $this->db->select('*');
      $select = $this->db->order_by('role');
      $data['role'] = $this->m->Get_All('role', $select);

      $this->load->view('templates/head', $data);
      $this->load->view('templates/navigation', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('pages/master/user/edituser', $data);
      $this->load->view('templates/footer');
      $this->load->view('templates/script', $data);
   }

   function updateuser()
   {
      $table = 'user';
      $where = array(
         'id_user'          =>   $this->input->post('iduser')
      );

      $data = array(
         'nama'              =>   $this->input->post('nama'),
         'username'          =>   $this->input->post('username'),
         'password'            =>   password_hash($this->input->post('password'), PASSWORD_DEFAULT),
         'role_id'           =>   $this->input->post('role'),
         'is_active'         =>   $this->input->post('status'),
         'tanggal_daftar'    =>   date("Y-m-d"),
      );
      $this->m->Update($where, $data, $table);


      $this->session->set_flashdata('success', 'Data user berhasil diubah');
      redirect('listuser');
   }
   function deleteuser()
   {
      $table = 'user';
      $where = array(
         'id_user'          =>   $this->input->post('id')
      );

      $this->m->Delete($where, $table);

      $this->session->set_flashdata('success', 'Data user berhasil dihapus');
      redirect('listuser');
   }
}
