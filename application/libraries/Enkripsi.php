<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Enkripsi
{
   private $CI;

   public function __construct()
   {
      $this->CI = &get_instance();
   }

   public function encrypt_string($string, $key)
   {
      $cipher = "AES-256-CBC";
      $ivLength = openssl_cipher_iv_length($cipher);
      $iv = openssl_random_pseudo_bytes($ivLength);
      $encrypted = openssl_encrypt($string, $cipher, $key, OPENSSL_RAW_DATA, $iv);
      $encrypted_string = base64_encode($iv . $encrypted);

      $encrypted_string = preg_replace('/[^a-zA-Z0-9]/', '', $encrypted_string);
      return $encrypted_string;
   }

   public function decrypt_string($encrypted_string, $key)
   {
      $cipher = "AES-256-CBC";
      $encrypted_string = base64_decode($encrypted_string);
      $ivLength = openssl_cipher_iv_length($cipher);
      $iv = substr($encrypted_string, 0, $ivLength);
      $encrypted = substr($encrypted_string, $ivLength);
      $decrypted_string = openssl_decrypt($encrypted, $cipher, $key, OPENSSL_RAW_DATA, $iv);

      return $decrypted_string;
   }
}
