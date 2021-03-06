<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Stud_Controller extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->database();
    }

    public function index() {
        $query = $this->db->get("stud");
        $data['records'] = $query->result();

        $this->load->helper('url');
        $this->load->view('student/Stud_view', $data);
    }

    public function add_student_view() {
        $this->load->helper('form');
        $this->load->view('student/Stud_add');
    }

    public function add_student() {
        $this->load->model('Stud_Model');

        $data = array(
            'roll_no' => $this->input->post('roll_no'),
            'name' => $this->input->post('name')
        );

        $this->Stud_Model->insert($data);

        $query = $this->db->get("stud");
        $data['records'] = $query->result();
        $this->load->view('student/Stud_view', $data);
    }

    public function update_student_view() {
        $this->load->helper('form');
        $roll_no = $this->uri->segment('3');
        $query = $this->db->get_where("stud", array("roll_no" => $roll_no));
        $data['records'] = $query->result();
        $data['old_roll_no'] = $roll_no;
        $this->load->view('student/Stud_edit', $data);
    }

    public function update_student() {
        $this->load->model('Stud_Model');

        $data = array(
            'roll_no' => $this->input->post('roll_no'),
            'name' => $this->input->post('name')
        );

        $old_roll_no = $this->input->post('old_roll_no');
        $this->Stud_Model->update($data, $old_roll_no);

        $query = $this->db->get("stud");
        $data['records'] = $query->result();
        $this->load->view('student/Stud_view', $data);
    }

    public function delete_student() {
        $this->load->model('Stud_Model');
        $roll_no = $this->uri->segment('3');
        $this->Stud_Model->delete($roll_no);

        $query = $this->db->get("stud");
        $data['records'] = $query->result();
        $this->load->view('student/Stud_view', $data);
    }

}
