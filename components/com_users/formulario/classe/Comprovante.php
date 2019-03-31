<?php 
class Comprovante {
    
    private $id;
    private $nome;
    private $tipo;
    private $md5;
    private $local;
    private $tempName;
    private $db;

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function getMd5() {
        return $this->md5;
    }

    public function getLocal() {
        return $this->local;
    }

    public function getTempName() {
        return $this->tempName;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function setMd5($md5) {
        $this->md5 = $md5;
    }

    public function setLocal($local) {
        $this->local = $local;
    }

    public function setTempName($tempName) {
        $this->tempName = $tempName;
    }
    
    public function setConnection($db){
        $this->db = $db;
    }
    
    public function __construct($db = null) {
        $this->db = $db;
    }

    public function save(){
        if($this->getId()){
            $this->update();
        }else{
            $this->insert();
        }
    }
    
    private function insert(){
        if(!$this->uploadComprovante()){
            return false;
        }
        $sql = "INSERT INTO __comprovante (nome, tipo, md5, local) VALUES ( ";
        $sql .= Persistencia::prepare($this->getNome(), Persistencia::STRING) . ", ";
        $sql .= Persistencia::prepare($this->getTipo(), Persistencia::STRING) . ", ";
        $sql .= Persistencia::prepare($this->getMd5(), Persistencia::STRING) . ", ";
        $sql .= Persistencia::prepare($this->getLocal(), Persistencia::STRING) . ") ";
         
        $this->db->setQuery($sql);
        $this->db->execute();
       
        if($this->db->getErrorNum()){
            return false;
        }
        $this->id = $this->db->insertid();
        return true;
        
    }
    
    private function update(){
        
        
    }
    
    public static function getById($id = 0, $db = null){
        $sql = "SELECT * FROM __comprovante WHERE id = " . $id;
        
        if($db){
            $db->setQuery($sql);
            $db->execute();
            $comp = $db->loadObject();
        }else{
            $query = mysql_query($sql);
            if(mysql_num_rows($query)){
                $comp = mysql_fetch_object($query);
            }else{
                $comp = false;
            }
        }
        
        if($comp){
            return self::load($comp);
        }else{
            return false;
        }
    }
    
    private function load($comprovante_){
        $comprovante = new Comprovante();
        $comprovante->setId($comprovante_->id);
        $comprovante->setNome($comprovante_->nome);
        $comprovante->setTipo($comprovante_->tipo);
        $comprovante->setMd5($comprovante_->md5);
        $comprovante->setLocal($comprovante_->local);
        return $comprovante;
    }

    private function uploadComprovante(){
        if(move_uploaded_file($this->getTempName(), $this->getLocal() . $this->getMd5() . $this->getTipo())){
            return true;
        }else{
            return false;
        }
    }
    
    private function removeComprovante(){
        $arquivo = $this->getLocal() . $this->getMd5() . $this->getTipo();
        if(unlink($arquivo)){
            return true;
        }else{
            return false;
        }
    }
    
    public static function deletaComprovante($id = 0){
        $comprovante  = Comprovante::getById($id);
        if($comprovante && $comprovante->removeComprovante()){
            return $comprovante->delete();
        }
    }
    
    public function delete(){
        $sql = "DELETE FROM __comprovante WHERE id = " . $this->id;
        if($this->db){
            $this->db->setQuery($sql);
            $this->db->execute();
            if(!$this->db->getErrorNum()){
            return true;
        }
        }else{
            $query = mysql_query($sql);
            if(!mysql_error()){
                return true;
            }
        }
        return false;
    }
    
    
}
