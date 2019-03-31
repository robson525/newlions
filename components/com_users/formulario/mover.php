 <?php 

 	if(isset($_GET['mover'])){
?>
<pre>
 <?php 
 		$pastaAnexo = "formulario/conprovante/convencao-20/";

        $sql1  = "SELECT * ";
        $sql1 .= "FROM __inscricao_convencao ic ";
        $sql1 .= "JOIN __comprovante c ON c.id = ic.comprovante ";
        $sql1 .= "WHERE ic.convencao_id = 5";
        
        print_r($sql1 . "\r\n\r\n");

        $query1 = mysql_query($sql1);
        $inscricoes1 = array();
        while($inscricao = mysql_fetch_object($query1)){
            $inscricoes1[] = $inscricao;
            rename($inscricao->local . $inscricao->md5 . $inscricao->tipo , $pastaAnexo . $inscricao->md5 . $inscricao->tipo);

            $sql2  = "UPDATE __comprovante SET local = '". $pastaAnexo ."' WHERE id = " . $inscricao->comprovante;
            print_r($sql2 . ";\r\n");
            mysql_query($sql1);

        }        
?>
</pre>
 <?php 
 	}

 ?>