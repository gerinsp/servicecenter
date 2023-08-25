<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
   public function __construct()
   {
      parent::__construct();
      $this->load->library('form_validation');
      $this->load->model('Models', 'm');
   }
   public function index()
   {

      $this->form_validation->set_rules(
         'username',
         'Username',
         'required|trim',
         [
            'required' => 'Username Tidak Boleh Kosong',
         ]
      );
      $this->form_validation->set_rules(
         'password',
         'Password',
         'required|trim',
         [
            'required' => 'Password Tidak Boleh Kosong'
         ]
      );

      if ($this->form_validation->run() == false) {
         $data['title'] = "Service Center | Login ";
         $this->load->view('auth/header', $data);
         $this->load->view('auth/login');
         $this->load->view('auth/footer');
      } else {
         $this->_login();
      }
   }

   private function _login()
   {

      $user = [
         $username   =   $this->input->post('username'),
         $password   =   $this->input->post('password')

      ];
      $user = $this->m->Get_Where(['username' => $username], 'user');

      if ($user) {

         if ($user->is_active == 1) {

            if (password_verify($password, $user->password)) {

               $data = [
                  'id_user' => $user->id_user,
                  'username' => $user->username,
                  'role_id' => $user->role_id,
                  'nama' => $user->nama
               ];


               $this->session->set_userdata($data);

               $this->session->set_flashdata('success', 'Anda berhasil login');
               redirect('dashboard');
            } else {
               $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password anda salah <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div> ');
               redirect('login');
            }
         } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Akun Tidak Aktif<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div> ');
            redirect('login');
         }
      } else {
         $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username Tidak Terdaftar<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div> ');
         redirect('login');
      }
   }

   public function logout()
   {

      session_start();
      session_destroy();
      $this->session->unset_userdata('username');
      $this->session->unset_userdata('role_id');
      $this->session->set_flashdata('success', 'Anda berhasil logout');
      redirect('login');
   }
   public function blocked()
   {
      $table = 'user';
      $where = array(
         'id_user'      =>   $this->session->userdata('id_user')
      );


      $data['user'] = $this->m->Get_Where($where, $table);
      $data['title'] = 'Akses Ditolak';
      $this->load->view('auth/header', $data);
      $this->load->view('auth/blocked');
      $this->load->view('auth/script');
   }
}
