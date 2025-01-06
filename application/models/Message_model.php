<?php

class Message_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }


    public function save_message($data) {
        $this->db->insert('messages', $data);
    }
    

}