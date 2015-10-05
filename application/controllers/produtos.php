<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Produtos extends CI_Controller {
	
	public function mostra($id) {
		$this->load->model("produtos_model");
		$produto = $this->produtos_model->busca($id);
		$dados = array("produto" => $produto);
		$this->load->view("produtos/mostra", $dados);
	}	


	public function index()
	{	
		//debug
		//$this->output->enable_profile("produtos_model");

		//carrega produtos_model
		$this->load->model("produtos_model");
			
		//chama método de produtos_model que busca tudo da tabela produtos
		$produtos = $this->produtos_model->buscaTodos();

		$dados = array("produtos" => $produtos);
		$this->load->helper(array("currency"));	
		$this->load->view("produtos/index.php", $dados);
	}

	public function formulario() {
		$this->load->view("produtos/formulario");
	}

	public function novo($id = NULL) {
		//carrega a biblioteca
		$this->load->library("form_validation");
		//regras de validacao
		$this->form_validation->set_rules("nome", "nome", "required|callback_nao_tenha_a_palabra_melhor");
		$this->form_validation->set_rules("descricao", "descricao", "required|min_length[10]");
		$this->form_validation->set_rules("preco", "preco", "required");
		$this->form_validation->set_error_delimiters("<p class='alert alert-danger'>", "</p>");
		//rodando a validacao
		$sucesso = $this->form_validation->run();
		if($sucesso){
			$usuarioLogado = $this->session->userdata("usuario_logado");
			$produto = array(
				"nome" => $this->input->post("nome"),
				"descricao" => $this->input->post("descricao"),
				"preco" => $this->input->post("preco"),
				"usuario_id" => $usuarioLogado["id"]
			);
			$this->load->model("produtos_model");
			if (is_null( $id )){
				$this->produtos_model->salva($produto);
				$this->session->set_flashdata("success", "Produto salvo com sucesso");
			} else {
				$this->produtos_model->update($produto, $id);
				$this->session->set_flashdata("success", "Produto atualizado com sucesso");			
			} 	
			redirect('/');
		} else {
			$this->load->view("produtos/formulario");
		}
	}

    public function editar($id = NULL) {

    	if($id == NULL OR !is_numeric($id)){
    		echo 'Erro com o ID';
    		return;
    	}
    	$this->load->library('form_validation');
    	$this->load->model('produtos_model');

    	$data['dados_produtos'] = $this->produtos_model->get_by_id($id);
   		
   		if (empty($data['dados_produtos'])) {
   			echo 'Id invalido';
   		} else {
   			$this->load->view('produtos/formulario', $data);
   		}
    }	

        
 


	public function nao_tenha_a_palabra_melhor($nome) {
		$posicao = strpos($nome, "melhor");
		if($posicao != FALSE){
			return TRUE;
		} else {
			$this->form_validation->set_message("nao_tenha_a_palabra_melhor", "O campo '%s' não pode conter a palavra \"melhor\"");
			return FALSE;
		}
	}
}
