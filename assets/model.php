<?php if (!defined('BASEPATH'))
    	exit('No direct script access allowed');

class Paises_model extends CI_Model {

	// public function __construct(){
	// 	// parent::__construct();
	// 	$this->load->database();
	// }

	// Obtiene la alternativa de "id" dado
	public function getAllCountries(){
		$this->load->database();
		$this->db
				->select("*")
				->from("test09.paises");
				// ->where("alt.id", $id);

		$query 	= $this->db->get();
		$row 	= $query->result_array();
		
		return $row;
	}

	public function updateCountry(){
		$this->load->database();
		// var_dump($_POST);exit();

		$jTableResult = array();

    	$this->db->where('id', $_POST['id']);
    	$this->db->update('test09.paises', $_POST);
    	
    	$row = $this->db->get_where('test09.paises', array('id' => $_POST['id']) )->row_array();
    	
    	if( $this->db->affected_rows() > 0 ){
    		$jTableResult['Result'] = 'OK';
    		$jTableResult['Record'] = $row;
    	}else{
    		$jTableResult['Result'] = 'ERROR';
    		$jTableResult['Message'] = 'Error al intentar actualizar el registro.';
    	}

    	return $jTableResult;
		// $this->db->where("id", $_POST['id']);
		// $this->db->delete("test09.paises");

		// $query 	= $this->db->get();
		// $row 	= $query->result_array();
		
		// return array('Result' => 'OK', 'id'=>$_POST[id]);;
	}

	public function deleteCountry(){
		$this->load->database();

		$this->db
				->where("id", $_POST['id'])
				->delete("test09.paises");

		// $query 	= $this->db->get();
		// $row 	= $query->result_array();
		
		return array('Result' => 'OK', 'id'=>$_POST[id]);;
	}


	public function createCountry(){
		// var_dump($_POST);
		// INSERT INTO `test09`.`paises` (`name`, `checked`) VALUES ('para', '1');
		$this->load->database();
		// var_dump($_POST);exit();
		
		$output = array();
		
		$result = $this->db->insert('test09.paises', $_POST);
		if( $result ) {
			$query = $this->db->query('SELECT * FROM test09.paises WHERE id = LAST_INSERT_ID();');
			$row = $query->row_array();
			
			$output['Result'] = "OK";
			$output['Message'] = "LA OPERACIÓN SE REALIZO CON EXITO";
			$output['Record'] = $row;
			// return $output;
		}else{
			$output['Result'] = "ERROR";
			$output['Message'] = $error;
		}
		// var_dump($output);
		// exit();

		return $output;
		
		// return array('Result' => $result, 'id'=>$id);
	}
}