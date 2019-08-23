<?php require_once("php7_mysql_shim.php");

error_reporting(E_ALL ^ E_DEPRECATED ^ E_STRICT);
include_once("../../configuration.php");
include_once("../classe/Conecta.php");
include_once("../classe/Persistencia.php");

if (isset($_POST['matricula']) && $_POST['matricula']) {
    $matricula = preg_replace('/[^[:digit:]_]/', '', $_POST['matricula']);
    echo verifica('matricula', $matricula);
} 

if (isset($_POST['cpf']) && $_POST['cpf']) {
    $cpf = preg_replace('/[^[:digit:]_]/', '', $_POST['cpf']);
    echo verifica('cpf', $cpf);
} 

if(isset($_POST['email']) && $_POST['email']){
    $email = Persistencia::prepare($_POST['email'], Persistencia::STRING);
    echo verificaEmail($email);
}

//***************************************************************************	

function verifica($campo, $valor) {
    $tabela = $campo=='matricula' ? '__usuario' : 'jom1__users';
    $campo = $campo=='matricula' ? 'matricula' : 'username';
    $con = new Conecta();
    $sql = "SELECT * FROM $tabela WHERE $campo = '$valor';";
    $query = mysql_query($sql) or die("Error in query ");
    if (mysql_num_rows($query) > 0) {
        $campo = mysql_fetch_array($query);
        return $campo['id'];
    } else
        return false;
}

function verificaEmail($mail){
    $con = new Conecta();
    $sql = "SELECT * FROM jom1__users WHERE email = $mail;";
    $query = mysql_query($sql) or die("Error in query ");
    if (mysql_num_rows($query) > 0) {
        $campo = mysql_fetch_array($query);
        return $campo['email'];
    } else
        return false;
}

?>