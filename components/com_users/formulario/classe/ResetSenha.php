<?php 

class ResetSenha {
    private $id;
    private $user_id;
    private $data;
    private $code;
    private $usado;
    private $data_usado;
    
    public function getId() {
        return $this->id;
    }

    public function getUser_id() {
        return $this->user_id;
    }

    public function getData() {
        return $this->data;
    }

    public function getCode() {
        return $this->code;
    }

    public function getUsado() {
        return $this->usado;
    }
    
    public function getDataUsado(){
        return $this->data_usado;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setUser_id($user_id) {
        $this->user_id = $user_id;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function setCode($code) {
        $this->code = $code;
    }

    public function setUsado($usado) {
        $this->usado = $usado;
    }
    
    public function setDataUsado($data_usado){
        $this->data_usado = $data_usado;
    }


    public function save(){
        if($this->getId()){
            return $this->updade();
        }else{
            return $this->insert();
        }
    }
    
    private function insert(){
        $sql  = "INSERT INTO jom1_user_reset_senha (user_id,data,code,usado) VALUES(";
        $sql .= Persistencia::prepare($this->getUser_id(), Persistencia::FK) . ", ";
        $sql .= "NOW(), ";
        $sql .= Persistencia::prepare($this->getCode(), Persistencia::STRING) . ", ";
        $sql .= Persistencia::prepare($this->getUsado(), Persistencia::BIT) . ") ";
        mysql_query($sql);
        if(mysql_error()){
            return false;
        }else{
            $this->id = mysql_fetch_object( mysql_query("SELECT LAST_INSERT_ID() AS id FROM jom1_user_reset_senha;"))->id;
            return true;
        }
    }

    private function updade(){
        $sql  = "UPDATE jom1_user_reset_senha SET ";
        $sql .= "usado = " . Persistencia::prepare($this->getUsado(), Persistencia::BIT) . ", ";
        $sql .= "data_usado = NOW() ";
        $sql .= "WHERE id = " . $this->getId();
        mysql_query($sql);
        if(mysql_error()){
            return false;
        }else {
            return true;
        }
    }

    public static function verificaCPF($cpf = 0){
        $sql = "SELECT * FROM jom1_users WHERE username = " . Persistencia::prepare($cpf, Persistencia::STRING);
        $query = mysql_query($sql);
        if(mysql_error()){
            return false;
        }
        $obj = mysql_fetch_object($query);
        $reset = new ResetSenha();
        $reset->setUser_id($obj->id);
        $reset->setCode(md5($obj->id . date("d-m-Y H:i:s:u")));
        $reset->setUsado('0');
        if($reset->save()){
            $email = new Email();
            $email->setDestinatario($obj->email, $obj->name);
            $email->recuperarSenha($reset->getCode());
            if($email->enviar()){
                return $obj->email;
            }  else {
                echo $email->getError();
                return false;
            }
        }
        
    }
    
    public static function verificaCode($code = ''){
        $sql = "SELECT * FROM jom1_user_reset_senha WHERE code = " . Persistencia::prepare($code, Persistencia::STRING);
        $query = mysql_query($sql);
        if(mysql_errno() || !mysql_num_rows($query)){
            return false;
        }
        $obj = mysql_fetch_object($query);
        if($obj->usado){
            return false;
        }
        return self::load($obj);
    }
    
    public static function getByPk($id = 0){
        $sql = "SELECT * FROM jom1_user_reset_senha WHERE id = " . Persistencia::prepare($id, Persistencia::PK);
        $query = mysql_query($sql);
        if(mysql_errno() || !mysql_num_rows($query)){
            return false;
        }
        $obj = mysql_fetch_object($query);
        return self::load($obj);
    }
    
    private function load($obj){
        $reset = new ResetSenha();
        $reset->setId($obj->id);
        $reset->setUser_id($obj->user_id);
        $reset->setData($obj->data);
        $reset->setCode($obj->code);
        $reset->setUsado($obj->usado);
        $reset->setDataUsado($obj->data_usado);
        return $reset;
    }
    
    public function alteraSenha($senha = 0){
        if($senha){
            $sql = "UPDATE jom1_users SET password = '" . md5($senha) . "' WHERE id = " . $this->getUser_id();
            mysql_query($sql);
            if(mysql_error()){
                return false;
            }else{
                $this->setUsado('1');
                $this->save();
                return true;
            } 
        }else{
            return false;
        }
    }

}