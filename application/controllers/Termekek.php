<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Termekek extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('termek_model');
    }
    

    public function index()
    {
        $fejlec_data = array('active_page' => "termekek" );
        $this->load->view('_header', $fejlec_data);
        $where = array('arhiv' => 0);
        $termekek = $this->termek_model->select_termek($where);
        $data['termekek'] = $termekek;
        $this->load->view('termekek', $data);
    }

    public function termek_reszletek($termek_id)
    {
        $where = array('id' => $termek_id, );
        $termekek = $this->termek_model->select_termek($where);
        if (count($termekek) == 0) {
            $error_data['heading'] = "Adatbázis hiba";
            $error_data['message'] = "<p>A megadott azonosítóval nem található termék</p>";
            $this->load->view('errors/html/error_db', $error_data);
            return;
        }
        
        $this->load->view('_header');
        $data['termek'] = $termekek[0];
        $this->load->view('termek_reszletek', $data);
    }

    public function termek_hozzaadasa()
    {
        if ($this->session->userdata('user') == null || $this->session->userdata('user')['jogosultsag'] < 1) {
            $errors = "Nincs jogosultság termék rögzítéshez";
            $this->session->set_flashdata('errors', $errors);
            redirect('termekek');
        }
        $fejlec_data = array('active_page' => "termek_hozzaadasa" );
        $this->load->view('_header', $fejlec_data);

        $this->load->view('termek_add');
    }

    public function termek_add_post()
    {
        if ($this->session->userdata('user') == null || $this->session->userdata('user')['jogosultsag'] < 1) {
            $errors = "Nincs jogosultság termék rögzítéshez";
            $this->session->set_flashdata('errors', $errors);
            redirect('termekek');
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('nev', 'Név', 'trim|required|min_length[1]|max_length[255]');
        $this->form_validation->set_rules('leiras', 'Leírás', 'trim'); 
        $this->form_validation->set_rules('ar', 'Ár', 'trim|required|min_length[1]|max_length[11]|numeric');
        if($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
            $this->session->set_flashdata('errors', $errors);
            $this->session->set_flashdata('last_request', $this->input->post());
            redirect('termekek/termek_hozzaadasa');
        } 

        $nev = $this->input->post('nev');
        $leiras = $this->input->post('leiras');
        $ar = $this->input->post('ar');
        $kepTemp = $_FILES['kep']['name'];
        if (empty($kepTemp)) {
            $errors = "Nem lett kép kiválasztva.";
            $this->session->set_flashdata('errors', $errors);
            redirect('termekek/termek_hozzaadasa');
        }
        $fileExt = pathinfo($kepTemp, PATHINFO_EXTENSION);
        $fajlnev = $nev;

        $fajlnev = preg_replace('/[áàãâä]/ui', 'a', $fajlnev);
        $fajlnev = preg_replace('/[éèêë]/ui', 'e', $fajlnev);
        $fajlnev = preg_replace('/[íìîï]/ui', 'i', $fajlnev);
        $fajlnev = preg_replace('/[óòõôöő]/ui', 'o', $fajlnev);
        $fajlnev = preg_replace('/[úùûüű]/ui', 'u', $fajlnev);
        $fajlnev = preg_replace('/[ç]/ui', 'c', $fajlnev);
        $fajlnev = preg_replace('/[^a-z0-9]/i', '_', $fajlnev);
        $fajlnev = preg_replace('/_+/', '_', $fajlnev);
        $fajlnev = strtolower($fajlnev);

        $idopont = date("Y_m_d_h_i_s");

        $kep = $fajlnev."_".$idopont. "." .$fileExt;

        $config['upload_path']          = 'util/img/upload';
        $config['allowed_types']        = 'gif|jpg|png|jpeg|bmp';
        $config['max_size']             = 5120;
        $config['max_width']            = 4000;
        $config['max_height']           = 4000;
        $config['file_name']            = $kep;

        $this->load->library('upload', $config);
        
        if (!$this->upload->do_upload("kep")){
            $errors = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('errors', $errors);
            redirect('termekek/termek_hozzaadasa');
        }
        
        $data = array(
            'nev' => $nev, 
            'leiras' => $leiras, 
            'ar' => $ar, 
            'kep' => $kep, 
        );

        $id = $this->termek_model->insert_termek($data);
        $success = "Sikeres termék rögzítés! A rögzített termék id-ja: ".$id;
        $this->session->set_flashdata('success', $success);
        redirect('termekek/termek_hozzaadasa');
    }

    public function termek_modositasa($termek_id)
    {
        if ($this->session->userdata('user') == null || $this->session->userdata('user')['jogosultsag'] < 1) {
            $errors = "Nincs jogosultság termék módosításához";
            $this->session->set_flashdata('errors', $errors);
            redirect('termekek');
        }

        $where = array('id' => $termek_id, );
        $termekek = $this->termek_model->select_termek($where);
        if (count($termekek) == 0) {
            $error_data['heading'] = "Adatbázis hiba";
            $error_data['message'] = "<p>A megadott azonosítóval nem található termék</p>";
            $this->load->view('errors/html/error_db', $error_data);
            return;
        }
        
        $this->load->view('_header');
        $data['termek'] = $termekek[0];
        $this->load->view('termek_edit', $data);
    }

    public function termek_edit_post()
    {
        
        if ($this->session->userdata('user') == null || $this->session->userdata('user')['jogosultsag'] < 1) {
            $errors = "Nincs jogosultság termék módosításához";
            $this->session->set_flashdata('errors', $errors);
            redirect('termekek');
        }

        $id = $this->input->post('id');

        $this->load->library('form_validation');
        $this->form_validation->set_rules('nev', 'Név', 'trim|required|min_length[1]|max_length[255]');
        $this->form_validation->set_rules('leiras', 'Leírás', 'trim'); 
        $this->form_validation->set_rules('ar', 'Ár', 'trim|required|min_length[1]|max_length[11]|numeric');
        if($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
            $this->session->set_flashdata('errors', $errors);
            $this->session->set_flashdata('last_request', $this->input->post());
            redirect('termekek/termek_modositasa/'.$id);
        } 

        $nev = $this->input->post('nev');
        $leiras = $this->input->post('leiras');
        $ar = $this->input->post('ar');
        $kepTemp = $_FILES['kep']['name'];
        if (!empty($kepTemp)) {
            $fileExt = pathinfo($kepTemp, PATHINFO_EXTENSION);
            $fajlnev = $nev;

            $fajlnev = preg_replace('/[áàãâä]/ui', 'a', $fajlnev);
            $fajlnev = preg_replace('/[éèêë]/ui', 'e', $fajlnev);
            $fajlnev = preg_replace('/[íìîï]/ui', 'i', $fajlnev);
            $fajlnev = preg_replace('/[óòõôöő]/ui', 'o', $fajlnev);
            $fajlnev = preg_replace('/[úùûüű]/ui', 'u', $fajlnev);
            $fajlnev = preg_replace('/[ç]/ui', 'c', $fajlnev);
            $fajlnev = preg_replace('/[^a-z0-9]/i', '_', $fajlnev);
            $fajlnev = preg_replace('/_+/', '_', $fajlnev);
            $fajlnev = strtolower($fajlnev);

            $idopont = date("Y_m_d_h_i_s");

            $kep = $fajlnev."_".$idopont. "." .$fileExt;

            $config['upload_path']          = 'util/img/upload';
            $config['allowed_types']        = 'gif|jpg|png|jpeg|bmp';
            $config['max_size']             = 5120;
            $config['max_width']            = 4000;
            $config['max_height']           = 4000;
            $config['file_name']            = $kep;

            $this->load->library('upload', $config);
            
            if (!$this->upload->do_upload("kep")){
                $errors = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('errors', $errors);
                redirect('termekek/termek_modositasa/'.$id);
            }
            
            $data = array(
                'nev' => $nev, 
                'leiras' => $leiras, 
                'ar' => $ar, 
                'kep' => $kep, 
            );
        } else{
            
            $data = array(
                'nev' => $nev, 
                'leiras' => $leiras, 
                'ar' => $ar
            );
        }

        $this->termek_model->update_termek($id, $data);
        $success = "Sikeres termék módosítás! A módosított termék id-ja: ".$id;
        $this->session->set_flashdata('success', $success);
        redirect('termekek/termek_reszletek/'.$id);
    }

    public function termek_arhivalasa()
    {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('termek_id', 'Termék id', 'trim|required');
        
        if($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
            $this->session->set_flashdata('errors', $errors);
            $this->session->set_flashdata('last_request', $this->input->post());
            redirect('termekek');
        } 

        $id = $this->input->post('termek_id');

        $data = array(
            'arhiv' => 1, 
            'kiemelt' => 0, 
        );
        
        $this->termek_model->update_termek($id, $data);
        $success = "Sikeres termék arhiválás! Az arhivált termék id-ja: ".$id;
        $this->session->set_flashdata('success', $success);
        redirect('termekek');
    }

    public function termek_kiemeles()
    {
        
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('termek_id', 'Termék id', 'trim|required');
        $this->form_validation->set_rules('kiemelt', 'Kiemelt-e?', 'trim|required');
        $this->form_validation->set_rules('reszletek', 'Átirányítás', 'trim|required');
        
        if($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
            $this->session->set_flashdata('errors', $errors);
            $this->session->set_flashdata('last_request', $this->input->post());
            redirect('termekek');
        } 

        $id = $this->input->post('termek_id');
        $kiemelt = $this->input->post('kiemelt');

        $data = array(
            'kiemelt' => $kiemelt, 
        );
        
        $this->termek_model->update_termek($id, $data);
        $success = "Sikeres termék kiemelés módosítása! A módosított termék id-ja: ".$id;
        $this->session->set_flashdata('success', $success);

        $reszletek = $this->input->post('reszletek');
        if ($reszletek == 1) {
            redirect('termekek/termek_reszletek/'.$id);
        }
        redirect('termekek');
    }
}

/* End of file Termekek.php */



?>