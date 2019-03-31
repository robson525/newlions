<?php

//require("libraries/phpmailer/phpmailer.php");

class Email {
    
    private $mail;
    private $destinatario;
    
    public function __construct(){
        $this->mail = new PHPMailer();
        $this->mail->IsSMTP(); 
        $this->mail->Host = "smtp.lionsdla6.com.br"; 
        $this->mail->SMTPAuth = true; 
        $this->mail->Username = 'convencao=lionsdla6.com.br'; 
        $this->mail->Password = 'fortunamajor'; 
        
        $this->mail->setFrom("convencao@lionsdla6.com.br", "LIONS DLA-6"); // Seu e-mail
        //$this->mail->FromName = "LIONS DLA-6"; // Seu nome
        $this->mail->IsHTML(true);
        
        $this->mail->SMTPSecure = 'tls';
        $this->mail->WordWrap = 50;
        $this->mail->Port = 25;
        $this->mail->CharSet = "UTF-8";
        $this->mail->SMTPSecure = false; 
        $this->mail->SMTPAutoTLS = false;
    }
    
    public function setFrom($from = ''){
        $this->mail->From = $from;
    }
    
    public function setDestinatario($email = '', $nome = ''){
        $this->mail->AddAddress($email, $nome);
        $this->destinatario = $nome;
    } 
    
    public function inscricaoConvencao($convencao = 'XVI Convenção'){
        $this->mail->Subject = "Confirmação de Inscrição na " . $convencao;
        
        $texto = '  <strong>
                    <p style="font-size: 16px; padding:1px;">Caro(a) senhor(a) ' . $this->destinatario . '</p>'.
                    '<p style="font-size: 16px; padding:1px;">Seu cadastro foi realizado com sucesso na '. $convencao .' Distrital do Distrito LA6.</p>'.
                    '<p style="font-size: 16px; padding:1px;">'.
                    'Para mais informa&ccedil;&otilde;es visite o site do <a title="Distrito LA6" href="http://www.lionsdla6.com.br" target="_blank">Distrito LA6</a>.</p>'.
                    '</strong>';

        $this->mail->Body = $texto;
        
        //$this->mail->AltBody = " Caro(a) senhor(a) " . $this->destinatario . "\r\n Seu cadastro foi realizado com sucesso na ". $convencao ." Distrital do Distrito LA6.";
    }
    
    public function inscricaoSite(){
        $this->mail->Subject = "Confirmação de Inscrição no Site Lions DLA6";
        $texto = '  <strong>
                    <p style="font-size: 16px; padding:1px;">Caro(a) senhor(a) ' . $this->destinatario . '</p>'.
                    '<p style="font-size: 16px; padding:1px;">Seu cadastro foi realizado com sucesso no Site do LIONS - Distrito LA6.</p>'.
                    '<p style="font-size: 16px; padding:1px;">Por favor faça login no mesmo para confirmar sua participação na Convenção.</p>'.
                    '<p style="font-size: 16px; padding:1px;">'.
                    'Para mais informa&ccedil;&otilde;es visite o site do <a title="Distrito LA6" href="http://www.lionsdla6.com.br" target="_blank">Distrito LA6</a>.</p>'.
                    '</strong>';
        $this->mail->Body = $texto;
    }
    
    public function recuperarSenha($subject, $texto){
        $this->mail->Subject = $subject;
        
        // $texto = "Prezado(a) ".$this->destinatario . ", <br><br>".
        //          "Por motivos de segurança a senha é arquivada de forma irrecuperável.<br>".
        //          "O link abaixo permite que você possa efetuar a alteração de sua senha.<br><br>".
        //          '<a title="Redefinir Senha - Distrito LA6" '.
        //          'href="http://www.lionsdla6.com.br/index.php/xx-convenção/cadastro.html?redefinirsenha=' . $code . '"' .
        //          'target="_blank">REDEFINIÇÃO DE SENHA - LIONS DISTRITO LA6</a>';

         $this->mail->Body = $texto;
    }

    public function enviar(){
        if($this->mail->send()){
            return true;
        }else{
            return false;;
        }
    }
    
    public function getError(){
        return $this->mail->ErrorInfo;
    }
    
}