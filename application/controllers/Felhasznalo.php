<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Felhasznalo extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('felhasznalo_model');
        $this->load->library('session');
        if ($this->session->userdata('user') == null) {
            $errors = "Be kell jelentkeznie a felhasználói beállításokhoz";
            $this->session->set_flashdata('errors', $errors);
            redirect();
        }
        
    }
    

    public function index()
    {   
        if ($this->session->userdata('user')['jogosultsag'] < 2) {
            $errors = "Nincs jogosultság a felhasználók megtekintéséhez";
            $this->session->set_flashdata('errors', $errors);
            redirect();
        }
        
        $fejlec_data = array('active_page' => "felhasznalo" );
        $this->load->view('_header', $fejlec_data);


        $felhasznalok = $this->felhasznalo_model->select_felhasznalo();
        $data = array();
        $data['felhasznalok'] = $felhasznalok;
        $this->load->view('felhasznalok', $data);
    }

    public function felhasznaloi_beallitasok()
    {
        if ($this->session->userdata('user') == null) {
            $errors = "A beállítások módosításához be kell jelentkeznie";
            $this->session->set_flashdata('errors', $errors);
            redirect();
        }

        $fejlec_data = array('active_page' => "felhasznaloi_beallitasok" );
        $this->load->view('_header', $fejlec_data);

        $user = $this->session->userdata('user');
        $data = array();
        $data['user'] = $user;
        $this->load->view('felhasznaloi_beallitasok', $data);
    }

    public function felhasznaloi_adatok_modositasa()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('cim', 'Cím', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
            $this->session->set_flashdata('errors', $errors);
            redirect('felhasznalo/felhasznaloi_beallitasok');
        }

        
        $cim = $this->input->post('cim');
        $id = $this->session->userdata('user')['id'];
        $data = array('cim' => $cim);

        $this->felhasznalo_model->update_felhasznalo($id,$data);
        
        $user = $this->felhasznalo_model->select_felhasznalo(array('id' => $id))[0];
        
        $user_data = array(
            'id' => $user['id'],
            'felh_nev' => $user['felh_nev'],
            'jogosultsag' => $user['jogosultsag'],
            'telj_nev' => $user['telj_nev'],
            'email' => $user['email'],
            'cim' => $user['cim']
        );
        
        $this->session->set_userdata('user', $user_data );


        $success = "Sikeres módosítás";
        $this->session->set_flashdata('success', $success);
        redirect('felhasznalo/felhasznaloi_beallitasok');
    }

    public function jelszo_modositasa()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('jelszo', 'Jelszó', 'trim|required|min_length[3]|max_length[200]');
        $this->form_validation->set_rules('jelenlegi_jelszo', 'Jelenlegi jelszó', 'trim|required|min_length[3]|max_length[200]');
        $this->form_validation->set_rules('jelszo_megerosites', 'Jelszó megerősítés', 'trim|required|min_length[3]|max_length[200]');

        if ($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
            $this->session->set_flashdata('errors', $errors);
            redirect('felhasznalo/felhasznaloi_beallitasok');
        }
        $jelszo = $this->input->post('jelszo');
        $jelenlegi_jelszo = $this->input->post('jelenlegi_jelszo');
        $jelszo_megerosites = $this->input->post('jelszo_megerosites');
        $id = $this->session->userdata('user')['id'];
        $user = $this->felhasznalo_model->select_felhasznalo(array('id' => $id))[0];
        if (!password_verify($jelenlegi_jelszo, $user['jelszo'])) {
            $errors = "Hibás jelenlegi jelszó";
            $this->session->set_flashdata('errors', $errors);
            redirect('felhasznalo/felhasznaloi_beallitasok');
        }

        if ($jelszo != $jelszo_megerosites) {
            $errors = "A két jelszónak meg kell egyeznie";
            $this->session->set_flashdata('errors', $errors);
            redirect('felhasznalo/felhasznaloi_beallitasok');
        }


        $data = array('jelszo' => password_hash($jelszo, PASSWORD_DEFAULT));
        $this->felhasznalo_model->update_felhasznalo($id,$data);

        $success = "Sikeres jelszó módosítás";
        $this->session->set_flashdata('success', $success);
        redirect('felhasznalo/felhasznaloi_beallitasok');
    }

    public function jogosultsag_modositasa($id = "")
    {
        if ($this->session->userdata('user')['jogosultsag'] < 2) {
            $errors = "Nincs jogosultság a felhasználók módosításához";
            $this->session->set_flashdata('errors', $errors);
            redirect();
        }
        if ("" == $id) {
            $errors = "Nincs megadva id";
            $this->session->set_flashdata('errors', $errors);
            redirect("felhasznalo");
        }
        $felhasznalok = $this->felhasznalo_model->select_felhasznalo(array('id' => $id ));
        if (count($felhasznalok) == 0){
            $errors = "Ilyen azonosítóval nincs felhasználó";
            $this->session->set_flashdata('errors', $errors);
            redirect("felhasznalo");
        }
        $felhasznalo = $felhasznalok[0];
        $jogosultsag = $felhasznalo['jogosultsag'];
        if ($jogosultsag > 1) {
            $errors = "Ennek a felhasználónak nem lehet módosítani a jogosultságát";
            $this->session->set_flashdata('errors', $errors);
            redirect("felhasznalo");
        }
        $jogosultsag = abs($jogosultsag-1);
        $data = array('jogosultsag' => $jogosultsag);
        $this->felhasznalo_model->update_felhasznalo($id, $data);
        
        
        $success = "Sikeres módosítás";
        $this->session->set_flashdata('success', $success);
        redirect('felhasznalo');
        
    }

}

/* End of file Felhasznalo.php */




?>