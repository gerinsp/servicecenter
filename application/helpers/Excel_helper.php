<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . 'third_party/PHPExcel/PHPExcel.php';

class Excel_helper
{
   public function __construct()
   {
      $this->ci = &get_instance();
   }

   public function import($file_path)
   {
      $objPHPExcel = PHPExcel_IOFactory::load($file_path);
      $worksheet = $objPHPExcel->getActiveSheet();
      $rows = $worksheet->toArray();

      return $rows;
   }
}
