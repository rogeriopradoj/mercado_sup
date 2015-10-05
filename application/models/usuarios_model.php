<?php

class Usuarios_model extends CI_Model {
	public function salva($usuario) {
		$this->db->insert("usuarios", $usuario);
	}

	public function buscaPorEmailESenha($email, $senha) {
		//verifica email e senha
		$this->db->where("email", $email);
		$this->db->where("senha", $senha);
		//select  & row array traz a primeira linha
		$usuario = $this->db->get("usuarios")->row_array();
		return $usuario;
	}
}