<html>
<body>
	<div class="container">
		<h1><?= $produto["nome"]?></h1>
		Preço: <?= $produto["preco"]?><br />
		<?= auto_typography(html_escape($produto["descricao"]))?>
	</div>
</body>
</html>