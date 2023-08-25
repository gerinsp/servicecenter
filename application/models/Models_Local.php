<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Models_Local extends CI_Model
{
   function __construct()
   {
      parent::__construct();
      $this->db_rs = $this->load->database('dbrs', TRUE);
   }
   public function Get_All($table, $select)
   {
      $select;
      $query = $this->db_rs->get($table);
      return $query->result();
   }
   function getMaterial($postData)
   {
      $response = array();

      $this->db_rs->select('*');

      if ($postData['search']) {

         // Select record
         date_default_timezone_set('Asia/Jakarta');
         $now = date('Y-m-d H:i:s');
         $this->db_rs->order_by('material');
         $this->db_rs->where('tbl_material.deleted', 0);


         $records = $this->db_rs->get('tbl_material')->result();

         foreach ($records as $row) {
            $response[] = array("value" => $row->id_material, "label" => $row->material, "labelsatuan" => $row->satuan);
         }
      }

      return $response;
   }
   function getKursMaterial($postData, $tanggal)
   {
      $response = array();


      $this->db_rs->select('*');

      if ($postData['search'] and $tanggal['tanggaltransaksi']) {

         // Select record
         date_default_timezone_set('Asia/Jakarta');
         $now = date('Y-m-d H:i:s');
         $this->db_rs->where("tbl_kursmaterial.id_material like '%" . $postData['search'] . "%'");
         $this->db_rs->where('tbl_kursmaterial.tanggal <=', $tanggal['tanggaltransaksi']);
         $this->db_rs->where('tbl_kursmaterial.deleted', 0);
         $this->db_rs->order_by('tbl_kursmaterial.tanggal desc');
         $this->db_rs->limit(1);

         $records = $this->db_rs->get('tbl_kursmaterial')->result();

         foreach ($records as $row) {
            $response[] = array("labelrate_" => number_format($row->rate, 0, ',', '.'), "labelrate" => $row->rate, "labeltanggal" => $row->tanggal);
         }
      }

      return $response;
   }
   function getHargaProngSetting($postData, $setting)
   {
      $response = array();


      $this->db_rs->select('*');

      if ($postData['search'] and $setting['setting']) {

         // Select record
         date_default_timezone_set('Asia/Jakarta');
         $now = date('Y-m-d H:i:s');
         $this->db_rs->where(" '" . $postData['search'] . "' BETWEEN tbl_detailheadsetting.caratfrom and tbl_detailheadsetting.caratto");
         $this->db_rs->where("tbl_detailheadsetting.id_headsetting = '" . $setting['setting'] . "'");
         // $this->db_rs->where('tbl_detailheadsetting.deleted', 0);
         // $this->db_rs->order_by('tbl_kurs.tanggal desc');
         $this->db_rs->limit(1);

         $records = $this->db_rs->get('tbl_detailheadsetting')->result();

         foreach ($records as $row) {
            $response[] = array("labelrate_" => number_format($row->harga, 0, ',', '.'), "labelrate" => $row->harga);
         }
      }

      return $response;
   }
   function getOngkos($idtipedesign, $kesulitan)
   {

      $response = array();

      $this->db_rs->select('*');

      if ($idtipedesign['idtipedesign'] and $kesulitan['kesulitan']) {

         // Select record 

         $this->db_rs->join('tipedesign', 'tipedesign.id_tipe = ongkosrangka.id_tipe');
         $this->db_rs->where("tbl_ongkosrangka.id_tipe like '%" . $idtipedesign['idtipedesign'] . "%'");
         $this->db_rs->where("filter like '%" . $kesulitan['kesulitan'] . "%'");
         $this->db_rs->where("noro", "NO");
         $this->db_rs->where('tbl_ongkosrangka.deleted', 0);
         $this->db_rs->limit(5);

         $records = $this->db_rs->get('tbl_ongkosrangka')->result();

         foreach ($records as $row) {
            $response[] = array("labelidongkosrangka" => $row->id_ongkosrangka, "labelharga" => $row->ongkosrangka, "labelharga_" => number_format($row->ongkosrangka, 0, ',', '.'));
         }
      }

      return $response;
   }
   public function autonumbering2ddesain($postData)
   {

      $this->db_rs->select('RIGHT(tbl_2ddesainheader.id_header,' . $postData['search'] . ')as id_header', FALSE);


      $this->db_rs->where('tbl_2ddesainheader.deleted', 0);
      $this->db_rs->order_by('tbl_2ddesainheader.id_header', 'DESC');
      $this->db_rs->limit(1);
      $this->db_rs->where('deleted', 0);
      $query = $this->db_rs->get('tbl_2ddesainheader');
      if ($query->num_rows() <> 0) {
         $data = $query->row();
         $kode = intval($data->id_header) + 1;
      } else {
         $kode = 1;
      }
      $batas = str_pad($kode, $postData['search'], 0, STR_PAD_LEFT);
      $kodetampil = $batas;

      $response[] = array("tampil" => $kodetampil);


      return $response;
   }
   function getKursMataUang($postData, $tanggal)
   {
      $response = array();


      $this->db_rs->select('*');

      if ($postData['search'] and $tanggal['tanggaltransaksi']) {

         // Select record
         date_default_timezone_set('Asia/Jakarta');
         $now = date('Y-m-d H:i:s');
         $this->db_rs->where("tbl_kurs.id_matauang like '%" . $postData['search'] . "%'");
         $this->db_rs->where('tbl_kurs.tanggal <=', $tanggal['tanggaltransaksi']);
         $this->db_rs->where('tbl_kurs.deleted', 0);
         $this->db_rs->order_by('tbl_kurs.tanggal desc');
         $this->db_rs->limit(1);

         $records = $this->db_rs->get('tbl_kurs')->result();

         foreach ($records as $row) {
            $response[] = array("labelrate_" => number_format($row->rate, 0, ',', '.'), "labelrate" => $row->rate, "labeltanggal" => $row->tanggal);
         }
      }

      return $response;
   }
   public function autonumberingcashbank($postData)
   {

      $this->db_rs->select('RIGHT(tbl_cashbankheader.nomor,' . $postData['search'] . ')as nomor', FALSE);
      $this->db_rs->order_by('id_cashbankheader', 'DESC');
      $this->db_rs->limit(1);
      $this->db_rs->where('deleted', 0);
      $query = $this->db_rs->get('tbl_cashbankheader');
      if ($query->num_rows() <> 0) {
         $data = $query->row();
         $kode = intval($data->nomor) + 1;
      } else {
         $kode = 1;
      }
      $batas = str_pad($kode, $postData['search'], "0", STR_PAD_LEFT);
      $kodetampil = $batas;

      $response[] = array("tampil" => $kodetampil);


      return $response;
   }
   public function autonumberingspk($postData)
   {

      $this->db_rs->select('RIGHT(tbl_spkheader.nomorspk,' . $postData['search'] . ')as nomor', FALSE);
      $this->db_rs->order_by('id_spkheader', 'DESC');
      $this->db_rs->limit(1);
      $this->db_rs->where('deleted', 0);
      $query = $this->db_rs->get('tbl_spkheader');
      if ($query->num_rows() <> 0) {
         $data = $query->row();
         $kode = intval($data->nomor) + 1;
      } else {
         $kode = 1;
      }
      $batas = str_pad($kode, $postData['search'], "0", STR_PAD_LEFT);
      $kodetampil = $batas;

      $response[] = array("tampil" => $kodetampil);


      return $response;
   }
   public function autonumberingcasting($postData)
   {

      $this->db_rs->select('RIGHT(tbl_castingheader.nomorcasting,' . $postData['search'] . ')as nomor', FALSE);
      $this->db_rs->order_by('id_castingheader', 'DESC');
      $this->db_rs->limit(1);
      $this->db_rs->where('deleted', 0);
      $query = $this->db_rs->get('tbl_castingheader');
      if ($query->num_rows() <> 0) {
         $data = $query->row();
         $kode = intval($data->nomor) + 1;
      } else {
         $kode = 1;
      }
      $batas = str_pad($kode, $postData['search'], "0", STR_PAD_LEFT);
      $kodetampil = $batas;

      $response[] = array("tampil" => $kodetampil);


      return $response;
   }
   public function autonumberingpembelian($postData)
   {

      $this->db_rs->select('RIGHT(tbl_headerpembelian.id_headerpembelian,' . $postData['search'] . ')as nomor', FALSE);
      $this->db_rs->order_by('id_headerpembelian', 'DESC');
      $this->db_rs->limit(1);
      $this->db_rs->where('deleted', 0);
      $query = $this->db_rs->get('tbl_headerpembelian');
      if ($query->num_rows() <> 0) {
         $data = $query->row();
         $kode = intval($data->nomor) + 1;
      } else {
         $kode = 1;
      }
      $batas = str_pad($kode, $postData['search'], "0", STR_PAD_LEFT);
      $kodetampil = $batas;

      $response[] = array("tampil" => $kodetampil);


      return $response;
   }
   public function autonumberingproduksi($postData)
   {

      $this->db_rs->select('RIGHT(tbl_headerproduksi.id_headerproduksi,' . $postData['search'] . ')as nomor', FALSE);
      $this->db_rs->order_by('id_headerproduksi', 'DESC');
      $this->db_rs->limit(1);
      $this->db_rs->where('deleted', 0);
      $query = $this->db_rs->get('tbl_headerproduksi');
      if ($query->num_rows() <> 0) {
         $data = $query->row();
         $kode = intval($data->nomor) + 1;
      } else {
         $kode = 1;
      }
      $batas = str_pad($kode, $postData['search'], "0", STR_PAD_LEFT);
      $kodetampil = $batas;

      $response[] = array("tampil" => $kodetampil);


      return $response;
   }
   function getWarnaProduk($postData)
   {

      $response = array();

      $this->db_rs->select('*');

      if ($postData['search']) {

         // Select record


         $this->db_rs->where("warnaproduk like '%" . $postData['search'] . "%'");
         $this->db_rs->where('tbl_warnaproduk.deleted', 0);
         $this->db_rs->limit(5);

         $records = $this->db_rs->get('tbl_warnaproduk')->result();

         foreach ($records as $row) {
            $response[] = array("value" => $row->id_warnaproduk, "label" => $row->warnaproduk);
         }
      }

      return $response;
   }
   function getCategory($postData)
   {

      $response = array();

      $this->db_rs->select('*');

      if ($postData['search']) {

         // Select record


         $this->db_rs->where("keterangan like '%" . $postData['search'] . "%'");
         $this->db_rs->where('tbl_masterid.deleted', 0);
         $this->db_rs->where('tbl_masterid.masterid', "Category");
         $this->db_rs->limit(5);

         $records = $this->db_rs->get('tbl_masterid')->result();

         foreach ($records as $row) {
            $response[] = array("value" => $row->id_masterid, "label" => $row->keterangan);
         }
      }

      return $response;
   }
   function getKaryawanCasting($postData)
   {

      $response = array();

      $this->db_rs->select('*');

      if ($postData['search']) {

         // Select record


         $this->db_rs->join('tbl_bagian', 'tbl_bagian.id_bagian = tbl_karyawan.id_bagian');

         $this->db_rs->where("nama like '%" . $postData['search'] . "%'");
         $this->db_rs->where('tbl_bagian.bagian', 'Casting');
         $this->db_rs->where('tbl_karyawan.deleted', 0);
         $this->db_rs->order_by('nama');
         $this->db_rs->limit(5);

         $records = $this->db_rs->get('tbl_karyawan')->result();

         foreach ($records as $row) {
            $response[] = array("value" => $row->id_karyawan, "label" => $row->nama);
         }
      }

      return $response;
   }
   function getLokasi($postData)
   {

      $response = array();

      $this->db_rs->select('*');

      if ($postData['search']) {

         // Select record


         $this->db_rs->where("keterangan like '%" . $postData['search'] . "%'");
         $this->db_rs->where('tbl_masterid.deleted', 0);
         $this->db_rs->where('tbl_masterid.masterid', "Lokasi");
         $this->db_rs->limit(5);

         $records = $this->db_rs->get('tbl_masterid')->result();

         foreach ($records as $row) {
            $response[] = array("value" => $row->id_masterid, "label" => $row->keterangan);
         }
      }

      return $response;
   }
   function getLawanTransaksi($postData)
   {

      $response = array();

      $this->db_rs->select('*');

      if ($postData['search']) {

         // Select record


         $this->db_rs->where("nama like '%" . $postData['search'] . "%'");
         $this->db_rs->where('tbl_client.deleted', 0);
         $this->db_rs->limit(5);

         $records = $this->db_rs->get('tbl_client')->result();

         foreach ($records as $row) {
            $response[] = array("value" => $row->id_client, "label" => $row->nama);
         }
      }

      return $response;
   }
   function getParcel($postData)
   {

      $response = array();

      $select = $this->db_rs->select('*, tbl_diagroup.diagroup, tbl_diameter.id_diagroup, tbl_diameter.diameter_to, tbl_diameter.diameter_from, tbl_diameter.carat');

      if ($postData['search']) {

         // Select record

         $this->db_rs->join('tbl_diameter', 'tbl_diameter.id_diameter = tbl_parcel.id_diameter');
         $this->db_rs->join('tbl_diagroup', 'tbl_diagroup.id_diagroup = tbl_diameter.id_diagroup');
         $this->db_rs->join('tbl_clarity', 'tbl_clarity.id_clarity = tbl_parcel.id_clarity');
         $this->db_rs->join('tbl_shape', 'tbl_shape.id_shape = tbl_parcel.id_shape');
         $this->db_rs->join('tbl_color', 'tbl_color.id_color = tbl_parcel.id_color');
         $this->db_rs->where("parcel like '%" . $postData['search'] . "%'");
         $this->db_rs->where('tbl_parcel.deleted', 0);
         $this->db_rs->order_by('diagroup asc, parcel asc, diameter_from asc, diameter_to asc');
         $this->db_rs->limit(5);

         $records = $this->db_rs->get('tbl_parcel')->result();

         foreach ($records as $row) {
            $response[] = array("value" => $row->id_parcel, "label" => $row->parcel, "labelclarity" => $row->clarity, "labelshape" => $row->shape, "labelshape" => $row->shape, "labelcolor" => $row->color, "labelharga" => number_format($row->hargabeli, 0, ',', '.'));
         }
      }

      return $response;
   }
   function getBarang($postData)
   {

      $response = array();


      $this->db_rs->select('*, a.keterangan as tipeproduk, b.keterangan as brand, c.keterangan as category, d.keterangan as etalase, e.keterangan as jenisgaransi, f.keterangan as periodegaransi, g.keterangan as claimgaransi, h.keterangan as kondisi, i.keterangan as satuanbesar, j.keterangan as satuankecil');
      if ($postData['search']) {

         // Select record


         $this->db_rs->join('tbl_masterid as a', 'a.id_masterid = tbl_masterproduk.id_tipeproduk');
         $this->db_rs->join('tbl_masterid as b', 'b.id_masterid = tbl_masterproduk.id_brand');
         $this->db_rs->join('tbl_masterid as c', 'c.id_masterid = tbl_masterproduk.id_category');
         $this->db_rs->join('tbl_masterid as d', 'd.id_masterid = tbl_masterproduk.id_etalase');
         $this->db_rs->join('tbl_masterid as e', 'e.id_masterid = tbl_masterproduk.id_jenisgaransi');
         $this->db_rs->join('tbl_masterid as f', 'f.id_masterid = tbl_masterproduk.id_periodegaransi');
         $this->db_rs->join('tbl_masterid as g', 'g.id_masterid = tbl_masterproduk.id_claimgaransi');
         $this->db_rs->join('tbl_masterid as h', 'h.id_masterid = tbl_masterproduk.id_kondisi');
         $this->db_rs->join('tbl_masterid as i', 'i.id_masterid = tbl_masterproduk.id_satuanbesar');
         $this->db_rs->join('tbl_masterid as j', 'j.id_masterid = tbl_masterproduk.id_satuankecil');
         $this->db_rs->join('tbl_matauang', 'tbl_matauang.id_matauang = tbl_masterproduk.id_matauang');
         $this->db_rs->where("namaproduk like '%" . $postData['search'] . "%'");
         $this->db_rs->where('tbl_masterproduk.deleted', 0);
         $this->db_rs->order_by('namaproduk');
         $this->db_rs->limit(5);

         $records = $this->db_rs->get('tbl_masterproduk')->result();

         foreach ($records as $row) {
            $response[] = array("value" => $row->id_produk, "label" => $row->namaproduk, "labeltipeproduk" => $row->tipeproduk, "labelbrand" => $row->brand, "labeletalase" => $row->etalase, "labelkondisi" => $row->kondisi, "labelharga" => $row->hargabeli, "labelharga_" => number_format($row->hargabeli, 0, ',', '.'));
         }
      }

      return $response;
   }
   function getJenisGaransi($postData)
   {

      $response = array();

      $this->db_rs->select('*');

      if ($postData['search']) {

         // Select record


         $this->db_rs->where("keterangan like '%" . $postData['search'] . "%'");
         $this->db_rs->where('tbl_masterid.deleted', 0);
         $this->db_rs->where('tbl_masterid.masterid', "Jenis Garansi");
         $this->db_rs->limit(5);

         $records = $this->db_rs->get('tbl_masterid')->result();

         foreach ($records as $row) {
            $response[] = array("value" => $row->id_masterid, "label" => $row->keterangan);
         }
      }

      return $response;
   }
   function getBrand($postData)
   {

      $response = array();

      $this->db_rs->select('*');

      if ($postData['search']) {

         // Select record


         $this->db_rs->where("keterangan like '%" . $postData['search'] . "%'");
         $this->db_rs->where('tbl_masterid.deleted', 0);
         $this->db_rs->where('tbl_masterid.masterid', "Brand");
         $this->db_rs->limit(5);

         $records = $this->db_rs->get('tbl_masterid')->result();

         foreach ($records as $row) {
            $response[] = array("value" => $row->id_masterid, "label" => $row->keterangan);
         }
      }

      return $response;
   }
   function getPeriodeGaransi($postData)
   {

      $response = array();

      $this->db_rs->select('*');

      if ($postData['search']) {

         // Select record


         $this->db_rs->where("keterangan like '%" . $postData['search'] . "%'");
         $this->db_rs->where('tbl_masterid.deleted', 0);
         $this->db_rs->where('tbl_masterid.masterid', "Periode Garansi");
         $this->db_rs->limit(5);

         $records = $this->db_rs->get('tbl_masterid')->result();

         foreach ($records as $row) {
            $response[] = array("value" => $row->id_masterid, "label" => $row->keterangan);
         }
      }

      return $response;
   }
   function getEtalase($postData)
   {

      $response = array();

      $this->db_rs->select('*');

      if ($postData['search']) {

         // Select record


         $this->db_rs->where("keterangan like '%" . $postData['search'] . "%'");
         $this->db_rs->where('tbl_masterid.deleted', 0);
         $this->db_rs->where('tbl_masterid.masterid', "Etalase");
         $this->db_rs->limit(5);

         $records = $this->db_rs->get('tbl_masterid')->result();

         foreach ($records as $row) {
            $response[] = array("value" => $row->id_masterid, "label" => $row->keterangan);
         }
      }

      return $response;
   }
   function getClaimGaransi($postData)
   {

      $response = array();

      $this->db_rs->select('*');

      if ($postData['search']) {

         // Select record


         $this->db_rs->where("keterangan like '%" . $postData['search'] . "%'");
         $this->db_rs->where('tbl_masterid.deleted', 0);
         $this->db_rs->where('tbl_masterid.masterid', "Claim Garansi");
         $this->db_rs->limit(5);

         $records = $this->db_rs->get('tbl_masterid')->result();

         foreach ($records as $row) {
            $response[] = array("value" => $row->id_masterid, "label" => $row->keterangan);
         }
      }

      return $response;
   }
   function getSatuanBesar($postData)
   {

      $response = array();

      $this->db_rs->select('*');

      if ($postData['search']) {

         // Select record


         $this->db_rs->where("keterangan like '%" . $postData['search'] . "%'");
         $this->db_rs->where('tbl_masterid.deleted', 0);
         $this->db_rs->where('tbl_masterid.masterid', "Satuan Besar");
         $this->db_rs->limit(5);

         $records = $this->db_rs->get('tbl_masterid')->result();

         foreach ($records as $row) {
            $response[] = array("value" => $row->id_masterid, "label" => $row->keterangan);
         }
      }

      return $response;
   }
   function getSatuanKecil($postData)
   {

      $response = array();

      $this->db_rs->select('*');

      if ($postData['search']) {

         // Select record


         $this->db_rs->where("keterangan like '%" . $postData['search'] . "%'");
         $this->db_rs->where('tbl_masterid.deleted', 0);
         $this->db_rs->where('tbl_masterid.masterid', "Satuan Kecil");
         $this->db_rs->limit(5);

         $records = $this->db_rs->get('tbl_masterid')->result();

         foreach ($records as $row) {
            $response[] = array("value" => $row->id_masterid, "label" => $row->keterangan);
         }
      }

      return $response;
   }
   function getKondisi($postData)
   {

      $response = array();

      $this->db_rs->select('*');

      if ($postData['search']) {

         // Select record


         $this->db_rs->where("keterangan like '%" . $postData['search'] . "%'");
         $this->db_rs->where('tbl_masterid.deleted', 0);
         $this->db_rs->where('tbl_masterid.masterid', "Kondisi");
         $this->db_rs->limit(5);

         $records = $this->db_rs->get('tbl_masterid')->result();

         foreach ($records as $row) {
            $response[] = array("value" => $row->id_masterid, "label" => $row->keterangan);
         }
      }

      return $response;
   }
   function getTipeProduk($postData)
   {

      $response = array();

      $this->db_rs->select('*');

      if ($postData['search']) {

         // Select record


         $this->db_rs->where("keterangan like '%" . $postData['search'] . "%'");
         $this->db_rs->where('tbl_masterid.deleted', 0);
         $this->db_rs->where('tbl_masterid.masterid', "Tipe Produk");
         $this->db_rs->limit(5);

         $records = $this->db_rs->get('tbl_masterid')->result();

         foreach ($records as $row) {
            $response[] = array("value" => $row->id_masterid, "label" => $row->keterangan);
         }
      }

      return $response;
   }
   function getClient($postData)
   {

      $response = array();

      $this->db_rs->select('*');

      if ($postData['search']) {

         // Select record

         $this->db_rs->where("nama like '%" . $postData['search'] . "%'");
         $this->db_rs->where('tbl_client.deleted', 0);
         $this->db_rs->order_by('nama');
         $this->db_rs->limit(5);

         $records = $this->db_rs->get('tbl_client')->result();

         foreach ($records as $row) {
            $response[] = array("value" => $row->id_client, "label" => $row->nama);
         }
      }

      return $response;
   }
   function getDesain($postData)
   {

      $response = array();

      $this->db_rs->select('*');
      $this->db_rs->join('tbl_2ddesainheader', 'tbl_2ddesainheader.id_header = tbl_2ddesaindetail.id_header');

      if ($postData['search']) {

         // Select record

         $this->db_rs->where("tbl_2ddesainheader.nomor like '%" . $postData['search'] . "%'");
         $this->db_rs->where('tbl_2ddesaindetail.deleted', 0);
         $this->db_rs->order_by('tbl_2ddesainheader.nomor');
         $this->db_rs->limit(5);

         $records = $this->db_rs->get('tbl_2ddesaindetail')->result();

         foreach ($records as $row) {
            $response[] = array("value" => $row->id_detail, "label" => $row->nomor);
         }
      }

      return $response;
   }
   function getMataUang($postData)
   {

      $response = array();

      $this->db_rs->select('*');

      if ($postData['search']) {

         // Select record


         $this->db_rs->where("kodematauang like '%" . $postData['search'] . "%'");
         $this->db_rs->where('tbl_matauang.deleted', 0);
         $this->db_rs->limit(5);

         $records = $this->db_rs->get('tbl_matauang')->result();

         foreach ($records as $row) {
            $response[] = array("value" => $row->id_matauang, "label" => $row->kodematauang);
         }
      }

      return $response;
   }
   function getKaryawan($postData)
   {

      $response = array();

      $this->db_rs->select('*');

      if ($postData['search']) {

         // Select record

         $this->db_rs->join('tbl_bagian', 'tbl_bagian.id_bagian = tbl_karyawan.id_bagian');
         $this->db_rs->order_by('nama');
         $this->db_rs->where('tbl_bagian.bagian', 'Designer 2D');
         $this->db_rs->where('tbl_karyawan.deleted', 0);
         $this->db_rs->limit(5);

         $records = $this->db_rs->get('tbl_karyawan')->result();

         foreach ($records as $row) {
            $response[] = array("value" => $row->id_karyawan, "label" => $row->nama);
         }
      }

      return $response;
   }

   function getFinishing($postData)
   {

      $response = array();

      $this->db_rs->select('*');

      if ($postData['search']) {

         // Select record


         $this->db_rs->where("finishing like '%" . $postData['search'] . "%'");
         $this->db_rs->where('tbl_finishing.deleted', 0);
         $this->db_rs->limit(5);

         $records = $this->db_rs->get('tbl_finishing')->result();

         foreach ($records as $row) {
            $response[] = array("value" => $row->id_finishing, "label" => $row->finishing);
         }
      }

      return $response;
   }

   function getTipeDesign($postData)
   {

      $response = array();

      $this->db_rs->select('*');

      if ($postData['search']) {

         // Select record


         $this->db_rs->where("tipedesign like '%" . $postData['search'] . "%'");
         $this->db_rs->where('tbl_tipedesign.deleted', 0);
         $this->db_rs->limit(5);

         $records = $this->db_rs->get('tbl_tipedesign')->result();

         foreach ($records as $row) {
            $response[] = array("value" => $row->id_tipe, "label" => $row->tipedesign);
         }
      }

      return $response;
   }
   function getkonsepkepala($postData)
   {

      $response = array();

      $this->db_rs->select('*');

      if ($postData['search']) {

         // Select record


         $this->db_rs->where("konsepkepala like '%" . $postData['search'] . "%'");
         $this->db_rs->where('tbl_konsepkepala.deleted', 0);
         $this->db_rs->limit(5);

         $records = $this->db_rs->get('tbl_konsepkepala')->result();

         foreach ($records as $row) {
            $response[] = array("value" => $row->id_konsepkepala, "label" => $row->konsepkepala);
         }
      }

      return $response;
   }
   function getAkunCoaSatu($postData)
   {

      $response = array();

      $this->db_rs->select('*');

      if ($postData['search']) {

         // Select record
         $this->db_rs->join('tbl_groupakun', 'tbl_groupakun.id_groupakun = tbl_coa.id_groupakun');
         $this->db_rs->where("akun like '%" . $postData['search'] . "%'");
         $this->db_rs->where('groupakun', "CASH BANK");
         $this->db_rs->where('tbl_coa.deleted', 0);
         $this->db_rs->where('headerdetail', "D");

         $records = $this->db_rs->get('tbl_coa')->result();

         foreach ($records as $row) {
            $response[] = array("value" => $row->namaakun, "label" => $row->akun);
         }
      }

      return $response;
   }
   function getAkunCoaDua($postData)
   {

      $response = array();

      $this->db_rs->select('*');

      if ($postData['search']) {

         // Select record
         $this->db_rs->join('tbl_groupakun', 'tbl_groupakun.id_groupakun = tbl_coa.id_groupakun');
         $this->db_rs->where("akun like '%" . $postData['search'] . "%'");
         $this->db_rs->where('tbl_coa.deleted', 0);
         $this->db_rs->where('headerdetail', "D");

         $records = $this->db_rs->get('tbl_coa')->result();

         foreach ($records as $row) {
            $response[] = array("value" => $row->namaakun, "label" => $row->akun);
         }
      }

      return $response;
   }
   public function Get_Where($where, $table)
   {
      $query = $this->db_rs->get_where($table, $where);
      return $query->row();
   }
   public function Get_WhereJoin($where, $table)
   {
      $join = array('tbl_role', 'tbl_role.id = tbl_user.id_user');
      $query = $this->db_rs->join($join[0], $join[1])->get_where($table, $where);
      return $query->row();
   }
   function Save($data, $table)
   {
      $result = $this->db_rs->insert($table, $data);
      return $result;
   }
   function Update($where, $data, $table)
   {
      $this->db_rs->update($table, $data, $where);
      return $this->db_rs->affected_rows();
   }
   function Update_Wherein($where, $data, $table)
   {

      $this->db_rs->where_in($where);
      $this->db_rs->update($table, $data);
      return $this->db_rs->affected_rows();
   }
   function Update_All($data, $table)
   {
      $this->db_rs->update($table, $data);
      return $this->db_rs->affected_rows();
   }
   function Delete($where, $table)
   {
      $result = $this->db_rs->delete($table, $where);
      return $result;
   }

   function Delete_Relasi()
   {

      $query = "DELETE a.*, b.*, c.* FROM tbl_2ddesaindetail a , tbl_2ddesainsubdetail b, tbl_2ddesainkepala c where a.id_detail = b.id_detail and a.id_detail = c.id_detail and a.id_header = 0";
      return $this->db_rs->query($query);
   }
   function Delete_All($table)
   {
      $result = $this->db_rs->delete($table);
      return $result;
   }
   public function Masuk($username, $userpass)
   {
      $this->db_rs->select('*');
      $this->db_rs->from('user');

      $this->db_rs->where('id', $username);
      $this->db_rs->where('password', $userpass);

      $query = $this->db_rs->get();

      if ($query->num_rows() > 0) {
         return $query->result();
      } else {
         return false;
      }
   }
   public function get_by_id($id, $table)
   {
      $this->db_rs->from($table);
      $this->db_rs->where('id_penjualan', $id);
      $query = $this->db_rs->get();

      return $query->row();
   }
   public function levelotomatis($kode)
   {

      $this->db_rs->select('RIGHT(tbl_coa.level,1)as level', FALSE);
      $this->db_rs->order_by('id_coa', 'desc');
      $this->db_rs->where('headerdetail', 'H');
      $this->db_rs->where('kode', $kode);
      $this->db_rs->limit(1);
      $query = $this->db_rs->get('tbl_coa');
      if ($query->num_rows() <> 0) {
         $data = $query->row();
         $kode = intval($data->level) + 1;
      } else {
         $kode = 1;
      }
      $batas = str_pad($kode, "0", STR_PAD_LEFT);
      $kodetampil = $batas;
      return $kodetampil;
   }

   public function id_headerreferance()
   {

      $this->db_rs->select('RIGHT(tbl_header_reference.id_header,1)as id_header', FALSE);
      $this->db_rs->order_by('id_header', 'desc');

      $this->db_rs->limit(1);
      $query = $this->db_rs->get('tbl_header_reference');
      if ($query->num_rows() <> 0) {
         $data = $query->row();
         $kode = intval($data->id_header) + 1;
      } else {
         $kode = 1;
      }
      $batas = str_pad($kode, "0", STR_PAD_LEFT);
      $kodetampil = $batas;
      return $kodetampil;
   }

   public function id_cashbankheader()
   {

      $this->db_rs->select('RIGHT(tbl_cashbankheader.id_cashbankheader,1)as id_cashbankheader', FALSE);
      $this->db_rs->order_by('id_cashbankheader', 'desc');

      $this->db_rs->limit(1);
      $query = $this->db_rs->get('tbl_cashbankheader');
      if ($query->num_rows() <> 0) {
         $data = $query->row();
         $kode = intval($data->id_cashbankheader) + 1;
      } else {
         $kode = 1;
      }
      $batas = str_pad($kode, "0", STR_PAD_LEFT);
      $kodetampil = $batas;
      return $kodetampil;
   }

   public function id_spkdetail()
   {

      $this->db_rs->select('RIGHT(tbl_spkdetail.id_spkdetail,1)as id_spkdetail', FALSE);
      $this->db_rs->order_by('id_spkdetail', 'desc');

      $this->db_rs->limit(1);
      $query = $this->db_rs->get('tbl_spkdetail');
      if ($query->num_rows() <> 0) {
         $data = $query->row();
         $kode = intval($data->id_spkdetail) + 1;
      } else {
         $kode = 1;
      }
      $batas = str_pad($kode, "0", STR_PAD_LEFT);
      $kodetampil = $batas;
      return $kodetampil;
   }

   public function id_spkheader()
   {
      $this->db_rs->select_max('tbl_spkheader.id_spkheader');
      $this->db_rs->order_by('id_spkheader', 'desc');

      $this->db_rs->limit(1);
      $query = $this->db_rs->get('tbl_spkheader');
      if ($query->num_rows() <> 0) {
         $data = $query->row();
         $kode = intval($data->id_spkheader) + 1;
      } else {
         $kode = 1;
      }
      $batas = str_pad($kode, "0", STR_PAD_LEFT);
      $kodetampil = $batas;
      return $kodetampil;
   }

   public function id_castingheader()
   {

      $this->db_rs->select_max('tbl_castingheader.id_castingheader');
      $this->db_rs->order_by('id_castingheader', 'desc');

      $this->db_rs->limit(1);
      $query = $this->db_rs->get('tbl_castingheader');
      if ($query->num_rows() <> 0) {
         $data = $query->row();
         $kode = intval($data->id_castingheader) + 1;
      } else {
         $kode = 1;
      }
      $batas = str_pad($kode, "0", STR_PAD_LEFT);
      $kodetampil = $batas;
      return $kodetampil;
   }

   public function id_headerproduksi()
   {
      $this->db_rs->select_max('tbl_headerproduksi.id_headerproduksi');
      $this->db_rs->order_by('header', 'desc');

      $this->db_rs->limit(1);
      $query = $this->db_rs->get('tbl_headerproduksi');
      if ($query->num_rows() <> 0) {
         $data = $query->row();
         $kode = intval($data->id_headerproduksi) + 1;
      } else {
         $kode = 1;
      }
      $batas = str_pad($kode, "0", STR_PAD_LEFT);
      $kodetampil = $batas;
      return $kodetampil;
   }

   public function id_header()
   {

      $this->db_rs->select_max('tbl_2ddesainheader.id_header');
      $this->db_rs->order_by('id_header', 'desc');

      $this->db_rs->limit(1);
      $query = $this->db_rs->get('tbl_2ddesainheader');
      if ($query->num_rows() <> 0) {
         $data = $query->row();
         $kode = intval($data->id_header) + 1;
      } else {
         $kode = 1;
      }
      $batas = str_pad($kode, "0", STR_PAD_LEFT);
      $kodetampil = $batas;
      return $kodetampil;
   }
   public function id_detail()
   {

      $this->db_rs->select_max('tbl_2ddesaindetail.id_detail');
      $this->db_rs->order_by('id_detail', 'desc');

      $this->db_rs->limit(1);
      $query = $this->db_rs->get('tbl_2ddesaindetail');
      if ($query->num_rows() <> 0) {
         $data = $query->row();
         $kode = intval($data->id_detail) + 1;
      } else {
         $kode = 1;
      }
      $batas = str_pad($kode, "0", STR_PAD_LEFT);
      $kodetampil = $batas;
      return $kodetampil;
   }
   public function id_headerpembelian()
   {

      $this->db_rs->select_max('tbl_headerpembelian.id_headerpembelian');
      $this->db_rs->order_by('id_headerpembelian', 'desc');

      $this->db_rs->limit(1);
      $query = $this->db_rs->get('tbl_headerpembelian');
      if ($query->num_rows() <> 0) {
         $data = $query->row();
         $kode = intval($data->id_headerpembelian) + 1;
      } else {
         $kode = 1;
      }
      $batas = str_pad($kode, "0", STR_PAD_LEFT);
      $kodetampil = $batas;
      return $kodetampil;
   }
   public function id_detailpembelian()
   {

      $this->db_rs->select_max('tbl_detailpembelian.id_detailpembelian');
      $this->db_rs->order_by('id_detailpembelian', 'desc');

      $this->db_rs->limit(1);
      $query = $this->db_rs->get('tbl_detailpembelian');
      if ($query->num_rows() <> 0) {
         $data = $query->row();
         $kode = intval($data->id_detailpembelian) + 1;
      } else {
         $kode = 1;
      }
      $batas = str_pad($kode, "0", STR_PAD_LEFT);
      $kodetampil = $batas;
      return $kodetampil;
   }

   public function id_detailcastingpohon()
   {

      $this->db_rs->select_max('tbl_detailcastingpohon.id_castingpohondetail');
      $this->db_rs->order_by('id_castingpohondetail', 'desc');

      $this->db_rs->limit(1);
      $query = $this->db_rs->get('tbl_detailcastingpohon');
      if ($query->num_rows() <> 0) {
         $data = $query->row();
         $kode = intval($data->id_castingpohondetail) + 1;
      } else {
         $kode = 1;
      }
      $batas = str_pad($kode, "0", STR_PAD_LEFT);
      $kodetampil = $batas;
      return $kodetampil;
   }
   public function id_serahterima()
   {

      $this->db_rs->select_max('tbl_serahterima.id_serahterima');
      $this->db_rs->order_by('id_serahterima', 'desc');

      $this->db_rs->limit(1);
      $query = $this->db_rs->get('tbl_serahterima');
      if ($query->num_rows() <> 0) {
         $data = $query->row();
         $kode = intval($data->id_serahterima) + 1;
      } else {
         $kode = 1;
      }
      $batas = str_pad($kode, "0", STR_PAD_LEFT);
      $kodetampil = $batas;
      return $kodetampil;
   }
   public function id_perekat()
   {

      $this->db_rs->select_max('tbl_perekat.id_perekat');
      $this->db_rs->order_by('id_perekat', 'desc');

      $this->db_rs->limit(1);
      $query = $this->db_rs->get('tbl_perekat');
      if ($query->num_rows() <> 0) {
         $data = $query->row();
         $kode = intval($data->tbl_perekat) + 1;
      } else {
         $kode = 1;
      }
      $batas = str_pad($kode, "0", STR_PAD_LEFT);
      $kodetampil = $batas;
      return $kodetampil;
   }
   public function id_kalkulasi()
   {

      $this->db_rs->select_max('tbl_kalkulasisusut.id_kalkulasi');
      $this->db_rs->order_by('id_kalkulasi', 'desc');

      $this->db_rs->limit(1);
      $query = $this->db_rs->get('tbl_kalkulasisusut');
      if ($query->num_rows() <> 0) {
         $data = $query->row();
         $kode = intval($data->id_kalkulasi) + 1;
      } else {
         $kode = 1;
      }
      $batas = str_pad($kode, "0", STR_PAD_LEFT);
      $kodetampil = $batas;
      return $kodetampil;
   }
   public function id_lebur()
   {

      $this->db_rs->select_max('tbl_transaksilebur.id_lebur');
      $this->db_rs->order_by('id_lebur', 'desc');

      $this->db_rs->limit(1);
      $query = $this->db_rs->get('tbl_transaksilebur');
      if ($query->num_rows() <> 0) {
         $data = $query->row();
         $kode = intval($data->id_lebur) + 1;
      } else {
         $kode = 1;
      }
      $batas = str_pad($kode, "0", STR_PAD_LEFT);
      $kodetampil = $batas;
      return $kodetampil;
   }
   public function id_pemakaianbahan()
   {

      $this->db_rs->select_max('tbl_pemakaianbahan.id_pemakaianbahan');
      $this->db_rs->order_by('id_pemakaianbahan', 'desc');

      $this->db_rs->limit(1);
      $query = $this->db_rs->get('tbl_pemakaianbahan');
      if ($query->num_rows() <> 0) {
         $data = $query->row();
         $kode = intval($data->id_pemakaianbahan) + 1;
      } else {
         $kode = 1;
      }
      $batas = str_pad($kode, "0", STR_PAD_LEFT);
      $kodetampil = $batas;
      return $kodetampil;
   }
   public function id_produksifinished()
   {

      $this->db_rs->select_max('tbl_produksifinished.id_produksifinished');
      $this->db_rs->order_by('id_produksifinished', 'desc');

      $this->db_rs->limit(1);
      $query = $this->db_rs->get('tbl_produksifinished');
      if ($query->num_rows() <> 0) {
         $data = $query->row();
         $kode = intval($data->id_produksifinished) + 1;
      } else {
         $kode = 1;
      }
      $batas = str_pad($kode, "0", STR_PAD_LEFT);
      $kodetampil = $batas;
      return $kodetampil;
   }
   public function id_castingfinished()
   {

      $this->db_rs->select_max('tbl_castingfinished.id_castingfinished');
      $this->db_rs->order_by('id_castingfinished', 'desc');

      $this->db_rs->limit(1);
      $query = $this->db_rs->get('tbl_castingfinished');
      if ($query->num_rows() <> 0) {
         $data = $query->row();
         $kode = intval($data->id_castingfinished) + 1;
      } else {
         $kode = 1;
      }
      $batas = str_pad($kode, "0", STR_PAD_LEFT);
      $kodetampil = $batas;
      return $kodetampil;
   }

   public function headecastingfinished()
   {
      $this->db_rs->select('RIGHT(tbl_castingfinished.header,5) as header', FALSE);
      $this->db_rs->order_by('id_castingfinished', 'DESC');
      $this->db_rs->limit(1);
      $query = $this->db_rs->get('tbl_castingfinished');
      if ($query->num_rows() <> 0) {
         $data = $query->row();
         $kode = intval($data->header) + 1;
      } else {
         $kode = 1;
      }
      $batas = str_pad($kode, 5, "0", STR_PAD_LEFT);
      $kodetampil = "CF-" . $batas;
      return $kodetampil;
   }
   public function headerproduksifinished()
   {
      $this->db_rs->select('RIGHT(tbl_produksifinished.header,5) as header', FALSE);
      $this->db_rs->order_by('id_produksifinished', 'DESC');
      $this->db_rs->limit(1);
      $query = $this->db_rs->get('tbl_produksifinished');
      if ($query->num_rows() <> 0) {
         $data = $query->row();
         $kode = intval($data->header) + 1;
      } else {
         $kode = 1;
      }
      $batas = str_pad($kode, 5, "0", STR_PAD_LEFT);
      $kodetampil = "PF-" . $batas;
      return $kodetampil;
   }
   public function nomorspk()
   {

      $this->db_rs->select_max('tbl_spkheader.id_spkheader');
      $this->db_rs->order_by('id_spkheader', 'DESC');
      $this->db_rs->limit(1);
      $query = $this->db_rs->get('tbl_spkheader');
      if ($query->num_rows() <> 0) {
         $data = $query->row();
         $kode = intval($data->id_spkheader) + 2;
      } else {
         $kode = 1;
      }

      $batas = $batas = str_pad($kode, STR_PAD_LEFT);
      $kodetampil = $batas;
      return $kodetampil;
   }
   public function nomorcasting()
   {

      $this->db_rs->select_max('tbl_castingheader.id_castingheader');
      $this->db_rs->order_by('id_castingheader', 'DESC');
      $this->db_rs->limit(1);
      $query = $this->db_rs->get('tbl_castingheader');
      if ($query->num_rows() <> 0) {
         $data = $query->row();
         $kode = intval($data->id_castingheader) + 2;
      } else {
         $kode = 1;
      }

      $batas = $batas = str_pad($kode, STR_PAD_LEFT);
      $kodetampil = $batas;
      return $kodetampil;
   }
   public function nomorproduksi()
   {

      $this->db_rs->select_max('tbl_headerproduksi.header');
      $this->db_rs->order_by('header', 'DESC');
      $this->db_rs->limit(1);
      $query = $this->db_rs->get('tbl_headerproduksi');
      if ($query->num_rows() <> 0) {
         $data = $query->row();
         $kode = intval($data->header) + 2;
      } else {
         $kode = 1;
      }

      $batas = $batas = str_pad($kode, STR_PAD_LEFT);
      $kodetampil = $batas;
      return $kodetampil;
   }
   public function nomorpembelian()
   {

      $this->db_rs->select_max('tbl_headerpembelian.id_headerpembelian');
      $this->db_rs->order_by('id_headerpembelian', 'DESC');
      $this->db_rs->limit(1);
      $query = $this->db_rs->get('tbl_headerpembelian');
      if ($query->num_rows() <> 0) {
         $data = $query->row();
         $kode = intval($data->id_headerpembelian) + 2;
      } else {
         $kode = 1;
      }

      $batas = $batas = str_pad($kode, STR_PAD_LEFT);
      $kodetampil = $batas;
      return $kodetampil;
   }
   public function headercastingpohondetail()
   {
      $this->db_rs->select('RIGHT(tbl_detailcastingpohon.header,5) as header', FALSE);
      $this->db_rs->order_by('id_castingpohondetail', 'DESC');
      $this->db_rs->limit(1);
      $query = $this->db_rs->get('tbl_detailcastingpohon');
      if ($query->num_rows() <> 0) {
         $data = $query->row();
         $kode = intval($data->header) + 1;
      } else {
         $kode = 1;
      }

      $batas = str_pad($kode, 5, "0", STR_PAD_LEFT);
      $kodetampil = "RCP-" . $batas;
      return $kodetampil;
   }
   public function headerkalkulasisusut()
   {
      $this->db_rs->select('RIGHT(tbl_kalkulasisusut.header,5) as header', FALSE);
      $this->db_rs->order_by('id_kalkulasi', 'DESC');
      $this->db_rs->limit(1);
      $query = $this->db_rs->get('tbl_kalkulasisusut');
      if ($query->num_rows() <> 0) {
         $data = $query->row();
         $kode = intval($data->header) + 1;
      } else {
         $kode = 1;
      }

      $batas = str_pad($kode, 5, "0", STR_PAD_LEFT);
      $kodetampil = "KS-" . $batas;
      return $kodetampil;
   }
   public function headertransaksilebur()
   {
      $this->db_rs->select('RIGHT(tbl_serahterima.header,5) as header', FALSE);
      $this->db_rs->order_by('id_serahterima', 'DESC');
      $this->db_rs->where('jenis', 4);
      $this->db_rs->limit(1);
      $query = $this->db_rs->get('tbl_serahterima');
      if ($query->num_rows() <> 0) {
         $data = $query->row();
         $kode = intval($data->header) + 1;
      } else {
         $kode = 1;
      }

      $batas = str_pad($kode, 5, "0", STR_PAD_LEFT);
      $kodetampil = "TL-" . $batas;
      return $kodetampil;
   }
   public function headerserahterima()
   {
      $this->db_rs->select('RIGHT(tbl_serahterima.header,5) as header', FALSE);
      $this->db_rs->where('jenis', 1);
      $this->db_rs->order_by('id_serahterima', 'DESC');
      $this->db_rs->limit(1);
      $query = $this->db_rs->get('tbl_serahterima');
      if ($query->num_rows() <> 0) {
         $data = $query->row();
         $kode = intval($data->header) + 1;
      } else {
         $kode = 1;
      }

      $batas = str_pad($kode, 5, "0", STR_PAD_LEFT);
      $kodetampil = "ST-" . $batas;
      return $kodetampil;
   }
   public function headerperekat()
   {
      $this->db_rs->select('RIGHT(tbl_perekat.header,5) as header', FALSE);
      $this->db_rs->order_by('id_perekat', 'DESC');
      $this->db_rs->limit(1);
      $query = $this->db_rs->get('tbl_perekat');
      if ($query->num_rows() <> 0) {
         $data = $query->row();
         $kode = intval($data->header) + 1;
      } else {
         $kode = 1;
      }

      $batas = str_pad($kode, 5, "0", STR_PAD_LEFT);
      $kodetampil = "PR-" . $batas;
      return $kodetampil;
   }
   public function headerserahterimadivisidiamond()
   {
      $this->db_rs->select('RIGHT(tbl_serahterima.header,5) as header', FALSE);
      $this->db_rs->where('jenis', 3);
      $this->db_rs->order_by('id_serahterima', 'DESC');
      $this->db_rs->limit(1);
      $query = $this->db_rs->get('tbl_serahterima');
      if ($query->num_rows() <> 0) {
         $data = $query->row();
         $kode = intval($data->header) + 1;
      } else {
         $kode = 1;
      }

      $batas = str_pad($kode, 5, "0", STR_PAD_LEFT);
      $kodetampil = "STD-" . $batas;
      return $kodetampil;
   }
   public function headerserahterimacorulang($id_spkdetail)
   {
      $this->db_rs->select('RIGHT(tbl_serahterima.header,5) as header', FALSE);
      $this->db_rs->where('id_spkdetail', $id_spkdetail);
      $this->db_rs->where('jenis', 2);
      $this->db_rs->order_by('id_serahterima', 'DESC');
      $this->db_rs->limit(1);
      $query = $this->db_rs->get('tbl_serahterima');
      if ($query->num_rows() <> 0) {
         $data = $query->row();
         $kode = intval($data->header) + 1;
      } else {
         $kode = 1;
      }

      $batas = str_pad($kode, 5, "0", STR_PAD_LEFT);
      $kodetampil = "CO-" . $batas;
      return $kodetampil;
   }

   public function headerpemakaianbahan()
   {
      $this->db_rs->select('RIGHT(tbl_pemakaianbahan.header,5) as header', FALSE);
      $this->db_rs->order_by('id_pemakaianbahan', 'DESC');
      $this->db_rs->limit(1);
      $query = $this->db_rs->get('tbl_pemakaianbahan');
      if ($query->num_rows() <> 0) {
         $data = $query->row();
         $kode = intval($data->header) + 1;
      } else {
         $kode = 1;
      }
      $batas = str_pad($kode, 5, "0", STR_PAD_LEFT);
      $kodetampil = "PB-" . $batas;
      return $kodetampil;
   }

   // 	public function headerpemakaianbahan()
   // {

   // 		$this->db_rs->select_max('tbl_pemakaianbahan.header'); 
   // 		$this->db_rs->order_by('id_pemakaianbahan', 'DESC');
   // 		$this->db_rs->limit(1);
   // 		$query = $this->db_rs->get('tbl_pemakaianbahan');
   // 			if ($query->num_rows() <> 0) {
   // 				$data = $query->row();
   // 				$kode = intval($data->header) + 1;
   // 			}
   // 			else{
   // 				$kode = 1;
   // 			}

   // 		$batas = $batas = str_pad($kode, STR_PAD_LEFT);
   // 		$kodetampil = $batas;
   // 		return $kodetampil;

   // }

   public function nomor2ddesain()
   {

      $this->db_rs->select_max('tbl_2ddesainheader.id_header');
      $this->db_rs->order_by('id_header', 'DESC');
      $this->db_rs->limit(1);
      $query = $this->db_rs->get('tbl_2ddesainheader');
      if ($query->num_rows() <> 0) {
         $data = $query->row();
         $kode = intval($data->id_header) + 2;
      } else {
         $kode = 1;
      }

      $batas = $batas = str_pad($kode, STR_PAD_LEFT);
      $kodetampil = $batas;
      return $kodetampil;
   }

   public function nomorcashbank()
   {

      $this->db_rs->select_max('tbl_cashbankheader.id_cashbankheader');
      $this->db_rs->order_by('id_cashbankheader', 'DESC');
      $this->db_rs->limit(1);
      $query = $this->db_rs->get('tbl_cashbankheader');
      if ($query->num_rows() <> 0) {
         $data = $query->row();
         $kode = intval($data->id_cashbankheader) + 2;
      } else {
         $kode = 1;
      }

      $batas = $batas = str_pad($kode, STR_PAD_LEFT);
      $kodetampil = $batas;
      return $kodetampil;
   }


   public function get_by_tanggal($dari, $sampai, $table1)
   {
      $this->db_rs->from($table1);
      $this->db_rs->where('tgl_ayamhilang BETWEEN "' . date('Y-m-d', strtotime($dari)) . '" and "' . date('Y-m-d', strtotime($sampai)) . '"');
      $query = $this->db_rs->get();
      return $query->result();
   }
   public function checking($kode)
   {


      // $this->db_rs->select('*');
      // $this->db_rs->from('');
      // echo $this->db_rs->count_all_results();

      // echo $this->db_rs-> count_all_results ( 'tbl_coa' );   // Menghasilkan bilangan bulat, seperti 25 
      $this->db_rs->where('kode', $kode);
      $this->db_rs->where('headerdetail', "D");
      $this->db_rs->where('deleted', 0);
      $hasil = $this->db_rs->count_all_results('tbl_coa');
      return $hasil;
   }
}
