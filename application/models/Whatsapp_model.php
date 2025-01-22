<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Whatsapp_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Load database library
        $this->load->database();
    }

    public function kirim($phone,$msg)
    {

        $msg =  str_replace(" ", "%20", $msg);

        $result = file_get_contents("https://jogja.wablas.com/api/send-message?token=dIcrt40Ek2SdegCv9KnkYQEVBFTyUxyztNMjTtB6ZxbQlhzYWrfbDgCGS8CVqLro.UftRIN0F&phone=$phone&message=$msg");
        return $result;
        // echo "<pre>";
        // print_r($result);
    }
}
?>