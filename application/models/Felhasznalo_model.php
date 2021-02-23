<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Felhasznalo_model extends CI_Model {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        
    }
    
    public function insert_felhasznalo($data)
    {
        $this->db->insert('felhasznalo', $data);
        return $this->db->insert_id();
    }

    public function update_felhasznalo($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('felhasznalo', $data);
    }

    public function delete_felhasznalo($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('felhasznalo');
    }
    /*
    $where = array(
        'nev' => 'asd',
        'ar' => 100,
     );
    */
    public function select_felhasznalo($where = "")
    {
        if ($where != "") {
            foreach ($where as $key => $value) {
                $this->db->where($key, $value);
            }
        }
        return $this->db->get('felhasznalo')->result_array();
    }
    
    

}




?>