<?php 
class Conecta {

    private $conn;

    // Realizando conexão e selecionando o banco de dados
    function __construct() {
        
        $config = new JConfig();
        $conn = mysql_connect($config->host, $config->user, $config->password) or die(mysql_error());
        $db = mysql_select_db($config->db, $conn) or die(mysql_error());

        if (mysql_errno()) {
            echo "falha ao conectar no MySQL: " . mysql_error();
        }

        $this->conn = $conn;

        // Definindo o charset como utf8 para evitar problemas com acentuação
        $charset = mysql_set_charset('utf8');
    }

    function desconecta() {
        mysql_close($this->conn);
    }


}

?>
