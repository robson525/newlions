
<h2 class="center">
    Inscrição Número : <?php echo $this->inscricao->getNinscricao(); ?>     
</h2>

<h3 class="center">
    01 a 02 de maio de 2020
</h3>
<h4 class="center" style="display: none;">					
    Luiz Correa - Parnaiba - PI<br>
    SESC PRAIA
</h4>

<hr>

<div style="display: none;">
	<h3 class="center bold">Pagamento</h3>
	<div class="row-fluid">
		<div class="span5">
			<h4 class="center bold">Dados Bancarios</h4>
			<p class="center">Banco do Brasil</p>                                               
			<p class="center">
				Agência: 3506-8 <br>
				Conta Corrente: 42056-5                 
			</p>
			<p class="center">
				Titular: DG Rita: BANCO DO BRASIL.
			</p>
		</div>
		<div class="span5">
			<h4 class="center bold">Valores das Incrições</h4>    
			<table class="table">
				<tr>
					<td>Até dia 30/12/2019</td>
					<td>R$ 300,00</td>
				</tr>
				<tr>
					<td>Até dia 28/02/2020</td>
					<td>R$ 320,00</td>
				</tr>
				<tr>
					<td>Até dia 30/04/2020</td>
					<td>R$ 350,00</td>
				</tr>
			</table>
		</div>
	</div>
</div>

<hr>

<?= $this->loadTemplate('comprovante');  ?>
