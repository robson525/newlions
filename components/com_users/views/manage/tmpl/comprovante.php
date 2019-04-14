<html>
<head>
	<title>Comprovante</title>
	<style type="text/css">
		*{
			font-family: 'Ubuntu', 'Helvetica', arial, serif;
		}
		h1{
			color: #174e9c;
			margin-top: 50px;
		}
		body{
			text-align: center;;
		}
		table{
			margin: 50px auto;
			font-size: 18px;
		}
	</style>
</head>
<body>
	<h1>Informações</h1>
	<table>
		<tr>
			<td>Nome:</td><td><?php echo $this->user->name; ?></td>
		</tr>
		<tr>
			<td>Email:</td><td><?php echo $this->user->email; ?></td>
		</tr>
			<td>Pago:</td><td><?php echo ($this->inscricao->getPago() ? "Sim" : "Não"); ?></td>
		</tr>
	</table>

	<?php $title = "title='" . $this->comprovante->getNome() . "'" ?>
	<?php $src = "src='../" . $this->comprovante->getNomeCompleto(true) . "'"  ?>
	
	<?php if($this->comprovante->getTipo() == ".pdf"): ?>

		<embed type="application/pdf" style="border: 2px solid #132d54;" <?php echo $title ?> <?php echo $src  ?> height="600" width="850" />
	
	<?php else: ?>

		<img <?php echo $title ?> <?php echo $src  ?> alt="Imagem Não Encontrada" style="width: 600;" />

	<?php endif; ?>
</body>
</html>