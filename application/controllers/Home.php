<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Paises_model');
    }

	public function index()
	{
		// $grades = $this->Paises_model->getAll();

		// $jsonData = json_encode($grades, JSON_PRETTY_PRINT);
		// echo "<pre>" . $jsonData . "</pre>";
		// 
		$output = array();
		$output['paises'] = $this->getAllCountries();
		$this->load->view('listado_paises', $output);
	}

	public function getAllCountries()
	{
		$this->load->model('Paises_model');
		$paises = $this->Paises_model->getAllCountries();

		return $paises;
	}

	public function updateCountry()
	{
		$this->load->model('Paises_model');
		// var_dump($_POST);exit();

		// IT COULD VALIDATE $_POST
		$response = $this->Paises_model->updateCountry();

		return $response;
	}

	public function deleteCountry()
	{
		$this->load->model('Paises_model');
		// IT COULD VALIDATE $_POST
		$response = $this->Paises_model->deleteCountry();
		// $output['Result'] = 'OK';
		$response = array ( 
			'Result' => 'OK'
		);
		return $response;
	}

	public function createCountry()
	{
		$this->load->model('Paises_model');
		// IT COULD VALIDATE $_POST
		$response = $this->Paises_model->createCountry();
		return $response;
	}
}
