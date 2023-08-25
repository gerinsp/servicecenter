<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Service extends CI_Controller
{
   public function __construct()
   {
      parent::__construct();
      $this->load->model('Models', 'm');
      $this->load->library('encrypt');
      cekuser();
   }
   function listservice()
   {
      $table = 'user';
      $where = array(
         'id_user'      =>   $this->session->userdata('id_user')
      );

      $data['user'] = $this->m->Get_Where($where, $table);
      $data['title'] = 'Service Center | List Service';


      $select = $this->db->select('*');
      $select = $this->db->join('pelanggan', 'pelanggan.id_pelanggan = barang.id_pelanggan');
      $select = $this->db->order_by('nomorservice', "ASC");
      $data['read'] = $this->m->Get_All('barang', $select);


      $this->load->view('templates/head', $data);
      $this->load->view('templates/navigation', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('pages/service/listservice', $data);
      $this->load->view('templates/footer');
      $this->load->view('templates/script', $data);
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


      $this->load->view('templates/head', $data);
      $this->load->view('templates/navigation', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('pages/progress/viewprogress', $data);
      $this->load->view('templates/footer');
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
   function detailservice($id_pelanggan)
   {

      $decrypt_id = $this->encrypt->decode($id_pelanggan);

      $data = [
         'title' => 'Service Center | Detail Data Service'
      ];
      $role_id = $this->session->userdata('role_id');

      $table = 'user';
      $where = array(
         'id_user'      =>   $this->session->userdata('id_user')
      );

      $data['user'] = $this->m->Get_Where($where, $table);

      $select = $this->db->select('*, tbl_barang.nomorservice as nomorservicepelanggan');
      $select = $this->db->join('tbl_pelanggan', 'tbl_pelanggan.id_pelanggan = tbl_barang.id_pelanggan');
      $select = $this->db->where('tbl_barang.id_pelanggan', $decrypt_id);
      $data['service'] = $this->m->Get_All('barang', $select);

      $this->load->view('templates/head', $data);
      $this->load->view('templates/navigation', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('pages/service/detailservice', $data);
      $this->load->view('templates/footer');
      $this->load->view('templates/script', $data);
   }
   function updatestatus($id_barang)
   {
      $ket = $this->input->post('keterangan');
      $diag = $this->input->post('diagnosis');
      $status = $this->input->post('status');

      $table = 'barang';
      $where = array(
         'id_barang'          =>   $id_barang
      );
      if ($status == 2) {
         $data = array(
            'status'                       =>   $status,
            'diagnosis'                    =>   $diag
         );
      } elseif ($status == 3) {
         $data = array(
            'status'                       =>   $status,
            'persiapan'                    =>   $ket
         );
      } else {
         $data = array(
            'status'                       =>   $status,
         );
      }
      $this->m->Update($where, $data, $table);
      $role_id = $this->session->userdata('role_id');

      if ($status == 2 || $status == 5) {
         $id_pelanggan = $this->input->post('id_pelanggan');
         if ($role_id == 3) {
            $this->session->set_flashdata('success', 'Anda berhasil melakukan update status.');
            redirect('listservice');
         }
         if ($role_id == 2) {
            $this->sendMessageToWa($id_pelanggan, $status);
         }
      } else {
         $this->session->set_flashdata('success', 'Anda berhasil melakukan update status.');
         redirect('listservice');
      }
   }
   function sendMessageToWa($id_pelanggan, $status)
   {
      $table = 'user';
      $where = array(
         'id_user'      =>   $this->session->userdata('id_user')
      );

      $data['user'] = $this->m->Get_Where($where, $table);

      $select = $this->db->select('*, tbl_barang.nomorservice as nomorservicepelanggan');
      $select = $this->db->join('tbl_pelanggan', 'tbl_pelanggan.id_pelanggan = tbl_barang.id_pelanggan');
      $select = $this->db->where('tbl_barang.id_pelanggan', $id_pelanggan);
      $data['service'] = $this->m->Get_All('barang', $select);

      $data_service = $data['service'][0];

      $no_telepon = $this->convertNoTeleponToFormatInternational($data_service->telepon);
      $no_service = $data_service->nomorservice;
      $nama_pelanggan = $data_service->namapelanggan;
      $merk_laptop = $data_service->merklaptop;
      $keluhan = $data_service->keluhan;
      $diagnosis = $data_service->diagnosis;

      if ($status == 2) {
         $template = 'Halo ' . $this->pesanSelamat() . ' kak, %0A%0Aberikut adalah hasil diagnosis service laptop Anda dengan keterangan sebagai berikut: %0ANomor Service:%20' . $no_service . '%0ANama Pelanggan:%20' . $nama_pelanggan . '%0AMerk Laptop:%20' . $merk_laptop . '%0AKeluhan:%20' . $keluhan . '%0AHasil Diagnosis:%20' . $diagnosis . '%0A%0AApakah anda bersedia untuk melanjutkan te tahap pengerjaan?.';
      } else {
         $template = 'Halo ' . $this->pesanSelamat() . ' kak, %0A%0AHasil service laptop Anda dengan keterangan sebagai berikut: %0ANomor Service:%20' . $no_service . '%0ANama Pelanggan:%20' . $nama_pelanggan . '%0AMerk Laptop:%20' . $merk_laptop . '%0AKeluhan:%20' . $keluhan . '%0AHasil Diagnosis:%20' . $diagnosis . '%0A%0ATelah selesai dikerjakan. Silakan datang untuk mengambil laptop Anda. Terima kasih telah mempercayakan service laptop Anda kepada kami.';
      }

      $whatsappUrl = "https://api.whatsapp.com/send?phone=$no_telepon&text=$template";

      $url = base_url('listpelanggan');
      echo "<script>
            var newTab = window.open('$whatsappUrl', '_blank');

            setTimeout(function() {
               window.location.href = '$url';
            }, 1000); 
         </script>";
   }
   function convertNoTeleponToFormatInternational($no_telepon)
   {
      $no_telepon = preg_replace('/[^0-9]/', '', $no_telepon);

      if (substr($no_telepon, 0, 1) === '0') {
         $no_telepon = '+62' . substr($no_telepon, 1);
      }

      return $no_telepon;
   }
   function pesanSelamat()
   {
      date_default_timezone_set('Asia/Jakarta');

      $currentHour = date('G');

      if ($currentHour >= 5 && $currentHour < 12) {
         $pesanSelamat = 'selamat pagi';
      } elseif ($currentHour >= 12 && $currentHour < 15) {
         $pesanSelamat = 'selamat siang';
      } elseif ($currentHour >= 15 && $currentHour < 18) {
         $pesanSelamat = 'selamat sore';
      } else {
         $pesanSelamat = 'selamat malam';
      }

      return $pesanSelamat;
   }
}
