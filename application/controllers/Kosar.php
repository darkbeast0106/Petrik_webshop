<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Kosar extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('cart');
        
    }
    
    public function index()
    {
        $this->load->helper('form');
        
        $fejlec_data = array('active_page' => "kosar" );
        $this->load->view('_header', $fejlec_data);

        $data['kosar_tartalma'] = $this->cart->contents();
        $this->load->view('kosar', $data);
    }

    public function kosar_insert()
    {
        $id = $this->input->post('id');
        $nev = $this->input->post('nev');
        $ar = $this->input->post('ar');
        
        $data = array(
            'id'      => $id,
            'qty'     => 1,
            'price'   => $ar,
            'name'    => $nev
        );        
        $this->cart->insert($data);        
        $this->echo_kosar_json();
    }

    public function kosar_update()
    {
        $rowid = $this->input->post('rowid');
        $qty = $this->input->post('qty');        
        
        $data = array(
            'rowid' => $rowid,
            'qty'   => $qty
        );
    
        $this->cart->update($data);
        $this->echo_kosar_json();
    }

    public function echo_kosar_json()
    {
        echo json_encode($this->cart->contents(), JSON_UNESCAPED_UNICODE);
    }
}

/* End of file Kosar.php */


?>