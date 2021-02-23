<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Rendeles_model extends CI_Model {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        
    }
    
    public function insert_rendeles($data)
    {
        $this->db->insert('rendeles', $data);
        return $this->db->insert_id();
    }

    public function update_rendeles($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('rendeles', $data);
    }

    public function delete_rendeles($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('rendeles');
    }
    /*
    $where = array(
        'nev' => 'asd',
        'ar' => 100,
     );
    */
    public function select_rendeles($where = "")
    {
        if ($where != "") {
            foreach ($where as $key => $value) {
                $this->db->where($key, $value);
            }
        }
        return $this->db->get('rendeles')->result_array();
    }
    
    public function insert_rendelesi_tetel($data)
    {
        $this->db->insert('rendelesi_tetel', $data);
        return $this->db->insert_id();
    }

    public function update_rendelesi_tetel($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('rendelesi_tetel', $data);
    }

    public function delete_rendelesi_tetel($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('rendelesi_tetel');
    }
    /*
    $where = array(
        'nev' => 'asd',
        'ar' => 100,
     );
    */
    public function select_rendelesi_tetel($where = "")
    {
        if ($where != "") {
            foreach ($where as $key => $value) {
                $this->db->where($key, $value);
            }
        }
        return $this->db->get('rendelesi_tetel')->result_array();
    }

}




?>