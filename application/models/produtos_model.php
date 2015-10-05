<?php
class Produtos_model extends CI_Model {

	public function busca($id) {
		return $this->db->get_where("produtos", array(
				"id" => $id
			))->row_array();
	}

    function get_by_id($id) {
            $query = $this->db->where('id',$id);
            $query = $this->db->get('produtos');
            return $query->result();
    }


	public function buscaTodos() {
		//result_array() traz todas as linhas
		return $this->db->get("produtos")->result_array();
	}

	public function salva($produto, $id = null) {
		if (null != $id) {
			$this->db->update("produtos", $produto);
			$this->db->where('id', $id);
		} else {
			$this->db->insert("produtos", $produto);
		}
		
	}
} 	