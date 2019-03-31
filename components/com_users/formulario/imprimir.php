<?php
error_reporting(E_ALL ^ E_DEPRECATED ^ E_STRICT);

require_once '../configuration.php';
require_once 'classe/Conecta.php';
require_once 'classe/Usuario.php';
require_once 'classe/Convencao.php';
require_once 'classe/InscricaoConvencao.php';
require_once 'classe/Comprovante.php';

if (isset($_GET['gerenciar'])) {
    $convencao_id = $_GET['gerenciar'];
    $_POST['estado'] = $_GET['estado'];
    $_POST['cidade'] = $_GET['cidade'];
    $_POST['clube'] = $_GET['clube'];
} else {
    $convencao_id = 1;
}
$connect = new Conecta();
$convencao = Convencao::getById($convencao_id);
$inscritos = InscricaoConvencao::getInscricoesGerencia($convencao_id);

//var_dump($inscritos);

$Ninscricoes = 0;
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Impressão - <?php echo $convencao->getTitulo() ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/fixedheadertable.css" rel="stylesheet" media="screen" />
        <style type="text/css">
            #print{
                width: 100%;
            }
            table th{
                white-space: nowrap;
            }
            table th, table td{
                text-align: center;
                font-size: 12px;
            }
            .iscriPago{
                width: 100%;
            }
            .iscriPago tr td{
                border: 1px solid rgba(0, 0, 0, 0.5);
            }
            .iscriPago .insc{
                width: 40px;
                padding-right: 5px;
            }
            .iscriPago .pago{
                padding-left: 5px;
                border-left: 1px solid black;
                width: 35px;
            }
        </style>
        <script src="js/jquery.js" type="text/javascript"></script>
        <script src="js/jquery.fixedheadertable.js" type="text/javascript"></script>
    </head>
    <body>

        <br>
    <center><h1>Gerênciamento das Inscrições da <?php echo $convencao->getTitulo() ?></h1></center>
    <br>

    <div class="" style="width: 100%; height: auto;">
        <table class="" id="print" cellpadding="0" cellspacing="0" border='1'>
            <thead>
                <tr>
                    <th >Nº</th>
                    <th >Prefixo</th>
                    <th >Nome</th>
                    <th >Estado</th>
                    <th >Cidade</th>
                    <th >Cluble</th>
                    <th style="padding: 3px;"> 
                        <table cellpadding="0" cellspacing="0" class="iscriPago">
                            <tr><td class="insc">Inscrição</td><td class="pago">Pago</td></tr>
                        </table>
                    </th>
                    <th >Nascimento</th>
                    <th >Delegado</th>
                    <th >Cargo no Clube</th>
                    <th >Cargo no Distrito</th>
                    <th >CL Melvin Jones</th>
                    <th >Camisa</th>
					<th >Email</th>
                </tr>
            </thead>z
            <tbody>
                <?php foreach ($inscritos as $i => $iscrito): ?>
                    <tr>
                        <td ><?php echo $i + 1 ?></td>
                        <td ><?php echo $iscrito->prefixo ?></td>
                        <td ><?php echo $iscrito->name ?></td>
                        <td ><?php echo $iscrito->estado ?></td>
                        <td ><?php echo $iscrito->cidade ?></td>
                        <td ><?php echo $iscrito->clube ?></td>
                        <td style="padding: 3px;">
                            <table class="iscriPago" cellpadding="0" cellspacing="0">
                            <?php foreach ($iscrito->inscricoes as $inscricao): ?>
                                <tr>
                                    <td class="insc"><?php echo InscricaoConvencao::getSNinscricao($inscricao->id) ?></td>
                                    <td class="pago"><?php echo $inscricao->pago ? "SIM" : "NÃO" ?></td>
                                </tr>
                                <?php $Ninscricoes++ ?>
                            <?php endforeach; ?>
                            </table>
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

    <br>
    <div>
        <table class="category" style="width: 30%; float: left; margin-left: 20px;" border="1">
            <caption><h3>Resultado desta Listagem</h3></caption>
            <tr>
                <th>Total de Inscritos</th>
                <td><?php echo count($inscritos); ?></td>
            </tr>
            <tr>
                <th>Total de Inscrições na Convenção</th>
                <td><?php echo $Ninscricoes; ?></td>
            </tr>
            <tr>
                <th>Inscritos no ultimos 7 dias</th>
                <td><?php echo InscricaoConvencao::fetInscritosSemana($convencao_id); ?></td>
            </tr>
        </table>

        <table class="category" style="width: 30%; float: right; margin-right: 20px;" border='1'>
            <caption><h3>Resultado Geral</h3></caption>
            <?php $total = InscricaoConvencao::getTotalInscritos($convencao_id); ?>
            <tr>
                <th>Total de Inscritos</th>
                <td><?php echo $total ? $total->total_inscritos : '' ?></td>
            </tr>
            <tr>
                <th>Total de Inscrições na Convenção</th>
                <td><?php echo $total ? $total->total_incricoes : ''; ?></td>
            </tr>
            <tr>
                <th>Inscritos no ultimos 7 dias</th>
                <td><?php echo InscricaoConvencao::fetInscritosSemana($convencao_id, true); ?></td>
            </tr>
        </table>
    </div>


</body>
<script type="text/javascript">
    window.print();
</script>
</html>