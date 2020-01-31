<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

?>

<div class="no-print" style="font-size: 14px;">
	<a class="btn btn-small pull-right btn-out" href="<?php echo JRoute::_('index.php?option=com_users&view=profile'); ?>" title="Voltar">
		<i class="icon-arrow-left"></i>Voltar
	</a>
</div>

<?php if(isset($this->inscritos)): ?>

    <h3 class="center bold">Inscrições <?php echo $this->convencao->getTitulo() ?></h3>
   
    <form method="POST" action="" class="no-print">
        <label class="center bold">Filtrar por: </label>
        <div class="row">
	        <span class="span1 right">Estado:</span>
	        <div class="span2">
		        <select id="estado" name="estado" onChange="Estado(false, false);">
		            <option value=""></option>
		            <option value="AMAPÁ">AMAPÁ</option>
		            <option value="MARANHÃO" >MARANHÃO</option>
		            <option value="PARÁ" >PARÁ</option>
		            <option value="PIAUÍ">PIAUÍ</option>
		        </select>
	        </div>
	        <span class="span1 right">Cidade:</span>
	        <div class="span3">
		        <select id="cidade" name="cidade">
		            <option id="padrao" value="" >SELECIONE UM ESTADO</option>    
		        </select>
	    	</div>
	        <span class="span1 right">Clube:</span>  
	        <div class="span3">      
		        <select id="clube" name="clube">
		            <option value="">SELECIONE UM ESTADO</option>
		        </select>
		    </div>	        
	        <div class="span1">
	        	<input type="submit" class="button" value="Filtrar" />
	    	</div>
        </div>
        <hr style="margin-top: 10px;">
    </form>

    <table class="show-print" style="margin-top: 10px; border-bottom: 1px solid #dddddd;; display: none;">
    	<caption class="center bold">Filtrado por: </caption>
    	<tr>
	        <td width="8%" class="right">Estado:</td>
	        <td width="15%">
		        <?php echo $this->estado ?>
	        </td>
	        <td width="8%" class="right">Cidade:</td>
	        <td width="30%">
		        <?php echo $this->cidade ?>
	    	</td>
	        <td width="8%" class="right">Clube:</td>  
	        <td >      
	        	<?php echo $this->clube ?>
		    </td>	      
        </tr>        
    </table>
    
    <div class="div_table_inscricao" style="overflow-x: auto;">
        <table class="table table-striped table-hover table-condensed table-nowrap">
            <thead>
                <tr>
                    <th >Nº</th>
                    <th >Prefixo</th>
                    <th >Nome</th>
                    <th >Matrícula</th>
                    <th >CPF</th>
                    <th >Estado</th>
                    <th >Cidade</th>
                    <th >Cluble</th>
                    <th >Inscrição | Pago &ensp;&ensp;</th>
                    <th >Nascimento</th>
                    <th >Delegado</th>
                    <th >Cargo no Clube</th>
                    <th >Cargo no Distrito</th>
                    <th >CL Melvin Jones</th>
                    <th >Camisa</th>
                    <th >Email</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($this->inscritos as $i => $iscrito): ?>
                    <tr>
                        <td ><?php echo $i + 1 ?></td>
                        <td ><?php echo $iscrito->prefixo ?></td>
                        <td ><?php echo $iscrito->name ?></td>
                        <td ><?php echo $iscrito->matricula ?></td>
                        <td ><?php echo $iscrito->cpf ?></td>
                        <td ><?php echo $iscrito->estado ?></td>
                        <td ><?php echo $iscrito->cidade ?></td>
                        <td ><?php echo $iscrito->clube ?></td>
                        <td >
                            <?php foreach ($iscrito->inscricoes as $inscricao): 
                            	if($inscricao->pago):
                            		?>
                            		<a title="Ver Comprovante" target="_blank" class="insc-pago" href="<?php echo JRoute::_('index.php?option=com_users&task=manage.comprovante&inscricao=' . (int) $inscricao->id); ?>">
                            		<?php
                            	endif;
                        	?>
                                <ul class="inline" >
                                    <li class="insc"><?php echo InscricaoConvencao::getSNinscricao($inscricao->id) ?></li>
                                    <li class="pago"><?php echo $inscricao->pago ? "SIM" : "NÃO" ?></li>
                                </ul>
                            <?php 
                            	$this->Ninscricoes++; 
                        		if($inscricao->pago):
                            ?>
                            		</a>
                        	<?php
                    			endif; 
                        	endforeach;
                        	?>
                        </td>
                        <td ><?php echo $iscrito->nascimento ? DateTime::createFromFormat("Y-m-d", $iscrito->nascimento)->format('d-m-Y') : "" ?></td>
                        <td ><?php echo $iscrito->delegado ?></td>
                        <td ><?php echo $iscrito->cargo_clube != "OUTRO" ? $iscrito->cargo_clube : $iscrito->qual_cc ?></td>
                        <td ><?php echo $iscrito->cargo_distrito != "OUTRO" ? $iscrito->cargo_distrito : $iscrito->qual_cd ?></td>
                        <td ><?php echo $iscrito->cl_mj ?></td>
                        <td ><?php echo $iscrito->camisa ?></td>
                        <td ><?php echo $iscrito->email ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div style="margin-top: 25px;" class="center no-print">
        <input type="button" class="button" value="Imprimir" onclick="window.print();"/>
    </div>
    
    <script type="text/javascript">
        function Estado(cidade, clube) {
            jQuery.post('../components/com_users/formulario/auxi/cidades.php', {estado: jQuery('#estado').val()},
        	function(resposta) {
                jQuery('#cidade').html(resposta);
                if (cidade) {
                    Selecionar('cidade', cidade);
                }
            });

        	jQuery.post('../components/com_users/formulario/auxi/clubes.php', {estado: jQuery('#estado').val()},
            function(resposta) {
                jQuery('#clube').html(resposta);
                if (clube) {
                    Selecionar('clube', clube);
                }
            });
        }

        function Selecionar(selecionar , Option){
            var Select = document.getElementById(selecionar); 
            for ( i =0; i < Select.length; i++){
                if (Select[i].value == Option){
                        Select[i].selected = true;
                }
            } 
        }        
        
        jQuery(document).ready(function() {
            jQuery('table tr td ul.insc-pago').click(function(){
                var url = 'components/com_users/formulario/comprovante.php?I=' + jQuery(this).attr('id') + "&U=<?php echo $this->user->id ?>";
                var aba = window.open(url, 'Comprovante' + jQuery(this).attr('id'), "width="+ (screen.width / 2) +", height=" + (screen.height / 2) +",scrollbars=yes,toolbar=no" );
            });
        });
        
        <?php if (isset($_POST['estado']) && $_POST['estado']) { ?>  
	                Selecionar('estado', "<?php echo $_POST['estado']; ?>");
	                Estado("<?php echo $_POST['cidade'] ?>", "<?php echo $_POST['clube'] ?>");
	    <?php } ?>

    </script>
	
<?php else: ?>
    <br>
        <center><h3>Ainda não há Inscritos</h3></center>
    <br>
<?php endif; ?>
       
