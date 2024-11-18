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

        $msg = htmlspecialchars($msg);

        $result = file_get_contents("https://jogja.wablas.com/api/send-message?token=uk6mWOZvwaEOTprR9NE64FlNy3X0Wa0EVvFcXC6byLvd9zTjTxL0XUlj8PlEEQ4D&phone=$phone&message=$msg");
        return $result;
        // echo "<pre>";
        // print_r($result);
    }
}
?>