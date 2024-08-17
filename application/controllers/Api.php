<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Api_model');
        $this->load->helper('url');
    }

    public function get_all_projects() {
        $data['projects'] = $this->Api_model->get_all_projects();
        $data['locations'] = $this->Api_model->get_all_locations(); 
        $this->load->view('home_view', $data);
    }
   
    public function add_project_view() {
        $data['locations'] = $this->Api_model->get_all_locations();
        $this->load->view('add_project_view', $data);
    }
    public function add_location_view() {
        $this->load->view('add_location_view');
    }

    public function edit_project_view($id) {
        $data['project'] = $this->Api_model->get_project_by_id($id);
        $data['locations'] = $this->Api_model->get_all_locations();
        $this->load->view('edit_project_view', $data);
    }

    public function edit_location_view($id) {
        $data['location'] = $this->Api_model->get_location_by_id($id);
        $this->load->view('edit_location_view', $data);
    }

    public function get_project($id) {
        $data['project'] = $this->Api_model->get_project_by_id($id);
        $this->load->view('project_view', $data);
    }

    public function get_location($id) {
        $data['location'] = $this->Api_model->get_location_by_id($id);
        $this->load->view('project_view', $data);
    }

    public function add_project() {
        
        $locations = $this->input->post('locationName');
        $locationArray = array();
        
        if ($locations) {
            foreach ($locations as $locationId) {
                $locationArray[] = array('id' => $locationId);
            }
        }
        $data = array(
            'name' => $this->input->post('name'),
            'client' => $this->input->post('client'),
            'startTime' => $this->input->post('startTime'),
            'endTime' => $this->input->post('endTime'),
            'projectLead' => $this->input->post('projectLead'),
            'note' => $this->input->post('note'),
            'locations' => $locationArray 
        );
        $result = $this->Api_model->add_project($data);
        log_message('debug', 'Processed data: ' . print_r($data, TRUE));
        redirect('api/get_all_projects');
    }

    public function add_location() {
        $data = array(
            'locationName' => $this->input->post('locationName'),
            'country' => $this->input->post('country'),
            'province' => $this->input->post('province'),
            'city' => $this->input->post('city')
        );
        $result = $this->Api_model->add_project($data);
        log_message('debug', 'Processed data: ' . print_r($data, TRUE));
        redirect('api/get_all_projects');
    }

    public function update_project($id) {
        $data = array(
            'name' => $this->input->post('name'),
            'client' => $this->input->post('client'),
            'startTime' => $this->input->post('startTime'),
            'endTime' => $this->input->post('endTime'),
            'projectLead' => $this->input->post('projectLead'),
            'note' => $this->input->post('note'),
            'location' => array('id' => $this->input->post('location')) 
        );
        
        $result = $this->Api_model->update_project($id, $data);
        log_message('debug', 'Processed data: ' . print_r($data, TRUE));
        redirect('home');
    }

    public function update_location($id) {
        $data = array(
            'locationName' => $this->input->post('locationName'),
            'country' => $this->input->post('country'),
            'province' => $this->input->post('province'),
            'city' => $this->input->post('city')
        );
        
        $result = $this->Api_model->update_location($id, $data);
        log_message('debug', 'Processed data: ' . print_r($data, TRUE));
        redirect('home');
    }
    

    public function delete_project($id) {
        $this->Api_model->delete_project($id);
        redirect('home');
    }

    public function delete_location($id) {
        $this->Api_model->delete_location($id);
        redirect('home');
    }
}
