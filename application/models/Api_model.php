<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model extends CI_Model {

    private $api_url = 'http://localhost:9090';

    public function __construct() {
        parent::__construct();
        $this->load->library('curl');
    }

    public function get_all_projects() {
        $response = $this->curl->simple_get($this->api_url . '/getAllProjects');
        return json_decode($response);
    }
    public function get_all_locations() {
        $response = $this->curl->simple_get($this->api_url . '/getAllLocations');
        return json_decode($response);
    }

    public function get_project_by_id($id) {
        $response = $this->curl->simple_get($this->api_url . '/project/' . $id);
        return json_decode($response);
    }

    public function get_location_by_id($id) {
        $response = $this->curl->simple_get($this->api_url . '/location/' . $id);
        return json_decode($response);
    }

    public function add_project($data) {
        $response = $this->curl->simple_post($this->api_url . '/addProject', $data);
        // print_r($response);
        return json_decode($response);
    }

    public function add_location($data) {
        $response = $this->curl->simple_post($this->api_url . '/addLocation', $data);
        // print_r($response);
        return json_decode($response);
    }

    public function update_project($id, $data) {
        $jsonData = json_encode($data);
        $response = $this->curl->simple_put($this->api_url . '/updateProject/' . $id, $jsonData, array(CURLOPT_HTTPHEADER => array('Content-Type: application/json')));
        
        return json_decode($response);
    }   
    
    public function update_location($id, $data) {
        $jsonData = json_encode($data);
        $response = $this->curl->simple_put($this->api_url . '/editLocation/' . $id, $jsonData, array(CURLOPT_HTTPHEADER => array('Content-Type: application/json')));
        
        return json_decode($response);
    }   

    public function delete_project($id) {
        $response = $this->curl->simple_delete($this->api_url . '/deleteProject/' . $id);
        return json_decode($response);
    }

    public function delete_location($id) {
        $response = $this->curl->simple_delete($this->api_url . '/deleteLocation/' . $id);
        return json_decode($response);
    }
}
