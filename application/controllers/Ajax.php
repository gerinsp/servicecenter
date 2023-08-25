<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ajax extends CI_Controller
{
   public function __construct()
   {
      parent::__construct();
      $this->load->model('Models', 'm');
      cekuser();
   }
   //Ajax Menu Produk
   function get_category()
   {
      $postData = $this->input->post();

      // get data
      $data = $this->m->getCategory($postData);

      echo json_encode($data);
   }
   function get_jenisgaransi()
   {
      $postData = $this->input->post();

      // get data
      $data = $this->m->getJenisGaransi($postData);

      echo json_encode($data);
   }

   function get_tipeproduk()
   {
      $postData = $this->input->post();

      // get data
      $data = $this->m->getTipeProduk($postData);

      echo json_encode($data);
   }
   function get_brand()
   {
      $postData = $this->input->post();

      // get data
      $data = $this->m->getBrand($postData);

      echo json_encode($data);
   }
   function get_periodegaransi()
   {
      $postData = $this->input->post();

      // get data
      $data = $this->m->getPeriodeGaransi($postData);

      echo json_encode($data);
   }
   function get_etalase()
   {
      $postData = $this->input->post();

      // get data
      $data = $this->m->getEtalase($postData);

      echo json_encode($data);
   }
   function get_claimgaransi()
   {
      $postData = $this->input->post();

      // get data
      $data = $this->m->getClaimGaransi($postData);

      echo json_encode($data);
   }
   function get_satuanbesar()
   {
      $postData = $this->input->post();

      // get data
      $data = $this->m->getSatuanBesar($postData);

      echo json_encode($data);
   }
   function get_satuankecil()
   {
      $postData = $this->input->post();

      // get data
      $data = $this->m->getSatuanKecil($postData);

      echo json_encode($data);
   }
   function get_kondisi()
   {
      $postData = $this->input->post();

      // get data
      $data = $this->m->getKondisi($postData);

      echo json_encode($data);
   }
   function get_matauang()
   {
      $postData = $this->input->post();

      // get data
      $data = $this->m->getMataUang($postData);

      echo json_encode($data);
   }

   //Ajax Menu Cashbank
   function get_akuncoasatu()
   {
      $postData = $this->input->post();

      // get data
      $data = $this->m->getAkunCoaSatu($postData);

      echo json_encode($data);
   }
   function get_akuncoadua()
   {
      $postData = $this->input->post();

      // get data
      $data = $this->m->getAkunCoaDua($postData);

      echo json_encode($data);
   }
   function getprodukbyscan()
   {
      $qr_code = $this->input->post('qrcode');

      $select = $this->db->select('*, mgb.quantity as stockproduk, masterproduk.skuproduk as skuproduk, masterproduk.hargajual as hargajual, mrp.srp as hargajualsrp,  b.brand as brand, c.categoryname as kategori, d.mastername as etalase, e.mastername as jenisgaransi, f.mastername as periodegaransi, g.mastername as claimgaransi, h.mastername as kondisi, i.mastername as tipeproduk, j.mastername as satuanbesar, k.mastername as satuankecil, matauang.symbol as symbol');
      $select = $this->db->join('tbl_masterbrand as b', 'b.id_brand = tbl_masterproduk.id_brand', 'left');
      $select = $this->db->join('tbl_mastercategory as c', 'c.id_category = tbl_masterproduk.id_category', 'left');
      $select = $this->db->join('tbl_masterid as d', 'd.masterid = tbl_masterproduk.id_etalase', 'left');
      $select = $this->db->join('tbl_masterid as e', 'e.masterid = tbl_masterproduk.id_jenisgaransi', 'left');
      $select = $this->db->join('tbl_masterid as f', 'f.masterid = tbl_masterproduk.id_periodegaransi', 'left');
      $select = $this->db->join('tbl_masterid as g', 'g.masterid = tbl_masterproduk.id_claimgaransi', 'left');
      $select = $this->db->join('tbl_masterid as h', 'h.masterid = tbl_masterproduk.id_kondisi', 'left');
      $select = $this->db->join('tbl_masterid as i', 'i.masterid = tbl_masterproduk.id_tipeproduk', 'left');
      $select = $this->db->join('tbl_masterid as j', 'j.masterid = tbl_masterproduk.id_satuanbesar', 'left');
      $select = $this->db->join('tbl_masterid as k', 'k.masterid = tbl_masterproduk.id_satuankecil', 'left');
      $select = $this->db->join('tbl_matauang', 'tbl_matauang.id_matauang = tbl_masterproduk.id_matauang', 'left');
      $select = $this->db->join('(SELECT mip.skuproduk, MAX(mip.updatedate) AS max_tanggal FROM tbl_masteritemsrp mip GROUP BY mip.skuproduk) AS latest_harga', 'masterproduk.skuproduk = latest_harga.skuproduk', 'left');
      $select = $this->db->join('tbl_masteritemsrp mrp', 'mrp.skuproduk = latest_harga.skuproduk AND mrp.updatedate = latest_harga.max_tanggal', 'left');
      $this->db->join('(SELECT skuproduk, quantity
      FROM tbl_mutgudabrg) mgb', 'masterproduk.skuproduk = mgb.skuproduk', 'left');
      $select = $this->db->order_by('namaproduk');
      $select = $this->db->where('tbl_masterproduk.barcode', $qr_code);
      $select = $this->db->where('tbl_masterproduk.deleted', 0);
      $data   = $this->m->Get_All('masterproduk', $select);
      echo json_encode($data);
   }
   function get_subakuncashdetail()
   {
      $postData = $this->input->post();

      // get data
      $data = $this->m->getSubAkunCashDetail($postData);

      echo json_encode($data);
   }
   function get_subakuncashlawan()
   {
      $postData = $this->input->post();

      // get data
      $data = $this->m->getSubAkunCashLawan($postData);

      echo json_encode($data);
   }

   function get_costcentercashdetail()
   {
      $postData = $this->input->post();

      // get data
      $data = $this->m->getCostCenterCashDetail($postData);

      echo json_encode($data);
   }
   function get_costcentercashlawan()
   {
      $postData = $this->input->post();

      // get data
      $data = $this->m->getCostCenterCashDetail($postData);

      echo json_encode($data);
   }

   function getcashdetail()
   {
      $id_cashbankheader = $this->input->post('id_cashbankheader');
      $select       = $this->db->select('*');
      $select       = $this->db->where('tbl_cashbankdetail.id_cashbankheader', $id_cashbankheader);
      $select       = $this->db->where('cashbankdetail.create_by', $this->session->userdata('id_user'));
      $select       = $this->db->where('cashbankdetail.deleted', 0);
      $select       = $this->db->where('cashbankdetail.statustmp', 1);
      $data          = $this->m->Get_All('cashbankdetail', $select);

      echo json_encode($data);
   }

   function getcashdetailedit()
   {
      $id_cashbankheader = $this->input->post('idcashbankheader');
      $select       = $this->db->select('*, tbl_coa.namaakun, tbl_coa.akun');
      $select       = $this->db->join('tbl_coa', 'coa.akun = tbl_cashbankdetail.akun');
      $select       = $this->db->where('tbl_cashbankdetail.id_cashbankheader', $id_cashbankheader);
      $select       = $this->db->where('cashbankdetail.create_by', $this->session->userdata('id_user'));
      $select       = $this->db->where('cashbankdetail.deleted', 0);
      $data          = $this->m->Get_All('cashbankdetail', $select);

      echo json_encode($data);
   }

   function getinvoicetmp()
   {
      $id_cashbankheader = $this->input->post('id_cashbankheader');
      $select       = $this->db->select('*');
      $select       = $this->db->join('tbl_matauang', 'tbl_matauang.id_matauang = tbl_mutasiaccountpayablereceiveable.id_matauang');
      $select       = $this->db->join('tbl_client', 'tbl_client.id_client = tbl_mutasiaccountpayablereceiveable.subakun');
      $select       = $this->db->where('tbl_mutasiaccountpayablereceiveable.statustmp', 1);
      $select       = $this->db->where('tbl_mutasiaccountpayablereceiveable.id_cashbankheader', $id_cashbankheader);
      $select       = $this->db->where('tbl_mutasiaccountpayablereceiveable.create_by', $this->session->userdata('id_user'));
      $select       = $this->db->where('tbl_mutasiaccountpayablereceiveable.deleted', 0);
      $data          = $this->m->Get_All('mutasiaccountpayablereceiveable', $select);

      echo json_encode($data);
   }

   function getinvoice()
   {
      $idclient = $this->input->post('idclient');
      $select       = $this->db->select('*, SUM(CASE 
		WHEN (typetransaksi = 10)
		THEN bayar 
		ELSE 0 
	END) AS totalbayar,  saldo - SUM(CASE 
		WHEN (typetransaksi = 10 or typetransaksi = 11)
		THEN bayar 
		ELSE 0 
	END)  as totalsaldo');
      $select       = $this->db->join('tbl_matauang', 'tbl_matauang.id_matauang = tbl_mutasiaccountpayablereceiveable.id_matauang');
      $select       = $this->db->join('tbl_client', 'tbl_client.id_client = tbl_mutasiaccountpayablereceiveable.subakun');
      $select       = $this->db->where('tbl_mutasiaccountpayablereceiveable.subakun', $idclient);
      // $select       = $this->db->where('tbl_mutasiaccountpayablereceiveable.create_by', $this->session->userdata('id_user'));
      $select       = $this->db->where('tbl_mutasiaccountpayablereceiveable.deleted', 0);
      $select       = $this->db->group_by('nomorapr');
      $select       = $this->db->having('total - SUM(CASE 
			WHEN (typetransaksi = 10)
			THEN bayar 
			ELSE 0 
		END) >', 0);
      $data          = $this->m->Get_All('mutasiaccountpayablereceiveable', $select);

      echo json_encode($data);
   }
   function getgroupakun()
   {
      $idcoa = $this->input->post('idcoa');
      $subquery = $this->db->select('id_subakun')->get_compiled_select('groupakun');

      $this->db->select('*, karyawan.nama as namakaryawan, client.nama as namaclient');
      $this->db->join('karyawan', 'karyawan.id_karyawan = subakun.id_karyawan', 'left');
      $this->db->join('client', 'client.id_client = subakun.id_client', 'left');
      $this->db->where('subakun.header in (SELECT id_subakun FROM tbl_groupakun WHERE tbl_groupakun.id_coa = ' . $idcoa . ')');
      $this->db->where('subakun.deleted', 0);
      $data    = $this->db->get('subakun')->result();
      echo json_encode($data);
   }

   function getcashlawan()
   {
      $idcashbankheader = $this->input->post("id_cashbankheader");
      $select       = $this->db->select('*');
      $select       = $this->db->where('tbl_cashbanklawan.id_cashbankheader', $idcashbankheader);
      $select       = $this->db->where('cashbanklawan.create_by', $this->session->userdata('id_user'));
      $select       = $this->db->where('cashbanklawan.deleted', 0);
      $select       = $this->db->where('cashbanklawan.statustmp', 1);
      $data         = $this->m->Get_All('cashbanklawan', $select);
      echo json_encode($data);
   }

   //Ajax Menu 2D Design
   function getdetaildiamond()
   {
      $select = $this->db->select('*');
      $select       = $this->db->join('tbl_parcel', 'tbl_parcel.id_parcel = tbl_2ddesainsubdetail.id_parcel');
      $select = $this->db->join('tbl_diameter', 'tbl_diameter.id_diameter = tbl_parcel.id_diameter', 'left');
      $select = $this->db->join('tbl_diagroup', 'tbl_diagroup.id_diagroup = tbl_diameter.id_diagroup', 'left');
      $select = $this->db->join('tbl_clarity', 'tbl_clarity.id_clarity = tbl_parcel.id_clarity', 'left');
      $select = $this->db->join('tbl_shape', 'tbl_shape.id_shape = tbl_parcel.id_shape', 'left');
      $select = $this->db->join('tbl_color', 'tbl_color.id_color = tbl_parcel.id_color', 'left');
      $select = $this->db->join('tbl_headsetting', 'tbl_headsetting.id_headsetting = tbl_2ddesainsubdetail.id_headsetting', 'left');
      $select = $this->db->where('tbl_2ddesainsubdetail.id_user', $this->session->userdata('id_user'));
      $select = $this->db->where('tbl_2ddesainsubdetail.id_detail', 0);
      $select = $this->db->where('tbl_2ddesainsubdetail.deleted', 0);
      $data   = $this->m->Get_All('2ddesainsubdetail', $select);

      echo json_encode($data);
   }
   function getdetailproduk()
   {
      $select = $this->db->select('*, a.keterangan as tipeproduk, b.keterangan as brand, c.keterangan as category, d.keterangan as etalase, e.keterangan as jenisgaransi, f.keterangan as periodegaransi, g.keterangan as claimgaransi, h.keterangan as kondisi, i.keterangan as satuanbesar, j.keterangan as satuankecil');
      $select       = $this->db->join('tbl_masterproduk', 'tbl_masterproduk.id_produk = tbl_2ddesainkepala.id_barang');
      $select = $this->db->join('tbl_masterid as a', 'a.id_masterid = tbl_masterproduk.id_tipeproduk');
      $select = $this->db->join('tbl_masterid as b', 'b.id_masterid = tbl_masterproduk.id_brand');
      $select = $this->db->join('tbl_masterid as c', 'c.id_masterid = tbl_masterproduk.id_category');
      $select = $this->db->join('tbl_masterid as d', 'd.id_masterid = tbl_masterproduk.id_etalase');
      $select = $this->db->join('tbl_masterid as e', 'e.id_masterid = tbl_masterproduk.id_jenisgaransi');
      $select = $this->db->join('tbl_masterid as f', 'f.id_masterid = tbl_masterproduk.id_periodegaransi');
      $select = $this->db->join('tbl_masterid as g', 'g.id_masterid = tbl_masterproduk.id_claimgaransi');
      $select = $this->db->join('tbl_masterid as h', 'h.id_masterid = tbl_masterproduk.id_kondisi');
      $select = $this->db->join('tbl_masterid as i', 'i.id_masterid = tbl_masterproduk.id_satuanbesar');
      $select = $this->db->join('tbl_masterid as j', 'j.id_masterid = tbl_masterproduk.id_satuankecil');
      $select = $this->db->join('tbl_matauang', 'tbl_matauang.id_matauang = tbl_masterproduk.id_matauang');
      $select = $this->db->where('tbl_2ddesainkepala.id_user', $this->session->userdata('id_user'));
      $select = $this->db->where('tbl_2ddesainkepala.id_detail', 0);
      $select = $this->db->where('tbl_2ddesainkepala.deleted', 0);
      $data   = $this->m->Get_All('2ddesainkepala', $select);


      echo json_encode($data);
   }
   function getdetailproduk_edit()
   {
      $id_detail = $this->input->post("iddetail");

      $select = $this->db->select('*, a.keterangan as tipeproduk, b.keterangan as brand, c.keterangan as category, d.keterangan as etalase, e.keterangan as jenisgaransi, f.keterangan as periodegaransi, g.keterangan as claimgaransi, h.keterangan as kondisi, i.keterangan as satuanbesar, j.keterangan as satuankecil');
      $select       = $this->db->join('tbl_masterproduk', 'tbl_masterproduk.id_produk = tbl_2ddesainkepala.id_barang');
      $select = $this->db->join('tbl_masterid as a', 'a.id_masterid = tbl_masterproduk.id_tipeproduk');
      $select = $this->db->join('tbl_masterid as b', 'b.id_masterid = tbl_masterproduk.id_brand');
      $select = $this->db->join('tbl_masterid as c', 'c.id_masterid = tbl_masterproduk.id_category');
      $select = $this->db->join('tbl_masterid as d', 'd.id_masterid = tbl_masterproduk.id_etalase');
      $select = $this->db->join('tbl_masterid as e', 'e.id_masterid = tbl_masterproduk.id_jenisgaransi');
      $select = $this->db->join('tbl_masterid as f', 'f.id_masterid = tbl_masterproduk.id_periodegaransi');
      $select = $this->db->join('tbl_masterid as g', 'g.id_masterid = tbl_masterproduk.id_claimgaransi');
      $select = $this->db->join('tbl_masterid as h', 'h.id_masterid = tbl_masterproduk.id_kondisi');
      $select = $this->db->join('tbl_masterid as i', 'i.id_masterid = tbl_masterproduk.id_satuanbesar');
      $select = $this->db->join('tbl_masterid as j', 'j.id_masterid = tbl_masterproduk.id_satuankecil');
      $select = $this->db->join('tbl_matauang', 'tbl_matauang.id_matauang = tbl_masterproduk.id_matauang');
      $select = $this->db->where('tbl_2ddesainkepala.id_user', $this->session->userdata('id_user'));
      $select = $this->db->where('tbl_2ddesainkepala.id_detail', $id_detail);
      $select = $this->db->where('tbl_2ddesainkepala.deleted', 0);
      $data   = $this->m->Get_All('2ddesainkepala', $select);


      echo json_encode($data);
   }

   function getdetaildiamond_edit()
   {

      $id_detail = $this->input->post("iddetail");

      $select = $this->db->select('*');
      $select       = $this->db->join('tbl_parcel', 'tbl_parcel.id_parcel = tbl_2ddesainsubdetail.id_parcel', 'left');
      $select = $this->db->join('tbl_diameter', 'tbl_diameter.id_diameter = tbl_parcel.id_diameter', 'left');
      $select = $this->db->join('tbl_diagroup', 'tbl_diagroup.id_diagroup = tbl_diameter.id_diagroup', 'left');
      $select = $this->db->join('tbl_clarity', 'tbl_clarity.id_clarity = tbl_parcel.id_clarity', 'left');
      $select = $this->db->join('tbl_shape', 'tbl_shape.id_shape = tbl_parcel.id_shape', 'left');
      $select = $this->db->join('tbl_color', 'tbl_color.id_color = tbl_parcel.id_color', 'left');
      $select = $this->db->join('tbl_headsetting', 'tbl_headsetting.id_headsetting = tbl_2ddesainsubdetail.id_headsetting', 'left');
      //$select = $this->db->where('tbl_2ddesainsubdetail.id_user', $this->session->userdata('id_user'));
      $select = $this->db->where('tbl_2ddesainsubdetail.id_detail', $id_detail);
      $select = $this->db->where('tbl_2ddesainsubdetail.deleted', 0);
      $data   = $this->m->Get_All('2ddesainsubdetail', $select);

      echo json_encode($data);
   }

   function get_karyawan()
   {
      $postData = $this->input->post();

      // get data
      $data = $this->m->getKaryawan($postData);

      echo json_encode($data);
   }

   function get_warnaproduk()
   {
      $postData = $this->input->post();

      // get data
      $data = $this->m->getWarnaProduk($postData);

      echo json_encode($data);
   }


   function get_client()
   {
      $postData = $this->input->post();

      // get data
      $data = $this->m->getClient($postData);

      echo json_encode($data);
   }

   function get_ongkos()
   {
      $idtipedesign = $this->input->post();
      $kesulitan = $this->input->post();
      // get data
      $data = $this->m->getOngkos($idtipedesign, $kesulitan);

      echo json_encode($data);
   }

   function get_finishing()
   {
      $postData = $this->input->post();

      // get data
      $data = $this->m->getFinishing($postData);

      echo json_encode($data);
   }
   function get_tipedesign()
   {
      $postData = $this->input->post();

      // get data
      $data = $this->m->getTipeDesign($postData);

      echo json_encode($data);
   }
   function get_konsepkepala()
   {
      $postData = $this->input->post();

      // get data
      $data = $this->m->getKonsepKepala($postData);

      echo json_encode($data);
   }
   function get_parcel()
   {
      $postData = $this->input->post();

      // get data
      $data = $this->m->getParcel($postData);

      echo json_encode($data);
   }
   function get_material()
   {
      $postData = $this->input->post();

      // get data
      $data = $this->m->getMaterial($postData);

      echo json_encode($data);
   }

   function get_kursmaterial()
   {
      $postData = $this->input->post();
      $tanggal  = $this->input->post();

      // get data
      $data = $this->m->getKursMaterial($postData, $tanggal);


      echo json_encode($data);
   }
   function get_komposisimaterial()
   {
      $postData = $this->input->post();
      $tanggal  = $this->input->post();

      // get data
      $data = $this->m->getKursMaterial($postData, $tanggal);


      echo json_encode($data);
   }
   function get_barang()
   {
      $postData = $this->input->post();

      // get data
      $data = $this->m->getBarang($postData);

      echo json_encode($data);
   }

   //Ajax Menu SPK
   function get_desain()
   {
      $postData = $this->input->post();

      // get data
      $data = $this->m->getDesain($postData);

      echo json_encode($data);
   }

   //Ajax Menu Pengaturan
   function get_autonumbering2ddesign()
   {
      $postData = $this->input->post();

      // get data
      $data = $this->m->autonumbering2ddesain($postData);


      echo json_encode($data);
   }
   function get_autonumberingcashbank()
   {
      $postData = $this->input->post();

      // get data
      $data = $this->m->autonumberingcashbank($postData);


      echo json_encode($data);
   }

   function get_autonumberingspk()
   {
      $postData = $this->input->post();

      // get data
      $data = $this->m->autonumberingspk($postData);


      echo json_encode($data);
   }
   function get_autonumberingproject()
   {
      $postData = $this->input->post();

      // get data
      $data = $this->m->autonumberingproject($postData);


      echo json_encode($data);
   }
   function get_autonumberingcasting()
   {
      $postData = $this->input->post();

      // get data
      $data = $this->m->autonumberingcasting($postData);


      echo json_encode($data);
   }
   function get_autonumberingproduksi()
   {
      $postData = $this->input->post();

      // get data
      $data = $this->m->autonumberingproduksi($postData);


      echo json_encode($data);
   }
   function get_autonumberingpembelian()
   {
      $postData = $this->input->post();

      // get data
      $data = $this->m->autonumberingpembelian($postData);


      echo json_encode($data);
   }
   function get_autonumberingpembelianbarangjadi()
   {
      $postData = $this->input->post();

      // get data
      $data = $this->m->autonumberingpembelianbarangjadi($postData);


      echo json_encode($data);
   }

   function get_autonumberingpenjualanbarangjadi()
   {
      $postData = $this->input->post();

      // get data
      $data = $this->m->autonumberingpenjualanbarangjadi($postData);


      echo json_encode($data);
   }

   //Ajax Menu Casting
   function get_karyawancasting()
   {
      $postData = $this->input->post();

      // get data
      $data = $this->m->getKaryawanCasting($postData);

      echo json_encode($data);
   }

   function get_lokasi()
   {
      $postData = $this->input->post();

      // get data
      $data = $this->m->getLokasi($postData);

      echo json_encode($data);
   }

   //Ajax Menu Pembelian
   function get_lawantransaksi()
   {
      $postData = $this->input->post();

      // get data
      $data = $this->m->getLawanTransaksi($postData);

      echo json_encode($data);
   }
   function get_kursmatauang()
   {
      $postData = $this->input->post();
      $tanggal  = $this->input->post();

      // get data
      $data = $this->m->getKursMataUang($postData, $tanggal);


      echo json_encode($data);
   }

   function get_hargaprongsetting()
   {
      $postData = $this->input->post();
      $setting  = $this->input->post();



      // get data
      $data = $this->m->getHargaProngSetting($postData, $setting);


      echo json_encode($data);
   }

   function getdetailpurchase()
   {
      $select = $this->db->select('*');
      $select = $this->db->where('tbl_detailpembelian.id_user', $this->session->userdata('id_user'));
      $select = $this->db->where('tbl_detailpembelian.id_headerpembelian', 0);
      $select = $this->db->where('tbl_detailpembelian.deleted', 0);
      $data   = $this->m->Get_All('detailpembelian', $select);


      echo json_encode($data);
   }
   function getdetailproject()
   {
      $select = $this->db->select('*');
      $select = $this->db->where('tbl_detailproject.id_user', $this->session->userdata('id_user'));
      $select = $this->db->where('tbl_detailproject.id_headerproject', 0);
      $select = $this->db->where('tbl_detailproject.deleted', 0);
      $data   = $this->m->Get_All('detailproject', $select);


      echo json_encode($data);
   }

   function getdetailpurchase_edit()
   {
      $id_headerpembelian = $this->input->post("idheaderpembelian");



      $select = $this->db->select('*, tbl_detailpembelian.discountpersen as discountpersendetail');
      $select = $this->db->join('tbl_headerpembelian', 'headerpembelian.id_headerpembelian = detailpembelian.id_headerpembelian');
      $select = $this->db->where('tbl_detailpembelian.id_user', $this->session->userdata('id_user'));
      $select = $this->db->where('tbl_detailpembelian.id_headerpembelian', $id_headerpembelian);
      $select = $this->db->where('tbl_detailpembelian.deleted', 0);
      $data   = $this->m->Get_All('detailpembelian', $select);


      echo json_encode($data);
   }
   function getdetailsale()
   {
      $select = $this->db->select('*');
      $select = $this->db->where('tbl_detailpenjualan.id_user', $this->session->userdata('id_user'));
      $select = $this->db->where('tbl_detailpenjualan.id_headerpenjualan', 0);
      $select = $this->db->where('tbl_detailpenjualan.status_tmp', 1);
      $select = $this->db->where('tbl_detailpenjualan.deleted', 0);
      $data   = $this->m->Get_All('detailpenjualan', $select);


      echo json_encode($data);
   }
   function getdetailsale_edit()
   {

      $id_headerpenjualan = $this->input->post("idheaderpenjualan");
      $select = $this->db->select('*');
      $select = $this->db->join('tbl_headerpenjualan', 'headerpenjualan.id_headerpenjualan = detailpenjualan.id_headerpenjualan');
      $select = $this->db->where('tbl_detailpenjualan.id_user', $this->session->userdata('id_user'));
      $select = $this->db->where('tbl_detailpenjualan.id_headerpenjualan', $id_headerpenjualan);
      $select = $this->db->where('tbl_detailpenjualan.deleted', 0);
      $data   = $this->m->Get_All('detailpenjualan', $select);


      echo json_encode($data);
   }
   function getcastingpohon()
   {
      $id_castingheader = $this->input->post("idcastingheader");

      $select = $this->db->select('*, castingpohon.beratbahan as hasilberat, castingpohon.konversililin as kl');
      $select = $this->db->join('castingheader', 'castingheader.id_castingheader = castingpohon.id_castingheader');
      $select = $this->db->join('material', 'material.id_material = castingpohon.id_material');
      $select = $this->db->where('castingpohon.id_castingheader', $id_castingheader);
      $select = $this->db->where('castingpohon.deleted', 0);
      $select = $this->db->where('castingpohon.statustmp', 1);
      $data = $this->m->Get_All('castingpohon', $select);


      echo json_encode($data);
   }


   function getprodukdetailcastingpohon()
   {

      $idcastingpohon = $this->input->post("idcastingpohon");
      $header = $this->input->post("header");

      $select = $this->db->select('*, tbl_mutasibarang.jumlah as barangterpakai, tbl_detailcastingpohon.jumlah as sisabahan');
      $select = $this->db->join('detailcastingpohon', 'detailcastingpohon.id_castingpohondetail = mutasibarang.id_header');
      $select = $this->db->where('mutasibarang.nomortransaksibarang', $header);
      $data = $this->m->Get_All('mutasibarang', $select);


      echo json_encode($data);
   }

   function getprodukserahterima()
   {

      $idspkdetail = $this->input->post("idspkdetail");
      $header = $this->input->post("header");

      $select = $this->db->select('*');
      $select = $this->db->where('serahterima.id_spkdetail', $idspkdetail);
      $select = $this->db->where('serahterima.header', $header);
      $data = $this->m->Get_All('serahterima', $select);

      echo json_encode($data);
   }
   function getbarangjadiserahterima()
   {

      // $idspkdetail = $this->input->post("idspkdetail");
      $header = $this->input->post("header");
      $id_user = $this->session->userdata('id_user');


      $select = $this->db->select('*');
      // $select = $this->db->where('serahterima.id_spkdetail', $idspkdetail);
      $select = $this->db->where('serahterima.created_by', $id_user);
      $select = $this->db->where('serahterima.statustmp', 1);
      $data = $this->m->Get_All('serahterima', $select);
      echo json_encode($data);
   }
   function getprodukkalkulasisusut()
   {
      $header = $this->input->post("header");

      $select = $this->db->select('*');
      $select = $this->db->where('kalkulasisusut.header', $header);
      $data = $this->m->Get_All('kalkulasisusut', $select);

      echo json_encode($data);
   }

   function getprodukongkos()
   {

      $iddetail = $this->input->post("iddetail");

      $select = $this->db->select('*,ongkosdesain.jumlah as jumlahongkosdesain, ongkospasangbatu.kode');
      $select = $this->db->join('ongkospasangbatu', 'ongkospasangbatu.id_ongkospasangbatu = ongkosdesain.id_ongkospasangbatu');
      $select = $this->db->where('tbl_ongkosdesain.id_detaildesign', $iddetail);
      $select = $this->db->where('tbl_ongkosdesain.statustmp', 1);
      $data = $this->m->Get_All('ongkosdesain', $select);

      echo json_encode($data);
   }


   function getprodukproduksi()
   {

      $nomorproduksi = $this->input->post("nomorproduksi");

      $select = $this->db->select('*');
      $select = $this->db->where('headerproduksi.nomorproduksi', $nomorproduksi);
      $data = $this->m->Get_All('headerproduksi', $select);


      echo json_encode($data);
   }
   function getprodukpemakaian()
   {

      $idheaderproduksi = $this->input->post("idheaderproduksi");
      $header = $this->input->post("header");

      $select = $this->db->select('*');
      $select = $this->db->where('pemakaianbahan.id_headerproduksi', $idheaderproduksi);
      $select = $this->db->where('pemakaianbahan.header', $header);
      // $select = $this->db->where('statustmp',1);
      $data = $this->m->Get_All('pemakaianbahan', $select);


      echo json_encode($data);
   }

   function getprodukcastingfinished()
   {

      $idcastingheader = $this->input->post("idcastingheader");


      $select = $this->db->select('*, format(tbl_castingfinished.jumlah, 4) as jumlahitem');
      $select = $this->db->join('spkheader', 'spkheader.id_spkheader = castingfinished.id_spkheader', 'left');
      $select = $this->db->join('spkdetail', 'spkdetail.id_spkdetail = castingfinished.id_spkdetail', 'left');
      $select = $this->db->where('castingfinished.id_castingheader', $idcastingheader);
      $select = $this->db->where('castingfinished.statustmp', 1);
      $select = $this->db->order_by('castingfinished.id_castingfinished', 'Desc');
      $data = $this->m->Get_All('castingfinished', $select);

      // $select = $this->db->select('count(id_castingfinished) as jumlahdata');   
      // $select = $this->db->where('castingfinished.id_castingheader', $idcastingheader);
      // $select = $this->db->where('castingfinished.header', 0); 
      // $select = $this->db->where('castingfinished.statustmp',1); 
      // $jumlahdata = $this->m->Get_All('castingfinished', $select);


      echo json_encode($data);
   }
   function getdetailcastingpohon()
   {

      $idcastingpohon = $this->input->post("idcastingpohon");

      $select = $this->db->select('*');
      $select = $this->db->where('detailcastingpohon.statustmp', 2);
      $select = $this->db->group_by('detailcastingpohon.header');
      $data = $this->m->Get_All('detailcastingpohon', $select);


      echo json_encode($data);
   }

   function getcastingfinished()
   {

      $id_castingheader = $this->input->post("id_castingheader");

      $select = $this->db->select('*');
      $select = $this->db->join('spkheader', 'spkheader.id_spkheader = castingfinished.id_spkheader', 'left');
      $select = $this->db->join('spkdetail', 'spkdetail.id_spkdetail = castingfinished.id_spkdetail', 'left');
      $select = $this->db->join('castingheader', 'castingheader.id_castingheader = castingfinished.id_castingheader');
      $select = $this->db->where('castingfinished.statustmp', 2);
      $select = $this->db->group_by('castingfinished.header');
      $data = $this->m->Get_All('castingfinished', $select);


      echo json_encode($data);
   }

   function getrealisasicastingpohon()
   {

      $idcastingpohon = $this->input->post("idcastingpohon");

      $select = $this->db->select('*, detailcastingpohon.nomorcasting as nomorcastingpohondetail, castingpohon.kodecasting as kodecastingpohon');
      $select = $this->db->join('castingheader', 'castingheader.nomorcasting = detailcastingpohon.nomorcasting');
      $select = $this->db->join('castingpohon', 'castingpohon.id_castingpohon = detailcastingpohon.id_castingpohon');
      $select = $this->db->where('detailcastingpohon.statustmp', 0);
      $select = $this->db->group_by('detailcastingpohon.header');
      $select = $this->db->where('detailcastingpohon.id_castingpohon', $idcastingpohon);
      $data   = $this->m->Get_All('detailcastingpohon', $select);


      echo json_encode($data);
   }

   function getkomposisimaterial()
   {

      $idmaterial = $this->input->post("idmaterial");

      $select = $this->db->select('*');
      $select = $this->db->where('id_material', $idmaterial);
      $select = $this->db->where('deleted', 0);
      $data   = $this->m->Get_All('komposisimaterial', $select);


      echo json_encode($data);
   }

   function getpemakaianbahan()
   {
      $idheaderproduksi = $this->input->post("idheaderproduksi");

      $select = $this->db->select('*');
      $select = $this->db->join('tbl_masterid', 'tbl_masterid.id_masterid=tbl_pemakaianbahan.lokasi');
      $select = $this->db->where('pemakaianbahan.id_headerproduksi', $idheaderproduksi);
      $select = $this->db->where('pemakaianbahan.statustmp', 0);
      $select = $this->db->where('pemakaianbahan.deleted', 0);
      $select = $this->db->group_by('pemakaianbahan.header');
      // $select = $this->db->where('statustmp',1);
      $data = $this->m->Get_All('pemakaianbahan', $select);


      echo json_encode($data);
   }
   function getprodukproduksifinished()
   {

      $headerproduksi = $this->input->post("headerproduksi");

      $select = $this->db->select('*, produksifinished.jumlah as jumlahitem');
      $select = $this->db->where('produksifinished.id_headerproduksi', $headerproduksi);
      $select = $this->db->where('produksifinished.header', 0);
      $select = $this->db->where('produksifinished.statustmp', 1);
      $data = $this->m->Get_All('produksifinished', $select);

      $select = $this->db->select('count(id_produksifinished) as jumlahdata');
      $select = $this->db->where('produksifinished.id_headerproduksi', $headerproduksi);
      $select = $this->db->where('produksifinished.header', 0);
      $select = $this->db->where('produksifinished.statustmp', 1);
      $jumlahdata = $this->m->Get_All('produksifinished', $select);


      echo json_encode($data);
   }
}
