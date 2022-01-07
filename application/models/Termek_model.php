<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Termek_model extends CI_Model {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        
    }
    
    public function insert_termek($data)
    {
        $this->db->insert('termek', $data);
        return $this->db->insert_id();
    }

    public function update_termek($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('termek', $data);
    }

    public function delete_termek($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('termek');
    }
    /*
    $where = array(
        'nev' => 'asd',
        'ar' => 100,
     );
    */
    public function select_termek($where = [])
    {
        if (!empty($where)) {
            foreach ($where as $key => $value) {
                $this->db->where($key, $value);
            }
        }
        return $this->db->get('termek')->result_array();
    }
}




?>