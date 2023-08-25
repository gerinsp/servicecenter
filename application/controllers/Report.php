<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{
   public function __construct()
   {
      parent::__construct();
      $this->load->model('Models', 'm');
   }


   public function printdataservice()
   {
      $this->load->library('dompdf_gen');
      $from     = $this->input->post("from");
      $to       = $this->input->post("to");

      date_default_timezone_set('Asia/Jakarta');

      $data = [
         'name'     => 'Print Data Service',
         'title'    => 'Data Service',
         'subtitle'  => 'Periode : ' . format_indo(date('Y-m-d', strtotime($from))) . ' To ' . format_indo(date('Y-m-d', strtotime($to))),
         'time'      =>  date('H:i:s')
      ];
      $select = $this->db->select('*');
      $select = $this->db->join('pelanggan', 'pelanggan.id_pelanggan=barang.id_pelanggan');
      $select = $this->db->where('tanggalservice BETWEEN "' . $from . '" and "' . $to . '"');
      $data['service'] = $this->m->Get_All('barang', $select);

      $select = $this->db->select('*,count(tbl_barang.id_barang) as jumlahservice');
      $select = $this->db->where('tanggalservice BETWEEN "' . date('Y-m-d', strtotime($from)) . '" and "' . date('Y-m-d', strtotime($to)) . '"');
      $data['totaldata'] = $this->m->Get_All('barang', $select);

      $select = $this->db->select('*,count(tbl_barang.id_barang) as jumlahunitmasuk');
      $select = $this->db->where('tanggalservice BETWEEN "' . date('Y-m-d', strtotime($from)) . '" and "' . date('Y-m-d', strtotime($to)) . '"');
      $select = $this->db->where('status', '1');
      $data['totaldataunitmasuk'] = $this->m->Get_All('barang', $select);

      $select = $this->db->select('*,count(tbl_barang.id_barang) as jumlahdiagnosis');
      $select = $this->db->where('tanggalservice BETWEEN "' . date('Y-m-d', strtotime($from)) . '" and "' . date('Y-m-d', strtotime($to)) . '"');
      $select = $this->db->where('status', '2');
      $data['totaldatadiagnosis'] = $this->m->Get_All('barang', $select);

      $select = $this->db->select('*,count(tbl_barang.id_barang) as jumlahpersiapan');
      $select = $this->db->where('tanggalservice BETWEEN "' . date('Y-m-d', strtotime($from)) . '" and "' . date('Y-m-d', strtotime($to)) . '"');
      $select = $this->db->where('status', '3');
      $data['totaldatapersiapan'] = $this->m->Get_All('barang', $select);

      $select = $this->db->select('*,count(tbl_barang.id_barang) as jumlahpengerjaan');
      $select = $this->db->where('tanggalservice BETWEEN "' . date('Y-m-d', strtotime($from)) . '" and "' . date('Y-m-d', strtotime($to)) . '"');
      $select = $this->db->where('status', '4');
      $data['totaldatapengerjaan'] = $this->m->Get_All('barang', $select);

      $select = $this->db->select('*,count(tbl_barang.id_barang) as jumlahselesai');
      $select = $this->db->where('tanggalservice BETWEEN "' . date('Y-m-d', strtotime($from)) . '" and "' . date('Y-m-d', strtotime($to)) . '"');
      $select = $this->db->where('status', '5');
      $data['totaldataselesai'] = $this->m->Get_All('barang', $select);




      $this->load->view('pages/report/printservice', $data);

      $paper_size = 'A4';
      $orintation = 'landscape';
      //$customPaper = array(0,0,850,1000);
      $html = $this->output->get_output();

      $this->dompdf->set_paper($paper_size, $orintation);
      $this->dompdf->load_html($html);
      $this->dompdf->render();
      $this->dompdf->stream("Data Service.pdf", array('Attachment' => 0));
   }
}
