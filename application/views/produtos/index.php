<html lang="en">
<head>
	<link rel="stylesheet" href="<?= base_url("css/bootstrap.css") ?> ">
	<meta charset="utf-8">
</head>
<body>
	<div class="container">

		<?php if($this->session->flashdata("success")) : ?>
			<p class="alert alert-success"><?= $this->session->flashdata("success") ?></p>
		<?php endif ?>
		<?php if($this->session->flashdata("danger")) : ?>
			<p class="alert alert-danger"><?= $this->session->flashdata("danger") ?></p>
		<?php endif ?>
		<h1>Produtos</h1>
		<table class="table table-striped">
		<?php foreach($produtos as $produto) : ?>
		<tr>
			<td><?= anchor("produtos/{$produto['id']}", $produto["nome"])?></td>
			<td><?= character_limiter($produto["descricao"], 10)?></td>
			<td><?= numeroEmReais($produto["preco"]) ?></td>
			<?= form_open("produtos/editar") ?>
			<td>
				<?=		form_button(array(
						"class" => "btn btn-primary",
						"content" => "Editar",
						"type"  => "submit"
						)); ?>
			</td>
			<?= form_close() ?>
			<?= form_open("produtos/excluir") ?>
			<td>
				<?=		form_button(array(
						"class" => "btn btn-danger",
						"content" => "Excluir",
						"type"  => "submit"
						)); ?>
			</td>
			<?= form_close() ?>
		</tr>
		<?php endforeach ?>
		</table>
		<!-- Se o usuário estiver logado, mostra a lista de produtos e o botão logout-->
	<?php if($this->session->userdata("usuario_logado")) : ?>
		<?= anchor('produtos/formulario', 'Novo Produto', array("class" => "btn btn-primary")) ?>
		<?= anchor('login/logout', 'Logout', array("class" => "btn btn-primary")) ?>
	
	<?php else :  ?>

		<h1>Login</h1>
		<?php 
		echo form_open("login/autenticar");

		echo form_label("Email", "email");
		echo form_input(array(
						"name" => "email",
						"id"   => "email",
						"class" => "form-control",
						"maxlength" =>"255"
 						));
		echo form_label("Senha", "senha");
		echo form_password(array(
						"name" => "senha",
						"id"   => "senha",
						"class" => "form-control",
						"maxlength" => "255"
						));
		echo "<br />\n";
		echo form_button(array(
						"class" => "btn btn-primary",
						"content" => "Login",
						"type"  => "submit"
						));
		echo form_close();
		?>

		<h1>Cadastro</h1>
		<?php
		echo form_open("usuarios/novo");
		
		echo form_label("Nome", "nome");
		echo form_input(array(
						"name" => "nome",
						"id"   => "nome",
						"class" => "form-control",
						"maxlength" => "255"
						));
		echo form_label("Email", "email");
		echo form_input(array(
						"name" => "email",
						"id"   => "email",
						"class" => "form-control",
						"maxlength" =>"255"
 						));
		echo form_label("Senha", "senha");
		echo form_password(array(
						"name" => "senha",
						"id"   => "senha",
						"class" => "form-control",
						"maxlength" => "255"
						));
		echo "<br />\n";
		echo form_button(array(
						"class" => "btn btn-primary",
						"content" => "Cadastrar",
						"type"  => "submit"
						));
		echo form_close();	
		?>
	<?php endif ?>
	</div>
</body>	
</html>