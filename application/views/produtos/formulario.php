<html>
	<meta charset="utf-8">
	<link rel="stylesheet" href="<?= base_url("css/bootstrap.css") ?> ">
<body>
	<div class="container">
	<h1>Cadastro de novo produto</h1>
	
	<?php 
	echo form_open("produtos/novo");

	echo form_label("Nome", "nome");
	echo form_input(array(
		"name" => "nome",
		"class" => "form-control",
		"id" => "nome",
		"maxlength" => "255",
		"value" => set_value("nome", $dados_produtos[0]->nome)
		));
	echo form_error("nome");

	echo "<br />";
	echo form_label("Preço", "preco");
	echo form_input(array(
		"name" => "preco",
		"class" => "form-control",
		"id" => "nome",
		"maxlength" => "255",
		"type"	=> "number",
		"value" => set_value("preco", $dados_produtos[0]->preco)
		));
	echo form_error("preco");
	echo "<br />";
	echo form_textarea(array(
		"name" => "descricao",
		"class" => "form-control",
		"id" => "descricao",
		"descricao" => set_value("descricao", $dados_produtos[0]->descricao)
		));
	echo "<br />";
	echo form_error("descricao");
	echo form_button(array(
		"class" => "btn btn-primary",
		"content" => "Cadastrar",
		"type" => "submit"
		));

	echo form_close();
	?>
	</div>
</body>
</html>