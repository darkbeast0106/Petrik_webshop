<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Rendeles extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('rendeles_model');
        
    }
    
    public function index()
    {
        $fejlec_data = array('active_page' => "rendeles" );
        $this->load->view('_header', $fejlec_data);

        $this->load->view('rendelesek');
    }
    
    public function rendeles_felvetele()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('szallitasi_cim', 'Szállítási cím', 'trim|required|max_length[200]');
        $this->form_validation->set_rules('megjegyzes', 'Megjegyzés', 'trim'); 
        
        
        if (!$this->form_validation->run()) {
            $errors = validation_errors();
            $this->session->set_flashdata('errors', $errors);
            $this->session->set_flashdata('last_request', $this->input->post());
            redirect('kosar');            
        } 
        
        $this->load->library('cart');
        if (count($this->cart->contents()) == 0){
            $errors = "Sikertelen rendelés! A kosár üres.";
            $this->session->set_flashdata('errors', $errors);
            $this->session->set_flashdata('last_request', $this->input->post());
            redirect('kosar');            
        }
        
        $rendelo_id = $this->session->userdata('user')['id'];        
        $szallitasi_cim = $this->input->post('szallitasi_cim');
        $megjegyzes = $this->input->post('megjegyzes');
        
        $data = array(
            'rendelo_id' => $rendelo_id,
            'szallitasi_cim' => $szallitasi_cim,
            'megjegyzes' => $megjegyzes    
            );

        $rendeles_id = $this->rendeles_model->insert_rendeles($data);


        $kosar = $this->cart->contents();

        foreach ($kosar as $rowid => $tetel) {
            $termek_id = $tetel['id'];
            $darab = $tetel['qty'];

            $tetel_data = array(
                'rendeles_id' => $rendeles_id,
                'termek_id' => $termek_id,
                'darab' => $darab    
                );
            $this->rendeles_model->insert_rendeles_tetel($tetel_data);

            $cart_data = array(
                'rowid' => $rowid,
                'qty'   => 0
            );        
            $this->cart->update($cart_data);
        }        
        
        $success = "Sikeres rendelés!";
        $this->session->set_flashdata('success', $success);
        redirect('rendeles');
    }
}
?>