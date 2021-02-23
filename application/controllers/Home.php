<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('felhasznalo_model');
        
    }
    

    public function index()
    {
        $fejlec_data = array('active_page' => "fooldal" );
        $this->load->view('_header', $fejlec_data);

        $this->load->view('home_page');
        if ($this->session->userdata('user')) {
            redirect('termekek');
        }
    }

    public function regisztracio()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[5]|max_length[255]');
        $this->form_validation->set_rules('felh_nev', 'Felhasználónév', 'trim|required|min_length[3]|max_length[30]');
        $this->form_validation->set_rules('jelszo', 'Jelszó', 'trim|required|min_length[3]|max_length[200]');
        $this->form_validation->set_rules('telj_nev', 'Teljes név', 'trim|required');
        $this->form_validation->set_rules('cim', 'Cím', 'trim|required');
        
        if ($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
            $this->session->set_flashdata('errors', $errors);
            $this->session->set_flashdata('last_request', $this->input->post());
            redirect('');
        } 

        $email = $this->input->post('email');
        $felh_nev = $this->input->post('felh_nev');
        $jelszo = $this->input->post('jelszo');
        $telj_nev = $this->input->post('telj_nev');
        $cim = $this->input->post('cim');

        $email_ellenorzes = $this->felhasznalo_model->select_felhasznalo(array('email' => $email));
        if (sizeof($email_ellenorzes) > 0) {
            $errors = "Az email cím már használatban van";
            $this->session->set_flashdata('errors', $errors);
            $this->session->set_flashdata('last_request', $this->input->post());
            redirect('');
        }

        $user_ellenorzes = $this->felhasznalo_model->select_felhasznalo(array('felh_nev' => $felh_nev));
        if (sizeof($user_ellenorzes) > 0) {
            $errors = "A felhasználónév foglalt";
            $this->session->set_flashdata('errors', $errors);
            $this->session->set_flashdata('last_request', $this->input->post());
            redirect('');
        }
        $data = array();
        $data['email'] = $email;
        $data['felh_nev'] = $felh_nev;
        $data['jelszo'] = password_hash($jelszo, PASSWORD_DEFAULT);
        $data['telj_nev'] = $telj_nev;
        $data['cim'] = $cim;

        $id = $this->felhasznalo_model->insert_felhasznalo($data);
        $success = "Sikeres regisztráció a következő id-val: ".$id;
        $this->session->set_flashdata('success', $success);
        redirect('');
    }

    public function bejelentkezes()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('felh_nev', 'Felhasználónév', 'trim|required|min_length[3]|max_length[255]');
        $this->form_validation->set_rules('jelszo', 'Jelszó', 'trim|required|min_length[3]|max_length[200]'); 
        if($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
            $this->session->set_flashdata('errors', $errors);
            $this->session->set_flashdata('last_request', $this->input->post());
            redirect('');
        } 
        $felh_nev = $this->input->post('felh_nev');
        $jelszo = $this->input->post('jelszo');


        $user_ellenorzes = $this->felhasznalo_model->select_felhasznalo(array('felh_nev' => $felh_nev));
        $email_ellenorzes = $this->felhasznalo_model->select_felhasznalo(array('email' => $felh_nev));
        if (sizeof($user_ellenorzes) == 0 && sizeof($email_ellenorzes) == 0 ) {
            $errors = "Hibás felhasználónév vagy jelszó!";
            $this->session->set_flashdata('errors', $errors);
            $this->session->set_flashdata('last_request', $this->input->post());
            redirect('');
        }
        $user = array();
        if (sizeof($user_ellenorzes) > 0) {
            $user = $user_ellenorzes[0];
        }else{
            $user = $email_ellenorzes[0];
        }
        
        if (!password_verify($jelszo, $user['jelszo'])) {
            $errors = "Hibás felhasználónév vagy jelszó!";
            $this->session->set_flashdata('errors', $errors);
            $this->session->set_flashdata('last_request', $this->input->post());
            redirect('');
        }
        $success = "Sikeres bejelentkezés";
        
        $user_data = array(
            'id' => $user['id'],
            'felh_nev' => $user['felh_nev'],
            'jogosultsag' => $user['jogosultsag'],
            'telj_nev' => $user['telj_nev'],
            'email' => $user['email'],
            'cim' => $user['cim']
        );
        
        $this->session->set_userdata('user', $user_data );
        
        $this->session->set_flashdata('success', $success);
        redirect('');
    }

    public function kijelentkezes()
    {
        $this->session->unset_userdata('user');
        $success = "Sikeres kijelentkezés";
        $this->session->set_flashdata('success', $success);
        redirect('');
    }

}

/* End of file Home.php */


?>