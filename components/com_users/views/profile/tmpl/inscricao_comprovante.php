
<h3 class="center bold">Situação</h3>

<p class="center">
    <?= $this->inscricao->getPago() ? "Comprovante de Pagamento Anexado" : "Pendente do Comprovante Pagamento"?>
</p>


<div class="center">
    <?php 
    if($this->inscricao->getPago())
    {
        echo "<img src='" . $this->comprovante->getNomeCompleto(true) . "' class='img-polaroid' style='max-height: 200px; margin-bottom: 20px;' />";
    }
     ?>
</div>

<form class="center" method="POST" action="<?= JRoute::_('index.php?option=com_users&task=profile.comprovante') ?>" enctype="multipart/form-data" onsubmit="return validaArquivo()">    
    <div class="row">
        <div class="offset3 span6">

            <input type="file" name="comprovante" id="comprovante" accept="image/jpg,image/jpeg,image/png,application/pdf" required class="inputfile" /> 

            <div class="input-append" style="width: 100%">
                <input id="txtFile" type="text" readonly="true" style="border:1px solid #cccccc; line-height: 1;" value="Comprovante de Pagamento"  />
                <label class="btn" type="button" it="btn-file" for="comprovante">
                    <i class="icon-folder-open"></i>
                    <?php echo $this->inscricao->getPago() ? "Alterar" : "Anexar"; ?> Arquivo
                </a>
            </div>    
        </div>
    </div>

    <p class="center">Extensões permitidas: .pdf , .jpg , .png , .jpeg </p>
    <p class="center">Tamanho máximo do arquivo: 4M </p>
    <center>
        <button class="button" type="submit" id="btnComprovante">
            Enviar Comprovante
        </button>
    </center>
    
</form>


<script type="text/javascript">
    var extPermitidas = ["pdf", "jpg", "png", "jpeg"];
    var tamanhoMax = 4194304;
    function validaArquivo(){
        var doc = document.getElementById('comprovante');
        var extensao = doc.value.split('.');
        extensao = extensao[extensao.length - 1].toLowerCase() ;
        if(extPermitidas.indexOf(extensao.toLowerCase()) < 0){
            alert("Extensão do arquivo não é permitida.");
            return false;
        }else if(doc.files[0].size > tamanhoMax){
            alert("Tamanho do arquivo é superior ao permitido.");
            return false;
        }else{
            jQuery("#btnComprovante").attr("disabled", "disabled");
            return true;
        }
    }

    jQuery("#txtFile").click(function(){
        jQuery("#comprovante").click();
    });

    jQuery("#comprovante").change(function(){
        
        var file = jQuery(this).val().split("\\").pop();
        if(!file){
            file = "Comprovante de Pagamento";
        }

        jQuery('#txtFile').prop('readonly',false);
        jQuery('#txtFile').val(file);
        jQuery('#txtFile').prop('readonly',true);

    });
</script>